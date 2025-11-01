<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Employee;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DateInterval;
use DatePeriod;
use DateTime;
use Illuminate\Support\Facades\DB;

class AttendanceController extends Controller
{
    public function index()
    {
        $today = Carbon::today()->toDateString();
        $employees = Employee::all();
        $alreadyTaken = Attendance::whereDate('att_date', $today)->exists();
        $attendanceSummary =  $this->getAttendDate();

        $notAttendedDates = $this->getNoAttendDates();
        return view("attendance.index", compact("employees", "alreadyTaken", "attendanceSummary", "notAttendedDates"));
    }
    public function store(Request $request, $date = null)
    {
        if($date) {
            $date = Carbon::parse($date)->toDateString();
        } else {
            $date = Carbon::today()->toDateString();

        }
        $attendances = $request->attendance;

        //  Missing attendance check
        $allEmployees = Employee::pluck('employee_id')->toArray();
        $missing = array_diff($allEmployees, array_keys($attendances ?? []));

        if (!empty($missing)) {
            $missingStr = implode(', ', $missing);
            return back()->with('error', "Error: Attendance missing for Employee IDs: $missingStr");
        }

        //  Already taken check
        $exists = Attendance::whereDate('att_date', $date)->exists();
        if ($exists) {
            return back()->with('error', 'Error: Attendance already taken for today!');
        }

        // Insert all attendance
        foreach ($attendances as $employeeId => $status) {
            Attendance::create([
                'employee_id' => $employeeId,
                'att_status' => $status,
                'att_date' => $date,
            ]);
        }

        return back()->with('success', 'Success: Attendance saved successfully!');
    }
    public function edit($date)
    {
        $editDate = $this->getAttendDate()[0]->att_date;

        $getAttByDate = DB::table('attendances')
            ->join('employees', 'attendances.employee_id', '=', 'employees.employee_id')
            ->select('attendances.*', 'employees.*')
            ->get();

        return view("attendance.edit", compact("getAttByDate", "editDate"));
    }
    public function update(Request $request, $date)
    {

        $attendanceData = $request->attendance;

        foreach ($attendanceData as $employee_id => $attend) {

            Attendance::where('employee_id', $employee_id)
                ->where('att_date', $date)
                ->update([
                    'att_status' => $attend,
                    'updated_at' => now(),
                ]);
        }
        return redirect()->route('attendance.index')->with('success', 'Attendance updated successfully!');
    }

    public function destroy($date)
    {
        $findDateByDate = Attendance::where("att_date", $date)->get();

        foreach ($findDateByDate as $dateData) {
            // echo $dateData->att_date;
            DB::table("attendances")->where("att_date", $dateData->att_date)->delete();
        }
        return redirect()->back()->with("success", "Attendance Deleted Successfully!");
    }

    // Helper functions
    public function getNoAttendDates()
    {
        $startOfMonth = date('Y-m-01');
        $endOfMonth = date('Y-m-t');
        $period = new DatePeriod(
            new DateTime($startOfMonth),
            new DateInterval('P1D'),
            (new DateTime($endOfMonth))->modify('+1 day')
        );

        $allDates = [];
        foreach ($period as $date) {
            $allDates[] = $date->format('Y-m-d');
        }

        $attendedDates = Attendance::whereMonth('att_date', now()->month)
            ->whereYear('att_date', now()->year)
            ->pluck('att_date')
            ->toArray();

        $notAttendedDates = array_diff($allDates, $attendedDates);

        return $notAttendedDates;
    }
    public function getAttendDate()
    {
        $dates = Attendance::select('att_date')
            ->distinct()
            ->orderBy('att_date', 'desc')
            ->get()
            ->map(function ($item) {
                $date = $item->att_date;

                $item->total_present = Attendance::where('att_date', $date)
                    ->where('att_status', 'Present')
                    ->count();

                $item->total_absent = Attendance::where('att_date', $date)
                    ->where('att_status', 'Absent')
                    ->count();

                return $item;
            });
        return $dates;
    }

   public function takeAttendancePrevNoTaken($date) {
    $today = Carbon::today()->toDateString();
        $employees = Employee::all();
        $attendanceSummary =  $this->getAttendDate();
        return view('attendance.takeAttendance', compact('employees', 'date'));
   }
}
