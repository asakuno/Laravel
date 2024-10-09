<?php
declare(strict_types=1);

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use App\DataTransferObjects\Auth\RegisterUserData;
use Illuminate\Support\Facades\Hash;

class RegisterRequest extends FormRequest
{
    private const DEFAULT_ACCOUNT_TYPE = 1;

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
        return [
            'name' => [
                'required',
                'string',
                'min:4',
            ],
            'email' => [
                'required',
                'string'
            ],
            'password' => [
                'required',
                'string'
            ],
        ];
    }

    /**
     * @return RegisterUserData
     */
    public function getRegisterParams(): RegisterUserData
    {
        return RegisterUserData::from([
            'name' => $this->input('name'),
            'email' => $this->input('email'),
            'password' => Hash::make($this->input('password')),
            'account_type' => self::DEFAULT_ACCOUNT_TYPE,
        ]);
    }
}
