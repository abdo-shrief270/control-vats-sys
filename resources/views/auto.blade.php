<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Automatic control</title>
    <link rel="icon" type="image/x-icon" href="{{asset('assets/icons/logo.png')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css"integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ=="crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400..900&display=swap">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="manifest" href="{{asset('assets/manifest.json')}}">
    <link rel="stylesheet" href="{{asset('assets/auto.css')}}">
</head>
<body class="d-flex flex-column align-items-center min-vh-100">

    <div class="col-12">
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
    </div>
    <div class="container-fluid pt-2 pt-lg-5 d-flex flex-column flex-lg-row justify-content-between col-12">
        <div class="col-12 col-lg-6 d-flex flex-column">
            <div class="col-12 pb-3 px-2 text-center">
                <div class="d-flex align-items-center justify-content-between p-2">
                    <span id="carMove" class="badge fs-5 py-3" style="width: 65% !important;">Vehicle is not moving</span>
                    <div class="text-center" style="width: 35% !important;">
                        <span id="carMode" class="font-monospace">Obstacle Avoidance</span>
                        <div class="toggle-button gd">
                            <div class="btn-on-off btn-pill" id="button">
                                <input id="modeInput" value="false" type="checkbox" class="checkbox" />
                                <div class="knob"></div>
                                <div class="btn-bg"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center align-items-center mt-3 px-1">
                    <div class="col-6 col-md-4 p-2">
                        <div class="border border-primary rounded-4 p-2">
                            <div class="d-flex align-items-center gap-2">
                                <svg width="34" height="34" viewBox="0 0 34 34" fill="none" xmlns="http://www.w3.org/2000/svg"><rect width="34" height="34" rx="10" fill="#007BFF" /><g clip-path="url(#clip0_256_197)"><path d="M15.4397 13.9144C15.4397 13.7716 15.4999 13.6346 15.6071 13.5336C15.7143 13.4326 15.8596 13.3759 16.0112 13.3759C17.9807 13.3779 19.869 14.116 21.2617 15.4283C22.6543 16.7407 23.4377 18.52 23.4397 20.3759C23.4397 20.5187 23.3795 20.6557 23.2724 20.7567C23.1652 20.8576 23.0199 20.9144 22.8683 20.9144C22.7168 20.9144 22.5714 20.8576 22.4642 20.7567C22.3571 20.6557 22.2969 20.5187 22.2969 20.3759C22.295 18.8056 21.6321 17.3 20.4537 16.1896C19.2754 15.0792 17.6777 14.4546 16.0112 14.4528C15.8596 14.4528 15.7143 14.3961 15.6071 14.2951C15.4999 14.1941 15.4397 14.0572 15.4397 13.9144ZM25.7254 21.9913H14.2969V11.2221C14.2969 11.0792 14.2367 10.9423 14.1295 10.8413C14.0223 10.7403 13.877 10.6836 13.7254 10.6836C13.5739 10.6836 13.4285 10.7403 13.3214 10.8413C13.2142 10.9423 13.154 11.0792 13.154 11.2221V13.3759H10.8683C10.7168 13.3759 10.5714 13.4326 10.4642 13.5336C10.3571 13.6346 10.2969 13.7716 10.2969 13.9144C10.2969 14.0572 10.3571 14.1941 10.4642 14.2951C10.5714 14.3961 10.7168 14.4528 10.8683 14.4528H13.154V22.5298C13.154 22.6726 13.2142 22.8095 13.3214 22.9105C13.4285 23.0115 13.5739 23.0682 13.7254 23.0682H25.7254C25.877 23.0682 26.0223 23.0115 26.1295 22.9105C26.2367 22.8095 26.2969 22.6726 26.2969 22.5298C26.2969 22.3869 26.2367 22.25 26.1295 22.149C26.0223 22.048 25.877 21.9913 25.7254 21.9913Z"fill="white" /></g><defs><clipPath id="clip0_256_197"><rect width="16.5" height="15.5481" fill="white"transform="translate(8.75 9.22595)" /></clipPath></defs></svg>
                                <p>Angle</p>
                            </div>
                            <div id="angle" class="text-center">0</div>
                        </div>
                    </div>
                    <div class="col-6 col-md-4 p-2">
                        <div class="border border-warning rounded-4 p-2">
                            <div class="d-flex align-items-center gap-2">
                                <svg width="34" height="34" viewBox="0 0 34 34" fill="none"xmlns="http://www.w3.org/2000/svg"><rect x="0.333008" width="34" height="34" rx="10" fill="#FFC107" /><g clip-path="url(#clip0_256_207)"><path d="M12.1831 9.86365C11.1011 9.86365 10.0177 10.6283 10.0177 12.1577L12.1831 16.236L14.3471 12.1577C14.3471 10.6283 13.2651 9.86365 12.1831 9.86365ZM21.7283 11.1063C21.495 11.1155 21.2684 11.1572 21.0791 11.1955L21.2076 11.7562C21.3969 11.7164 21.593 11.6912 21.7587 11.6798L21.7283 11.1063ZM12.1831 11.1381C12.7815 11.1381 13.2651 11.5947 13.2651 12.1577C13.2651 12.7216 12.7815 13.1773 12.1831 13.1773C11.5856 13.1773 11.1011 12.7216 11.1011 12.1577C11.1011 11.5947 11.5856 11.1381 12.1831 11.1381ZM22.4012 11.1445L22.2997 11.7084C22.4654 11.7413 22.6311 11.7824 22.7765 11.8646L23.0706 11.3611C22.8644 11.2576 22.6345 11.1646 22.4012 11.1445ZM20.457 11.358C20.2507 11.4338 20.0444 11.5017 19.8686 11.5682L20.1087 12.094C20.2947 12.0194 20.4908 11.9544 20.6564 11.8996L20.457 11.358ZM23.6252 11.7849L23.1619 12.1577C23.2837 12.289 23.3783 12.4508 23.4527 12.5814L23.9971 12.3234C23.8821 12.1147 23.7807 11.9566 23.6252 11.7849ZM19.304 11.8136C19.0977 11.9127 18.9286 12.0009 18.746 12.0876L19.0436 12.591C19.2194 12.4954 19.4121 12.403 19.5677 12.3297L19.304 11.8136ZM18.2118 12.3839C18.0326 12.4827 17.8568 12.5814 17.6843 12.6898L18.0157 13.1677C18.1814 13.0657 18.3538 12.9702 18.5229 12.8746L18.2118 12.3839ZM24.2067 12.9542C24.0072 12.9861 23.8044 13.0084 23.6049 13.0307C23.6184 13.19 23.6083 13.3621 23.5744 13.4959L24.1662 13.6265C24.2 13.3971 24.2304 13.1613 24.2067 12.9542ZM17.1704 13.0084C17.0013 13.1167 16.8356 13.2282 16.6666 13.3366L17.0182 13.8049C17.1805 13.6934 17.3462 13.5883 17.5119 13.4799L17.1704 13.0084ZM16.1695 13.6807C16.0005 13.7954 15.8247 13.9228 15.6793 14.028L16.0478 14.4836C16.2338 14.3561 16.3623 14.2606 16.5313 14.1427L16.1695 13.6807ZM23.3716 13.9356C23.2701 14.0821 23.1518 14.2287 23.0335 14.3402L23.4764 14.7385C23.6218 14.576 23.7773 14.4103 23.8855 14.2446L23.3716 13.9356ZM15.1958 14.3848C15.0301 14.5059 14.8644 14.6301 14.719 14.7448L15.1045 15.1877C15.2634 15.0635 15.4257 14.936 15.5744 14.8341L15.1958 14.3848ZM22.6142 14.7066C22.4586 14.8245 22.2963 14.9392 22.1476 15.0348L22.4958 15.5063C22.675 15.3916 22.8509 15.2674 23.003 15.1527L22.6142 14.7066ZM14.249 15.1176C14.0901 15.2387 13.9379 15.3662 13.7824 15.4904L14.178 15.9269C14.3302 15.8027 14.4823 15.6784 14.6378 15.5573L14.249 15.1176ZM21.6505 15.3407C21.4781 15.4362 21.2989 15.535 21.1366 15.6179L21.4274 16.1245C21.61 16.0193 21.8162 15.9269 21.9684 15.8313L21.6505 15.3407ZM13.3192 15.8696C13.167 15.997 13.0182 16.1245 12.8661 16.2551L13.2752 16.682C13.424 16.5546 13.5761 16.4271 13.7249 16.2997L13.3192 15.8696ZM20.6057 15.8823C20.4265 15.9651 20.2473 16.0512 20.0681 16.134L20.3285 16.6502C20.5381 16.5546 20.6936 16.4749 20.883 16.3921L20.6057 15.8823ZM19.5237 16.373C19.3378 16.4526 19.1586 16.5291 18.9692 16.6024L19.216 17.1281C19.402 17.0516 19.588 16.972 19.7739 16.8923L19.5237 16.373ZM12.4198 16.6502C12.2473 16.7936 12.1273 16.9051 11.9701 17.0484L12.3995 17.4626C12.5584 17.3193 12.6869 17.195 12.8356 17.0739L12.4198 16.6502ZM18.4147 16.835C18.2287 16.9083 18.0427 16.9847 17.8568 17.058L18.0935 17.5901C18.2828 17.5168 18.4688 17.4403 18.6548 17.3639L18.4147 16.835ZM17.2955 17.281C17.1095 17.3575 16.9236 17.434 16.7342 17.5041L16.9709 18.0362C17.1569 17.9629 17.3462 17.8864 17.5322 17.8131L17.2955 17.281ZM23.544 17.5104C22.462 17.5104 21.38 18.2751 21.38 19.8045L23.544 23.8828L25.708 19.8045C25.708 18.2751 24.626 17.5104 23.544 17.5104ZM16.1729 17.7271C15.9802 17.8099 15.7773 17.8864 15.6116 17.9533L15.8517 18.4822C16.0512 18.4026 16.2406 18.3261 16.4096 18.256L16.1729 17.7271ZM15.0504 18.1795C14.8678 18.2592 14.6548 18.3484 14.4925 18.4185L14.7427 18.941C14.9422 18.8582 15.118 18.7753 15.2938 18.7053L15.0504 18.1795ZM13.9346 18.6575C13.7452 18.7435 13.5491 18.8327 13.38 18.9124L13.6539 19.4253C13.8365 19.3361 14.0258 19.2533 14.1915 19.1768L13.9346 18.6575ZM23.544 18.7849C24.1425 18.7849 24.626 19.2405 24.626 19.8045C24.626 20.3684 24.1425 20.824 23.544 20.824C22.9455 20.824 22.462 20.3684 22.462 19.8045C22.462 19.2405 22.9455 18.7849 23.544 18.7849ZM12.8323 19.1768C12.6531 19.2692 12.4739 19.3648 12.2913 19.4636L12.5956 19.9606C12.768 19.865 12.9438 19.7758 13.1197 19.6866L12.8323 19.1768ZM11.7604 19.7726C11.5707 19.8746 11.3875 20.0116 11.2296 20.1103L11.5981 20.5692C11.7662 20.4545 11.9471 20.3366 12.0918 20.2537L11.7604 19.7726ZM10.7494 20.4927C10.5871 20.6329 10.4272 20.7954 10.3031 20.9324L10.7663 21.3052C10.8965 21.1554 11.0098 21.0439 11.1619 20.9164L10.7494 20.4927ZM18.1138 20.5341L18.1679 21.1044C18.3437 21.0758 18.5195 21.0949 18.6953 21.1204L18.8001 20.5564C18.577 20.5246 18.3403 20.5022 18.1138 20.5341ZM16.8559 20.8527L17.0859 21.3848C17.2617 21.3115 17.4443 21.2542 17.6302 21.2C17.566 21.0184 17.5187 20.8336 17.4679 20.6488C17.2549 20.7062 17.0419 20.7826 16.8559 20.8527ZM19.4764 20.824L19.1315 21.2956C19.2735 21.3944 19.4122 21.4995 19.5237 21.6301L19.9836 21.2542C19.8111 21.0885 19.6793 20.9324 19.4764 20.824ZM16.2811 21.1108C16.0952 21.2 15.916 21.302 15.7367 21.4007L16.0444 21.8946C16.2203 21.8054 16.3927 21.7002 16.5652 21.6142L16.2811 21.1108ZM9.93151 21.4613C9.82939 21.6684 9.74655 21.8914 9.70801 22.089L10.3065 22.1877C10.343 22.0061 10.3954 21.8755 10.4722 21.7194C10.2865 21.6429 10.1094 21.5505 9.93151 21.4613ZM15.2093 21.7098C15.0368 21.8149 14.8678 21.9201 14.6987 22.0284L15.0368 22.5063C15.2059 22.4012 15.3716 22.2929 15.5406 22.1877L15.2093 21.7098ZM20.3724 21.748L19.8619 22.0603C19.9701 22.2132 20.0749 22.3725 20.1729 22.535L20.7004 22.2483C20.5821 22.0698 20.4975 21.9105 20.3724 21.748ZM14.1949 22.3534C14.0258 22.4586 13.8568 22.5605 13.6911 22.672L14.0292 23.1499C14.1915 23.0384 14.364 22.9333 14.5364 22.825L14.1949 22.3534ZM10.3132 22.6561C10.1175 22.6943 9.92001 22.7262 9.72322 22.7612C9.75873 22.9843 9.85374 23.2009 9.93962 23.373L10.4891 23.1245C10.4157 22.9652 10.346 22.7995 10.3132 22.6561ZM21.0013 22.7453L20.4739 23.0321C20.5787 23.2041 20.7004 23.3889 20.7985 23.5355L21.309 23.2264C21.1941 23.0575 21.096 22.8982 21.0013 22.7453ZM13.1907 22.9843C13.0216 23.083 12.8559 23.1786 12.6801 23.271L12.981 23.7713C13.1602 23.6725 13.3395 23.5737 13.5119 23.4686L13.1907 22.9843ZM10.7799 23.5036L10.364 23.9242C10.552 24.0931 10.7839 24.2046 11.0368 24.2555L11.1721 23.698C11.022 23.6693 10.8816 23.5992 10.7799 23.5036ZM12.1662 23.5132C11.9968 23.5865 11.8209 23.6438 11.6387 23.6789L11.7773 24.2396C11.9944 24.1982 12.1986 24.1217 12.4029 24.0421L12.1662 23.5132ZM21.6438 23.6661L21.1738 24.0261C21.3192 24.195 21.4984 24.3575 21.6539 24.4722L22.0292 24.0198C21.8805 23.9114 21.752 23.7808 21.6438 23.6661ZM22.4586 24.2237L22.3065 24.7813C22.5736 24.8322 22.7731 24.8482 23.0233 24.8227L22.9489 24.2524C22.7832 24.2779 22.6209 24.2619 22.4586 24.2237Z" fill="black" /></g><defs><clipPath id="clip0_256_207"><rect width="16.5" height="15.5481" fill="white"transform="translate(9.08301 9.22595)" /></clipPath></defs></svg>
                                <p>Distance</p>
                            </div>
                            <div id="distance" class="text-center">
                                0
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-4 p-2">
                        <div class="border border-danger rounded-4 p-2">
                            <div class="d-flex align-items-center gap-2">
                            <svg width="34" height="34" viewBox="0 0 34 34" fill="none"xmlns="http://www.w3.org/2000/svg"><rect x="0.666992" width="100%" height="100%" rx="10" fill="#DC3545" /><g clip-path="url(#clip0_256_214)"><path d="M17.667 13.1129C17.8037 13.1129 17.9349 13.1641 18.0316 13.2552C18.1283 13.3463 18.1826 13.4699 18.1826 13.5988V15.0564C18.1826 15.1853 18.1283 15.3089 18.0316 15.4C17.9349 15.4911 17.8037 15.5423 17.667 15.5423C17.5302 15.5423 17.3991 15.4911 17.3024 15.4C17.2057 15.3089 17.1514 15.1853 17.1514 15.0564V13.5988C17.1514 13.4699 17.2057 13.3463 17.3024 13.2552C17.3991 13.1641 17.5302 13.1129 17.667 13.1129ZM13.2656 14.796C13.3623 14.7049 13.4934 14.6537 13.6302 14.6537C13.7669 14.6537 13.898 14.7049 13.9947 14.796L14.9383 15.6842C14.9862 15.7294 15.0243 15.783 15.0502 15.842C15.0762 15.901 15.0895 15.9643 15.0895 16.0282C15.0895 16.0921 15.0762 16.1553 15.0502 16.2144C15.0243 16.2734 14.9862 16.327 14.9383 16.3722C14.8904 16.4174 14.8335 16.4532 14.7708 16.4776C14.7082 16.5021 14.641 16.5147 14.5732 16.5147C14.5054 16.5147 14.4383 16.5021 14.3757 16.4776C14.313 16.4532 14.2561 16.4174 14.2082 16.3722L13.2656 15.483C13.169 15.3919 13.1146 15.2683 13.1146 15.1395C13.1146 15.0107 13.169 14.8871 13.2656 14.796ZM11.4795 18.9434C11.4795 18.8146 11.5338 18.691 11.6305 18.5999C11.7272 18.5088 11.8584 18.4576 11.9951 18.4576H13.6307C13.7674 18.4576 13.8986 18.5088 13.9953 18.5999C14.092 18.691 14.1463 18.8146 14.1463 18.9434C14.1463 19.0723 14.092 19.1959 13.9953 19.287C13.8986 19.3781 13.7674 19.4293 13.6307 19.4293H11.9951C11.8584 19.4293 11.7272 19.3781 11.6305 19.287C11.5338 19.1959 11.4795 19.0723 11.4795 18.9434ZM21.2764 18.9434C21.2764 18.8146 21.3307 18.691 21.4274 18.5999C21.5241 18.5088 21.6552 18.4576 21.792 18.4576H23.3389C23.4756 18.4576 23.6068 18.5088 23.7035 18.5999C23.8002 18.691 23.8545 18.8146 23.8545 18.9434C23.8545 19.0723 23.8002 19.1959 23.7035 19.287C23.6068 19.3781 23.4756 19.4293 23.3389 19.4293H21.792C21.6552 19.4293 21.5241 19.3781 21.4274 19.287C21.3307 19.1959 21.2764 19.0723 21.2764 18.9434ZM22.0539 14.8174C21.9824 14.7506 21.8868 14.7116 21.7862 14.708C21.6856 14.7044 21.5872 14.7365 21.5105 14.7979L17.1998 18.2729C17.0994 18.3527 17.0178 18.4514 16.9604 18.5627C16.903 18.674 16.8711 18.7954 16.8666 18.9191C16.8621 19.0428 16.8853 19.166 16.9345 19.2807C16.9837 19.3954 17.058 19.4991 17.1524 19.5851C17.2469 19.6711 17.3594 19.7375 17.4828 19.7799C17.6062 19.8223 17.7376 19.8399 17.8686 19.8314C17.9997 19.823 18.1273 19.7887 18.2434 19.7308C18.3595 19.6729 18.4614 19.5927 18.5425 19.4954L22.0838 15.3198C22.1452 15.247 22.1761 15.1555 22.1706 15.0627C22.1651 14.9699 22.1236 14.8822 22.0539 14.8164V14.8174Z"fill="white" /><path fill-rule="evenodd" clip-rule="evenodd"d="M9.417 18.7081C9.41804 17.611 9.67317 16.5274 10.1646 15.5329C10.656 14.5384 11.3718 13.6569 12.2621 12.95C13.1524 12.2432 14.1957 11.7279 15.3191 11.4402C16.4426 11.1525 17.6191 11.0994 18.7666 11.2844C19.9141 11.4695 21.005 11.8884 21.9629 12.5117C22.9209 13.1351 23.723 13.948 24.3131 14.8937C24.9032 15.8393 25.2672 16.895 25.3796 17.9869C25.492 19.0788 25.3502 20.1806 24.964 21.2156C24.522 22.3963 23.119 22.7251 22.032 22.3934C20.726 21.9949 18.892 21.535 17.417 21.535C15.943 21.535 14.107 21.9949 12.802 22.3934C11.715 22.7251 10.312 22.3963 9.87 21.2156C9.56936 20.4099 9.41618 19.5621 9.417 18.7081ZM17.417 12.1119C16.2974 12.1117 15.194 12.3645 14.1995 12.8491C13.205 13.3338 12.3484 14.0362 11.7016 14.8973C11.0547 15.7585 10.6365 16.7533 10.4821 17.7982C10.3277 18.8432 10.4415 19.9078 10.814 20.9027C11.017 21.4445 11.737 21.7282 12.494 21.4964C13.814 21.0949 15.775 20.5927 17.417 20.5927C19.059 20.5927 21.021 21.094 22.34 21.4973C23.097 21.7282 23.817 21.4445 24.02 20.9027C24.3925 19.9078 24.5063 18.8432 24.3519 17.7982C24.1974 16.7533 23.7793 15.7585 23.1324 14.8973C22.4856 14.0362 21.629 13.3338 20.6345 12.8491C19.64 12.3645 18.5366 12.1117 17.417 12.1119Z"fill="white" /></g></svg>
                                <p>Speed</p>
                            </div>
                            <div id="speedoo" class="text-center">
                                0
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row align-items-center">
                    <div class="col-xl-4 col-lg-5 col-md-4 d-flex justify-content-center">
                        <div class="text-center w-100 position-relative p-4" id="carRotate" style="max-width:200px;">
                            <p id="wheelfl" class="position-absolute top-0 start-0 m-0 mt-5">0</p>
                            <p id="wheelfr" class="wheelSpeed position-absolute top-0 end-0 m-0 mt-5">0</p>
                            <img src="{{asset('assets/icons/car.png')}}" class="w-100" alt="Car Logo">
                            <p id="wheelbl" class="wheelSpeed position-absolute bottom-0 start-0 mb-5 m-0">0</p>
                            <p id="wheelbr" class="wheelSpeed position-absolute bottom-0 end-0 mb-5 m-0">0</p>
                        </div>
                    </div>
                    <div id="progressSec" class="col-xl-8 col-lg-7 col-md-8">
                        <div class="text-center mb-2">
                            <strong class="text-capitalize">Progress <span id="current_distance"></span> / <span id="target_distance"></span></strong>
                        </div>
                        <div class="progress w-100">
                            <div class="progress-bar progress-bar-striped bg-danger progress-bar-animated" id="progressbar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
                       <div class="row p-2">
            <strong class="fs-2 text-center">Ultrasonic reads</strong>
            <div class="col-md-3 p-1">
                <div class="bg-success bg-opacity-10 border border-1 border-success rounded-4 d-flex flex-column justify-content-center align-items-center gap-1">
                    <strong class="fs-4">Left</strong>
                    <p class="fs-5" id="read1"></p>
                </div>
            </div>
            <div class="col-md-3 p-1">
                <div class="bg-success bg-opacity-10 border border-1 border-success rounded-4 d-flex flex-column justify-content-center align-items-center gap-1">
                    <strong class="fs-4">Front</strong>
                    <p class="fs-5" id="read2"></p>
                </div>
            </div>
            <div class="col-md-3 p-1">
                <div class="bg-success bg-opacity-10 border border-1 border-success rounded-4 d-flex flex-column justify-content-center align-items-center gap-1">
                    <strong class="fs-4">Back</strong>
                    <p class="fs-5" id="read3"></p>
                </div>
            </div>
            <div class="col-md-3 p-1">
                <div class="bg-success bg-opacity-10 border border-1 border-success rounded-4 d-flex flex-column justify-content-center align-items-center gap-1">
                    <strong class="fs-4">Right</strong>
                    <p class="fs-5" id="read4"></p>
                </div>
            </div>
        </div>
            </div>
        </div>
        <div id="pathLocSec" class="col-12 col-lg-6 d-flex flex-column">
            <div class="col-12 pb-3">
                <div class="px-2">
                    <div id="seqSec" class="col-12 pb-3">
                        <div class="p-2">
                        <div class="text-center">
                            <strong class="text-capitalize">&lt; Execute Sequence &gt;</strong>
                        </div>
                        <div class="row justify-content-center align-content-center align-items-center flex-row">
                            <div class="col-6">
                                <label class="text-muted" for="lengthInput">Length</label>
                                <input type="number" class="form-control" placeholder="Type in cm" id="lengthInput">
                            </div>
                            <div class="col-6">
                                <label class="text-muted" for="widthInput">Width</label>
                                <input type="number" class="form-control" placeholder="Type in cm" id="widthInput">
                            </div>
                            <div class="col-12 mt-2">
                                <label class="text-muted" for="speedShapeInput">Speed</label>
                                <input type="number" class="form-control" value="50" placeholder="0 to 100" id="speedShapeInput">
                            </div>
                            <div class="col-12 text-center mt-2 d-flex justify-content-around">
                                <div id="squareDiv" class="col-3 bg-success bg-opacity-10 border border-success border-opacity-50 rounded-4 p-2" style="cursor: pointer;">
                                    <svg width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g clip-path="url(#clip0_256_246)"><path d="M3.66699 1.5C3.26917 1.5 2.88764 1.65804 2.60633 1.93934C2.32503 2.22064 2.16699 2.60218 2.16699 3V21C2.16699 21.3978 2.32503 21.7794 2.60633 22.0607C2.88764 22.342 3.26917 22.5 3.66699 22.5H21.667C22.0648 22.5 22.4463 22.342 22.7277 22.0607C23.009 21.7794 23.167 21.3978 23.167 21V3C23.167 2.60218 23.009 2.22064 22.7277 1.93934C22.4463 1.65804 22.0648 1.5 21.667 1.5H3.66699ZM21.667 0C22.4626 0 23.2257 0.316071 23.7883 0.87868C24.3509 1.44129 24.667 2.20435 24.667 3V21C24.667 21.7956 24.3509 22.5587 23.7883 23.1213C23.2257 23.6839 22.4626 24 21.667 24H3.66699C2.87134 24 2.10828 23.6839 1.54567 23.1213C0.983063 22.5587 0.666992 21.7956 0.666992 21V3C0.666992 2.20435 0.983063 1.44129 1.54567 0.87868C2.10828 0.316071 2.87134 0 3.66699 0L21.667 0Z"fill="#28A745" /></g><defs><clipPath id="clip0_256_246"><rect width="24" height="24" fill="white" transform="matrix(-1 0 0 1 24.667 0)" /></clipPath></defs></svg>
                                </div>
                                <div id="triDiv" class="col-3 bg-danger bg-opacity-10 border border-danger border-opacity-50 rounded-4 p-2" style="cursor: pointer;">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g clip-path="url(#clip0_256_250)"><path d="M11.9066 2.61707C11.936 2.60095 11.969 2.59268 12.0026 2.59307C12.0356 2.59294 12.0681 2.60119 12.097 2.61707C12.1312 2.63787 12.1591 2.66738 12.1781 2.70257L22.4635 20.2031C22.5175 20.2931 22.516 20.3891 22.4665 20.4776C22.4459 20.5128 22.4184 20.5434 22.3855 20.5676C22.3566 20.5874 22.3215 20.5964 22.2865 20.5931H1.71855C1.68358 20.5964 1.64855 20.5874 1.61955 20.5676C1.58672 20.5434 1.55915 20.5128 1.53855 20.4776C1.51446 20.4357 1.50204 20.3882 1.50256 20.3399C1.50309 20.2916 1.51655 20.2444 1.54155 20.2031L11.8256 2.70257C11.8445 2.66738 11.8724 2.63787 11.9066 2.61707ZM13.4726 1.94207C13.3241 1.68341 13.11 1.46852 12.8519 1.31908C12.5938 1.16964 12.3008 1.09094 12.0026 1.09094C11.7043 1.09094 11.4113 1.16964 11.1532 1.31908C10.8951 1.46852 10.681 1.68341 10.5326 1.94207L0.247053 19.4426C-0.438447 20.6096 0.383553 22.0931 1.71705 22.0931H22.2865C23.62 22.0931 24.4435 20.6081 23.7565 19.4426L13.4726 1.94207Z"fill="#DC3545" /></g><defs><clipPath id="clip0_256_250"><rect width="24" height="24" fill="white" /></clipPath></defs></svg>
                                </div>
                                <div id="rectDiv" class="col-3 bg-info bg-opacity-10 border border-info border-opacity-50 rounded-4 p-2" style="cursor: pointer;">
                                    <svg width="42" height="26" viewBox="0 0 42 26" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M37.334 1H5.33398C3.12485 1 1.33398 2.79086 1.33398 5V21C1.33398 23.2091 3.12485 25 5.33398 25H37.334C39.5431 25 41.334 23.2091 41.334 21V5C41.334 2.79086 39.5431 1 37.334 1Z"stroke="#007BFF" stroke-linecap="round" stroke-linejoin="round" /></svg>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                    <div class="p-2">
                        <div class="text-center">
                            <strong class="text-capitalize">&lt; Execute path &gt;</strong>
                        </div>

                        <div class="row justify-content-center align-content-center align-items-center flex-row">
                            <div class="col-6">
                                <label class="text-muted" for="angleInput">Angle</label>
                                <input type="number" class="form-control" placeholder="in degrees" id="angleInput">
                            </div>
                            <div class="col-6">
                                <label class="text-muted" for="distanceInput">Distance</label>
                                <input type="number" class="form-control" placeholder="Type in cm" id="distanceInput">
                            </div>
                            <div class="col-12 mt-2">
                                <label class="text-muted" for="speedInput">Speed</label>
                                <input type="number" class="form-control" value="50" placeholder="0 to 100" id="speedInput">
                            </div>
                            <div class="col-12 text-center">
                                <button id="pathSubmit" class="btn btn-primary text-white mt-2">Apply Path</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="px-2">
                    <div class="p-2 mt-3">
                        <div class="text-center">
                            <strong class="text-capitalize">&lt; Go To Location &gt;</strong>
                        </div>

                        <div class="row justify-content-center align-content-center align-items-center flex-row">
                            <div class="col-6">
                                <label class="text-muted" for="xInput">X</label>
                                <input type="number" class="form-control" placeholder="Type in cm" id="xInput">
                            </div>
                            <div class="col-6">
                                <label class="text-muted" for="yInput">Y</label>
                                <input type="number" class="form-control" placeholder="Type in cm" id="yInput">
                            </div>
                            <div class="col-12 mt-2">
                                <label class="text-muted" for="speedLocInput">Speed</label>
                                <input type="number" class="form-control" value="50" placeholder="0 to 100" id="speedLocInput">
                            </div>
                            <div class="col-12 text-center">
                                <button id="locationSubmit" class="btn btn-success mt-2">Goooo</button>
                            </div>
                        </div>
                    </div>
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
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3"crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V"crossorigin="anonymous"></script>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script src="https://www.gstatic.com/firebasejs/9.17.1/firebase-app-compat.js"></script>
    <script src="https://www.gstatic.com/firebasejs/9.17.1/firebase-database-compat.js"></script>
    <script src="{{asset('assets/auto.js')}}"></script>
    @include('sweetalert::alert')
</body>
</html>
