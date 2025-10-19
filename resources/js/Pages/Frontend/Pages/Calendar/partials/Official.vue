<template>
  <section class="bg-[#F4F7FF] mb-16 lg:mb-16">
    <div class="w-full sm:container 3xl:max-w-[70%] mx-auto px-4">
      <div class="relative flex flex-col items-start gap-y-5 gap-x-8 xl:gap-x-10 py-16 md:py-24">
        <!-- Left Content -->
        <div class="relative z-[5] flex-1 space-y-1.5 max-w-xl xl:max-w-2xl text-justify">
          <h2 class="relative z-10 text-2xl lg:text-3xl xl:text-[32px] font-semibold text-black !leading-tight">
            {{ $t('frontend.calendar.official_title') }}
          </h2>
          <p class="relative z-10 !leading-6 text-base lg:text-base xl:text-xl font-normal text-pretty">
            {{ $t('frontend.calendar.official_description') }}
          </p>
          <img :src="'/img/shape_star.svg'" alt="ShapeOne" class="absolute -top-8 -start-10 3xl:-start-20 opacity-40 3xl:opacity-100 rtl:scale-x-[-1]" />
        </div>

        <!-- List -->
        <div class="relative z-[5]">
          <ul class="list-disc list-inside -space-y-1 ms-6">
            <li class="text-base lg:text-xl">New Year's Day</li>
            <li class="text-base lg:text-xl">Nowruz (Kurdish New Year)</li>
            <li class="text-base lg:text-xl">Eid al-Fitr and Eid al-Adha</li>
            <li class="text-base lg:text-xl">Independence & National Days</li>
            <li class="text-base lg:text-xl">Teacher's Day</li>
          </ul>
        </div>

        <div class="absolute end-20 bottom-20 md:bottom-36 overflow-hidden opacity-20 md:opacity-100">
          <div class="size-6 bg-[#019BFF] rounded-full rtl:scale-x-[-1]"></div>
        </div>
        <div class="absolute end-10 bottom-24 md:bottom-40 overflow-hidden opacity-20 md:opacity-100">
          <img :src="'/img/shape_one.png'" alt="ShapeOne" class="rtl:scale-x-[-1]" />
        </div>
        <div class="absolute end-0 bottom-14 md:bottom-28 overflow-hidden opacity-20 md:opacity-100">
          <img :src="'/img/shape_two.png'" alt="ShapeOne" class="rtl:scale-x-[-1]" />
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
</script>

