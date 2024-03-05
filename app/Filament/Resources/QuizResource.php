<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Quiz;
use Filament\Tables;
use App\Enums\QuizType;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Enums\QuestionType;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\QuizResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\QuizResource\RelationManagers;

class QuizResource extends Resource
{
    protected static ?string $model = Quiz::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->columns([
                        'sm' => 2,
                    ])
                    ->schema([
                        Forms\Components\Select::make('user_id')
                            ->relationship('user', 'name')
                            ->required(),
                        Select::make('Publish Type')
                            ->options(QuizType::class)
                            ->required(),

                        Forms\Components\TextInput::make('Quiz Heading')
                            ->required(),
                        Forms\Components\Textarea::make('Say more about this Quiz')
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('marks_total')
                            ->numeric(),
                        Forms\Components\TextInput::make('Ask a Question?')
                            ->required(),
                        Select::make('Select a Question Type')
                            ->options(QuestionType::class)
                            ->required(),
                        Forms\Components\TextInput::make('Want to say any clue?'),
                        // ->required(),
                        // Forms\Components\TextInput::make('type')
                        //     ->required(),


                        Forms\Components\DateTimePicker::make('started_at')
                            ->required(),
                        Forms\Components\DateTimePicker::make('expired_at')
                            ->required(),

                    ]),
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
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('marks_total')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('type')
                    ->searchable(),
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
                //
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
