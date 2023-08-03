<template>
    <div class="h-screen flex flex-col overflow-hidden">
        <div class="navbar bg-base-100 h-max">
            <div class="flex-1">
                <a class="btn btn-ghost normal-case text-xl">daisyUI</a>
            </div>

        </div>
        <div class="h-full bg-base-200 flex gap-4">
            <div class="h-full py-4 px-2">
                <ul class="menu bg-base-100 w-56 rounded-box">
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
            <div class="py-4 w-full pr-4 pb-[90px] h-full overflow-hidden">
                <div
                    class="card bg-base-100 h-full overflow-y-auto"
                >
                    <div class="card-body">
                        <slot></slot>
                    </div>
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
