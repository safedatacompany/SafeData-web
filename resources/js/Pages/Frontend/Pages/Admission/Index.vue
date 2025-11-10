<template>

  <Head>
    <title>{{ $t('frontend.nav.admission') }}</title>
  </Head>

  <div class="block min-h-[100dvh]">
    <Policy :policy="policy" />
    <Documents :document="document" />
  </div>
</template>

<script setup>
import Policy from './partials/Policy.vue';
import Documents from './partials/Documents.vue';
import PublicLayout from '@/Pages/Frontend/Layouts/Public.vue';
import { Head } from '@inertiajs/vue3';

// Receive props from controller
defineProps({
  policy: Object,
  document: Object,
});

defineOptions({
  layout: PublicLayout
});
</script>
