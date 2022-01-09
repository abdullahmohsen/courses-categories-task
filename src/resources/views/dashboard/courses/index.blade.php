@extends('dashboard.layouts.main')
@section('title', 'Courses')

@push('vendor-css')
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/tables/datatable/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/tables/datatable/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/tables/datatable/buttons.bootstrap4.min.css')}}">
@endpush

@section('content')
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-12 mb-2 mt-1">
                    <div class="breadcrumbs-top">
                        <h5 class="content-header-title float-left pr-1 mb-0">{{ __('Courses') }}</h5>
                        <div class="breadcrumb-wrapper d-none d-sm-block">
                            <ol class="breadcrumb p-0 mb-0 pl-1">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard.home') }}"><i class="bx bx-home-alt"></i></a>
                                </li>
                                <li class="breadcrumb-item active">{{ __('Courses') }}
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
            @include('dashboard.layouts.includes.alerts')
            <!-- Column selectors with Export Options and print table -->
                <section id="column-selectors">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">
                                        {{ __('Courses List') }}
                                    </h4>
                                    <a id="addRow" href="{{ route('courses.create') }}" class="btn btn-primary">
                                        <i class="bx bx-plus"></i> {{ __('Create') }}
                                    </a>
                                </div>
                                <div class="card-body card-dashboard">
                                    <div class="table-responsive">
                                        <table class="table table-striped dataex-html5-selectors">
                                            <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Name</th>
                                                <th>Category</th>
                                                <th>Rate</th>
                                                <th>Views</th>
                                                <th>Level</th>
                                                <th>hours</th>
                                                <th>Status</th>
                                                <th>Created Date</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($courses as $index => $course)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $course->name }}</td>
                                                    <td>{{ $course->category->name }}</td>
                                                    <td>{{ $course->rating }}</td>
                                                    <td>{{ $course->views }}</td>
                                                    <td>{{ $course->levels }}</td>
                                                    <td>{{ $course->hours }} Minutes</td>
                                                    <td>{{ $course->active == 1 ? 'Active' : 'Inactive' }}</td>
                                                    <td>{{ $course->created }}</td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <span class="bx bx-dots-horizontal-rounded font-medium-3 dropdown-toggle nav-hide-arrow cursor-pointer" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="menu">
                                                            </span>
                                                            <div class="dropdown-menu dropdown-menu-right">
{{--                                                                <a class="dropdown-item" href="{{ route('courses.show', $course->id) }}"><i class="bx bx-show mr-1"></i>{{ __('Show') }}</a>--}}
                                                                <a class="dropdown-item" href="{{ route('courses.edit', $course->id) }}"><i class="bx bx-edit-alt mr-1"></i>{{ __('Edit') }}</a>
                                                                <a class="dropdown-item" href="#" data-confirm="{{__('Are You Sure?').' | '.__('This action can not be undone. Do you want to continue?')}}"
                                                                   data-confirm-yes="document.getElementById('delete-form-{{ $course->id }}').submit();">
                                                                    <i class="bx bx-trash mr-1"></i> {{ __('Delete')}}</a>
                                                                <form action="{{ route('courses.destroy', $course->id) }}" method="post" id="delete-form-{{$course->id}}">
                                                                    @csrf
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tfoot>
                                        </table>
                                    </div>
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
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/buttons.print.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/pdfmake.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/vfs_fonts.js') }}"></script>
@endpush

@push('javascript')
    <!-- BEGIN: Page JS-->
    <script src="{{ asset('app-assets/js/scripts/datatables/datatable.js') }}"></script>
    <script src="{{ asset('assets/js/stisla.js') }}"></script>
    <script src="{{ asset('assets/js/old-scripts.js') }}"></script>
    <!-- END: Page JS-->
@endpush