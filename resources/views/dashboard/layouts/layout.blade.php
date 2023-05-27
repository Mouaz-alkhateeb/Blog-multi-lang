<!--
 * CoreUI - Open Source Bootstrap Admin Template
 * @version v1.0.0-alpha.2
 * @link http://coreui.io
 * Copyright (c) 2016 creativeLabs Łukasz Holeczek
 * @license MIT
 -->
 <!DOCTYPE html>
 <html lang="IR-fa" dir="rtl">

 <head>
     <meta charset="utf-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
     <meta name="author" content="Lukasz Holeczek">
     <meta name="description" content="{{ $settings->translate(app()->getlocale())->content }}">
    <meta name="keyword" content="{{ $settings->translate(app()->getlocale())->title }}">


     <link rel="shortcut icon" href="{{ asset($settings->favicon) }}">
    <title>{{ $settings->translate(app()->getlocale())->title }}</title>
     {{-- <title>Blog</title> --}}
     <!-- Icons -->


     <link href="{{asset('adminAssets/css/font-awesome.min.css')}}" rel="stylesheet">
     <link href="{{asset('adminAssets/css/simple-line-icons.css')}}" rel="stylesheet">
     <!-- Main styles for this application -->
     <link href="{{asset('adminAssets/dest/style.css')}}" rel="stylesheet">
     <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">

 </head>


 <body class="navbar-fixed sidebar-nav fixed-nav">
     <header class="navbar">
         <div class="container-fluid">
             <button class="navbar-toggler mobile-toggler hidden-lg-up" type="button">&#9776;</button>
             <a class="navbar-brand" href="#" style="background-image: url({{ asset($settings->logo) }});"></a>
             <ul class="nav navbar-nav hidden-md-down">
                 <li class="nav-item">
                     <a class="nav-link navbar-toggler layout-toggler" href="#">&#9776;</a>
                 </li>
             </ul>
             <ul class="nav navbar-nav pull-left hidden-md-down">

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle nav-link" data-toggle="dropdown" href="#" role="button"
                        aria-haspopup="true" aria-expanded="false">
                        <span class="hidden-md-down">{{ LaravelLocalization::getCurrentLocaleNative() }}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">

                        @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            <a class="dropdown-item" rel="alternate" hreflang="{{ $localeCode }}"
                                href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                {{ $properties['native'] }}
                            </a>
                        @endforeach

                    </div>
                </li>

                 <li class="nav-item dropdown" >
                     <a style="margin-left: 25px;margin-right:10px" class="nav-link dropdown-toggle nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                         {{-- <img src="{{asset('adminAssets/img/avatars/6.jpg')}}" class="img-avatar" alt="admin@bootstrapmaster.com"> --}}
                         {{ auth()->user()->name }}({{ auth()->user()->status }})
                     </a>
                     <div class="dropdown-menu dropdown-menu-right">

                         <div class="divider"></div>
                         <a class="dropdown-item" href="{{ route('logout') }}"  onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();"><i class="fa fa-lock"></i>
                                {{ __('words.logout') }}
                        </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                     </div>
                 </li>

             </ul>
         </div>
     </header>

     @include('dashboard.layouts.sidebar')
     <!-- Main content -->
     <main class="main">
        @yield('body')
     </main>

     <aside class="aside-menu">
         <ul class="nav nav-tabs" role="tablist">
             <li class="nav-item">
                 <a class="nav-link active" data-toggle="tab" href="#timeline" role="tab"><i class="icon-list"></i></a>
             </li>
             <li class="nav-item">
                 <a class="nav-link" data-toggle="tab" href="#messages" role="tab"><i class="icon-speech"></i></a>
             </li>
             <li class="nav-item">
                 <a class="nav-link" data-toggle="tab" href="#settings" role="tab"><i class="icon-settings"></i></a>
             </li>
         </ul>
         <!-- Tab panes -->

     </aside>

     <footer class="footer">
         <span class="text-left">
             <a href="http://coreui.io">CoreUI</a> &copy; 2023 creativeLabs.
         </span>
         <span class="pull-right">
             Powered by <a href="http://coreui.io">CoreUI</a>
         </span>
     </footer>
     <!-- Bootstrap and necessary plugins -->
     <script src="{{asset('adminAssets/js/libs/jquery.min.js')}}"></script>
     <script src="{{asset('adminAssets/js/libs/tether.min.js')}}"></script>
     <script src="{{asset('adminAssets/js/libs/bootstrap.min.js')}}"></script>
     <script src="{{asset('adminAssets/js/libs/pace.min.js')}}"></script>

     <!-- Plugins and scripts required by all views -->
     <script src="{{asset('adminAssets/js/libs/Chart.min.js')}}"></script>

     <!-- CoreUI main scripts -->

     <script src="{{asset('adminAssets/js/app.js')}}"></script>

     <!-- Plugins and scripts required by this views -->
     <!-- Custom scripts required by this view -->
     <script src="{{ asset('adminAssets/js/views/main.js') }}"></script>
     <!-- Grunt watch plugin -->
     <script src="{{ asset('adminAssets') }}/livereload.js"></script>
     <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
     <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>

     <script src="https://cdn.ckeditor.com/ckeditor5/38.0.1/classic/ckeditor.js"></script>


     < <script>
        var allEditors = document.querySelectorAll('#editor');
        for (var i = 0; i < allEditors.length; ++i) {
            ClassicEditor.create(allEditors[i]);
        }

        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
        });
    </script>

     @stack('javascripts')
 </body>

 </html>
