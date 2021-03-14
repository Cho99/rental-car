<?php

namespace App\Repositories\Address;

use App\Models\Address;
use App\Repositories\BaseRepository;

class AddressRepository extends BaseRepository implements AddressRepositoryInterface
{
    public function getModel()
    {
        return Address::class;
    }

    public function getDistrict()
    {
        return $this->model->where('parent_id', config('address.code_hanoi'))->get();
    }

    public function getWard($id) 
    {
        return $this->model->where('parent_id', $id)->get();
    }
}
