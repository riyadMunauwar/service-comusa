<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\FeatureResource\Pages;
use App\Filament\Admin\Resources\FeatureResource\RelationManagers;
use App\Models\Feature;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FeatureResource extends Resource
{
    protected static ?string $model = Feature::class;

    protected static ?string $slug = 'appearance/features';

    protected static ?string $navigationIcon = 'heroicon-o-bolt';

    protected static ?string $recordTitleAttribute = 'title';

    protected static ?string $navigationGroup = 'Appearance';

    protected static ?string $navigationLabel = 'Features';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Forms\Components\Group::make()->schema([

                    Forms\Components\Section::make()->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('Title')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\RichEditor::make('description')
                            ->label('Description')
                            ->maxLength(5000),

                        ]),

                ])->columnSpan(2),

                Forms\Components\Group::make()->schema([

                    Forms\Components\Section::make('Status')->schema([
                        Forms\Components\Toggle::make('is_published')
                        ->label('Published')
                        ->helperText('This product will be hidden from all sales channels.')
                        ->default(true),
                    ])->collapsible(),

                ])->columnSpan(1),

            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Title')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),

                Tables\Columns\ToggleColumn::make('is_published')
                    ->label('Toggle Published')
                    ->toggleable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListFeatures::route('/'),
            // 'create' => Pages\CreateFeature::route('/create'),
            // 'view' => Pages\ViewFeature::route('/{record}'),
            // 'edit' => Pages\EditFeature::route('/{record}/edit'),
        ];
    }
}
