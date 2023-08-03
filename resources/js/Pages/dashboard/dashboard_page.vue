<template lang="">
    <div class="grid grid-cols-2 gap-4">
        <div
            class="card shadow-2xl bg-base-100"
            v-for="(item, index) in data_perangkat"
            :key="index"
        >
            <div class="card-body">
                <div class="flex justify-between">
                    <div class="text-lg capitalize font-bold">
                        {{ item.perangkat }}
                    </div>
                    <div class="flex gap-2">
                        <div class="">OFF</div>
                        <input
                            type="checkbox"
                            class="toggle toggle-success"
                            :checked="
                                item.kondisi == 'hidup' || item.kondisi == true
                            "
                            v-model="item.kondisi"
                            @change="status_perangkat(item)"
                        />
                        <div class="">ON</div>
                    </div>
                </div>
                <div :id="item.perangkat">
                    <apexchart
                        height="200"
                        :options="item.chartOptions"
                        :series="item.series"
                    ></apexchart>
                </div>
                <div class="w-full">
                    <table class="">
                        <tbody>
                            <tr>
                                <td>Daya Pakai</td>
                                <td class="pl-4">: {{ item.daya }} Watt</td>
                            </tr>
                            <tr>
                                <td>Status Perangkat</td>
                                <td class="pl-4">
                                    :
                                    <span
                                        class="badge badge-success"
                                        v-if="
                                            item.kondisi == 'hidup' ||
                                            item.kondisi == true
                                        "
                                        >HIDUP</span
                                    >
                                    <span class="badge badge-error" v-else
                                        >MATI</span
                                    >
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import Layout_page from "../../layout/layout_page.vue";
import { router } from "@inertiajs/vue3";

export default {
    layout: Layout_page,
    props: ["list_perangkat"],
    data() {
        return {
            data_perangkat: this.list_perangkat.map((e) => {
                e.kondisi = e.kondisi == "hidup" ? true : false;
                return e;
            }),
        };
    },
    created() {
        this.$echo.channel("bang-wahyu").listen(".info-perangkat", (e) => {
            const id = e.id;
            const data_baru = [e.date, e.data];

            const perangkat_aktif = this.data_perangkat.findIndex(
                (perangkat) => perangkat.id == id
            );
            const data_lama =
                this.data_perangkat[perangkat_aktif].series[0].data;
            this.data_perangkat[perangkat_aktif].series[0].data.push(data_baru);
            this.data_perangkat[perangkat_aktif].daya = e.data;
        });

        this.$echo.channel("bang-wahyu").listen(".status-perangkat", (e) => {
            const perangkat_aktif = this.data_perangkat.findIndex(
                (perangkat) => perangkat.id == e.id
            );
            this.data_perangkat[perangkat_aktif].kondisi = e.kondisi;
        });
    },
    methods: {
        status_perangkat(data) {
            const form = { ...data };
            const kondisi = form.kondisi == true ? "hidup" : "mati";
            form.kondisi = kondisi;
            router.put(
                route("perangkat.update", {
                    id: form.id,
                }),
                form
            );
        },
    },
};
</script>
<style lang=""></style>
