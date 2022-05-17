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
                                    <h4>Add {{ $module_add_title }}</h4>
                                </div>
                            </div>
                        </div>
                        <div class="widget-content widget-content-area">
                            <form method="post"
                                  action="{{ route($module_name . '_add') }}">
                                @csrf
                                <div class="row mb-12">
                                    <div class="col">
                                        <label for="exampleFormControlInput2">Title</label>
                                        <input type="text" class="form-control" name="title" placeholder="Title"
                                               required value="{{ old('title') }}">
                                        @include('includes.single_flash',['input_name' => 'title'])
                                    </div>
                                </div>

                                <div class="row mb-12">
                                    <div class="col">
                                        <label for="exampleFormControlInput2">Description</label>
                                        <textarea type="text" class="form-control" name="description"
                                                  required placeholder="Description">{{ old('description') }}</textarea>
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


