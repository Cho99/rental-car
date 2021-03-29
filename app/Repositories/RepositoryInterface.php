<?php

namespace App\Repositories;

interface RepositoryInterface
{
    public function get();

    public function findOrFail($id);

    public function create($attributes = []);

    public function update($id, $attributes = []);

    public function destroy($id);

    public function with(array $relation);

    public function load($model, $relation);

    public function sync($collection, $relation, $items = []);

    public function attach($collection, $relation, $param = []);
}
