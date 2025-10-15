<template>
  <section class="w-full sm:container 3xl:max-w-[70%] mx-auto px-4 mt-10 md:mt-12 lg:mt-5 xl:mt-16">
    <div class="relative flex flex-col gap-6 md:gap-12 py-16 lg:py-24">
      <!-- Top Content -->
      <div class="relative z-5 flex-1 space-y-1.5 max-w-[720px]">
        <h2 class="text-2xl lg:text-3xl xl:text-[32px] font-semibold text-black !leading-tight">
          {{ $t('frontend.admission.policy') }}
        </h2>
        <p class="!leading-6 text-base lg:text-base xl:text-xl font-normal text-pretty">
          {{ $t('frontend.admission.policy_description') }}
        </p>
        <p class="!leading-10 text-base lg:text-base xl:text-xl font-medium text-pretty text-primary">
          {{ $t('frontend.admission.requirements') }}
        </p>
      </div>
      <!-- Bottom Content -->
      <div class="relative z-10 w-full flex flex-col md:flex-row items-center justify-between gap-10">
        <!-- First Cards -->
        <div class="flex flex-col gap-4">
          <div v-for="item in firstCol" :key="item.id"
            class="flex flex-col justify-between gap-5 lg:gap-7 rounded-[40px] bg-neutral-800 px-7 py-4 h-32 lg:h-[140px] md:w-60 lg:w-[332px]">
            <div class="bg-white text-black p-[3px] rounded-full max-w-max ms-auto">
              <Svg name="check" class="size-4"></Svg>
            </div>
            <div class="flex flex-col">
              <p class="text-xs lg:text-sm text-gray-400 !leading-4">
                {{ item.level }}
              </p>
              <h2 class="text-sm lg:text-base text-white">
                {{ item.title }}
              </h2>
            </div>
          </div>
        </div>
        <div class="relative w-full min-h-full flex items-center justify-center">
          <h1 class="min-h-full text-lg xl:text-xl font-medium text-nowrap">
            {{ $t('frontend.admission.available_via') }}
          </h1>
          <div class="absolute bottom-full start-0 z-0 hidden md:block">
            <Svg name="shape_admission"
              class="size-40 lg:size-52 xl:size-[248px] duration-500 text-gray-200 hover:text-yellow-400 rtl:scale-x-[-1]"></Svg>
          </div>
          <div class="absolute top-full start-0 mt-12 z-0 -rotate-[40deg] hidden md:block">
            <Svg name="shape_admission"
              class="size-40 lg:size-52 xl:size-[248px] duration-500 text-gray-200 hover:text-primary rtl:scale-x-[-1]"></Svg>
          </div>
        </div>
        <!-- Second Cards -->
        <div class="flex flex-col gap-4">
          <div v-for="item in secondCol" :key="item.id"
            class="flex flex-col justify-between gap-5 lg:gap-7 rounded-[40px] bg-neutral-800 px-7 py-4 h-32 lg:h-[140px] md:w-60 lg:w-[332px]">
            <div class="bg-white text-black !p-1 flex items-center justify-center rounded-full max-w-max ms-auto">
              <Svg :name="item.icon" class="size-4"></Svg>
            </div>
            <div class="flex flex-col">
              <p class="text-xs lg:text-sm text-gray-400 !leading-4">
                {{ item.level }}
              </p>
              <h2 class="text-sm lg:text-base text-white">
                {{ item.title }}
              </h2>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
import { ref } from 'vue';

const firstCol = ref([
  {
    id: 1,
    title: 'Entrance assessment & interview',
    level: 'First',
  },
  {
    id: 2,
    title: 'Review of academic records and conduct',
    level: 'Second',
  },
  {
    id: 3,
    title: 'Preference for early applicants and siblings',
    level: 'Third',
  },
  {
    id: 4,
    title: 'Final approval by the admissions committee',
    level: 'Fourth',
  },
]);

const secondCol = ref([
  {
    id: 1,
    title: 'School reception',
    level: 'Read',
    icon: 'file',
  },
  {
    id: 2,
    title: 'Download from our official website',
    level: 'Download',
    icon: 'download',
  },
  {
    id: 3,
    title: 'Email request: kurdgeniusschool@gmail.com',
    level: 'Message',
    icon: 'mail',
  },
]);
</script>
