<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->primary_model = new Blog();
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required'
        ]);

        $data = $this->primary_model->create($request->only($this->primary_model->getFillable()));

        return sendSuccessResponse($data, 'Blog created successfully');
    }

    public function update(Request $request, $id)
    {
        $this->primary_model->findOrFail($id)->update($request->only($this->primary_model->getFillable()));

        $data = $this->primary_model->findOrFail($id);

        return sendSuccessResponse($data, 'Blog updated successfully');
    }

    public function delete($id)
    {
        $this->primary_model->findOrFail($id)->delete();

        return sendSuccessResponse([], 'Blog deleted successfully');
    }

    public function get($id)
    {
        $data = $this->primary_model->findOrFail($id);

        return sendSuccessResponse($data, 'Blog fetched successfully');
    }

    public function getAll(Request $request)
    {
        $data = $this->primary_model->getAllBlogs($request->all());

        return sendSuccessResponse($data, 'Blogs fetched successfully');
    }

}
