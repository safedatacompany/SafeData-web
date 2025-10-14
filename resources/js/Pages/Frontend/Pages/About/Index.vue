<template>
  <div class="block min-h-[100dvh]">
    <About />
    <Message />
    <Mission />
    <Media />
    <Touch />
  </div>
</template>

<script setup>
import About from './partials/About.vue';
import Media from './partials/Media.vue';
import Message from './partials/Message.vue';
import Mission from './partials/Mission.vue';
import Touch from './partials/Touch.vue';
import PublicLayout from '@/Pages/Frontend/Layouts/Public.vue';

defineOptions({
  layout: PublicLayout
});
</script>

