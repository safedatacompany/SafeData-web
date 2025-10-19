<template>
  <section class="mt-10 mb-16 xl:mt-24 lg:mb-32">
    <div class="w-full sm:container 3xl:max-w-[85%] mx-auto px-4">
      <!-- Content -->
      <TabGroup>
        <div class="relative z-[5] w-full flex-1 flex flex-col items-center justify-center gap-5 text-justify">
          <h2 class="text-2xl lg:text-3xl xl:text-[32px] font-semibold text-black !leading-tight">
            {{ $t('frontend.news.latest_news') }}
          </h2>
          <!-- Input Search -->
          <div class="relative w-full max-w-xl">
            <input type="text" :placeholder="$t('frontend.news.search_placeholder')"
              class="w-full border bg-f-primary/5 text-black placeholder:text-black rounded-full py-4 px-7 text-sm sm:text-base font-normal !leading-5 border-transparent outline-0 focus:ring-0" />
          </div>
          <TabList class="flex justify-center flex-wrap gap-1">
            <Tab v-for="(items, category) in newsCategories" :key="category" v-slot="{ selected }" class="outline-0">
              <button :class="[
                'w-full rounded-full duration-300 py-2 px-3.5 sm:px-5 text-sm sm:text-base capitalize font-normal !leading-5 outline-0 border-0 ring-0',
                selected
                  ? 'text-white bg-f-primary'
                  : 'text-black hover:text-f-primary',
              ]">
                {{ category }}
              </button>
            </Tab>
          </TabList>
        </div>
        <!-- Tab -->
        <TabPanels class="mt-10">
          <TabPanel v-for="(newsItems, category) in newsCategories" :key="category" class="block">
            <div class="flex-1 grid sm:grid-cols-3 gap-3 md:gap-6 lg:gap-8">
              <div v-for="item in newsItems" :key="item.id"
                class="relative h-[532px] sm:h-[332px] md:h-[412px] lg:h-[532px] xl:h-[652px] 2xl:h-[732px] overflow-hidden">
                <img :src="item.image" alt="news" class="w-full h-full object-cover" />
                <p
                  class="absolute bottom-3 lg:bottom-6 xl:bottom-11 z-[2] text-white p-4 text-base sm:text-xs lg:text-sm xl:text-base 2xl:text-lg lg:leading-6 font-light">
                  {{ item.description }}
                </p>
                <div
                  class="absolute inset-x-0 bottom-0 z-[1] h-[200px] bg-gradient-to-t from-gray-950/70 to-transparent">
                </div>
              </div>
            </div>
          </TabPanel>
        </TabPanels>
      </TabGroup>

      <!-- Pagination -->
      <div class="mt-16 flex justify-center gap-2">
        <button
          class="size-9 bg-white text-black flex items-center justify-center border border-black rounded-full hover:text-white hover:bg-black duration-300">
          <Svg name="arrow_up" class="size-6 rtl:rotate-180"></Svg>
        </button>
        <div class="flex justify-center gap-1">
          <button
            class="size-9 bg-black text-white border border-black rounded-full hover:text-white hover:bg-black duration-300">
            1
          </button>
          <button
            class="size-9 bg-white text-black border border-black rounded-full hover:text-white hover:bg-black duration-300">
            2
          </button>
          <button
            class="size-9 bg-white text-black border border-black rounded-full hover:text-white hover:bg-black duration-300">
            3
          </button>
          <button
            class="size-9 bg-white text-black border border-black rounded-full hover:text-white hover:bg-black duration-300">
            12
          </button>
        </div>
        <button
          class="size-9 bg-white text-black flex items-center justify-center border border-black rounded-full hover:text-white hover:bg-black duration-300">
          <Svg name="arrow_up" class="size-6 ltr:rotate-180"></Svg>
        </button>
      </div>
    </div>
  </section>
</template>

<script setup>
import { TabGroup, TabList, Tab, TabPanels, TabPanel } from '@headlessui/vue'

const newsCategories = {
  projects: [
    {
      id: 1,
      title: 'Kindergarten Activity',
      description:
        'Lorem ipsum dolor sit amet consectetur.Lorem ipsum dolor sit amet consectetur. Lorem ipsum dolor sit amet consectetur.',
      image: '/img/news/1.jpg',
    },
    {
      id: 2,
      title: 'School Building Project',
      description:
        'Lorem ipsum dolor sit amet consectetur.Lorem ipsum dolor sit amet consectetur. Lorem ipsum dolor sit amet consectetur.',
      image: '/img/news/2.jpg',
    },
    {
      id: 3,
      title: 'Community Center',
      description:
        'Lorem ipsum dolor sit amet consectetur.Lorem ipsum dolor sit amet consectetur. Lorem ipsum dolor sit amet consectetur.',
      image: '/img/news/3.jpg',
    },
    {
      id: 4,
      title: 'Educational Program',
      description:
        'Lorem ipsum dolor sit amet consectetur.Lorem ipsum dolor sit amet consectetur. Lorem ipsum dolor sit amet consectetur.',
      image: '/img/news/4.jpg',
    },
    {
      id: 17,
      title: 'Library Renovation',
      description:
        'Lorem ipsum dolor sit amet consectetur.Lorem ipsum dolor sit amet consectetur. Lorem ipsum dolor sit amet consectetur.',
      image: '/img/news/5.jpg',
    },
    {
      id: 18,
      title: 'Playground Installation',
      description:
        'Lorem ipsum dolor sit amet consectetur.Lorem ipsum dolor sit amet consectetur. Lorem ipsum dolor sit amet consectetur.',
      image: '/img/news/6.jpg',
    },
  ],
  events: [
    {
      id: 5,
      title: 'Annual Conference',
      description:
        'Lorem ipsum dolor sit amet consectetur.Lorem ipsum dolor sit amet consectetur. Lorem ipsum dolor sit amet consectetur.',
      image: '/img/news/5.jpg',
    },
    {
      id: 6,
      title: 'Cultural Festival',
      description:
        'Lorem ipsum dolor sit amet consectetur.Lorem ipsum dolor sit amet consectetur. Lorem ipsum dolor sit amet consectetur.',
      image: '/img/news/6.jpg',
    },
    {
      id: 7,
      title: 'Graduation Ceremony',
      description:
        'Lorem ipsum dolor sit amet consectetur.Lorem ipsum dolor sit amet consectetur. Lorem ipsum dolor sit amet consectetur.',
      image: '/img/news/7.jpg',
    },
    {
      id: 8,
      title: 'Workshop Series',
      description:
        'Lorem ipsum dolor sit amet consectetur.Lorem ipsum dolor sit amet consectetur. Lorem ipsum dolor sit amet consectetur.',
      image: '/img/news/8.jpg',
    },
    {
      id: 21,
      title: 'Music Concert',
      description:
        'Lorem ipsum dolor sit amet consectetur.Lorem ipsum dolor sit amet consectetur. Lorem ipsum dolor sit amet consectetur.',
      image: '/img/news/2.jpg',
    },
    {
      id: 22,
      title: 'Art Exhibition',
      description:
        'Lorem ipsum dolor sit amet consectetur.Lorem ipsum dolor sit amet consectetur. Lorem ipsum dolor sit amet consectetur.',
      image: '/img/news/5.jpg',
    },
  ],
  activities: [
    {
      id: 9,
      title: 'Community Outreach',
      description:
        'Lorem ipsum dolor sit amet consectetur.Lorem ipsum dolor sit amet consectetur. Lorem ipsum dolor sit amet consectetur.',
      image: '/img/news/2.jpg',
    },
    {
      id: 10,
      title: 'Volunteer Program',
      description:
        'Lorem ipsum dolor sit amet consectetur.Lorem ipsum dolor sit amet consectetur. Lorem ipsum dolor sit amet consectetur.',
      image: '/img/news/3.jpg',
    },
    {
      id: 11,
      title: 'Fundraising Event',
      description:
        'Lorem ipsum dolor sit amet consectetur.Lorem ipsum dolor sit amet consectetur. Lorem ipsum dolor sit amet consectetur.',
      image: '/img/news/6.jpg',
    },
    {
      id: 12,
      title: 'Health Campaign',
      description:
        'Lorem ipsum dolor sit amet consectetur.Lorem ipsum dolor sit amet consectetur. Lorem ipsum dolor sit amet consectetur.',
      image: '/img/news/1.jpg',
    },
  ],
  campus: [
    {
      id: 13,
      title: 'Campus Tour',
      description:
        'Lorem ipsum dolor sit amet consectetur.Lorem ipsum dolor sit amet consectetur. Lorem ipsum dolor sit amet consectetur.',
      image: '/img/news/2.jpg',
    },
    {
      id: 14,
      title: 'Library Facilities',
      description:
        'Lorem ipsum dolor sit amet consectetur.Lorem ipsum dolor sit amet consectetur. Lorem ipsum dolor sit amet consectetur.',
      image: '/img/news/2.jpg',
    },
    {
      id: 15,
      title: 'Sports Complex',
      description:
        'Lorem ipsum dolor sit amet consectetur.Lorem ipsum dolor sit amet consectetur. Lorem ipsum dolor sit amet consectetur.',
      image: '/img/news/4.jpg',
    },
    {
      id: 16,
      title: 'Student Center',
      description:
        'Lorem ipsum dolor sit amet consectetur.Lorem ipsum dolor sit amet consectetur. Lorem ipsum dolor sit amet consectetur.',
      image: '/img/news/8.jpg',
    },
    {
      id: 23,
      title: 'Cafeteria Area',
      description:
        'Lorem ipsum dolor sit amet consectetur.Lorem ipsum dolor sit amet consectetur. Lorem ipsum dolor sit amet consectetur.',
      image: '/img/news/3.jpg',
    },
  ],
};
</script>
