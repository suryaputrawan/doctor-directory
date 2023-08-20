<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Ward Info BIMC KUTA">
    <meta name="author" content="Ward">
    <meta name="keywords" content="ward, bimc kuta">

    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>Doctor Directory</title>

    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/favicons/favicon.ico') }}" />
    <link rel="shortcut icon" href="{{ asset('assets/favicons/favicon.ico') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/favicons/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/favicons/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/favicons/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('assets/favicons/site.webmanifest') }}">
    <link rel="mask-icon" color="#5bbad5" href="{{ asset('assets/favicons/safari-pinned-tab.svg') }}">
    <meta name="msapplication-TileColor" content="#00aba9">
    <meta name="theme-color" content="#ffffff">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <!-- End fonts -->

    <!-- plugin css -->
    <link href="{{ asset('assets/admin/fonts/feather-font/css/iconfont.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/admin/plugins/flag-icon-css/css/flag-icon.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/admin/plugins/perfect-scrollbar/perfect-scrollbar.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/admin/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/admin/plugins/magnific-popup/magnific-popup.css') }}" rel="stylesheet" />
    <!-- end plugin css -->

    @stack('plugin-styles')

    <!-- common css -->
    <link href="{{ asset('css/admin/app.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/admin/custom.css') }}" rel="stylesheet" />
    <!-- end common css -->

    <style>
        #main {
            width: 100%;
            height: 50vw;
            /* border: 1px solid #c3c3c3; */
            display: flex;
            flex-direction: column;
            flex-wrap: wrap;
            align-content: flex-start;
            margin: 0px;
        }
    </style>
</head>

<body data-base-url="{{url('/')}}">

    <script src="{{ asset('assets/admin/js/spinner.js') }}"></script>
    <div id="main">
        @foreach ($doctors as $index => $doctor)
            <h5 style="font-family: 'Courier New', Courier, monospace; font-size:14px;">{{ $index }}</h5>
            <div class="col-md-3">
                <ul class="list-unstyled">
                    @foreach ($doctor as $data)
                        <div class="card">
                            <li class="d-flex align-items-start">
                                <img src="{{ $data->takeImage }}" class="d-flex wd-sm-50 py-2 px-2 me-2" alt="...">
                                <div>
                                    <h6 style="font-size: 12px" class="mt-2 mb-2">{{ $data->name }}</h6>
                                    <h6 style="font-size: 10px">{{ $data->keterangan }}</h6>
                                </div>
                            </li>
                        </div>
                    @endforeach
                </ul>
            </div>
        @endforeach
    </div>

    <!-- base js -->
    <script src="{{ asset('js/admin/app.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/magnific-popup/magnific-popup.min.js') }}"></script>
    <!-- end base js -->

    <!-- common js -->
    <script src="{{ asset('assets/admin/js/template.js') }}"></script>
    <!-- end common js -->

</body>

</html>
