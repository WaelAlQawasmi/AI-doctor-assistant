import { defineConfig } from 'vite';
import vue from '@vitejs/plugin-vue'
import { fileURLToPath } from 'url'; // Importing from 'url' instead of 'node:url'
import path from 'path'; // Importing 'path' for file path handling
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    publicPath: '/',
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        vue(),
    ],
    resolve: {
        alias: {
            vue: 'vue/dist/vue.esm-bundler.js',
            '@': fileURLToPath(new URL('./resources/js/vueApp', import.meta.url))
        },
    }
});


