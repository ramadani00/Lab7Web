<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        return view('welcome_message');
    }
    public function about()
    {
        return view('about');
    }
    public function contact()
    {
        return view('contact');
    }
    public function faqs()
    {
        return view('faqs');
    }
    public function tos()
    {
        return view('tos');
    }
}
