<template>
  <div class="block min-h-[100dvh]">
    <Approach />
    <Choose />
  </div>
</template>

<script setup>
import Approach from './partials/Approach.vue';
import Choose from './partials/Choose.vue';
import PublicLayout from '@/Pages/Frontend/Layouts/Public.vue';

defineOptions({
  layout: PublicLayout
});
</script>

