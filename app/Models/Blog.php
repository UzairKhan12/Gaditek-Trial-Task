<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'description',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */

    public function getAllBlogs($params)
    {
        $query = $this;

        $total_docs = $query->count();

        if (isset($params['search'])) {

            $query = $query->where(function ($q) use ($params) {
                $q->orWhere('title', 'like', '%' . $params['search'] . '%');
                $q->orWhere('description', 'like', '%' . $params['search'] . '%');
            });
        }

        $total_docs_with_filter = $query->count();

        $data = $query->skip($params['offset'] ?? 0)->take($params['limit'] ?? 10)->orderBy('created_at', 'DESC')->get();

        return [
            'docs' => $data,
            'total_docs' => $total_docs,
            'total_docs_with_filter' => $total_docs_with_filter
        ];
    }
}
