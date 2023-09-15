<template lang="">
    <div class="flex flex-col gap-4">
        <div class="flex justify-between gap-4">
            <label for="tambah" class="btn btn-sm btn-success">
                <i class="fa fa-plus"></i>
                tambah
            </label>
        </div>

        <div class="overflow-x-auto w-full">
            <div class="overflow-x-auto">
                <table class="table table-zebra">
                    <!-- head -->
                    <thead>
                        <tr>
                            <th></th>
                            <th class="text-center">Nama</th>
                            <th>Role</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- row 1 -->
                        <tr v-for="(item, index) in user" :key="index">
                            <td>{{ index + 1 }}</td>
                            <td class="text-center">{{ item.nama }}</td>
                            <td class="capitalize">{{ item.role }}</td>
                            <td>
                                <div class="flex w-max gap-2">
                                    <label
                                        @click="edit_data(item)"
                                        for="edit"
                                        class="btn btn-sm btn-warning"
                                    >
                                        <i class="fa fa-pen"></i>
                                        Edit
                                    </label>
                                    <label
                                        @click="data_hapus(item)"
                                        for="hapus"
                                        class="btn btn-sm btn-error"
                                    >
                                        <i class="fa fa-trash"></i>
                                        Hapus
                                    </label>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- tambah  -->
    <input type="checkbox" id="tambah" class="modal-toggle" />
    <div class="modal">
        <div class="modal-box">
            <h3 class="font-bold text-lg">Tambah User</h3>
            <div class="py-4">
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Nama User</span>
                    </label>
                    <input
                        type="text"
                        class="input input-bordered input-sm"
                        v-model="form_tambah.nama"
                        placeholder="Masukkan Nama User"
                    />
                    <label class="label" v-if="form_tambah.errors.nama">
                        <span class="label-text-alt text-error">{{
                            form_tambah.errors.nama
                        }}</span>
                    </label>
                </div>
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Username</span>
                    </label>
                    <input
                        type="text"
                        class="input input-bordered input-sm"
                        v-model="form_tambah.username"
                        placeholder="Masukkan Username User"
                    />
                    <label class="label" v-if="form_tambah.errors.username">
                        <span class="label-text-alt text-error">{{
                            form_tambah.errors.username
                        }}</span>
                    </label>
                </div>
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Role User</span>
                    </label>
                    <select
                        class="select select-bordered w-full select-sm"
                        v-model="form_tambah.role"
                    >
                        <option value="admin">ADMIN</option>
                        <option value="user">USER</option>
                    </select>
                    <label class="label" v-if="form_tambah.errors.role">
                        <span class="label-text-alt text-error">{{
                            form_tambah.errors.role
                        }}</span>
                    </label>
                </div>
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Password</span>
                    </label>
                    <input
                        type="password"
                        class="input input-bordered input-sm"
                        v-model="form_tambah.password"
                        placeholder="Masukkan Password"
                    />
                    <label class="label" v-if="form_tambah.errors.password">
                        <span class="label-text-alt text-error">{{
                            form_tambah.errors.password
                        }}</span>
                    </label>
                </div>

                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Konfirmasi Password</span>
                    </label>
                    <input
                        type="password"
                        class="input input-bordered input-sm"
                        v-model="form_tambah.password_confirmation"
                        placeholder="Konfirmasi Password"
                    />
                    <label
                        class="label"
                        v-if="form_tambah.errors.password_confirmation"
                    >
                        <span class="label-text-alt text-error">{{
                            form_tambah.errors.password_confirmation
                        }}</span>
                    </label>
                </div>
            </div>
            <div class="modal-action">
                <button
                    class="btn btn-success"
                    @click="submit_tambah"
                    :disabled="form_tambah.processing"
                >
                    <span
                        class="loading loading-spinner loading-sm"
                        v-if="form_tambah.processing"
                    ></span>
                    Tambah
                </button>
                <label for="tambah" class="btn">Close</label>
            </div>
        </div>
    </div>

    <!-- edit  -->
    <input type="checkbox" id="edit" class="modal-toggle" />
    <div class="modal">
        <div class="modal-box">
            <h3 class="font-bold text-lg">Edit User</h3>
            <div class="py-4">
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Nama User</span>
                    </label>
                    <input
                        type="text"
                        class="input input-bordered input-sm"
                        v-model="form_edit.nama"
                        placeholder="Masukkan Nama User"
                    />
                    <label class="label" v-if="form_edit.errors.nama">
                        <span class="label-text-alt text-error">{{
                            form_edit.errors.nama
                        }}</span>
                    </label>
                </div>
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Username</span>
                    </label>
                    <input
                        type="text"
                        class="input input-bordered input-sm"
                        v-model="form_edit.username"
                        placeholder="Masukkan Username User"
                    />
                    <label class="label" v-if="form_edit.errors.username">
                        <span class="label-text-alt text-error">{{
                            form_edit.errors.username
                        }}</span>
                    </label>
                </div>
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Role User</span>
                    </label>
                    <select
                        class="select select-bordered w-full select-sm"
                        v-model="form_edit.role"
                    >
                        <option value="admin">ADMIN</option>
                        <option value="user">USER</option>
                    </select>
                    <label class="label" v-if="form_edit.errors.role">
                        <span class="label-text-alt text-error">{{
                            form_edit.errors.role
                        }}</span>
                    </label>
                </div>
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Password</span>
                    </label>
                    <input
                        type="password"
                        class="input input-bordered input-sm"
                        v-model="form_edit.password"
                        placeholder="Masukkan Password"
                    />
                    <label class="label" v-if="form_edit.errors.password">
                        <span class="label-text-alt text-error">{{
                            form_edit.errors.password
                        }}</span>
                    </label>
                </div>

                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Konfirmasi Password</span>
                    </label>
                    <input
                        type="password"
                        class="input input-bordered input-sm"
                        v-model="form_edit.password_confirmation"
                        placeholder="Konfirmasi Password"
                    />
                    <label
                        class="label"
                        v-if="form_edit.errors.password_confirmation"
                    >
                        <span class="label-text-alt text-error">{{
                            form_edit.errors.password_confirmation
                        }}</span>
                    </label>
                </div>
            </div>
            <div class="modal-action">
                <button
                    class="btn btn-warning"
                    @click="submit_edit"
                    :disabled="form_edit.processing"
                >
                    <span
                        class="loading loading-spinner loading-sm"
                        v-if="form_edit.processing"
                    ></span>
                    Edit
                </button>
                <label for="edit" class="btn">Close</label>
            </div>
        </div>
    </div>

    <!-- hapus  -->
    <input type="checkbox" id="hapus" class="modal-toggle" />
    <div class="modal">
        <div class="modal-box">
            <h3 class="font-bold text-lg">Hapus User</h3>
            <div class="py-4">
                Hapus user <b>{{form_hapus.nama}}</b>.
            </div>
            <div class="modal-action">
                <button
                    class="btn btn-error"
                    @click="submit_hapus"
                    :disabled="form_hapus.processing"
                >
                    <span
                        class="loading loading-spinner loading-sm"
                        v-if="form_hapus.processing"
                    ></span>
                    hapus
                </button>
                <label for="hapus" class="btn">Close</label>
            </div>
        </div>
    </div>
</template>
<script>
import { useForm } from "@inertiajs/vue3";
import layout_page from "../../layout/layout_page.vue";
export default {
    layout: layout_page,
    props: {
        user: Array,
    },
    setup() {
        const form_tambah = useForm({
            nama: "",
            username: "",
            role: "user",
            password: "",
            password_confirmation: "",
        });
        const form_edit = useForm({
            id: null,
            nama: "",
            username: "",
            role: "user",
            password: "",
            password_confirmation: "",
        });

        const form_hapus = useForm({
            id: null,
            nama: "",
        });
        return {
            form_tambah,
            form_edit,
            form_hapus,
        };
    },
    methods: {
        submit_tambah() {
            this.form_tambah.post(route("settings.user.post"), {
                onSuccess: () => {
                    document.getElementById("tambah").click();
                    this.form_tambah.reset();
                },
            });
        },
        edit_data(data){
            this.form_edit.id = data.id
            this.form_edit.nama = data.nama
            this.form_edit.username = data.username
            this.form_edit.role = data.role
        },
        submit_edit() {
            this.form_edit.post(route("settings.user.edit"), {
                onSuccess: () => {
                    document.getElementById("edit").click();
                    this.form_edit.reset();
                },
            });
        },
        data_hapus(data){
            this.form_hapus.id = data.id
            this.form_hapus.nama = data.nama
        },
        submit_hapus() {
            this.form_hapus.post(route("settings.user.hapus"), {
                onSuccess: () => {
                    document.getElementById("hapus").click();
                    this.form_hapus.reset();
                },
            });
        },
    },
};
</script>
<style lang=""></style>
