<?php
/**
 * PhpStorm Meta file, to provide autocomplete information for PhpStorm
 * Generated file - DO NOT EDIT!
 */

namespace PHPSTORM_META {
    override(
        \auth(0),
        map([
            '' => \Illuminate\Contracts\Auth\Guard::class,
            'default' => \Illuminate\Contracts\Auth\Guard::class,
        ])
    );
    
    override(
        \auth()->check(),
        type(0, 'bool')
    );
    
    override(
        \auth()->user(),
        type(0, \App\Models\User::class)
    );
    
    override(
        \auth()->user(0),
        type(0, \App\Models\User::class)
    );
}


















