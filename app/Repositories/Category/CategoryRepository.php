<?php

namespace App\Repositories\Category;

use App\Models\Category;
use App\Repositories\BaseRepository;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{
    public function getModel()
    {
        return Category::class;
    }

    public function getTrademark($key)
    {
        return $this->model->where('parent_id', config('category.trademark'))->orderBy($key, 'desc')->get();
    }
}
