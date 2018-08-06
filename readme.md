# Course Material Distribution and Attendance System

## Introduction

> For college kids and project level,

## Code Samples



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

## Installation

Just pull and:
> composer install
> 
> Edit the .env file to fit your database and other parameter
> 
> php artisan key:generate
>
> php artisan migrate
>
> php artisan serve
> 
> Go to your browser and browse "localhost/8000"
> 
> Your system should be up and running then
