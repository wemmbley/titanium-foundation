<?php

namespace TitaniumFoundation\Source\Core;

class Registry
{
    public array $procedures = [
        Router::class,
        Validator::class,
        HttpFoundation::class,
        View::class,
        Cacher::class,
    ];
}