<template lang="">
    <div class="flex flex-col gap-4">
        <div class="card shadow-lg bg-base-100">
            <div class="card-body">
                <div class="">test {{testData}}</div>
                <div id="chart">
                    <apexchart
                        type="area"
                        height="200"
                        :options="chartOptions"
                        :series="series"
                    ></apexchart>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import Layout_page from "../../layout/layout_page.vue";

export default {
    layout: Layout_page,
    data() {
        return {
            series: [
                {
                    name: "series2",
                    data: [11, 32, 45, 32, 34, 52, 41],
                },
            ],
            chartOptions: {
                chart: {
                    height: 350,
                    type: "area",
                },
                dataLabels: {
                    enabled: false,
                },
                stroke: {
                    curve: "smooth",
                },
                xaxis: {
                    type: "datetime",
                    categories: [
                        "2018-09-19T00:00:00.000Z",
                        "2018-09-19T01:30:00.000Z",
                        "2018-09-19T02:30:00.000Z",
                        "2018-09-19T03:30:00.000Z",
                        "2018-09-19T04:30:00.000Z",
                        "2018-09-19T05:30:00.000Z",
                        "2018-09-19T06:30:00.000Z",
                    ],
                },
                tooltip: {
                    x: {
                        format: "dd/MM/yy HH:mm",
                    },
                },
            },
            testData : null
        };
    },
    created(){
        this.$echo.channel("bang-wahyu").listen('.info-perangkat', e => {
           this.testData = e.data
        })
    }
};
</script>
<style lang=""></style>
