<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Spatie\ResponseCache\Facades\ResponseCache;

class AdminSettingsController extends AdminController
{
    public function clearCache()
    {
        ResponseCache::clear();

        return back();
    }
}
