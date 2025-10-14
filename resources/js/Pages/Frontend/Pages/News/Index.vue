<template>
  <div class="block min-h-[100dvh]">
    <Detalils />
    <Latest />
  </div>
</template>

<script setup>
import Detalils from './partials/Detalils.vue';
import Latest from './partials/Latest.vue';
import PublicLayout from '@/Pages/Frontend/Layouts/Public.vue';

defineOptions({
  layout: PublicLayout
});
</script>

