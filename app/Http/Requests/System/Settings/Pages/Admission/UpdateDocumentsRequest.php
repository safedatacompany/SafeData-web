<?php

namespace App\Http\Requests\System\Settings\Pages\Admission;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDocumentsRequest extends FormRequest
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
            'documents' => 'nullable|array',
            'documents.en' => 'nullable|array',
            'documents.en.*' => 'required|array',
            'documents.en.*.title' => 'required|string',
            'documents.ckb' => 'nullable|array',
            'documents.ckb.*' => 'required|array',
            'documents.ckb.*.title' => 'required|string',
            // Icon file uploads (one per document, shared across all languages)
            'icon_0' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
            'icon_1' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
            'icon_2' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
            'icon_3' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
        ];
    }

    /**
     * Get custom attribute names for validation errors.
     */
    public function attributes(): array
    {
        return [
            'documents.en.0.title' => __('system.document') . ' 1 - ' . __('pages.title') . ' (' . __('system.en') . ')',
            'documents.en.1.title' => __('system.document') . ' 2 - ' . __('pages.title') . ' (' . __('system.en') . ')',
            'documents.en.2.title' => __('system.document') . ' 3 - ' . __('pages.title') . ' (' . __('system.en') . ')',
            'documents.en.3.title' => __('system.document') . ' 4 - ' . __('pages.title') . ' (' . __('system.en') . ')',
            'documents.ckb.0.title' => __('system.document') . ' 1 - ' . __('pages.title') . ' (' . __('system.ckb') . ')',
            'documents.ckb.1.title' => __('system.document') . ' 2 - ' . __('pages.title') . ' (' . __('system.ckb') . ')',
            'documents.ckb.2.title' => __('system.document') . ' 3 - ' . __('pages.title') . ' (' . __('system.ckb') . ')',
            'documents.ckb.3.title' => __('system.document') . ' 4 - ' . __('pages.title') . ' (' . __('system.ckb') . ')',
            'icon_0' => __('system.document') . ' 1 - ' . __('system.image'),
            'icon_1' => __('system.document') . ' 2 - ' . __('system.image'),
            'icon_2' => __('system.document') . ' 3 - ' . __('system.image'),
            'icon_3' => __('system.document') . ' 4 - ' . __('system.image'),
        ];
    }
}
