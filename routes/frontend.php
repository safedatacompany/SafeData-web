<?php

use Illuminate\Support\Facades\Route;

// Redirect legacy homepage path to canonical URL.
Route::redirect('/safe', '/', 301);
