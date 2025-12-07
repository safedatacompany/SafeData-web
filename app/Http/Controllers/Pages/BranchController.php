<?php

namespace App\Http\Controllers\Pages;

use App\Models\Pages\Branch;
use App\Http\Controllers\Controller;
use App\Http\Requests\BranchRequest;
use App\Traits\HandlesSorting;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    use HandlesSorting;

    public function index(Request $request)
    {
        $this->authorize('viewAny', Branch::class);

        $filters = $this->getFilters($request);

        $query = Branch::query()
            ->withTrashed()
            ->search($filters['search'])
            ->filterByDateRange($filters['start_date'], $filters['end_date']);

        $this->applySortingToQuery($query, $filters['sort_by'], $filters['sort_direction'], $this->getSortableFields());

        $branches = $query->paginate($filters['number_rows']);

        return inertia('Pages/Branch/Index', [
            'branches' => $branches,
            'filter' => $filters,
        ]);
    }

    private function getSortableFields(): array
    {
        return [
            'id' => $this->simpleSort('branches.id'),
            'name' => $this->simpleSort('branches.name'),
            'slug' => $this->simpleSort('branches.slug'),
            'color' => $this->simpleSort('branches.color'),
            'created_at' => $this->simpleSort('branches.created_at'),
            'updated_at' => $this->simpleSort('branches.updated_at'),
        ];
    }

    public function store(BranchRequest $request)
    {
        $this->authorize('create', Branch::class);

        $data = $request->validated();

        $branch = Branch::create($data);

        // Handle logo upload via media library
        if ($request->hasFile('logo')) {
            $branch->addMedia($request->file('logo'))
                ->toMediaCollection('logo');
        }

        return redirect()->back();
    }

    public function update(BranchRequest $request, Branch $branch)
    {
        $this->authorize('update', $branch);

        $data = $request->validated();

        $branch->update($data);

        // Handle logo removal
        if ($request->has('remove_logo') && $request->remove_logo) {
            $branch->clearMediaCollection('logo');
        }
        // Handle logo upload via media library
        elseif ($request->hasFile('logo')) {
            $branch->clearMediaCollection('logo'); // Remove old logo
            $branch->addMedia($request->file('logo'))
                ->toMediaCollection('logo');
        }

        return redirect()->back();
    }

    public function destroy(Branch $branch)
    {
        $this->authorize('delete', $branch);

        // Check all relationships
        if (
            $branch->news()->exists() ||
            $branch->campuses()->exists() ||
            $branch->classrooms()->exists()
        ) {
            return redirect()->back()->withErrors([
                'error' => __('common.cannot_delete_record'),
            ]);
        }

        $branch->delete();

        return redirect()->back();
    }

    public function forceDelete($id)
    {
        $branch = Branch::withTrashed()->findOrFail($id);

        $this->authorize('delete', $branch);

        // Media library will automatically delete media when model is force deleted
        // But we can explicitly clear it if needed
        $branch->clearMediaCollection('logo');

        // Permanently delete the branch
        $branch->forceDelete();

        return redirect()->back();
    }

    public function restore($id)
    {
        $branch = Branch::withTrashed()->findOrFail($id);

        $this->authorize('restore', $branch);

        $branch->restore();

        return redirect()->back();
    }
}
