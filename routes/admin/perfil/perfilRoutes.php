<?php
use App\Http\Controllers\Perfil\PerfilController;

Route::post('update-dashboard', [PerfilController::class, 'updateDashboard'])->name('perdil.updateDashboard');