<?php

namespace App\Http\Controllers;
use App\Models\Classroom;
use App\Models\Student;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\StudentImport;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $listClassroom = classroom::all(); 
        $IdClass = $request->get('Id_Class');

        $listStudent = student::join("classroom", "student.Id_Class", "=", "classroom.Id_Class")
                                ->where('classroom.Id_Class', $IdClass)  
                                ->where('student.availabel', 1)  
                                ->get();
        return view('student.index', [
            'listStudent' => $listStudent,
            'listClassroom' => $listClassroom,
            'IdClass' => $IdClass,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $listClassroom = classroom::all();
        return view('student.create', [
            'listClassroom' => $listClassroom,
        ]);
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
        $Name_Class = $request->get('Name_Class');
        $gender = $request->get('gender');
        $DoB = $request->get('DoB');
        $email = $request->get('email');
        $phone = $request->get('phone');

        if (student::where('Phone_Number', $phone)->exists()) {
            session()->flash('danger', 'Số điện thoại đã tồn tại!!');
                return redirect(route('student.create'));

        }elseif (student::where('Email', $email)->exists()) {
            session()->flash('danger', 'Email đã tồn tại!!');
                return redirect(route('student.create'));
        }else{       
        $student = new student();
        $student->Name_Name = $name;
        $student->Id_Class = $Name_Class;
        $student->Gender = $gender;
        $student->DoB = $DoB;
        $student->Email = $email;
        $student->Phone_Number = $phone;
        $student->availabel = 1;

        $student->save();

         session()->flash('success', 'Thêm sinh viên thành công!!');

        return redirect(route( 'student.index') );
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $student = student::find($id);
        $listClassroom = classroom::all();

        return view('student.edit', [
            'student' => $student,
            'listClassroom' => $listClassroom,
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
        $Name_Class = $request->get('Name_Class');
        $gender = $request->get('gender');
        $DoB = $request->get('DoB');
        $email = $request->get('email');
        $phone = $request->get('phone');

        $student = student::find($id);
        $student->Name_Name = $name;
        $student->Id_Class = $Name_Class;
        $student->Gender = $gender;
        $student->DoB = $DoB;
        $student->Email = $email;
        $student->Phone_Number = $phone;

        $student->save();

         session()->flash('success', 'Cập nhật sinh viên thành công!!');
        return redirect(route( 'student.index') );
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
        $student = student::find($id);
        $student->availabel = 0;
        $student->save();
        
         session()->flash('success', 'Xóa sinh viên thành công!!');
        return redirect(route('student.index'));
    }

    public function insertExcel(){
        return view('student.insert-excel');
    }

    public function insertExcelProcess(Request $request){
        Excel::import(new StudentImport, $request->file("excel"));
        return redirect(route('student.index'));
    }
}
