@section('title', 'Add Employe')
@extends('layout.app')

@section('main-content')
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <div class="card shadow">
                    <div class="card-header px-5 py-3 bg-dark text-white">
                        <div class="d-flex justify-content-between align-items-center">
                            <button onclick="window.history.back()" class="btn btn-primary"><-Back </button>
                                    <h4 class="mb-0"> Edit Employe</h4>
                        </div>
                    </div>
                    <div class="card-body px-5">

                        <form action="{{ route('employe.update', $employee->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <!-- Name -->
                            <div class="mb-3">
                                <label for="name" class="form-label"> Name *</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" name="name" placeholder="Enter student name"
                                    value="{{ $employee->name }}">
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ ucwords($message) }}
                                    </div>
                                @enderror
                            </div>
                            <!-- Class -->
                            <div class="mb-3">
                                <label for="class" class="form-label">Department *</label>
                                <select class="form-select @error('department') is-invalid @enderror" id="class"
                                    name="department">
                                    <option selected disabled>Select Department</option>
                                    <option value="Merketing" {{ $employee->department == 'Merketing' ? 'selected' : '' }}>
                                        Merketing
                                    </option>
                                    <option value="HR" {{ $employee->department == 'HR' ? 'selected' : '' }}>HR
                                    </option>
                                    <option value="IT" {{ $employee->department == 'IT' ? 'selected' : '' }}>IT</option>
                                    <option value="Accounting"
                                        {{ $employee->department == 'Accounting' ? 'selected' : '' }}>
                                        Accounting</option>
                                </select>
                                @error('department')
                                    <div class="invalid-feedback">
                                        {{ ucwords($message) }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Gender -->
                            <div class="mb-3">
                                <label class="form-label">Gender *</label>
                                <div class="">
                                    <div class="form-check form-check-inline @error('gender') is-invalid @enderror">
                                        <input class="form-check-input" type="radio" name="gender" id="male"
                                            value="Male" {{ $employee->gender == 'male' ? 'checked' : '' }}>
                                        <label class="form-check-label " for="male">Male</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input " type="radio" name="gender" id="female"
                                            value="Female" {{ $employee->gender == 'female' ? 'checked' : '' }}>
                                        <label class="form-check-label " for="female">Female</label>
                                    </div>
                                    @error('gender')
                                        <div class="invalid-feedback">
                                            {{ ucwords($message) }}
                                        </div>
                                    @enderror
                                </div>

                            </div>

                            <!-- Blood Group -->
                            <div class="mb-3">
                                <label for="blood_group" class="form-label">Blood Group *</label>
                                <select class="form-select @error('blood_group') is-invalid @enderror" id="blood_group"
                                    name="blood_group">
                                    <option value="" selected disabled>Select blood group</option>
                                    <option value="A+" {{ $employee->blood_group == 'A+' ? 'selected' : '' }}>A+
                                    </option>
                                    <option value="A-" {{ $employee->blood_group == 'A-' ? 'selected' : '' }}>A-
                                    </option>
                                    <option value="B+" {{ $employee->blood_group == 'B+' ? 'selected' : '' }}>B+
                                    </option>
                                    <option value="B-" {{ $employee->blood_group == 'B-' ? 'selected' : '' }}>B-
                                    </option>
                                    <option value="O+" {{ $employee->blood_group == 'O+' ? 'selected' : '' }}>O+
                                    </option>
                                    <option value="O-" {{ $employee->blood_group == 'O-' ? 'selected' : '' }}>O-
                                    </option>
                                    <option value="AB+" {{ $employee->blood_group == 'AB+' ? 'selected' : '' }}>AB+
                                    </option>
                                    <option value="AB-" {{ $employee->blood_group == 'AB-' ? 'selected' : '' }}>AB-
                                    </option>
                                </select>
                                @error('blood_group')
                                    <div class="invalid-feedback">
                                        {{ ucwords($message) }}
                                    </div>
                                @enderror
                            </div>
                            <!-- Photo Upload -->
                            <div class="row mb-3">
                                <div class="col-6">
                                    <label for="photo" class="form-label">Upload Photo *</label>
                                    <input
                                        class="form-control @error('photo')
                                    is-invalid
                                @enderror"
                                        type="file" id="photo" name="photo" accept="image/*"
                                        onchange="previewImage(event)">
                                    @error('photo')
                                        <div class="invalid-feedback">
                                            {{ ucwords($message) }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    {{-- Preview image --}}
                                    <div class="mt-2 border border-dark "
                                        style="height: 200px; width: 200px; border-style: dashed !important;">
                                        <img id="preview" src="{{ asset($employee->photo) }}"
                                            class="rounded border w-100 h-100">
                                    </div>
                                </div>
                            </div>

                            <!-- Submit -->
                            <button type="submit" class="btn btn-success"><i class="bi bi-save"></i> Update</button>
                            <button type="reset" class="btn btn-secondary">Reset</button>

                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
<script>
    function previewImage(event) {
        const reader = new FileReader();
        const preview = document.getElementById('preview');

        reader.onload = function() {
            preview.src = reader.result;
            preview.style.display = 'block';
        }

        reader.readAsDataURL(event.target.files[0]);
    }
</script>
