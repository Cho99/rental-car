<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Report;
use App\Jobs\ReplyJob;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reports = Report::with('user', 'car')->orderBy('id', 'desc')->get();

        return view('admin.report.index', compact('reports'));
    }

    public function reply(Request $request, $id)
    {
        $report = Report::with('user')->findOrFail($id);
        $report->update([
            'status' => Report::READ,
        ]);

        $data = [
            'user_name' => $report->user->name,
            'content' => $request->input('content'),
        ];

        ReplyJob::dispatch($report->user->email, $data);

        return response()->json(
            'success',
        );
    }
}
