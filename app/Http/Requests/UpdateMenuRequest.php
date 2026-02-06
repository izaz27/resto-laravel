<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateMenuRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        // Abaikan ID menu yang sedang diedit dari aturan unique
        $menuId = $this->route('menu')->id; 

        return [
            'name' => ['required', 'string', 'max:255', Rule::unique('menus')->ignore($menuId)],
            'category_id' => ['required', 'exists:categories,id'],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'numeric', 'min:1000'],
            'is_available' => ['required', 'boolean'],
        ];
    }
}