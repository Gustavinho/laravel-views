<?php

namespace LaravelViews\Macros;

use Illuminate\Support\Str;

class StrMacros
{
    public function register()
    {
        Str::macro('classNameAsSentence', function ($className) {
            $intermediate = preg_replace('/(?!^)([[:upper:]][[:lower:]]+)/', ' $0', $className);
            $titleStr = preg_replace('/(?!^)([[:lower:]])([[:upper:]])/', '$1 $2', $intermediate);

            return $titleStr;
        });

        Str::macro('camelToDash', function ($str) {
            return strtolower(preg_replace('%([a-z])([A-Z])%', '\1-\2', $str));
        });
    }
}