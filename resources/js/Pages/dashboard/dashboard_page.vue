<template lang="">
    <div class="grid grid-cols-2 gap-4">
        <div
            class="card shadow-lg bg-base-100"
            v-for="(item, index) in data_perangkat"
            :key="index"
        >
            <div class="card-body">
                <div class="flex justify-between">
                    <div class="text-lg capitalize font-bold">
                        {{ item.perangkat }}
                    </div>
                </div>
                <div :id="item.perangkat" class="h-[150px] overflow-hidden">
                    <apexchart
                        height="100%"
                        :options="item.chartOptions"
                        :series="item.series"
                        :ref="`chart${item.id}`"
                    ></apexchart>
                </div>
                <div class="w-full flex justify-between items-center px-4">
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
                    <div class="font-hemi text-4xl">{{ item.daya }}V</div>
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

            this.data_perangkat[perangkat_aktif].daya = e.data;

            const id_perangkat = this.data_perangkat[perangkat_aktif].id;

            const refs_perangkat = this.$refs[`chart${id_perangkat}`][0]

            if(!refs_perangkat?.data_lama){
                refs_perangkat.data_lama = [...refs_perangkat.series[0].data]
            }

            const data_lama = refs_perangkat.data_lama
            if(data_lama.length >= 10){
                data_lama.shift()
            }
            data_lama.push(data_baru)
            refs_perangkat.updateSeries([{
              data: data_lama
            }])
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
