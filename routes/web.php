<?php

use App\Attendance;
use App\Lecture;
use App\Material;
use App\Reg;
use App\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

    Route::get('login', function (){
        return redirect()->route('loginPage');
    });

    Route::get('/',[
        'as' => 'loginPage',
        function(){
            return view('login');
        }
    ]);

    Route::post('postlogin', [
        'as' => 'postLogin',
        'uses' => 'UserController@login'
    ]);

    Route::get('/signup',[
        'as' => 'signUpPage',
        function(){
            return view('signup');
        }
    ]);

    Route::post('/postsignup', [
        'as' => 'postSignUp',
        'uses' => 'UserController@signUp'
    ]);

    Route::get('/lecturer/home',[
        'as' => 'lecturerHome',
        function(){
            $totalLecs = Lecture::where('lec', Auth::user()->getAuthIdentifier())->count();
            $totalUnits = Unit::where('lec', Auth::user()->getAuthIdentifier())->count();
            $upcoming = Lecture::where('lec', \Illuminate\Support\Facades\Auth::user()->id)
                    ->where('time', '>', \Carbon\Carbon::now())
                    ->get();


            return view('lecturer.systemfiles.dashboard', [
                'totalLecs' => $totalLecs,
                'totalUnits' => $totalUnits,
                'upcomings' => $upcoming
            ]);
        }
    ])->middleware('auth')->middleware('lec');

    Route::get('/lecturer/units',[
        'as' => 'lecturerUnits',
        function(){
            $units = Unit::where('lec', Auth::user()
                ->getAuthIdentifier())->where('status', 'active')
                ->orderBy('id', 'desc')
                ->paginate(10);
            return view('lecturer.systemfiles.unitList', [
                'units' => $units
            ]);
        }
    ])->middleware('auth')->middleware('lec');

    Route::post('postaddunit', [
        'as' => 'postAddUnit',
        'uses' => 'UserController@postAddUnit'
    ])->middleware('auth')->middleware('lec');

    Route::get('lecturer/unitdetail/{unitid}',[
        'as' => 'lecturerUnitDetail',
        function($unitid){
            $unit = Unit::where('id', $unitid)
                ->where('lec', Auth::user()->getAuthIdentifier())
                ->first();
            $lectures = Lecture::where('unit', $unitid)
                ->orderBy('id', 'desc')
                ->get();
            $students = Reg::where('unit', $unitid)
                ->where('status', 'active')
                ->orderBy('id', 'desc')
                ->get();
            return view('lecturer.systemfiles.unitDetail', [
                'unit' => $unit,
                'lectures' => $lectures,
                'students' => $students
            ]);
        }
    ])->middleware('auth')->middleware('lec');

    Route::post('postaddlecture', [
        'as' => 'postAddLecture',
        'uses' => 'UserController@postAddLecture'
    ])->middleware('auth')->middleware('lec');

    Route::post('postAddStudents', [
        'as' => 'postAddStudents',
        'uses' => 'UserController@postAddStudents'
    ])->middleware('auth')->middleware('lec');

    Route::get('/lecturer/lecturedetail/{lectureid}',[
        'as' => 'lecturerLectureDetail',
        function($lectureid){
            $lecture = Lecture::where('id', $lectureid)
                ->first();
            $unit = Unit::where('id', $lecture->unit)
                ->first();
            $materials = Material::where('lecture', $lectureid)
                ->get();
            return view('lecturer.systemfiles.lectureDetail', [
                'lecture' => $lecture,
                'unit' => $unit,
                'materials' => $materials
            ]);
        }
    ])->middleware('auth')->middleware('lec');

    Route::get('lecturer/deletematerial/{file}', [
        'as' => 'lecDeleteMaterial',
        function($file){
            $material = Material::where('file', $file)->first();
            if($material->delete()){
                return back()->with([
                    'title' => "Deleted",
                    "message" => "",
                    "status" => "info"
                ]);
            }else{
                return back()->with([
                    'title' => "Error",
                    "message" => "An Unkown Error occurres",
                    "status" => "error"
                ]);
            }
        }
    ])->middleware('auth')->middleware('lec');

    Route::post('postAddLearningMaterial', [
        'as' => 'postAddLearningMaterial',
        'uses' => 'UserController@postAddLearningMaterial'
    ])->middleware('auth')->middleware('lec');

    Route::get('lecturer/lectures', [
        'as' => 'lecturerLectureList',
        function(){
            $lectures = Lecture::where('lec', Auth::user()->getAuthIdentifier())->paginate(30);
            return view('lecturer.systemfiles.lectureList', [
                'lectures' => $lectures
            ]);
        }
    ])->middleware('auth')->middleware('lec');

    Route::get('lecturer/profile', [
        'as' => 'lecturerProfile',
        function(){
            return view('lecturer.systemfiles.lecturerProfile');
        }
    ])->middleware('auth')->middleware('lec');

    Route::post('lecupdateprofile', [
        'as' => 'postLecUpdateProfile',
        'uses' => 'UserController@postLecUpdateProfile'
    ])->middleware('auth')->middleware('lec');

    Route::post('studupdateprofile', [
        'as' => 'postStudUpdateProfile',
        'uses' => 'UserController@postStudUpdateProfile'
    ])->middleware('auth')->middleware('stud');

    Route::get('lecturer/changepassword', [
        'as' => 'lecturerUpdatePassword',
        function(){
            return view('lecturer.systemfiles.changePassword');
        }
    ])->middleware('auth')->middleware('lec');

    Route::post('lecChangePassword', [
        'as' => 'lecChangePassword',
        'uses' => 'UserController@lecChangePassword'
    ])->middleware('auth')->middleware('lec');

    Route::post('studChangePassword', [
        'as' => 'studChangePassword',
        'uses' => 'UserController@studChangePassword'
    ])->middleware('auth')->middleware('lec');

    Route::get('student/home',[
        'as' => 'studentHome',
        function(){
            $allClassesRaw = Lecture::where('time', '>', \Carbon\Carbon::now())->orderBy('time', 'asc');
            $res = null;
            $upcoming = null;
            if($allClassesRaw->count() == 0){
                $res = null;
                $upcoming = null;
            }else{
                foreach ($allClassesRaw->get() as $allClass){
                    if(Reg::where('unit', $allClass->unit)->where('student', Auth::user()->getAuthIdentifier())->count() == 1){
                        $res = $allClass;
                        break;
                    }
                }

                foreach ($allClassesRaw->get() as $allClasses){
                    $data = array();
                    if(Reg::where('unit', $allClass->unit)->where('student', Auth::user()->getAuthIdentifier())->count() == 1){
                        array_push($data, $allClasses);
                    }
                }
                $upcoming = $data;
            }
            $supposedatts = 0;
            $attended = 0;
            foreach (Reg::where('student', Auth::user()->getAuthIdentifier())->get() as $reg){
                foreach (Lecture::where('unit', $reg->unit)->get() as $lec){
                    $supposedatts++;
                    if(Attendance::where('student', Auth::user()->getAuthIdentifier())->where('lec', $lec->id)->count() == 1){
                        $attended++;
                    }
                }
            }
            if($supposedatts != 0){
                $percatts = $attended/$supposedatts * 100;
            }else{
                $percatts = 0;
            }
            $totalLecs = Attendance::where('student', Auth::user()->getAuthIdentifier())->count();
            return view('student.systemfiles.dashboard', [
                'closestClass' => $res,
                'upComingClasses' => $upcoming,
                'totalUnits' => Reg::where('student', Auth::user()->getAuthIdentifier())->count(),
                'percAtts' => $percatts,
                'totalLecs' => $totalLecs
            ]);
        }
    ])->middleware('auth')->middleware('stud');

    Route::get('student/units', [
        'as' => 'studentUnitList',
        function(){
            $regs = Reg::where('student', Auth::user()->getAuthIdentifier())
                ->where('status', 'active')
                ->orderBy('id', 'desc')
                ->paginate(10);
            return view('student.systemfiles.unitList', [
                'regs' => $regs
            ]);
        }
    ])->middleware('auth')->middleware('stud');

    Route::get('student/unitdetail/{unitid}', [
        'as' => 'studentUnitDetail',
        function($unitid){
            $unit = Unit::where('id', $unitid)->first();
            $lecs = Lecture::where('unit', $unitid)->get();
            return view('student.systemfiles.unitDetail', [
                'unit' => $unit,
                'lecs' => $lecs
            ]);
        }
    ])->middleware('auth')->middleware('stud');

    Route::get('student/lecturedetail/{leid}', [
        'as' => 'studentLectureDetail',
        function($leid){
            $lecture = Lecture::where('id', $leid)->first();
            $unit = Unit::where('id', $lecture->unit)->first();
            $materials = Material::where('lecture', $lecture->id)->get();
            return view('student.systemfiles.lectureDetail', [
                'lecture' => $lecture,
                'unit' => $unit,
                'materials' => $materials
            ]);
        }
    ])->middleware('auth')->middleware('stud');

    Route::get('student/profile', [
        'as' => 'studentProfile',
        function(){
            return view('student.systemfiles.studentProfile');
        }
    ])->middleware('auth')->middleware('stud');

    Route::get('student/changepassword', [
        'as' => 'studentChangePassword',
        function(){
            return view('student.systemfiles.changePassword');
        }
    ])->middleware('auth')->middleware('stud');

    Route::get('student/signattendance/{leid}', [
        'as' => 'studentSignAttendance',
        'uses' => 'UserController@studentSignAttendance'
    ])->middleware('auth')->middleware('stud');

    Route::get('revokeSignature/{atid}', [
        'as' => 'revokeAttendance',
        'uses' => 'UserController@revokeAttendance'
    ])->middleware('auth')->middleware('lec');

    Route::get('closeSigning/{lecid}', [
        'as' => 'closeSigning',
        'uses' => 'UserController@closeSigning'
    ])->middleware('auth')->middleware('lec');



    Route::get('logout', [
       'as' => 'logout',
       'uses' => 'UserController@logout'
    ]);




?>