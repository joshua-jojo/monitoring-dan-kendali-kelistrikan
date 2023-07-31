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
                            :checked="item.kondisi == 'hidup'"
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
                                <td>Daya Pakai </td>
                                <td class="pl-4"> : {{ item.daya }} Watt</td>
                            </tr>
                            <tr>
                                <td>Status Perangkat </td>
                                <td class="pl-4"> : 
                                    <span
                                        class="badge badge-success"
                                        v-if="item.kondisi == 'hidup'"
                                        >HIDUP</span
                                    >
                                    <span class="badge badge-error">MATI</span>
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

export default {
    layout: Layout_page,
    props: ["perangkat"],
    data() {
        return {
            data_perangkat: [...this.perangkat],
            testData: null,
        };
    },
    created() {
        this.$echo
            .channel("bang-wahyu")
            .listen(".info-perangkat", async (e) => {
                const id = e.id;
                const data_baru = [e.date, e.data];

                const perangkat_aktif = await this.data_perangkat.findIndex(
                    (perangkat, index) => perangkat.id == id
                );
                const data_lama =
                    this.data_perangkat[perangkat_aktif].series[0].data;
                this.data_perangkat[perangkat_aktif].series[0].data = [
                    ...data_lama,
                    data_baru,
                ];
                this.data_perangkat[perangkat_aktif].daya = e.data;
            });
    },
    computed: {
        loop_perangkat() {
            return;
        },
    },
};
</script>
<style lang=""></style>
