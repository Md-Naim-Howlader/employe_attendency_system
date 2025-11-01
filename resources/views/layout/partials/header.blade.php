 <nav class="navbar navbar-expand-lg navbar-dark bg-dark  shadow-sm py-4">
     <div class="container ">
         <a class="navbar-brand fw-bold" href="/">EMS</a>
         <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
             <span class="navbar-toggler-icon"></span>
         </button>


         <ul class="navbar-nav mx-auto">
             <li class="nav-item"><a class="nav-link" href="{{ url('/') }}"><i class="bi bi-speedometer2 me-1"></i>
                     Dashboard</a></li>
             <li class="nav-item"><a class="nav-link" href="{{ route('employe.index') }}"><i
                         class="bi bi-people me-1"></i> Employes</a></li>
             <li class="nav-item"><a class="nav-link" href="{{ route('attendance.index') }}"><i
                         class="bi bi-calendar-check me-1"></i> Attendance</a></li>

         </ul>

         <!-- Right Side -->
         <div class="d-flex align-items-center">
             <span class="text-white me-2">Admin</span>
             <img src="" class="rounded-circle" alt="admin">
         </div>
     </div>
 </nav>
