<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\CustomerResource\Pages;
use App\Filament\Admin\Resources\CustomerResource\RelationManagers;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CustomerResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $modelLabel = 'Customers';

    protected static ?string $slug = 'services/customers';

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $navigationGroup = 'Service';

    protected static ?string $navigationLabel = 'Customers';

    protected static ?int $navigationSort = 3;


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()->schema([
                    Forms\Components\TextInput::make('name')
                        ->label('Name')
                        ->required()
                        ->maxLength(255),

                    Forms\Components\TextInput::make('email')
                        ->label('Email')
                        ->required()
                        ->email()
                        ->unique()
                        ->maxLength(255),

                    Forms\Components\TextInput::make('password')
                        ->label('Password')
                        ->required()
                        ->password()
                        ->confirmed()
                        ->maxLength(255),

                    Forms\Components\TextInput::make('password_confirmation')
                        ->label('Confirm')
                        ->required()
                        ->password()
                        ->maxLength(255),

                    Forms\Components\Checkbox::make('is_admin')
                        ->label('Admin'),
                ])->columnSpan(1),
            ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('profile_photo_url')
                ->label('Avatar')
                ->circular(),

                Tables\Columns\TextColumn::make('name')
                    ->label('Name')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('credit_balance')
                    ->badge()
                    ->color(function($state) {
                        return $state <= 10 ? 'danger' : 'success';
                    })
                    ->label('Credit Balance')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),

                Tables\Columns\CheckboxColumn::make('is_admin')
                    ->label('Admin')
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
            'index' => Pages\ListCustomers::route('/'),
            'create' => Pages\CreateCustomer::route('/create'),
            // 'view' => Pages\ViewCustomer::route('/{record}'),
            'edit' => Pages\EditCustomer::route('/{record}/edit'),
        ];
    }
}
