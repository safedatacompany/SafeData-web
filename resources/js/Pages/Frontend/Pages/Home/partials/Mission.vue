<template>
  <section class="mt-16 mb-16 lg:mt-32 lg:mb-16 bg-[#F4F7FF]">
    <div class="w-full sm:container 3xl:max-w-[75%] mx-auto px-4">
      <!-- Header Line -->
      <div class="w-36 h-1 bg-black rounded-full mx-auto"></div>
      <div class="relative flex flex-col lg:flex-row items-center justify-between gap-5 xl:gap-10 py-16 lg:py-32">
        <!-- Left Content -->
        <div class="relative z-5 flex-1 space-y-1.5 max-w-xl xl:max-w-2xl">
          <h2 class="text-2xl lg:text-3xl xl:text-[32px] font-semibold text-black leading-tight">
            {{ $t('frontend.mission.title') }}
          </h2>
          <p class="!leading-6 text-base lg:text-lg xl:text-xl font-normal text-pretty">
            At Kurd Genius School, our mission is to create a safe, inclusive, and inspiring learning environment where
            every student is empowered to reach their full potential.
          </p>
          <p class="!leading-6 text-base lg:text-lg xl:text-xl font-normal text-pretty !mt-4">
            We strive to develop lifelong learners who are academically prepared, socially responsible, and globally
            minded. Through high quality education, modern teaching methods, and strong moral values, we prepare our
            students to become leaders, critical thinkers, and compassionate citizens.
          </p>
        </div>

        <!-- Right Content - Images -->
        <div class="absolute end-0 top-1/2 z-1 -translate-y-1/2">
          <img :src="'/img/home/mission.svg'" alt="mission"
            class="w-full h-40 object-cover opacity-20 lg:opacity-100" />
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
</script>
