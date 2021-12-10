<?php

namespace App\Http\Controllers;

use Goutte\Client;

use Illuminate\Http\Request;

class ScraperController extends Controller
{
    private $result = array();
    public function scraper()
    {
        $client = new Client();
        $url = '';
        return view('scraper');
    }
}
