<template>
    <div class="panel">
        <div class="mb-5 flex items-center justify-between">
            <h5 class="text-lg font-semibold dark:text-white-light">{{ $t('system.policy_section') }}</h5>
            <label class="relative h-6 w-12">
                <input v-model="form.is_active" type="checkbox"
                    class="custom_switch absolute w-full h-full opacity-0 z-10 cursor-pointer peer" />
                <span
                    class="bg-[#ebedf2] dark:bg-dark block h-full rounded-full before:absolute before:left-1 before:bg-white dark:before:bg-white-dark dark:peer-checked:before:bg-white before:bottom-1 before:w-4 before:h-4 before:rounded-full peer-checked:before:left-7 peer-checked:bg-primary before:transition-all before:duration-300"></span>
            </label>
        </div>
        <form class="space-y-5">
            <!-- Description -->
            <div>
                <label for="policy_description">{{ $t('system.description') }} ({{
                    $t(`system.${selectLanguage.slug}`) }})</label>
                <textarea v-model="form.description[selectLanguage.slug]" id="policy_description" rows="4"
                    class="form-textarea" :placeholder="$t('system.description')"></textarea>
                <div class="mt-1 text-sm text-danger" v-if="form.errors['description.' + selectLanguage.slug]"
                    v-html="form.errors['description.' + selectLanguage.slug]">
                </div>
            </div>

            <!-- Admission Process Steps (Left Column - 4 Cards) -->
            <div class="block">
                <label class="mb-3 block">{{ $t('system.admission_process_steps') }} ({{ $t(`system.${selectLanguage.slug}`) }})</label>
                <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-3">
                    <div v-for="(step, index) in admissionSteps" :key="index"
                        class="border border-[#e0e6ed] dark:border-[#1b2e4b] rounded p-4">
                        <div class="mb-3">
                            <span class="text-sm font-semibold">{{ step.label }} - {{ step.level }}</span>
                        </div>

                        <input v-model="form.steps[selectLanguage.slug][index].title" :id="'step_title_' + index" type="text" class="form-input"
                            :placeholder="step.titlePlaceholder" />
                        <div class="mt-1 text-sm text-danger"
                            v-if="form.errors['steps.' + selectLanguage.slug + '.' + index + '.title']"
                            v-html="form.errors['steps.' + selectLanguage.slug + '.' + index + '.title']">
                        </div>
                    </div>
                </div>
                <!-- General validation error for steps -->
                <div class="mt-2 text-sm text-danger" v-if="form.errors['steps.en.0.title']">
                    {{ form.errors['steps.en.0.title'] }}
                </div>
                <div class="mt-2 text-sm text-danger" v-if="form.errors['steps']">
                    {{ form.errors['steps'] }}
                </div>
            </div>

            <!-- Application Methods (Right Column - 3 Cards) -->
            <div>
                <label class="mb-3 block">{{ $t('system.application_methods') }} ({{ $t(`system.${selectLanguage.slug}`) }})</label>
                <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-3">
                    <div v-for="(method, index) in applicationMethods" :key="index"
                        class="border border-[#e0e6ed] dark:border-[#1b2e4b] rounded p-4">
                        <div class="mb-3 flex items-center justify-between">
                            <span class="text-sm font-semibold">{{ method.label }} - {{ method.level }}</span>
                            <span class="text-xs text-gray-500">{{ method.icon }}</span>
                        </div>

                        <input v-model="form.steps[selectLanguage.slug][4 + index].title" :id="'method_title_' + index" type="text" class="form-input"
                            :placeholder="method.titlePlaceholder" />
                        <div class="mt-1 text-sm text-danger"
                            v-if="form.errors['steps.' + selectLanguage.slug + '.' + (4 + index) + '.title']"
                            v-html="form.errors['steps.' + selectLanguage.slug + '.' + (4 + index) + '.title']">
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>

<script setup>
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

// Fixed 4 Admission Process Steps
const admissionSteps = [
    { label: 'Step 1', level: 'First', titlePlaceholder: 'e.g., Entrance assessment & interview' },
    { label: 'Step 2', level: 'Second', titlePlaceholder: 'e.g., Review of academic records and conduct' },
    { label: 'Step 3', level: 'Third', titlePlaceholder: 'e.g., Preference for early applicants and siblings' },
    { label: 'Step 4', level: 'Fourth', titlePlaceholder: 'e.g., Final approval by the admissions committee' }
];

// Fixed 3 Application Methods
const applicationMethods = [
    { label: 'Method 1', level: 'Read', icon: '📄 File', titlePlaceholder: 'e.g., School reception' },
    { label: 'Method 2', level: 'Download', icon: '⬇️ Download', titlePlaceholder: 'e.g., Download from our official website' },
    { label: 'Method 3', level: 'Message', icon: '✉️ Mail', titlePlaceholder: 'e.g., Email request: kurdgeniusschool@gmail.com' }
];
</script>
