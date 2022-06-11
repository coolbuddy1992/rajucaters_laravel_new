<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    public function englishLoad()
    {
        if ((session()->get('language') == 'hindi')) {
            session()->forget('language');
            return redirect(route('home'));
        }
        session()->get('language');
        session()->forget('language');
        Session::put('language', 'english');
        return redirect()->back();
    }

    public function banglaLoad()
    {
        session()->get('language');
        session()->forget('language');
        Session::put('language', 'bangla');
        return redirect()->back();
    }

    public function hindiLoad()
    {
        if ((session()->get('language') == 'english')) {
            session()->forget('language');
            return redirect(route('home'));
        } else {
            session()->get('language');
            session()->forget('language');
            Session::put('language', 'hindi');
            return redirect(route('home'));
        }
        session()->get('language');
        session()->forget('language');
        Session::put('language', 'hindi');
        return redirect()->back();
    }
}
