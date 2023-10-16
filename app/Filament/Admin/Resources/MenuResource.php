<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\MenuResource\Pages;
use App\Filament\Admin\Resources\MenuResource\RelationManagers;
use App\Models\Menu;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MenuResource extends Resource
{
    protected static ?string $model = Menu::class;

    protected static ?string $slug = 'appearance/menus';

    protected static ?string $navigationIcon = 'heroicon-o-bars-4';

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $navigationGroup = 'Appearance';

    protected static ?string $navigationLabel = 'Menu';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()->schema([



                    Forms\Components\Section::make()->schema([

                        Forms\Components\Select::make('type')
                            ->label('Type')
                            ->options([
                                'collection' => 'Collection',
                                'item' => 'Item',
                            ])
                            ->default('item')
                            ->required(),

                        Forms\Components\Select::make('collection_id')
                            ->relationship('collection', 'name')
                            ->placeholder('Select a menu collection'),

                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\TextInput::make('link')
                            ->label('Menu Link')
                            ->maxLength(2048),

                        Forms\Components\Select::make('category_id')
                            ->label('Or Bind with category')
                            ->relationship('category', 'name')
                            ->searchable(),

                    ]),

                ])->columnSpan(2),

                Forms\Components\Group::make()->schema([

                    Forms\Components\Section::make('Status')->schema([
                        Forms\Components\Toggle::make('is_published')
                            ->label('Published')
                            ->helperText('Only published item will show in public')
                            ->default(true),

                    ])->collapsible(),




                    Forms\Components\Section::make('Associations')->schema([
                        Forms\Components\Select::make('parent_id')
                            ->relationship('parent', 'name')
                            ->searchable()
                            ->placeholder('Select parent Menu'),

                    ])->collapsible(),


                    Forms\Components\Section::make('Sorting')->schema([
                        Forms\Components\TextInput::make('sort_order')
                            ->label('Sort Order')
                            ->helperText('Show according to this order on views')
                            ->numeric()
                            ->maxValue(9999999)
                            ->minValue(-9999999),

                    ])->collapsible(),


                ])->columnSpan(1),
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Name')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\BadgeColumn::make('type')
                    ->label('Type')
                    ->color('success')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\BadgeColumn::make('collection.name')
                    ->label('Collection')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\BadgeColumn::make('parent.name')
                    ->label('Parent Menu')
                    ->color('warning')
                    ->searchable()
                    ->sortable(),


                Tables\Columns\BadgeColumn::make('sort_order')
                    ->label('Sort Order')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\CheckboxColumn::make('is_published')
                    ->label('Published')
                    ->sortable()
                    ->toggleable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListMenus::route('/'),
            // 'create' => Pages\CreateMenu::route('/create'),
            // 'view' => Pages\ViewMenu::route('/{record}'),
            // 'edit' => Pages\EditMenu::route('/{record}/edit'),
        ];
    }
}
