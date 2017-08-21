<?php

namespace Webmagic\Users\Http\Requests;


use Illuminate\Foundation\Http\FormRequest as Request;

class CreateUserRequest extends Request
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
     * Return rules for validation
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|unique:users,name,',
            'password' => 'required|string',
            'password_confirm' => 'same:password',
            'role_slug' => 'required|string|exists:roles,slug'
        ];
    }
}