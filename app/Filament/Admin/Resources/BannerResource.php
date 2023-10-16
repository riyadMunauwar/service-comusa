<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\BannerResource\Pages;
use App\Filament\Admin\Resources\BannerResource\RelationManagers;
use App\Models\Banner;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;

class BannerResource extends Resource
{
    protected static ?string $model = Banner::class;

    protected static ?string $slug = 'appearance/banner';

    protected static ?string $navigationIcon = 'heroicon-o-photo';

    protected static ?string $recordTitleAttribute = 'title';

    protected static ?string $navigationGroup = 'Appearance';

    protected static ?string $navigationLabel = 'Banner';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->label('Title')
                    ->required()
                    ->maxLength(2048),

                Forms\Components\TextInput::make('sub_title_1')
                    ->label('Sub Title 1')
                    ->required()
                    ->maxLength(2048),

                Forms\Components\TextInput::make('sub_title_2')
                    ->label('Sub Title 2')
                    ->required()
                    ->maxLength(2048),

                SpatieMediaLibraryFileUpload::make('media')
                    ->collection('banner')
                    ->label('Banner Image')
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\SpatieMediaLibraryImageColumn::make('banner')
                ->label('Banner')
                ->collection('banner'),


            Tables\Columns\TextColumn::make('title')
                ->label('Title')
                ->searchable()
                ->sortable()
                ->toggleable(),

            Tables\Columns\TextColumn::make('sub_title_1')
                ->label('Sub Title 1')
                ->searchable()
                ->sortable()
                ->toggleable(),

            Tables\Columns\TextColumn::make('sub_title_1')
                ->label('Sub Title 2')
                ->searchable()
                ->sortable()
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
            'index' => Pages\ListBanners::route('/'),
            // 'create' => Pages\CreateBanner::route('/create'),
            // 'edit' => Pages\EditBanner::route('/{record}/edit'),
        ];
    }
}
