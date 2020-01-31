<?php 

namespace App\Http\Controllers\Api;

use App\User;
use App\Model\Admin\Acount;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Http\Traits\Web\UserRequestTrait;

class UserController extends Controller{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function get(Request $request){
        return response()->json($request->user());
    }
}
