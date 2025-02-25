<?php

use Illuminate\Support\Facades\Route;
use Laravel\WorkOS\Http\Requests\AuthKitAuthenticationRequest;
use Laravel\WorkOS\Http\Requests\AuthKitLoginRequest;
use Laravel\WorkOS\Http\Requests\AuthKitLogoutRequest;

Route::get('login', function (AuthKitLoginRequest $request) {
    return $request->redirect();
})->middleware(['guest'])->name('login');

Route::get('authenticate', function (AuthKitAuthenticationRequest $request) {
    try {
        $request->authenticate(); // Perform the authentication
        return to_route('dashboard'); // Redirect to the dashboard
    } catch (\Exception $e) {
        // Handle authentication failure (e.g., log the error, redirect back with an error message)
        return redirect()->route('login')->withErrors(['auth' => 'Authentication failed.']);
    }
})->middleware(['guest'])->name('authenticate');

Route::post('logout', function (AuthKitLogoutRequest $request) {
    $request->logout(); // Perform the logout
    return to_route('login'); // Then redirect to the login page
})->middleware(['auth'])->name('logout');
