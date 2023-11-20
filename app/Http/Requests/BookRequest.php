<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
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
        $rules = [];
        $currentAction = $this->route()->getActionMethod();
        switch ($this->method()) {
            case 'POST':
                switch ($currentAction) {
                    case 'update':
                        $rules = [
                            'title' => 'required',
                            'status' => 'required',
                            'price' => 'required|integer',
                            'stock_quantity' => 'required|integer',
                            'page' => 'required',
                            'publication_date' => 'required',
                            'page_count' => 'required|integer',
                            'publisher' => 'required',
                            'language' => 'required',
                            'author_id' => 'required',
                            'category_id' => 'required'
                        ];
                        break;
                    case 'store' :
                        $rules = [
                            'title' => 'required',
                            'status' => 'required',
                            'slug' => 'unique:books',
                            'image_url' => 'required',
                            'price' => 'required|integer',
                            'stock_quantity' => 'required|integer',
                            'page' => 'required',
                            'publication_date' => 'required',
                            'page_count' => 'required|integer',
                            'publisher' => 'required',
                            'language' => 'required',
                            'author_id' => 'required',
                            'category_id' => 'required'
                        ];
                        break;
                }
                break;
            default:
                break;
        }
        return $rules;
    }
}
