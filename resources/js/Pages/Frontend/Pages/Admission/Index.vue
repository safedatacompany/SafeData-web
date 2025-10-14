<template>
  <div class="block min-h-[100dvh]">
    <Policy />
    <Documents />
  </div>
</template>

<script setup>
import Policy from './partials/Policy.vue';
import Documents from './partials/Documents.vue';
import PublicLayout from '@/Pages/Frontend/Layouts/Public.vue';

defineOptions({
  layout: PublicLayout
});
</script>

