<?php

namespace App\Http\Controllers;

// Use others
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class RDController
{
    public function __construct()
    {
    }

    // THEME WITH COOKIE
    public function readCookie(Request $request)
    {
        try {
            $theme = $request->cookie('theme');
            return view('RD.theme')->with('theme', $theme);
        } catch (\Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }

    public function createAndUpdateCookie(Request $request)
    {
        try {
            $theme = $request->input('theme');
            if ($theme && in_array($theme, ['light', 'dark'])) {
                $cookie = cookie('theme', $theme, 60 * 24 * 365);
            }
            return back()->withCookie($cookie);
        } catch (\Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }

    public function deleteCookie()
    {
        try {
            Cookie::queue(Cookie::forget('theme'));
            return back();
        } catch (\Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }
}
