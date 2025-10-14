<template>
  <section class="w-full sm:container 3xl:max-w-[85%] mx-auto px-4">
    <div class="flex flex-col gap-10 xl:gap-16 py-3 md:py-8 lg:py-16">
      <!-- Top Content -->
      <div class="flex-1 flex flex-col md:flex-row md:items-center justify-between gap-2">
        <div class="flex-1 space-y-1.5">
          <h2 class="text-2xl lg:text-3xl xl:text-[32px] font-semibold text-black leading-tight">
            {{ $t('frontend.news.title') }}
          </h2>
          <p
            class="!leading-6 text-base lg:text-lg xl:text-xl font-normal text-pretty max-w-md lg:max-w-xl xl:max-w-2xl">
            {{ $t('frontend.news.description') }}
          </p>
        </div>
        <div class="md:mx-4 mt-4">
          <a href="#" class="font-normal">
            <span>{{ $t('frontend.common.see_more') }}</span>
            <div class="w-10 h-0.5 bg-yellow-400 rounded-full"></div>
          </a>
        </div>
      </div>

      <!-- Right Content - Images -->
      <div class="flex-1 grid sm:grid-cols-3 gap-3 md:gap-6 lg:gap-8">
        <div v-for="item in newsItems" :key="item.id"
          class="relative h-[532px] sm:h-[332px] md:h-[412px] lg:h-[532px] xl:h-[652px] 2xl:h-[732px] overflow-hidden">
          <img :src="item.imageUrl" alt="news" class="w-full h-full object-cover" />
          <p
            class="absolute bottom-3 lg:bottom-6 xl:bottom-11 z-10 text-white p-4 text-base sm:text-xs lg:text-sm xl:text-base 2xl:text-lg lg:!leading-6 font-light">
            {{ item.description }}
          </p>
          <div class="absolute inset-x-0 bottom-0 h-[200px] bg-gradient-to-t from-gray-950/70 to-transparent"></div>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
import { ref } from 'vue';

const newsItems = ref([
  {
    id: 1,
    imageUrl: '/img/news/1.jpg',
    description: 'We believe every student is unique. That\'s why our low student-to-teacher ratio allows for personalized attention and tailored learning paths — ensuring academic success and emotional growth.',
  },
  {
    id: 2,
    imageUrl: '/img/news/2.jpg',
    description: 'We believe every student is unique. That\'s why our low student-to-teacher ratio allows for personalized attention and tailored learning paths — ensuring academic success and emotional growth.',
  },
  {
    id: 3,
    imageUrl: '/img/news/3.jpg',
    description: 'We believe every student is unique. That\'s why our low student-to-teacher ratio allows for personalized attention and tailored learning paths — ensuring academic success and emotional growth.',
  },
]);
</script>


