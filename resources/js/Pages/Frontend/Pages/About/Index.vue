<template>

  <Head>
    <title>{{ $t('frontend.nav.about') }}</title>
  </Head>

  <div class="block min-h-[100dvh]">
    <About :data="about" />
    <Message :data="message" />
    <Mission :data="mission" />
    <Media :data="gallery" />
    <Touch :data="touch" />
  </div>
</template>

<script setup>
import { Head } from '@inertiajs/vue3';
import About from './partials/About.vue';
import Media from './partials/Media.vue';
import Message from './partials/Message.vue';
import Mission from './partials/Mission.vue';
import Touch from './partials/Touch.vue';
import PublicLayout from '@/Pages/Frontend/Layouts/Public.vue';

// Define props received from AboutController
const props = defineProps({
  about: {
    type: Object,
    default: () => ({})
  },
  message: {
    type: Object,
    default: () => ({})
  },
  mission: {
    type: Object,
    default: () => ({})
  },
  touch: {
    type: Object,
    default: () => ({})
  },
  gallery: {
    type: Object,
    default: () => ({})
  }
});

defineOptions({
  layout: PublicLayout
});
</script>
