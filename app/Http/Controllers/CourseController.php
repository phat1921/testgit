<?php

namespace App\Http\Controllers;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        $listCourse = course::where('Name_Course', 'like', "%$search%")
                              ->where('course.availabel', 1)  
                              ->paginate(3);
        return view('Course.index', [
            'listCourse' => $listCourse,
            'search' => $search
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('Course.create');
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

        if (course::where('Name_Course', $name)->exists()) {
            session()->flash('danger', 'Khóa học đã tồn tại!!');
            return redirect(route('course.create'));
        }else{
            $course = new course();
            $course->Name_Course = $name;
            $course->availabel = 1;
            $course->save();

            session()->flash('success', 'Thêm khóa thành công!!');
          return redirect(route('course.index'));
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
        $course = course::where('Id_Course', $id)->first();
        return $course;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $course = course::find($id);
        return view('Course.edit', [
            "course" => $course
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
       $course = course::find($id);
       $course->Name_Course = $name;
       $course->save();

        session()->flash('success', 'Cập nhật khóa thành công!!');
       return redirect(route('course.index')); 
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
        $course = course::find($id);
        $course->availabel = 0;
        $course->save();

         session()->flash('success', 'Xóa khóa thành công!!');
        return redirect(route('course.index'));
    }
}
