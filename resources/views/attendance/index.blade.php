@section('title', 'Home')
@extends('layout.app')

<style>
    .nav-pills button {
        background: #fff;
        color: #000;
        margin-left: 10px;

    }
</style>

@section('main-content')
    <div class="container mt-5 mb-5">


        <!-- Date Filter -->
        {{-- <div class="row mb-3">
            <div class="col-md-4">
                <input type="date" class="form-control" />
            </div>
            <div class="col-md-2">
                <button class="btn btn-primary w-100">Filter</button>
            </div>
            <div class="col-md-6 text-end">
                <h2>Today Date: {{ Date('d-M-Y') }}</h2>
            </div>
        </div> --}}
        <div class="">
            <div class="row ">
                <div class="col-lg-3"></div>
                <div class="col-lg-6 text-center">
                    <ul class="nav nav-pills mb-3 " id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home"
                                aria-selected="true">
                                Take Attendence Today

                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile"
                                aria-selected="false">
                                Complete Attendance
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact"
                                aria-selected="false">
                                Incomplete attendance
                            </button>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-3"></div>
            </div>

            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">

                    <div class="table-responsive">
                        @if ($alreadyTaken)
                            <h2 class="mb-4 text-center">✅ Attendance Already Taken Today: {{ Date('d-M-Y') }}</h2>
                        @else
                            <h2 class="mb-4 text-center">Take Attendance for: {{ Date('d-M-Y') }}</h2>
                        @endif

                        <form action="{{ route('attendance.store', Date('d-M-Y')) }}" method="POST" class="border p-3">
                            @csrf
                            <table class="table table-bordered table-hover align-middle text-center">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Sl No</th>
                                        <th>Photo</th>
                                        <th>Name</th>
                                        <th>Id No</th>
                                        <th>Gender</th>
                                        <th>Blood Group</th>
                                        <th>Attandance</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($employees)
                                        <?php $i = 0; ?>

                                        @foreach ($employees as $employee)
                                            <tr>
                                                <td>{{ ++$i }}</td>
                                                <td><img style="height: 50px; width: 50px"
                                                        src="{{ asset($employee->photo) }}" alt="photo"></td>
                                                <td>{{ $employee->name }}</td>
                                                <td>{{ $employee->employee_id }}</td>
                                                <td>{{ $employee->gender }}</td>
                                                <td>{{ $employee->blood_group }}</td>
                                                <td>
                                                    <div class="d-flex justify-content-evenly">
                                                        <label>
                                                            P
                                                            <input class="form-check-input" type="radio"
                                                                name="attendance[{{ $employee->employee_id }}]"
                                                                value="Present">
                                                        </label>
                                                        <label>
                                                            A
                                                            <input class="form-check-input" type="radio"
                                                                name="attendance[{{ $employee->employee_id }}]"
                                                                value="Absent">
                                                        </label>
                                                    </div>
                                                </td>

                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>

                                        </tr>
                                    @endif
                                </tbody>

                            </table>
                            <div class="text-end">
                                <button @if ($alreadyTaken) disabled @endif type="submit"
                                    class="btn btn-success px-4 btn-lg">Submit Attendance</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                    <div class="table-responsive">
                        <h2 class="mb-4 text-center">Complete Attendance List</h2>
                        <table class="table table-bordered table-hover text-center align-middle">
                            <thead class="table-dark">
                                <tr>
                                    <th>Sl No</th>
                                    <th>Date</th>
                                    <th>Attendance Status</th>
                                    <th>Total Present</th>
                                    <th>Total Absent</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 0; ?>
                                @foreach ($attendanceSummary as $date)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td>{{ \Carbon\Carbon::parse($date->att_date)->format('d-F-Y') }}</td>
                                        <td>
                                            <button class="btn btn-success">Done</button>
                                        </td>
                                        <td>{{ $date->total_present }}</td>
                                        <td>{{ $date->total_absent }}</td>
                                        <td>

                                            <a href="{{ route('attendance.edit', $date->att_date) }}"
                                                class="btn btn-primary">
                                                <i class="bi bi-pencil"></i></a>
                                            <a id="delete" class="btn btn-danger"
                                                href="{{ route('attendance.delete', $date->att_date) }}"><i
                                                    class="bi bi-trash"></i></a>
                                        </td>
                                    </tr>
                                @endforeach



                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                    <div class="table-responsive">
                        <h2 class="mb-4 text-center">Incomplete Attendance List</h2>
                        <table class="table table-bordered table-hover text-center align-middle">
                            <thead class="table-dark">
                                <tr>
                                    <th>Sl No</th>
                                    <th>Date</th>
                                    <th>Attendance Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 0; ?>
                                @foreach ($notAttendedDates as $date)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td>{{ \Carbon\Carbon::parse($date)->format('d-F-Y') }}</td>
                                        <td>
                                            <button class="btn btn-Warning">No Taken</button>
                                        </td>

                                        <td>
                                            <a href="{{ route('attendance.take', $date) }}"
                                                class="btn btn-sm btn-primary">Take Now</a>
                                        </td>
                                    </tr>
                                @endforeach



                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>



    </div>

@endsection
