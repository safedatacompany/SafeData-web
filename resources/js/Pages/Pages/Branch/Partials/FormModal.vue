<template>
    <TransitionRoot appear :show="showModal" as="template">
        <Dialog as="div" @close="onClose" class="relative z-50">
            <TransitionChild as="template" enter="duration-300 ease-out" enter-from="opacity-0" enter-to="opacity-100"
                leave="duration-200 ease-in" leave-from="opacity-100" leave-to="opacity-0">
                <DialogOverlay class="fixed inset-0 bg-[black]/60" />
            </TransitionChild>

            <div class="fixed inset-0 overflow-y-auto">
                <div class="flex min-h-full items-start justify-center px-4 py-8">
                    <TransitionChild as="template" enter="duration-300 ease-out" enter-from="opacity-0 scale-95"
                        enter-to="opacity-100 scale-100" leave="duration-200 ease-in" leave-from="opacity-100 scale-100"
                        leave-to="opacity-0 scale-95">
                        <DialogPanel
                            class="panel border-0 p-0 overflow-hidden rounded-lg w-full max-w-3xl text-black dark:text-white-dark">
                            <button type="button"
                                class="absolute top-4 ltr:right-4 rtl:left-4 text-gray-400 hover:text-gray-800 dark:hover:text-gray-600 outline-none"
                                @click="onClose">
                                <Svg name="close" class="size-6"></Svg>
                            </button>
                            <div
                                class="b-text-lg font-bold bg-[#fbfbfb] dark:bg-[#121c2c] ltr:pl-5 rtl:pr-5 py-3 ltr:pr-[50px] rtl:pl-[50px]">
                                <span v-if="form.id">
                                    {{ $t('common.edit') }}
                                </span>
                                <span v-else>
                                    {{ $t('common.new') }}
                                </span>
                                {{ $t('pages.branch') }}
                            </div>
                            <div class="p-5">
                                <form @submit.prevent="onSubmit" v-shortkey="['ctrl', 's']" @shortkey="onSubmit"
                                    class="space-y-5">
                                    <!-- Language Tabs for Translations -->
                                    <div class="border-b border-gray-200 dark:border-gray-700">
                                        <ul class="flex flex-wrap -mb-px text-sm font-medium text-center">
                                            <li v-for="lang in Languages" :key="lang.slug" class="mr-2">
                                                <button type="button" @click="language = lang.slug" :class="{
                                                    'border-primary text-primary': language === lang.slug,
                                                    'border-transparent': language !== lang.slug
                                                }"
                                                    class="inline-block p-2 -mt-2 text-sm font-medium border-b-2 rounded-t-lg hover:text-primary hover:border-primary">
                                                    {{ $t(`system.${lang.slug}`) }}
                                                </button>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                        <!-- Name (Multilingual) -->
                                        <div class="col-span-full">
                                            <label :for="'name_' + language">
                                                {{ $t('pages.name') }} ({{ $t(`system.${language}`) }}) <span
                                                    class="text-danger">*</span>
                                            </label>
                                            <input :id="'name_' + language" type="text" v-model="form.name[language]"
                                                :placeholder="$t('pages.name')" class="form-input"
                                                :class="{ 'border border-red-300 rounded-md': form.errors['name.' + language] }" />
                                            <div class="mt-1 text-sm text-danger" v-if="form.errors['name.' + language]"
                                                v-html="form.errors['name.' + language]">
                                            </div>
                                        </div>

                                        <!-- Slug is generated automatically from the name (server-side). -->
                                        <!-- Removed manual slug input to prevent user errors. -->

                                        <!-- Description (Multilingual) -->
                                        <div class="col-span-full">
                                            <label :for="'description_' + language">
                                                {{ $t('pages.description') }} ({{ $t(`system.${language}`) }})
                                            </label>
                                            <textarea :id="'description_' + language" rows="4"
                                                v-model="form.description[language]"
                                                :placeholder="$t('pages.description')" class="form-input"
                                                :class="{ 'border border-red-300 rounded-md': form.errors['description.' + language] }"></textarea>
                                            <div class="mt-1 text-sm text-danger"
                                                v-if="form.errors['description.' + language]"
                                                v-html="form.errors['description.' + language]">
                                            </div>
                                        </div>

                                        <!-- Logo Upload -->
                                        <div>
                                            <label for="logo">
                                                {{ $t('pages.logo') }} <span v-if="!form.id"
                                                    class="text-danger">*</span>
                                            </label>
                                            <ImageUpload v-model="form.logo" field-name="branch_logo"
                                                @update:form="(data) => { if (data.remove_branch_logo !== undefined) form.remove_logo = data.remove_branch_logo; }" />
                                            <p class="text-xs text-gray-500 mt-1">
                                                Supported formats: JPEG, PNG, JPG, GIF, WEBP (Max: 2MB)
                                            </p>
                                            <div class="mt-1 text-sm text-danger" v-if="form.errors.logo"
                                                v-html="form.errors.logo">
                                            </div>
                                        </div>

                                        <!-- Color Picker -->
                                        <div>
                                            <label for="color">
                                                {{ $t('pages.color') }}
                                            </label>
                                            <div class="flex items-center gap-2">
                                                <input type="color" id="color" v-model="form.color"
                                                    class="size-10 rounded border border-gray-300" />
                                                <input type="text" v-model="form.color"
                                                    :placeholder="$t('pages.color_hex')" class="form-input flex-1"
                                                    :class="{ 'border border-red-300 rounded-md': form.errors.color }" />
                                            </div>
                                            <p class="text-xs text-gray-500 mt-1">
                                                {{ $t('pages.color_format') }} (e.g., #FF5733)
                                            </p>
                                            <div class="mt-1 text-sm text-danger" v-if="form.errors.color"
                                                v-html="form.errors.color">
                                            </div>
                                        </div>

                                        <!-- Status Toggle -->
                                        <div class="col-span-full flex items-center gap-2">
                                            <label class="inline-flex cursor-pointer">
                                                <input type="checkbox" v-model="form.is_active" class="form-checkbox" />
                                                <span class="ltr:ml-2 rtl:mr-2">{{ $t('common.active') }}</span>
                                            </label>
                                        </div>

                                    </div>

                                    <!-- Submit Buttons -->
                                    <div class="flex justify-end items-center mt-5">
                                        <button @click="onClose" type="button" class="btn btn-outline-danger">
                                            {{ $t('common.discard') }}
                                        </button>
                                        <button :disabled="form.processing" type="submit"
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
</template>

<script setup>
import { ref, watch, computed, inject } from 'vue';
import { usePage } from '@inertiajs/vue3';
import { TransitionRoot, TransitionChild, Dialog, DialogPanel, DialogOverlay } from '@headlessui/vue';
import Svg from '@/Components/Svg.vue';
import ImageUpload from '@/Components/Inputs/ImageUpload.vue';

const props = defineProps({
    showModal: Boolean,
    form: Object,
});

const emit = defineEmits(['close', 'submit']);

const Languages = usePage().props.languages;
const language = ref('en');

// Submit form
const onSubmit = () => {
    emit('submit');
};

// Close modal
const onClose = () => {
    emit('close');
};

</script>
