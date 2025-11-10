<template>

  <Head>
    <title>{{ $t('frontend.nav.academics') }}</title>
  </Head>

  <div class="block min-h-[100dvh]">
    <Approach :approach="approach" />
    <Choose :choose="choose" />
  </div>
</template>

<script setup>
import { Head } from '@inertiajs/vue3';
import Approach from './partials/Approach.vue';
import Choose from './partials/Choose.vue';
import PublicLayout from '@/Pages/Frontend/Layouts/Public.vue';

defineProps({
  approach: {
    type: Object,
    default: null
  },
  choose: {
    type: Object,
    default: null
  }
});

defineOptions({
  layout: PublicLayout
});
</script>
