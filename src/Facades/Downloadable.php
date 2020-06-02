<?php

namespace Diskominfotik\Downloadable\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Diskominfotik\Downloadable\Skeleton\SkeletonClass
 */
class Downloadable extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'downloadable';
    }
}
