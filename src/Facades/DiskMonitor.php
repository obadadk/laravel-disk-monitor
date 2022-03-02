<?php

namespace Obadadk\DiskMonitor\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Obadadk\DiskMonitor\DiskMonitor
 */
class DiskMonitor extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'laravel-disk-monitor';
    }
}
