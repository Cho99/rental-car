<?php
namespace App\Repositories\Address;

use App\Repositories\RepositoryInterface;

interface AddressRepositoryInterface extends RepositoryInterface
{
    /**
     * Get Districts
     *
     * @return void
     */
    public function getDistrict();

    /**
     * Get Ward function
     *
     * @param  int  $id
     * @return void
     */
    public function getWard($id);

    public function getHotDistrict();
}
