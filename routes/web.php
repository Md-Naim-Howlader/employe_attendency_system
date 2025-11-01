<?php

use App\Http\Controllers\AttendanceController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Models\Attendance;
use App\Models\Employee;
use Carbon\Carbon;

Route::get('/', function () {
    $totalEmployee = Employee::all()->count();
    $today = Carbon::today()->toDateString();
    $totalPresentToday = Attendance::where('att_status', 'Present')
        ->whereDate('att_date', $today)
        ->count();
    $totalAbsentToday = Attendance::where('att_status', 'Absent')
        ->whereDate('att_date', $today)
        ->count();


    return view('home', compact("totalEmployee", "totalPresentToday", "totalAbsentToday"));
});

Route::resource('employe', EmployeeController::class);
Route::get("/attendance", [AttendanceController::class, "index"])->name("attendance.index");
Route::post("/attendance/store{date}", [AttendanceController::class, "store"])->name("attendance.store");
Route::get("/attendance/edit/{date}", [AttendanceController::class, "edit"])->name("attendance.edit");
Route::Patch("/attendance/update/{date}", [AttendanceController::class, "update"])->name("attendance.update");
Route::get("/attendance/delete/{date}", [AttendanceController::class, "destroy"])->name("attendance.delete");
Route::get("/attendance/take/{date}", [AttendanceController::class, "takeAttendancePrevNoTaken"])->name("attendance.take");
