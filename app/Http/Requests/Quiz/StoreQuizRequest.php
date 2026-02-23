<?php

namespace App\Http\Requests\Quiz;

use Illuminate\Foundation\Http\FormRequest;

class StoreQuizRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
        //tüm kullanıcılara izin verdik burada user tip veya permission gate  kullanıp kısıt işlemi de yaılırı
    }

    public function rules(): array
    {
        return [
            'title' => ['required','string','max:200'],
            'is_active' => ['sometimes','boolean'],
            'status' => ['required','in:taslak,yayinda'],
        ];
    }
}
