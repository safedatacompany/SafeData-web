<template>
    <div class="font-mont bg-white overflow-x-hidden">
        <Navbar />
        <slot></slot>
        <Footer />
    </div>
</template>

<script setup>
import { ref, provide } from 'vue';
import Navbar from '@/Pages/Frontend/Components/Navbar.vue';
import Footer from '@/Pages/Frontend/Components/Footer.vue';

const pageNumber = ref(0);
const navDirection = ref(false);
provide('pageNumber', pageNumber);
provide('navDirection', navDirection);
</script>

