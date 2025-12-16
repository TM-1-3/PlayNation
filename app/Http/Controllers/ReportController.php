<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'target_type' => 'nullable|string',
            'target_id' => 'nullable|integer',
            'reason' => 'required|string',
            'details' => 'nullable|string',
        ]);

        // Currently we only accept and acknowledge the report on the UI level.
        // Persisting to the database or notifying admins can be implemented later.

        return redirect()->back()->with('status', 'Report submitted. Thank you.');
    }
}
