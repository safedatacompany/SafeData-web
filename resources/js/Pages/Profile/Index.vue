<template>

    <Head>
        <title>{{ $t('nav.profile') }}</title>
    </Head>

    <div class="space-y-6">
        <!-- Breadcrumb -->
        <ul class="flex space-x-2 rtl:space-x-reverse">
            <li class="text-gray-500">
                <span>{{ $t('system.system') }}</span>
            </li>
            <li class="before:content-['/'] ltr:before:mr-2 rtl:before:ml-2">
                <span>{{ $t('system.profile') }}</span>
            </li>
        </ul>

        <!-- Main Content -->
        <div class="flex flex-col md:flex-row gap-6">
            <!-- Profile Information Card -->
            <div class="w-full md:max-w-xs">
                <div class="panel p-4">
                    <div class="text-center">
                        <!-- Profile Avatar -->
                        <div class="relative inline-block mb-3">
                            <!-- <ImageUpload v-model="imageForm.avatar" v-model:form="imageForm" field-name="avatar"
                                :custom-class="'!size-24 !rounded-full'" /> -->
                            <ImageUpload v-model="imageForm.avatar" :form="imageForm" field-name="avatar"
                                :custom-class="'!size-24 !rounded-full'" @update:form="updateImageForm" />
                            <!-- <img src="http://127.0.0.1:8000/storage/2/logo.png" alt=""> -->
                        </div>

                        <!-- User Info -->
                        <!-- <h3 class="b-text-xl font-semibold text-gray-900 dark:text-white mb-1">
                            {{ user.name }}
                        </h3>
                        <p class="text-gray-600 dark:text-gray-400 mb-4">
                            {{ user.email }}
                        </p> -->
                        <div class="flex items-center justify-center gap-2">
                            <div class="b-text-lg text-gray-500">{{ $t('system.privilege') }}: </div>
                            <div class="b-text-lg font-semibold text-primary capitalize">
                                {{ userRoles }}
                            </div>
                        </div>

                        <!-- Profile Stats -->
                        <!-- <div v-if="userRoles"
                            class="grid grid-cols-1 gap-4 text-center border-t pt-4 dark:border-gray-700">
                            <div>
                                <div class="b-text-lg font-semibold text-primary capitalize">
                                    {{ userRoles }}
                                </div>
                                <div class="b-text-xs text-gray-500">{{ $t('system.privilege') }}</div>
                            </div>
                            <div>
                                <div class="b-text-lg font-semibold text-success">
                                    {{ $t(`system.${userAuthority}`) }}
                                </div>
                                <div class="b-text-xs text-gray-500">{{ $t('system.authority') }}</div>
                            </div>
                        </div> -->

                        <!-- Divider -->
                        <div class="col-span-full mx-auto w-2/3 border-b border-gray-100 dark:border-[#191e3a] my-3">
                        </div>

                        <!-- Information -->
                        <div class="grid grid-cols-1 gap-5 text-start">

                            <!-- Name -->
                            <div>
                                <label for="name" class="required">{{ $t('system.name') }}</label>
                                <input v-model="form.name" id="name" type="text"
                                    :placeholder="$t('common.enter') + ' ' + $t('system.name')" class="form-input"
                                    :class="{ 'border border-red-300 rounded-md': form.errors.name }" />
                                <div class="mt-1 text-danger" v-if="form.errors.name" v-html="form.errors.name">
                                </div>
                            </div>

                            <!-- Email -->
                            <div>
                                <label for="email" class="required">{{ $t('system.email') }}</label>
                                <VInput type="email" v-model="form.email"
                                    :class="{ 'border border-red-300 rounded-md': form.errors.email }">
                                    <template #before>
                                        @
                                    </template>
                                </VInput>

                                <div class="mt-1 text-danger" v-if="form.errors.email" v-html="form.errors.email">
                                </div>
                            </div>

                            <!-- Phone One -->
                            <div class="col-span-full">
                                <label for="phone" class="required">
                                    {{ $t('system.phone') }}
                                </label>
                                <PhoneSelect v-model="form.phone"
                                    :class="{ 'border border-red-300 rounded-md': form.errors.phone }" />
                                <div class="mt-1 text-danger" v-if="form.errors.phone" v-html="form.errors.phone">
                                </div>
                            </div>

                            <!-- Password -->
                            <div>
                                <label for="password">
                                    {{ $t('system.password') }}
                                </label>

                                <VInput :type="form.show_password ? 'text' : 'password'" v-model="form.password"
                                    :placeholder="$t('system.password')"
                                    :class="{ 'border border-red-300 rounded-md': form.errors.password }">
                                    <template #after>
                                        <Svg @click="form.show_password = !form.show_password"
                                            v-if="!form.show_password" name="eye" class="cursor-pointer size-5"></Svg>
                                        <Svg @click="form.show_password = !form.show_password" v-else name="eye_line"
                                            class="cursor-pointer size-5"></Svg>
                                    </template>
                                </VInput>
                                <p class="b-text-xs text-gray-500 mt-1">
                                    {{ $t('system.leave_blank_to_keep_current') }}
                                </p>

                                <div class="mt-1 text-danger" v-if="form.errors.password" v-html="form.errors.password">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Settings Panel -->
            <div class="w-full md:max-w-xl">
                <div class="panel p-6">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="bg-primary/10 p-2 rounded-lg">
                            <Svg name="setup" class="size-5 text-primary"></Svg>
                        </div>
                        <div>
                            <h2 class="b-text-xl font-semibold text-gray-900 dark:text-white">
                                {{ $t('system.appearance_settings') }}
                            </h2>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <!-- Typography Section -->
                        <div class="space-y-4">
                            <h3
                                class="b-text-lg font-medium text-gray-900 dark:text-white border-b pb-2 dark:border-gray-700">
                                {{ $t('system.typography') }}
                            </h3>
                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                                <div class="space-y-2">
                                    <label class="block b-text-sm font-medium text-gray-700 dark:text-gray-300">
                                        {{ $t('system.font_size') }}
                                    </label>
                                    <MultiSelect v-model="form.font_scale" :list="scaleOptions" label="name"
                                        value="value" :showValue="false" :error="form.errors.font_scale" />
                                </div>
                                <div class="space-y-2">
                                    <label class="block b-text-sm font-medium text-gray-700 dark:text-gray-300">
                                        {{ $t('system.font_weight') }}
                                    </label>
                                    <MultiSelect v-model="form.font_weight" :list="weightOptions" label="name"
                                        value="value" :showValue="false" :error="form.errors.font_weight" />
                                </div>
                            </div>
                        </div>

                        <!-- Localization Section -->
                        <div class="space-y-4">
                            <h3
                                class="b-text-lg font-medium text-gray-900 dark:text-white border-b pb-2 dark:border-gray-700">
                                {{ $t('system.localization') }}
                            </h3>
                            <div class="grid grid-cols-1 lg:grid-cols-1 gap-4">
                                <div class="space-y-2">
                                    <label class="block b-text-sm font-medium text-gray-700 dark:text-gray-300">
                                        {{ $t('system.language') }}
                                    </label>
                                    <MultiSelect v-model="form.language_id" :list="page.props.languages" label="slug"
                                        parent-key="system" :error="form.errors.language_id" />
                                </div>
                            </div>
                        </div>

                        <!-- Theme Section -->
                        <div class="space-y-4">
                            <h3
                                class="b-text-lg font-medium text-gray-900 dark:text-white border-b pb-2 dark:border-gray-700">
                                {{ $t('system.visual_theme') }}
                            </h3>
                            <div class="space-y-2">
                                <label class="block b-text-sm font-medium text-gray-700 dark:text-gray-300">
                                    {{ $t('system.theme') }}
                                </label>
                                <MultiSelect v-model="form.theme" :list="props.theme" label="slug" value="name"
                                    parent-key="system" :showValue="false" :error="form.errors.theme" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Bottom Actions -->
        <div
            class="sticky bottom-0 bg-white dark:bg-gray-900 border-t border-[#d3d3d3] dark:border-[#1b2e4b] p-3 -mx-6">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div class="b-text-sm text-gray-600 dark:text-gray-400">
                    <span v-if="user.updated_at">
                        {{ $t('system.last_updated') }}: {{ $helpers.formatCustomDate(user.updated_at, true) }}
                    </span>
                </div>
                <div class="flex items-center gap-3">
                    <button @click="updateSettings" :disabled="form.processing"
                        class="btn btn-sm btn-primary min-w-[120px]">
                        <Svg v-if="form.processing" name="main_spinner"
                            class="animate-spin w-4 h-4 ltr:mr-2 rtl:ml-2"></Svg>
                        {{ form.processing ? $t('system.saving') : $t('system.save_changes') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
import { wTrans, trans } from 'laravel-vue-i18n';
import { inject, ref, computed, watch } from 'vue';
import { Head, useForm, usePage } from '@inertiajs/vue3';
import MultiSelect from '@/Components/Inputs/MultiSelect.vue';
import Svg from '@/Components/Svg.vue';
import ImageUpload from '@/Components/Inputs/ImageUpload.vue';
import VInput from '@/Components/Inputs/VInput.vue';
import PhoneSelect from '@/Components/Inputs/PhoneSelect.vue';
import { useFontSettings } from '@/Composables/useFontSize';
import Swal from 'sweetalert2';

const { fontScale, scaleOptions, fontWeight, weightOptions, isLoading, setFontScale, setFontWeight } = useFontSettings();

const props = defineProps({
    theme: {
        type: Array,
        required: false,
        default: () => [],
    },
});

const $helpers = inject('helpers');
const page = usePage();

// In your profile page script:
const imageForm = ref({
    avatar: page.props.auth.user.avatar || null,
    remove_avatar: false
});

// Update the watch to properly sync
watch(imageForm, (newVal) => {
    form.avatar = newVal.avatar || null;
    form.remove_avatar = newVal.remove_avatar || false;
}, { deep: true });

// Add proper form update handler
const updateImageForm = (newForm) => {
    imageForm.value = newForm;
};

// Fix the main form initialization
const form = useForm({
    avatar: page.props.auth.user.avatar || null,
    remove_avatar: false,
    name: page.props.auth.user.name || '',
    email: page.props.auth.user.email || '',
    phone: page.props.auth.user.phone || '',
    password: '',
    show_password: false,
    font_scale: null,
    font_weight: null,
    language_id: page.props.languages?.length > 0 ? (
        page.props.languages.find(d => d.id === page.props.auth.user.settings?.language_id) || page.props.languages.find(d => d.id === page.props.auth.user.settings?.language?.id) ||
        page.props.languages[0]
    ) : null,
    theme: props.theme?.length > 0 ? (
        props.theme.find(d => d.name === page.props.auth.user.settings?.theme) ||
        props.theme[0]
    ) : null,
});

console.log('Initial form:', form);

const user = computed(() => page.props.auth.user || {});
const userRoles = computed(() => (user.value.roles?.map(r => r.name).join(', ') || (user.value.role || '')));
const userAuthority = computed(() => {
    try {
        return (user.value && user.value.typeuser && user.value.typeuser.slug) ? user.value.typeuser.slug : '-';
    } catch (e) {
        return '-';
    }
});

watch(fontScale, (newFontScale) => {
    const newFontScaleObject = scaleOptions.value.find(scale => scale.value === newFontScale);
    if (newFontScaleObject) {
        form.font_scale = newFontScaleObject;
    }
}, { immediate: true });

watch(fontWeight, (newFontWeight) => {
    const newFontWeightObject = weightOptions.value.find(weight => weight.value === newFontWeight);
    if (newFontWeightObject) {
        form.font_weight = newFontWeightObject;
    }
});

const updateSettings = () => {
    form.post(route('control.system.users.setting'), {
        onSuccess: (response) => {
            $helpers.toast(trans('common.record') + ' ' + trans('common.updated'));

            if (form.language_id?.name) {
                localStorage.setItem('language', form.language_id.name);
            }
            if (form.theme?.name) {
                localStorage.setItem('theme', form.theme.name);
            }
            if (form.font_scale?.value) {
                localStorage.setItem('fontScale', form.font_scale.value);
                setFontScale(form.font_scale.value);
            }
            if (form.font_weight?.value) {
                localStorage.setItem('fontWeight', form.font_weight.value);
                setFontWeight(form.font_weight.value);
            }

            if (form.direction) {
                localStorage.setItem('direction', form.direction);
            }

            window.location.reload();
        },
        onError: (errors) => {
            console.error('Failed to update settings:', errors);
        }
    });

};
</script>
