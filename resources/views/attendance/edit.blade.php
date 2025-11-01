@section('title', 'Home')
@extends('layout.app')
@section('main-content')

    <main>
        <section class="table-responsive">

            <h2 class="mb-4 text-center"> Edit Attendance: {{ \Carbon\Carbon::parse($editDate)->format('d-F-Y') }}</h2>


            <form action="{{ route('attendance.update', $editDate) }}" method="POST" class="border p-3">
                @csrf
                @method('PATCH')
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
                        @if ($getAttByDate)
                            <?php $i = 0; ?>

                            @foreach ($getAttByDate as $employee)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td><img style="height: 50px; width: 50px" src="{{ asset($employee->photo) }}"
                                            alt="photo"></td>
                                    <td>{{ $employee->name }}</td>
                                    <td>{{ $employee->employee_id }}</td>
                                    <td>{{ $employee->gender }}</td>
                                    <td>{{ $employee->blood_group }}</td>

                                    <td>
                                        <div class="d-flex justify-content-evenly">
                                            <label>
                                                P
                                                <input @if ($employee->att_status == 'Present') checked @endif
                                                    class="form-check-input" type="radio"
                                                    name="attendance[{{ $employee->employee_id }}]" value="Present">
                                            </label>
                                            <label>
                                                A
                                                <input @if ($employee->att_status == 'Absent') checked @endif
                                                    class="form-check-input" type="radio"
                                                    name="attendance[{{ $employee->employee_id }}]" value="Absent">
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
                    <button type="submit" class="btn btn-success px-4 btn-lg">Update Attendance</button>
                </div>
            </form>
            </div>
    </main>
@endsection
