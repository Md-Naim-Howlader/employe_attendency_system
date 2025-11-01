<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="img/favicon.png" type="image/x-icon">
    <title> @yield('title') - {{ config('app.name') }}</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/sweetalert2/sweetalert2.min.css') }}">
    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
    @endif
    <style>
        .toast-success {
            background-color: green !important;
            box-shadow: none;
            color: #fff !important;
        }

        .toast-error {
            background-color: #dc3545 !important;
            box-shadow: none;
            color: #fff !important;
        }

        .toast-info {
            background-color: #17a2b8 !important;
            box-shadow: none;
            color: #fff !important;
        }

        .toast-warning {
            background-color: #ffc107 !important;
            box-shadow: none;
            color: #000 !important;

        }

        #toast-container>div {
            opacity: 1 !important;
            box-shadow: none !important;
        }
    </style>
</head>

<body>

    @include('layout.partials.header')
    <main class="min-h-[72vh]">
        @yield('main-content')
    </main>
    @include('layout.partials.footer')
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    {{-- toast message --}}

    <script>
        @if (session('success'))
            toastr.success("{{ session('success') }}");
        @endif

        @if (session('error'))
            toastr.error("{{ session('error') }}");
        @endif

        @if (session('warning'))
            toastr.warning("{{ session('warning') }}");
        @endif

        @if (session('info'))
            toastr.info("{{ session('info') }}");
        @endif
        toastr.options = {
            closeButton: true,
            progressBar: true,
            positionClass: "toast-bottom-right",
            timeOut: 2000,
            tapToDismiss: true
        };
    </script>
    <script>
        $(document).on("click", "#delete", function(e) {
            e.preventDefault(); // Prevent default behavior
            let link = $(this).attr("href"); // Get the link of the delete button

            Swal.fire({
                    title: "Are you sure you want to delete?",
                    text: "Once deleted, this will be permanently gone!",
                    icon: "warning",
                    showCancelButton: true, // Show cancel button
                    confirmButtonColor: "#3085d6", // Confirm button color
                    cancelButtonColor: "#d33", // Cancel button color
                    confirmButtonText: "Yes, delete it!", // Button text for confirmation
                })
                .then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = link; // If confirmed, redirect to delete link
                    } else {
                        Swal.fire("Safe data!");
                    }
                });
        });
    </script>
    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: 'Are you sure to Delete ?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            })
        }
    </script>


</body>

</html>
