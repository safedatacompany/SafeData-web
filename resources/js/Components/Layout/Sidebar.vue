<template>
    <div :class="{ 'dark text-white-dark': semidark }">
        <nav
            class="sidebar fixed overflow-x-hidden min-h-screen h-full top-0 bottom-0 w-[260px] shadow-[5px_0_25px_0_rgba(94,92,154,0.1)] z-50 transition-all duration-300">
            <div class="bg-white dark:bg-[#0e1726] h-full">
                <div class="flex justify-between items-center px-4 py-3 mb-2">
                    <!-- <div class="flex items-center px-1 py-1">
                        <div class="flex-none">
                            <img class="rounded-2xl size-11 object-cover" src="/public/assets/images/user-profile.jpeg"
                                alt="" />
                        </div>
                        <div class="ltr:pl-4 rtl:pr-4">
                            <h4 class="text-sm font-bold">
                                John Doe
                                <span class="text-xs bg-success-light rounded text-success px-1 mx-1">Pro</span>
                            </h4>
                            <p class="text-black/60 dark:text-dark-light/60">
                                Admin
                            </p>
                        </div>
                    </div> -->
                    <div class="main-logo flex items-center shrink-0">
                        <img class="w-8 ml-[5px] flex-none" :src="'/img/logo/full_logo.png'" alt="" />
                        <span
                            class="text-2xl ms-3 font-semibold align-middle lg:inline dark:text-white-light">
                            {{ $t('nav.logo') }}
                        </span>
                    </div>

                    <button type="button"
                        class="collapse-icon w-8 h-8 rounded-full flex items-center hover:bg-gray-500/10 dark:hover:bg-dark-light/10 dark:text-white-light transition duration-300 rtl:rotate-180 hover:text-primary"
                        @click="toggleMobileMenu">
                        <svg class="w-5 h-5 m-auto rotate-180 lg:rotate-0" width="20" height="20" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M13 19L7 12L13 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path opacity="0.5" d="M16.9998 19L10.9998 12L16.9998 5" stroke="currentColor"
                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </button>
                </div>
                <perfect-scrollbar :options="{
                    swipeEasing: true,
                    wheelPropagation: false,
                }" class="h-[calc(100vh-80px)] relative">
                    <ul class="relative font-semibold space-y-0.5 p-4 py-0">

                        <li class="menu nav-item">
                            <Link :href="route('control.dashboard')" class="nav-link group w-full"
                                :class="{ active: $page.component === 'Dashboard' }">
                            <div class="flex items-center">
                                <Svg name="home_angle" class="size-5"></Svg>

                                <span
                                    class="ltr:pl-3 rtl:pr-3 text-black dark:text-[#7d96c5] dark:group-hover:text-white-dark">
                                    {{ $t('nav.dashboard') }}
                                </span>
                            </div>
                            </Link>
                        </li>

                        <h2
                            class="py-3 px-7 flex items-center uppercase font-extrabold bg-white-light/30 dark:bg-dark dark:bg-opacity-[0.08] -mx-4 mb-1">
                            <svg class="w-4 h-5 flex-none hidden" viewBox="0 0 24 24" stroke="currentColor"
                                stroke-width="1.5" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                            </svg>
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

                        <h2
                            class="py-3 px-7 flex items-center uppercase font-extrabold bg-white-light/30 dark:bg-dark dark:bg-opacity-[0.08] -mx-4 mb-1">
                            <svg class="w-4 h-5 flex-none hidden" viewBox="0 0 24 24" stroke="currentColor"
                                stroke-width="1.5" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                            </svg>
                            <span>{{ $t('nav.system') }}</span>
                        </h2>

                        <li class="nav-item">
                            <ul>
                                <li v-if="$can('view_users')" class="nav-item">
                                    <Link :href="route('control.system.users.index')"
                                        class="nav-link group w-full"
                                        :class="{ active: $page.component === 'Users/Index' }">
                                    <div class="flex items-center">
                                        <Svg name="user" class="size-5"></Svg>

                                        <span
                                            class="ltr:pl-3 rtl:pr-3 text-black dark:text-[#7d96c5] dark:group-hover:text-white-dark">
                                            {{ $t('nav.users') }}
                                        </span>
                                    </div>
                                    </Link>
                                </li>
                                <li v-if="false" class="nav-item">
                                    <Link :href="route('control.system.permissions.index')" class="nav-link group w-full"
                                        :class="{ active: $page.component === 'Permissions' }">
                                    <div class="flex items-center">
                                        <Svg name="user" class="size-5"></Svg>

                                        <span
                                            class="ltr:pl-3 rtl:pr-3 text-black dark:text-[#7d96c5] dark:group-hover:text-white-dark">
                                            {{ $t('nav.permissions') }}
                                        </span>
                                    </div>
                                    </Link>
                                </li>
                                <li v-if="false" class="nav-item">
                                    <Link :href="route('control.system.roles.index')" class="nav-link group w-full"
                                        :class="{ active: $page.component === 'Roles' }">
                                    <div class="flex items-center">
                                        <Svg name="user" class="size-5"></Svg>

                                        <span
                                            class="ltr:pl-3 rtl:pr-3 text-black dark:text-[#7d96c5] dark:group-hover:text-white-dark">
                                            {{ $t('nav.roles') }}
                                        </span>
                                    </div>
                                    </Link>
                                </li>
                            </ul>
                        </li>

                    </ul>
                </perfect-scrollbar>
            </div>
        </nav>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { Link } from '@inertiajs/vue3';
import VueCollapsible from 'vue-height-collapsible/vue3';
import { getDefaultSettings } from '@/settings.js';

const settings = getDefaultSettings();
const emits = defineEmits();

const sidebar = ref(settings.sidebar);
const semidark = settings.semidark;
const activeDropdown = ref(getPath());
const subActive = ref(getPath());

const toggleMobileMenu = () => {
    if (window.innerWidth < 1024) {
        sidebar.value = !sidebar.value;
    }
    emits('toggleSidebar');
};

function getPath() {
    const currentPath = window.location.pathname;
    const lastSlashIndex = currentPath.lastIndexOf('/');

    if (lastSlashIndex !== -1)
        return currentPath.substring(0, lastSlashIndex);
}
</script>
