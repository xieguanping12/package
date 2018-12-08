<?php

namespace App\Http\Controllers;

use Dingo\Api\Routing\Helpers;

class HomeController extends Controller
{
    use Helpers;

    public function index()
    {
        $users = $this->api->get('users');

        return view('index')->with('users', $users);
    }
}
