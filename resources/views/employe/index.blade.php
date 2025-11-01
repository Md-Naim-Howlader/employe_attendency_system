@section('title', 'Employe')
@extends('layout.app')

@section('main-content')
    <div class="container mt-4">
        <!-- Page Header -->
        <div class="card shadow-sm">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h3 class="text-dark">Employee List</h3>
                    <a href="{{ route('employe.create') }}" class="btn btn-success">
                        + Add Employee
                    </a>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover align-middle text-center">
                    <thead class="table-dark">
                        <tr>
                            <th>Sl No</th>
                            <th>Photo</th>
                            <th>Name</th>
                            <th>Id No</th>
                            <th>Gender</th>
                            <th>Blood Group</th>
                            <th>Join Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($employees)
                            <?php $i = 0; ?>
                            @foreach ($employees as $employee)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td><img style="height: 50px; width: 50px" src="{{ asset($employee->photo) }}"
                                            alt="photo"></td>
                                    <td>{{ $employee->name }}</td>
                                    <td>{{ $employee->employee_id }}</td>
                                    <td>{{ $employee->gender }}</td>
                                    <td>{{ $employee->blood_group }}</< /td>
                                    <td>{{ Date($employee->join_date) }}</< /td>
                                    <td>


                                        <a href="{{ route('employe.edit', $employee->id) }}"
                                            class="btn btn-sm btn-primary"><i class="bi bi-pencil"></i></a>

                                        <form id="delete-form-{{ $employee->id }}"
                                            onclick=" confirmDelete({{ $employee->id }})"
                                            action="{{ route('employe.destroy', $employee->id) }}" method="POST"
                                            class="d-inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-sm btn-danger"><i
                                                    class="bi bi-trash"></i></button>
                                        </form>


                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>

                            </tr>
                        @endif


                    </tbody>
                </table>

            </div>
        </div>
    </div>
@endsection
