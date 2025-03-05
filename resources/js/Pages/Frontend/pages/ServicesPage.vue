<template>
    <div class="relative container 2xl:max-w-[100rem] mx-auto z-20 py-36">
        <div
            class="w-full flex flex-col sm:flex-row items-center justify-center gap-y-5 gap-x-5 xl:gap-x-16 2xl:gap-x-24 text-white lg:px-2">
            <h1 v-motion-slide-visible-bottom :duration="300" class="font-audi text-xl md:text-2xl xl:text-3xl ms-3">SERVICES</h1>

            <div class="w-full grid grid-cols-1 lg:grid-cols-2 gap-y-3 sm:gap-y-5 gap-x-5 xl:gap-x-16 2xl:gap-x-24 p-6">
                <!-- Card -->
                <div v-motion-slide-visible-bottom :duration="300" v-for="service in services" :key="service.id"
                    class="services-card w-full group relative overflow-hidden text-white p-5 sm:p-6 lg:p-8 xl:p-10" data-tilt
                    data-tilt-scale="1.02" data-tilt-reset-to-start="true" data-tilt-reset="true" data-tilt-speed="1000"
                    data-tilt-max="5">
                    <div class="relative z-10 flex gap-1">
                        <div class="block">
                            <Svg :name="service.icon" class="size-9 2xl:size-12 text-white me-3"></Svg>
                        </div>
                        <div class="flex flex-col justify-center gap-1">
                            <h2 class="text-base sm:text-lg 2xl:text-xl font-medium">{{ service.title }}</h2>
                            <p
                                class="text-white block text-xs 2xl:text-sm font-light text-justify leading-tight">
                                {{ service.description }}
                            </p>
                        </div>
                    </div>
                    <div class="absolute inset-0 -z-10 size-full backdrop-blur-xl bg-white/[4%]"></div>
                    <div class="absolute inset-0 z-0 bg-f-secondary duration-500 opacity-0 group-hover:opacity-100">
                        <div
                            class="absolute inset-0 size-full scale-[3] z-5 circle-obj rounded-e-full blur-3xl opacity-0 group-hover:opacity-30">
                        </div>
                        <div
                            class="absolute inset-0 size-full scale-[3] z-5 circle-obj-one rounded-e-full blur-3xl opacity-0 group-hover:opacity-30">
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import VanillaTilt from "vanilla-tilt";

const services = ref([
    {
        id: 1,
        title: "Web Application",
        description: "We offer top-tier web application development services, creating robust, scalable, and user-friendly solutions tailored to your business needs. Whether building a custom web app from scratch or enhancing an existing one, our skilled developers deliver high-quality results efficiently and cost-effectively.",
        icon: "development",
    },
    {
        id: 2,
        title: "Cloud",
        description: "We offer reliable cloud services, including cloud hosting, storage, SaaS solutions, backup and disaster recovery, and cloud security, tailored for businesses. Their solutions ensure scalability, security, and easy access to your data and applications from anywhere.",
        icon: "cloud",
    },
    {
        id: 3,
        title: "Mobile Application",
        description: "We specialize in mobile application development, creating custom apps for businesses. They develop high-quality, user-friendly apps for both iOS and Android platforms, tailored to meet specific business needs and enhance customer engagement.",
        icon: "apps",
    },
    {
        id: 4,
        title: "Network",
        description: "We provide comprehensive network services, including network design, setup, maintenance, and security. They ensure reliable, secure, and high-performance network infrastructure tailored to your business needs.",
        icon: "network",
    },
    {
        id: 5,
        title: "UX/UI Design",
        description: "We offer expert UI/UX design services, creating intuitive and visually appealing interfaces for web and mobile applications. Their design process focuses on user experience, ensuring that the final product is not only beautiful but also easy to use and highly functional.",
        icon: "figma",
    },
    {
        id: 6,
        title: "Website",
        description: "We excel in website development, creating modern, responsive, and user-friendly websites tailored to your business needs. We offer everything from design and development to hosting and maintenance, ensuring a seamless online presence for your brand.",
        icon: "website",
    },
]);

onMounted(() => {
    VanillaTilt.init(document.querySelectorAll(".services-card"));
});
</script>