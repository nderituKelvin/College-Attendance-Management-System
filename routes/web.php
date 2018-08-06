<?php

use Illuminate\Support\Facades\Route;

    Route::get('/',[
        'as' => 'loginPage',
        function(){
            return view('login');
        }
    ]);

    Route::get('/signup',[
        'as' => 'signUpPage',
        function(){
            return view('signup');
        }
    ]);

    Route::get('/lecturer/home',[
        'as' => 'lecturerHome',
        function(){
            return view('lecturer.systemfiles.dashboard');
        }
    ]);

    Route::get('/lecturer/units',[
        'as' => 'lecturerUnits',
        function(){
            return view('lecturer.systemfiles.unitList');
        }
    ]);

    Route::get('/lecturer/unitdetail',[
        'as' => 'lecturerUnitDetail',
        function(){
            return view('lecturer.systemfiles.unitDetail');
        }
    ]);

    Route::get('/lecturer/lecturedetail',[
        'as' => 'lecturerLectureDetail',
        function(){
            return view('lecturer.systemfiles.lectureDetail');
        }
    ]);

    Route::get('lecturer/lectures', [
        'as' => 'lecturerLectureList',
        function(){
            return view('lecturer.systemfiles.lectureList');
        }
    ]);

    Route::get('lecturer/profile', [
        'as' => 'lecturerProfile',
        function(){
            return view('lecturer.systemfiles.lecturerProfile');
        }
    ]);

    Route::get('lecturer/changepassword', [
        'as' => 'lecturerUpdatePassword',
        function(){
            return view('lecturer.systemfiles.changePassword');
        }
    ]);

    Route::get('student/home',[
        'as' => 'studentHome',
        function(){
            return view('student.systemfiles.dashboard');
        }
    ]);

    Route::get('student/units', [
        'as' => 'studentUnitList',
        function(){
            return view('student.systemfiles.unitList');
        }
    ]);

    Route::get('student/unitdetail', [
        'as' => 'studentUnitDetail',
        function(){
            return view('student.systemfiles.unitDetail');
        }
    ]);

    Route::get('student/lecturedetail', [
        'as' => 'studentLectureDetail',
        function(){
            return view('student.systemfiles.lectureDetail');
        }
    ]);

    Route::get('student/profile', [
        'as' => 'studentProfile',
        function(){
            return view('student.systemfiles.studentProfile');
        }
    ]);

    Route::get('student/changepassword', [
        'as' => 'studentChangePassword',
        function(){
            return view('student.systemfiles.changePassword');
        }
    ]);






?>