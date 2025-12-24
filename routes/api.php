<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/*
|--------------------------------------------------------------------------
| Deployment Routes
|--------------------------------------------------------------------------
*/

Route::post('/deploy/migrate', function (Request $request) {
    // Verify the deploy token
    $token = $request->header('X-Deploy-Token');
    $expectedToken = '7k9mP2vL8nQ4wR6xT3yU1zB5cD0eF7gH9jK2mN4pQ6sT8vW0xY3zA5bC7dE9fG1h';
    
    if ($token !== $expectedToken) {
        return response()->json([
            'success' => false,
            'error' => 'Unauthorized - Invalid token'
        ], 401);
    }
    
    try {
        // Run migrations
        Artisan::call('migrate', ['--force' => true]);
        $migrateOutput = Artisan::output();
        
        // Clear cache
        Artisan::call('config:clear');
        Artisan::call('cache:clear');
        Artisan::call('route:clear');
        Artisan::call('view:clear');
        
        return response()->json([
            'success' => true,
            'message' => 'Migration completed successfully',
            'output' => $migrateOutput,
            'timestamp' => now()->toDateTimeString()
        ], 200);
        
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'error' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine()
        ], 500);
    }
});
