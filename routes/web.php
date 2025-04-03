<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/admin');
});

Route::get('/powerbi-proxy/{id}', function ($id) {
    $record = App\Models\PowerBiDashboard::findOrFail($id);
    // Verificar permisos aquí si es necesario
    return view('proxy-iframe', ['url' => $record->embed_url]);
})->middleware(['auth'])->name('powerbi.proxy');

Route::get('/powerbi-viz-proxy/{id}', function ($id) {
    $record = App\Models\PowerBiVisualization::findOrFail($id);
    // Verificar permisos aquí si es necesario
    return view('proxy-iframe', ['url' => $record->embed_url]);
})->middleware(['auth'])->name('powerbi.viz.proxy');

