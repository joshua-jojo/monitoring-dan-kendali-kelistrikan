<template>
    <div class="h-screen flex flex-col">
        <div class="navbar bg-base-100">
            <div class="flex-1">
                <a class="btn btn-ghost normal-case text-xl">daisyUI</a>
            </div>
            <div class="flex-none">
                <ul class="menu menu-horizontal px-1">
                    <li><a>Link</a></li>
                    <li>
                        <details>
                            <summary>Parent</summary>
                            <ul class="p-2 bg-base-100">
                                <li><a>Link 1</a></li>
                                <li><a>Link 2</a></li>
                            </ul>
                        </details>
                    </li>
                </ul>
            </div>
        </div>
        <div class="h-full bg-base-300 flex gap-4">
            <div class="h-full py-4 px-2">
                <ul class="menu bg-base-200 w-56 rounded-box">
                    <li>
                        <h2 class="menu-title">Dashboard</h2>
                        <ul>
                            <li @click="dashboard"><a>Dashboard</a></li>
                        </ul>
                    </li>
                    <li>
                        <h2 class="menu-title">Data</h2>
                        <ul>
                            <li><a @click="perangkat">Perangkat</a></li>
                            <li @click="monitoring"><a>Monitoring</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="card bg-base-200 my-4 w-full mr-4">
                <div class="card-body">
                    <slot></slot>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { router } from "@inertiajs/vue3";

export default {
    methods: {
        monitoring() {
            router.get(route("monitoring.index"));
        },
        dashboard() {
            router.get(route("dashboard.index"));
        },
        perangkat() {
            router.get(route("perangkat.index"));
        },
    },
};
</script>
