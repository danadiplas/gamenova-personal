<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StockTiendaResource\Pages;
use App\Models\StockTienda;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class StockTiendaResource extends Resource
{
    protected static ?string $model = StockTienda::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-storefront';
    protected static ?string $navigationLabel = 'Stock por Tienda';
    protected static ?string $modelLabel = 'Stock Tienda';
    protected static ?string $pluralModelLabel = 'Stock por Tienda';
    protected static ?string $navigationGroup = 'Inventario';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('tienda_id')
                    ->relationship('tienda', 'nombre')
                    ->label('Tienda')
                    ->required()
                    ->searchable()
                    ->preload(),
                Forms\Components\Select::make('producto_id')
                    ->relationship('producto', 'nombre')
                    ->label('Producto')
                    ->required()
                    ->searchable()
                    ->preload(),
                Forms\Components\TextInput::make('cantidad')
                    ->label('Cantidad')
                    ->required()
                    ->numeric()
                    ->minValue(0)
                    ->default(0),
                Forms\Components\TextInput::make('cantidad_minima')
                    ->label('Stock Mínimo')
                    ->required()
                    ->numeric()
                    ->minValue(0)
                    ->default(5),
                Forms\Components\TextInput::make('ubicacion')
                    ->label('Ubicación')
                    ->maxLength(100)
                    ->placeholder('Ej: Estantería A, Pasillo 3'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('tienda.nombre')
                    ->label('Tienda')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('producto.nombre')
                    ->label('Producto')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('producto.plataforma')
                    ->label('Plataforma')
                    ->badge()
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('cantidad')
                    ->label('Stock')
                    ->numeric()
                    ->sortable()
                    ->color(function ($record) {
                        if ($record->cantidad <= $record->cantidad_minima) {
                            return 'danger';
                        } elseif ($record->cantidad <= ($record->cantidad_minima * 2)) {
                            return 'warning';
                        }
                        return 'success';
                    }),
                Tables\Columns\TextColumn::make('cantidad_minima')
                    ->label('Mínimo')
                    ->numeric()
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('ubicacion')
                    ->label('Ubicación')
                    ->searchable()
                    ->toggleable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('tienda')
                    ->relationship('tienda', 'nombre')
                    ->searchable()
                    ->preload(),
                Tables\Filters\SelectFilter::make('producto')
                    ->relationship('producto', 'nombre')
                    ->searchable()
                    ->preload(),
                Tables\Filters\Filter::make('stock_bajo')
                    ->label('Stock Bajo')
                    ->query(fn($query) => $query->whereColumn('cantidad', '<=', 'cantidad_minima')),
            ])
            ->actions([
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
            'index' => Pages\ManageStockTiendas::route('/'),
        ];
    }
}
