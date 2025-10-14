<template>
  <div class="block min-h-[100dvh]">
    <Campus />
    <Class />
    <Contact />
  </div>
</template>

<script setup>
import Campus from './partials/Campus.vue';
import Class from './partials/Class.vue';
import Contact from './partials/Contact.vue';
import PublicLayout from '@/Pages/Frontend/Layouts/Public.vue';

defineOptions({
  layout: PublicLayout
});
</script>

