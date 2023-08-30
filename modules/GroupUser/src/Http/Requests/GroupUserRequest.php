<?php
namespace Modules\GroupUser\src\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GroupUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {

        return [
            'name' => 'required|max:255'
        ];
    }

    public function messages(){
        return [
            'required' => __('categories::validation.required'),
            'max' => __('categories::validation.max'),
        ];
    }

    public function attributes(){
        return [
            'name' =>  __('groupUser::validation.attributes.name'),
              ];

    }
}