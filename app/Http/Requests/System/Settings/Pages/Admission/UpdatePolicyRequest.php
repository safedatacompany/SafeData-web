<?php

namespace App\Http\Requests\System\Settings\Pages\Admission;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePolicyRequest extends FormRequest
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
        return [
            'branch_id' => 'nullable|exists:branches,id',
            'description.en' => 'required|string',
            'description.ckb' => 'required|string',
            'steps' => 'nullable|array',
            'steps.en' => 'nullable|array',
            'steps.en.*' => 'required|array',
            'steps.en.*.level' => 'required|string',
            'steps.en.*.title' => 'required|string',
            'steps.ckb' => 'nullable|array',
            'steps.ckb.*' => 'required|array',
            'steps.ckb.*.level' => 'required|string',
            'steps.ckb.*.title' => 'required|string',
        ];
    }

    /**
     * Get custom attribute names for validation errors.
     */
    public function attributes(): array
    {
        return [
            'description.en' => __('system.description') . ' (' . __('system.en') . ')',
            'description.ckb' => __('system.description') . ' (' . __('system.ckb') . ')',
            'steps.en.0.title' => __('system.step') . ' 1 - ' . __('pages.title') . ' (' . __('system.en') . ')',
            'steps.en.1.title' => __('system.step') . ' 2 - ' . __('pages.title') . ' (' . __('system.en') . ')',
            'steps.en.2.title' => __('system.step') . ' 3 - ' . __('pages.title') . ' (' . __('system.en') . ')',
            'steps.en.3.title' => __('system.step') . ' 4 - ' . __('pages.title') . ' (' . __('system.en') . ')',
            'steps.en.4.title' => __('system.application_methods') . ' 1 - ' . __('pages.title') . ' (' . __('system.en') . ')',
            'steps.en.5.title' => __('system.application_methods') . ' 2 - ' . __('pages.title') . ' (' . __('system.en') . ')',
            'steps.en.6.title' => __('system.application_methods') . ' 3 - ' . __('pages.title') . ' (' . __('system.en') . ')',
            'steps.ckb.0.title' => __('system.step') . ' 1 - ' . __('pages.title') . ' (' . __('system.ckb') . ')',
            'steps.ckb.1.title' => __('system.step') . ' 2 - ' . __('pages.title') . ' (' . __('system.ckb') . ')',
            'steps.ckb.2.title' => __('system.step') . ' 3 - ' . __('pages.title') . ' (' . __('system.ckb') . ')',
            'steps.ckb.3.title' => __('system.step') . ' 4 - ' . __('pages.title') . ' (' . __('system.ckb') . ')',
            'steps.ckb.4.title' => __('system.application_methods') . ' 1 - ' . __('pages.title') . ' (' . __('system.ckb') . ')',
            'steps.ckb.5.title' => __('system.application_methods') . ' 2 - ' . __('pages.title') . ' (' . __('system.ckb') . ')',
            'steps.ckb.6.title' => __('system.application_methods') . ' 3 - ' . __('pages.title') . ' (' . __('system.ckb') . ')',
        ];
    }
}
