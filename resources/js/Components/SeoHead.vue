<template>
    <Head>
        <title>{{ fullTitle }}</title>
        <meta name="description" :content="description" />
        <meta name="keywords" v-if="keywords" :content="keywords" />

        <!-- Open Graph / Facebook -->
        <meta property="og:type" :content="type" />
        <meta property="og:title" :content="fullTitle" />
        <meta property="og:description" :content="description" />
        <meta property="og:image" v-if="image" :content="image" />
        <meta property="og:image:alt" v-if="image" :content="imageAlt || title" />

        <!-- Twitter Card -->
        <meta name="twitter:card" :content="twitterCard" />
        <meta name="twitter:title" :content="fullTitle" />
        <meta name="twitter:description" :content="description" />
        <meta name="twitter:image" v-if="image" :content="image" />
        <meta name="twitter:image:alt" v-if="image" :content="imageAlt || title" />
    </Head>
</template>

<script setup>
import { Head } from '@inertiajs/vue3';
import { computed } from 'vue';

const props = defineProps({
    title: {
        type: String,
        required: true,
    },
    description: {
        type: String,
        default: 'Safe Data Company – Your trusted partner for data security, software development, web hosting, and IT solutions.',
    },
    image: {
        type: String,
        default: null,
    },
    imageAlt: {
        type: String,
        default: null,
    },
    keywords: {
        type: String,
        default: null,
    },
    type: {
        type: String,
        default: 'website',
    },
    twitterCard: {
        type: String,
        default: 'summary_large_image',
    },
    appendSiteName: {
        type: Boolean,
        default: true,
    },
});

const siteName = 'Safe Data Company';

const fullTitle = computed(() => {
    if (props.appendSiteName && props.title !== siteName) {
        return `${props.title} | ${siteName}`;
    }
    return props.title;
});
</script>
