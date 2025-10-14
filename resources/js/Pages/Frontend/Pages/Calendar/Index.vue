<template>
  <div class="block min-h-[100dvh]">
    <Academic />
    <Official />
    <Important />
  </div>
</template>

<script setup>
import Academic from './partials/Academic.vue';
import Official from './partials/Official.vue';
import Important from './partials/Important.vue';
import PublicLayout from '@/Pages/Frontend/Layouts/Public.vue';

defineOptions({
  layout: PublicLayout
});
</script>

