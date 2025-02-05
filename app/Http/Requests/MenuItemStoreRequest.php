<?php

namespace App\Http\Requests;

use App\Enums\GeneralStatusEnum;
use App\Enums\StockStatusEnum;
use App\Helpers\Enum;
use App\Models\MenuCategory;
use Illuminate\Foundation\Http\FormRequest;

class MenuItemStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $categories = MenuCategory::all()->pluck('id')->toArray();
        $categories = implode(',', $categories);
        
        $enum = implode(',', (new Enum(StockStatusEnum::class))->values());
        $enum2 = implode(',', (new Enum(GeneralStatusEnum::class))->values());

        return [
            'menu_category_id' => "required|in:$categories",
            'name' => 'required|string|unique:menu_items,name|min:1|max:1000',
            'photo' => 'string|nullable',
            'price' => ['required', 'numeric', 'between:0,999999999.99'],
            'currency_type' => 'string',
            'is_available' => "required|in:$enum",
            'status' => "required|in:$enum2",
        ];
    }
}
