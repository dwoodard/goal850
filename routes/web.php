<?php

use Illuminate\Support\Facades\Route;

Route::statamic('search', 'search');

// create a template design route
Route::statamic('design', 'template-design');

// statamic arguments take the following parameters
// 1. The URI to match
// 2. The Statamic template to render
