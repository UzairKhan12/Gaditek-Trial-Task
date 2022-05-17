@extends('main')


@section('main_content')
    <!--  BEGIN CONTENT AREA  -->
    <div id="content" class="main-content">
        <div class="layout-px-spacing">

            <div class="row layout-top-spacing">
                <div class="col-lg-12 col-12 layout-spacing">
                    @include('includes.flash_messages')
                    <div class="statbox widget box box-shadow">
                        <div class="widget-header">
                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                    <h4>Edit {{ $module_add_title }}</h4>
                                </div>
                            </div>
                        </div>
                        <div class="widget-content widget-content-area">
                            <form method="post"
                                  action="{{ route(config('constants.ADMIN_PREFIX') . $module_name . '_update') }}">
                                @csrf
                                <input type="hidden" name="id" value="{{ $data->id }}">
                                <div class="row mb-4">
                                    <div class="col">
                                        <label for="exampleFormControlInput2">Title</label>
                                        <input type="text" class="form-control" name="title" placeholder="Title"
                                               required value="{{ $data->title }}">
                                        @include('includes.single_flash',['input_name' => 'title'])
                                    </div>
                                </div>

                                <div class="row mb-12">
                                    <div class="col">
                                        <label for="exampleFormControlInput2">Description</label>
                                        <textarea type="text" class="form-control" name="description"
                                                  placeholder="Description" required>{{ $data->description }}</textarea>
                                        @include('includes.single_flash',['input_name' => 'description'])
                                    </div>
                                </div>
                                <input type="submit" class="mt-4 mb-4 btn btn-primary">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--  END CONTENT AREA  -->
@endsection


