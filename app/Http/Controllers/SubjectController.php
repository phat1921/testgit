<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        $listSubject = subject::where('Name_Subject', 'like',"%$search%")
                                ->where('subject.availabel', 1)
                                ->paginate(3);
        return view('subject.index', [
            'search' => $search,
            'listSubject' => $listSubject,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('subject.create');
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

        if (subject::where('Name_Subject', $name)->exists()) {
                session()->flash('danger', 'Môn học đã tồn tại!!');
                return redirect(route('subject.create'));
        }else{
            $subject = new subject();
            $subject->Name_Subject = $name;
            $subject->availabel = 1;
            $subject->save();

             session()->flash('success', 'Thêm môn học thành công!!');
            return redirect(route('subject.index'));
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
        $subject = subject::find($id);
        return $subject;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $subject = subject::find($id);
        return view('subject.edit', [
            "subject" => $subject,
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
        $subject = subject::find($id);
        $subject->Name_Subject = $name;
        $subject->save();

         session()->flash('success', 'Cập nhật môn học thành công!!');
        return redirect(route('subject.index'));
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
        $subject = subject::find($id);
        $subject->availabel = 0;
        $subject->save();

         session()->flash('success', 'Xóa môn học thành công!!');
        return redirect(route('subject.index'));
    }
}
