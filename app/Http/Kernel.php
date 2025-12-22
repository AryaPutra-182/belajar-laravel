<?php

class Kernel
{
    protected $routerMiddleware = [
        'IsAdmin' => \App\Http\Middleware\IsAdmin::class,
    ];
}