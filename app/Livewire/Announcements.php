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
use App\Models\Announcement;
use Illuminate\Support\Facades\Auth;
use Filament\Notifications\Notification;

class Announcements extends Component implements HasForms
{
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
                    ->hidden(fn (callable $get) => $get('post_public'))
                    ->schema([
                        Checkbox::make('user')->reactive()->label("Tag Specific users"),
                        Checkbox::make('group')->reactive()->label("Tag Specific groups"),
                        CheckboxList::make('tags_user')
                            ->hidden(fn (callable $get) => ! $get('user'))
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
                                ->hidden(fn (callable $get) => ! $get('group'))
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
                    ->maxFiles(15)
                    ->maxSize(50000),
                MarkdownEditor::make('content'),
            ])
            ->statePath('data');
    }
    
    public function create(): void
    {
        $data = $this->form->getState();
        $dataValues = [
            'title' => $data['title'],
            'images' => $data['images'],
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

    public function render() : View
    {
        return view('livewire.announcements',[
            'Announcements' => Announcement::orderBy('updated_at', 'desc')->get()
        ]);
    }
}
