<?php
/**
 * Created by PhpStorm.
 * User: s1500631
 * Date: 14/12/2017
 * Time: 14:39
 */

namespace App\Http\Controllers;

use database\connectors\UserData;
use Illuminate\Http\Request;

class UserController extends Controller {
    public function __construct(){
        $this->middleware('user');
    }
    public function userSettings(){
        $id=UserData::getUserId(auth()->guard('users')->id());
        $user = UserData::getUser($id);
        return view('user-settings',['user'=>$user]);
    }
    public function updateSettings(Request $request){
        $username = $request->input('username');
        $department = $request->input('department');
        $position = $request->input('position');
        $status = $request->input('status');
        $account = auth()->guard('users')->id();
        UserData::updateInformationByAccount($account,$username,$department,$position,$status);
        return redirect()->intended('/user/settings');
    }
}