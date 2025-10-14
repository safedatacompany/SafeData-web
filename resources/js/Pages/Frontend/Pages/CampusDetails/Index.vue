<template>
    <section class="w-full sm:container 3xl:max-w-[85%] mx-auto px-4 mb-[120px] mt-[96px] md:mt-[116px] lg:mt-[128px] xl:mt-[168px] min-h-[100dvh]">
        <div class="w-full flex flex-col items-center gap-y-6">
            <!-- Header -->
            <div class="flex-1 space-y-1 text-center">
                <p
                    class="leading-4 text-base lg:text-lg xl:text-xl font-normal text-pretty max-w-md lg:max-w-xl xl:max-w-3xl">
                    17/5/2025
                </p>
                <h2 class="text-2xl lg:text-3xl xl:text-[32px] font-semibold text-black leading-tight">
                    {{ $t('campusDetails.title') }}
                </h2>
                <p
                    class="leading-6 text-xs lg:text-sm xl:text-base font-normal text-pretty max-w-md lg:max-w-xl xl:max-w-3xl">
                    {{ $t('campusDetails.hashtag') }}
                </p>
            </div>
            <div class="flex flex-col items-center gap-8 w-full lg:w-2/3">
                <img :src="'/img/campus/1.jpg'" alt="news"
                    class="w-full h-60 md:h-80 lg:h-100 xl:h-120 2xl:h-160 object-cover" />
                <p class="leading-6 text-sm lg:text-base xl:text-xl font-normal text-pretty max-w-xl xl:max-w-3xl">
                    {{ $t('campusDetails.paragraph1') }}
                </p>
                <p class="leading-6 text-sm lg:text-base xl:text-xl font-normal text-pretty max-w-xl xl:max-w-3xl">
                    {{ $t('campusDetails.paragraph2') }}
                </p>
                <img :src="'/img/campus/2.jpg'" alt="news"
                    class="w-full h-60 md:h-80 lg:h-100 xl:h-120 2xl:h-160 object-cover" />
                <p class="leading-6 text-sm lg:text-base xl:text-xl font-normal text-pretty max-w-xl xl:max-w-2xl">
                    {{ $t('campusDetails.paragraph3') }}
                </p>
            </div>
        </div>
    </section>
</template>

<script setup>
import { trans } from 'laravel-vue-i18n';
import PublicLayout from '@/Pages/Frontend/Layouts/Public.vue';

defineOptions({
  layout: PublicLayout
});
</script>

