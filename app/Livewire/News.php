<?php

namespace App\Livewire;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Filament\Forms\Components\TagsInput;
use App\Models\news as NewsDB;
use Filament\Notifications\Notification;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Filament\Tables;

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
    public $tags = [
        "Biden",
        "Trump",
        "Elections",
        "Climate Crisis",
        "Artificial Intelligence",
        "ChatGPT",
        "OpenAI",
        "Bitcoin",
        "Ethereum",
        "Stock Market Crash",
        "Federal Reserve",
        "Interest Rates",
        "Inflation",
        "Ukraine War",
        "Israel-Palestine",
        "NATO",
        "China Relations",
        "TikTok Ban",
        "COVID-19",
        "Vaccine Updates",
        "Omicron Variant",
        "Global Warming",
        "NASA",
        "SpaceX",
        "Mars Mission",
        "Hollywood Strike",
        "Oscars",
        "Grammys",
        "Taylor Swift",
        "Elon Musk",
        "Tesla",
        "Meta",
        "Facebook",
        "Instagram",
        "Data Breach",
        "Hackers",
        "Ransomware",
        "Climate Summit",
        "Renewable Energy",
        "Electric Vehicles",
        "Mental Health Awareness",
        "Gun Violence",
        "School Shootings",
        "Black Lives Matter",
        "MeToo",
        "LGBTQ+ Rights",
        "Pride Month",
        "Women in Tech",
        "Remote Work",
        "Job Market",
        "Layoffs",
        "Startup Funding",
        "IPO",
        "Crypto Regulation",
        "AI Ethics",
        "Deepfakes",
        "Misinformation",
        "Fact-Checking",
        "Censorship",
        "Press Freedom",
        "Supreme Court",
        "Roe v. Wade",
        "Migration Crisis",
        "Border Policy",
        "Trade War",
        "Supply Chain",
        "Electricity Shortage",
        "Water Crisis",
        "Hurricane Season",
        "Wildfires",
        "Earthquakes",
        "Humanitarian Aid",
        "UN",
        "G7 Summit",
        "BRICS",
        "Davos",
        "Tech Layoffs",
        "Streaming Wars",
        "Netflix Originals",
        "Disney+",
        "Marvel",
        "DC Comics",
        "World Cup",
        "Olympic Games",
        "Champions League",
        "NBA Playoffs",
        "Super Bowl",
        "Wimbledon",
        "US Open",
        "AI in Healthcare",
        "Digital Privacy",
        "Smart Cities",
        "Drone Warfare",
        "Facial Recognition",
        "5G Rollout",
        "Cybersecurity Laws",
        "Student Loans",
        "College Protests",
        "DEI",
        "Public Transit",
        "Electric Grid",
        "Affordable Housing",
        "Rent Crisis",
        "Minimum Wage",
        "Food Prices",
        "Consumer Rights",
        "Animal Rights",
        "Plastic Ban"
    ];
      
    
    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                FileUpload::make('mainImage')
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
                    ->required(),
                TextInput::make('title')
                    ->required(),
                MarkdownEditor::make('content')
                    ->toolbarButtons([
                        'attachFiles',
                        'blockquote',
                        'bold',
                        'bulletList',
                        'heading',
                        'italic',
                        'link',
                        'orderedList',
                        'redo',
                        'strike',
                        'undo',
                    ])
                    ->required(),
                TagsInput::make('categories')
                    ->reorderable()
                    ->required()
                    ->placeholder('New Categories')
                    ->suggestions($this->categories)
                    ->color('primary'),
                TagsInput::make('tags')
                    ->reorderable()
                    ->required()
                    ->suggestions($this->tags)
                    ->color('primary'),
                FileUpload::make('ads1')
                    ->acceptedFileTypes([
                        'image/png',
                        'image/jpeg',
                        'image/gif',
                    ])
                    // ->preserveFilenames()
                    ->imageEditor()
                    ->imageEditorEmptyFillColor('Green')
                    ->loadingIndicatorPosition('left')
                    ->removeUploadedFileButtonPosition('right')
                    ->uploadButtonPosition('left')
                    ->uploadProgressIndicatorPosition('left')
                    ->openable()
                    ->uploadingMessage('Uploading Images...')
                    ->minFiles(0)
                    ->maxFiles(1)
                    ->maxSize(50000),
                FileUpload::make('ads2')
                    ->acceptedFileTypes([
                        'image/png',
                        'image/jpeg',
                        'image/gif',
                    ])
                    // ->preserveFilenames()
                    ->multiple()
                    ->imageEditor()
                    ->imageEditorEmptyFillColor('Green')
                    ->loadingIndicatorPosition('left')
                    ->panelLayout('integrated')
                    ->removeUploadedFileButtonPosition('right')
                    ->uploadButtonPosition('left')
                    ->uploadProgressIndicatorPosition('left')
                    ->panelLayout('grid')
                    ->reorderable()
                    ->appendFiles()
                    ->openable()
                    ->uploadingMessage('Uploading Images...')
                    ->minFiles(0)
                    ->maxFiles(2)
                    ->maxSize(50000),

            
            


            ])
            ->statePath('data');
    }
    
    public function create(): void
    {
        // dd($this->form->getState());
        NewsDB::create($this->form->getState());
        $this->form->fill([]); 
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
                Tables\Columns\ImageColumn::make('mainImage')->label('Image')->size(50),
                Tables\Columns\TextColumn::make('title')->label('Title')->limit(50),
                Tables\Columns\TextColumn::make('content')->label('Content')->limit(100),
                Tables\Columns\TextColumn::make('categories')->label('Categories'),
                Tables\Columns\TextColumn::make('tags')->label('Tags'),
                Tables\Columns\TextColumn::make('created_at')->label('Created At')->dateTime(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('categories')->options($this->categories),
                Tables\Filters\SelectFilter::make('tags')->options($this->tags),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
