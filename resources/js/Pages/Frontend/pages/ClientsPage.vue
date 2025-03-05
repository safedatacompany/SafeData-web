<template>
    <div class="relative container-test mx-auto overflow-hidden z-20 py-36">
        <div class="w-full flex flex-col items-center justify-center gap-10 text-white">
            <Splide v-motion-slide-visible-bottom :duration="300" ref="splide"
                aria-labelledby="autoplay-example-heading" :options="{ ...options, autoScroll: { speed: -1.25, } }"
                :extensions="extensions" :has-track="true">
                <SplideSlide v-for="client in clients" :key="client.id" class="!bg-transparent !border-0">
                    <div class="relative size-full p-5 lg:px-7 lg:py-8 duration-200 group overflow-hidden">
                        <div class="relative size-full z-10 overflow-hidden">
                            <h2
                                class="text-sm lg:text-lg font-medium whitespace-nowrap duration-500 opacity-0 group-hover:opacity-100 -translate-y-10 group-hover:translate-y-0">
                                {{ client.name }}
                            </h2>
                            <div
                                class="size-full flex flex-col items-center justify-center gap-1 duration-300 -translate-y-6 group-hover:translate-y-0">
                                <img :src="client.logo" :alt="client.name"
                                    class="w-32 object-cover filter invert brightness-0 grayscale opacity-30">
                            </div>
                        </div>
                        <div class="absolute inset-0 z-0 size-full backdrop-blur-xl bg-white/[4%]"></div>
                    </div>
                </SplideSlide>
            </Splide>
            <h1 v-motion-slide-visible-bottom :duration="300" class="font-audi text-xl md:text-2xl xl:text-3xl">
                CLIENTS
            </h1>
            <Splide v-motion-slide-visible-bottom :duration="300" ref="splide"
                aria-labelledby="autoplay-example-heading" :options="{ ...options, autoScroll: { speed: 1.25, } }"
                :extensions="extensions" :has-track="true">
                <SplideSlide v-for="client in reverseClients" :key="client.id" class="!bg-transparent !border-0">
                    <div class="relative size-full p-5 lg:px-7 lg:py-8 duration-200 group overflow-hidden">
                        <div class="relative size-full z-10 overflow-hidden">
                            <h2
                                class="text-sm lg:text-lg font-medium whitespace-nowrap duration-500 opacity-0 group-hover:opacity-100 -translate-y-10 group-hover:translate-y-0">
                                {{ client.name }}
                            </h2>
                            <div
                                class="size-full flex flex-col items-center justify-center gap-1 duration-300 -translate-y-6 group-hover:translate-y-0">
                                <img :src="client.logo" :alt="client.name"
                                    class="w-32 object-cover filter invert brightness-0 grayscale opacity-30">
                            </div>
                        </div>
                        <div class="absolute inset-0 z-0 size-full backdrop-blur-xl bg-white/[4%]"></div>
                    </div>
                </SplideSlide>
            </Splide>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted, computed } from 'vue';
import { Splide, SplideSlide } from '@splidejs/vue-splide';
import { AutoScroll } from '@splidejs/splide-extension-auto-scroll';
import '@splidejs/vue-splide/css';

const options = {
    rewind: true,
    width: '100%',
    gap: '1.5rem',
    type: 'loop',
    drag: 'free',
    focus: 'right',
    pagination: false,
    arrows: false,
    breakpoints: {
        1920: {
            perPage: 6,
        },
        1536: {
            perPage: 5,
        },
        1280: {
            perPage: 4,
        },
        1024: {
            perPage: 3,
        },
        768: {
            perPage: 3,
        },
        640: {
            perPage: 2,
        },
        480: {
            perPage: 2,
        },
    }
};

const clients = ref([
    {
        id: 1,
        name: 'Ale',
        logo: '/img/client/ale.png',
    },
    {
        id: 2,
        name: 'Art Stone',
        logo: '/img/client/artstone.png',
    },
    {
        id: 3,
        name: 'Bardasor',
        logo: '/img/client/bardasor.png',
    },
    {
        id: 4,
        name: 'Bros Burger',
        logo: '/img/client/brosburger.png',
    },
    {
        id: 5,
        name: 'Bryar Company',
        logo: '/img/client/bryar.png',
    },
    {
        id: 6,
        name: 'Chia Company',
        logo: '/img/client/chia.png',
    },
    {
        id: 7,
        name: 'Dentist',
        logo: '/img/client/dentist.png',
    },
    {
        id: 8,
        name: 'Dli Shar',
        logo: '/img/client/dlishar.png',
    },
    {
        id: 9,
        name: 'Dr.Azad Hasan',
        logo: '/img/client/drazad.png',
    },
    {
        id: 10,
        name: 'Dukan Net',
        logo: '/img/client/dukannet.png',
    },
    {
        id: 11,
        name: 'Duplex',
        logo: '/img/client/duplex.png',
    },
    {
        id: 12,
        name: 'Fuji',
        logo: '/img/client/fuji.png',
    },
    {
        id: 13,
        name: 'Hemn',
        logo: '/img/client/hemn.png',
    },
    {
        id: 14,
        name: 'Homeline',
        logo: '/img/client/homeline.png',
    },
    {
        id: 15,
        name: 'Kayla',
        logo: '/img/client/kayla.png',
    },
    {
        id: 16,
        name: 'KRG',
        logo: '/img/client/krg.png',
    },
    {
        id: 17,
        name: 'Leaders Guide',
        logo: '/img/client/leadersguide.png',
    },
    {
        id: 18,
        name: 'Liwa',
        logo: '/img/client/liwa.png',
    },
    {
        id: 19,
        name: 'Mohammed Arif',
        logo: '/img/client/mohammed-arif.png',
    },
    {
        id: 20,
        name: 'Oka Travel',
        logo: '/img/client/okatravel.png',
    },
    {
        id: 21,
        name: 'Onebox',
        logo: '/img/client/onebox.png',
    },
    {
        id: 22,
        name: 'ONLINE',
        logo: '/img/client/online.png',
    },
    {
        id: 24,
        name: 'Perfect Glam',
        logo: '/img/client/perfectglam.png',
    },
    {
        id: 26,
        name: 'Quay Power',
        logo: '/img/client/quaypower.png',
    },
    {
        id: 27,
        name: 'Sadeer Baghdad',
        logo: '/img/client/sadeer.png',
    },
    {
        id: 28,
        name: 'Sdf Factory',
        logo: '/img/client/sdf.png',
    },
    {
        id: 29,
        name: 'Sh & K',
        logo: '/img/client/sh-k.png',
    },
    {
        id: 30,
        name: 'Sofyan',
        logo: '/img/client/sofyan.png',
    },
    {
        id: 31,
        name: 'Talent KG',
        logo: '/img/client/talentkg.png',
    },
    {
        id: 32,
        name: 'Terminal',
        logo: '/img/client/terminal.png',
    },
    {
        id: 35,
        name: 'Xawn KG',
        logo: '/img/client/xawn.png',
    },
    {
        id: 37,
        name: 'Zmnako Marka',
        logo: '/img/client/zmnakomarka.png',
    },
    {
        id: 38,
        name: 'Parsian Zagros',
        logo: '/img/client/parsianzagros.png',
    },
    {
        id: 39,
        name: 'Talent Nursery',
        logo: '/img/client/talent-nursery.png',
    },
    {
        id: 40,
        name: 'Iraq lubricant',
        logo: '/img/client/iraq_lubricant.png',
    },
    {
        id: 41,
        name: 'Jihany Kishmir',
        logo: '/img/client/jihany-kishmir.png',
    },
    {
        id: 42,
        name: 'Kutaly Zhilwan',
        logo: '/img/client/kutaly-zhilwan.png',
    },
]);

// i want get reverse clients
const reverseClients = computed(() => clients.value.slice().reverse());

const extensions = {
    AutoScroll,
};

onMounted(() => {
    // Initialization or additional logic if needed
});
</script>