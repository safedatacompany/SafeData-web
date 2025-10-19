<template>
  <section class="w-full sm:container 3xl:max-w-[85%] mx-auto px-4 mb-20">
    <div class="relative flex flex-col items-start gap-y-8 gap-x-8 xl:gap-x-10 py-16">
      <!-- Top Content -->
      <div class="relative z-5 flex-1 space-y-1.5 max-w-xl xl:max-w-2xl text-justify">
        <h2 class="!leading-6 text-base lg:text-xl font-medium rtl:font-semibold">
          {{ $t('frontend.admission.documents_required') }}
        </h2>
      </div>
      <!-- Bottom Content -->
      <div class="relative z-5 grid grid-cols-2 xl:grid-cols-4 gap-4 sm:gap-6 lg:gap-8 w-full">
        <div
          class="bg-gray-50 border-4 border-gray-50 hover:border-pink-600 duration-500 rounded-[40px] text-center py-1 px-2 h-36 flex flex-col items-center justify-start gap-1.5 w-full">
          <img :src="'/img/admission/passport.svg'" alt="passport" class="size-16" />
          <span class="text-sm sm:text-base lg:text-xl font-medium">
            Copy of passport or national ID
          </span>
        </div>
        <div
          class="bg-gray-50 border-4 border-gray-50 hover:border-pink-600 duration-500 rounded-[40px] text-center py-1 px-2 h-36 flex flex-col items-center justify-start gap-1.5 w-full">
          <img :src="'/img/admission/editing.svg'" alt="editing" class="size-16" />
          <span class="text-sm sm:text-base lg:text-xl font-medium">
            6 recent passport-sized photos
          </span>
        </div>
        <div
          class="bg-gray-50 border-4 border-gray-50 hover:border-pink-600 duration-500 rounded-[40px] text-center py-1 px-2 h-36 flex flex-col items-center justify-start gap-1.5 w-full">
          <img :src="'/img/admission/report.svg'" alt="report" class="size-16" />
          <span class="text-sm sm:text-base lg:text-xl font-medium">
            Academic transcripts or report cards
          </span>
        </div>
        <div
          class="bg-gray-50 border-4 border-gray-50 hover:border-pink-600 duration-500 rounded-[40px] text-center py-1 px-2 h-36 flex flex-col items-center justify-start gap-1.5 w-full">
          <img :src="'/img/admission/medicine.svg'" alt="medicine" class="size-16" />
          <span class="text-sm sm:text-base lg:text-xl font-medium">
            Medical & vaccination records
          </span>
        </div>
      </div>
      <!-- Fee -->
      <div class="relative z-5 flex-1 space-y-1.5 max-w-xl xl:max-w-2xl mt-20 lg:mt-40">
        <h2 class="!leading-6 text-base lg:text-xl font-medium rtl:font-semibold">
          {{ $t('frontend.admission.tuition_fee') }}
        </h2>
        <p class="text-sm sm:text-lg lg:text-xl font-normal !leading-6">
          {{ $t('frontend.admission.tuition_description') }}
        </p>
        <h2 class="!leading-6 text-base lg:text-xl font-medium !mt-4 rtl:font-semibold">
          {{ $t('frontend.admission.we_offer') }}
        </h2>
        <div class="flex flex-col gap-px !mt-5">
          <div class="group flex flex-col gap-1 max-w-max">
            <h2 class="!leading-6 text-base lg:text-xl font-medium mt-4">
              {{ $t('frontend.admission.offers.flexible_payment') }}
            </h2>
            <div class="bg-yellow-400/90 h-0.5 w-12 rounded-full group-hover:w-24 duration-500"></div>
          </div>
          <div class="group flex flex-col gap-1 max-w-max">
            <h2 class="!leading-6 text-base lg:text-xl font-medium mt-4">
              {{ $t('frontend.admission.offers.sibling_discount') }}
            </h2>
            <div class="bg-yellow-400/90 h-0.5 w-12 rounded-full group-hover:w-24 duration-500"></div>
          </div>
          <div class="group flex flex-col gap-1 max-w-max">
            <h2 class="!leading-6 text-base lg:text-xl font-medium mt-4">
              {{ $t('frontend.admission.offers.scholarships') }}
            </h2>
            <div class="bg-yellow-400/90 h-0.5 w-12 rounded-full group-hover:w-24 duration-500"></div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
import { ref } from 'vue';
</script>

