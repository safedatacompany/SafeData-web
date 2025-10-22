<?php

namespace App\Http\Middleware;

use App\Models\Pages\Branch;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HandleBranchSelection
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Remove trailing slash from URL (except root)
        $path = $request->path();
        if ($path !== '/' && str_ends_with($request->getRequestUri(), '/')) {
            return redirect(rtrim($request->getRequestUri(), '/'), 301);
        }
        
        // Get all active branches
        $branches = Branch::active()->ordered()->get();
        
        // Get the first segment of the URL path
        $firstSegment = $request->segment(1);
        
        // Check if the first segment matches a branch slug
        $selectedBranch = $branches->firstWhere('slug', $firstSegment);
        
        // If no branch found in URL, check session or use default
        if (!$selectedBranch) {
            $selectedBranchId = session('selected_branch_id');
            $selectedBranch = $selectedBranchId 
                ? $branches->firstWhere('id', $selectedBranchId) 
                : $branches->first();
            
            // If on root path or non-branch path, redirect to branch-based URL
            if ($selectedBranch && $firstSegment === null) {
                // Root path: redirect to branch home
                return redirect('/' . $selectedBranch->slug);
            } elseif ($selectedBranch && !in_array($firstSegment, ['control', 'lang', 'login', 'register'])) {
                // Non-branch path with a page: redirect to branch-based path
                $currentPath = $request->path();
                if ($currentPath !== '/') {
                    return redirect('/' . $selectedBranch->slug . '/' . $currentPath);
                }
            }
        }
        
        // Store selected branch in session for consistency
        if ($selectedBranch) {
            session(['selected_branch_id' => $selectedBranch->id]);
            session(['selected_branch_slug' => $selectedBranch->slug]);
        }

        // Share branches data with Inertia
        inertia()->share([
            'branches' => $branches,
            'selectedBranch' => $selectedBranch,
            'branchPrefix' => $selectedBranch ? $selectedBranch->slug : '',
        ]);

        return $next($request);
    }
}
