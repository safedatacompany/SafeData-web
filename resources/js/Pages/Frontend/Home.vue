<template>
  <div class="relative bg-f-primary">

    <Head>
      <title>Safe Data Company</title>
    </Head>

    <!-- Animation Background -->
    <div class="fixed inset-0">
      <AnimationBg />
    </div>

    <section class="first">
      <div class="outer size-full overflow-y-hidden">
        <div class="inner size-full overflow-y-hidden">
          <div class="bg relative flex items-center justify-center abdolute size-full bg-cover">
            <HeroPage />
          </div>
        </div>
      </div>
    </section>
    <section class="second">
      <div class="outer size-full overflow-y-hidden">
        <div class="inner size-full overflow-y-hidden">
          <div class="bg flex items-center justify-center abdolute size-full bg-cover">
            <ProductsPage />
          </div>
        </div>
      </div>
    </section>
    <section class="third">
      <div class="outer size-full overflow-y-hidden">
        <div class="inner size-full overflow-y-hidden">
          <div class="bg flex items-center justify-center abdolute size-full bg-cover">
            <ServicesPage />
          </div>
        </div>
      </div>
    </section>
    <section class="fourth">
      <div class="outer size-full overflow-y-hidden">
        <div class="inner size-full overflow-y-hidden">
          <div class="bg flex items-center justify-center abdolute size-full bg-cover">
            <HostingPage />
          </div>
        </div>
      </div>
    </section>
    <section class="fifth">
      <div class="outer size-full overflow-y-hidden">
        <div class="inner size-full overflow-y-hidden">
          <div class="bg flex items-center justify-center abdolute size-full bg-cover">
            <ClientsPage />
          </div>
        </div>
      </div>
    </section>
    <section class="sixth">
      <div class="outer size-full overflow-y-hidden">
        <div class="inner size-full overflow-y-hidden">
          <div class="bg flex items-center justify-center abdolute size-full bg-cover">
            <AboutPage />
          </div>
        </div>
      </div>
    </section>

  </div>
</template>

<script setup>
import { ref, onMounted, inject, watch } from 'vue';
import { gsap } from 'gsap';
import { Observer } from 'gsap/Observer';

import HeroPage from './pages/HeroPage.vue';
import ProductsPage from './pages/ProductsPage.vue';
import ServicesPage from './pages/ServicesPage.vue';
import HostingPage from './pages/HostingPage.vue';
import AnimationBg from './components/AnimationBg.vue';
import ClientsPage from './pages/ClientsPage.vue';
import AboutPage from './pages/AboutPage.vue';

gsap.registerPlugin(Observer);

const pageNumber = inject('pageNumber');
const navDirection = inject('navDirection');
let currentIndex = -1;
let animating = false;

const sectionElements = ref();
const images = ref();
const outerWrappers = ref();
const innerWrappers = ref();

const direct = ref(1);
const lengthSections = ref(0);

// onMounted(() => {
//   sectionElements.value = document.querySelectorAll("section");
//   images.value = document.querySelectorAll(".bg");
//   outerWrappers.value = gsap.utils.toArray(".outer");
//   innerWrappers.value = gsap.utils.toArray(".inner");

//   lengthSections.value = sectionElements.value.length;

//   gsap.set(outerWrappers.value, { yPercent: 100 });
//   gsap.set(innerWrappers.value, { yPercent: -100 });

//   createObserver();
//   gotoSection(0, 1);
// });

// const gotoSection = (index, direction) => {
//   pageNumber.value = index;
//   direct.value = direction;
//   index = index == -1 ? lengthSections.value - 1 : index;
//   index = index == lengthSections.value ? 0 : index;
//   animating = true;
//   const fromTop = direction === -1;
//   const dFactor = fromTop ? -1 : 1;
//   const tl = gsap.timeline({
//     defaults: { duration: 1.65, ease: "power1.inOut" },
//     onComplete: () => animating = false
//   });

//   if (currentIndex >= 0 && sectionElements.value[currentIndex]) {
//     // The first time this function runs, currentIndex is -1
//     gsap.set(sectionElements.value[currentIndex], { zIndex: 0 });
//     tl.to(images.value[currentIndex], { yPercent: -100 * dFactor })
//       .set(sectionElements.value[currentIndex], { autoAlpha: 0 });
//   }

//   if (sectionElements.value[index]) {
//     gsap.set(sectionElements.value[index], { autoAlpha: 1, zIndex: 1 });
//     tl.fromTo([outerWrappers.value[index], innerWrappers.value[index]], {
//       yPercent: i => i ? -100 * dFactor : 100 * dFactor
//     }, {
//       yPercent: 0
//     }, 0)
//       .fromTo(images.value[index], { yPercent: 15 * dFactor }, { yPercent: 0 }, 0);
//   }

//   currentIndex = index;
// }

// const createObserver = () => {
//   Observer.create({
//     type: "wheel,touch,pointer",
//     wheelSpeed: -1,
//     onDown: () => !animating && gotoSection(currentIndex - 1, -1),
//     onUp: () => !animating && gotoSection(currentIndex + 1, 1),
//     tolerance: 10,
//     preventDefault: true
//   });
// }

// // Uncomment the line below to enable section navigation based on pageNumber changes
// watch(pageNumber, (newVal, oldVal) => {
//   let direction = newVal > oldVal ? 1 : -1;
//   if (navDirection.value) {
//     if (!animating) {
//       gotoSection(pageNumber.value, direction);
//     }
//   }
// });
</script>

<script>
import layout from './Layouts/Public.vue'
import { Head } from '@inertiajs/vue3';

export default {
  layout: layout,
}
</script>
