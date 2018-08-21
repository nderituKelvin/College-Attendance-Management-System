<?php

namespace App\Http\Controllers;

use App\Attendance;
use App\Lecture;
use App\Material;
use App\Photo;
use App\Reg;
use App\Unit;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;


class UserController extends Controller{
    public function closeSigning($lecid){
        $lecture = Lecture::where('id', $lecid)->first();
        $lecture->status = "done";
        if($lecture->save()){
            return $this->backWithMessage("Signing Class has been turned off", "", "info");
        }
    }

    public function revokeAttendance($atid){
        $attendance = Attendance::where('id', $atid)->first();
        if($attendance->delete()){
            return $this->backWithMessage("Revoked", "Student Signature has been revoked", "info");
        }else{
            return $this->backWithUnknownError();
        }
    }

    public function studentSignAttendance($leid){
        // ensure that class is active and time has passed before accepting signing
        $lecture = Lecture::where('id', $leid)->first();
        if($lecture->status != "active"){
            return $this->backWithMessage("Sorry", "This Class is closed off", "info");
        }

        $unit = Unit::where('id', $lecture->unit)->first();
        if(Reg::where('student', Auth::user()->getAuthIdentifier())->where('unit', $unit->id)->count() == 1){
            if(Attendance::where('unit', $unit->id)->where('lec', $leid)->where('student', Auth::user()->getAuthIdentifier())->count() == 0){
                $att = new Attendance();
                $att->unit = $unit->id;
                $att->student = Auth::user()->getAuthIdentifier();
                $att->lec = $leid;
                if($att->save()){
                    return $this->backWithMessage("Signed", "You have successfully signed in", "success");
                }
            }else{
                return $this->backWithMessage("Failed", "You are already signed in", "warning");
            }
        }else{
            return $this->backWithMessage("Sorry",
                "You are not enrolled for this unit, Please raise this issue with your lecturer",
                "success");
        }
    }

    public function lecChangePassword(Request $request){
        if($request['conpass'] == $request['newpass']){
            $user = Auth::user();
            $user->password = bcrypt($request['newpass']);
            if($user->save()){
                return $this->backWithMessage("Password Updated", "", "success");
            }else{
                return $this->backWithUnknownError();
            }
        }else{
            return $this->backWithMessage("Error", "Ensure both passwords are the same", "warning");
        }
    }

    public function studChangePassword(Request $request){
        if($request['conpass'] == $request['newpass']){
            $user = Auth::user();
            $user->password = bcrypt($request['newpass']);
            if($user->save()){
                return $this->backWithMessage("Password Updated", "", "success");
            }else{
                return $this->backWithUnknownError();
            }
        }else{
            return $this->backWithMessage("Error", "Ensure both passwords are the same", "warning");
        }
    }

    public function postLecUpdateProfile(Request $request){
        $user = Auth::user();
        $user->name = $request['name'];
        $user->idno = $request['idno'];
        $user->save();
        if($request->hasFile('proffpic')){
            if($this->uploadImage($request->file('proffpic'), "user", "512x512", $user->id)){
                $img = Photo::where('native', "user")->where('nativeid', $user->id)->first();
                $img->delete();
            }
        }
        return $this->backWithMessage("Updated", "", "success");
    }

    public function postStudUpdateProfile(Request $request){
        $user = Auth::user();
        $user->name = $request['name'];
        $user->idno = $request['idno'];
        $user->save();
        if($request->hasFile('proffpic')){
            if($this->uploadImage($request->file('proffpic'), "user", "512x512", $user->id)){
                $img = Photo::where('native', "user")->where('nativeid', $user->id)->first();
                $img->delete();
            }
        }
        return $this->backWithMessage("Updated", "", "success");
    }



    public function postAddLearningMaterial(Request $request){
        if($request->hasFile('material')){
            if($request->file('material')->isValid()){
                $file = $request->file('material');
                $ext = $file->getClientOriginalExtension();

                do{
                    $name = $this->generateRandomString(50).'.'.$ext;
                }while(Material::where('file', $name)->count() > 0 );
                $file->move('storage/materials/', $name);
                $material = new Material();
                $material->lecture = $request['lecture'];
                $material->title = $request['title'];
                $material->file = $name;
                $material->status = "active";
                if($material->save()){
                    return $this->backWithMessage("Success", "Upload was successful", "success");
                }else{
                    return $this->backWithUnknownError();
                }
            }else{
                return $this->backWithMessage("Corrupt File", "", "error");
            }
        }else{
            return $this->backWithUnknownError();
        }
    }

    public function postAddStudents(Request $request){
        if(!$request->hasFile('excelFile')){
            return $this->backWithMessage("Error", "Please Upload a valid file", "warning");
        }

        $ext = $request->file('excelFile')->getClientOriginalExtension();
        if($ext != 'xlsx' && $ext != 'XLSX' && $ext != 'XLS' && $ext != 'xls'){
            return $this->backWithMessage("Format not supported", "Please reformat your file to either 'xlsx' or 'xls' then try again", "warning");
        }

        if($ext == 'xlsx' || $ext == 'XLSX'){
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        }elseif($ext == 'csv' || $ext == 'CSV'){
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
        }else{
            return $this->backWithMessage("Format not supported", "Please reformat your file to either 'xlsx' or 'csv' then try again", "warning");
        }

        try{
            $spreadsheet = $reader->load($request->file('excelFile'));
        }catch (Exception $exception){
            return $this->backWithUnknownError();
        }

        $sheet = $spreadsheet->getActiveSheet();
        $regNoColumn = 'A';
        $lastRow = $sheet->getHighestRow();
        $lastRow++;
        $count = 0;
        $mishaps = 0;
        $redundant = 0;
        for($row = 1;$row < $lastRow;$row++){
            $regno = $sheet->getCell($regNoColumn.$row);
            $count++;
            if(User::where('regno', $regno)->where('usertype', 'stud')->where('status', 'active')->count() == 1){
                $student = User::where('regno', $regno)->where('usertype', 'stud')->where('status', 'active')->first();
                if(Reg::where('student', $student->id)->where('unit', $request['unit'])->count() == 0){
                    $reg = new Reg();
                    $reg->student = $student->id;
                    $reg->unit = $request['unit'];
                    $reg->status = 'active';
                    $reg->save();
                }else{
                    $redundant++;
                }
            }else{
                $mishaps++;
            }
        }
        return $this->backWithMessage("Uploaded", $mishaps." Mishaps Occured and ".$redundant." data redundancy cases", "info");
    }

    public function postAddLecture(Request $request){
        $time = $request['date']." ".$request['time'];
        $lec = new Lecture();
        if(Carbon::parse($time) < Carbon::now()){
            return $this->backWithMessage("Invalid Time", "The Time Indicated must be in the future", "error");
        }
        $lec->time = Carbon::parse($time);
        $lec->title = $request['title'];
        $lec->lec = Auth::user()->getAuthIdentifier();
        $lec->unit = $request['unit'];
        $lec->status = 'pending';
        if($lec->save()){
            return $this->backWithMessage("Success", "Lecture has been scheduled", "success");
        }else{
            return $this->backWithUnknownError();
        }
    }

    public function postAddUnit(Request $request){
        if(Unit::where('code', $request['unitcode'])->where('status', 'active')->where('lec', Auth::user()->getAuthIdentifier())->count() == 0){
            $unit = new Unit();
            $unit->name = $request['unitname'];
            $unit->code = $request['unitcode'];
            $unit->lec = Auth::user()->getAuthIdentifier();
            $unit->status = 'active';
            if($unit->save()){
                return $this->backWithMessage("Saved", "Unit has been created, You may add students now", "success");
            }else{
                return $this->backWithUnknownError();
            }
        }else{
            return $this->backWithMessage("Sorry", "A unit with the same Unit Code was found", "warning");
        }
    }

    public function login(Request $request){
        if(Auth::attempt(['regno' => $request['regno'], 'password' => $request['password'], 'status' => 'active'])){
            $user = Auth::user();
            if($user->usertype == "stud"){
                return $this->toRouteWithMessage("studentHome", "Welcome", "", "success");
            }else if($user->usertype == "lec"){
                return $this->toRouteWithMessage("lecturerHome", "Welcome", "", "success");
            }else{
                return $this->logout();
            }
        }else{
            return $this->backWithMessage("Sorry", "Login Failed", "error");
        }
    }

    public function signUp(Request $request){
        if(User::where('regno', $request['regno'])->orWhere('idno', $request['idno'])->count() == 0){
            if($request['password'] != $request['conpass']){
                return $this->backWithMessage("Password Error", "Please ensure that your password and Confirmation passwords are the same", "error");
            }

            $user = new User();
            $user->name = $request['name'];
            $user->regno = $request['regno'];
            $user->idno = $request['idno'];
            $user->status = 'active';
            $user->usertype = $request['usertype'];
            $user->password = bcrypt($request['password']);

            if($user->save()){
                if($request->hasFile("proffpic")){
                    $this->uploadImage($request->file('proffpic'), "user", "512x512", $user->id);
                }
                return $this->toRouteWithMessage("loginPage", "Success, Sign Up successful", "You may login now", "success");
            }else{
                return $this->backWithUnknownError();
            }
        }else{
            return $this->backWithMessage("Similar Account Found", "A user with the same email or ID number was found, please try logging in", "error");
        }
    }

    public function logout(){
        Auth::logout();
        return $this->toRouteWithMessage("loginPage", "Logged Out", "", "info");
    }

    public function justBack(){
        return redirect()->back();
    }

    public function toRouteWithMessage($route, $title, $message, $status){
        return redirect()->route($route)->with([
            'title' => $title,
            'message' => $message,
            'status' => $status
        ]);
    }

    public function backWithUnknownError(){
        return redirect()->back()->with([
            'title' => 'Sorry!!',
            'message' => 'A Fatal Error Occurred, We are however working on it',
            'status' => 'error'
        ]);
    }

    public function toRoute($route){
        return redirect()->route($route);
    }

    public function backWithMessage($title, $message, $status){
        return redirect()->back()->with([
            'title' => $title,
            'message' => $message,
            'status' => $status
        ]);
    }

    public function uploadImage($photo, $model, $dimensions, $nativeid){
        $ext = $photo->getClientOriginalExtension();
        if(
            $ext!='jpg'
            && $ext!='JPG'
            && $ext != 'PNG'
            && $ext != 'png'
            && $ext != 'JPEG'
            && $ext != 'jpeg'
            && $ext != 'bmp'
            && $ext != 'BMP'
            && $ext != 'gif'
            && $ext != 'GIF'
            && $ext != 'svg'
            && $ext != 'SVG'
        ){
            return false;
        }
        ini_set("gd.jpeg_ignore_warning", 1);
        do{
            $name = $this->generateRandomString(50).'.'.$ext;
        }while(Photo::where('name', $name)->count() > 0 );
        $dimens = explode("x", $dimensions);

        if(Image::make($photo)->fit($dimens[0], $dimens[1], function ($contraint){})->save('storage/images/'.$name)){
            $img = new Photo();
            $img->name = $name;
            $img->native = $model;
            $img->dimension = $dimensions;
            $img->nativeid = $nativeid;
            if($img->save()){
                return true;
            }
        }

        return false;
    }

    public function generateRandomString($length = 4) {
        $characters = '23456789ABCEFGHJKMNPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
