<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddressRequest;
use App\Models\Address;
use App\Repositories\Address\AddressRepositoryInterface;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    protected $addressRepo;

    public function __construct(
        AddressRepositoryInterface $addressRepo
    ) {
        $this->addressRepo = $addressRepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model = $this->addressRepo->getDistrict();
        $addresses = $this->addressRepo->load($model, 'parent');

        return view('admin.address.index', compact('addresses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createDistrict()
    {
        return view('admin.address.createDistrict');
    }

    public function createWard()
    {
        $districts = $this->addressRepo->getDistrict();

        return view('admin.address.createWard', compact('districts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddressRequest $request)
    {
        $parent_id = config('address.code_hanoi');
        if ($request->parent_id) {
            $parent_id = $request->parent_id;
        }
        $result = $this->addressRepo->create([
            'name' => $request->name,
            'parent_id' => $parent_id,
        ]);
        if ($result) {
            return redirect()->route('admin.addresses.index')->with('infoMessage', 'Thành công');
        }

        return redirect()->route('admin.addresses.index')->with('infoMessage', 'Thất bại');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $wards = $this->addressRepo->getWard($id);
        
        return view('admin.address.wardList', compact('wards')); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $address = $this->addressRepo->findOrFail($id);
        $districts = [];
        if ($address->parent_id != config('address.code_hanoi')) {
            $districts = $this->addressRepo->getDistrict();
        }

        return view('admin.address.edit', compact('infoMessage', 'districts'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AddressRequest $request, $id)
    {
        $parent_id = config('address.code_hanoi');
        if ($request->parent_id) {
            $parent_id = $request->parent_id;
        }
        $result = $this->addressRepo->update($id, [
            'name' => $request->name,
            'parent_id' => $parent_id,
        ]);
        if ($result) {
            return redirect()->route('admin.addresses.index')->with('infoMessage', 'Thành công');
        }

        return redirect()->back()->with('infoMessage', 'Thất bại');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = $this->addressRepo->destroy($id);
        if ($result) {
            return redirect()->route('admin.addresses.index')->with('infoMessage', 'Thành công');
        }

        return redirect()->route('admin.addresses.index')->with('infoMessage', 'Thất bại');
    }
}
