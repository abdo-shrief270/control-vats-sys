<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Live Stream</title>
    <link rel="icon" type="image/x-icon" href="{{asset('assets/icons/logo.png')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css"integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ=="crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect"  href="https://fonts.googleapis.com">
    <link rel="preconnect"  href="https://fonts.gstatic.com" crossorigin>
    <link  rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400..900&display=swap">
    <link rel="stylesheet"  href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="manifest" href="{{asset('assets/manifest.json')}}">
    <link rel="stylesheet" href="{{asset('assets/live.css')}}">
</head>
<body class="d-flex flex-column min-vh-100">
    <div class="span py-2 text-center fw-bold fs-6" id="logs_status"></div>
    <nav class="navbar navbar-expand-xl bg-white">
        <div class="container-fluid py-1">
            <div class="navbar-brand py-0">
                <svg width="50" height="50" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M37.3337 28.6666C37.3337 36.9883 28.102 45.6549 25.002 48.3316C24.7132 48.5487 24.3617 48.6662 24.0003 48.6662C23.639 48.6662 23.2875 48.5487 22.9987 48.3316C19.8987 45.6549 10.667 36.9883 10.667 28.6666C10.667 25.1304 12.0718 21.739 14.5722 19.2385C17.0727 16.738 20.4641 15.3333 24.0003 15.3333C27.5365 15.3333 30.9279 16.738 33.4284 19.2385C35.9289 21.739 37.3337 25.1304 37.3337 28.6666Z"
                        stroke="#007BFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    <path
                        d="M24.0003 33.6666C26.7617 33.6666 29.0003 31.428 29.0003 28.6666C29.0003 25.9052 26.7617 23.6666 24.0003 23.6666C21.2389 23.6666 19.0003 25.9052 19.0003 28.6666C19.0003 31.428 21.2389 33.6666 24.0003 33.6666Z"
                        stroke="#007BFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    <path
                        d="M36 48H39M39 48C39 51.866 42.134 55 46 55M39 48C39 44.134 42.134 41 46 41M53 48H56M53 48C53 51.866 49.866 55 46 55M53 48C53 44.134 49.866 41 46 41M46 38V41M46 55V58M49 48C49 49.6569 47.6569 51 46 51C44.3431 51 43 49.6569 43 48C43 46.3431 44.3431 45 46 45C47.6569 45 49 46.3431 49 48Z"
                        stroke="#007BFF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <a href="https://vats-sys.com" class="text-decoration-none"><span class="text-primary text-uppercase fs-3">A.V.D.T.M</span></a>
            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
                    aria-controls="offcanvasNavbar">
                <i class="fa-solid fa-bars fs-2 text-primary"></i>
            </button>
            <div class="offcanvas offcanvas-end  w-75 side-bar" tabindex="-1" id="offcanvasNavbar"
                 aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title text-primary text-uppercase" id="offcanvasNavbarLabel">A.V.D.T.M</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                        <li class="nav-item">
                            <a id="indexPageLink" class="nav-link text-dark pr-xl-3 fs-5 a-font" aria-current="page"
                               href="{{route('home')}}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a id="logsPageLink" class="nav-link text-dark px-xl-3 fs-5 a-font" aria-current="page"
                               href="{{route('activityLogs')}}">Activity Logs</a>
                        </li>
                        <li class="nav-item">
                            <a id="autoPageLink" class="nav-link text-dark px-xl-3 fs-5 a-font" aria-current="page"
                               href="{{route('automaticControl')}}">Automatic control</a>
                        </li>
                        <li class="nav-item">
                            <a id="livePageLink" class="nav-link text-dark px-xl-3 fs-5 a-font" aria-current="page"
                               href="{{route('liveStream')}}">Live Stream</a>
                        </li>
                        <li class="nav-item">
                            <a id="testPageLink" class="nav-link text-dark pl-xl-3 fs-5 a-font" aria-current="page"
                               href="{{route('carStatus')}}">Car Parameters</a>
                        </li>
                        @if(auth()->check())
                            <li class="nav-item">
                                <a id="logout" class="nav-link text-dark pl-xl-3 pl-3 py-1 btn btn-danger mt-2" aria-current="page"
                                   href="{{route('logout')}}">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="btn-close-white" fill="#000000" height="25px" width="25px" version="1.1" id="Capa_1" viewBox="0 0 490.3 490.3" xml:space="preserve">
                                    <g>
                                        <g>
                                            <path d="M0,121.05v248.2c0,34.2,27.9,62.1,62.1,62.1h200.6c34.2,0,62.1-27.9,62.1-62.1v-40.2c0-6.8-5.5-12.3-12.3-12.3    s-12.3,5.5-12.3,12.3v40.2c0,20.7-16.9,37.6-37.6,37.6H62.1c-20.7,0-37.6-16.9-37.6-37.6v-248.2c0-20.7,16.9-37.6,37.6-37.6h200.6    c20.7,0,37.6,16.9,37.6,37.6v40.2c0,6.8,5.5,12.3,12.3,12.3s12.3-5.5,12.3-12.3v-40.2c0-34.2-27.9-62.1-62.1-62.1H62.1    C27.9,58.95,0,86.75,0,121.05z"/>
                                            <path d="M385.4,337.65c2.4,2.4,5.5,3.6,8.7,3.6s6.3-1.2,8.7-3.6l83.9-83.9c4.8-4.8,4.8-12.5,0-17.3l-83.9-83.9    c-4.8-4.8-12.5-4.8-17.3,0s-4.8,12.5,0,17.3l63,63H218.6c-6.8,0-12.3,5.5-12.3,12.3c0,6.8,5.5,12.3,12.3,12.3h229.8l-63,63    C380.6,325.15,380.6,332.95,385.4,337.65z"/>
                                        </g>
                                    </g>
                                </svg>

                                </a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <div class="container-fluid w-100 text-center d-flex justify-content-center">
        <div class="row w-100">
            <div class="col-12 col-sm-12 col-md-12 col-lg-8 text-center d-flex justify-content-center align-items-center flex-column">
                <img id="live" class="border rounded-3 col-6" src="{{asset('assets/icons/stream_error.png')}}" alt="" style="font-weight: 700; font-size: 40px; color: red;display: flex;justify-content: center;align-items: center;max-height:100vh;"/>
                <span class="col-12">Live Stream Video</span>
            </div>
            <div class="col-12 col-sm-12 col-md-12 col-lg-4 text-center">
                <div class="row">
                    <div class="col-12">
                    <span id="carMove" class="badge w-100 fs-5 mt-3 py-3"></span>
                    </div>
                    <div class="col-12">
                        <span id="carStatus" class="badge w-100 fs-5 mt-3 py-3"></span>
                    </div>
                </div>
                <div class="col-12 d-flex justify-content-center row ">
                    <img id="detection_image" class="border rounded-3 mt-3 col-9" src="{{asset('assets/icons/stream_error.png')}}" alt="last Person detected" style="display: flex; justify-content: center; align-items: center;"/>
                    <span class="col-12">Last Detected Image</span>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-auto">
        <div class="logocontainer">
            <img class="logoo" src="{{asset('assets/icons/logo.png')}}" alt="">
        </div>
        <footer class="bg-info text-center d-flex justify-content-around align-items-center control-fs" style="width: 100%;height:30px ; ">
            <span class="text-dark" style="font-size:12px;">RPi IP :<span id="rpiIp">~</span></span>
            <span class="text-dark" style="font-size:12px;">all rights reserved © 2025</span>
        </footer>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3"crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V"crossorigin="anonymous"></script>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script src="https://www.gstatic.com/firebasejs/9.17.1/firebase-app-compat.js"></script>
    <script src="https://www.gstatic.com/firebasejs/9.17.1/firebase-database-compat.js"></script>
    <script src="{{asset('assets/live.js')}}"></script>
    @include('sweetalert::alert')

</body>
</html>
