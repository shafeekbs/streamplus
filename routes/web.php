<?php

use Illuminate\Support\Facades\Route;



Route::get('/', App\Livewire\OnboardingForm::class)->name('onboarding.form');

Route::get('/success', function(){
    return view('success');
})->name('onboarding.success');
