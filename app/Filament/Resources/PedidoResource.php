<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PedidoResource\Pages;
use App\Models\Pedido;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PedidoResource extends Resource
{
    protected static ?string $model = Pedido::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';
    protected static ?string $navigationLabel = 'Pedidos';
    protected static ?string $modelLabel = 'Pedido';
    protected static ?string $pluralModelLabel = 'Pedidos';
    protected static ?string $navigationGroup = 'Ventas';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->label('Cliente')
                    ->required()
                    ->searchable()
                    ->preload(),
                Forms\Components\TextInput::make('numero_pedido')
                    ->label('Número de Pedido')
                    ->required()
                    ->maxLength(50)
                    ->default('PED-' . strtoupper(uniqid())),
                Forms\Components\Select::make('estado')
                    ->options([
                        'pendiente' => 'Pendiente',
                        'confirmado' => 'Confirmado',
                        'procesando' => 'Procesando',
                        'enviado' => 'Enviado',
                        'entregado' => 'Entregado',
                        'cancelado' => 'Cancelado',
                    ])
                    ->required()
                    ->default('pendiente'),
                Forms\Components\Select::make('metodo_pago')
                    ->label('Método de Pago')
                    ->options([
                        'tarjeta' => 'Tarjeta',
                        'paypal' => 'PayPal',
                        'transferencia' => 'Transferencia',
                        'contra_reembolso' => 'Contra Reembolso',
                    ])
                    ->nullable(),
                Forms\Components\Select::make('direccion_envio_id')
                    ->relationship('direccionEnvio', 'direccion')
                    ->label('Dirección de Envío')
                    ->required()
                    ->searchable(),
                Forms\Components\Select::make('direccion_facturacion_id')
                    ->relationship('direccionFacturacion', 'direccion')
                    ->label('Dirección de Facturación')
                    ->required()
                    ->searchable(),
                Forms\Components\TextInput::make('subtotal')
                    ->required()
                    ->numeric()
                    ->prefix('€'),
                Forms\Components\TextInput::make('envio')
                    ->label('Gastos de Envío')
                    ->required()
                    ->numeric()
                    ->prefix('€')
                    ->default(0),
                Forms\Components\TextInput::make('iva')
                    ->label('IVA')
                    ->required()
                    ->numeric()
                    ->prefix('€'),
                Forms\Components\TextInput::make('total')
                    ->required()
                    ->numeric()
                    ->prefix('€'),
                Forms\Components\Textarea::make('notas')
                    ->label('Notas')
                    ->columnSpanFull(),
                Forms\Components\DateTimePicker::make('fecha_pedido')
                    ->label('Fecha Pedido')
                    ->required()
                    ->default(now()),
                Forms\Components\DateTimePicker::make('fecha_envio')
                    ->label('Fecha Envío'),
                Forms\Components\DateTimePicker::make('fecha_entrega')
                    ->label('Fecha Entrega'),
                Forms\Components\TextInput::make('tracking_number')
                    ->label('Número de Seguimiento')
                    ->maxLength(100),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('numero_pedido')
                    ->label('Número')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Cliente')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('estado')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'pendiente' => 'warning',
                        'confirmado' => 'info',
                        'procesando' => 'primary',
                        'enviado' => 'success',
                        'entregado' => 'success',
                        'cancelado' => 'danger',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('total')
                    ->money('EUR')
                    ->sortable(),
                Tables\Columns\TextColumn::make('metodo_pago')
                    ->label('Pago')
                    ->badge()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('fecha_pedido')
                    ->label('Fecha')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('estado')
                    ->options([
                        'pendiente' => 'Pendiente',
                        'confirmado' => 'Confirmado',
                        'procesando' => 'Procesando',
                        'enviado' => 'Enviado',
                        'entregado' => 'Entregado',
                        'cancelado' => 'Cancelado',
                    ]),
                Tables\Filters\SelectFilter::make('metodo_pago')
                    ->options([
                        'tarjeta' => 'Tarjeta',
                        'paypal' => 'PayPal',
                        'transferencia' => 'Transferencia',
                        'contra_reembolso' => 'Contra Reembolso',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ManagePedidos::route('/'),
        ];
    }
}
