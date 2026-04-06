<template>

    <Head>
        <title>{{ $t('User Type') }}</title>
    </Head>
    <div class="mx-auto">
        <div class="w-full flex flex-wrap items-center justify-between gap-x-5 gap-y-2.5 -mt-1">
            <ul class="flex flex-wrap whitespace-nowrap space-x-2 rtl:space-x-reverse">
                <li class="text-gray-400">
                    <span>{{ $t('system.system') }}</span>
                </li>
                <li class="before:content-['/'] ltr:before:mr-2 rtl:before:ml-2">
                    <Link :href="route('control.system.settings')" class="duration-200 hover:text-primary">
                    {{ $t("system.settings") }}
                    </Link>
                </li>
                <li class="before:content-['/'] ltr:before:mr-2 rtl:before:ml-2">
                    <span>{{ $t('system.user_type') }}</span>
                </li>
            </ul>
            <!-- add new row -->
            <div class="block">
                <!-- Trigger -->
                <div class="flex items-center justify-center">
                    <button v-if="$can('create_usertypes')" type="button"
                        class="btn btn-sm btn-primary shadow-none flex items-center gap-1" @click="toggleModal()">
                        <Svg name="new" class="size-4"></Svg>
                        <span>{{ $t('common.new') }} {{ $t('system.user_type') }}</span>
                    </button>
                </div>

                <!-- Create Modal -->
                <TransitionRoot appear :show="showModal" as="template">
                    <Dialog as="div" @close="toggleModal()" class="relative z-50">
                        <TransitionChild as="template" enter="duration-300 ease-out" enter-from="opacity-0"
                            enter-to="opacity-100" leave="duration-200 ease-in" leave-from="opacity-100"
                            leave-to="opacity-0">
                            <DialogOverlay class="fixed inset-0 bg-[black]/60" />
                        </TransitionChild>

                        <div class="fixed inset-0 overflow-y-auto">
                            <div class="flex min-h-full items-start justify-center px-4 py-8">
                                <TransitionChild as="template" enter="duration-300 ease-out"
                                    enter-from="opacity-0 scale-95" enter-to="opacity-100 scale-100"
                                    leave="duration-200 ease-in" leave-from="opacity-100 scale-100"
                                    leave-to="opacity-0 scale-95">
                                    <DialogPanel
                                        class="panel border-0 p-0 overflow-hidden rounded-lg w-full max-w-lg text-black dark:text-gray-200">
                                        <button type="button"
                                            class="absolute top-4 ltr:right-4 rtl:left-4 text-gray-400 hover:text-gray-800 dark:hover:text-gray-600 outline-none"
                                            @click="toggleModal()">
                                            <Svg name="close" class="size-6"></Svg>
                                        </button>
                                        <div
                                            class="text-lg font-bold bg-[#fbfbfb] dark:bg-[#121c2c] ltr:pl-5 rtl:pr-5 py-3 ltr:pr-[50px] rtl:pl-[50px]">
                                            <span v-if="form.id">
                                                {{ $t('common.edit') }}
                                            </span>
                                            <span v-else>
                                                {{ $t('common.new') }}
                                            </span>
                                            {{ $t('system.type') }}
                                        </div>
                                        <div class="p-5">
                                            <form @submit.prevent="save()" v-shortkey="['ctrl', 's']" @shortkey="save"
                                                class="space-y-5">
                                                <div class="grid grid-cols-1 sm:grid-cols-4 gap-4 text-sm">
                                                    <div class="col-span-full">
                                                        <label for="name" class="required">
                                                            {{ $t('system.name') }}
                                                        </label>
                                                        <VInput id="name" v-model="form.name" type="text"
                                                            :placeholder="$t('system.name')" :error="form.errors.name">
                                                        </VInput>
                                                    </div>
                                                    <div class="col-span-full">
                                                        <label for="name" class="required">
                                                            {{ $t('system.slug') }}
                                                        </label>
                                                        <VInput id="slug" v-model="form.slug" type="text"
                                                            :placeholder="$t('system.slug')" :error="form.errors.slug">
                                                        </VInput>
                                                    </div>
                                                </div>
                                                <div class="flex justify-end items-center mt-5">
                                                    <button @click="toggleModal()" type="button"
                                                        class="btn btn-outline-danger">
                                                        {{ $t('common.discard') }}
                                                    </button>
                                                    <button :disabled="form.processing"
                                                        class="btn btn-primary ltr:ml-4 rtl:mr-4">
                                                        <Spinner v-if="form.processing" />
                                                        {{ $t('common.save') }}
                                                    </button>
                                                </div>
                                            </form>

                                        </div>
                                    </DialogPanel>
                                </TransitionChild>
                            </div>
                        </div>
                    </Dialog>
                </TransitionRoot>
            </div>
        </div>
        <div class="pt-4">
            <div class="panel pb-0">
                <!-- Datatable -->
                <Datatable :rows="type" :columns="columns" :totalRows="type.data?.length" @change="apply_filter"
                    v-model:search="filters.search" v-model:numberRows="filters.number_rows" :filter="props.filter"
                    v-model:sortBy="filters.sort_by" v-model:sortDirection="filters.sort_direction">

                    <!-- Date Range Picker -->
                    <template #datatable-actions>
                        <CustomDatePicker v-model="dateRangeModel" filter-key="created_at" parent-key="system"
                            placeholder="select_created_at_range" @apply-filter="handleApplyFilter"
                            @clear-filter="handleClearFilter" />
                    </template>

                    <template #updated_at="data">
                        <span v-tippy dir="ltr" class="text-sm font-bold ltr">
                            {{ data.value.updated_at ? $helpers.formatCustomDate(data.value.updated_at) : '' }}
                        </span>
                        <tippy>{{ $helpers.formatCustomDate(data.value.updated_at, true) }}</tippy>
                    </template>

                    <template #created_at="data">
                        <span v-tippy dir="ltr" class="text-sm font-bold ltr">
                            {{ data.value.created_at ? $helpers.formatCustomDate(data.value.created_at) : '' }}
                        </span>
                        <tippy>{{ $helpers.formatCustomDate(data.value.created_at, true) }}</tippy>
                    </template>

                    <template v-if="$can('edit_usertypes') || $can('delete_usertypes')" #actions="data">
                        <div class="flex gap-2">
                            <div v-if="$can('edit_usertypes')" class="text-center">
                                <button type="button" v-tippy @click="toggleModal(data.value)">
                                    <Svg name="pencil" class="size-5"></Svg>
                                </button>
                                <tippy>{{ $t('common.edit') }}</tippy>
                            </div>
                            <div v-if="$can('delete_usertypes')" class="text-center">
                                <button type="button" v-tippy @click="callDelete(data.value)">
                                    <Svg name="trash" class="size-5"></Svg>
                                </button>
                                <tippy>{{ $t('common.delete') }}</tippy>
                            </div>
                        </div>
                    </template>
                </Datatable>
            </div>
        </div>
    </div>
</template>
<script setup>
import { inject, onMounted, ref } from 'vue';
import { useForm, Head, Link } from '@inertiajs/vue3';
import { TransitionRoot, TransitionChild, Dialog, DialogPanel, DialogOverlay } from '@headlessui/vue';
import { wTrans, trans } from 'laravel-vue-i18n';
import Swal from 'sweetalert2';
import Svg from '@/Components/Svg.vue';
import Spinner from '@/Components/Spinner.vue';
import Datatable from '@/Components/Datatable.vue';
import { initializeFilters, updateFilters } from '@/Plugins/filtersPlugin';
import VueEasyLightbox from 'vue-easy-lightbox';
import VInput from '@/Components/Inputs/VInput.vue';
import CustomDatePicker from '@/Components/Inputs/CustomDatePicker.vue';
import { useDateFilters } from '@/composables/useDateFilters.js';
const props = defineProps([
    'type',
    'filter',
]);

const $helpers = inject('helpers');


const filters = initializeFilters({
    search: '',
    number_rows: 10,
    sort_by: 'id',
    sort_direction: 'desc',
    start_date: props.filter.start_date || '',
    end_date: props.filter.end_date || '',
});

const apply_filter = () => {
    updateFilters({
        ...filters,
        start_date: filters.start_date || '',
        end_date: filters.end_date || '',
    });
};

const { dateRangeModel, handleApplyFilter, handleClearFilter } = useDateFilters(filters, apply_filter);

const form = useForm({
    name: '',
    slug: '',
    id: null,
});
// Reset form on component mount
onMounted(() => {
    form.reset();
});
const toggleModal = (row) => {
    if (row) {
        form.id = row.id;
        form.name = row.name;
        form.slug = row.slug;
    }
    showModal.value = !showModal.value;

    if (!showModal.value) {
        form.id = null;
        form.name = '';
        form.slug = '';
    }
};
const showModal = ref(false);

const save = () => {
    // Validate form
    if (form.id) {
        // Update existing record
        form.put(route('control.system.usertype.update', form.id), {
            onSuccess: () => {
                toggleModal();
                $helpers.toast(trans('common.record') + ' ' + trans('common.updated'));
            },
        });
        return;
    }
    // Create new record
    form.post(route('control.system.usertype.store'), {
        onSuccess: () => {
            toggleModal();
            $helpers.toast(trans('common.record') + ' ' + trans('common.created'));
        },
    });
}

// Watch for changes in filters and apply them
const columns =
    ref([
        {
            field: 'id',
            title: 'ID',
            width: '25px',
            type: 'number',
        },
        {
            field: 'name',
            title: wTrans('common.name')
        },
        {
            field: 'slug',
            title: wTrans('common.slug')
        },

        {
            field: 'updated_at',
            title: wTrans('common.updated_at'),
            type: 'date',
            hide: true,
        },
        {
            field: 'created_at',
            title: wTrans('common.created_at'),
            type: 'date',
        },
        {
            field: 'actions',
            title: wTrans('common.actions'),
            width: '50px',
            sort: false,
        },
    ]) || [];

// Delete record
const callDelete = (data) => {

    if (data.users_count > 0) {
        Swal.fire({
            icon: "error",
            icon: "error",
            title: trans("common.action_not_allowed"),
            text: trans("common.cannot_delete_active_user_type"),
        });
    } else {
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
                form.delete(route('control.system.usertype.destroy', data.id), {
                    onSuccess: () => {
                        $helpers.toast(trans('common.record') + ' ' + trans('common.deleted'));
                    },
                });
            }
        });
    };
}
</script>