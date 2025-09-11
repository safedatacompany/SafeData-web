<template>

    <Head>
        <title>{{ $t('system.permissions') }}</title>
    </Head>
    <div class="mx-auto">
        <div class="w-full flex flex-wrap items-center justify-between gap-x-5 gap-y-2.5 -mt-1">
            <div>
                <perfect-scrollbar class="relative min-w-full">
                    <div class="whitespace-nowrap">
                        <ul class="flex space-x-2 rtl:space-x-reverse">
                            <li class="text-gray-500">
                                <span>{{ $t('system.system') }}</span>
                            </li>
                            <li class="before:content-['/'] ltr:before:mr-2 rtl:before:ml-2">
                                <Link :href="route('control.system.users.index')"
                                    class="duration-200 hover:text-primary">
                                {{ $t("system.users") }}
                                </Link>
                            </li>
                            <li class="before:content-['/'] ltr:before:mr-2 rtl:before:ml-2">
                                <span>{{ $t('system.permissions') }}</span>
                            </li>
                        </ul>
                    </div>
                </perfect-scrollbar>
            </div>
            <div class="block">
                <div class="flex items-center justify-center">
                    <button v-if="$can('create_permissions')" type="button"
                        class="btn btn-sm btn-primary shadow-none flex items-center gap-1" @click="toggleModal()">
                        <Svg name="new" class="size-4"></Svg>
                        <span>{{ $t('common.new') }} {{ $t('system.permissions') }}</span>
                    </button>
                </div>
                <TransitionRoot appear :show="showModal" as="template">
                    <Dialog as="div" @close="toggleModal()" class="relative z-50 ">
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
                                        class="panel border-0 p-0  rounded-lg w-full max-w-lg text-black dark:text-white-dark">
                                        <button type="button"
                                            class="absolute top-4 ltr:right-4 rtl:left-4 text-gray-400 hover:text-gray-800 dark:hover:text-gray-600 outline-none"
                                            @click="toggleModal()">
                                            <Svg name="close" class="size-6"></Svg>
                                        </button>
                                        <div
                                            class="text-lg font-bold rounded-lg bg-[#fbfbfb] dark:bg-[#121c2c] ltr:pl-5 rtl:pr-5 py-3 ltr:pr-[50px] rtl:pl-[50px]">
                                            <span v-if="form.id">
                                                {{ $t('common.edit') }}
                                            </span>
                                            <span v-else>
                                                {{ $t('common.new') }}
                                            </span>
                                            {{ $t('system.permissions') }}
                                        </div>
                                        <div class="p-5">
                                            <form @submit.prevent="save" class="">

                                                <div class="flex flex-col gap-5">
                                                    <div class="col-span-full">
                                                        <label for="name" class="required">
                                                            {{ $t('system.name') }}
                                                        </label>
                                                        <VInput v-model="form.name" type="text"
                                                            :placeholder="$t('system.name')" :error="form.errors.name">
                                                        </VInput>
                                                    </div>
                                                    <div>
                                                        <label for="name" class="required">
                                                            {{ $t('system.layer_one_permission') }}
                                                        </label>
                                                        <MultiSelect v-model="form.layer_one_permission_id"
                                                            :list="props.layerOnePermissions" label="name" track-by="id"
                                                            :multiple="false"
                                                            :error="form.errors.layer_one_permission_id" />

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
                <Datatable :rows="permissions" :columns="columns" :totalRows="permissions.data?.length"
                    @change="apply_filter" v-model:search="filters.search" v-model:numberRows="filters.number_rows"
                    :filter="props.filter" v-model:sortBy="filters.sort_by"
                    v-model:sortDirection="filters.sort_direction">

                    <template #group_name_name="data">
                        {{ data.value.group_name?.name ?? '-' }}
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

                    <template v-if="$can('edit_permissions') || $can('delete_permissions')" #actions="data">
                        <div class="flex gap-2">
                            <div v-if="$can('edit_permissions')" class="text-center">
                                <button type="button" v-tippy @click="toggleModal(data.value)">
                                    <Svg name="pencil" class="size-5"></Svg>
                                </button>
                                <tippy>{{ $t('common.edit') }}</tippy>
                            </div>
                            <div v-if="$can('delete_permissions')" class="text-center">
                                <button type="button" v-tippy @click="callDelete(data.value.id)">
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
import { ref, inject, computed, watch } from "vue";
import { useForm, Head, Link } from '@inertiajs/vue3';
import MultiSelect from '@/Components/Inputs/MultiSelect.vue';
import { TransitionRoot, TransitionChild, Dialog, DialogPanel, DialogOverlay } from '@headlessui/vue';
import { wTrans, trans } from 'laravel-vue-i18n';
import Swal from 'sweetalert2';
import Svg from '@/Components/Svg.vue';
import Datatable from '@/Components/Datatable.vue';
import { initializeFilters, updateFilters } from '@/Plugins/FiltersPlugin';
import VInput from '@/Components/Inputs/VInput.vue';


const props = defineProps({
    permissions: Object,
    layerOnePermissions: Array,
    filter: Object
});

const $helpers = inject('helpers');

const filters = initializeFilters({
    search: '',
    number_rows: 10,
    sort_by: 'id',
    sort_direction: 'desc',
});

const form = useForm({
    name: "",
    layer_one_permission_id: null,
});


const apply_filter = () => {
    updateFilters({
        ...filters,
    });
};

const columns = ref([
    { field: 'id', title: 'ID', width: '25px', type: 'number' },
    { field: 'name', title: wTrans('common.name') },
    { field: 'layer_one_permission.name', title: wTrans('system.group_name') },
    { field: 'updated_at', title: wTrans('common.updated_at'), type: 'date', hide: true },
    { field: 'created_at', title: wTrans('common.created_at'), type: 'date' },
    { field: 'actions', title: wTrans('common.actions'), width: '50px', sort: false },
]);


const showModal = ref(false);


const toggleModal = (row) => {
    if (row) {
        // Edit mode
        form.id = row.id;
        form.name = row.name;
        form.layer_one_permission_id = $helpers.getObjectById(row.layer_one_permission_id, props.layerOnePermissions) || null;
    } else {
        // Create mode
        form.id = null;
        form.name = '';
        form.layer_one_group_id = null;
    }
    showModal.value = !showModal.value;
};

const save = () => {
    const payload = {
        name: form.name,
        layer_one_group_id: form.layer_one_group_id?.id || null
    };

    if (form.id) {
        form.put(route('control.system.users.permissions.update', form.id), {
            data: payload,
            onSuccess: () => {
                toggleModal();
                $helpers.toast(trans('common.record') + ' ' + trans('common.updated'));
            },
        });
    } else {
        form.post(route('control.system.users.permissions.store'), {
            data: payload,
            onSuccess: () => {
                toggleModal();
                $helpers.toast(trans('common.record') + ' ' + trans('common.created'));
            },
        });
    }
};



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
            form.delete(route('control.system.users.permissions.destroy', id), {
                onSuccess: () => {
                    $helpers.toast(trans('common.record') + ' ' + trans('common.deleted'));
                },
            });
        }
    });
};
</script>