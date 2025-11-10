<template>

  <Head>
    <title>{{ $t('frontend.nav.campus') }}</title>
  </Head>

  <div class="block min-h-[100dvh]">
    <Campus :campuses="campuses" />
    <Class :classrooms="classrooms" />
    <Contact />
  </div>
</template>

<script setup>
import { Head } from '@inertiajs/vue3';
import Campus from './partials/Campus.vue';
import Class from './partials/Class.vue';
import Contact from './partials/Contact.vue';
import PublicLayout from '@/Pages/Frontend/Layouts/Public.vue';

defineProps({
  campuses: {
    type: Array,
    default: () => []
  },
  classrooms: {
    type: Array,
    default: () => []
  }
});

defineOptions({
  layout: PublicLayout
});
</script>
