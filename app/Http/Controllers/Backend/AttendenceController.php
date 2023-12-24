<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Models\Attendance;
use Carbon\Carbon;

class AttendenceController extends Controller
{
    public function EmployeeAttendenceList() {

        $allData = Attendance::select('date')->groupBy('date')->orderBy('id', 'desc')->get();

        return view('backend.attendence.view_employee_attend', compact('allData'));
    }

    public function AddEmployeeAttendence() {

        $employees = Employee::all();

        return view('backend.attendence.add_employee_attend', compact('employees'));
    }

    public function EmployeeAttendenceStore(Request $request) {

        $countemployee = count($request->employee_id);

        for ($i=0; $i < $countemployee; $i++) {
            $attend_status = 'attend_status'.$i;

            $attend = new Attendance();
            $attend->date = date('Y-m-d', strtotime($request->date));
            $attend->employee_id = $request->employee_id[$i];
            $attend->attend_status = $request->$attend_status;

            $attend->save();
        }

        $notification = array(
            'message' => 'Data Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('employee.attend.list')->with($notification);
    }

    public function EditEmployeeAttendence($date) {

        $employees = Employee::all();
        $editData = Attendance::where('date',$date)->get();

        return view('backend.attendence.edit_employee_attend', compact('employees', 'editData'));

   }
}