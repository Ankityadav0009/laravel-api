<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group([ 'prefix' => 'auth'], function ($router) {

    Route::post('login', [AuthController::class,'login']);
    Route::post('register', [AuthController::class,'register']);

});
Route::middleware (['auth:api'])->group(function(){
    Route::post('me', [AuthController::class,'me']);
    Route::post('refresh', [AuthController::class,'refresh']);
    Route::post('logout', [AuthController::class,'logout']);


});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//All Employees
Route::post('employee', [EmployeeController::class, 'getEmployee']);

//Specific Employees
Route::get('employee/{id}', [EmployeeController::class, 'getEmployeebyId']);

//Add Employee
Route::post('addEmployee', [EmployeeController::class, 'addEmployee']);

//update employee
Route::post('updateEmployee', [EmployeeController::class, 'updateEmployee']);

//Delete Employee
Route::delete('deleteEmployee/{id}', [EmployeeController::class, 'deleteEmployee']);
//Delete checked Employee
Route::post('deleteMultipleEmployees', [EmployeeController::class, 'deleteMultiple']);

//Add Employee
Route::post('store', [EmployeeController::class, 'store']);
