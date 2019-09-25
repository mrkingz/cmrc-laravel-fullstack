<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('guest')->except(['logout', 'getHome', 'getAbout', get]);
    // }

    public function getAbout()
    {
        return view('pages.about');
    }

    public function getBlog()
    {
        return view('pages.blog');
    }

    public function getHome()
    {
        return view('pages.home');
    }

    public function getIndex()
    {
        return view('pages.welcome');
    }

    public function getPolls()
    {
        return view('pages.polls');
    }

    public function getServices()
    {
        return view('pages.services');
    }
}
