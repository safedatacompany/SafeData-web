<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BranchRequest extends FormRequest
{
    public function rules(): array
    {
        $branchId = $this->route('branch') ? $this->route('branch')->id : null;
        $isUpdate = $branchId !== null;

        $rules = [
            'name' => 'required|array',
            'name.en' => 'required_without_all:name.ckb|nullable|string|max:255',
            'name.ckb' => 'required_without_all:name.en|nullable|string|max:255',
            'name.ar' => 'nullable|string|max:255',

            'description' => 'nullable|array',
            'description.en' => 'nullable|string',
            'description.ckb' => 'nullable|string',
            'description.ar' => 'nullable|string',

            'remove_logo' => 'nullable|boolean',
            'color' => 'required|string|regex:/^#[0-9A-Fa-f]{6}$/',
            'is_active' => 'nullable|boolean',
        ];

        // Logo validation - only validate as file if it's actually a file upload
        if ($this->hasFile('logo')) {
            $rules['logo'] = 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048';
        } elseif (!$isUpdate) {
            $rules['logo'] = 'required';
        }

        return $rules;
    }

    public function attributes(): array
    {
        return [
            'name.en' => __('pages.name.en'),
            'name.ckb' => __('pages.name.ckb'),
            'name.ar' => __('pages.name.ar'),
            'description.en' => __('pages.description.en'),
            'description.ckb' => __('pages.description.ckb'),
            'description.ar' => __('pages.description.ar'),
            'slug' => __('pages.slug'),
            'logo' => __('pages.logo'),
            'color' => __('pages.color'),
        ];
    }

    public function messages(): array
    {
        return [
            'slug.regex' => 'The slug must only contain lowercase letters, numbers, and hyphens.',
            'color.regex' => 'The color must be a valid hex color code (e.g., #0028DF).',
            'logo.required' => __('pages.logo') . ' ' . __('validation.required'),
        ];
    }
}
