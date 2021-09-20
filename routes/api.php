<?php

use App\Http\Controllers\ProcessMonitorController;


Route::any('processes/{id}/monitor', [ProcessMonitorController::class, 'index'])->name('processes.monitor.index');
