<?php

use Carbon\Carbon;

if (! function_exists('appName')) {
    /**
     * Helper to grab the application name.
     *
     * @return mixed
     */
    function appName()
    {
        return config('app.name', 'Jetport');
    }
}

if (! function_exists('carbon')) {
    /**
     * Create a new Carbon instance from a time.
     *
     * @param $time
     *
     * @return Carbon
     * @throws Exception
     */
    function carbon($time)
    {
        return new Carbon($time);
    }
}

if (! function_exists('homeRoute')) {
    /**
     * Return the route to the "home" page depending on authentication/authorization status.
     *
     * @return string
     */
    function homeRoute()
    {
        if (auth()->check()) {
            return \App\Providers\RouteServiceProvider::HOME;
        }

        return 'index';
    }
}

if (! function_exists('currentRouteHas')) {
    /**
     * Check if current url contains a given string
     * @param string|array $value
     * @return bool
     */
    function currentRouteHas($value): bool
    {
        if (is_array($value)) {
            return in_array('/'.request()->path(), $value);
        }
        return str_contains(url()->current(), $value);
    }
}

if (! function_exists('requestPathIs')) {
    /**
     * Check if current request path
     * is equal to the given string
     * or array of strings
     * NOTE: prepends slash '/'
     * @param string|array $value
     * @return bool
     */
    function requestPathIs($value): bool
    {
        if (is_array($value)) {
            return in_array('/'.request()->path(), $value);
        }
        return '/'.request()->path() === $value;
    }
}

if (! function_exists('setAllLocale')) {

    /**
     * @param $locale
     *
     * @return void
     */
    function setAllLocale($locale): void
    {
        setAppLocale($locale);
        setPHPLocale($locale);
        setCarbonLocale($locale);
    }
}

if (! function_exists('setAppLocale')) {

    /**
     * @param $locale
     *
     * @return void
     */
    function setAppLocale($locale): void
    {
        app()->setLocale($locale);
    }
}

if (! function_exists('setPHPLocale')) {

    /**
     * @param $locale
     *
     * @return void
     */
    function setPHPLocale($locale): void
    {
        setlocale(LC_TIME, $locale);
    }
}

if (! function_exists('setCarbonLocale')) {

    /**
     * @param $locale
     *
     * @return void
     */
    function setCarbonLocale($locale): void
    {
        Carbon::setLocale($locale);
    }
}

if (!function_exists('includeFilesInFolder')) {
    /**
     * Loops through a folder and requires all PHP files
     * Searches sub-directories as well.
     *
     * @param $folder
     *
     * @return void
     */
    function includeFilesInFolder($folder): void
    {
        try {
            $rdi = new RecursiveDirectoryIterator($folder);
            $it = new RecursiveIteratorIterator($rdi);

            while ($it->valid()) {
                if (!$it->isDot() && $it->isFile() && $it->isReadable() && $it->current()->getExtension() === 'php') {
                    require $it->key();
                }

                $it->next();
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}

if (!function_exists('includeRouteFiles')) {

    /**
     * @param $folder
     *
     * @return void
     */
    function includeRouteFiles($folder): void
    {
        includeFilesInFolder($folder);
    }
}
