<template>
  <section class="relative mb-10 bg-[#F4F7FF] overflow-hidden">
    <div class="w-full sm:container 3xl:max-w-[75%] mx-auto px-4">
      <div class="relative flex items-center justify-center gap-5 xl:gap-10 py-16 lg:py-[110px]">
        <!-- Content -->
        <div class="relative z-[5] flex-1 flex flex-col items-center space-y-3.5 max-w-xl xl:max-w-2xl text-white">
          <h2 class="text-2xl lg:text-3xl xl:text-[32px] font-semibold !leading-tight">
            {{ $t('frontend.mission.title') }}
          </h2>
          <p class="!leading-6 text-base lg:text-lg xl:text-xl font-normal text-justify">
            At Kurd Genius School, our mission is to create a safe, inclusive, and inspiring learning environment where
            every student is empowered to reach their full potential. We strive to develop lifelong learners who are
            academically prepared, socially responsible, and globally minded. Through high quality education, modern
            teaching methods, and strong moral values, we prepare our students to become leaders, critical thinkers, and
            compassionate citizens.
          </p>
        </div>
      </div>
      <!-- Image -->
      <div class="absolute inset-0">
        <img :src="'/img/about/bg_mission.jpg'" alt="mission" class="w-full h-full object-cover object-[50%_96.5%]" />
      </div>
      <div class="absolute inset-0 bg-[#0B1441]/70"></div>
      <div class="absolute inset-0 bg-black/15"></div>
    </div>
  </section>
</template>

<script setup>
</script>
