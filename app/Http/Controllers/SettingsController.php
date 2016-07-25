<?php

namespace Admin\Http\Controllers;

use Admin\BlurbCategory;
use Admin\Cuisine;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    /**
     * Display tutorials page
     *
     * @return Redirect
     */
    public function index()
    {
        $data['cuisines'] = Cuisine::get()->toArray();
        $data['blurb_category'] = BlurbCategory::get()->toArray();

        return view('settings.index', $data);
    }

    /**
     * Display tutorials page
     *
     * @return Redirect
     */
    public function store(Request $request)
    {

    }
}
