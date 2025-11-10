<template>

    <Head>
        <title>{{ $t(`frontend.nav.${page.props.route.name == 'campus' ? 'campus' : 'classrooms'}`) }}</title>
    </Head>

    <section
        class="w-full sm:container 3xl:max-w-[85%] mx-auto px-4 mb-[120px] mt-[96px] md:mt-[116px] lg:mt-[128px] xl:mt-[168px] min-h-[100dvh]">
        <div class="w-full flex flex-col items-center gap-y-6">
            <div class="flex-1 space-y-1 text-center">
                <p class="!leading-4 text-base lg:text-lg xl:text-xl font-normal">
                    {{ detail.formatted_date || detail.date }}
                </p>
                <h2
                    class="text-2xl lg:text-3xl xl:text-[32px] font-semibold text-black !leading-tight max-w-md lg:max-w-xl xl:max-w-3xl">
                    {{ helpers.getTranslatedText(detail.title, page) }}
                </h2>
            </div>
            <div class="flex flex-col items-center gap-8 w-full lg:w-2/3">
                <img :src="detail.image" alt="detail"
                    class="w-full h-[240px] md:h-[320px] lg:h-[400px] xl:h-[480px] 2xl:h-[640px] object-cover" />
                <div class="!leading-6 text-sm lg:text-base xl:text-xl font-normal text-pretty max-w-xl xl:max-w-3xl"
                    v-html="helpers.getTranslatedText(detail.description, page.props.locale)">
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
import PublicLayout from '@/Pages/Frontend/Layouts/Public.vue';
import { Head, usePage } from '@inertiajs/vue3';
import helpers from '@/helpers';

const props = defineProps({
    detail: {
        type: Object,
        required: true,
    },
});

const page = usePage();

console.log(page.props.route.name);

defineOptions({
    layout: PublicLayout,
});
</script>
