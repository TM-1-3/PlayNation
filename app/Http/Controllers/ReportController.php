<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Report;

class ReportController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'target_type' => 'required|string|in:post,user,group',
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
        }

        return redirect()->back()->with('status', 'Report submitted. Admins will review it.');
    }
}
