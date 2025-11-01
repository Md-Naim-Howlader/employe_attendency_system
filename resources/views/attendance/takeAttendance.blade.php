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
        <div class="">
            <div class="row ">
                <div class="col-lg-12 text-center">

                    <div class="table-responsive">

                        <h2 class="mb-4 text-center">Take Attendance for: {{ \Carbon\Carbon::parse($date)->format('d F Y') }}
                        </h2>


                        <form action="{{ route('attendance.store', $date) }}" method="POST" class="border p-3">
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
                                <button type="submit" class="btn btn-success px-4 btn-lg">Submit Attendance</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


        </div>



    </div>

@endsection
