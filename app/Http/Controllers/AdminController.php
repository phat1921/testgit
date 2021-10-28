<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        $listAdmin = admin::where('Name_Admin', 'like', "%$search")
                            ->where('admin.status', 1)
                            ->paginate(3);
        return view('admin.index', [
            'search' => $search,
            'listAdmin' => $listAdmin
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $name = $request->get('name');
        $DoB = $request->get('DoB');
        $gender = $request->get('gender');
        $phone = $request->get('phone');
        $address = $request->get('address');
        $email = $request->get('email');
        $username = $request->get('username');
        $password = $request->get('password');
        $role = $request->get('role');
        
        if (admin::where('Email', $email)->exists()) {
                session()->flash('danger', 'Email đã tồn tại!!');
                return redirect(route('admin.create'));

            }elseif (admin::where('Phone_Number', $phone)->exists()) {
                session()->flash('danger', 'Số điện thoại đã tồn tại!!');
                return redirect(route('admin.create'));

            }if (admin::where('User_Name', $username)->exists()) {
                session()->flash('danger', 'Tên đăng nhập đã tồn tại!!');
                return redirect(route('admin.create'));
            }else{

            $admin = new admin();
            $admin->Name_Admin = $name;
            $admin->DoB = $DoB;
            $admin->Gender = $gender;
            $admin->Phone_Number = $phone;
            $admin->Address = $address;
            $admin->Email = $email;
            $admin->User_Name = $username;
            $admin->PassWord = $password;
            $admin->Role = $role;
            $admin->Status = 1;

            $admin->save();

            session()->flash('success', 'Thêm AD thành công!!');
            return redirect(route('admin.index'));
            }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('admin.profile');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $admin = admin::find($id);
        return view('admin.edit', [
            'admin' => $admin
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $name = $request->get('name');
        $DoB = $request->get('DoB');
        $gender = $request->get('gender');
        $phone = $request->get('phone');
        $address = $request->get('address');
        $email = $request->get('email');
        $username = $request->get('username');
        $password = $request->get('password');
        $role = $request->get('role');
        $status = $request->get('status');

        $admin = admin::find($id);
        $admin->Name_Admin = $name;
        $admin->DoB = $DoB;
        $admin->Gender = $gender;
        $admin->Phone_Number = $phone;
        $admin->Address = $address;
        $admin->Email = $email;
        $admin->User_Name = $username;
        $admin->PassWord = $password;
        $admin->Role = $role;
        $admin->Status = $status;

        $admin->save();

         session()->flash('success', 'Cập nhật AD thành công!!');

        return redirect(route('admin.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function hide($id){
        $admin = admin::find($id);
        $admin->status = 0;
        $admin->save();

        session()->flash('success', 'Xóa AD thành công!!');
        return redirect(route('admin.index'));
    }

   // public function profile(){
   //  return view('admin.profile');
   // }

}
