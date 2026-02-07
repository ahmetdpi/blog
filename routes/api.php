<?php

use App\Api\ApiTool\ApiToolController;
use Illuminate\Support\Facades\Route;

Route::post('git-pull', [ApiToolController::class, 'gitPull']);
