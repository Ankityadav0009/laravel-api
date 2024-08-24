<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Employee;
use App\Models\Contact;

class EmployeeController extends Controller
{

    public function deleteMultiple(Request $request)
    {
        $input = $request->all();
        $ids = $input['delete_ids'];
        //request('delete_ids');
        DB::table('employees')->whereIn('id', $ids)->delete();
        // $input = $request->all();
        return response()->json(['status'=>true,'data'=>$request], 200);

    }
    public function getEmployee(Request $request) {


        $input = $request->all();

        if($input['input_filter'] !=''){
            $sql="SELECT * FROM `employees` WHERE `name` LIKE '%".$input['input_filter']."%' OR  `email` LIKE '%".$input['input_filter']."%'";
            $res = DB::select($sql);

            // $customer = DB::table('employees')->where('name','like','%'.$input['input_filter'].'%')->get();

            return response()->json(['status'=>true,'data'=>$res], 200);

        }else{
             $sql="SELECT * FROM `employees`";
            // $empData = Employee::all();
            $res = DB::select($sql);

            return response()->json(['status'=>true,'data'=>$res], 200);
        }

    }

    public function getEmployeebyId($id) {
        $employee = Employee::find($id);
        if(is_null($employee)) {
            return response()->json(['message' => 'Employee Not Founded'], 404);
        }

        return response()->json($employee::find($id), 200);
    }

    public function addEmployee(Request $request) {

    // $request->validate([
    //     'name' => 'required|string|max:255',
    //     'salary' => 'required|numeric',
    //     'email' => 'required|email|max:255',
    //     'country' => 'required|string|max:255',
    //     'image' => 'nullable|mimes:png,jpg,gif,jpeg,svg,pdf|max:2048',
    // ]);

    $imageName = '';
    $input = $request->all();

    if ($request->hasFile('img_ast')) {
        $file = $request->file('img_ast');
        $ext = $file->getClientOriginalExtension();


        $name = time() . "akkk"."." . $ext;
        $file->move(public_path('uploads/images'), $name);
        $imageName = $name;
    }

    $data = [
        'name' => $input['name'],
        'salary' => @$input['salary'],
        'email' => @$input['email'],
        'country' => @$input['country'],
        'image' => $imageName,
    ];

    $employee = Employee::create($data);
    return response($employee, 201);
    }

    public function updateEmployee(Request $request) {

    $imageName = '';
    $input = $request->all();
    $id = $input['id'];
    if ($request->hasFile('img_ast')) {
        $file = $request->file('img_ast');
        $ext = $file->getClientOriginalExtension();


        $name = time() . "ankit"."." . $ext;
        $file->move(public_path('uploads/images'), $name);
        $imageName = $name;
    }
    $data = [
        'name' => $request['name'],
        'salary' => @$request['salary'],
        'email' => @$request['email'],
        'country' => @$request['country']
    ];

    if($imageName != ''){
        $data['image'] = $imageName;
    }

    // $employee = Employee::all();
        $employee = Employee::find($id);
        if(is_null($employee)) {
            return response()->json(['message' => 'Employee Not Found'], 404);
        }
        $employee->update($data);

        // return response($data, 200);
        return response()->json(['status'=>true,'msg' => 'User data updated!'], 200);
    }

    public function deleteEmployee(Request $request, $id) {
        $employee = Employee::find($id);
        if(is_null($employee)) {
            return response()->json(['message' => 'Employee Not Found'], 404);
        }
        $employee->delete();
        return response()->json(null, 204);
    }



}
