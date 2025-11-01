<template>
    <div class="panel">
        <div class="mb-5 flex items-center justify-between">
            <h5 class="text-lg font-semibold dark:text-white-light">{{ $t('system.documents_section') }}</h5>
            <label class="relative h-6 w-12">
                <input v-model="form.is_active" type="checkbox"
                    class="custom_switch absolute w-full h-full opacity-0 z-10 cursor-pointer peer" />
                <span
                    class="bg-[#ebedf2] dark:bg-dark block h-full rounded-full before:absolute before:left-1 before:bg-white dark:before:bg-white-dark dark:peer-checked:before:bg-white before:bottom-1 before:w-4 before:h-4 before:rounded-full peer-checked:before:left-7 peer-checked:bg-primary before:transition-all before:duration-300"></span>
            </label>
        </div>
        <form class="space-y-5">
            <div>
                <label class="mb-3 block">{{ $t('system.required_documents') }} ({{ $t(`system.${selectLanguage.slug}`) }})</label>
                <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-3">
                    <div v-for="(doc, index) in fixedDocuments" :key="index"
                        class="border border-[#e0e6ed] dark:border-[#1b2e4b] rounded p-4">
                        <div class="mb-3 flex items-center justify-between">
                            <span class="text-sm font-semibold">{{ doc.label }}</span>
                        </div>

                        <div class="flex flex-col gap-4">
                            <!-- Title Input -->
                            <div class="w-full">
                                <input v-model="form.documents[selectLanguage.slug][index].title" 
                                    :id="'doc_title_' + index" 
                                    type="text" 
                                    class="form-input"
                                    :placeholder="doc.titlePlaceholder" />
                                <div class="mt-1 text-sm text-danger"
                                    v-if="form.errors['documents.' + selectLanguage.slug + '.' + index + '.title']"
                                    v-html="form.errors['documents.' + selectLanguage.slug + '.' + index + '.title']">
                                </div>
                            </div>

                            <!-- Icon Upload (shared across all languages) -->
                            <div>
                                <ImageUpload
                                    v-model="sharedIcons[index]"
                                    :fieldName="'doc_icon_' + index"
                                    customClass="!size-20"
                                    @update:form="handleIconUpdate($event, index)"
                                />
                                <div class="mt-1 text-sm text-danger"
                                    v-if="form.errors['icon_' + index]"
                                    v-html="form.errors['icon_' + index]">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>

<script setup>
import { ref, watch, computed } from 'vue';
import ImageUpload from '@/Components/Inputs/ImageUpload.vue';

const props = defineProps({
    form: {
        type: Object,
        required: true
    },
    selectLanguage: {
        type: Object,
        required: true
    }
});

// Fixed 4 document types
const fixedDocuments = [
    { label: 'Document 1', iconName: 'passport.svg', titlePlaceholder: 'e.g., Copy of passport or national ID' },
    { label: 'Document 2', iconName: 'editing.svg', titlePlaceholder: 'e.g., 6 recent passport-sized photos' },
    { label: 'Document 3', iconName: 'report.svg', titlePlaceholder: 'e.g., Academic transcripts or report cards' },
    { label: 'Document 4', iconName: 'medicine.svg', titlePlaceholder: 'e.g., Medical & vaccination records' }
];

// Shared icons across all languages (same icon for each document regardless of language)
const sharedIcons = ref([]);

// Initialize shared icons from the first available language
watch(() => props.form.documents, (newDocs) => {
    if (newDocs && newDocs.en && newDocs.en.length > 0) {
        sharedIcons.value = newDocs.en.map(doc => doc.icon || '');
    }
}, { immediate: true, deep: true });

const handleIconUpdate = (formData, index) => {
    const fieldName = 'doc_icon_' + index;
    
    if (formData[fieldName]) {
        // Store icon file in a shared location
        if (!props.form.iconFiles) {
            props.form.iconFiles = {};
        }
        props.form.iconFiles[index] = formData[fieldName];
        
        // Update shared icon reference
        sharedIcons.value[index] = URL.createObjectURL(formData[fieldName]);
        
        // Update all languages with the same icon
        Object.keys(props.form.documents).forEach(lang => {
            if (props.form.documents[lang][index]) {
                props.form.documents[lang][index].icon_file = formData[fieldName];
            }
        });
    }
    if (formData['remove_' + fieldName]) {
        sharedIcons.value[index] = '';
        if (props.form.iconFiles) {
            props.form.iconFiles[index] = null;
        }
        
        // Remove from all languages
        Object.keys(props.form.documents).forEach(lang => {
            if (props.form.documents[lang][index]) {
                props.form.documents[lang][index].icon = '';
                props.form.documents[lang][index].icon_file = null;
            }
        });
    }
};
</script>
