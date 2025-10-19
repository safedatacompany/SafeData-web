<template>
  <section class="mt-16 mb-16 xl:mt-28 lg:mb-16">
    <div class="w-full sm:container 3xl:max-w-[85%] mx-auto px-4">
      <!-- Content -->
      <TabGroup>
        <div
          class="relative z-[5] w-full flex-1 flex flex-col md:flex-row md:items-end justify-between gap-5 text-justify">
          <h2 class="text-2xl lg:text-3xl xl:text-[32px] font-semibold text-black !leading-tight">
            {{ $t('frontend.media.title') }}
          </h2>
          <TabList class="flex flex-wrap gap-1">
            <Tab v-for="(items, category) in mediaCategories" :key="category" v-slot="{ selected }" class="outline-0">
              <button :class="[
                'w-full capitalize rounded-full duration-300 py-2 px-3.5 sm:px-5 text-sm sm:text-base font-normal !leading-5 outline-0 border-0 ring-0',
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
          <TabPanel v-for="(mediaItems, category) in mediaCategories" :key="category" class="block">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
              <div v-for="media in mediaItems" :key="media.id" class="relative group">
                <img :src="media.image" :alt="media.title" class="w-full h-[376px] object-cover" />
                <div
                  class="absolute inset-x-3 lg:inset-x-4 bottom-3 bg-white text-black py-3 px-5 text-justify opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                  <h3 class="text-base font-medium">{{ media.title }}</h3>
                  <p class="text-sm font-light">
                    {{ media.description }}
                  </p>
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

const mediaCategories = {
  projects: [
    {
      id: 1,
      title: 'Kindergarten Activity',
      description:
        'Lorem ipsum dolor sit amet consectetur.Lorem ipsum dolor sit amet consectetur. Lorem ipsum dolor sit amet consectetur.',
      image: '/img/media/1.jpg',
    },
    {
      id: 2,
      title: 'School Building Project',
      description:
        'Lorem ipsum dolor sit amet consectetur.Lorem ipsum dolor sit amet consectetur. Lorem ipsum dolor sit amet consectetur.',
      image: '/img/media/2.jpg',
    },
    {
      id: 3,
      title: 'Community Center',
      description:
        'Lorem ipsum dolor sit amet consectetur.Lorem ipsum dolor sit amet consectetur. Lorem ipsum dolor sit amet consectetur.',
      image: '/img/media/3.jpg',
    },
    {
      id: 4,
      title: 'Educational Program',
      description:
        'Lorem ipsum dolor sit amet consectetur.Lorem ipsum dolor sit amet consectetur. Lorem ipsum dolor sit amet consectetur.',
      image: '/img/media/4.jpg',
    },
    {
      id: 17,
      title: 'Library Renovation',
      description:
        'Lorem ipsum dolor sit amet consectetur.Lorem ipsum dolor sit amet consectetur. Lorem ipsum dolor sit amet consectetur.',
      image: '/img/media/5.jpg',
    },
    {
      id: 18,
      title: 'Playground Installation',
      description:
        'Lorem ipsum dolor sit amet consectetur.Lorem ipsum dolor sit amet consectetur. Lorem ipsum dolor sit amet consectetur.',
      image: '/img/media/6.jpg',
    },
    {
      id: 19,
      title: 'Art Workshop',
      description:
        'Lorem ipsum dolor sit amet consectetur.Lorem ipsum dolor sit amet consectetur. Lorem ipsum dolor sit amet consectetur.',
      image: '/img/media/7.jpg',
    },
    {
      id: 20,
      title: 'Science Fair',
      description:
        'Lorem ipsum dolor sit amet consectetur.Lorem ipsum dolor sit amet consectetur. Lorem ipsum dolor sit amet consectetur.',
      image: '/img/media/8.jpg',
    },
  ],
  events: [
    {
      id: 5,
      title: 'Annual Conference',
      description:
        'Lorem ipsum dolor sit amet consectetur.Lorem ipsum dolor sit amet consectetur. Lorem ipsum dolor sit amet consectetur.',
      image: '/img/media/5.jpg',
    },
    {
      id: 6,
      title: 'Cultural Festival',
      description:
        'Lorem ipsum dolor sit amet consectetur.Lorem ipsum dolor sit amet consectetur. Lorem ipsum dolor sit amet consectetur.',
      image: '/img/media/6.jpg',
    },
    {
      id: 7,
      title: 'Graduation Ceremony',
      description:
        'Lorem ipsum dolor sit amet consectetur.Lorem ipsum dolor sit amet consectetur. Lorem ipsum dolor sit amet consectetur.',
      image: '/img/media/7.jpg',
    },
    {
      id: 8,
      title: 'Workshop Series',
      description:
        'Lorem ipsum dolor sit amet consectetur.Lorem ipsum dolor sit amet consectetur. Lorem ipsum dolor sit amet consectetur.',
      image: '/img/media/8.jpg',
    },
    {
      id: 21,
      title: 'Music Concert',
      description:
        'Lorem ipsum dolor sit amet consectetur.Lorem ipsum dolor sit amet consectetur. Lorem ipsum dolor sit amet consectetur.',
      image: '/img/media/2.jpg',
    },
    {
      id: 22,
      title: 'Art Exhibition',
      description:
        'Lorem ipsum dolor sit amet consectetur.Lorem ipsum dolor sit amet consectetur. Lorem ipsum dolor sit amet consectetur.',
      image: '/img/media/5.jpg',
    },
  ],
  activities: [
    {
      id: 9,
      title: 'Community Outreach',
      description:
        'Lorem ipsum dolor sit amet consectetur.Lorem ipsum dolor sit amet consectetur. Lorem ipsum dolor sit amet consectetur.',
      image: '/img/media/2.jpg',
    },
    {
      id: 10,
      title: 'Volunteer Program',
      description:
        'Lorem ipsum dolor sit amet consectetur.Lorem ipsum dolor sit amet consectetur. Lorem ipsum dolor sit amet consectetur.',
      image: '/img/media/3.jpg',
    },
    {
      id: 11,
      title: 'Fundraising Event',
      description:
        'Lorem ipsum dolor sit amet consectetur.Lorem ipsum dolor sit amet consectetur. Lorem ipsum dolor sit amet consectetur.',
      image: '/img/media/6.jpg',
    },
    {
      id: 12,
      title: 'Health Campaign',
      description:
        'Lorem ipsum dolor sit amet consectetur.Lorem ipsum dolor sit amet consectetur. Lorem ipsum dolor sit amet consectetur.',
      image: '/img/media/1.jpg',
    },
  ],
  campus: [
    {
      id: 13,
      title: 'Campus Tour',
      description:
        'Lorem ipsum dolor sit amet consectetur.Lorem ipsum dolor sit amet consectetur. Lorem ipsum dolor sit amet consectetur.',
      image: '/img/media/2.jpg',
    },
    {
      id: 14,
      title: 'Library Facilities',
      description:
        'Lorem ipsum dolor sit amet consectetur.Lorem ipsum dolor sit amet consectetur. Lorem ipsum dolor sit amet consectetur.',
      image: '/img/media/2.jpg',
    },
    {
      id: 15,
      title: 'Sports Complex',
      description:
        'Lorem ipsum dolor sit amet consectetur.Lorem ipsum dolor sit amet consectetur. Lorem ipsum dolor sit amet consectetur.',
      image: '/img/media/4.jpg',
    },
    {
      id: 16,
      title: 'Student Center',
      description:
        'Lorem ipsum dolor sit amet consectetur.Lorem ipsum dolor sit amet consectetur. Lorem ipsum dolor sit amet consectetur.',
      image: '/img/media/8.jpg',
    },
    {
      id: 23,
      title: 'Cafeteria Area',
      description:
        'Lorem ipsum dolor sit amet consectetur.Lorem ipsum dolor sit amet consectetur. Lorem ipsum dolor sit amet consectetur.',
      image: '/img/media/3.jpg',
    },
  ],
};
</script>
