<?php

namespace TitaniumFoundation\Core\Procedures;

class View
{
    public static function render(string $template)
    {
        echo file_get_contents($template);
    }
}

