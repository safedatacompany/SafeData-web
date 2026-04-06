import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import i18n from 'laravel-vue-i18n/vite';
import vue from '@vitejs/plugin-vue';
import svgLoader from 'vite-svg-loader'

export default defineConfig({
    base: '/build/',
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        vue(),
        i18n(),
        svgLoader(),
    ],
    resolve: {
        alias: {
            '@': '/resources/js',
            '@resources': '/resources',
            '@Components': '/resources/js/Components',
        },
    },
    optimizeDeps: {
        include: ['quill', 'swiper', 'maska'],
    },
    build: {
        rollupOptions: {
            output: {
                manualChunks(id) {
                    if (!id.includes('node_modules')) {
                        return;
                    }

                    if (id.includes('apexcharts') || id.includes('vue3-apexcharts')) {
                        return 'vendor-charts';
                    }

                    if (id.includes('lottie-web-light')) {
                        return 'vendor-lottie';
                    }

                    if (id.includes('swiper')) {
                        return 'vendor-swiper';
                    }

                    if (id.includes('floating-vue') || id.includes('@floating-ui') || id.includes('tippy')) {
                        return 'vendor-popovers';
                    }

                    if (id.includes('notivue')) {
                        return 'vendor-notifications';
                    }

                    return 'vendor';
                },
            },
        },
    },
});
