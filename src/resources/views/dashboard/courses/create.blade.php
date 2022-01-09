@extends('dashboard.layouts.main')
@section('title', 'Create Course')

@push('vendor-css')
    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/forms/select/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/extensions/jquery.rateyo.min.css') }}">
    <!-- END: Vendor CSS-->
@endpush

@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/forms/validation/form-validation.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/extensions/ext-component-ratings.css') }}">
    <link href="https://cdn.jsdelivr.net/timepicker.js/latest/timepicker.min.css" rel="stylesheet"/>
    <style>
        ._jw-tpk-container {
            height: 180px !important;
        }
    </style>

@endpush

@section('content')
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-12 mb-2 mt-1">
                    <div class="breadcrumbs-top">
                        <h5 class="content-header-title float-left pr-1 mb-0">{{ __('Create Course') }}</h5>
                        <div class="breadcrumb-wrapper d-none d-sm-block">
                            <ol class="breadcrumb p-0 mb-0 pl-1">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard.home') }}"><i class="bx bx-home-alt"></i></a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{ route('courses.index') }}">{{ __('Courses') }}</a>
                                </li>
                                <li class="breadcrumb-item active">{{ __('Create Course') }}
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                @include('dashboard.layouts.includes.alerts')
                <section class="simple-validation">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">{{ __('Create Course') }}</h4>
                                </div>
                                <div class="card-body">
                                    <form id="jquery-val-form" method="POST" action="{{ route('courses.store') }}">
                                        @csrf
                                        <div class="form-group">
                                            <label class="form-label" for="course-name">{{ __('course Name') }} <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="course Name" required/>
                                        </div>
                                        <div class="form-group">
                                            <label for="course-category">{{ __('Categories') }}</label><span class="text-danger">*</span>
                                            @if(count($categories))
                                                <select class="form-control select2" name="category_id" required>
                                                    <option value=""></option>
                                                    @foreach($categories as $category)
                                                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                                    @endforeach
                                                </select>
                                            @else
                                                <div class="text-dark">
                                                    There's no categories in our database, <a href="{{ route('categories.create') }}">Create new category</a>
                                                </div>
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label" for="course-description">{{ __('Course Description') }}</label>
                                            <textarea type="text" value="{{ old('description') }}" name="description" placeholder="Type your Course Description here" rows="3" class="form-control">{{ old('description') }}</textarea>
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label" for="time">{{ __('Course Hours') }} <span class="text-danger">*</span></label>
                                            <input type="text" id="time" class="form-control" name="hours" placeholder="Course Hours" value="{{ old('hours') }}" required>
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label" for="course-rating">{{ __('Course Ratings') }}</label>
                                            <div class="onChange-event-ratings"></div>
                                            <div class="counter-wrapper mt-50">
                                                <strong>Course Ratings:</strong>
                                                <span class="counter"></span>
                                            </div>
                                            <input type="hidden" id="rating" value="{{ old('rating') }}" name="rating">
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label" for="course-views">{{ __('Course Views') }} <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="course-views" name="views" placeholder="Course Views" required/>
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label" for="course-level">{{ __('Course Level') }} <span class="text-danger">*</span></label>
                                            <select class="form-control select2" name="level" required>
                                                <option value=""></option>
                                                <option value="beginner" {{ old('level') == "beginner" ? 'selected' : '' }}>{{ __('Beginner') }}</option>
                                                <option value="immediate" {{ old('level') == "immediate" ? 'selected' : '' }}>{{ __('Immediate') }}</option>
                                                <option value="high" {{ old('level') == "high" ? 'selected' : '' }}>{{ __('High') }}</option>
                                            </select>
                                        </div>

                                        <div class="form-group row mt-2">
                                            <div class="col-md-8 d-flex" style="align-items: end;">
                                                <label for="status_toggle">{{ __('Active Status') }}</label>
                                                <div class="custom-control custom-switch custom-control-inline ml-1">
                                                    <input {{ old('active') == 'on' ? 'checked' : '' }} name="active" type="checkbox" class="custom-control-input" id="customSwitch1">
                                                    <label class="custom-control-label mr-1" for="customSwitch1">
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div><br></div>
                                        <div class="row">
                                            <div class="col-12">
                                                <button type="submit" class="btn btn-primary" name="submit" value="Submit">{{ __('Add') }}
                                                    <i class="bx bx-plus"></i>
                                                </button>
                                                <a href="{{ route('courses.index') }}" class="btn btn-secondary">{{ __('Cancel') }}</a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection

@push('vendor-js')
    <!-- BEGIN: Page Vendor JS-->
    <script src="{{asset('app-assets/vendors/js/forms/select/select2.full.min.js')}}"></script>
    <script src="{{asset('app-assets/vendors/js/forms/validation/jquery.validate.min.js')}}"></script>
    <script src="{{asset('app-assets/vendors/js/extensions/jquery.rateyo.min.js')}}"></script>
    <!-- END: Page Vendor JS-->
@endpush

@push('javascript')
    <script src="{{asset('app-assets/js/scripts/forms/validation/form-validation.js')}}"></script>
    <script src="{{asset('app-assets/js/scripts/extensions/ext-component-ratings.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/timepicker.js/latest/timepicker.min.js"></script>

    <script>
        var timepicker = new TimePicker('time', {
            lang: 'en',
            theme: 'dark'
        });
        timepicker.on('change', function(evt) {

            var value = (evt.hour || '00') + ':' + (evt.minute || '00');
            evt.element.value = value;

        });

        $(".onChange-event-ratings").click(function(){
            $('#rating').val($('.counter').text());
        });

    </script>
@endpush
