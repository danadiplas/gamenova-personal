<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductoResource\Pages;
use App\Models\Producto;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class ProductoResource extends Resource
{
    protected static ?string $model = Producto::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';
    protected static ?string $navigationLabel = 'Productos';
    protected static ?string $modelLabel = 'Producto';
    protected static ?string $pluralModelLabel = 'Productos';
    protected static ?string $navigationGroup = 'Inventario';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Información Básica')
                    ->schema([
                        Forms\Components\TextInput::make('nombre')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn(string $state, Forms\Set $set) =>
                            $set('slug', Str::slug($state))),
                        Forms\Components\TextInput::make('slug')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true),
                        Forms\Components\Textarea::make('descripcion_corta')
                            ->label('Descripción Corta')
                            ->maxLength(500)
                            ->rows(2),
                        Forms\Components\Textarea::make('descripcion')
                            ->label('Descripción Completa')
                            ->columnSpanFull()
                            ->rows(4),
                    ])->columns(2),

                Forms\Components\Section::make('Precios y Stock')
                    ->schema([
                        Forms\Components\TextInput::make('precio')
                            ->required()
                            ->numeric()
                            ->prefix('€')
                            ->step(0.01),
                        Forms\Components\TextInput::make('precio_rebajado')
                            ->label('Precio Rebajado')
                            ->numeric()
                            ->prefix('€')
                            ->step(0.01),
                        Forms\Components\TextInput::make('stock_online')
                            ->label('Stock Online')
                            ->required()
                            ->numeric()
                            ->default(0)
                            ->minValue(0),
                    ])->columns(3),

                Forms\Components\Section::make('Categorías y Proveedores')
                    ->schema([
                        Forms\Components\Select::make('categoria_id')
                            ->label('Categoría')
                            ->relationship('categoria', 'nombre')
                            ->required()
                            ->searchable()
                            ->preload(),
                        Forms\Components\Select::make('proveedor_id')
                            ->label('Proveedor')
                            ->relationship('proveedor', 'nombre_empresa')
                            ->searchable()
                            ->preload(),
                    ])->columns(2),

                Forms\Components\Section::make('Detalles Técnicos')
                    ->schema([
                        Forms\Components\Select::make('plataforma')
                            ->options([
                                'PS5' => 'PlayStation 5',
                                'PS4' => 'PlayStation 4',
                                'XBOX Series X|S' => 'XBOX Series X|S',
                                'XBOX One' => 'XBOX One',
                                'Nintendo Switch' => 'Nintendo Switch',
                                'PC' => 'PC',
                                'Multiplataforma' => 'Multiplataforma',
                            ])
                            ->required(),
                        Forms\Components\TextInput::make('desarrolladora')
                            ->maxLength(150),
                        Forms\Components\TextInput::make('publisher')
                            ->label('Editor')
                            ->maxLength(150),
                        Forms\Components\DatePicker::make('fecha_lanzamiento')
                            ->label('Fecha de Lanzamiento'),
                        Forms\Components\Select::make('pegi')
                            ->options([
                                '3' => 'PEGI 3',
                                '7' => 'PEGI 7',
                                '12' => 'PEGI 12',
                                '16' => 'PEGI 16',
                                '18' => 'PEGI 18',
                            ]),
                        Forms\Components\TextInput::make('imagen_principal')
                            ->label('Imagen princiapl')
                            ->maxLength(150),
                    ])->columns(3),

                Forms\Components\Section::make('Configuración')
                    ->schema([
                        Forms\Components\Toggle::make('destacado')
                            ->label('Destacado')
                            ->default(false),
                        Forms\Components\Toggle::make('activo')
                            ->label('Activo')
                            ->default(true),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nombre')
                    ->searchable()
                    ->sortable()
                    ->limit(30),
                Tables\Columns\TextColumn::make('categoria.nombre')
                    ->label('Categoría')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('proveedor.nombre_empresa')
                    ->label('Proveedor')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('plataforma')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'PS5' => 'danger',
                        'XBOX Series X|S' => 'success',
                        'Nintendo Switch' => 'primary',
                        'PC' => 'info',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('precio')
                    ->money('EUR')
                    ->sortable(),
                Tables\Columns\TextColumn::make('precio_rebajado')
                    ->label('Precio Rebajado')
                    ->money('EUR')
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('stock_online')
                    ->label('Stock')
                    ->numeric()
                    ->sortable()
                    ->color(fn($record): string =>
                    $record->stock_online < 10 ? 'danger' : 'success'),
                Tables\Columns\IconColumn::make('destacado')
                    ->boolean()
                    ->toggleable(),
                Tables\Columns\IconColumn::make('activo')
                    ->boolean()
                    ->toggleable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('categoria')
                    ->relationship('categoria', 'nombre')
                    ->searchable()
                    ->preload(),
                Tables\Filters\SelectFilter::make('proveedor')
                    ->relationship('proveedor', 'nombre_empresa')
                    ->searchable()
                    ->preload(),
                Tables\Filters\SelectFilter::make('plataforma')
                    ->options([
                        'PS5' => 'PS5',
                        'PS4' => 'PS4',
                        'XBOX Series X|S' => 'XBOX Series X|S',
                        'Nintendo Switch' => 'Nintendo Switch',
                        'PC' => 'PC',
                        'Multiplataforma' => 'Multiplataforma',
                    ]),
                Tables\Filters\TernaryFilter::make('destacado')
                    ->label('Destacado'),
                Tables\Filters\TernaryFilter::make('activo')
                    ->label('Activo'),
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
            'index' => Pages\ListProductos::route('/'),
            'create' => Pages\CreateProducto::route('/create'),
            'edit' => Pages\EditProducto::route('/{record}/edit'),
        ];
    }
}
