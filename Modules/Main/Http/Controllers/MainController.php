<?php

namespace Modules\Main\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Routing\Route;

use App\Http\Requests\LoginRequest;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Redirect;
class MainController extends Controller
{

    public function __construct()
    {
        //Check login

        // $this->middleware(function ($request, $next) {
        //     if(Session::get('auth') == NULL){
        //          return Redirect::to('/auth/login');
        //     }else{
        //         return $next($request);
        //     }
        // });
    }

    public function index()
    {
        $user = Session::get('auth');

        $re = DB::table('st_users')->get();
        $data['User'] = $user;

        return view('main::index',$data);
    }


}
