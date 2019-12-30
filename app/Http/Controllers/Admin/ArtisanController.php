<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ArtisanController extends Controller
{

    public function index(Request $request, string $command){
        $params = $request->all();
        Artisan::call($command, $params);
        return Artisan::output();
    }

}
