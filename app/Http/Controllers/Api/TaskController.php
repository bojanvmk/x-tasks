<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class TaskController extends BaseController
{
    public function __invoke(Request $request)
    {
        $user = User::query()
            ->with('tasks')
            ->firstWhere('email', $request->input('username'));

        return response()->json([
            'tasks' => $user->tasks ?? []
        ]);
    }
}
