<?php

namespace App\Http\Requests;

use App\Enums\GeneralStatusEnum;
use App\Helpers\Enum;
use App\Models\MenuCategory;
use Illuminate\Foundation\Http\FormRequest;

class MenuCategoryUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $category = MenuCategory::findOrFail(request('id'));
        $categoryId = $category->id;

        $enum = implode(',', (new Enum(GeneralStatusEnum::class))->values());

        return [
            'name' => "required|string|unique:categories,name,$categoryId|min:1|max:1000",
            'description' => 'string|nullable',
            'status' => "required|in:$enum"
        ];
    }
}
