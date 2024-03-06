<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Quiz;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\CheckboxList;
use Filament\Tables;
use App\Enums\QuizType;
use Filament\Forms\Get;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Enums\QuestionType;
use Filament\Resources\Resource;
use Filament\Forms\Components\Grid;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\IconColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\QuizResource\Pages;

class QuizResource extends Resource
{
    protected static ?string $model = Quiz::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Quiz Details')
                    ->icon('heroicon-m-check')
                    ->columns([
                        'default' => 1,
                        'sm' => 2,
                        '2xl' => 3
                    ])
                    ->schema([
                        Forms\Components\TextInput::make('timer')
                            ->numeric()
                            ->placeholder('00 (Minutes)')
                            ->maxLength(150),
                        Forms\Components\Select::make('user_id')
                            ->relationship('user', 'name')
                            ->required()
                            ->columnStart(1),
                        Select::make('type')
                            ->options(QuizType::class)
                            ->required(),
                        Forms\Components\TextInput::make('title')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),
                        Textarea::make('description')
                            ->autosize()
                            ->rows(3)
                            ->columnSpanFull(),
                        Forms\Components\DateTimePicker::make('started_at')
                            ->before('expired_at')
                            ->required(),
                        Forms\Components\DateTimePicker::make('expired_at')
                            ->after('started_at')
                            ->required(),

                    ]),

                Repeater::make('questions')
                    ->relationship()
                    ->schema([
                        Section::make()
                            ->columns([
                                'default' => 1,
                                'sm' => 2,
                                '2xl' => 3
                            ])
                            ->schema([
                                Forms\Components\TextInput::make('marks')
                                    ->numeric()
                                    ->maxLength(100),
                                Forms\Components\TextInput::make('title')
                                    ->required()
                                    ->maxLength(255)
                                    ->columnSpanFull(),
                                Textarea::make('hint')
                                    ->autosize()
                                    ->rows(3)
                                    ->columnSpanFull(),
                            ]),
                    ])
                    ->collapsible()
                    ->columnSpanFull()
                    ->itemLabel(fn(array $state): ?string => "Question: {$state['title']}" ?? null),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->searchable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tenant_exists')
                    ->label('Is Tenant')
                    ->exists('tenant')
                    ->alignCenter(),
                Tables\Columns\TextColumn::make('title')
                    ->limit(20)
                    ->searchable(),
                Tables\Columns\TextColumn::make('description')
                    ->limit(40)
                    ->searchable(),
                Tables\Columns\TextColumn::make('marks_total')
                    ->numeric()
                    ->alignCenter()
                    ->sortable(),
                Tables\Columns\TextColumn::make('type')
                    ->badge()
                    ->searchable(),
                Tables\Columns\TextColumn::make('timer')
                    ->numeric()
                    ->alignCenter()
                    ->default(0)
                    ->searchable(),
                IconColumn::make('is_timeout')
                    ->boolean()
                    ->alignCenter(),
                Tables\Columns\TextColumn::make('questions_count')
                    ->counts('questions')
                    ->alignCenter(),
                Tables\Columns\TextColumn::make('started_at')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('expired_at')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('type')
                    ->options(QuizType::class),
                Filter::make('is_timeout')
                    ->query(fn(Builder $query): Builder => $query->where('is_timeout', true))
                    ->toggle(),
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
            'index' => Pages\ListQuizzes::route('/'),
            'create' => Pages\CreateQuiz::route('/create'),
            'edit' => Pages\EditQuiz::route('/{record}/edit'),
        ];
    }
}
