<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
{
    public function rules()
    {
        return [
            'title'       => ['sometimes', 'string'],
            'expire_at'   => ['required', 'date_format:Y-m-d H:i:s', 'after_or_equal:' . now()->toDateTimeString()],
            'description' => ['nullable', 'string'],
            'status_id'   => ['sometimes', 'exists:task_statuses,id'],
        ];
    }
}
