<template lang="">
    <div class="flex flex-col gap-4">
        <div class="flex justify-between">
            <div class="flex gap-2 items-center">
                <label class="label">
                    <span class="label-text">Tampilkan Dari</span>
                </label>
                <input
                    type="date"
                    v-model="filter_data.waktu_mulai"
                    class="input input-bordered input-xs"
                />
                <label class="label">
                    <span class="label-text">Sampai </span>
                </label>
                <input
                    type="date"
                    class="input input-bordered input-xs"
                    v-model="filter_data.waktu_selesai"
                />
            </div>
            <div class="flex items-center gap-2">
                <div class="flex gap-2 items-center">
                    <label class="label">
                        <span class="label-text">Pilih Perangkat</span>
                    </label>
                    <select
                        class="select select-xs select-bordered"
                        v-model="filter_data.perangkat"
                    >
                        <option :value="0" selected disabled>
                            Pilih Perangkat
                        </option>
                        <option
                            :value="item.id"
                            v-for="(item, index) in perangkat"
                            :key="index"
                        >
                            {{ item.perangkat }}
                        </option>
                    </select>
                </div>
                <div class="flex gap-2 items-center">
                    <label class="label">
                        <span class="label-text">Baris</span>
                    </label>
                    <select
                        class="select select-xs select-bordered"
                        v-model="filter_data.show"
                    >
                        <option value="" selected disabled>Pilih Baris</option>
                        <option :value="5">5 Baris</option>
                        <option :value="10">10 Baris</option>
                        <option :value="20">20 Baris</option>
                    </select>
                </div>
            </div>
        </div>

        <table class="table table-zebra">
            <thead>
                <tr>
                    <th></th>
                    <th>Nama Perangkat</th>
                    <th>Tanggal</th>
                    <th>Jam</th>
                    <th class="text-center">Tegangan</th>
                </tr>
            </thead>
            <tbody>
                <tr
                    v-for="(item, index) in statistik.data"
                    :key="item.id"
                    v-if="statistik.data.length"
                >
                    <td>
                        {{
                            (statistik.current_page - 1) * filter_data.show +
                            (index + 1)
                        }}
                    </td>
                    <td>{{ item?.perangkat?.perangkat }}</td>
                    <td>{{ item.tanggal }}</td>
                    <td>{{ item.jam }}</td>
                    <td class="text-center">{{ item.tegangan }} V</td>
                </tr>
                <tr v-else>
                    <td class="text-center font-bold" colspan="99">
                        Belum Ada Data!
                    </td>
                </tr>
            </tbody>
        </table>

        <div
            class="flex justify-center items-center"
            v-if="statistik.data.length"
        >
            <div class="join">
                <Link
                    as="button"
                    :href="item.url"
                    class="join-item btn btn-sm"
                    :class="{ 'btn-active': item.active }"
                    v-for="(item, index) in statistik.links"
                    :key="index"
                    :disabled="!item.url"
                    v-html="item.label"
                />
            </div>
        </div>
    </div>
</template>
<script>
import { router, Link } from "@inertiajs/vue3";
import Layout_page from "../../../layout/layout_page.vue";

export default {
    layout: Layout_page,
    props: ["perangkat", "statistik", "params"],
    components: {
        Link,
    },
    data() {
        return {
            filter_data: {
                perangkat: this.params.perangkat,
                show: this.params.show,
                cari: this.params.cari,
                waktu_mulai: this.params.waktu_mulai,
                waktu_selesai: this.params.waktu_selesai,
            },
        };
    },
    methods: {
        get_data() {
            router.get(route("monitoring.index"), this.filter_data, {
                preserveState: true,
            });
        },
    },
    watch: {
        "filter_data.perangkat"() {
            this.get_data();
        },
        "filter_data.show"() {
            this.get_data();
        },
        "filter_data.waktu_mulai"() {
            this.get_data();
        },
        "filter_data.waktu_selesai"() {
            this.get_data();
        },
    },
};
</script>
<style lang=""></style>
