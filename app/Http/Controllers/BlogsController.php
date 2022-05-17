<?php

namespace App\Http\Controllers;

use App\Http\Requests\Blogs\StoreBlog;
use App\Http\Requests\Blogs\UpdateBlog;
use App\Services\BlogService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogsController extends Controller
{
    public function __construct()
    {
        $this->blog_service = new BlogService();

        $this->data_assign['module_name'] = 'blogs';

        $this->data_assign['module_add_title'] = ucfirst($this->data_assign['module_name']);
    }

    public function show()
    {
        $this->data_assign['module_ajax_listing_url'] = $this->data_assign['module_name'] . '_dtListing';

        $this->data_assign['primary_dt_columns'] = $this->blog_service->getDataTableColumns();

        return view($this->data_assign['module_name'] . '.' . Str::snake(__FUNCTION__), $this->data_assign);
    }

    public function dtListing(Request $request)
    {
        return $this->blog_service->getAllEntities($request->all());
    }

    public function add()
    {
        return view($this->data_assign['module_name'] . '.' . Str::snake(__FUNCTION__), $this->data_assign);
    }

    public function store(StoreBlog $request)
    {
        $this->blog_service->createEntity($request->all());

        return redirect()->route($this->data_assign['module_name'].'_show');
    }

    public function edit($id)
    {
        $this->data_assign['data'] = $this->blog_service->getSingleEntity($id);

        return view($this->data_assign['module_name'] . '.' . Str::snake(__FUNCTION__), $this->data_assign);
    }

    public function update(UpdateBlog $request)
    {
        $this->blog_service->updateEntity($request->all());

        return redirect()->route($this->data_assign['module_name'].'_show');
    }

    public function delete($id)
    {
        $this->blog_service->deleteEntity($id);

        return redirect()->back();
    }
}
