<?php

namespace App\Http\Requests;

use App\Rules\ValidPhilippineMobileNumber;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateResidentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized
     * to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }


    /**
     * Prepare and normalize input
     * before validation.
     */
    protected function prepareForValidation(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Contact Number
        |--------------------------------------------------------------------------
        */

        $contactNumber =
            $this->input('contact_number');

        if (is_string($contactNumber)) {

            $contactNumber =
                preg_replace(
                    '/[\s\-\(\)]+/',
                    '',
                    trim($contactNumber)
                );


            /*
            |--------------------------------------------------------------------------
            | Convert +63 / 63 to 09
            |--------------------------------------------------------------------------
            */

            if (
                str_starts_with(
                    $contactNumber,
                    '+63'
                )
            ) {

                $contactNumber =
                    '0'
                    . substr(
                        $contactNumber,
                        3
                    );

            } elseif (
                str_starts_with(
                    $contactNumber,
                    '63'
                )
                && strlen($contactNumber) === 12
            ) {

                $contactNumber =
                    '0'
                    . substr(
                        $contactNumber,
                        2
                    );
            }


            if ($contactNumber === '') {
                $contactNumber = null;
            }
        }


        /*
        |--------------------------------------------------------------------------
        | Email
        |--------------------------------------------------------------------------
        */

        $email =
            $this->input('email');

        if (is_string($email)) {

            $email =
                strtolower(
                    trim($email)
                );

            if ($email === '') {
                $email = null;
            }
        }


        /*
        |--------------------------------------------------------------------------
        | Optional Text
        |--------------------------------------------------------------------------
        */

        $middleName =
            $this->cleanNullableText(
                $this->input('middle_name')
            );

        $suffix =
            $this->cleanNullableText(
                $this->input('suffix')
            );

        $occupation =
            $this->cleanNullableText(
                $this->input('occupation')
            );


        /*
        |--------------------------------------------------------------------------
        | Merge Normalized Values
        |--------------------------------------------------------------------------
        */

        $this->merge([

            'first_name' =>
                trim(
                    (string) $this->input(
                        'first_name',
                        ''
                    )
                ),

            'middle_name' =>
                $middleName,

            'last_name' =>
                trim(
                    (string) $this->input(
                        'last_name',
                        ''
                    )
                ),

            'suffix' =>
                $suffix,

            'contact_number' =>
                $contactNumber,

            'email' =>
                $email,

            'occupation' =>
                $occupation,

            'address' =>
                trim(
                    (string) $this->input(
                        'address',
                        ''
                    )
                ),

            'area' =>
                trim(
                    (string) $this->input(
                        'area',
                        ''
                    )
                ),

            'is_voter' =>
                $this->boolean(
                    'is_voter'
                ),

        ]);
    }


    /**
     * Validation rules.
     */
    public function rules(): array
    {
        $resident =
            $this->route('resident');


        return [

            'first_name' => [
                'required',
                'string',
                'max:60',
            ],

            'middle_name' => [
                'nullable',
                'string',
                'max:60',
            ],

            'last_name' => [
                'required',
                'string',
                'max:60',
            ],

            'suffix' => [
                'nullable',
                'string',
                'max:20',
            ],

            'sex' => [
                'required',

                Rule::in([
                    'Male',
                    'Female',
                ]),
            ],

            'birth_date' => [
                'required',
                'date',
                'before_or_equal:today',
            ],

            'civil_status' => [
                'required',

                Rule::in([
                    'Single',
                    'Married',
                    'Widowed',
                    'Separated',
                ]),
            ],

            'contact_number' => [
                'nullable',
                'string',
                new ValidPhilippineMobileNumber(),
            ],

            'email' => [
                'nullable',
                'email',
                'max:255',

                Rule::unique(
                    'residents',
                    'email'
                )->ignore(
                    $resident
                ),
            ],

            'occupation' => [
                'nullable',
                'string',
                'max:100',
            ],

            'address' => [
                'required',
                'string',
                'max:500',
            ],

            'area' => [
                'required',
                'string',
                'max:255',
            ],

            'is_voter' => [
                'required',
                'boolean',
            ],

            'profile_photo' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png',
                'max:2048',
            ],

        ];
    }


    /**
     * Custom validation messages.
     */
    public function messages(): array
    {
        return [

            'first_name.required' =>
                'First name is required.',

            'first_name.max' =>
                'First name must not exceed 60 characters.',


            'middle_name.max' =>
                'Middle name must not exceed 60 characters.',


            'last_name.required' =>
                'Last name is required.',

            'last_name.max' =>
                'Last name must not exceed 60 characters.',


            'suffix.max' =>
                'Suffix must not exceed 20 characters.',


            'sex.required' =>
                'Please select the resident\'s sex.',

            'sex.in' =>
                'Please select a valid sex.',


            'birth_date.required' =>
                'Birth date is required.',

            'birth_date.date' =>
                'Please enter a valid birth date.',

            'birth_date.before_or_equal' =>
                'Birth date cannot be in the future.',


            'civil_status.required' =>
                'Please select a civil status.',

            'civil_status.in' =>
                'Please select a valid civil status.',


            'email.email' =>
                'Please enter a valid email address.',

            'email.unique' =>
                'This email address is already assigned to another resident.',

            'email.max' =>
                'Email address must not exceed 255 characters.',


            'occupation.max' =>
                'Occupation must not exceed 100 characters.',


            'address.required' =>
                'Complete address is required.',

            'address.max' =>
                'Complete address must not exceed 500 characters.',


            'area.required' =>
                'Village / Street is required.',

            'area.max' =>
                'Village / Street must not exceed 255 characters.',


            'profile_photo.image' =>
                'The profile photo must be a valid image.',

            'profile_photo.mimes' =>
                'The profile photo must be a JPG, JPEG, or PNG file.',

            'profile_photo.max' =>
                'The profile photo must not exceed 2 MB.',

        ];
    }


    /**
     * Friendly field names.
     */
    public function attributes(): array
    {
        return [

            'first_name' =>
                'first name',

            'middle_name' =>
                'middle name',

            'last_name' =>
                'last name',

            'birth_date' =>
                'birth date',

            'civil_status' =>
                'civil status',

            'contact_number' =>
                'contact number',

            'area' =>
                'Village / Street',

            'is_voter' =>
                'voter status',

            'profile_photo' =>
                'profile photo',

        ];
    }


    /**
     * Convert empty optional text
     * values to null.
     */
    private function cleanNullableText(
        mixed $value
    ): ?string {

        if (!is_string($value)) {
            return null;
        }

        $value =
            trim($value);

        return $value === ''
            ? null
            : $value;
    }
}