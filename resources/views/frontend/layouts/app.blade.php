<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    {{-- googlefont --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- custom style -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/main.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/style.css') }}">
    {{-- fontawesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    {{-- date range picker --}}
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    @yield('extra_css')
</head>
<body>
    <div id="app">
        <section class="header-menu py-3">
            <div class="row justify-content-center mx-0">
                <div class="col-md-8">
                    <div class="d-flex justify-content-center align-items-center">
                        <div class="col-2 text-center">
                            @if(!request()->is('/'))
                            <a href="" class="back-btn">
                                <i class="fas fa-angle-left"></i>
                            </a>
                            @endif
                        </div>
                        <div class="col-8">
                                <h3 class="mb-0 text-center">@yield('title')</h3>
                        </div>
                        <div class="col-2 text-center">
                           <a href="{{url('notifications')}}" class="noti-btn">
                                <i class="fas fa-bell"></i>
                                <x-notification-count />
                           </a>
                        </div>    
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="row justify-content-center mx-0">
                <div class="col-md-8">
                    @yield('content')
                </div>
            </div>
        </section>

        <section class="bottom-menu">
            <div class="scan-div d-flex justify-content-center align-items-center">
                <a href="{{url('scan-and-pay')}}" class="scan-wrapper d-flex justify-content-center align-items-center">
                    <div class="scan-inner d-flex justify-content-center align-items-center">
                        <div class="scan-content d-flex justify-content-center align-items-center">
                            <i class="fas fa-qrcode m-0"></i>
                        </div>
                    </div>
                </a>
                
            </div>
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-6">
                            <div class="row">
                                <div class="col-6 text-center">
                                    <a href="{{ route('home') }}" class="d-block">
                                        <i class="fas fa-home"></i>
                                        <p>Home</p>
                                    </a>
                                </div>
                                <div class="col-6 text-center">
                                    <a href="{{ route('wallet') }}" class="d-block">
                                        <i class="fas fa-wallet"></i>
                                        <p>Wallet</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="row">
                                <div class="col-6 text-center">
                                    <a href="{{route('transactions.index')}}" class="d-block">
                                        <i class="fas fa-exchange-alt"></i>
                                        <p>Transaction</p>
                                    </a>
                                </div>
                                <div class="col-6 text-center">
                                   <a href="{{ route('profile')}}" class="d-block">
                                        <i class="fas fa-user"></i>
                                        <p>Profile</p>
                                   </a>
                                </div>
                            </div> 
                        </div>
                    </div>                                           
                </div>
            </div>
        </section>
    </div>

    {{-- sweeralert2 --}}
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="{{ asset('frontend/js/main.js') }}"></script>
    {{-- date range picker --}}
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            const Toast = Swal.mixin({
                          toast: true,
                          position: 'top-end',
                          showConfirmButton: false,
                          timer: 3000,
                          timerProgressBar: true,
                          didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                          }
                        });
            @if (session('create')) {
                Toast.fire({
                  icon: 'success',
                  title: "{{session('create')}}"
                })
            }
            @endif
            @if (session('update')) {
                Toast.fire({
                  icon: 'success',
                  title: "{{session('update')}}"
                })
            }
            @endif
             @if (session('success')) {
                Toast.fire({
                  icon: 'success',
                  title: "{{session('success')}}"
                })
            }
            @endif

            $('.back-btn').on('click', function(e) {
                e.preventDefault();
                window.history.go(-1);

            })
        })
    </script>
    @yield('scripts')
</body>
</html>
