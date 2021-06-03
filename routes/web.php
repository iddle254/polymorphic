<?php

use Illuminate\Support\Facades\Route;
use App\Models\Staff;
use App\Models\Photo;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/create', function(){
    $staff = Staff::findOrFail(1);
    $staff->photos()->create(['path'=>'example3.jpg']);
});

Route::get('/read', function(){
    $staff = Staff::findOrFail(2);
    foreach($staff->photos as $photo){
        return $photo->path;
    }
});

Route::get('/update', function(){
    $staff = Staff::findOrFail(2);
    $photo = $staff->photos()->whereId(2)->first();
    $photo->path = "updated example.jpg";
    $photo->save();
});

Route::get('/delete', function(){
    $staff = Staff::findOrFail(0);
    $staff->photos()->whereId(1)->delete();
});

Route::get('/assign', function(){
    $staff = Staff::findOrFail(2);
    $photo = Photo::findOrFail(6);
    $staff->photos()->save($photo);
});