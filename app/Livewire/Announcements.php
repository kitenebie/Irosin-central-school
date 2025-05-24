<?php

namespace App\Livewire;

use Livewire\Component;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Illuminate\Contracts\View\View;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Fieldset;
use App\Models\Announcement as Announcement;
use Illuminate\Support\Facades\Auth;
use Filament\Notifications\Notification;
use Illuminate\Support\Str;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\CheckboxColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Tables\Contracts\HasTable;
use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;

class Announcements extends Component implements HasForms, HasTable, HasActions
{
    use InteractsWithActions;
    use InteractsWithTable;
    use InteractsWithForms;

    public ?array $data = [];
    public $modalData = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Audience Visibility')
                    ->description('Control who can view this post by tagging specific users or groups')
                    ->schema([
                        Toggle::make('post_public')
                            ->onColor('success')
                            ->offColor('danger')
                            ->default(true)
                            ->reactive(),
                        Fieldset::make('private')
                            ->hidden(fn(callable $get) => $get('post_public'))
                            ->schema([
                                Checkbox::make('user')->reactive()->label("Tag Specific users"),
                                Checkbox::make('group')->reactive()->label("Tag Specific groups"),
                                CheckboxList::make('tags_user')
                                    ->hidden(fn(callable $get) => ! $get('user'))
                                    ->label('Tag your audience [Users]')
                                    ->noSearchResultsMessage('No users found.')
                                    ->searchPrompt('Search for a audience')
                                    ->searchable()
                                    ->bulkToggleable()
                                    ->columns(1)
                                    ->options([
                                        'Carl Martes',
                                        'John Doe',
                                        'Edward Swite',
                                        'Anne Brezee',
                                    ]),
                                CheckboxList::make('tags_group')
                                    ->hidden(fn(callable $get) => ! $get('group'))
                                    ->label('Tag your audience [Groups]')
                                    ->noSearchResultsMessage('No groups found.')
                                    ->searchPrompt('Search for a audience')
                                    ->searchable()
                                    ->bulkToggleable()
                                    ->columns(1)
                                    ->options([
                                        'Grade 1 - Charity',
                                        'Grade 1 - Prarents',
                                        'Faculty Members',
                                        'PTA Members',
                                        'Parents',
                                    ]),
                            ])
                    ]),
                TextInput::make('title')
                    ->required(),
                FileUpload::make('images')
                    ->acceptedFileTypes([
                        'image/png',
                        'image/jpeg',
                        'image/gif',
                        'video/mp4',
                    ])
                    ->imageCropAspectRatio('16:9')
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
                    ->maxFiles(15)
                    ->maxSize(50000),
                MarkdownEditor::make('content')
                    ->toolbarButtons([
                    ]),
            ])
            ->statePath('data');
    }

    public function create(): void
    {
        $data = $this->form->getState();
        // Separate and reorder images: videos first, images second
        $videos = collect($data['images'])->filter(fn($img) => Str::endsWith($img, '.mp4'));
        $images = collect($data['images'])->filter(fn($img) => Str::endsWith($img, ['.png', '.jpg', '.jpeg', '.gif']));

        $orderedImages = $videos->concat($images)->values();

        $dataValues = [
            'title' => $data['title'],
            'images' => $orderedImages,
            'content' => $data['content'],
            'tags' => $data['post_public'] ? ['all'] : array_merge($data['tags_group'] ?? [], $data['tags_user'] ?? []),
        ];

        Announcement::create($dataValues);
        $this->form->fill([]);

        Notification::make()
            ->title('Saved successfully')
            ->success()
            ->send();
    }

    public function readMore($id)
    {
        $this->modalData = Announcement::where('id', $id)->get();
        dd($this->modalData);
    }
    public static function table(Table $table): Table
    {
        return $table
            ->query(Announcement::query()->orderByDesc('id'))
            ->columns([
                TextColumn::make('title')
                    ->label('Post Title')
                    ->searchable()
                    ->sortable(),

                IconColumn::make('post_public')
                    ->boolean()
                    ->label('Public')
                    ->trueIcon('heroicon-o-eye')
                    ->falseIcon('heroicon-o-eye-slash')
                    ->color(fn(bool $state): string => $state ? 'success' : 'danger'),

                TextColumn::make('tags_user')
                    ->label('Tagged Users')
                    ->formatStateUsing(fn($state) => is_array($state) ? implode(', ', $state) : '-')
                    ->toggleable(),

                TextColumn::make('tags_group')
                    ->label('Tagged Groups')
                    ->formatStateUsing(fn($state) => is_array($state) ? implode(', ', $state) : '-')
                    ->toggleable(),

                ImageColumn::make('images')
                    ->label('Media')
                    ->circular()
                    ->limit(3),

                TextColumn::make('updated_at')
                    ->label('Last Updated')
                    ->dateTime('M d, Y H:i')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->label('View')
                    ->modalHeading('View announcement')
                    ->modalSubmitAction(false) // Hide submit button
                    ->modalCancelActionLabel('Close')
                    ->fillForm(fn(Announcement $record): array => [
                        // dd($record);
                        'title' => $record->title,
                        'content' => $record->content,
                        'images' => $record->images ?? [],
                        'post_public' => $record->post_public ?? true,
                        'tags_user' => $record->tags_user ?? [],
                        'tags_group' => $record->tags_group ?? [],
                    ])
                    ->form([
                        Section::make('Audience Visibility')
                            ->schema([
                                Toggle::make('post_public')->label('Public')->disabled(),
                                TextInput::make('tags_user')->label('Tagged Users')->disabled(),
                                TextInput::make('tags_group')->label('Tagged Groups')->disabled(),
                            ]),
                        TextInput::make('title')->disabled(),
                        FileUpload::make('images')
                            ->multiple()
                            ->imageEditor()
                            ->disabled(),
                        MarkdownEditor::make('content')->disabled(),
                    ]),
                Tables\Actions\EditAction::make()
                    ->modalHeading('Edit announcement')
                    ->modalCancelActionLabel('Close')
                    ->fillForm(fn(Announcement $record): array => [
                        'title' => $record->title,
                        'content' => $record->content,
                        'images' => $record->images ?? [],
                        'post_public' => $record->post_public ?? true,
                        'tags_user' => $record->tags_user ?? [],
                        'tags_group' => $record->tags_group ?? [],
                    ])
                    ->form([
                        Section::make('Audience Visibility')
                            ->description('Control who can view this post by tagging specific users or groups')
                            ->schema([
                                Toggle::make('post_public')
                                    ->onColor('success')
                                    ->offColor('danger')
                                    ->default(true)
                                    ->reactive(),
                                Fieldset::make('private')
                                    ->hidden(fn(callable $get) => $get('post_public'))
                                    ->schema([
                                        Checkbox::make('user')->reactive()->label("Tag Specific users"),
                                        Checkbox::make('group')->reactive()->label("Tag Specific groups"),
                                        CheckboxList::make('tags_user')
                                            ->hidden(fn(callable $get) => ! $get('user'))
                                            ->label('Tag your audience [Users]')
                                            ->noSearchResultsMessage('No users found.')
                                            ->searchPrompt('Search for a audience')
                                            ->searchable()
                                            ->bulkToggleable()
                                            ->columns(1)
                                            ->options([
                                                'Carl Martes',
                                                'John Doe',
                                                'Edward Swite',
                                                'Anne Brezee',
                                            ]),
                                        CheckboxList::make('tags_group')
                                            ->hidden(fn(callable $get) => ! $get('group'))
                                            ->label('Tag your audience [Groups]')
                                            ->noSearchResultsMessage('No groups found.')
                                            ->searchPrompt('Search for a audience')
                                            ->searchable()
                                            ->bulkToggleable()
                                            ->columns(1)
                                            ->options([
                                                'Grade 1 - Charity',
                                                'Grade 1 - Prarents',
                                                'Faculty Members',
                                                'PTA Members',
                                                'Parents',
                                            ]),
                                    ])
                            ]),
                        TextInput::make('title')
                            ->required(),
                        FileUpload::make('images')
                            ->acceptedFileTypes([
                                'image/png',
                                'image/jpeg',
                                'image/gif',
                                'video/mp4',
                            ])
                            ->imageCropAspectRatio('16:9')
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
                            ->maxFiles(15)
                            ->maxSize(50000),
                        MarkdownEditor::make('content')
                            ->toolbarButtons([]),
                    ]),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
    public function render(): View
    {
        return view('livewire.announcements', [
            'Announcements' => Announcement::orderBy('updated_at', 'desc')->get()
        ]);
    }
}
