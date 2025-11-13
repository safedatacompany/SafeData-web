<template>

    <Head>
        <title>{{ $t('system.users') }}</title>
    </Head>

    <div class="mx-auto">
        <div class="w-full flex flex-wrap items-center justify-between gap-x-5 gap-y-2.5 -mt-1">
            <div>
                <perfect-scrollbar class="relative min-w-full">
                    <div class="whitespace-nowrap">
                        <ul class="flex  space-x-2 rtl:space-x-reverse">
                            <li class="text-gray-400">
                                <span>{{ $t('system.system') }}</span>
                            </li>
                            <li class="before:content-['/'] ltr:before:mr-2 rtl:before:ml-2">
                                <span>{{ $t('system.users') }}</span>
                            </li>
                        </ul>
                    </div>
                </perfect-scrollbar>
            </div>
            <div v-if="$can('create_users|view_roles|view_permissions')" class="flex items-center gap-2">
                <!--Creating new user-->
                <Link v-if="$can('view_roles')" :href="route('control.system.users.roles.index')" type="button"
                    class="btn btn-primary btn-sm shadow-none flex items-center gap-1">
                <Svg name="shield" class="size-4"></Svg>
                <span>{{ $t('system.roles') }}</span>
                </Link>

                <!--permissions section-->
                <Link v-if="$is('developer')" :href="route('control.system.users.permissions.index')" type="button"
                    class="btn btn-primary btn-sm shadow-none flex items-center gap-1">
                <Svg name="lock" class="size-4"></Svg>
                <span>{{ $t('system.permissions') }}</span>
                </Link>

                <!--Creating new user-->
                <Link v-if="$can('create_users')" :href="route('control.system.users.create')" type="button"
                    class="btn btn-primary btn-sm shadow-none flex items-center gap-1">
                <Svg name="new" class="size-4"></Svg>
                <span>{{ $t('common.new') }} {{ $t('system.user') }}</span>
                </Link>

            </div>
        </div>
        <div class="pt-4">
            <div class="panel pb-0">
                <div v-if="1" class="flex items-center flex-wrap gap-x-0 lg:gap-x-1.5 gap-y-1.5 mb-1.5 -mt-1.5">

                    <!-- Owner -->
                    <!-- <div class="mb-1.5">
                        <CustomMultiSelect v-model="form.user" :list="owners" :label="$t('system.owner')"
                            :multiple="true" />
                    </div> -->

                    <!-- Created Date -->
                    <!-- <div class="mb-1.5">
                        <Datepicker v-model="form.created_at" :label="$t('system.created_at')" />
                    </div> -->

                </div>

                <!-- Datatable -->
                <Datatable :rows="users" :columns="columns" :totalRows="users.data?.length" @change="apply_filter"
                    v-model:search="filters.search" v-model:numberRows="filters.number_rows" :filter="props.filter"
                    v-model:sortBy="filters.sort_by" v-model:sortDirection="filters.sort_direction" :checkable="true"
                    @update:selection="onSelection" @bulk-delete="onBulkDelete">

                    <template #user="data">
                        <div class="flex items-center gap-2">
                            <img :src="data.value.avatar ? data.value.avatar : `/assets/images/avatar.png`"
                                class="w-9 h-9 rounded-full max-w-none" alt="user-profile" />
                            <div class="flex flex-col">
                                <div class="font-semibold">{{ data.value.name }}</div>
                                <div class="font-semibold b-text-xs text-gray-400">{{ data.value.email }}</div>
                            </div>
                        </div>
                    </template>

                    <template #is_active="data">
                        <span class="capitalize" :class="data.value.is_active ? 'text-success' : 'text-danger'">
                            {{ data.value.is_active ? $t('system.yes') : $t('system.no') }}
                        </span>
                    </template>

                    <template #roles="data">
                        <div class="flex flex-col">
                            <div v-for="(role, index) in data.value.roles" :key="index" class="flex items-center gap-1">
                                <div class="size-1.5 bg-green-500 rounded-full"></div>
                                <div class="font-semibold capitalize">{{ role.name }}</div>
                            </div>
                        </div>
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

                    <template v-if="$can('edit_users') || $can('delete_users') || $can('restore_users')"
                        #actions="data">

                        <!-- Active Record Actions -->
                        <div v-if="data.value.deleted_at == null" class="flex items-center gap-2">
                            <div class="text-center">
                                <div class="block" v-tippy>
                                    <Link
                                        v-if="$can('edit_users') && (!isProtectedRole(data.value.roles) || $is('developer') || $is('super_admin'))"
                                        :href="route('control.system.users.edit', data.value.id)">
                                    <Svg name="pencil" class="size-5"></Svg>
                                    </Link>
                                </div>
                                <tippy>{{ $t('common.edit') }}</tippy>
                            </div>

                            <div v-if="$can('delete_users') && (!isProtectedRole(data.value.roles) || $is('developer') || $is('super_admin')) && data.value.id !== authUser.id"
                                class="text-center">
                                <button type="button" v-tippy @click="callDelete(data.value.id)">
                                    <Svg name="trash" class="size-5"></Svg>
                                </button>
                                <tippy>{{ $t('common.delete') }}</tippy>
                            </div>
                        </div>

                        <!-- Deleted Record Actions -->
                        <div v-else class="flex gap-2">
                            <div v-if="$can('delete_users') && data.value.id !== authUser.id" class="text-center">
                                <button type="button" v-tippy @click="callForceDelete(data.value)">
                                    <Svg name="trash" class="size-5"></Svg>
                                </button>
                                <tippy>{{ $t('common.delete') }}</tippy>
                            </div>
                            <div v-if="$can('restore_users')" class="text-center">
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
import { inject, ref } from 'vue';
import { Link, Head, router, usePage } from '@inertiajs/vue3';
import Svg from '@/Components/Svg.vue';
import { wTrans } from 'laravel-vue-i18n';
import { trans } from 'laravel-vue-i18n';
import Swal from 'sweetalert2';
import Datatable from '@/Components/Datatable.vue';
import { initializeFilters, updateFilters } from '@/Plugins/FiltersPlugin';

const rtlClass = inject('rtlClass');
const $helpers = inject('helpers');

// Authenticated user (used to prevent self-delete in the UI)
const authUser = usePage().props.auth.user;

const groupFilter = ref('all');

const props = defineProps([
    'users',
    'filter',
]);

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

const selection = ref([]);

const onSelection = (ids) => {
    selection.value = ids;
    console.log('selection updated', selection.value);
};

const onBulkDelete = (ids) => {
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
            console.log('bulk-delete confirmed for ids:', ids);
        }
    });
};

// Returns true if the provided roles array contains protected roles
// that should only be editable/deletable by developer or super admin.
const isProtectedRole = (roles) => {
    if (!roles || !Array.isArray(roles)) return false;
    const protectedNames = ['developer', 'super admin', 'super_admin', 'super-admin', 'superadmin'];
    return roles.some(r => {
        const name = (r && r.name) ? String(r.name).toLowerCase() : '';
        return protectedNames.includes(name) || name === 'super admin' || name === 'super_admin' || name === 'superadmin';
    });
};

const columns =
    ref([
        {
            field: 'id',
            title: wTrans('common.id'),
            isUnique: true,
            width: '25px',
            type: 'number',
        },
        {
            field: 'user',
            title: wTrans('system.user')
        },
        {
            field: 'phone',
            title: wTrans('system.phone')
        },
        {
            field: 'roles',
            title: wTrans('system.roles')
        },
        {
            field: 'is_active',
            title: wTrans('system.is_active')
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
            sort: false
        },
    ]) || [];

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
            router.delete(route('control.system.users.destroy', { user: id }), {
                onSuccess: () => {
                    $helpers.toast(trans('common.record') + ' ' + trans('common.deleted'));
                },
            });
        }
    });
};


// Force delete user (permanent)
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
            router.delete(route('control.system.users.force_delete', row.id), {
                onSuccess: () => {
                    $helpers.toast(trans('common.record') + ' ' + trans('common.deleted'));
                },
            });
        }
    });
};

// Restore soft-deleted user
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
            router.post(route('control.system.users.restore', row.id), {
                onSuccess: () => {
                    $helpers.toast(trans('common.record') + ' ' + trans('common.restored'));
                },
            });
        }
    });
};


</script>