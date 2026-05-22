<?php

namespace App\Http\Controllers;

use App\Services\Ip2Location;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController
{
    public function __construct(
        private readonly Ip2Location $ip2location
    ) {}

    public function index(Request $request, ?string $locale = null): View
    {
        $locale = in_array($locale, ['en', 'fa'], true) ? $locale : config('app.locale');
        app()->setLocale($locale);

        return view('home', [
            'location' => rescue(fn () => $this->ip2location->query($request->ip()), report: false),
            'userAgent' => $request->userAgent(),
        ]);
    }
}
