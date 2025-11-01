<?php

namespace App\Http\Controllers\System\Settings\Pages;

use App\Http\Controllers\Controller;
use App\Http\Requests\System\Settings\Pages\Admission\UpdateDocumentsRequest;
use App\Http\Requests\System\Settings\Pages\Admission\UpdatePolicyRequest;
use App\Models\Pages\Admission\AdmissionDocument;
use App\Models\Pages\Admission\AdmissionPolicy;
use App\Models\Pages\Branch;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdmissionController extends Controller
{
    public function index(Request $request)
    {
        $branchId = $request->input('branch_id') ?? Branch::active()->ordered()->first()->id;

        $policy = AdmissionPolicy::where('branch_id', $branchId)->first();
        $documents = AdmissionDocument::where('branch_id', $branchId)->first();

        return Inertia::render('System/Settings/Pages/Admission/Index', [
            'policy' => $policy,
            'documents' => $documents,
        ]);
    }

    public function updatePolicy(UpdatePolicyRequest $request)
    {
        $branchId = $request->input('branch_id');
        $validated = $request->validated();

        $policy = AdmissionPolicy::updateOrCreate(
            ['branch_id' => $branchId],
            [
                'user_id' => auth()->id(),
                'description' => $validated['description'],
                'steps' => $validated['steps'] ?? null,
                'is_active' => true,
            ]
        );

        return redirect()->back()->with('success', __('Admission policy updated successfully.'));
    }

    public function updateDocuments(UpdateDocumentsRequest $request)
    {
        $branchId = $request->input('branch_id');
        $validated = $request->validated();

        // Parse documents JSON strings if they exist
        $documentsData = [];
        foreach (['en', 'ckb'] as $lang) {
            if ($request->has("documents_{$lang}")) {
                $documentsData[$lang] = json_decode($request->input("documents_{$lang}"), true);
            }
        }

        // Handle icon uploads for each document (shared across all languages)
        for ($i = 0; $i < 4; $i++) {
            if ($request->hasFile("icon_{$i}")) {
                $file = $request->file("icon_{$i}");
                $filename = time() . '_doc_' . $i . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('admission/icons', $filename, 'public');
                $iconPath = '/storage/' . $path;
                
                // Set the same icon for all languages
                foreach (['en', 'ckb'] as $lang) {
                    if (isset($documentsData[$lang][$i])) {
                        $documentsData[$lang][$i]['icon'] = $iconPath;
                    }
                }
            }
        }

        // Use validated documents structure if JSON wasn't provided
        if (empty($documentsData) && isset($validated['documents'])) {
            $documentsData = $validated['documents'];
        }

        $documents = AdmissionDocument::updateOrCreate(
            ['branch_id' => $branchId],
            [
                'user_id' => auth()->id(),
                'documents' => $documentsData,
                'is_active' => $validated['is_active'] ?? true,
            ]
        );

        return redirect()->back()->with('success', __('Admission documents updated successfully.'));
    }
}
