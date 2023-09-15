<template lang="">
    <div class="min-h-screen flex justify-center items-center" data-aos="fade-up">
        <div class="h-screen w-full z-0">
            <img src="../../assets/pelabuhan.jpeg" alt="" srcset="" class='object-cover h-full'>
        </div>
        <div class="max-w-sm w-full h-full flex justify-center items-center z-10">
            <form
                class="overflow-hidden w-full max-w-xs bg-white rounded shadow-lg text-slate-500 shadow-slate-200"
                @submit.prevent="submit"
            >
                <!-- Body-->
                <div class="p-6">
                    <header class="mb-4 text-center">
                        <h3 class="text-xl font-medium text-slate-700">
                            Login
                        </h3>
                    </header>
                    <div class="flex flex-col space-y-8">
                        <!-- Input field -->
                        <div class="relative my-6">
                            <input
                                id="username"
                                type="text"
                                name="username"
                                placeholder="your name"
                                required
                                v-model="LoginForm.username"
                                class="relative w-full h-10 px-4 text-sm placeholder-transparent transition-all border rounded outline-none peer border-slate-200 text-slate-500 autofill:bg-white focus:border-neutral-500 focus:outline-none disabled:cursor-not-allowed disabled:bg-slate-50 disabled:text-slate-400"
                            />
                            <label
                                for="username"
                                class="absolute left-2 -top-2 z-[1] px-2 text-xs text-slate-400 transition-all before:absolute before:top-0 before:left-0 before:z-[-1] before:block before:h-full before:w-full before:bg-white before:transition-all peer-placeholder-shown:top-2.5 peer-placeholder-shown:text-sm peer-required:after:content-['\00a0*'] peer-focus:-top-2 peer-focus:text-xs peer-focus:text-neutral-500 peer-disabled:cursor-not-allowed peer-disabled:text-slate-400 peer-disabled:before:bg-transparent"
                            >
                                Username
                            </label>
                            <small
                                class="absolute flex justify-between w-full px-4 py-1 text-xs transition text-slate-400 peer-invalid:text-pink-500"
                            >
                                <span class="text-red-500 capitalize">{{
                                    LoginForm.errors.username
                                }}</span>
                            </small>
                        </div>
                        <!-- Input field -->
                        <div class="relative my-6">
                            <input
                                id="password"
                                type="password"
                                name="password"
                                placeholder="your password"
                                required
                                v-model="LoginForm.password"
                                class="relative w-full h-10 px-4 text-sm placeholder-transparent transition-all border rounded outline-none peer border-slate-200 text-slate-500 autofill:bg-white focus:border-neutral-500 focus:outline-none disabled:cursor-not-allowed disabled:bg-slate-50 disabled:text-slate-400"
                            />
                            <label
                                for="password"
                                class="absolute left-2 -top-2 z-[1] px-2 text-xs text-slate-400 transition-all before:absolute before:top-0 before:left-0 before:z-[-1] before:block before:h-full before:w-full before:bg-white before:transition-all peer-placeholder-shown:top-2.5 peer-placeholder-shown:text-sm peer-required:after:content-['\00a0*'] peer-focus:-top-2 peer-focus:text-xs peer-focus:text-neutral-500 0 peer-disabled:cursor-not-allowed peer-disabled:text-slate-400 peer-disabled:before:bg-transparent"
                            >
                                Password
                            </label>
                            <small
                                class="absolute flex justify-between w-full px-4 py-1 text-xs transition text-slate-400 peer-invalid:text-pink-500"
                            >
                                <span>{{ LoginForm.errors.password }}</span>
                            </small>
                        </div>
                    </div>
                </div>
                <!-- Action base sized basic button -->
                <div class="flex justify-end p-6">
                    <button
                        class="inline-flex items-center justify-center w-full h-10 gap-2 px-5 text-sm font-medium tracking-wide text-white transition duration-300 rounded focus-visible:outline-none whitespace-nowrap bg-emerald-500 hover:bg-emerald-600 focus:bg-emerald-700 disabled:cursor-not-allowed disabled:border-emerald-300 disabled:bg-emerald-300 disabled:shadow-none"
                    >
                        <span>Log in</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>
<script setup>
import { useForm } from "@inertiajs/vue3";
import { ref } from "vue";
const password_hide = ref(false);

const LoginForm = useForm({
    username: "",
    password: "",
});

const submit = () => {
    LoginForm.post(route("login.submit"));
};
</script>
<style lang=""></style>
