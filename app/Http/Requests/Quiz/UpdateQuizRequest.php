<?php

namespace App\Http\Requests\Quiz;

use Illuminate\Foundation\Http\FormRequest;

class UpdateQuizRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['sometimes','string','max:200'],
            'is_active' => ['sometimes','boolean'],
            'status' => ['sometimes','in:taslak,yayinda'],
        ];
    }
}
