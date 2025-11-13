<template>

    <Head>
        <title>{{ $t('system.roles') }}</title>
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
                                <span>{{ $t('system.roles') }}</span>
                            </li>
                        </ul>
                    </div>
                </perfect-scrollbar>
            </div>
            <div class="block">
                <div class="flex items-center justify-center">
                    <Link v-if="$can('create_roles')" :href="route('control.system.users.roles.create')" type="button"
                        class="btn btn-sm btn-primary shadow-none flex items-center gap-1">
                    <Svg name="new" class="size-4"></Svg>
                    <span>{{ $t('common.new') }} {{ $t('system.roles') }}</span>
                    </Link>
                </div>
            </div>
        </div>
        <div class="pt-4">
            <div class="panel pb-0">
                <Datatable :rows="props.roles" :columns="columns" :totalRows="props.roles.data?.length"
                    @change="apply_filter" v-model:search="filters.search" v-model:numberRows="filters.number_rows"
                    :filter="props.filter" v-model:sortBy="filters.sort_by"
                    v-model:sortDirection="filters.sort_direction">
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

                    <template v-if="$can('edit_roles') || $can('delete_roles')" #actions="data">
                        <div class="flex gap-2">
                            <div v-if="$can('edit_roles') && (checkRole(data.value.name))" class="text-center">
                                <Link :href="route('control.system.users.roles.edit', data.value.id)" v-tippy>
                                <Svg name="pencil" class="size-5"></Svg>
                                </Link>
                                <tippy>{{ $t('common.edit') }}</tippy>
                            </div>
                            <div v-if="$can('delete_roles') && (checkRole(data.value.name))" class="text-center">
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
import { useForm, Head, Link, router, usePage } from '@inertiajs/vue3';
import { wTrans, trans } from 'laravel-vue-i18n';
import Swal from 'sweetalert2';
import Svg from '@/Components/Svg.vue';
import Datatable from '@/Components/Datatable.vue';
import { initializeFilters, updateFilters } from '@/Plugins/FiltersPlugin';

const props = defineProps({
    roles: Object,
    filter: Object
});

const page = usePage();

const $helpers = inject('helpers');

const filters = initializeFilters({
    search: '',
    number_rows: 10,
    sort_by: 'id',
    sort_direction: 'desc',
});

const apply_filter = () => {
    updateFilters({
        ...filters,
    });
};

const columns = ref([
    { field: 'id', title: 'ID', width: '25px', type: 'number' },
    { field: 'name', title: wTrans('common.name') },
    { field: 'updated_at', title: wTrans('common.updated_at'), type: 'date', hide: true },
    { field: 'created_at', title: wTrans('common.created_at'), type: 'date' },
    { field: 'actions', title: wTrans('common.actions'), width: '50px', sort: false },
]);

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
            router.delete(route('control.system.users.roles.destroy', id), {
                onSuccess: () => {
                    $helpers.toast(trans('common.record') + ' ' + trans('common.deleted'));
                },
            });

        }
    });
};

const checkRole = (roleName) => {
    // Prevent editing/deleting super_admin and developer roles
    return !(roleName === 'super_admin' || roleName === 'developer');
};
</script>