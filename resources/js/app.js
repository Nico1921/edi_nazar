import './bootstrap';
import '../css/app.css';
import.meta.glob(['../images/**','../fonts/**',]);

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';
import { i18nVue } from 'laravel-vue-i18n';
import 'vue-material-design-icons/styles.css';
import 'floating-vue/dist/style.css';

const classBody = {
    paddingLg : "lg:pb-20",
    padding : "pb-10",
    height: "min-h-full",
    position: "relative"
};
const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Nazar EDI';
createInertiaApp({
 
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, app, props, plugin }) {
        el.classList.add(classBody.position);
        // el.classList.add(classBody.paddingLg);
        // el.classList.add(classBody.padding);
        el.classList.add(classBody.height);
        return createApp({ render: () => h(app, props) })
            .use(plugin)
            .use(ZiggyVue, Ziggy)
            .use(i18nVue, {
                fallbackLang : 'en',
                resolve: (lang) => import(`../../lang/${lang}.json`)
            })
            .mount(el);
    },
});

InertiaProgress.init({ color: '#4B5563' });
