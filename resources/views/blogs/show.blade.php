@extends('main')

@section('main_content')
    <!--  BEGIN CONTENT AREA  -->
    <div id="content" class="main-content">
        <div class="layout-px-spacing">
            @include('includes.flash_messages')
            <div class="row layout-top-spacing">
                <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                    <div class="widget-content widget-content-area br-6">
                        <a href="{{ route(config('constants.ADMIN_PREFIX') . $module_name . '_add') }}">
                            <button class="btn btn-primary">
                                Add {{ $module_add_title }}
                            </button>
                        </a>
                        <div class="table-responsive mb-4 mt-4">
                            @include('includes.datatable' , [
                                'module_name' => $module_name,
                                'ajax_data_url' => route($module_ajax_listing_url),
                                'module_columns' => $primary_dt_columns
                            ])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--  END CONTENT AREA  -->
@endsection


