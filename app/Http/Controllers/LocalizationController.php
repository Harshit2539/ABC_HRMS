<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LocalizationController extends Controller
{
    public function index($locale){
      
        if(!in_array($locale, config('localization.locales'))){
            abort(404);
        }
        session(['localization' => $locale]);
        return redirect()->back();

    }
}
