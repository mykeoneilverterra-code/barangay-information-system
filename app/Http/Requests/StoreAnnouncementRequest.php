<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreAnnouncementRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check()
            && auth()->user()->role === 'admin';
    }

    public function rules(): array
    {
        return [
            'title' => [
                'required',
                'string',
                'max:150',
            ],

            'description' => [
                'required',
                'string',
                'max:2000',
            ],

            'category' => [
                'required',
                Rule::in([
                    'Community',
                    'Youth',
                    'Health',
                    'Government',
                    'Emergency',
                    'Other',
                ]),
            ],

            'announcement_date' => [
                'required',
                'date',
            ],

            'status' => [
                'required',
                Rule::in([
                    'Draft',
                    'Published',
                ]),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' =>
                'Please enter an announcement title.',

            'description.required' =>
                'Please enter the announcement details.',

            'category.required' =>
                'Please select a category.',

            'announcement_date.required' =>
                'Please select an announcement date.',

            'status.required' =>
                'Please select a status.',
        ];
    }
}