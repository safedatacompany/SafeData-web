<template>
  <section class="w-full sm:container 3xl:max-w-[70%] mx-auto px-4">
    <div class="flex flex-col gap-10 xl:gap-16 py-12 lg:py-20">
      <div class="text-5xl md:text-6xl lg:text-7xl xl:text-8xl">
        <span>{{ $t('frontend.know_more.title') }}</span>
        <div class="w-[88px] h-1 bg-yellow-400 rounded-full ltr:mt-1.5 rtl:mt-6"></div>
        <div class="flex items-center gap-2 mt-6">
          <a href="#">
            <Svg name="logos_youtube" class="h-[30px]"></Svg>
          </a>
          <a href="#">
            <Svg name="facebook_fill" class="h-10 text-[#1877F2]"></Svg>
          </a>
          <a href="#">
            <Svg name="instagram" class="h-8"></Svg>
          </a>
          <a href="#">
            <Svg name="twitter" class="h-8 ms-1"></Svg>
          </a>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
</script>

