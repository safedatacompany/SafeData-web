<template>

    <Head>
        <title>{{ $t('nav.branches') }}</title>
    </Head>

    <div class="mx-auto">
        <div class="w-full flex flex-wrap items-center justify-between gap-x-5 gap-y-2.5 -mt-1">
            <ul class="flex space-x-2 rtl:space-x-reverse">
                <li class="text-gray-500">
                    <span>{{ $t('pages.pages') }}</span>
                </li>
                <li class="before:content-['/'] ltr:before:mr-2 rtl:before:ml-2">
                    <span>{{ $t('pages.branches') }}</span>
                </li>
            </ul>
            <div class="flex items-center gap-3">
                <!-- Add New Button -->
                <button v-if="$can('create_branches')" type="button"
                    class="btn btn-sm btn-primary shadow-none flex items-center gap-1" @click="toggleModal()">
                    <Svg name="new" class="size-4"></Svg>
                    <span>{{ $t('common.new') }} {{ $t('pages.branch') }}</span>
                </button>
            </div>
        </div>

        <!-- Modal -->
        <FormModal :showModal="showModal" :form="form" @submit="save" @close="toggleModal" />

        <!-- Datatable Section -->
        <div class="pt-5">
            <div class="panel pb-0">

                <!-- Filters -->
                <perfect-scrollbar class="relative max-w-max">
                    <div class="flex items-center gap-2 w-full mb-2 whitespace-nowrap">
                        <!-- Date Range Filter -->
                        <CustomDatePicker v-model="dateRangeModel" filter-key="created_at" parent-key="system"
                            placeholder="select_created_at_range" @apply-filter="handleApplyFilter"
                            @clear-filter="handleClearFilter" />
                    </div>
                </perfect-scrollbar>

                <!-- Datatable -->
                <Datatable :rows="branches" :columns="columns" :totalRows="branches.data?.length" @change="apply_filter"
                    v-model:search="filters.search" v-model:numberRows="filters.number_rows" :filter="props.filter"
                    v-model:sortBy="filters.sort_by" v-model:sortDirection="filters.sort_direction">

                    <template #datatable-actions>
                        <CustomMultiSelect v-model="selectLanguage" :list="Languages" label="name" value="value"
                            :showValue="false" parent-key="system" placeholder="languages" :require-selection="true" />
                    </template>

                    <template #name="data">
                        <div class="b-text-sm font-bold">
                            {{ $helpers.getTranslation(data.value.name, selectLanguage.slug) }}
                        </div>
                    </template>

                    <template #description="data">
                        <div class="b-text-sm text-gray-600">
                            {{ $helpers.excerpt($helpers.getTranslation(data.value.description || {},
                            selectLanguage.slug)) }}
                        </div>
                    </template>

                    <template #logo="data">
                        <div v-if="data.value.logo_url" class="flex items-center">
                            <img :src="data.value.logo_url" class="size-10 rounded-md object-contain"
                                alt="branch-logo" />
                        </div>
                        <span v-else class="text-gray-400">{{ $t('pages.no_logo') }}</span>
                    </template>

                    <template #color="data">
                        <div v-if="data.value.color" class="flex items-center gap-1.5">
                            <div :style="{ backgroundColor: data.value.color }" class="size-5 rounded-full"></div>
                            <span class="b-text-sm font-mono">{{ data.value.color }}</span>
                        </div>
                    </template>

                    <template #status="data">
                        <span v-if="data.value.is_active" class="badge bg-success">
                            {{ $t('common.active') }}
                        </span>
                        <span v-else class="badge bg-danger">
                            {{ $t('common.inactive') }}
                        </span>
                    </template>

                    <template #updated_at="data">
                        <span v-tippy dir="ltr" class="b-text-sm font-bold ltr">
                            {{ data.value.updated_at ? $helpers.formatCustomDate(data.value.updated_at) : '' }}
                        </span>
                        <tippy>{{ $helpers.formatCustomDate(data.value.updated_at, true) }}</tippy>
                    </template>

                    <template #created_at="data">
                        <span v-tippy dir="ltr" class="b-text-sm font-bold ltr">
                            {{ data.value.created_at ? $helpers.formatCustomDate(data.value.created_at) : '' }}
                        </span>
                        <tippy>{{ $helpers.formatCustomDate(data.value.created_at, true) }}</tippy>
                    </template>

                    <template v-if="$can('edit_branches') || $can('delete_branches') || $can('restore_branches')"
                        #actions="data">

                        <!-- Active Record Actions -->
                        <div v-if="data.value.deleted_at == null" class="flex items-center justify-end gap-2">
                            <div v-if="$can('edit_branches')" class="text-center">
                                <button type="button" v-tippy @click="toggleModal(data.value)">
                                    <Svg name="pencil" class="size-5"></Svg>
                                </button>
                                <tippy>{{ $t("common.edit") }}</tippy>
                            </div>

                            <div v-if="$can('delete_branches')" class="text-center">
                                <button type="button" v-tippy @click="callDelete(data.value.id)">
                                    <Svg name="trash" class="size-5"></Svg>
                                </button>
                                <tippy>{{ $t("common.delete") }}</tippy>
                            </div>
                        </div>

                        <!-- Deleted Record Actions -->
                        <div v-else class="flex gap-2">
                            <div v-if="$can('delete_branches')" class="text-center">
                                <button type="button" v-tippy @click="callForceDelete(data.value)">
                                    <Svg name="trash" class="size-5"></Svg>
                                </button>
                                <tippy>{{ $t('common.delete') }}</tippy>
                            </div>
                            <div v-if="$can('restore_branches')" class="text-center">
                                <button type="button" v-tippy @click="callRestore(data.value)">
                                    <Svg name="restore" class="size-5 opacity-65"></Svg>
                                </button>
                                <tippy>{{ $t('common.restore') }}</tippy>
                            </div>
                        </div>
                    </template>

                </Datatable>

            </div>
        </div>
    </div>
</template>

<script setup>
import { inject, ref, watch, computed } from 'vue';
import { Head, useForm, usePage } from '@inertiajs/vue3';
import { wTrans, trans } from 'laravel-vue-i18n';
import Swal from 'sweetalert2';
import Svg from '@/Components/Svg.vue';
import Datatable from '@/Components/Datatable.vue';
import { initializeFilters, updateFilters } from '@/Plugins/FiltersPlugin';
import CustomMultiSelect from '@/Components/Inputs/CustomMultiSelect.vue';
import CustomDatePicker from '@/Components/Inputs/CustomDatePicker.vue';
import { useDateFilters } from '@/composables/useDateFilters.js';
import FormModal from './Partials/FormModal.vue';

const props = defineProps({
    branches: Object,
    filter: Object,
});

const $helpers = inject('helpers');
const authUser = usePage().props.auth.user;
const Languages = usePage().props.languages;
const selectLanguage = ref(Languages[0]);

const showModal = ref(false);

// Filters
const filters = initializeFilters({
    search: "",
    number_rows: 10,
    sort_by: "id",
    sort_direction: "desc",
    start_date: props.filter.start_date || '',
    end_date: props.filter.end_date || '',
});

const apply_filter = () => {
    updateFilters({
        ...filters,
        start_date: filters.start_date,
        end_date: filters.end_date,
    });
};

const { dateRangeModel, handleApplyFilter, handleClearFilter } = useDateFilters(filters, apply_filter);

// Helper to create empty form data
const createEmptyFormData = () => ({
    id: '',
    slug: '',
    name: {},
    description: {},
    color: '#000000',
    logo: null,
    remove_logo: false,
    is_active: true,
});

// Form state
let form = useForm(createEmptyFormData());

// Save branch (create or update)
const save = () => {
    // Determine route and action
    const isUpdate = !!form.id;
    const successMessage = trans('common.record') + ' ' + trans(isUpdate ? 'common.updated' : 'common.created');

    // For updates with file uploads, we need to use POST with _method field
    if (isUpdate) {
        form.post(route('control.pages.branches.update', { branch: form.id }), {
            forceFormData: true,
            onSuccess: () => {
                toggleModal();
                $helpers.toast(successMessage);
            },
        });
    } else {
        form.post(route('control.pages.branches.store'), {
            forceFormData: true,
            onSuccess: () => {
                toggleModal();
                $helpers.toast(successMessage);
            },
        });
    }
};

// Toggle modal (open/close with optional row data for editing)
const toggleModal = (row = null) => {
    showModal.value = !showModal.value;

    if (row) {
        // Populate form with existing data for editing
        form.id = row.id;
        form.slug = row.slug;
        form.name = row.name || {};
        form.description = row.description || {};
        form.color = row.color || '#000000';
        form.logo = row.logo_url || null; // Pass the existing logo URL for preview
        form.remove_logo = false;
        form.is_active = row.is_active !== undefined ? row.is_active : true;
    } else if (!showModal.value) {
        // Reset form when closing modal
        Object.assign(form, createEmptyFormData());
        form.clearErrors();
    }
};

// Datatable columns configuration
const columns = ref([
    { field: 'id', title: 'ID', width: '25px', type: 'number' },
    { field: 'name', title: wTrans('pages.name') },
    { field: 'slug', title: wTrans('pages.slug') },
    { field: 'description', title: wTrans('pages.description'), hide: true },
    { field: 'logo', title: wTrans('pages.logo'), sort: false },
    { field: 'color', title: wTrans('pages.color'), sort: false },
    { field: 'status', title: wTrans('common.status'), sort: true },
    { field: 'updated_at', title: wTrans('common.updated_at'), type: 'date', hide: true },
    { field: 'created_at', title: wTrans('common.created_at'), type: 'date' },
    { field: 'actions', title: wTrans('common.actions'), width: '50px', sort: false },
]);

// Delete branch with confirmation
const callDelete = (id) => {
    Swal.fire({
        icon: 'warning',
        title: trans('common.are_you_sure'),
        text: trans('common.delete_this'),
        showCancelButton: true,
        confirmButtonText: trans('common.confirm'),
        cancelButtonText: trans('common.cancel'),
        padding: '2em',
        customClass: 'sweet-alerts',
    }).then((result) => {
        if (result.value) {
            form.delete(route('control.pages.branches.destroy', id), {
                onSuccess: () => $helpers.toast(trans('common.record') + ' ' + trans('common.deleted')),
            });
        }
    });
};

// Force delete branch with confirmation
const callForceDelete = (row) => {
    Swal.fire({
        icon: 'warning',
        title: trans('common.are_you_sure'),
        text: trans('common.force_delete_this'),
        showCancelButton: true,
        confirmButtonText: trans('common.confirm'),
        cancelButtonText: trans('common.cancel'),
        padding: '2em',
        customClass: 'sweet-alerts',
    }).then((result) => {
        if (result.value) {
            form.delete(route('control.pages.branches.force_delete', row.id), {
                onSuccess: () => $helpers.toast(trans('common.record') + ' ' + trans('common.deleted')),
            });
        }
    });
};

// Restore branch with confirmation
const callRestore = (row) => {
    Swal.fire({
        icon: 'warning',
        title: trans('common.are_you_sure'),
        text: trans('common.restore_this'),
        showCancelButton: true,
        confirmButtonText: trans('common.confirm'),
        cancelButtonText: trans('common.cancel'),
        padding: '2em',
        customClass: 'sweet-alerts',
    }).then((result) => {
        if (result.value) {
            form.post(route('control.pages.branches.restore', row.id), {
                onSuccess: () => $helpers.toast(trans('common.record') + ' ' + trans('common.restored')),
            });
        }
    });
};

</script>
