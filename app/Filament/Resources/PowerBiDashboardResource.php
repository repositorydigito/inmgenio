<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PowerBiDashboardResource\Pages;
use App\Filament\Resources\PowerBiDashboardResource\RelationManagers;
use App\Models\PowerBiDashboard;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Contracts\View\View;

class PowerBiDashboardResource extends Resource
{
    protected static ?string $model = PowerBiDashboard::class;

    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';
    
    protected static ?string $navigationLabel = 'Admin BI';
    
    protected static ?string $modelLabel = 'Admin BI';
    
    protected static ?string $pluralModelLabel = 'Admin BI';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->label('Título')
                    ->required()
                    ->maxLength(255)
                    ->placeholder('Ingrese el título del tablero')
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('embed_url')
                    ->label('URL de Incrustación')
                    ->required()
                    ->columnSpanFull()
                    ->placeholder('Ingrese la URL de incrustación de Power BI')
                    ->helperText('Pegue aquí la URL de incrustación proporcionada por Power BI'),
                Forms\Components\Textarea::make('description')
                    ->label('Descripción')
                    ->columnSpanFull()
                    ->placeholder('Ingrese una descripción opcional')
                    ->helperText('Esta descripción ayudará a identificar el propósito del tablero'),
                Forms\Components\Toggle::make('is_active')
                    ->label('Activo')
                    ->required()
                    ->helperText('Determine si el tablero está disponible para los usuarios'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Título')
                    ->searchable()
                    ->sortable()
                    ->icon('heroicon-o-document-text')
                    ->description(fn (PowerBiDashboard $record): string => $record->description ?? 'Sin descripción'),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Estado')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Fecha de Creación')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Última Actualización')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Estado')
                    ->placeholder('Todos')
                    ->trueLabel('Activos')
                    ->falseLabel('Inactivos'),
            ])
            ->actions([
                Tables\Actions\Action::make('view')
                    ->label('Ver')
                    ->icon('heroicon-o-eye')
                    ->modalContent(fn (PowerBiDashboard $record): View => view(
                        'filament.resources.power-bi-dashboard.modal-content',
                        ['record' => $record]
                    ))
                    ->modalSubmitAction(false)
                    ->modalCancelActionLabel('Cerrar')
                    ->modalWidth('7xl')
                    ->extraAttributes([
                        'class' => '!max-w-full !h-[90vh]'
                    ]),
                Tables\Actions\EditAction::make()
                    ->label('Editar')
                    ->icon('heroicon-o-pencil-square'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->label('Eliminar Seleccionados')
                        ->icon('heroicon-o-trash')
                        ->requiresConfirmation()
                        ->modalHeading('¿Eliminar tableros seleccionados?')
                        ->modalDescription('Esta acción no se puede deshacer.')
                        ->modalSubmitActionLabel('Sí, eliminar')
                        ->modalCancelActionLabel('Cancelar'),
                ]),
            ])
            ->defaultSort('created_at', 'desc')
            ->striped()
            ->poll('10s');
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
            'index' => Pages\ListPowerBiDashboards::route('/'),
            'create' => Pages\CreatePowerBiDashboard::route('/create'),
            'edit' => Pages\EditPowerBiDashboard::route('/{record}/edit'),
        ];
    }
}
