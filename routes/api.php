<?php

use App\Http\Controllers\MonitorOABController;
use App\Http\Controllers\MonitorProgressController;


Route::any('processes/{id}/monitor', [MonitorProgressController::class, 'index'])->name('processes.monitor.index');
Route::any('processes/oab/{oab}/uf/{uf}/monitor', [MonitorOABController::class, 'index'])->name('oab.monitor.index');
