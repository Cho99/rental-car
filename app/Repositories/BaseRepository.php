<?php

namespace App\Repositories;

use App\Repositories\RepositoryInterface;

abstract class BaseRepository implements RepositoryInterface
{
    protected $model;

    public function __construct()
    {
        $this->setModel();
    }

    abstract public function getModel();

    public function setModel()
    {
        $this->model = app()->make(
            $this->getModel()
        );
    }

    public function get()
    {
        return $this->model->orderBy('id', 'DESC')->get();
    }

    public function findOrFail($id)
    {
        return $this->model->findOrFail($id);
    }

    public function create($attributes = [])
    {
        return $this->model->create($attributes);
    }

    public function update($id, $attributes = [])
    {
        $result = $this->model->findOrFail($id);
        if ($result) {
            return $result->update($attributes);
        }

        return false;
    }

    public function destroy($id)
    {
        $result = $this->model->findOrFail($id);

        if ($result) {
            $result->delete();

            return true;
        }

        return false;
    }

    public function with(array $relation)
    {
        return $this->model->with($relation)->get();
    }

    public function load($model, $relation)
    {
        return $model->load($relation);
    }

    public function attach($collection, $relation, $param = [])
    {
        return $collection->$relation()->attach($param);
    }

    public function sync($collection, $relation, $items = [])
    {
        return $collection->$relation()->sync($items);
    }
}
