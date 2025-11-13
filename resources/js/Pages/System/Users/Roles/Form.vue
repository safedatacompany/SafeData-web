<template>

    <Head>
        <title>{{ $t('system.roles') }}</title>
    </Head>

    <div class="mx-auto">
        <div class="w-full flex flex-wrap items-center justify-between gap-x-5 gap-y-2.5 -mt-1">
            <div>

                <perfect-scrollbar class="relative min-w-full">
                    <div class="whitespace-nowrap">
                        <ul class="flex  space-x-2 rtl:space-x-reverse">
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
                                <Link :href="route('control.system.users.roles.index')"
                                    class="duration-200 hover:text-primary">
                                {{ $t('system.roles') }}
                                </Link>
                            </li>
                            <li class="before:content-['/'] ltr:before:mr-2 rtl:before:ml-2 space-x-1 ">
                                <span v-if="form.id">{{ $t('common.edit') }}</span>
                                <span v-else>{{ $t('common.new') }}</span>
                                <span>{{ $t('system.role') }}</span>
                            </li>
                        </ul>
                    </div>
                </perfect-scrollbar>
            </div>
            <button @click="submit" :disabled="form.processing" class="btn btn-sm btn-primary">
                <Spinner v-if="form.processing" />
                {{ $t('system.save_changes') }}
            </button>
        </div>

        <div class="flex flex-col lg:flex-row gap-5 py-5">
            <!-- Information -->
            <div class="w-full lg:w-4/12 2xl:w-3/12">
                <div class="panel sticky top-20">
                    <div class="mb-3">
                        <h5 class="font-semibold b-text-lg dark:text-white-light">
                            {{ $t('system.information') }}
                        </h5>
                    </div>

                    <form @submit.prevent="submit">
                        <div class="flex flex-col gap-4">
                            <div class="col-span-full">
                                <label for="name" class="required">
                                    {{ $t('system.name') }}
                                </label>
                                <VInput v-model="form.name" type="text" :placeholder="$t('system.name')"
                                    :error="form.errors.name">
                                </VInput>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="w-full lg:w-8/12 2xl:w-9/12">
                <div class="panel">
                    <form @submit.prevent="submit">
                        <div class="mb-3">
                            <h5 class="font-semibold b-text-lg dark:text-white-light">
                                {{ $t('system.permissions') }}
                            </h5>
                            <p class="b-text-sm text-gray-600 dark:text-gray-400">
                                {{ $t('system.fine_tune_role_permissions') }}
                            </p>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 2xl:grid-cols-3 gap-4 pt-2">
                            <template v-for="(permissions, group) in permissions" :key="group">
                                <template v-if="canViewPermissionsSection(permissions[0].group_permissions.name)">
                                    <div
                                        class="flex flex-col w-full rounded-md border border-gray-200 dark:border-gray-800 overflow-hidden">
                                        <div class="inline-flex items-center justify-between py-2.5 px-3.5">
                                            <label class="w-full inline-flex items-center cursor-pointer m-0">
                                                <input type="checkbox" class="form-checkbox rounded-full peer"
                                                    @click="toggleGroupPermissions(permissions)"
                                                    :checked="isGroupChecked(permissions)" @click.stop />
                                                <span class="capitalize cursor-pointer leading-3">
                                                    {{ permissions[0].group_permissions.name }}
                                                </span>
                                            </label>
                                            <div
                                                class="flex gap-1 b-text-xs text-gray-500 dark:text-gray-400 whitespace-nowrap">
                                                <p class="font-medium text-primary">
                                                    {{permissions.filter(gp => form.permissions?.some(fp => fp.name ===
                                                        gp.name)).length}}
                                                </p>
                                                <p> / {{ permissions.length }} {{ $t('common.selected') }}</p>
                                            </div>
                                        </div>

                                        <div class="py-2.5 px-3.5 border-t border-[#d3d3d3] dark:border-[#1b2e4b]">
                                            <div class="flex flex-wrap gap-2">
                                                <button v-for="(permission, i) in permissions" :key="i" type="button"
                                                    @click="togglePermission(!form.permissions?.filter(x => x.name == permission.name)?.length, permission, permissions)"
                                                    :class="[
                                                        'px-4 capitalize py-2 rounded-full b-text-sm font-medium transition',
                                                        form.permissions?.filter(x => x.name == permission.name)?.length
                                                            ? 'bg-primary text-white shadow'
                                                            : 'bg-gray-200 dark:bg-[#1b2e4b] hover:bg-primary hover:text-white'
                                                    ]">
                                                    <span class="b-text-xs cursor-pointer">
                                                        {{ $t('common.' + (permission?.name || '')
                                                            .replace('_' + permissions[0].group_permissions.name, '')) ||
                                                            (permission?.name || '')
                                                                .replace('_' + permissions[0].group_permissions.name, '') }}
                                                    </span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </template>
                            </template>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Bottom Actions -->
        <div
            class="sticky bottom-0 bg-white dark:bg-gray-900 border-t border-[#d3d3d3] dark:border-[#1b2e4b] p-3 -mx-6">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div class="b-text-sm text-gray-600 dark:text-gray-400">
                    <span v-if="form.id">
                        {{ $t('system.last_updated') }}: {{ $helpers.formatCustomDate(role?.updated_at, true) }}
                    </span>
                    <span v-else>{{ $t('system.creating_new_user_account') }}</span>
                    <p class="text-danger b-text-xs" v-if="form.errors.permissions" v-html="form.errors.permissions">
                    </p>
                </div>
                <div class="flex items-center gap-3">
                    <Link :href="route('control.system.users.index')" class="btn btn-sm btn-outline-secondary">
                    {{ $t('common.back') }}
                    </Link>
                    <button @click="submit" :disabled="form.processing" class="btn btn-sm btn-primary min-w-[120px]">
                        <Spinner v-if="form.processing" />
                        {{ $t('system.save_changes') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, inject, } from "vue";
import { useForm, Head, Link, usePage } from "@inertiajs/vue3";
import { trans } from 'laravel-vue-i18n';
import VInput from '@/Components/Inputs/VInput.vue';

const $helpers = inject('helpers');

const page = usePage();

const props = defineProps({
    roles: [Array, Object],
    role: [Object],
    permissions: [Array, Object],
});

const form = useForm({
    id: props.role?.id || null,
    name: props.role?.name || "",
    permissions: props.role?.permissions || [],
});


const submit = () => {

    // Only send permission IDs, not objects
    if (form.permissions.length && typeof form.permissions[0] === 'object') {
        form.permissions = form.permissions.map((p) => p.id);
    }

    if (props.role?.id) {
        form.put(route('control.system.users.roles.update', props.role.id), {
            onSuccess: () => {
                $helpers.toast(trans('common.record') + ' ' + trans('common.updated'));
            }
        });
    } else {
        form.post(route('control.system.users.roles.store'), {
            onSuccess: () => {
                $helpers.toast(trans('common.record') + ' ' + trans('common.created'));
                resetForm();
            }
        });
    }
};



const resetForm = () => {
    form.reset();
};

const toggleGroupPermissions = (permissions, _permission = null, _checked = null) => {

    let checked = _checked || form.permissions.find(x => x.name == permissions[0].name);

    permissions.forEach(permission => {
        if (_permission) {
            if (_permission === permission.name.split('_').shift()) {
                permission = togglePermission(checked ? false : true, permission);
            }
            return;
        }

        permission = togglePermission(checked ? false : true, permission);

    });

}


const togglePermission = (checked, permission, permissions = []) => {
    if (checked) {

        form.permissions = form.permissions || [];
        form.permissions.push(permission);

        const view = permissions.find(x => x?.name?.startsWith('view'))

        if ((!permission?.name?.startsWith('view') && view)) {
            togglePermission(checked, view);
        }

    } else {
        form.permissions = form.permissions.filter(x => x.name != permission.name);

        if (permission?.name?.startsWith('view') && !permission?.name?.startsWith('view_any') && permissions) {
            permissions.forEach(permission => {
                togglePermission(checked, permission);
            });
        }
    }

}

const isGroupChecked = (permissions) => {
    if (!permissions?.length) return false;

    return permissions.every(permission =>
        form.permissions?.some(formPerm => formPerm.name === permission.name)
    );
};


const canViewPermissionsSection = (group) => {
    const user = page.props.auth.user;

    if (user?.roles?.some(role => role.name === 'super_admin')) {
        return true;
    }

    const allowed = [
        'permissions',
        'group_permissions',
        'languages',
        'keys',
        'translations',
        'themes',
    ];
    if (allowed.includes(group)) {
        return false;
    } else {
        return true;
    }
};



</script>