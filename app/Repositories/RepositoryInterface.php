<?php

namespace App\Repositories;

interface RepositoryInterface
{
    public function get();

    public function findOrFail($id);

    public function create($attributes = []);

    public function update($id, $attributes = []);

    public function destroy($id);

    public function with($relation);

    public function load($model, $relation);
}
