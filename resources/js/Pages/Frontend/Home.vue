<template>
  <div class="relative bg-f-primary">

    <SeoHead
      title="Safe Data Company"
      description="Safe Data Company – Your trusted partner for data security, software development, web hosting, and IT solutions."
      keywords="safe data, data security, software development, web hosting, IT services, IT solutions"
      :append-site-name="false"
    />

    <!-- Animation Background -->
    <div class="fixed inset-0">
      <AnimationBg />
    </div>

    <main>
    <section id="home" class="first">
      <div class="outer size-full overflow-y-hidden">
        <div class="inner size-full overflow-y-hidden">
          <div class="bg relative flex items-center justify-center abdolute size-full min-h-dvh bg-cover">
            <HeroPage :services="services" />
          </div>
        </div>
      </div>
    </section>
    <section id="products" class="second">
      <div class="outer size-full overflow-y-hidden">
        <div class="inner size-full overflow-y-hidden">
          <div class="bg flex items-center justify-center abdolute size-full min-h-dvh bg-cover">
            <ProductsPage :products="products" />
          </div>
        </div>
      </div>
    </section>
    <section id="services" class="third">
      <div class="outer size-full overflow-y-hidden">
        <div class="inner size-full overflow-y-hidden">
          <div class="bg flex items-center justify-center abdolute size-full min-h-dvh bg-cover">
            <ServicesPage :services="services" />
          </div>
        </div>
      </div>
    </section>
    <section id="hosting" class="fourth">
      <div class="outer size-full overflow-y-hidden">
        <div class="inner size-full overflow-y-hidden">
          <div class="bg flex items-center justify-center abdolute size-full min-h-dvh bg-cover">
            <HostingPage :hosting="hosting" />
          </div>
        </div>
      </div>
    </section>
    <section id="clients" class="fifth">
      <div class="outer size-full overflow-y-hidden">
        <div class="inner size-full overflow-y-hidden">
          <div class="bg flex items-center justify-center abdolute size-full min-h-dvh bg-cover">
            <ClientsPage :clients="clients" />
          </div>
        </div>
      </div>
    </section>
    <section id="about" class="sixth">
      <div class="outer size-full overflow-y-hidden">
        <div class="inner size-full overflow-y-hidden">
          <div class="bg flex items-center justify-center abdolute size-full min-h-dvh bg-cover">
            <AboutPage :links="links" :phone_numbers="phone_numbers" />
          </div>
        </div>
      </div>
    </section>
    </main>

  </div>
</template>

<script setup>
import { ref, onMounted, inject, watch } from 'vue';

import HeroPage from './pages/HeroPage.vue';
import ProductsPage from './pages/ProductsPage.vue';
import ServicesPage from './pages/ServicesPage.vue';
import HostingPage from './pages/HostingPage.vue';
import AnimationBg from './components/AnimationBg.vue';
import ClientsPage from './pages/ClientsPage.vue';
import AboutPage from './pages/AboutPage.vue';

const props = defineProps([
    'services',
    'clients',
    'products',
    'hosting',
    'links',
    'phone_numbers'
]);
</script>

<script>
import layout from './Layouts/Public.vue'
import { Head } from '@inertiajs/vue3';
import SeoHead from '@/Components/SeoHead.vue';

export default {
  layout: layout,
}
</script>
