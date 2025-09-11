<template>
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
                <div class="panel p-6">
                    <div class="text-center">
                        <!-- Profile Avatar -->
                        <div class="relative inline-block mb-3">
                            <ImageUpload v-model="imageForm.avatar" v-model:form="imageForm" field-name="avatar"
                                :custom-class="'!size-24 !rounded-full'" />
                        </div>

                        <!-- User Info -->
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-1">
                            {{ user.name }}
                        </h3>
                        <p class="text-gray-600 dark:text-gray-400 mb-4">
                            {{ user.email }}
                        </p>

                        <!-- Profile Stats -->
                        <div class="grid grid-cols-2 gap-4 text-center border-t pt-4 dark:border-gray-700">
                            <div>
                                <div class="text-lg font-semibold text-primary capitalize">
                                    {{ userRoles }}
                                </div>
                                <div class="text-xs text-gray-500">{{ $t('system.privilege') }}</div>
                            </div>
                            <div>
                                <div class="text-lg font-semibold text-success">
                                    {{ userAuthority }}
                                </div>
                                <div class="text-xs text-gray-500">{{ $t('system.authority') }}</div>
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
                            <h2 class="text-xl font-semibold text-gray-900 dark:text-white">
                                {{ $t('system.appearance_settings') }}
                            </h2>
                        </div>
                    </div>

                    <form @submit.prevent="updateSettings" class="space-y-6">
                        <!-- Typography Section -->
                        <div class="space-y-4">
                            <h3
                                class="text-lg font-medium text-gray-900 dark:text-white border-b pb-2 dark:border-gray-700">
                                {{ $t('system.typography') }}
                            </h3>
                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                                <div class="space-y-2">
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                        {{ $t('system.font_size') }}
                                    </label>
                                    <MultiSelect v-model="form.font_scale" :list="scaleOptions" label="name"
                                        value="value" :showValue="false" :error="form.errors.font_scale" />
                                </div>
                                <div class="space-y-2">
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
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
                                class="text-lg font-medium text-gray-900 dark:text-white border-b pb-2 dark:border-gray-700">
                                {{ $t('system.localization') }}
                            </h3>
                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                                <div class="space-y-2">
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                        {{ $t('system.language') }}
                                    </label>
                                    <MultiSelect v-model="form.language_id" :list="page.props.languages" label="slug"
                                        parent-key="system" :error="form.errors.language_id" />
                                </div>
                                <div class="space-y-2">
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                        {{ $t('system.direction') }}
                                    </label>
                                    <MultiSelect v-model="form.direction" :list="directionOptions" label="label"
                                        value="value" :showValue="false" :error="form.errors.direction" />
                                </div>
                            </div>
                        </div>

                        <!-- Theme Section -->
                        <div class="space-y-4">
                            <h3
                                class="text-lg font-medium text-gray-900 dark:text-white border-b pb-2 dark:border-gray-700">
                                {{ $t('system.visual_theme') }}
                            </h3>
                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    {{ $t('system.theme') }}
                                </label>
                                <MultiSelect v-model="form.theme" :list="props.theme" label="name" value="name"
                                    :showValue="false" :error="form.errors.theme" />
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex items-center justify-between pt-6 border-t dark:border-gray-700">
                            <div class="flex items-center space-x-3">
                                <button type="button" class="btn btn-sm btn-outline-secondary px-6 py-2"
                                    @click="resetForm">
                                    {{ $t('system.reset') }}
                                </button>
                                <button type="submit"
                                    class="btn btn-sm btn-primary px-6 py-2 flex items-center space-x-2"
                                    :disabled="isLoading">
                                    <Svg v-if="isLoading" name="main_spinner" class="animate-spin w-4 h-4"></Svg>
                                    <span>{{ isLoading ? $t('system.saving') : $t('system.save_changes') }}</span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
import { trans } from 'laravel-vue-i18n';
import { inject, ref, computed, watch, onMounted } from 'vue';
import { useForm, usePage } from '@inertiajs/vue3';
import MultiSelect from '@/Components/Inputs/MultiSelect.vue';
import ImageUpload from '@/Components/Inputs/ImageUpload.vue';
import Svg from '@/Components/Svg.vue';
import { useFontSettings } from '@/Composables/useFontSize';

// Props
const props = defineProps({
    theme: {
        type: Array,
        required: false,
        default: () => [],
    },
});

// Composables & Injects
const { fontScale, scaleOptions, fontWeight, weightOptions, isLoading, setFontScale, setFontWeight } = useFontSettings();
const $helpers = inject('helpers');
const page = usePage();

// Constants
const DIRECTION_OPTIONS = [
    { id: 1, value: 'ltr', label: 'LTR' },
    { id: 2, value: 'rtl', label: 'RTL' }
];

// Computed Properties
const user = computed(() => page.props.auth.user);
const userSettings = computed(() => user.value.user_setting || user.value.settings);
const userRoles = computed(() => user.value.roles?.map(r => r.name).join(', ') || 'User');
const userAuthority = computed(() => user.value.roles?.length > 0 ? 'Admin' : 'User');
const directionOptions = computed(() => DIRECTION_OPTIONS);

// Helper Functions
const findLanguage = (userSettings, languages) => {
    if (!languages.length) return null;
    return languages.find(d => d.id === userSettings?.language_id) ||
        languages.find(d => d.id === userSettings?.language?.id) ||
        languages[0];
};

const findDirection = (userSettings) => {
    const userDirection = userSettings?.direction ||
        userSettings?.language?.direction ||
        localStorage.getItem('rtlClass') || 'ltr';
    return DIRECTION_OPTIONS.find(d => d.value === userDirection) || DIRECTION_OPTIONS[0];
};

const findTheme = (userSettings, themes) => {
    if (!themes?.length) return null;
    const userTheme = userSettings?.theme || localStorage.getItem('theme');
    return themes.find(d => d.name === userTheme) || themes[0];
};

const getInitialValues = () => {
    const settings = userSettings.value;
    const languages = page.props.languages || [];

    return {
        font_scale: null,
        font_weight: null,
        language_id: findLanguage(settings, languages),
        direction: findDirection(settings),
        theme: findTheme(settings, props.theme),
    };
};

// Forms
const form = useForm(getInitialValues());
const imageForm = ref({
    avatar: user.value.avatar || null,
    remove_avatar: false
});

// Font Settings Sync
const syncFontSettings = () => {
    const scaleObj = scaleOptions.value.find(s => s.value === fontScale.value);
    const weightObj = weightOptions.value.find(w => w.value === String(fontWeight.value));

    if (scaleObj) form.font_scale = scaleObj;
    if (weightObj) form.font_weight = weightObj;
};

// Image Upload Handler
const updateProfileImage = () => {
    const updateForm = useForm({
        avatar: imageForm.value.avatar instanceof File ? imageForm.value.avatar : null,
        remove_avatar: imageForm.value.remove_avatar
    });

    updateForm.post(route('control.system.users.update-avatar'), {
        onSuccess: () => {
            $helpers.toast(trans('common.record') + ' ' + trans('common.updated'));

            if (imageForm.value.remove_avatar) {
                page.props.auth.user.avatar = null;
                imageForm.value = { avatar: null, remove_avatar: false };
            } else {
                imageForm.value = { avatar: user.value.avatar, remove_avatar: false };
            }
        },
    });
};

// Settings Handlers
const applySettings = () => {
    const settingsActions = [
        () => form.language_id?.name && localStorage.setItem('language', form.language_id.name),
        () => {
            if (form.direction?.value) {
                localStorage.setItem('rtlClass', form.direction.value);
                document.querySelector('html')?.setAttribute('dir', form.direction.value);
            }
        },
        () => {
            if (form.theme?.name) {
                localStorage.setItem('theme', form.theme.name);
                document.querySelector('body')?.classList.toggle('dark', form.theme.name === 'dark');
            }
        },
        () => {
            if (form.font_scale?.value) {
                localStorage.setItem('fontScale', form.font_scale.value);
                setFontScale(form.font_scale.value);
            }
        },
        () => {
            if (form.font_weight?.value) {
                localStorage.setItem('fontWeight', form.font_weight.value);
                setFontWeight(form.font_weight.value);
            }
        }
    ];

    settingsActions.forEach(action => action());
};

const updateSettings = () => {
    form.post(route('control.system.users.setting'), {
        onSuccess: () => {
            $helpers.toast(trans('common.record') + ' ' + trans('common.updated'));
            applySettings();
        },
    });
};

const resetForm = () => {
    const initialValues = getInitialValues();
    Object.assign(form, initialValues);
    syncFontSettings();
    $helpers.toast(trans('system.form_reset'));
};

// Watchers
watch([fontScale, fontWeight], syncFontSettings, { immediate: true });
watch(() => imageForm.value, (newValue, oldValue) => {
    if (newValue.avatar instanceof File) {
        updateProfileImage();
    } else if (newValue.remove_avatar === true && oldValue?.remove_avatar !== true) {
        updateProfileImage();
    }
}, { deep: true });

// Lifecycle
onMounted(() => {
    if (!form.font_scale || !form.font_weight) {
        syncFontSettings();
    }
});
</script>
