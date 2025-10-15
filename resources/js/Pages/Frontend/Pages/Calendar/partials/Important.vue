<template>
  <section class="w-full sm:container 3xl:max-w-[70%] mx-auto px-4 mb-16">
    <div class="relative flex flex-col items-start gap-y-5 gap-x-8 xl:gap-x-10 pb-10 md:pb-24 pt-8">
      <!-- Left Content -->
      <div class="relative z-5 flex-1 space-y-1.5 max-w-xl xl:max-w-2xl text-justify">
        <h2 class="relative z-10 text-2xl lg:text-3xl xl:text-[32px] font-semibold text-black !leading-tight">
          {{ $t('frontend.calendar.important_title') }}
        </h2>
        <img :src="'/img/shape_red.svg'" alt="ShapeOne"
          class="absolute -top-5 -start-5 3xl:-start-[60px] opacity-20 3xl:opacity-100" />
      </div>

      <!-- Table -->
      <div class="w-full overflow-hidden mt-3">
        <div class="overflow-x-auto">
          <table class="w-full border-collapse border border-gray-300">
            <tbody>
              <tr class="border-b !border-gray-300">
                <td class="px-4 sm:px-6 py-3.5 sm:py-4.5 text-sm sm:text-base lg:text-xl font-medium lg:w-2/3">
                  Start School
                </td>
                <td
                  class="px-4 sm:px-6 py-3.5 sm:py-4.5 text-sm sm:text-base lg:text-xl font-medium border-s border-gray-300">
                  Early September
                </td>
              </tr>
              <tr class="border-b !border-gray-300">
                <td class="px-4 sm:px-6 py-3.5 sm:py-4.5 text-sm sm:text-base lg:text-xl font-medium lg:w-2/3">
                  Midterm Exams
                </td>
                <td
                  class="px-4 sm:px-6 py-3.5 sm:py-4.5 text-sm sm:text-base lg:text-xl font-medium border-s border-gray-300">
                  November & March
                </td>
              </tr>
              <tr class="border-b !border-gray-300">
                <td class="px-4 sm:px-6 py-3.5 sm:py-4.5 text-sm sm:text-base lg:text-xl font-medium lg:w-2/3">
                  Final Exams
                </td>
                <td
                  class="px-4 sm:px-6 py-3.5 sm:py-4.5 text-sm sm:text-base lg:text-xl font-medium border-s border-gray-300">
                  January & June
                </td>
              </tr>
              <tr class="border-b !border-gray-300">
                <td class="px-4 sm:px-6 py-3.5 sm:py-4.5 text-sm sm:text-base lg:text-xl font-medium lg:w-2/3">
                  Parent-Teacher Meetings
                </td>
                <td
                  class="px-4 sm:px-6 py-3.5 sm:py-4.5 text-sm sm:text-base lg:text-xl font-medium border-s border-gray-300">
                  Each Semester
                </td>
              </tr>
              <tr class="border-b !border-gray-300">
                <td class="px-4 sm:px-6 py-3.5 sm:py-4.5 text-sm sm:text-base lg:text-xl font-medium lg:w-2/3">
                  Science Fair
                </td>
                <td
                  class="px-4 sm:px-6 py-3.5 sm:py-4.5 text-sm sm:text-base lg:text-xl font-medium border-s border-gray-300">
                  April
                </td>
              </tr>
              <tr class="border-b !border-gray-300">
                <td class="px-4 sm:px-6 py-3.5 sm:py-4.5 text-sm sm:text-base lg:text-xl font-medium lg:w-2/3">
                  Graduation & Cultural Day
                </td>
                <td
                  class="px-4 sm:px-6 py-3.5 sm:py-4.5 text-sm sm:text-base lg:text-xl font-medium border-s border-gray-300">
                  May - June
                </td>
              </tr>
              <tr class="border-b !border-gray-300">
                <td class="px-4 sm:px-6 py-3.5 sm:py-4.5 text-sm sm:text-base lg:text-xl font-medium lg:w-2/3">
                  Summer Program
                </td>
                <td
                  class="px-4 sm:px-6 py-3.5 sm:py-4.5 text-sm sm:text-base lg:text-xl font-medium border-s border-gray-300">
                  July
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

    </div>
  </section>
</template>

<script setup>
</script>
