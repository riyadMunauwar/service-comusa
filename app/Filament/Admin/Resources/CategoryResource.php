<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\CategoryResource\Pages;
use App\Filament\Admin\Resources\CategoryResource\RelationManagers;
use App\Models\Category;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Filters\Filter;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Enums\FiltersLayout;
use Illuminate\Support\Str;


class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static ?string $slug = 'services/categories';

    protected static ?string $navigationIcon = 'heroicon-o-tag';

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $navigationGroup = 'Service';

    protected static ?string $navigationLabel = 'Categories';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()->schema([
                    Forms\Components\Section::make()->schema([
                        Forms\Components\TextInput::make('name')
                        ->required()
                        ->maxLength(255)
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn (string $operation, $state, Forms\Set $set) => $operation === 'create' ? $set('slug', Str::slug($state)) : null),

                    Forms\Components\TextInput::make('slug')
                        ->disabled()
                        ->dehydrated()
                        ->required()
                        ->maxLength(255)
                        ->unique(Category::class, 'slug', ignoreRecord: true),

                    Forms\Components\RichEditor::make('description')
                        ->label('Description')
                        ->maxLength(5000),

                    ]),


                    Forms\Components\Section::make('Meta')->schema([
                        Forms\Components\TextInput::make('meta_title')
                        ->label('Meta Title')
                        ->helperText('Seo title')
                        ->maxLength(255),

                        Forms\Components\TextInput::make('meta_tags')
                            ->label('Meta Tags')
                            ->helperText('Seo tags')
                            ->maxLength(255)
                            ->placeholder('meta tags'),

                        Forms\Components\Textarea::make('meta_description')
                            ->label('Meta Descriptin')
                            ->helperText('Seo description')
                            ->maxLength(255),
                    ])->collapsible(),
                ])->columnSpan(2),

                Forms\Components\Group::make()->schema([

                    Forms\Components\Section::make('Status')->schema([
                        Forms\Components\Toggle::make('is_published')
                        ->label('Published')
                        ->helperText('This product will be hidden from all sales channels.')
                        ->default(true),

                        Forms\Components\Checkbox::make('is_featured')
                        ->label('Featured Category')
                        ->default(false),

                    ])->collapsible(),


                    Forms\Components\Section::make('Sorting')->schema([
                        Forms\Components\TextInput::make('sort_order')
                            ->label('Sort Order')
                            ->helperText('Show according to this order on views')
                            ->numeric()
                            ->maxValue(9999999)
                            ->minValue(-9999999),

                    ])->collapsible(),

                    Forms\Components\Section::make('Associations')->schema([
                        Forms\Components\Select::make('parent_id')
                        ->relationship('parent', 'name')
                        ->searchable()
                        ->placeholder('Select parent category'),

                    ])->collapsible(),

                    Forms\Components\Section::make('Image/Icon')->schema([
                        SpatieMediaLibraryFileUpload::make('media')
                        ->collection('icon')
                        ->disableLabel(),

                    ])->collapsible(),
                ])->columnSpan(1),
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\SpatieMediaLibraryImageColumn::make('thumbnail')
                    ->label('Thumbnail')
                    ->collection('icon')
                    ->circular(),

                Tables\Columns\TextColumn::make('name')
                    ->label('Name')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('slug')
                    ->label('Slug')
                    ->sortable(),

                Tables\Columns\TextColumn::make('parent.name')
                    ->label('Parent Category')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('sort_order')
                    ->label('Sort Order')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\CheckboxColumn::make('is_published')
                    ->label('Published')
                    ->sortable()
                    ->toggleable(),

                Tables\Columns\CheckboxColumn::make('is_featured')
                    ->label('Featured')
                    ->sortable()
                    ->toggleable(),

            ])
            ->filters([
                Filter::make('created_at')
                    ->form([
                        DatePicker::make('created_from'),
                        DatePicker::make('created_until'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['created_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    })
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ]),
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
            'index' => Pages\ListCategories::route('/'),
            // 'create' => Pages\CreateCategory::route('/create'),
            // 'view' => Pages\ViewCategory::route('/{record}'),
            // 'edit' => Pages\EditCategory::route('/{record}/edit'),
        ];
    }
}
