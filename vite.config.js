import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import i18n from 'laravel-vue-i18n/vite';
import vue from '@vitejs/plugin-vue';
import svgLoader from 'vite-svg-loader'

export default defineConfig({
    base: '/',
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
});
