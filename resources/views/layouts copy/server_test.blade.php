<!DOCTYPE html>
<html lang="en">

<head>
    @include('includes.head')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.13.1/datatables.min.css" />



    <style>
        .pagination>li>a,
        .pagination>li>span {
            background-color: white;
            color: #414b62;
        }

        .pagination>li.active>a,
        .pagination>li.active>span {
            background-color: #414b62;
            border: 1px solid #cbc3b1;
        }

        select,
        input[type=search] {
            box-shadow: none !important;
        }
    </style>
</head>

<body>

    <header>

    </header>

    <div class="wrapper">
        <nav id="sidebar">
            <ul class="list-unstyled components">
                <div class="container">
                    <!-- <center>
                        <img src="{{asset('/img/logo_385.jpg')}}" class="img-fluid mx-auto" width="75" height="75" alt="">
                    </center> -->
                    <div class="d-grid">
                        <a class=" text-decoration-none text-light fw-bold text-center mt-2 mb-4" href="/welcome-user">System Control Panel</a>
                    </div>

                    <!-- <p class="admin-card-text text-secondary text-center">Welcome, {{auth()->user()->name}}</p> -->
                    <span class="mt-2 text-secondary text-uppercase fw-bold" style="font-size:11px">Official Website</span>
                    <li><a class="text-decoration-none" href="/"><i class="ms-2 fa-solid fa-house me-2"></i>Barangay 385 Home</a></li>

                    @if(Auth::user()->user_type == 0)
                    <span class="mt-2 text-secondary text-uppercase fw-bold" style="font-size:11px">User Management</span>
                    <li><a class="text-decoration-none {{ (request()->is('users/*')) ? 'active-link' : '' }}" href="/users/index"><i class="ms-2 fa-solid fa-users me-2"></i>System Users</a></li>
                    <span class="mt-2 text-secondary text-uppercase fw-bold" style="font-size:11px">Database Summary</span>
                    <li class="{{ (request()->is('dashboard')) ? 'active-link' : '' }}"><a class="text-decoration-none" href="/dashboard"><i class="ms-2 fa-solid fa-chart-line me-2"></i>Dashboard</a></li>
                    <!-- <li><a class="text-decoration-none" href="/admin-panel/user-activity"><i class="ms-2 fa-solid fa-user-clock me-2"></i>User Activity</a></li> -->
                    @endif


                    @if(Auth::user()->user_type == 2 || Auth::user()->user_type == 0)
                    <span class="mt-2 text-secondary text-uppercase fw-bold" style="font-size:11px">Edit the Barangay Home page</span>
                    <div class="mt-1">
                        <li class="{{ (request()->is('links/*')) ? 'active-link' : '' }}"><a class="text-decoration-none" href="/links/index"><i class="ms-2 fa-solid fa-link me-2"></i>Quick Links</a></li>
                        <li class="{{ (request()->is('videos/*')) ? 'active-link' : '' }}"><a class="text-decoration-none" href="/videos/index"><i class="ms-2 fa-brands fa-youtube me-2"></i>Featured Videos</a></li>
                        <li class="{{ (request()->is('announcements/*')) ? 'active-link' : '' }}"><a class="text-decoration-none" href="/announcements/index"><i class="ms-2 fa-solid fa-bullhorn me-2"></i>Announcements</a></li>
                    </div>
                    @endif

                    @if(Auth::user()->user_type == 1 || Auth::user()->user_type == 0)
                    <span class="mt-2 text-secondary text-uppercase fw-bold" style="font-size:11px">Local Statistics</span>
                    <li class="{{ (request()->is('streets/*')) ? 'active-link' : '' }}"><a class="text-decoration-none" href="/streets/index"><i class="ms-2 fa-solid fa-house-user me-2"></i>Household Profiling</a></li>
                    <span class="mt-2 text-secondary text-uppercase fw-bold" style="font-size:11px">Tables</span>
                    <li class="{{ (request()->is('households_list')) ? 'active-link' : '' }}"><a class="text-decoration-none" href="/households_list"><i class="ms-2 fa-solid fa-house-circle-check me-2"></i>Households</a></li>
                    <li class="{{ (request()->is('residents/*')) ? 'active-link' : '' }}"><a class="text-decoration-none" href="/residents/index"><i class="ms-2 fa-solid fa-users-line me-2"></i>Residents</a></li>
                    @if(Auth::user()->user_type == 0)
                    <li class="{{ (request()->is('archive/residents')) ? 'active-link' : '' }}"><a class="text-decoration-none" href="/archive/residents"><i class="ms-2 fa-solid fa-box-archive me-2"></i>Archives</a></li>
                    @endif
                    @endif


                    @if(Auth::user()->user_type == 3 || Auth::user()->user_type == 0)
                    <span class="mt-2 text-secondary text-uppercase fw-bold" style="font-size:11px">Forms</span>
                    <li class="{{ (request()->is('certificates/index')) ? 'active-link' : '' }}"><a class="text-decoration-none" href="/certificates/index"><i class="ms-2 fa-solid fa-print me-2"></i>Form Logs</a></li>
                    <li class="{{ (request()->is('forms')) || (request()->is('forms/*')) ? 'active-link' : '' }}"><a class="text-decoration-none" href="/forms"><i class="ms-2 fa-solid fa-file-signature me-2"></i>Generate Forms</a></li>
                    @endif

                    @if(Auth::user()->user_type == 0 )
                    <!-- <span class="mt-2 text-secondary text-uppercase fw-bold" style="font-size:11px">Settings</span>
                    <li><a class="text-decoration-none" href="{{route('backup')}}"><i class="ms-2 fa-solid fa-cloud-arrow-up me-2"></i>Backup database</a></li> -->
                    @endif
                    <span class="mt-2 text-secondary text-uppercase fw-bold" style="font-size:11px">Help</span>
                    <li class="{{ (request()->is('welcome-user')) ? 'active-link' : '' }}"><a class="text-decoration-none" href="/welcome-user"><i class="ms-2 fa-solid fa-clipboard-question me-2"></i>User Manual</a></li>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <div class="d-grid">
                            <button class="btn btn-light admin-card-text mt-4" type="submit"> Log out</button>
                        </div>
                    </form>


                </div>
            </ul>

        </nav>

        <!-- Page Content  -->
        <div id="content" class="bg-light admin-card-text">
            <nav class="navbar navbar-expand-lg bg-white shadow-sm py-2">
                <a class="navbar-brand fw-normal" href="#" style="color:#414b62">
                    <button type="button" id="sidebarCollapse" class="btn btn-sm btn-light">
                        <!-- <i class="fa-solid fa-bars fa-flip" style="color:#414b62; --fa-animation-duration: 3s;"></i> -->
                        <i class="fa-solid fa-bars" style="color:#414b62;"></i>

                    </button>
                    <!-- @yield('title')  -->
                </a>
                <button class="navbar-toggler" class="btn btn-sm btn-light" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa-solid fa-user" style="color:#414b62;"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <div class="navbar-nav ms-auto">
                        <div class="container">
                            <a href="/user/profile" title="Profile Settings" class="text-dark" href="#">You are currently logged in as: {{auth()->user()->name}}


                                @if(auth()->user()->user_type == 0)
                                <span class="badge rounded-pill fw-normal" style="background-color:#08306b">Master</span>
                                @elseif(auth()->user()->user_type == 1)
                                <span class="badge rounded-pill fw-normal" style="background-color:#08519c">Profiling</span>
                                @elseif(auth()->user()->user_type == 2)
                                <span class="badge rounded-pill fw-normal" style="background-color:#2171b5">E-journalist</span>
                                @elseif(auth()->user()->user_type == 3)
                                <span class="badge rounded-pill fw-normal" style="background-color:#4292c6">Forms</span>
                                @endif


                            </a>
                        </div>
                    </div>
                </div>
            </nav>

            <div class="" style="padding:40px">

                @yield('content')
            </div>
        </div>
        <!-- Page Content  -->
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js" integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" crossorigin="anonymous"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>
    <script src="https://cdn.tiny.cloud/1/kogos4e3i28a6tb2dnuq31kw6wnycc1tc6pbredig4ew514h/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>
    <!-- Development -->
    <script src="https://unpkg.com/@popperjs/core@2/dist/umd/popper.min.js"></script>
    <script src="https://unpkg.com/tippy.js@6/dist/tippy-bundle.umd.js"></script>


    <script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>



    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.13.1/b-2.3.3/b-html5-2.3.3/b-print-2.3.3/datatables.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $("#sidebar").mCustomScrollbar({
                theme: "minimal"
            });

            $('#sidebarCollapse').on('click', function() {
                $('#sidebar, #content').toggleClass('active');
                $('.collapse.in').toggleClass('in');
                $('a[aria-expanded=true]').attr('aria-expanded', 'false');
            });
            const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
            const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))


        });
    </script>
    <script>
        $(document).ready(function() {
            $('#formTable').DataTable({
                "columnDefs": [{
                    "type": "date",
                    "targets": 2
                }]
            });

            $('#householdTable').DataTable({
                    "columnDefs": [{
                        "type": "date",
                        "targets": "Last Updated"
                    }],
                    dom: 'Blfrtip',
                    buttons: [

                        {
                            extend: 'pdfHtml5',
                            orientation: 'landscape',
                            pageSize: 'LEGAL',
                            className: 'bg-export',
                            exportOptions: {
                                columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]
                            }
                        },
                        {
                            extend: 'excelHtml5',
                            className: 'bg-export',
                            exportOptions: {
                                columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]
                            }
                        },
                        {
                            extend: 'csvHtml5',
                            className: 'bg-export',
                            exportOptions: {
                                columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]
                            }
                        },
                    ]
                }).buttons()
                .container()
                .appendTo("#outside");

            $('#residentTable').DataTable({
                    "columnDefs": [{
                        "type": "date",
                        "targets": "Last Updated"
                    }],
                    dom: 'Blfrtip',
                    buttons: [{
                            extend: 'pdfHtml5',
                            orientation: 'landscape',
                            pageSize: 'LEGAL',
                            className: 'bg-export',
                            exportOptions: {
                                columns: [1, 2, 3, 4, 5]
                            }
                        },
                        {
                            extend: 'excelHtml5',
                            className: 'bg-export',
                            exportOptions: {
                                columns: [1, 2, 3, 4, 5]
                            }
                        },
                        {
                            extend: 'csvHtml5',
                            className: 'bg-export',
                            exportOptions: {
                                columns: [1, 2, 3, 4, 5]
                            }
                        },
                    ]

                }).buttons()
                .container()
                .appendTo("#outside");
            $('#archiveTable').DataTable({
                "columnDefs": [{
                    "type": "date",
                    "targets": "Archive date"
                }]
            });
            $('#linkTable').DataTable({
                "columnDefs": [{}]
            });
            $('#announcementTable').DataTable({
                "columnDefs": [{
                    "type": "date",
                    "targets": "Published"
                }]
            });
            $('#userTable').DataTable({
                "columnDefs": [{
                    "type": "date",
                    "targets": "Last updated"
                }]
            });
            $('#bonafideTable').DataTable({
                    "columnDefs": [{
                        "type": "num-fmt",
                        "targets": "Age"
                    }],
                    dom: 'Blfrtip',
                    buttons: [{
                            extend: 'pdfHtml5',
                            orientation: 'landscape',
                            pageSize: 'LEGAL',
                            className: 'bg-export',
                            exportOptions: {
                                columns: [1, 2, 3, 4]
                            }
                        },
                        {
                            extend: 'excelHtml5',
                            className: 'bg-export',
                            exportOptions: {
                                columns: [1, 2, 3, 4]
                            }
                        },
                        {
                            extend: 'csvHtml5',
                            className: 'bg-export',
                            exportOptions: {
                                columns: [1, 2, 3, 4]
                            }
                        },
                    ]
                }).buttons()
                .container()
                .appendTo("#outside");
            $('#voterTable').DataTable({
                    "columnDefs": [{
                        "type": "num-fmt",
                        "targets": "Age"
                    }],
                    dom: 'Blfrtip',
                    buttons: [{
                            extend: 'pdfHtml5',
                            orientation: 'landscape',
                            pageSize: 'LEGAL',
                            className: 'bg-export',
                            exportOptions: {
                                columns: [1, 2, 3, 4]
                            }
                        },
                        {
                            extend: 'excelHtml5',
                            className: 'bg-export',
                            exportOptions: {
                                columns: [1, 2, 3, 4]
                            }
                        },
                        {
                            extend: 'csvHtml5',
                            className: 'bg-export',
                            exportOptions: {
                                columns: [1, 2, 3, 4]
                            }
                        },
                    ]
                }).buttons()
                .container()
                .appendTo("#outside");

            $('#seniorTable').DataTable({
                    "columnDefs": [{
                        "type": "num-fmt",
                        "targets": "Age"
                    }],
                    dom: 'Blfrtip',
                    buttons: [{
                            extend: 'pdfHtml5',
                            orientation: 'landscape',
                            pageSize: 'LEGAL',
                            className: 'bg-export',
                            exportOptions: {
                                columns: [1, 2, 3]
                            }
                        },
                        {
                            extend: 'excelHtml5',
                            className: 'bg-export',
                            exportOptions: {
                                columns: [1, 2, 3]
                            }
                        },
                        {
                            extend: 'csvHtml5',
                            className: 'bg-export',
                            exportOptions: {
                                columns: [1, 2, 3]
                            }
                        },
                    ]
                }).buttons()
                .container()
                .appendTo("#outside");

            $('#menTable').DataTable({
                    "columnDefs": [{
                        "type": "num-fmt",
                        "targets": "Age"
                    }],
                    dom: 'Blfrtip',
                    buttons: [{
                            extend: 'pdfHtml5',
                            orientation: 'landscape',
                            pageSize: 'LEGAL',
                            className: 'bg-export',
                            exportOptions: {
                                columns: [1, 2, 3, 4]
                            }
                        },
                        {
                            extend: 'excelHtml5',
                            className: 'bg-export',
                            exportOptions: {
                                columns: [1, 2, 3, 4]
                            }
                        },
                        {
                            extend: 'csvHtml5',
                            className: 'bg-export',
                            exportOptions: {
                                columns: [1, 2, 3, 4]
                            }
                        },
                    ]
                }).buttons()
                .container()
                .appendTo("#outside");

            $('#womenTable').DataTable({
                    "columnDefs": [{
                        "type": "num-fmt",
                        "targets": "Age"
                    }],
                    dom: 'Blfrtip',
                    buttons: [{
                            extend: 'pdfHtml5',
                            orientation: 'landscape',
                            pageSize: 'LEGAL',
                            className: 'bg-export',
                            exportOptions: {
                                columns: [1, 2, 3, 4]
                            }
                        },
                        {
                            extend: 'excelHtml5',
                            className: 'bg-export',
                            exportOptions: {
                                columns: [1, 2, 3, 4]
                            }
                        },
                        {
                            extend: 'csvHtml5',
                            className: 'bg-export',
                            exportOptions: {
                                columns: [1, 2, 3, 4]
                            }
                        },
                    ]
                }).buttons()
                .container()
                .appendTo("#outside");
            $('#womenchildrenTable').DataTable({
                    "columnDefs": [{
                        "type": "num-fmt",
                        "targets": "Age"
                    }],
                    dom: 'Blfrtip',
                    buttons: [{
                            extend: 'pdfHtml5',
                            orientation: 'landscape',
                            pageSize: 'LEGAL',
                            className: 'bg-export',
                            exportOptions: {
                                columns: [1, 2, 3, 4]
                            }
                        },
                        {
                            extend: 'excelHtml5',
                            className: 'bg-export',
                            exportOptions: {
                                columns: [1, 2, 3, 4]
                            }
                        },
                        {
                            extend: 'csvHtml5',
                            className: 'bg-export',
                            exportOptions: {
                                columns: [1, 2, 3, 4]
                            }
                        },
                    ]
                }).buttons()
                .container()
                .appendTo("#outside");

            $('#pregnantTable').DataTable({
                    "columnDefs": [{
                        "type": "num-fmt",
                        "targets": "Age"
                    }],
                    dom: 'Blfrtip',
                    buttons: [{
                            extend: 'pdfHtml5',
                            orientation: 'landscape',
                            pageSize: 'LEGAL',
                            className: 'bg-export',
                            exportOptions: {
                                columns: [1, 2, 3, 4]
                            }
                        },
                        {
                            extend: 'excelHtml5',
                            className: 'bg-export',
                            exportOptions: {
                                columns: [1, 2, 3, 4]
                            }
                        },
                        {
                            extend: 'csvHtml5',
                            className: 'bg-export',
                            exportOptions: {
                                columns: [1, 2, 3, 4]
                            }
                        },
                    ]
                }).buttons()
                .container()
                .appendTo("#outside");

            $('#pwdTable').DataTable({
                    "columnDefs": [{
                        "type": "num-fmt",
                        "targets": "Age"
                    }],
                    dom: 'Blfrtip',
                    buttons: [{
                            extend: 'pdfHtml5',
                            orientation: 'landscape',
                            pageSize: 'LEGAL',
                            className: 'bg-export',
                            exportOptions: {
                                columns: [1, 2, 3, 4, 5]
                            }
                        },
                        {
                            extend: 'excelHtml5',
                            className: 'bg-export',
                            exportOptions: {
                                columns: [1, 2, 3, 4, 5]
                            }
                        },
                        {
                            extend: 'csvHtml5',
                            className: 'bg-export',
                            exportOptions: {
                                columns: [1, 2, 3, 4, 5]
                            }
                        },
                    ]
                }).buttons()
                .container()
                .appendTo("#outside");
            $('#inschoolTable').DataTable({
                    "columnDefs": [{
                        "type": "num-fmt",
                        "targets": "Age"
                    }],
                    dom: 'Blfrtip',
                    buttons: [{
                            extend: 'pdfHtml5',
                            orientation: 'landscape',
                            pageSize: 'LEGAL',
                            className: 'bg-export',
                            exportOptions: {
                                columns: [1, 2, 3, 4, 5]
                            }
                        },
                        {
                            extend: 'excelHtml5',
                            className: 'bg-export',
                            exportOptions: {
                                columns: [1, 2, 3, 4, 5]
                            }
                        },
                        {
                            extend: 'csvHtml5',
                            className: 'bg-export',
                            exportOptions: {
                                columns: [1, 2, 3, 4, 5]
                            }
                        },
                    ]
                }).buttons()
                .container()
                .appendTo("#outside");
            $('#outofschoolTable').DataTable({
                    "columnDefs": [{
                        "type": "num-fmt",
                        "targets": "Age"
                    }],
                    dom: 'Blfrtip',
                    buttons: [{
                            extend: 'pdfHtml5',
                            orientation: 'landscape',
                            pageSize: 'LEGAL',
                            className: 'bg-export',
                            exportOptions: {
                                columns: [1, 2, 3, 4]
                            }
                        },
                        {
                            extend: 'excelHtml5',
                            className: 'bg-export',
                            exportOptions: {
                                columns: [1, 2, 3, 4]
                            }
                        },
                        {
                            extend: 'csvHtml5',
                            className: 'bg-export',
                            exportOptions: {
                                columns: [1, 2, 3, 4]
                            }
                        },
                    ]
                }).buttons()
                .container()
                .appendTo("#outside");
            $('#employedTable').DataTable({
                    "columnDefs": [{
                        "type": "num-fmt",
                        "targets": "Age"
                    }],
                    dom: 'Blfrtip',
                    buttons: [{
                            extend: 'pdfHtml5',
                            orientation: 'landscape',
                            pageSize: 'LEGAL',
                            className: 'bg-export',
                            exportOptions: {
                                columns: [1, 2, 3, 4, 5]
                            }
                        },
                        {
                            extend: 'excelHtml5',
                            className: 'bg-export',
                            exportOptions: {
                                columns: [1, 2, 3, 4, 5]
                            }
                        },
                        {
                            extend: 'csvHtml5',
                            className: 'bg-export',
                            exportOptions: {
                                columns: [1, 2, 3, 4, 5]
                            }
                        },
                    ]
                }).buttons()
                .container()
                .appendTo("#outside");
            $('#unemployedTable').DataTable({
                    "columnDefs": [{
                        "type": "num-fmt",
                        "targets": "Age"
                    }],
                    dom: 'Blfrtip',
                    buttons: [{
                            extend: 'pdfHtml5',
                            orientation: 'landscape',
                            pageSize: 'LEGAL',
                            className: 'bg-export',
                            exportOptions: {
                                columns: [1, 2, 3, 4]
                            }
                        },
                        {
                            extend: 'excelHtml5',
                            className: 'bg-export',
                            exportOptions: {
                                columns: [1, 2, 3, 4]
                            }
                        },
                        {
                            extend: 'csvHtml5',
                            className: 'bg-export',
                            exportOptions: {
                                columns: [1, 2, 3, 4]
                            }
                        },
                    ]
                }).buttons()
                .container()
                .appendTo("#outside");
            $('#filipinoTable').DataTable({
                    "columnDefs": [{
                        "type": "num-fmt",
                        "targets": "Age"
                    }],
                    dom: 'Blfrtip',
                    buttons: [{
                            extend: 'pdfHtml5',
                            orientation: 'landscape',
                            pageSize: 'LEGAL',
                            className: 'bg-export',
                            exportOptions: {
                                columns: [1, 2, 3, 4, 5]
                            }
                        },
                        {
                            extend: 'excelHtml5',
                            className: 'bg-export',
                            exportOptions: {
                                columns: [1, 2, 3, 4, 5]
                            }
                        },
                        {
                            extend: 'csvHtml5',
                            className: 'bg-export',
                            exportOptions: {
                                columns: [1, 2, 3, 4, 5]
                            }
                        },
                    ]
                }).buttons()
                .container()
                .appendTo("#outside");
            $('#nonfilipinoTable').DataTable({
                    "columnDefs": [{
                        "type": "num-fmt",
                        "targets": "Age"
                    }],
                    dom: 'Blfrtip',
                    buttons: [{
                            extend: 'pdfHtml5',
                            orientation: 'landscape',
                            pageSize: 'LEGAL',
                            className: 'bg-export',
                            exportOptions: {
                                columns: [1, 2, 3, 4, 5, 6]
                            }
                        },
                        {
                            extend: 'excelHtml5',
                            className: 'bg-export',
                            exportOptions: {
                                columns: [1, 2, 3, 4, 5, 6]
                            }
                        },
                        {
                            extend: 'csvHtml5',
                            className: 'bg-export',
                            exportOptions: {
                                columns: [1, 2, 3, 4, 5, 6]
                            }
                        },
                    ]
                }).buttons()
                .container()
                .appendTo("#outside");
            $('#religionTable').DataTable({
                    "columnDefs": [{
                        "type": "num-fmt",
                        "targets": "Age"
                    }],
                    dom: 'Blfrtip',
                    buttons: [{
                            extend: 'pdfHtml5',
                            orientation: 'landscape',
                            pageSize: 'LEGAL',
                            className: 'bg-export',
                            exportOptions: {
                                columns: [1, 2, 3, 4, 5]
                            }
                        },
                        {
                            extend: 'excelHtml5',
                            className: 'bg-export',
                            exportOptions: {
                                columns: [1, 2, 3, 4, 5]
                            }
                        },
                        {
                            extend: 'csvHtml5',
                            className: 'bg-export',
                            exportOptions: {
                                columns: [1, 2, 3, 4, 5]
                            }
                        },
                    ]
                }).buttons()
                .container()
                .appendTo("#outside");
        });
    </script>
    <script>
        var mybutton = document.getElementById("toTop");
        // When the user scrolls down 20px from the top of the document, show the button
        window.onscroll = function() {
            scrollFunction()
        };

        function scrollFunction() {
            if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                mybutton.style.display = "block";
            } else {
                mybutton.style.display = "none";
            }
        }
        // When the user clicks on the button, scroll to the top of the document
        function topFunction() {
            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;
        }

        function previewFile(input) {
            var file = $("input[type=file]").get(0).files[0];
            if (file) {
                var reader = new FileReader();
                reader.onload = function() {
                    $('#previewImg').attr("src", reader.result);
                }
                reader.readAsDataURL(file);
            }
        }
        tinymce.init({
            selector: '#announcement',
            plugins: 'print preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons',
            imagetools_cors_hosts: ['picsum.photos'],
            menubar: 'file edit view insert format tools table help',
            toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl',
            toolbar_sticky: true,
            autosave_ask_before_unload: true,
            autosave_interval: '30s',
            autosave_prefix: '{path}{query}-{id}-',
            autosave_restore_when_empty: false,
            autosave_retention: '2m',
            image_advtab: true,
            link_list: [{
                    title: 'My page 1',
                    value: 'https://www.tiny.cloud'
                },
                {
                    title: 'My page 2',
                    value: 'http://www.moxiecode.com'
                }
            ],
            image_list: [{
                    title: 'My page 1',
                    value: 'https://www.tiny.cloud'
                },
                {
                    title: 'My page 2',
                    value: 'http://www.moxiecode.com'
                }
            ],
            image_class_list: [{
                    title: 'None',
                    value: ''
                },
                {
                    title: 'Some class',
                    value: 'class-name'
                }
            ],
            importcss_append: true,
            file_picker_callback: function(callback, value, meta) {
                /* Provide file and text for the link dialog */
                if (meta.filetype === 'file') {
                    callback('https://www.google.com/logos/google.jpg', {
                        text: 'My text'
                    });
                }

                /* Provide image and alt text for the image dialog */
                if (meta.filetype === 'image') {
                    callback('https://www.google.com/logos/google.jpg', {
                        alt: 'My alt text'
                    });
                }

                /* Provide alternative source and posted for the media dialog */
                if (meta.filetype === 'media') {
                    callback('movie.mp4', {
                        source2: 'alt.ogg',
                        poster: 'https://www.google.com/logos/google.jpg'
                    });
                }
            },
            templates: [{
                    title: 'New Table',
                    description: 'creates a new table',
                    content: '<div class="mceTmpl"><table width="98%%"  border="0" cellspacing="0" cellpadding="0"><tr><th scope="col"> </th><th scope="col"> </th></tr><tr><td> </td><td> </td></tr></table></div>'
                },
                {
                    title: 'Starting my story',
                    description: 'A cure for writers block',
                    content: 'Once upon a time...'
                },
                {
                    title: 'New list with dates',
                    description: 'New List with dates',
                    content: '<div class="mceTmpl"><span class="cdate">cdate</span><br /><span class="mdate">mdate</span><h2>My List</h2><ul><li></li><li></li></ul></div>'
                }
            ],
            template_cdate_format: '[Date Created (CDATE): %m/%d/%Y : %H:%M:%S]',
            template_mdate_format: '[Date Modified (MDATE): %m/%d/%Y : %H:%M:%S]',
            height: 600,
            image_caption: true,
            quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
            noneditable_noneditable_class: 'mceNonEditable',
            toolbar_mode: 'sliding',
            contextmenu: 'link image imagetools table',


            content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
        });
        // tinymce.init({
        //     selector: '#announcement',
        //     plugins: 'charmap wordcount lists image imagetools searchreplace ',
        //     toolbar: 'searchreplace charmap wordcount hr | image | advlist bullist numlist ',
        //     toolbar_mode: 'floating',
        // });
        // tinymce.init({
        //     selector: '#announcement',
        // plugins: 'image autolink lists media table advimage',
        //     toolbar: 'wordcount'
        // });
    </script>
    <script>
        $(document).ready(function() {
            $("input[name=pwd]").change(function() {
                if ($(this).val() === 'Yes') {
                    $("#pwd_field").append('<div id="added-pwd-field"><label for="disability" class="form-label">Type of disability</label> <select class="form-select shadow-none rounded-0 @error("disability") is-invalid @enderror" name="disability" id="disability"><option>Deaf or hard of hearing</option><option>Intellectual disability</option><option>Learning disability</option><option>Mental disability</option><option>Orthopedic</option><option>Psychosocial disability</option><option>Speech and language impairment</option><option>Visual disability</option><option>Cancer</option><option>Rare disease </option> </select> @error("disability") <small class="text-danger"> {{$message}} </small> @enderror </div>');

                } else if ($(this).val() === 'No') {
                    $("#added-pwd-field").remove();
                }
            });
            $("#sex").change(function() {
                if ($(this).val() === 'Female') {
                    $("#pregnant_field").append('<div id="added_pregnant_field"><label for="pregnant" class="form-label mt-3">Is pregnant?</label><select class="form-select shadow-none rounded-0 @error("pregnant") is-invalid @enderror" name="pregnant" id="pregnant"><option>Yes</option><option>No</option> </select>@error("pregnant") <small class="text-danger"> {{$message}} </small> @enderror </div>');
                } else if ($(this).val() === 'Male') {
                    $("#added_pregnant_field").remove();
                }
            });

        });
    </script>



</body>

</html>
<!-- plugins: 'a11ychecker advcode casechange export formatpainter image editimage linkchecker autolink lists checklist media mediaembed pageembed permanentpen powerpaste table advtable tinymcespellchecker advimage',
toolbar: 'a11ycheck addcomment showcomments casechange checklist code export formatpainter image editimage pageembed permanentpen table numlist bullist', -->