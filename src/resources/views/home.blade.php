<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <title>@yield('title')</title>
    <link rel="apple-touch-icon" href="{{ asset('app-assets/images/ico/apple-icon-120.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('app-assets/images/ico/favicon.ico') }}">
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,600%7CIBM+Plex+Sans:300,400,500,600,700" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/extensions/jquery.rateyo.min.css') }}">
    @stack('vendor-css')
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap-extended.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/colors.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/components.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/themes/dark-layout.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/themes/semi-dark-layout.css') }}">
    <!-- END: Theme CSS-->

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/core/menu/menu-types/vertical-menu.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/dashboard-ecommerce.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/extensions/ext-component-ratings.css') }}">
    @stack('css')
    <!-- END: Page CSS-->

    <link rel="stylesheet" href="{{ asset('app-assets/modules/izitoast/css/iziToast.min.css') }}">
</head>
<!-- END: Head-->

<!-- BEGIN: Body-->
<body class="vertical-layout vertical-menu-modern 2-columns navbar-sticky footer-static" data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">

<!-- BEGIN: Main Menu-->
<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation" data-icon-style="lines">

        </ul>
    </div>
</div>
<!-- END: Main Menu-->


<!-- BEGIN: Content-->
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-body">
            <section class="search-bar-wrapper">
                <!-- Search Bar -->
                <div class="search-bar">
                    <!-- input search -->
                    <form>
                        <fieldset class="page-search-input form-group position-relative">
                            <input type="text" class="form-control rounded-right form-control-lg shadow pl-2" id="search-courses" name="search" placeholder="Search">
                        </fieldset>
                    </form>
                    <!--/ input search -->
                </div>

                <div class="row match-height">
                    <div class="col-12 mt-3 mb-1">
                        <h4 class="text-uppercase">All Courses</h4>
                    </div>
                </div>
                <div class="row match-height">
                    <div class="col-12">
                        <div class="card-deck-wrapper">
                            <div class="card-deck">
                                <div id="dynamic-row" class="row no-gutters">
                                    @foreach($courses as $course)
                                        <div class="col-md-3 col-sm-6 mb-sm-1">
                                            <div class="card">
                                                <img class="card-img-top img-fluid" src="{{ asset('app-assets/images/slider/01.jpg') }}" alt="Card image cap" />
                                                <div class="card-header">
                                                    <h4 class="card-title">{{ $course->name }}</h4>
                                                </div>
                                                <div class="card-body">
                                                    <p class="card-text">
                                                        {{ $course->description ?? "No Description" }}
                                                    </p>
                                                    <p class="">{{ $course->hours }} Minutes</p>
                                                    <div class="d-flex align-items-center">
                                                        <small class="read-only-ratings" data-rateyo-read-only="true"></small>
                                                        <span class="text-muted">({{ $course->views }})</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @if($course->rating == 1)
                                        <style>
                                            .jq-ry-group {
                                                width: 20% !important;
                                            }
                                        </style>
                                        @elseif($course->rating == 2)
                                            <style>
                                                .jq-ry-group {
                                                    width: 40% !important;
                                                }
                                            </style>
                                        @elseif($course->rating == 3)
                                            <style>
                                                .jq-ry-group {
                                                    width: 60% !important;
                                                }
                                            </style>
                                        @elseif($course->rating == 4)
                                            <style>
                                                .jq-ry-group {
                                                    width: 80% !important;
                                                }
                                            </style>
                                        @elseif($course->rating == 5)
                                            <style>
                                                .jq-ry-group {
                                                    width: 100% !important;
                                                }
                                            </style>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pagination justify-content-center mt-3">
                    {{ $courses->links('vendor.pagination.bootstrap-4') }}
                </div>
            </section>
        <!-- Decks section end -->
        </div>
    </div>
</div>

<input type="hidden" name="hidden_page" id="hidden_page" value="1" />
<input type="hidden" name="hidden_column_name" id="hidden_column_name" value="id" />
<input type="hidden" name="hidden_sort_type" id="hidden_sort_type" value="asc" />


<!-- BEGIN: Vendor JS-->
<script src="{{asset('app-assets/vendors/js/vendors.min.js')}}"></script>
<script src="{{asset('app-assets/fonts/LivIconsEvo/js/LivIconsEvo.tools.js')}}"></script>
<script src="{{asset('app-assets/fonts/LivIconsEvo/js/LivIconsEvo.defaults.js')}}"></script>
<script src="{{asset('app-assets/fonts/LivIconsEvo/js/LivIconsEvo.min.js')}}"></script>
<script src="{{asset('app-assets/vendors/js/extensions/jquery.rateyo.min.js')}}"></script>
@stack('vendor-js')
<!-- BEGIN Vendor JS-->


<!-- BEGIN: Theme JS-->
<script src="{{asset('app-assets/js/scripts/configs/vertical-menu-light.js')}}"></script>
<script src="{{asset('app-assets/js/core/app-menu.js')}}"></script>
<script src="{{asset('app-assets/js/core/app.js')}}"></script>
<script src="{{asset('app-assets/js/scripts/components.js')}}"></script>
<script src="{{asset('app-assets/js/scripts/footer.js')}}"></script>
<!-- END: Theme JS-->
<script src="{{ asset('app-assets/modules/izitoast/js/iziToast.min.js') }}"></script>
<script src="{{ asset('app-assets/js/scripts/pages/dashboard-ecommerce.js') }}"></script>
<script src="{{asset('app-assets/js/scripts/extensions/ext-component-ratings.js')}}"></script>
@stack('javascript')
<script type="text/javascript">
    $('body').on('keyup', '#search-courses', function(){
        var searchQuest = $(this).val();
        $.ajax({
            method: 'POST',
            url: '{{ route('courses.search') }}',
            dataType: 'json',
            data: {
                '_token': '{{ csrf_token() }}',
                searchQuest: searchQuest
            },
            success: function (response) {
                var cardRow = '';
                $('#dynamic-row').html('');
                $.each(response, function (index, value){
                    cardRow = `<div class="col-md-3 col-sm-6 mb-sm-1"><div class="card"><img class="card-img-top img-fluid" src="{{ asset('app-assets/images/slider/01.jpg') }}" alt="Card image cap"/>
                        <div class="card-header"><h4 class="card-title">`+ value.name +`</h4></div><div class="card-body"><p class="card-text">`+ value.description +`</p>
                        <p class="">`+ value.hours +` Minutes</p><div class="d-flex align-items-center"><small class="read-only-ratings" data-rateyo-read-only="true"></small>
                        <span class="text-muted">(`+ value.views +`)</span></div></div></div></div>`;
                    $('#dynamic-row').append(cardRow);
                });
            }
        });
    });
</script>



</body>
<!-- END: Body-->

</html>
