<template>

    <header class="fixed top-5 !z-50 flex flex-wrap lg:justify-start lg:flex-nowrap w-full text-white text-sm py-4">
        <nav
            class="container 2xl:max-w-[100rem] w-full mx-auto px-4 flex flex-wrap basis-full items-center justify-between">
            <div v-motion :initial="{ opacity: 0, y: -100 }" :enter="{ opacity: 1, y: 0, }" :delay="300"
                :duration="1200">
                <img :src="'img/logo/symbol_logo.png'" alt="Safe Data Company logo" class="w-10 md:w-12">
            </div>
            <div class="lg:order-3 flex items-center gap-x-2">

                <div class="inline-flex lg:hidden">

                    <!-- Button Menu -->
                    <div v-motion :initial="{ opacity: 0, y: -100 }" :enter="{ opacity: 1, y: 0, }" :delay="300"
                        :duration="600" class="menu__trigger js-menu-trigger relative"><span>MENU</span></div>
                    <!-- End Button Menu -->

                    <!--Menu-->
                    <NavMobile />
                    <!--/Menu-->

                </div>

                <!-- Button -->
                <div v-motion :initial="{ opacity: 0, y: -100 }" :enter="{ opacity: 1, y: 0, }" :delay="300"
                    :duration="1200">
                    <div
                        class="button-nav hidden lg:flex flex-col items-center justify-center bg-white/10 shadow-none rounded-full overflow-hidden">
                        <a href="#about" @click.prevent="changePage('about')"
                            class="primary-button-nav w-full relative group py-2.5 px-3.5 cursor-none rounded-full text-sm">
                            <span class="relative z-20">Contact</span>
                            <span class="round" />
                        </a>
                    </div>
                </div>
                <!-- End Button -->
            </div>
            <div id="navbar-alignment"
                class="hidden overflow-hidden transition-all duration-300 basis-full grow lg:grow-0 lg:basis-auto lg:block lg:order-2">
                <div class="hoverable black flex flex-col lg:flex-row lg:items-center py-3">
                    <a v-motion :initial="{ opacity: 0, y: -100 }" :enter="{ opacity: 1, y: 0, }" :delay="300"
                        :duration="1200" href="#home" @click.prevent="changePage('home')"
                        class=".btn-nav px-5 font-normal cursor-none">
                        Home
                    </a>
                    <a v-motion :initial="{ opacity: 0, y: -100 }" :enter="{ opacity: 1, y: 0, }" :delay="300"
                        :duration="1200" href="#products" @click.prevent="changePage('products')"
                        class=".btn-nav px-5 font-normal cursor-none">
                        Products
                    </a>
                    <a v-motion :initial="{ opacity: 0, y: -100 }" :enter="{ opacity: 1, y: 0, }" :delay="300"
                        :duration="1200" href="#services" @click.prevent="changePage('services')"
                        class=".btn-nav px-5 font-normal cursor-none">
                        Services
                    </a>
                    <a v-motion :initial="{ opacity: 0, y: -100 }" :enter="{ opacity: 1, y: 0, }" :delay="300"
                        :duration="1200" href="#hosting" @click.prevent="changePage('hosting')"
                        class=".btn-nav px-5 font-normal cursor-none">
                        Web Hosting
                    </a>
                    <a v-motion :initial="{ opacity: 0, y: -100 }" :enter="{ opacity: 1, y: 0, }" :delay="300"
                        :duration="1200" href="#clients" @click.prevent="changePage('clients')"
                        class=".btn-nav px-5 font-normal cursor-none">
                        Clients
                    </a>
                    <a v-motion :initial="{ opacity: 0, y: -100 }" :enter="{ opacity: 1, y: 0, }" :delay="300"
                        :duration="1200" href="#about" @click.prevent="changePage('about')"
                        class=".btn-nav px-5 font-normal cursor-none">
                        About
                    </a>
                    <!-- Change Mouse -->
                    <GeneralMouse />
                </div>
            </div>
        </nav>
    </header>

</template>

<script setup>
import { onMounted } from 'vue'
import GeneralMouse from './GeneralMouse.vue';
import NavMobile from './NavMobile.vue';

const changePage = (sectionId) => {
    const element = document.getElementById(sectionId) || document.getElementsByClassName(sectionId)[0];

    if (!element) {
        return;
    }

    var lastPoint = 70;
    if (sectionId === 'about' || sectionId === 'sixth') {
        lastPoint = 0;
    }

    const elementPosition = element.getBoundingClientRect().top + window.pageYOffset;
    const offsetPosition = elementPosition - lastPoint;

    window.scrollTo({
        top: offsetPosition,
        behavior: 'smooth'
    });
}

onMounted(() => {
    // Button Contact
    let button = document.querySelector(".primary-button-nav");
    let item = document.querySelector(".primary-button-nav .round");

    button.addEventListener("mouseenter", function (event) {
        this.classList += " animate";

        let buttonX = event.offsetX;
        let buttonY = event.offsetY;

        if (buttonY < 24) {
            item.style.top = 0 + "px";
        } else if (buttonY > 30) {
            item.style.top = 48 + "px";
        }

        item.style.left = buttonX + "px";
        item.style.width = "1px";
        item.style.height = "1px";
    });

    button.addEventListener("mouseleave", function () {
        this.classList.remove("animate");

        let buttonX = event.offsetX;
        let buttonY = event.offsetY;

        if (buttonY < 24) {
            item.style.top = 0 + "px";
        } else if (buttonY > 30) {
            item.style.top = 48 + "px";
        }
        item.style.left = buttonX + "px";
    });
})
</script>

<style>
.button-nav .primary-button-nav .round {
    position: absolute;
    top: -1px;
    left: 10px;
    z-index: 10;
    border-radius: 100%;
    animation: scale-down-nav 0.8s forwards;
}

.button-nav .primary-button-nav.animate .round {
    animation: scale-up-nav 0.8s forwards;
}

@keyframes scale-up-nav {
    to {
        transform: scale(200);
        background-color: rgb(206 132 64);
    }
}

@keyframes scale-down-nav {
    from {
        transform: scale(200);
        background-color: rgb(206 132 64);
    }

    to {
        transform: scale(0);
        background-color: rgb(206 132 64 / 0.05);
    }
}
</style>