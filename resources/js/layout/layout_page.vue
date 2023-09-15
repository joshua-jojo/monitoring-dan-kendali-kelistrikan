<template>
    <div class="h-screen flex flex-col overflow-hidden">
        <div class="navbar bg-base-100 h-max shadow-black">
            <div class="flex-1 justify-between p-2">
                <div class="h-[35px]">
                    <img src="../assets/pelindo.png" class="h-full" />
                </div>
                <div class="">
                    <label class="swap swap-rotate">
                        <!-- this hidden checkbox controls the state -->
                        <input type="checkbox" v-model="tema" />

                        <!-- sun icon -->
                        <svg
                            class="swap-on fill-current w-10 h-7"
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                        >
                            <path
                                d="M5.64,17l-.71.71a1,1,0,0,0,0,1.41,1,1,0,0,0,1.41,0l.71-.71A1,1,0,0,0,5.64,17ZM5,12a1,1,0,0,0-1-1H3a1,1,0,0,0,0,2H4A1,1,0,0,0,5,12Zm7-7a1,1,0,0,0,1-1V3a1,1,0,0,0-2,0V4A1,1,0,0,0,12,5ZM5.64,7.05a1,1,0,0,0,.7.29,1,1,0,0,0,.71-.29,1,1,0,0,0,0-1.41l-.71-.71A1,1,0,0,0,4.93,6.34Zm12,.29a1,1,0,0,0,.7-.29l.71-.71a1,1,0,1,0-1.41-1.41L17,5.64a1,1,0,0,0,0,1.41A1,1,0,0,0,17.66,7.34ZM21,11H20a1,1,0,0,0,0,2h1a1,1,0,0,0,0-2Zm-9,8a1,1,0,0,0-1,1v1a1,1,0,0,0,2,0V20A1,1,0,0,0,12,19ZM18.36,17A1,1,0,0,0,17,18.36l.71.71a1,1,0,0,0,1.41,0,1,1,0,0,0,0-1.41ZM12,6.5A5.5,5.5,0,1,0,17.5,12,5.51,5.51,0,0,0,12,6.5Zm0,9A3.5,3.5,0,1,1,15.5,12,3.5,3.5,0,0,1,12,15.5Z"
                            />
                        </svg>

                        <!-- moon icon -->
                        <svg
                            class="swap-off fill-current w-10 h-7"
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                        >
                            <path
                                d="M21.64,13a1,1,0,0,0-1.05-.14,8.05,8.05,0,0,1-3.37.73A8.15,8.15,0,0,1,9.08,5.49a8.59,8.59,0,0,1,.25-2A1,1,0,0,0,8,2.36,10.14,10.14,0,1,0,22,14.05,1,1,0,0,0,21.64,13Zm-9.5,6.69A8.14,8.14,0,0,1,7.08,5.22v.27A10.15,10.15,0,0,0,17.22,15.63a9.79,9.79,0,0,0,2.1-.22A8.11,8.11,0,0,1,12.14,19.73Z"
                            />
                        </svg>
                    </label>
                </div>
            </div>
        </div>
        <div class="h-full bg-base-200 flex gap-4">
            <div class="h-full py-4 px-2">
                <ul class="menu bg-base-100 w-56 rounded-box shadow-lg">
                    <li>
                        <h2 class="menu-title">Dashboard</h2>
                        <ul>
                            <li @click="dashboard">
                                <a
                                    :class="{
                                        active:
                                            $page.component ==
                                            'dashboard/dashboard_page',
                                    }"
                                    >Dashboard</a
                                >
                            </li>
                        </ul>
                    </li>
                    <li>
                        <h2 class="menu-title">Data</h2>
                        <ul>
                            <li @click="perangkat">
                                <a
                                    :class="{
                                        active:
                                            $page.component ==
                                            'data/perangkat/perangkat_page',
                                    }"
                                    >Perangkat</a
                                >
                            </li>
                            <li @click="monitoring">
                                <a
                                    :class="{
                                        active:
                                            $page.component ==
                                            'data/monitoring/monitoring_page',
                                    }"
                                    >Monitoring</a
                                >
                            </li>
                        </ul>
                    </li>
                    <li>
                        <h2 class="menu-title">Settings</h2>
                        <ul>
                            <li @click="UserPage" v-if="otorisasi">
                                <a
                                    :class="{
                                        active:
                                            $page.component ==
                                            'settings/UserPage',
                                    }"
                                    >Manajemen User</a
                                >
                            </li>
                            <li @click="logout">
                                <a>Logout</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="py-4 w-full pr-4 pb-[90px] h-full overflow-hidden">
                <div class="card bg-base-100 h-full overflow-y-auto shadow-lg">
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
    props: {
        auth_status: Boolean,
        auth_user: Object,
    },
    setup() {
        const tema = localStorage.getItem("tema");
        const tag_tema = document.getElementById("tema");
        tag_tema.setAttribute("data-theme", tema ? tema : "light");
        return {
            get_tema: tema,
        };
    },
    data() {
        return {
            tema: this.get_tema == "night" ? false : true,
        };
    },
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
        set_tema(tema) {
            const tag_tema = document.getElementById("tema");
            tag_tema.setAttribute("data-theme", tema);
            localStorage.setItem("tema", tema);
        },
        logout() {
            router.post(route("logout"));
        },
        UserPage() {
            router.get(route("settings.user.index"));
        },
    },
    watch: {
        tema(baru) {
            if (baru) {
                this.set_tema("light");
            } else {
                this.set_tema("night");
            }
        },
    },
    computed : {
        otorisasi() {
            return (this.auth_user.role == "admin");
        },
    }
};
</script>
