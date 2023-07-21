<template lang="">
    <div class="flex gap-4 flex-col">
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
                            <th>Nama Perangkat</th>
                            <th>Kondisi</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- row 1 -->
                        <tr v-for="(item, index) in perangkat" :key="index">
                            <th>{{ index + 1 }}</th>
                            <td class="capitalize">{{ item.perangkat }}</td>
                            <td class="font-semibold">
                                <div
                                    class="badge badge-success"
                                    v-if="item.kondisi == 'hidup'"
                                >
                                    Hidup
                                </div>
                                <div class="badge badge-error" v-else>Mati</div>
                            </td>
                            <td>
                                <div class="flex w-max gap-2">
                                    <label
                                        @click="data_edit(item)"
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
            <h3 class="font-bold text-lg">Tambah Perangkat</h3>
            <div class="py-4">
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Perangkat</span>
                    </label>
                    <input
                        type="text"
                        class="input input-bordered input-sm"
                        v-model="form_tambah.perangkat"
                        placeholder="Masukkan Nama Perangkat"
                    />
                    <label class="label" v-if="form_tambah.errors.perangkat">
                        <span class="label-text-alt text-error">{{
                            form_tambah.errors.perangkat
                        }}</span>
                    </label>
                </div>
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Kondisi Perangkat</span>
                    </label>
                    <select
                        class="select select-bordered w-full select-sm"
                        v-model="form_tambah.kondisi"
                    >
                        <option value="hidup">Hidup</option>
                        <option value="mati">Mati</option>
                    </select>
                    <label class="label" v-if="form_tambah.errors.kondisi">
                        <span class="label-text-alt text-error">{{
                            form_tambah.errors.kondisi
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
            <h3 class="font-bold text-lg">Edit Perangkat</h3>
            <div class="py-4">
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Perangkat</span>
                    </label>
                    <input
                        type="text"
                        class="input input-bordered input-sm"
                        v-model="form_edit.perangkat"
                        placeholder="Masukkan Nama Perangkat"
                    />
                    <label class="label" v-if="form_edit.errors.perangkat">
                        <span class="label-text-alt text-error">{{
                            form_edit.errors.perangkat
                        }}</span>
                    </label>
                </div>
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Kondisi Perangkat</span>
                    </label>
                    <select
                        class="select select-bordered w-full select-sm"
                        v-model="form_edit.kondisi"
                    >
                        <option value="hidup">Hidup</option>
                        <option value="mati">Mati</option>
                    </select>
                    <label class="label" v-if="form_edit.errors.kondisi">
                        <span class="label-text-alt text-error">{{
                            form_edit.errors.kondisi
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
                    edit
                </button>
                <label for="edit" class="btn">Close</label>
            </div>
        </div>
    </div>
</template>
<script>
import { useForm } from "@inertiajs/vue3";
import Layout_page from "../../../layout/layout_page.vue";

export default {
    layout: Layout_page,
    props: ["perangkat"],
    setup() {
        const form_tambah = useForm({
            perangkat: "",
            kondisi: "mati",
        });

        const form_edit = useForm({
            id: null,
            perangkat: "",
            kondisi: "mati",
        });

        const form_hapus = useForm({
            id: null,
            perangkat: "",
        });
        return {
            form_tambah,
            form_edit,
            form_hapus,
        };
    },
    methods: {
        submit_tambah() {
            this.form_tambah.post(route("perangkat.store"), {
                onSuccess: () => {
                    document.getElementById("tambah")?.click();
                    this.form_tambah.reset();
                },
            });
        },
        data_edit(data){
            this.form_edit.id = data.id
            this.form_edit.perangkat = data.perangkat
            this.form_edit.status = data.status
        },
        submit_edit() {
            this.form_edit.put(route("perangkat.update",{id : this.form_edit.id}), {
                onSuccess: () => {
                    document.getElementById("edit")?.click();
                    this.form_edit.reset();
                },
            });
        },
        data_hapus(data){
            this.form_hapus.id = data.id
            this.form_hapus.perangkat = data.perangkat
        },
        submit_hapus() {
            this.form_hapus.delete(route("perangkat.destroy",{id : this.form_hapus.id}), {
                onSuccess: () => {
                    document.getElementById("hapus")?.click();
                    this.form_hapus.reset();
                },
            });
        },
    },
};
</script>
<style lang=""></style>
