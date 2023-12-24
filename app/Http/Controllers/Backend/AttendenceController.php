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

        $allData = Attendance::orderBy('id', 'desc')->get();

        return view('backend.attendence.view_employee_attend', compact('allData'));
    }

    public function AddEmployeeAttendence() {

        $employees = Employee::all();

        return view('backend.attendence.add_employee_attend', compact('employees'));
    }
}