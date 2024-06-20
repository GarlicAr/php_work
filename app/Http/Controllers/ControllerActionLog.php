<?php

namespace App\Http\Controllers;

use App\Models\UserActionLogs;
use Illuminate\Http\Request;
use App\Models\Enums\Action;
use App\Models\Enums\Type;

class ControllerActionLog extends Controller
{
    private $allowedParams = ['date'];

    public function logUserAction($userId, $action, $actionModel, $actionModelId)
    {

        $userEmail = auth()->user()->email;

        $log = new UserActionLogs([
            'user_id' => $userId,
            'action' => $action,
            'action_model' => $actionModel,
            'action_model_id' => $actionModelId,
            'user_email' => $userEmail,
        ]);

        $log->save();
    }

    public function getRecentLogs(Request $request)
    {

        $validatedData = $request->validate([
            'date' => 'sometimes|date_format:Y-m-d',
        ]);

        $query = UserActionLogs::query()->orderBy('created_at', 'desc');

        if (isset($validatedData['date'])) {

            $date = $validatedData['date'];

            $query->whereDate('created_at', $date);
        }

        $logs = $query->take(10)->get();

        return response()->json(['logs' => $logs]);
    }
}
