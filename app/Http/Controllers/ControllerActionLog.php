<?php

namespace App\Http\Controllers;

use App\Models\UserActionLogs;
use Illuminate\Http\Request;
use App\Models\Enums\Action;
use App\Models\Enums\Type;

class ControllerActionLog extends Controller
{
    public function logUserAction($userId, $action, $actionModel, $actionModelId)
    {
        $log = new UserActionLogs([
            'user_id' => $userId,
            'action' => $action,
            'action_model' => $actionModel,
            'action_model_id' => $actionModelId,
        ]);

        $log->save();
    }
}
