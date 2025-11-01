@section('title', 'Home')
@extends('layout.app')

@section('main-content')
    <!-- Main Content -->
    <div class="container my-4">

        <div class=" py-4">
            <h2 class="mb-4 fw-bold text-center">Employee Management Dashboard</h2>

            <div class="row g-4">
                <div class="col-md-3 col-sm-6">
                    <div class="dashboard-card text-center">
                        <div class="card-icon text-primary mb-2"><i class="bi bi-people-fill"></i></div>
                        <h5 class="card-title">Total Employees</h5>
                        <h3 class="fw-bold text-dark">{{ $totalEmployee }}</h3>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="dashboard-card text-center">
                        <div class="card-icon text-success mb-2"><i class="bi bi-person-check-fill"></i></div>
                        <h5 class="card-title">Present Today</h5>
                        <h3 class="fw-bold text-dark">{{ $totalPresentToday }}</h3>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="dashboard-card text-center">
                        <div class="card-icon text-danger mb-2"><i class="bi bi-person-x-fill"></i></div>
                        <h5 class="card-title">Absent Today</h5>
                        <h3 class="fw-bold text-dark">{{ $totalAbsentToday }}</h3>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="dashboard-card text-center">
                        <div class="card-icon text-warning mb-2"><i class="bi bi-calendar-event-fill"></i></div>
                        <h5 class="card-title">On Leave</h5>
                        <h3 class="fw-bold text-dark">10</h3>
                    </div>
                </div>
            </div>

            <div class="row g-4 mt-2">
                <div class="col-md-3 col-sm-6">
                    <div class="dashboard-card text-center">
                        <div class="card-icon text-info mb-2"><i class="bi bi-person-plus-fill"></i></div>
                        <h5 class="card-title">New Joinees</h5>
                        <h3 class="fw-bold text-dark">5</h3>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="dashboard-card text-center">
                        <div class="card-icon text-secondary mb-2"><i class="bi bi-box-arrow-right"></i></div>
                        <h5 class="card-title">Resigned</h5>
                        <h3 class="fw-bold text-dark">3</h3>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="dashboard-card text-center">
                        <div class="card-icon text-success mb-2"><i class="bi bi-graph-up-arrow"></i></div>
                        <h5 class="card-title">Attendance Rate</h5>
                        <h3 class="fw-bold text-dark">89%</h3>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="dashboard-card text-center">
                        <div class="card-icon text-dark mb-2"><i class="bi bi-diagram-3-fill"></i></div>
                        <h5 class="card-title">Departments</h5>
                        <h3 class="fw-bold text-dark">6</h3>
                    </div>
                </div>
            </div>
        </div>



    </div>
@endsection
