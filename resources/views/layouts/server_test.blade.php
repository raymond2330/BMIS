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

        #sidebar-nav {
            width: 16.5rem;
        }

        #sidebar-nav a {
            color: #fff;
            border: 0;
            padding: 0.85rem;
            text-align: left;
            display: block;
            background-color: #353c4e;
            border-radius: 1rem;
            margin: 0.4rem;
        }

        #sidebar-nav .sidebar-item:hover {
            transition: all 0.5s ease;
            /* font-weight: bold; */
            margin-left: 1rem;
            background-color: #414b62;
            color: #cbc3b1;
        }

        .active-link {
            background-color: #414b62 !important;
            color: #cbc3b1 !important;
            border-radius: 10px;
        }
    </style>
</head>

<body style="background-color: #E8EAF6;">

    <header>

    </header>
    <div class="row flex-nowrap g-0">
        @include('layouts.sidebar')

        <main class="col">
            <div class="py-1 mb-3 bg-white shadow-sm">
                <a href="#" data-bs-target="#sidebar" data-bs-toggle="collapse" class="border-none rounded-3 fs-5 p-2 text-decoration-none text-dark"><i class="fa-solid fa-bars" style="margin: 1rem"></i></a>

            </div>
            <div class="m-3">
                @yield('content')
            </div>
        </main>

    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js" integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>
    <script src="https://cdn.tiny.cloud/1/kogos4e3i28a6tb2dnuq31kw6wnycc1tc6pbredig4ew514h/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <!-- Development -->


    <script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>



    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.13.1/b-2.3.3/b-html5-2.3.3/b-print-2.3.3/datatables.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {

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
    <script>
        function addShowClass() {
            const screenWidth = window.innerWidth;
            const divElement = document.getElementById("sidebar");

            if (screenWidth > 720) {
                divElement.classList.add("show");
            } else {
                divElement.classList.remove("show");
            }
        }
        window.addEventListener("resize", addShowClass);
    </script>



</body>

</html>