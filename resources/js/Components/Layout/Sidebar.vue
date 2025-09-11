<template>
    <div :class="{ 'dark text-white-dark': semidark }">
        <nav
            class="sidebar fixed overflow-x-hidden min-h-screen h-full top-14 bottom-0 w-[260px] shadow-[5px_0_25px_0_rgba(94,92,154,0.1)] z-50 transition-all duration-300">
            <div class="bg-white dark:bg-[#0e1726] h-full">
                <perfect-scrollbar :options="{
                    swipeEasing: true,
                    wheelPropagation: false,
                }" class="h-[calc(100vh-80px)] relative">
                    <ul class="relative font-semibold space-y-0.5 p-4 py-4">
                        <li class="menu nav-item">
                            <Link :href="route('control.dashboard')" class="nav-link group w-full"
                                :class="{ active: $page.component.startsWith('Dashboard') }">
                            <div class="flex items-center">
                                <Svg name="home_angle" class="size-5"></Svg>

                                <span
                                    class="ps-3 lg:text-base text-black dark:text-gray-300 dark:group-hover:text-gray-200">
                                    {{ $t('nav.dashboard') }}
                                </span>
                            </div>
                            </Link>
                        </li>

                        <h2 v-if="$can('view_services' || 'view_products' || 'view_hostings' || 'view_clients')"
                            class="py-3 px-7 flex items-center uppercase font-extrabold bg-white-light/30 dark:bg-dark dark:bg-opacity-[0.08] -mx-4 mb-1">
                            <Svg name="line" class="w-4 h-5 flex-none hidden"></Svg>
                            <span>{{ $t('nav.pages') }}</span>
                        </h2>

                        <li class="nav-item">
                            <ul>
                                <li v-if="$can('view_services')" class="nav-item">
                                    <Link :href="route('control.pages.services.index')" class="nav-link group w-full"
                                        :class="{ active: $page.component === 'Pages/Services' }">
                                    <div class="flex items-center">
                                        <Svg name="service" class="size-5"></Svg>

                                        <span
                                            class="ltr:pl-3 rtl:pr-3 text-black dark:text-[#7d96c5] dark:group-hover:text-white-dark">
                                            {{ $t('nav.services') }}
                                        </span>
                                    </div>
                                    </Link>
                                </li>
                                <li v-if="$can('view_products')" class="nav-item">
                                    <Link :href="route('control.pages.products.index')" class="nav-link group w-full"
                                        :class="{ active: $page.component === 'Pages/Products' }">
                                    <div class="flex items-center">
                                        <Svg name="box" class="size-5"></Svg>

                                        <span
                                            class="ltr:pl-3 rtl:pr-3 text-black dark:text-[#7d96c5] dark:group-hover:text-white-dark">
                                            {{ $t('nav.products') }}
                                        </span>
                                    </div>
                                    </Link>
                                </li>
                                <li v-if="$can('view_hostings')" class="nav-item">
                                    <Link :href="route('control.pages.hostings.index')" class="nav-link group w-full"
                                        :class="{ active: $page.component === 'Pages/Hostings' }">
                                    <div class="flex items-center">
                                        <Svg name="cloud" class="size-5"></Svg>

                                        <span
                                            class="ltr:pl-3 rtl:pr-3 text-black dark:text-[#7d96c5] dark:group-hover:text-white-dark">
                                            {{ $t('nav.hostings') }}
                                        </span>
                                    </div>
                                    </Link>
                                </li>
                                <li v-if="$can('view_clients')" class="nav-item">
                                    <Link :href="route('control.pages.clients.index')" class="nav-link group w-full"
                                        :class="{ active: $page.component === 'Pages/Clients' }">
                                    <div class="flex items-center">
                                        <Svg name="users" class="size-5"></Svg>

                                        <span
                                            class="ltr:pl-3 rtl:pr-3 text-black dark:text-[#7d96c5] dark:group-hover:text-white-dark">
                                            {{ $t('nav.clients') }}
                                        </span>
                                    </div>
                                    </Link>
                                </li>
                            </ul>
                        </li>

                        <h2 v-if="$can('view_users')"
                            class="py-3 px-7 flex items-center uppercase font-extrabold bg-white-light/30 dark:bg-dark dark:bg-opacity-[0.08] -mx-4 mb-1">
                            <Svg name="line" class="w-4 h-5"></Svg>
                            <span>{{ $t('nav.system') }}</span>
                        </h2>
                        <ul>
                            <li v-if="$can('view_users')" class="nav-item">
                                <Link :href="route('control.system.users.index')" class="nav-link group w-full"
                                    :class="{ active: $page.component.startsWith('System/Users') }">
                                <div class="flex items-center">
                                    <Svg name="users" class="size-5"></Svg>

                                    <span
                                        class="ltr:pl-3 rtl:pr-3 text-black dark:text-gray-300 dark:group-hover:text-gray-200">
                                        {{ $t('nav.users') }}
                                    </span>
                                </div>
                                </Link>
                            </li>
                        </ul>

                        <h2
                            class="py-3 px-7 flex items-center uppercase font-extrabold bg-white-light/30 dark:bg-dark dark:bg-opacity-[0.08] -mx-4 mb-1">
                            <Svg name="line" class="w-4 h-5 flex-none hidden"></Svg>
                            <span>{{ $t('nav.others') }}</span>
                        </h2>
                        <ul>
                            <li class="nav-item">
                                <Link :href="route('control.profile')" class="nav-link group w-full"
                                    :class="{ active: $page.component === 'Profile' }">
                                <div class="flex items-center">
                                    <Svg name="user_id" class="size-5"></Svg>
                                    <span
                                        class="ltr:pl-3 rtl:pr-3 text-black dark:text-gray-300 dark:group-hover:text-gray-200">
                                        {{ $t('nav.profile') }}
                                    </span>
                                </div>
                                </Link>
                            </li>
                        </ul>

                    </ul>
                </perfect-scrollbar>
            </div>
        </nav>
    </div>
</template>

<script setup>
import { ref, onMounted, watch } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';
import VueCollapsible from 'vue-height-collapsible/vue3';
import { getDefaultSettings } from '@/settings.js';

const settings = getDefaultSettings();
const emits = defineEmits();

const sidebar = ref(settings.sidebar);
const semidark = settings.semidark;
const activeDropdown = ref(getPath());
const subActive = ref(getPath());

function getPath() {
    const currentPath = window.location.pathname;
    const lastSlashIndex = currentPath.lastIndexOf('/');

    if (lastSlashIndex !== -1)
        return currentPath.substring(0, lastSlashIndex);
}


</script>
