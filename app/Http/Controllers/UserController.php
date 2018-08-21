<?php

namespace App\Http\Controllers;

use App\Photo;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;


class UserController extends Controller{
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
