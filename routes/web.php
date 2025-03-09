<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\WorkOS\Http\Middleware\ValidateSessionWithWorkOS;

Route::get('/', function () {
    Log::info('home');
    return Inertia::render('welcome');
})->name('home');

Route::middleware([
    'auth',
    ValidateSessionWithWorkOS::class,
])->group(function () {
    Route::get('dashboard', function () {
        return Inertia::render('dashboard');
    })->name('dashboard');
});

Route::get('/test', function() {
    // Create test table
    Schema::create('new_test_table_new', function ($table) {
        $table->id();
        $table->string('name');
        $table->timestamps();
    });

    // Generate some queries
    DB::table('new_test_table_new')->insert(['name' => 'Test 1']);
    DB::table('new_test_table_new')->insert(['name' => 'Test 2']);
    DB::table('new_test_table_new')->get();
    
    return "Generated test queries!";
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
