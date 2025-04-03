<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PowerBiVisualizationResource\Pages;
use App\Models\PowerBiVisualization;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Contracts\View\View;
use Filament\Support\Enums\MaxWidth;

class PowerBiVisualizationResource extends Resource
{
    protected static ?string $model = PowerBiVisualization::class;

    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';
    
    protected static ?string $navigationLabel = 'Tableros';
    
    protected static ?string $modelLabel = 'Tablero';
    
    protected static ?string $pluralModelLabel = 'Tableros';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->label('Título')
                    ->required()
                    ->maxLength(255)
                    ->placeholder('Ingrese el título de la visualización')
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
                    ->helperText('Esta descripción ayudará a identificar el propósito de la visualización'),
                Forms\Components\Toggle::make('is_active')
                    ->label('Activo')
                    ->required()
                    ->helperText('Determine si la visualización está disponible para los usuarios'),
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
                    ->size('lg')
                    ->weight('bold')
                    ->color('primary')
                    ->icon('heroicon-o-presentation-chart-bar')
                    ->description(fn (PowerBiVisualization $record): string => $record->description ?? 'Sin descripción'),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Estado')
                    ->boolean()
                    ->size('lg')
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger')
                    ->alignCenter(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Fecha de Creación')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->icon('heroicon-o-calendar')
                    ->alignEnd(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Última Actualización')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->icon('heroicon-o-clock')
                    ->alignEnd()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->actions([
                Tables\Actions\Action::make('view')
                    ->label('Ver')
                    ->icon('heroicon-o-eye')
                    ->color('primary')
                    ->tooltip('Ver visualización')
                    ->modalHeading(fn (PowerBiVisualization $record): string => "Visualización: {$record->title}")
                    ->modalContent(fn (PowerBiVisualization $record): View => view(
                        'filament.resources.power-bi-visualization.modal-content',
                        ['record' => $record]
                    ))
                    ->modalSubmitAction(false)
                    ->modalCancelActionLabel('Cerrar')
                    ->modalWidth('7xl')
                    ->extraAttributes([
                        'class' => '!max-w-full !h-[90vh]'
                    ])
            ])
            ->defaultSort('created_at', 'desc')
            ->striped()
            ->poll('10s')
            ->modifyQueryUsing(fn (Builder $query) => $query->active());
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
            'index' => Pages\ListPowerBiVisualizations::route('/'),
        ];
    }
}
