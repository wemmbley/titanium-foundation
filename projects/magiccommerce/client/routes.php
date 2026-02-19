<?php

use App\Projects\MagicCommerce\Client\Controller\HomeController;
use TitaniumFoundation\Core\Procedures\Route;

Route::get('/', [HomeController::class, 'index']);