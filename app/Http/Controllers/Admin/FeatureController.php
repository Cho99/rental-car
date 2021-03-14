<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\FeatureRequest;
use App\Repositories\Feature\FeatureRepositoryInterface;
use Illuminate\Http\Request;

class FeatureController extends Controller
{
    protected $featureRepo;

    public function __construct(
        FeatureRepositoryInterface $featureRepo
    ) {
        $this->featureRepo = $featureRepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $features = $this->featureRepo->get();

        return view('admin.feature.index', compact('features'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.feature.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FeatureRequest $request)
    {
        $image = '';
        if ($request->hasFile('image')) {
            $file = $request->image;
            $file->move('upload/feature', $file->getClientOriginalName());
            $image = $file->getClientOriginalName();
        }
        $result = $this->featureRepo->create([
            'name' => $request->name,
            'image' => $image,
        ]);
        if ($result) {
            return redirect()->route('admin.features.index')->with('infoMessage',
                trans('message.feature_create_success'));
        }

        return redirect()->route('admin.features.index')->with('infoMessage',
            trans('message.feature_create_fail'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $feature = $this->featureRepo->findOrFail($id);

        return view('admin.feature.edit', compact('feature'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FeatureRequest $request, $id)
    {
        $model = $this->featureRepo->findOrFail($id);
        $image = $model->image;
        if($request->hasFile('image'))
        {
            $file = $request->image;
            $file->move('upload/feature', $file->getClientOriginalName());
            $image = $file->getClientOriginalName();
        }
        $result = $this->featureRepo->update($id, [
            'name' => $request->name,
            'image' => $image
        ]);
        if ($result) {
            return redirect()->route('admin.features.index')->with('infoMessage',
                trans('message.feature_update_success'));
        }

        return redirect()->route('admin.features.index')->with('infoMessage',
            trans('message.feature_update_fail'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = $this->featureRepo->destroy($id);
        if ($result) {
            return redirect()->route('admin.features.index')->with('infoMessage',
                trans('message.feature_delete_success'));
        }

        return redirect()->route('admin.features.index')->with('infoMessage',
            trans('message.feature_delete_fail'));
    }
}
