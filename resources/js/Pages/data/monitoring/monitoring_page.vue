<template lang="">
    <div class="flex flex-col gap-4">
        <div class="flex justify-between">
            <div class="flex gap-2 items-center">
                <label class="label">
                    <span class="label-text">Tampilkan Dari</span>
                </label>
                <input type="date" class="input input-bordered input-xs" />
                <label class="label">
                    <span class="label-text">Sampai </span>
                </label>
                <input type="date" class="input input-bordered input-xs" />
            </div>
            <div class="flex items-center gap-2">
                <div class="flex gap-2 items-center">
                    <label class="label">
                        <span class="label-text">Pilih Perangkat</span>
                    </label>
                    <select class="select select-xs select-bordered">
                        <option value="" selected disabled>
                            Pilih Perangkat
                        </option>
                    </select>
                </div>
                <div class="flex gap-2 items-center">
                    <label class="label">
                        <span class="label-text">Baris</span>
                    </label>
                    <select class="select select-xs select-bordered">
                        <option value="" selected disabled>
                            Pilih Baris
                        </option>
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
                    <th>Tegangan</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td></td>
                    <td>Nama Perangkat</td>
                    <td>Tanggal</td>
                    <td>Jam</td>
                    <td>Tegangan</td>
                </tr>
            </tbody>
        </table>

        <div class="flex justify-center items-center">
            <div class="join">
                <button class="join-item btn btn-sm">1</button>
                <button class="join-item btn btn-sm btn-active">2</button>
                <button class="join-item btn btn-sm">3</button>
                <button class="join-item btn btn-sm">4</button>
            </div>
        </div>
    </div>
</template>
<script>
import Layout_page from "../../../layout/layout_page.vue";

export default {
    layout: Layout_page,
};
</script>
<style lang=""></style>
