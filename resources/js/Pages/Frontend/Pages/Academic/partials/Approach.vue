<template>
  <section class="mt-25 xl:mt-45">
    <div class="w-full sm:container 3xl:max-w-[73%] mx-auto px-4">
      <div class="relative flex flex-col gap-3 md:gap-6 py-16 lg:py-25">
        <!-- Top Content -->
        <div class="relative z-5 flex-1 space-y-1.5 max-w-2xl">
          <h2 class="text-2xl lg:text-3xl xl:text-[32px] font-semibold text-black leading-tight">
            {{ $t('academic.approach_title') }}
          </h2>
          <p class="leading-6 text-base lg:text-base xl:text-xl font-normal text-pretty">
            {{ $t('academic.approach_description') }}
          </p>
          <p class="leading-10 text-base lg:text-base xl:text-xl font-medium text-pretty text-primary">
            {{ $t('academic.approach_highlight') }}
          </p>
          <img :src="'/img/academic/paintbrush.svg'" alt="mission"
            class="absolute -top-11.5 xl:-top-20 start-4 xl:start-6 size-10 xl:size-auto rtl:scale-x-[-1]" />
          <img :src="'/img/academic/ruler.svg'" alt="mission"
            class="absolute -top-19 xl:-top-36 -start-5 xl:-start-12 size-14 xl:size-auto rtl:scale-x-[-1]" />
          <img :src="'/img/academic/pencil.svg'" alt="mission"
            class="absolute -top-5 xl:-top-10 -start-8 xl:-start-15 size-7 xl:size-auto rtl:scale-x-[-1]" />
        </div>
        <!-- Bottom Content -->
        <div
          class="relative z-10 w-full flex flex-col gap-4 bg-[#FFA610] rounded-3xl md:rounded-[50px] px-4 md:px-7 lg:px-8 py-4 md:py-5">
          <div v-for="approach in approaches" :key="approach.id"
            class="relative z-10 group w-full xl:w-7/10 2xl:w-5/8 flex items-center gap-2 rounded-full bg-white px-3 md:px-4 py-2 md:py-4 2xl:py-5 lg:min-w-70">
            <img :src="'/img/academic/circle.svg'" alt="mission"
              class="size-4 md:size-4.5 2xl:size-5.5 duration-500 rotate-0 group-hover:-rotate-150" />
            <h2 class="relative z-5 text-xs md:text-base 2xl:text-xl leading-4">
              {{ $t(`academic.approach.item${approach.id}`) }}
            </h2>
          </div>
          <!-- Image -->
          <div class="absolute bottom-0 -end-43 2xl:-end-55 z-0 hidden xl:block">
            <div class="h-full lg:h-140 2xl:h-175 overflow-hidden">
              <img :src="'/img/academic/person.png'" alt="mission"
                class="size-170 2xl:size-220 object-contain object-top ltr:scale-x-[-1]" />
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
import { trans } from 'laravel-vue-i18n';
import { ref } from 'vue';

const approaches = ref([
  {
    id: 1,
  },
  {
    id: 2,
  },
  {
    id: 3,
  },
  {
    id: 4,
  },
  {
    id: 5,
  },
]);
</script>
