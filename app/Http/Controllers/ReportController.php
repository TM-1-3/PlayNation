<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Report;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function store(Request $request)
    {
        // Check if user is banned
        if (Auth::check() && Auth::user()->isBanned()) {
            return back()->withErrors(['form' => 'You cannot submit reports because your account has been banned.']);
        }

        $data = $request->validate([
            'target_type' => 'required|string|in:post,user,group,comment',
            'target_id' => 'required|integer',
            'reason' => 'required|string',
            'details' => 'nullable|string',
        ]);

        $description = $data['reason'];
        if (!empty($data['details'])) {
            $description .= ': ' . $data['details'];
        }

        $report = Report::create(['description' => $description]);

        switch ($data['target_type']) {
            case 'post':
                \DB::table('report_post')->insert([
                    'id_report' => $report->id_report,
                    'id_post' => $data['target_id']
                ]);
                break;
            case 'user':
                \DB::table('report_user')->insert([
                    'id_report' => $report->id_report,
                    'id_user' => $data['target_id']
                ]);
                break;
            case 'group':
                \DB::table('report_group')->insert([
                    'id_report' => $report->id_report,
                    'id_group' => $data['target_id']
                ]);
                break;
            case 'comment':
                \DB::table('report_comment')->insert([
                    'id_report' => $report->id_report,
                    'id_comment' => $data['target_id']
                ]);
                break;
        }

        return redirect()->back()->with('status', 'Report submitted. Admins will review it.');
    }
}
