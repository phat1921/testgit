<?php

namespace App\Http\Controllers;

use Exception;
use TypeError;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Redirect;


class AuthenticateController extends Controller
{
    public function login(){
        return view('login');
    }

    public function loginProcess(Request $request){
        $username = $request->get('username');
        $password = $request->get('password');

        try {
           $admin = Admin::where('User_Name', $username)->where('PassWord', $password)->firstOrFail();
            if ($admin->Role == 1) {
                $request->session()->put('idAd', $admin->Id_Admin);
                $request->session()->put('namead', $admin->Name_Admin);
                $request->session()->put('genderad', $admin->Gender);
                $request->session()->put('DoBad', $admin->DoB);
                $request->session()->put('phonead', $admin->Phone_Number);
                $request->session()->put('addressad', $admin->Address);
                $request->session()->put('emailad', $admin->Email);
                $request->session()->put('rolead', $admin->Role);
                    return Redirect::route('dashboard');
            }else if($admin->Role == 0){
                $request->session()->put('iduser', $admin->Id_Admin);
                $request->session()->put('nameuser', $admin->Name_Admin);
                $request->session()->put('genderuser', $admin->Gender);
                $request->session()->put('DoBuser', $admin->DoB);
                $request->session()->put('phoneuser', $admin->Phone_Number);
                $request->session()->put('addressuser', $admin->Address);
                $request->session()->put('emailuser', $admin->Email);
                $request->session()->put('roleuser', $admin->Role);
                    return Redirect::route('dashboard');
            }
           
        } catch (Exception $e) {
            return Redirect::route('login')->with('error', 'Sai tài khoảng hoặc mật');      
        }
        

    }

    public function logout(Request $request){
        $request->session()->flush();
        return Redirect::route('login');
    }

}
