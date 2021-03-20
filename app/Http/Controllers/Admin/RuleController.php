<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Rule\RuleRepositoryInterface;
use Illuminate\Http\Request;

class RuleController extends Controller
{
    protected $ruleRepo;
    public function __construct(
        RuleRepositoryInterface $ruleRepo
    ) {
        $this->ruleRepo = $ruleRepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rules = $this->ruleRepo->get();

        return view('admin.rule.index', compact('rules'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.rule.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $image = '';
        if ($request->hasFile('image')) {
            $file = $request->image;
            $file->move('upload/rule', $file->getClientOriginalName());
            $image = $file->getClientOriginalName();
        }
        $result = $this->ruleRepo->create([
            'name' => $request->name,
            'image' => $image,
        ]);
        if ($result) {
            return redirect()->route('admin.rules.index')->with('infoMessage',
                trans('message.rule_create_success'));
        }

        return redirect()->route('admin.rules.index')->with('infoMessage',
            trans('message.rule_create_fail'));
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
        $rule = $this->ruleRepo->findOrFail($id);

        return view('admin.rule.edit', compact('rule'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $model = $this->ruleRepo->findOrFail($id);
        $image = $model->image;
        if($request->hasFile('image'))
        {
            $file = $request->image;
            $file->move('upload/rule', $file->getClientOriginalName());
            $image = $file->getClientOriginalName();
        }
        $result = $this->ruleRepo->update($id, [
            'name' => $request->name,
            'image' => $image
        ]);
        if ($result) {
            return redirect()->route('admin.rules.index')->with('infoMessage',
                trans('message.rule_update_success'));
        }

        return redirect()->route('admin.rules.index')->with('infoMessage',
            trans('message.rule_update_fail'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = $this->ruleRepo->destroy($id);
        if ($result) {
            return redirect()->route('admin.rules.index')->with('infoMessage',
                trans('message.rule_destroy_success'));
        }

        return redirect()->route('admin.rules.index')->with('infoMessage',
            trans('message.rule_destroy_fail'));
    }
}
