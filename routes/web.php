<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/trigger-job', function () {
    $exitCode = Artisan::call('schedule:run');
    return response()->json(['message' => 'Scheduler run successfully', 'exitCode' => $exitCode]);
});

Route::get('/logs', function () {
	
	 $logFile = storage_path('logs/laravel.log');

    if (File::exists($logFile)) {
        $contents = File::get($logFile);
        return response()->json(['content' => $contents]);
    } else {
        return response()->json(['error' => 'A laravel.log fájl nem létezik.'], 404);
    }
});