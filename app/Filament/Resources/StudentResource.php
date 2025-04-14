<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StudentResource\Pages;
use App\Filament\Resources\StudentResource\RelationManagers;
use App\Models\Student;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Actions\Action;

class StudentResource extends Resource
{
    protected static ?string $model = Student::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Learner’s Reference Number')
                    ->description('The Learner’s Reference Number (LRN) must be a 12-digit number.')
                    ->schema([
                        Checkbox::make('with_lrn')
                            ->label('With LRN?')
                            ->inline()
                            ->reactive(),
                        TextInput::make('lrn')
                            ->label('LRN')
                            ->prefixIcon('heroicon-m-user-circle')
                            ->hidden(fn (callable $get) => ! $get('with_lrn'))
                            ->columnSpan(3),
                    ])
                    ->columns(4),
    
                Section::make('Student Personal Information')
                    ->description('Basic personal details of the learner.')
                    ->schema([
                        TextInput::make('adviser_id')
                            ->label('Adviser ID')
                            ->prefixIcon('heroicon-m-user-circle'),
                        TextInput::make('last_name')
                            ->label('Last Name')
                            ->prefixIcon('heroicon-m-user-circle'),
                        TextInput::make('first_name')
                            ->label('First Name')
                            ->prefixIcon('heroicon-m-user-circle'),
                        TextInput::make('middle_name')
                            ->label('Middle Name')
                            ->prefixIcon('heroicon-m-user-circle'),
                        TextInput::make('extension_name')
                            ->label('Extension Name')
                            ->prefixIcon('heroicon-m-user-circle'),
                        DatePicker::make('birthdate')
                            ->label('Birthdate')
                            ->prefixIcon('heroicon-m-cake')
                            ->native(false),
                        TextInput::make('age')
                            ->label('Age')
                            ->prefixIcon('heroicon-m-user-circle'),
                        Select::make('sex')
                            ->label('Sex')
                            ->options([
                                'Male' => 'Male',
                                'Female' => 'Female',
                            ]),
                        TextInput::make('mother_tongue')
                            ->label('Mother Tongue')
                            ->prefixIcon('heroicon-m-language'),
                        TextInput::make('permanent_address')
                            ->label('Permanent Address')
                            ->prefixIcon('heroicon-m-map-pin')
                            ->suffixAction(
                                Action::make('SelectFromThemap')
                                    ->icon('heroicon-m-globe-americas')
                                    ->action(function () {
                                        
                                    })
                                ),
                        TextInput::make('current_address')
                            ->label('Current Address')
                            ->prefixIcon('heroicon-m-map-pin')
                            ->suffixAction(
                                Action::make('SelectFromThemap')
                                    ->icon('heroicon-m-globe-americas')
                                    ->action(function () {
                                        
                                    })
                                )
                            ->columnspan([
                                'sm' => 1,
                                'md' => 1,
                                'lg' => 2,
                                'xl' => 2,
                                '2xl' => 5,
                            ]),
                    ])
                    ->columns([
                        'sm' => 1,
                        'md' => 1,
                        'lg' => 3,
                        'xl' => 4,
                        '2xl' => 6,
                    ]),
    
                Section::make('Learners with Disability')
                    ->description('Specify if the learner has a disability.')
                    ->schema([
                        Checkbox::make('is_learner_with_disability')
                            ->label('Is learner with disability?')
                            ->inline()
                            ->reactive(),
                        Select::make('disability_type')
                            ->label('Disability Type')
                            ->prefixIcon('heroicon-m-rectangle-group')
                            ->options([
                                'Visual Impairment', 'Hearing Impairment', 'Learning Disability', 'Intellectual Disability',
                                'Blind', 'Low Vision', 'Speech/Language Disorder', 'Cerebral Palsy',
                                'Special Health Problem/Chronic Disease', 'Multiple Disorder', 'Autism Spectrum Disorder',
                                'Emotional-Behavioral Disorder', 'Orthopedic/Physical Handicap', 'Cancer',
                            ])
                            ->hidden(fn (callable $get) => ! $get('is_learner_with_disability'))
                            ->columnSpan(3),
                            ])
                            ->columns(4),
    
                Section::make('Returning Learner')
                    ->description('Check if the student is a returning learner.')
                    ->schema([
                        Checkbox::make('returning_learner')
                            ->label('Returning Learner')
                            ->inline()
                            ->reactive(),
                    ]),
    
                Section::make('Indigenous Peoples')
                    ->description('Specify if the learner belongs to an indigenous group.')
                    ->schema([
                        Checkbox::make('indigenous_peoples')
                            ->label('Indigenous Peoples?')
                            ->inline()
                            ->reactive(),
                        TextInput::make('indigenous_peoples_specification')
                            ->label('Specification')
                            ->prefixIcon('heroicon-m-user-group')
                            ->hidden(fn (callable $get) => ! $get('indigenous_peoples'))
                            ->columnSpan(3),
                    ])
                    ->columns(4),
    
                Section::make('4Ps Beneficiary')
                    ->description('Information on 4Ps (Pantawid Pamilyang Pilipino Program) status.')
                    ->schema([
                        Checkbox::make('4ps_beneficiary')
                            ->label('Is 4Ps Beneficiary?')
                            ->inline()
                            ->reactive(),
                        TextInput::make('4ps_household_id')
                            ->label('4Ps Household ID')
                            ->prefixIcon('heroicon-m-user-group')
                            ->hidden(fn (callable $get) => ! $get('4ps_beneficiary'))
                            ->columnSpan(3),
                    ])
                    ->columns(4),
    
                Section::make('Parents Information')
                    ->description('Details about the learner’s parents or guardian.')
                    ->schema([
                        TextInput::make('father_name')
                            ->label('Father’s Name')
                            ->prefixIcon('heroicon-m-user-circle'),
                        TextInput::make('mother_maiden_name')
                            ->label('Mother’s Maiden Name')
                            ->prefixIcon('heroicon-m-user-circle'),
                        TextInput::make('legal_guardian_name')
                            ->label('Legal Guardian’s Name')
                            ->prefixIcon('heroicon-m-user-circle'),
                        TextInput::make('contact_number')
                            ->label('Contact Number')
                            ->prefixIcon('heroicon-m-user-circle'),
                    ])
                    ->columns([
                        'sm' => 1,
                        'md' => 1,
                        'lg' => 4,
                        'xl' => 4,
                        '2xl' => 4,
                    ]),
    
                Section::make('Education Information')
                    ->description('Previous education background of the learner.')
                    ->schema([
                        TextInput::make('last_grade_level_completed')
                            ->label('Last Grade Level Completed')
                            ->prefixIcon('heroicon-m-academic-cap'),
                        TextInput::make('last_school_year_completed')
                            ->label('Last School Year Completed')
                            ->prefixIcon('heroicon-m-academic-cap'),
                        TextInput::make('last_school_attended')
                            ->label('Last School Attended')
                            ->prefixIcon('heroicon-m-academic-cap'),
                        TextInput::make('school_id')
                            ->label('School ID')
                            ->prefixIcon('heroicon-m-academic-cap'),
                        
                            Select::make('distance_learning_preference')
                            ->label('Distance Learning Preference')
                            ->prefixIcon('heroicon-m-book-open')
                            ->options([
                                'Modular (Print)', 'Modular (Digital)', 'Online',
                                'Radio-Based Instruction', 'Educational Television',
                                'Blended', 'Homeschooling',
                            ])
                            ->columnspan([
                                'sm' => 1,
                                'md' => 1,
                                'lg' => 2,
                                'xl' => 2,
                                '2xl' => 5,
                            ]),
                            Fieldset::make('Quarter')
                            ->schema([
                                Radio::make('semester')
                                ->label('Quarter')
                                ->options([
                                    '1st' => '1st',
                                    '2nd' => '2nd',
                                    '3rd' => '3rd',
                                    '4th' => '4th',
                                ]),
                            ])
                    ])
                    ->columns([
                        'sm' => 1,
                        'md' => 1,
                        'lg' => 3,
                        'xl' => 3,
                        '2xl' => 6,
                    ]),
            ]);
    }
    

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('lrn')
                    ->label('LRN')
                    ->searchable()
                    ->sortable(),
    
                Tables\Columns\TextColumn::make('first_name')
                    ->label('First Name')
                    ->searchable()
                    ->sortable(),
    
                Tables\Columns\TextColumn::make('last_name')
                    ->label('Last Name')
                    ->searchable()
                    ->sortable(),
    
                Tables\Columns\TextColumn::make('age')
                    ->label('Age')
                    ->sortable(),
    
                Tables\Columns\TextColumn::make('sex')
                    ->label('Sex')
                    ->sortable(),
    
                Tables\Columns\TextColumn::make('birthdate')
                    ->label('Birthdate')
                    ->date()
                    ->sortable(),
    
                Tables\Columns\TextColumn::make('mother_tongue')
                    ->label('Mother Tongue'),
    
                Tables\Columns\TextColumn::make('permanent_address')
                    ->label('Address')
                    ->limit(30),
    
                Tables\Columns\TextColumn::make('last_grade_level_completed')
                    ->label('Last Grade Level')
                    ->sortable(),
    
                Tables\Columns\TextColumn::make('last_school_attended')
                    ->label('Last School Attended')
                    ->limit(30),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('sex')
                    ->label('Sex')
                    ->options([
                        'Male' => 'Male',
                        'Female' => 'Female',
                    ]),
    
                Tables\Filters\Filter::make('is_learner_with_disability')
                    ->label('Learner with Disability')
                    ->query(fn ($query) => $query->where('is_learner_with_disability', true)),
    
                Tables\Filters\Filter::make('returning_learner')
                    ->label('Returning Learner')
                    ->query(fn ($query) => $query->where('returning_learner', true)),
    
                Tables\Filters\Filter::make('4ps_beneficiary')
                    ->label('4Ps Beneficiary')
                    ->query(fn ($query) => $query->where('4ps_beneficiary', true)),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
    

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListStudents::route('/'),
            'create' => Pages\CreateStudent::route('/create'),
            'edit' => Pages\EditStudent::route('/{record}/edit'),
        ];
    }
}
