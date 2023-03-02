import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import i18n from 'laravel-vue-i18n/vite';
import vue from '@vitejs/plugin-vue';
import { resolve } from 'path';

export default defineConfig({
    plugins: [
        laravel({
            input: 'resources/js/app.js',
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
        i18n(),
    ],

    resolve: {
        alias : {
          "icons": resolve(__dirname, "node_modules/vue-material-design-icons")
        }
      }
});
