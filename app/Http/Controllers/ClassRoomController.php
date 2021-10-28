<?php

namespace App\Http\Controllers;
use App\Models\Classroom;
use App\Models\Course;
use App\Models\Subject;
use Illuminate\Http\Request;

class ClassRoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $listCourse = course::all();
        $IdCourse = $request->get('Id_Course');

        $listClassroom = classroom::join("course", "classroom.Id_Course", "=", "course.Id_Course")
                                    ->join("subject", "classroom.Id_Subject", "=", "subject.Id_Subject")
                                    ->where('classroom.availabel', 1)
                                    ->where('course.Id_Course', $IdCourse)
                                    ->paginate(3);
        return view('Classroom.index', [
            'listClassroom' => $listClassroom,
            'listCourse' => $listCourse,
            'IdCourse' => $IdCourse,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $listCourse = course::all();
        
        $listSubject = subject::all();
        return view('Classroom.create', [
            'listCourse' => $listCourse,
            'listSubject' => $listSubject,
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
        $Name_Course = $request->get('Name_Course');
        $Name_Subject = $request->get('Name_Subject');

        if (classroom::where('Name_Class', $name)->exists()) {
                session()->flash('danger', 'Lớp học đã tồn tại!!');
                return redirect(route('classroom.create'));
        }else{
            $classroom = new classroom();
            $classroom->Name_Class = $name;
            $classroom->Id_Course = $Name_Course;
            $classroom->Id_Subject = $Name_Subject;
            $classroom->availabel = 1;

            $classroom->save();

             session()->flash('success', 'Thêm lớp thành công!!');

        return redirect(route('classroom.index'));
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
        $classroom = classroom::find($id);
        $listCourse = course::all();
        $listSubject = subject::all();

        return view('classroom.edit', [
            'classroom' => $classroom,
            'listCourse' => $listCourse,
            'listSubject' => $listSubject
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
        $Name_Course = $request->get('Name_Course');
        $Name_Subject = $request->get('Name_Subject');

        $classroom = classroom::find($id);
        $classroom->Name_Class = $name;
        $classroom->Id_Course = $Name_Course;
        $classroom->Id_Subject = $Name_Subject;

        $classroom->save();

         session()->flash('success', 'Cập nhật lớp thành công!!');
        return redirect(route('classroom.index'));   
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
        $classroom = classroom::find($id);
        $classroom->availabel = 0;
        $classroom->save();

         session()->flash('success', 'Xóa lớp thành công!!');
        return redirect(route('classroom.index'));
     }
}
