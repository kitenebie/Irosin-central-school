<?php

namespace App\Livewire;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Filament\Forms\Components\TagsInput;
use App\Models\NewsPage as NewsDB;
use Filament\Notifications\Notification;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Wizard;

class News extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public ?array $data = [];
    public $categories = [
        "World",
        "International",
        "Politics",
        "U.S. Politics",
        "Global Politics",
        "Business",
        "Economy",
        "Markets",
        "Banking",
        "Stock Market",
        "Finance",
        "Investing",
        "Cryptocurrency",
        "Real Estate",
        "Energy",
        "Oil & Gas",
        "Utilities",
        "Startups",
        "Entrepreneurship",
        "Venture Capital",
        "Technology",
        "Gadgets",
        "AI & Machine Learning",
        "Cybersecurity",
        "Data Privacy",
        "Social Media",
        "Internet",
        "Software",
        "Hardware",
        "Mobile",
        "Cloud Computing",
        "E-commerce",
        "Science",
        "Space",
        "Physics",
        "Biology",
        "Environment",
        "Climate Change",
        "Natural Disasters",
        "Conservation",
        "Weather",
        "Health",
        "Mental Health",
        "Healthcare Policy",
        "Medicine",
        "Fitness",
        "Nutrition",
        "Public Health",
        "Diseases",
        "COVID-19",
        "Vaccines",
        "Lifestyle",
        "Fashion",
        "Beauty",
        "Travel",
        "Food & Drink",
        "Home & Garden",
        "Relationships",
        "Parenting",
        "Pets",
        "Education",
        "Higher Education",
        "K-12",
        "Student Life",
        "Scholarships",
        "Entertainment",
        "Movies",
        "TV Shows",
        "Streaming",
        "Music",
        "Celebrities",
        "Theater",
        "Pop Culture",
        "Art & Design",
        "Books",
        "Gaming",
        "Esports",
        "Comics",
        "Sports",
        "Football",
        "Soccer",
        "Basketball",
        "Baseball",
        "Tennis",
        "Olympics",
        "MMA / UFC",
        "Motorsports",
        "Wrestling",
        "Golf",
        "Cricket",
        "Local News",
        "Regional News",
        "Community",
        "Crime",
        "Public Safety",
        "Legal",
        "Courts",
        "Law Enforcement",
        "Human Rights",
        "Immigration",
        "Social Justice",
        "Race & Ethnicity",
        "Gender",
        "Religion",
        "Faith & Spirituality",
        "Culture",
        "Philosophy",
        "Opinion",
        "Editorial",
        "Columns",
        "Letters",
        "Satire",
        "Breaking News",
        "Obituaries",
        "Military",
        "Defense",
        "Terrorism",
        "Security",
        "Surveillance",
        "Government",
        "Infrastructure",
        "Transportation",
        "Labor",
        "Unions",
        "Agriculture",
        "Commodities",
        "Philanthropy",
        "Donations & Aid",
        "Charities",
        "Events",
        "Conferences",
        "Awards",
        "Historical",
        "Anniversaries",
        "Technology Policy",
        "Digital Ethics",
        "Metaverse",
        "Web3",
        "Space Exploration"
    ];


    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Wizard::make([
                    Wizard\Step::make('News Topic')
                        ->schema([
                            FileUpload::make('image')
                                ->acceptedFileTypes([
                                    'image/png',
                                    'image/jpeg',
                                    'image/gif',
                                    'video/mp4',
                                ])
                                ->imageEditor()
                                ->imageEditorEmptyFillColor('Green')
                                ->loadingIndicatorPosition('left')
                                ->removeUploadedFileButtonPosition('right')
                                ->uploadButtonPosition('left')
                                ->uploadProgressIndicatorPosition('left')
                                ->openable()
                                ->uploadingMessage('Uploading Images...')
                                ->minFiles(1)
                                ->maxFiles(1)
                                ->maxSize(50000)
                                ->required(true),
                            Select::make('topic_category')->label('Main Topic')
                                ->required(true)
                                ->options($this->categories),
                            TagsInput::make('relevant_topic')
                                ->reorderable()
                                ->required(true)
                                ->placeholder('New Categories')
                                ->suggestions($this->categories)
                                ->separator(',')
                                ->color('primary'),
                        ]),
                    Wizard\Step::make('News Title & Authors')
                        ->schema([
                            TextInput::make('title')
                                ->required(true),
                            TextInput::make('author')
                                ->required(true),
                            RichEditor::make('author_description')
                                ->toolbarButtons([]),
                            TextInput::make('read_duration')
                                ->numeric()
                                ->required(true),
                            Select::make('remarks')->label('Remark')
                                ->required(true)
                                ->options([
                                    'Normal' => 'Normal',
                                    'Featured' => 'Featured'
                                ]),
                        ]),
                    Wizard\Step::make('News Content')
                        ->schema([
                            Repeater::make('content')
                                ->schema([
                                    TextInput::make('subject'),
                                    Repeater::make('Paragraph')
                                        ->schema([
                                            RichEditor::make('content')
                                                ->toolbarButtons([]),
                                        ])->collapsed(),
                                    Repeater::make('Quote')
                                        ->schema([
                                            RichEditor::make('Quote')
                                                ->toolbarButtons([]),
                                        ])->collapsed()
                                ])->collapsible()->minItems(1)
                        ]),
                ])
            ])
            ->statePath('data');
    }

    public function create(): void
    {
        // dd($this->form->getState());
        NewsDB::create($this->form->getState());
        // $this->form->fill([]); 
        Notification::make()
            ->title('Saved successfully')
            ->success()
            ->send();
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(NewsDB::query()->OrderByDesc('id'))
            ->columns([
                Tables\Columns\ImageColumn::make('image')->label('Image')->size(50),
                Tables\Columns\TextColumn::make('title')->label('Title')->limit(50),
                Tables\Columns\TextColumn::make('content')->label('Content')->limit(100),
                Tables\Columns\TextColumn::make('topic_category')->label('Categories'),
                Tables\Columns\TextColumn::make('created_at')->label('Created At')->dateTime(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('categories')->options($this->categories),
            ])
            ->actions([
                Tables\Actions\Action::make('edit')
                    ->label('Edit')
                    ->icon('heroicon-o-pencil-square')
                    ->form([
                        Wizard::make([
                            Wizard\Step::make('News Topic')
                                ->schema([
                                    FileUpload::make('image')
                                        ->acceptedFileTypes([
                                            'image/png',
                                            'image/jpeg',
                                            'image/gif',
                                            'video/mp4',
                                        ])
                                        ->imageEditor()
                                        ->imageEditorEmptyFillColor('Green')
                                        ->loadingIndicatorPosition('left')
                                        ->removeUploadedFileButtonPosition('right')
                                        ->uploadButtonPosition('left')
                                        ->uploadProgressIndicatorPosition('left')
                                        ->openable()
                                        ->uploadingMessage('Uploading Images...')
                                        ->minFiles(1)
                                        ->maxFiles(1)
                                        ->maxSize(50000)
                                        ->required(true),
                                    Select::make('topic_category')->label('Main Topic')
                                        ->required(true)
                                        ->options($this->categories),
                                    TagsInput::make('relevant_topic')
                                        ->reorderable()
                                        ->required(true)
                                        ->placeholder('New Categories')
                                        ->suggestions($this->categories)
                                        ->separator(',')
                                        ->color('primary'),
                                ]),
                            Wizard\Step::make('News Title & Authors')
                                ->schema([
                                    TextInput::make('title')
                                        ->required(true),
                                    TextInput::make('author')
                                        ->required(true),
                                    RichEditor::make('author_description')
                                        ->toolbarButtons([]),
                                    TextInput::make('read_duration')
                                        ->numeric()
                                        ->required(true),
                                    Select::make('remarks')->label('Remark')
                                        ->required(true)
                                        ->options([
                                            'Normal' => 'Normal',
                                            'Featured' => 'Featured'
                                        ]),
                                ]),
                            Wizard\Step::make('News Content')
                                ->schema([
                                    Repeater::make('content')
                                        ->schema([
                                            TextInput::make('subject'),
                                            Repeater::make('Paragraph')
                                                ->schema([
                                                    RichEditor::make('content')
                                                        ->toolbarButtons([]),
                                                ])->collapsed(),
                                            Repeater::make('Quote')
                                                ->schema([
                                                    RichEditor::make('Quote')
                                                        ->toolbarButtons([]),
                                                ])->collapsed()
                                        ])->collapsible()->minItems(1)
                                ]),
                        ])
                    ])
                    ->fillForm(function (NewsDB $record): array {
                        return [
                            'image' => $record->image,
                            'topic_category' => $record->topic_category,
                            'relevant_topic' => $record->relevant_topic,
                            'title' => $record->title,
                            'author' => $record->author,
                            'author_description' => $record->author_description,
                            'read_duration' => $record->read_duration,
                            'remarks' => $record->remarks,
                            'topic_category' => $record->topic_category,
                            'relevant_topic' => $record->relevant_topic,
                            'content' => collect($record->content)->map(function ($item) {
                                return [
                                    'subject' => $item['subject'] ?? '',
                                    'Paragraph' => collect($item['Paragraph'] ?? [])->map(fn($p) => [
                                        'content' => $p['content'] ?? '',
                                    ])->toArray(),
                                    'Quote' => collect($item['Quote'] ?? [])->map(fn($q) => [
                                        'Quote' => $q['Quote'] ?? '',
                                    ])->toArray(),
                                ];
                            })->toArray(),
                        ];
                    })
                    ->action(function (NewsDB $record, array $data): void {
                        $record->update($data);

                        Notification::make()
                            ->title('News updated successfully')
                            ->success()
                            ->send();
                    }),
                Tables\Actions\DeleteAction::make(),
            ])

            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public function render()
    {
        return view('livewire.news');
    }
}
