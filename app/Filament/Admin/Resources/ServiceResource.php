<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\ServiceResource\Pages;
use App\Filament\Admin\Resources\ServiceResource\RelationManagers;
use App\Models\Service;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Illuminate\Support\Str;

class ServiceResource extends Resource
{
    protected static ?string $model = Service::class;

    protected static ?string $slug = 'services/services';

    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $navigationGroup = 'Service';

    protected static ?string $navigationLabel = 'Services';

    protected static ?int $navigationSort = 2;

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
                        ->unique(Service::class, 'slug', ignoreRecord: true),


                    Forms\Components\Group::make()->schema([
                        Forms\Components\TextInput::make('price')
                            ->numeric(),
                        Forms\Components\TextInput::make('youtube_video_id'),
                        Forms\Components\Select::make('is_bulk_order_allowed')
                            ->options([
                                'yes' => 'Yes',
                                'no' => 'No'
                            ]),
                        Forms\Components\TextInput::make('order_type'),
                        Forms\Components\TextInput::make('service_type'),
                        Forms\Components\Select::make('is_submit_to_verified_allowed')
                            ->options([
                                'yes' => 'Yes',
                                'no' => 'No'
                            ]),
                        Forms\Components\Select::make('is_cancelation_allowed')
                            ->options([
                                'yes' => 'Yes',
                                'no' => 'No'
                            ]),
                        Forms\Components\TextInput::make('delivery_time'),
                    ])->columns(2),

                    ]),

                    Forms\Components\Section::make('Custom Attribute')->schema([
                        Forms\Components\Repeater::make('attributes')
                            ->relationship()
                            ->schema([
                                Forms\Components\TextInput::make('name')
                                    ->label('Attribute Name'),
                                Forms\Components\TextInput::make('value')
                                    ->label('Value'),
                            ])->columns(2),

                    ])->collapsible(),

                    Forms\Components\Section::make('Description')->schema([
                        Forms\Components\RichEditor::make('description')
                            ->label('Description')
                            ->maxLength(5000),


                    ])->collapsible(),

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
                        ->label('Featured Service')
                        ->default(false),

                    ])->collapsible(),


                    Forms\Components\Section::make('Associations')->schema([
                        Forms\Components\Select::make('categories')
                        ->relationship('categories', 'name')
                        ->multiple()
                        ->searchable()
                        ->placeholder('Select Category'),

                    ])->collapsible(),

                    Forms\Components\Section::make('Thumbnail')->schema([
                        SpatieMediaLibraryFileUpload::make('media')
                        ->collection('thumbnail')
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
                ->collection('thumbnail'),


            Tables\Columns\TextColumn::make('name')
                ->label('Name')
                ->searchable()
                ->sortable()
                ->toggleable(),

            Tables\Columns\TextColumn::make('slug')
                ->label('Slug')
                ->searchable()
                ->sortable()
                ->toggleable(),

            Tables\Columns\TextColumn::make('price')
                ->label('Price')
                ->badge()
                ->prefix('$ ')
                ->color('success')
                ->searchable()
                ->sortable()
                ->toggleable(),

            // Tables\Columns\TextColumn::make('sort_order')
            //     ->label('Sort Order')
            //     ->searchable()
            //     ->sortable(),

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
                //
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
            'index' => Pages\ListServices::route('/'),
            'create' => Pages\CreateService::route('/create'),
            'edit' => Pages\EditService::route('/{record}/edit'),
        ];
    }
}
