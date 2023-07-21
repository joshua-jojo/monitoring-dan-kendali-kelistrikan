import './bootstrap';

import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.es';
import { Ziggy } from './ziggy';
import route from 'ziggy-js';
import VueApexCharts from "vue3-apexcharts";
import Pusher from 'pusher-js';
import LaravelEcho from "laravel-echo-vue3"

import '@fortawesome/fontawesome-free/css/all.css'
import '@fortawesome/fontawesome-free/js/all.js'

const apiKey = '9a85ac4209727bd69743'
const cluster = 'ap1'

const options = {
    broadcaster: 'pusher',
    key: apiKey,
    cluster: cluster,
    forceTLS: true
}

createInertiaApp({
    resolve: name => {
        const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })
        return pages[`./Pages/${name}.vue`]
    },
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue, Ziggy)
            .use(VueApexCharts)
            .use(LaravelEcho,{
                ...options,
                client : new Pusher(options.key, options)
            })
            .mixin({ methods: { route } })
            .mount(el)
    },
})
