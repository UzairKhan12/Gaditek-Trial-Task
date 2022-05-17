<?php

namespace App\Services;

use App\Libraries\LumenWrapperClass;

class BlogService extends Service
{
    public function __construct()
    {
        $this->wrapper_class = new LumenWrapperClass();

        $this->end_point_slug = 'blog';

        $this->module_name = 'blogs';
    }

    public function getDataTableColumns()
    {
        return [
            [
                'title' => 'Title',
                'data' => 'title'
            ],
            [
                'title' => 'Description',
                'data' => 'description'
            ],
            [
                'title' => 'Actions',
                'data' => 'action'
            ]
        ];
    }
}
