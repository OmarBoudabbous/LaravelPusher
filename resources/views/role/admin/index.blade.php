<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>Admin & Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesdesign" name="author" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <!-- Toastr JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <!-- Pusher JavaScript -->
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>


    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('backend/assets/images/favicon.ico') }}">

    <!-- Bootstrap Css -->
    <link href="{{ asset('backend/assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet"
        type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('backend/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('backend/assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />

</head>

<body data-topbar="dark">

    <!-- <body data-layout="horizontal" data-topbar="dark"> -->

    <!-- Begin page -->
    <div id="layout-wrapper">

        @include('role.layout.header')

        <!-- ========== Left Sidebar Start ========== -->
        @include('role.layout.left_side_bar')
        <!-- Left Sidebar End -->



        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <!-- start page title -->
                    @yield('content')
                    <!-- end page title -->

                </div> <!-- container-fluid -->
            </div>
            <!-- End Page-content -->

            @include('role.layout.footer')

        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->


    <!-- JAVASCRIPT -->
    <script src="{{ asset('backend/assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/node-waves/waves.min.js') }}"></script>

    <script src="{{ asset('backend/assets/js/app.js') }}"></script>


    {{-- toast for the message err --}}
    <script>
        @if (Session::has('message'))
            var type = "{{ Session::get('alert-type', 'info') }}"
            switch (type) {
                case 'info':
                    toastr.info(" {{ Session::get('message') }} ");
                    break;

                case 'success':
                    toastr.success(" {{ Session::get('message') }} ");
                    break;

                case 'warning':
                    toastr.warning(" {{ Session::get('message') }} ");
                    break;

                case 'error':
                    toastr.error(" {{ Session::get('message') }} ");
                    break;
            }
        @endif
    </script>

    {{-- script from pusher   --}}
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script>
        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher('284c8af045dfa5939d8d', {
            cluster: 'eu'
        });

        var channel = pusher.subscribe('my-channel');
        channel.bind('my-event', function(data) {
            alert(JSON.stringify(data));
        });
    </script>

    {{-- for the notification --}}
    <style>
        /* Custom style for Toastr notifications */
        .toast-info .toast-message {
            display: flex;
            align-items: center;
        }

        .toast-info .toast-message i {
            margin-right: 10px;
        }

        .toast-info .toast-message .notification-content {
            display: flex;
            flex-direction: row;
            align-items: center;
        }

        div#toast-container {
            margin-top: 70px !important;
        }
    </style>

    @if (Auth::user()->role === 'admin')
        <script>
            Pusher.logToConsole = true;

            // Initialize Pusher
            var pusher = new Pusher('284c8af045dfa5939d8d', {
                cluster: 'eu'
            });

            // Subscribe to the channel
            var channel = pusher.subscribe('notification');

            // Bind to the event
            channel.bind('test.notification', function(data) {
                console.log('Received data:', data); // Debugging line

                // Display Toastr notification with icons and inline content
                if (data.voie && data.type && data.id && data.user && data.matricule) {
                    toastr.info(
                        `<div 
                            style="padding: 10px; display: flex; flex-direction: column; gap: 10px; font-family: Arial, sans-serif; cursor: pointer;"
                            onclick="redirectToPanne(${data.id})">
                            <!-- Clickable Section -->
                            <div style="display: flex; align-items: center; gap: 15px; background-color: #f8f9fa; padding: 10px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
                                <div style="display: flex; align-items: center; gap: 10px; font-size: 14px; color: #343a40;">
                                    <i class="fas fa-user" style="color: #007bff;"></i>
                                    <span><strong>${data.user}</strong></span>
                                </div>
                                <div style="display: flex; align-items: center; gap: 10px; font-size: 14px; color: #343a40;">
                                    <i class="fas fa-id-card" style="color: #28a745;"></i>
                                    <span>${data.matricule}</span>
                                </div>
                            </div>
                            <div style="display: flex; align-items: center; gap: 15px; background-color: #f8f9fa; padding: 10px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
                                <div style="display: flex; align-items: center; gap: 10px; font-size: 14px; color: #343a40;">
                                    <i class="fas fa-road" style="color: #ffc107;"></i>
                                    <span>${data.voie}</span>
                                </div>
                                <div style="display: flex; align-items: center; gap: 10px; font-size: 14px; color: #343a40;">
                                    <i class="fas fa-exclamation-circle" style="color: #dc3545;"></i>
                                    <span>${data.type}</span>
                                </div>
                            </div>
                     </div>`,
                        'New Panne Notification', {
                            closeButton: true,
                            progressBar: true,
                            timeOut: 0, // Set timeOut to 0 to make it persist until closed
                            extendedTimeOut: 0, // Ensure the notification stays open
                            positionClass: 'toast-top-right',
                            enableHtml: true
                        }
                    );
                } else {
                    console.error('Invalid data received:', data);
                }
            });

            // Function to redirect to the panne page
            function redirectToPanne(id) {
                // Replace 'your-route-url' with the actual route URL pattern
                window.location.href = `/admin/panne/${id}`;
            }

            // Debugging line
            pusher.connection.bind('connected', function() {
                console.log('Pusher connected');
            });
        </script>
    @endif
</body>

</html>
