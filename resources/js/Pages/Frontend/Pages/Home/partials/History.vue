<template>
  <section class="mt-16 mb-16 lg:mt-32 lg:mb-16 bg-[#F4F7FF]">
    <div class="w-full sm:container 3xl:max-w-[75%] mx-auto px-4">
      <!-- Header Line -->
      <div class="w-36 h-1 bg-black rounded-full mx-auto"></div>
      <div class="flex flex-col lg:flex-row gap-5 xl:gap-10 pt-16 pb-16 lg:pt-32 lg:pb-20">
        <!-- Left Content -->
        <div class="flex-1 space-y-1.5">
          <h2 class="text-2xl lg:text-3xl xl:text-[32px] font-semibold text-black leading-tight">
            {{ $t('frontend.history.title') }}
          </h2>
          <p class="!leading-6 text-base lg:text-lg xl:text-xl font-normal text-pretty">
            Kurd Genius School was established in 2013 by Maya Company, a proud member of the Qaiwan Group of Companies,
            and is led by Mrs. Sozan Abubakr Mawlud.
          </p>
          <div class="!mt-4">
            <a href="#" class="font-normal">
              <span>{{ $t('frontend.common.see_more') }}</span>
              <div class="w-10 h-0.5 bg-yellow-400 rounded-full"></div>
            </a>
          </div>
        </div>

        <!-- Right Content - Images -->
        <div class="flex-1 flex items-end gap-4 sm:gap-8">
          <div class="rounded-3xl overflow-hidden">
            <img :src="'/img/home/history/2.jpg'" alt="Graduation"
              class="w-full h-[190px] sm:h-[270px] 2xl:h-[390px] object-cover" />
          </div>
          <div class="rounded-2xl overflow-hidden">
            <img :src="'/img/home/history/1.jpg'" alt="Graduation"
              class="w-full h-[376px] sm:h-[456px] 2xl:h-[576px] object-cover" />
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
</script>
