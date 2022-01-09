@extends('dashboard.layouts.main')
@section('title', 'Edit Category')

@push('vendor-css')
    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/forms/select/select2.min.css') }}">
    <!-- END: Vendor CSS-->
@endpush

@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/forms/validation/form-validation.css') }}">
@endpush

@section('content')
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-12 mb-2 mt-1">
                    <div class="breadcrumbs-top">
                        <h5 class="content-header-title float-left pr-1 mb-0">{{ __('Edit Category') }}</h5>
                        <div class="breadcrumb-wrapper d-none d-sm-block">
                            <ol class="breadcrumb p-0 mb-0 pl-1">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard.home') }}"><i class="bx bx-home-alt"></i></a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{ route('categories.index') }}">{{ __('Category') }}</a>
                                </li>
                                <li class="breadcrumb-item active">{{ __('Edit Category') }}
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
                                    <h4 class="card-title">{{ __('Edit Category') }}</h4>
                                </div>
                                <div class="card-body">
                                    <form id="jquery-val-form" method="POST" action="{{ route('categories.update', $category->id) }}">
                                        @csrf
                                        <div class="form-group">
                                            <label class="form-label" for="basic-default-name">{{ __('Category Name') }} <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="name" value="{{ $category->name }}" placeholder="Category Name" required/>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-8 d-flex" style="align-items: end;">
                                                <label for="status_toggle">{{ __('Active Status') }}</label>
                                                <div class="custom-control custom-switch custom-control-inline ml-1">
                                                    <input {{ $category->active == 1 ? 'checked' : '' }} name="active" type="checkbox" class="custom-control-input" id="customSwitch1">
                                                    <label class="custom-control-label mr-1" for="customSwitch1">
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div><br></div>
                                        <div class="row">
                                            <div class="col-12">
                                                <button type="submit" class="btn btn-primary" name="submit" value="Submit">{{ __('Update') }}
                                                    <i class="bx bx-plus"></i>
                                                </button>
                                                <a href="{{ route('categories.index') }}" class="btn btn-secondary">{{ __('Cancel') }}</a>
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
    <script src="{{asset('app-assets/vendors/js/extensions/moment.min.js')}}"></script>
    <!-- END: Page Vendor JS-->
@endpush