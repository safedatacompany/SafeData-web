<template>
    <section
        class="w-full sm:container 3xl:max-w-[85%] mx-auto px-4 mb-[120px] mt-[96px] md:mt-[116px] lg:mt-[128px] xl:mt-[168px] min-h-[100dvh]">
        <div class="w-full flex flex-col items-center gap-y-6">
            <div class="flex-1 space-y-1 text-center">
                <p
                    class="!leading-4 text-base lg:text-lg xl:text-xl font-normal text-pretty max-w-md lg:max-w-xl xl:max-w-3xl">
                    {{ detail.date }}
                </p>
                <h2 class="text-2xl lg:text-3xl xl:text-[32px] font-semibold text-black !leading-tight">
                    {{ detail.title }}
                </h2>
                <p
                    class="!leading-6 text-xs lg:text-sm xl:text-base font-normal text-pretty max-w-md lg:max-w-xl xl:max-w-3xl">
                    {{ detail.hashtag }}
                </p>
            </div>
            <div class="flex flex-col items-center gap-8 w-full lg:w-2/3">
                <img :src="detail.image" alt="detail"
                    class="w-full h-[240px] md:h-[320px] lg:h-[400px] xl:h-[480px] 2xl:h-[640px] object-cover" />
                <p class="!leading-6 text-sm lg:text-base xl:text-xl font-normal text-pretty max-w-xl xl:max-w-3xl">
                    {{ detail.description }}
                </p>
            </div>
        </div>
    </section>
</template>

<script setup>
import { ref } from 'vue';
import PublicLayout from '@/Pages/Frontend/Layouts/Public.vue';

defineProps({
    detail: {
        type: Object,
        required: true,
    },
});



defineOptions({
    layout: PublicLayout
});
</script>
