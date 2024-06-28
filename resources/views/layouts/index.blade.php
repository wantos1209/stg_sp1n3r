<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('img/utama/g21-icon.ico') }}" />
    <title>Dashboard | L21</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/design.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/custom_dash.css') }}" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.all.min.js"></script>
    {{-- CDN SELECT --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    {{-- ------------ --}}
    <script>
        $(document).ready(function() {
            adjustElementSize();
        });
    </script>
</head>

<body>
    <div class="sec_container_utama">
        <div class="sec_sidebar" id="sec_sidebar">
            @include('layouts.side_nav')
        </div>
        <div class="sec_groupmain">
            <div class="sec_top_navbar">
                @include('layouts.top_nav')
            </div>
            <div class="sec_main_konten">
                <div class="title_main_content">
                    <h3>dashboard</h3>
                </div>
                <div class="content_body">
                    <div class="aplay_code">
                        @yield('container')
                    </div>
                    <div class="footer" id="footer">
                        <span>© Copyright 2010 - 2023 Lukcy Wheel L21Group All Rights Reserved.</span>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="{{ asset('js/script.js') }}"></script>
    <script src="{{ asset('js/design.js') }}"></script>
    <script src="{{ asset('js/component.js') }}"></script>
</body>

</html>
