<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Notice;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //最新公告
    public function index()
//    {}
//    public function fack()
    {

        //=== 抓取課程年度陣列
//        $years = array();

//        $courses = \App\Models\User::find(
//            \Illuminate\Support\Facades\Auth::id())->teacher()->first()->courses()->get()
//            ->sortbydesc('year');
//
//        $courses -> unique('year');
//        return $courses;

        return view('teacher.index',[

        ]);
    }

    public function course(Request $request,$course_id){

        //=== 使用id抓取課程
        $course = Course::find($course_id);

        $courses = Auth::user()->teacher()->first()->courses()->get()->
        unique('year')->sortbydesc('year');

        foreach ($courses as $data){
            $years[$data -> id] = $data -> year;
        }

        //抓取該課程所有公告
        $notices = $course->notices()->get();

//        return $notices;

        return view('teacher.courses.notices',[
            'course' => $course,
            'notices' => $notices,
            'years' => $years,
        ]);
    }

    //系統建議
    public function problem(){

        //=== 抓取該老師所有課程
        $courses = User::find(Auth::id())->teacher()->first()->courses()->get()->
        unique('year')->sortbydesc('year');

        // === 寫入資料
        foreach ($courses as $course) {
            $years[$course->id] = $course->year;
        }

        return view('teacher.problem',[
            'courses'=>$courses,
            'years' => $years,
        ]);
    }

    //行事曆
    public function behave(){

        //=== 抓取該老師所有課程
        $courses = User::find(Auth::id())->teacher()->first()->courses()->get()->
        unique('year')->sortbydesc('year');

        // === 寫入資料
        foreach ($courses as $course) {
            $years[$course->id] = $course->year;
        }

        return view('teacher.behave',[
            'courses'=>$courses,
            'years' => $years,
        ]);
    }

    //系統建議
    public function system_suggest(){
        //=== 抓取該老師所有課程
        $courses = User::find(Auth::id())->teacher()->first()->courses()->get()->
        unique('year')->sortbydesc('year');

        // === 寫入資料
        foreach ($courses as $course) {
            $years[$course->id] = $course->year;
        }

        return view('teacher.system_suggest',[
            'courses'=>$courses,
            'years' => $years,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function show(Teacher $teacher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function edit(Teacher $teacher)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Teacher $teacher)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function destroy(Teacher $teacher)
    {
        //
    }

    public function TA(){
        $courses = User::find(Auth::id())->teacher()->first()->courses()->get();

        return view('teacher.ta',[
            'courses' => $courses,
        ]);
    }

    public function test(Teacher $teacher){

        //隨機在某個老師的某個課程裡新增公告

        //==== 隨便抓取某個老師的資料
        $teachers = Teacher::all()->sortByDesc('id');
        $ran_teachers = random_int(1,$teachers->first()->id);
        $teacher = $teachers->where('id',$ran_teachers)->first();

        // ======隨便抓取該老師的某個課程
        $courses = Course::all()->where('teacher_id',$teacher->id);
        $deep_courses = 0;
        foreach ($courses as $course){
            $deep_courses ++;
        }
        $ran_courses = random_int(1, $deep_courses);

        return $deep_courses;

//        return view('teacher.data');
    }


}
