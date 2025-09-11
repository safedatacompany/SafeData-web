<?php

namespace App\Traits;

use App\Models\System\Settings\Reasons\Log;



trait LogsActivity
{
    /**
     * Log an activity
     *
     * @param string $action
     * @param int|null $rowId
     * @param int|null $userId
     * @param array $additionalData
     * @return void
     */
    protected function logActivity(string $action, int $rowId = null, int $userId = null, array $additionalData = [])
    {
        Log::create(array_merge([
            'action' => $action,
            'row_id' => $rowId,
            'user_id' => $userId ?? auth()->id(),
        ], $additionalData));
    }

    /**
     * Log creation activity
     */
    protected function logCreated(string $resource, $model)
    {
        $this->logActivity("Created {$resource}", $model);
    }

    /**
     * Log update activity
     */
    protected function logUpdated(string $resource, $model)
    {
        $this->logActivity("Updated {$resource}", $model);
    }

    /**
     * Log deletion activity
     */
    protected function logDeleted(string $resource, $model)
    {
        $this->logActivity("Deleted {$resource}", $model);
    }
    protected function logLogOut(string $resource, $model)
    {
        $this->logActivity("Logged out {$resource}", is_object($model) ? $model->id : $model);
    }
    protected function logLogIn(string $resource, $model)
    {
        $this->logActivity("Logged in {$resource}", is_object($model) ? $model->id : $model);
    }

    /**
     * Log custom activity with context
     */
    protected function logWithContext(string $action, $model = null, array $context = [])
    {
        $this->logActivity(
            $action,
            $model ? $model : null,
            auth()->id(),
            $context
        );
    }
}