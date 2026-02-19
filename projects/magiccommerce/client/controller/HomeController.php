<?php

namespace App\Projects\MagicCommerce\Client\Controller;

use TitaniumFoundation\Core\Helpers\Path;
use TitaniumFoundation\Core\Procedures\View;

class HomeController
{
    public function index()
    {
        View::render(
            Path::root('projects/magiccommerce/client/view/template/index.html'),
            ['name' => 'Rustam'],
        );
    }
}