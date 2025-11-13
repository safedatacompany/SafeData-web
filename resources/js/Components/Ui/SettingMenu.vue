<template>
    <Link v-if="(!is || $is(is)) && (!can || $can(can))" :href="route(link)"
        class="p-3 duration-300 hover:bg-primary/70 dark:hover:bg-primary/40 hover:text-white flex items-center justify-between gap-2 rtl:space-x-reverse">
    <div class="flex items-center gap-2">
        <Svg v-if="icon" :name="icon" class="size-5"></Svg>
        {{ $t('system.' + label) }}
    </div>
    <Svg name="arrow" class="size-5"></Svg>
    </Link>
</template>

<script setup>
import Svg from '@/Components/Svg.vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    link: {
        type: String,
        required: true
    },
    label: {
        type: String,
        required: true
    },
    icon: {
        type: String,
        default: ''
    },
    is: {
        type: String,
        default: ''
    },
    can: {
        type: String,
        default: ''
    }
});
</script>