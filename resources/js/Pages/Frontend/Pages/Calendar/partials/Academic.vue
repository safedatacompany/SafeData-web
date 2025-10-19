<template>
  <section class="w-full sm:container 3xl:max-w-[70%] mx-auto px-4 mt-16 xl:mt-32 mb-5">
    <div
      class="relative flex flex-col items-start gap-y-20 gap-x-8 xl:gap-x-10 py-16 pb-[200px] lg:pb-[280px] xl:pb-[360px] 2xl:pb-[400px]">
      <!-- Top Content -->
      <div class="relative z-[5] flex-1 space-y-1.5 max-w-xl xl:max-w-2xl text-justify">
        <h2 class="text-2xl lg:text-3xl xl:text-[32px] font-semibold text-black !leading-tight">
          {{ $t('frontend.calendar.academic_title') }}
        </h2>
        <p class="!leading-6 text-base lg:text-base xl:text-xl font-normal text-pretty">
          {{ $t('frontend.calendar.academic_description') }}
        </p>
      </div>

      <!-- Bottom Content -->
      <div class="relative z-[5] grid grid-cols-2 xl:grid-cols-4 gap-4 sm:gap-6 lg:gap-4 sm:w-11/12 mx-auto">
        <div
          class="bg-gray-50 ring-2 ring-[#0028DF] border-2 border-[#0028DF]/0 hover:border-[#0028DF] duration-500 rounded-3xl text-center p-1 lg:p-3 h-36 flex items-center justify-center w-full">
          <span class="text-sm sm:text-base lg:text-xl font-medium">
            Core subject instruction
          </span>
        </div>
        <div
          class="bg-gray-50 ring-2 ring-[#FED176] border-2 border-[#FED176]/0 hover:border-[#FED176] duration-500 rounded-3xl text-center p-1 lg:p-3 h-36 flex items-center justify-center w-full">
          <span class="text-sm sm:text-base lg:text-xl font-medium">
            Weekly enrichment programs (STEM, arts, languages)
          </span>
        </div>
        <div
          class="bg-gray-50 ring-2 ring-[#3DA8A5] border-2 border-[#3DA8A5]/0 hover:border-[#3DA8A5] duration-500 rounded-3xl text-center p-1 lg:p-3 h-36 flex items-center justify-center w-full">
          <span class="text-sm sm:text-base lg:text-xl font-medium">
            Monthly themes (Science Day, Reading Month, etc.)
          </span>
        </div>
        <div
          class="bg-gray-50 ring-2 ring-[#FF966D] border-2 border-[#FF966D]/0 hover:border-[#FF966D] duration-500 rounded-3xl text-center p-1 lg:p-3 h-36 flex items-center justify-center w-full">
          <span class="text-sm sm:text-base lg:text-xl font-medium">
            Project-based learning and exhibitions
          </span>
        </div>
      </div>

      <div class="absolute end-0 xl:end-5 3xl:-end-[88px] top-20 overflow-hidden ltr:scale-x-[-1]">
        <div class="size-[192px] xl:size-[264px] bg-[#FFDB57] rounded-full translate-x-1/2"></div>
      </div>
      <div class="absolute -end-24 xl:-end-28 3xl:-end-[220px] top-20 overflow-hidden ltr:scale-x-[-1]">
        <div class="size-[192px] xl:size-[264px] bg-[#FBAF49] rounded-full translate-x-1/2"></div>
      </div>
      <div class="absolute lg:start-3 3xl:-start-[88px] bottom-20 overflow-hidden">
        <div class="size-[152px] xl:size-[196px] bg-[#019BFF] rounded-full"></div>
      </div>
    </div>
  </section>
</template>

<script setup>
</script>
