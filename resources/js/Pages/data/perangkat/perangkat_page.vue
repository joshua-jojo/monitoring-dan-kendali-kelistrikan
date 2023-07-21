<template lang="">
    <div class="flex gap-4 flex-col">
        <div class="flex justify-between gap-4">
            <label for="tambah" class="btn btn-sm btn-success">
                <i class="fa fa-plus"></i>
                tambah
            </label>

            <div class="flex gap-4">
                <div class="form-control">
                    <input
                        type="text"
                        class="input input-bordered input-sm"
                        placeholder="Cari..."
                    />
                </div>
                <div class="flex gap-2 justify-center items-center">
                    tampilkan :
                    <select class="select select-bordered w-max select-sm">
                        <option :value="5">5 Baris</option>
                        <option :value="10">10 Baris</option>
                        <option :value="20">20 Baris</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="overflow-x-auto w-full">
            <div class="overflow-x-auto">
                <table class="table table-zebra">
                    <!-- head -->
                    <thead>
                        <tr>
                            <th></th>
                            <th>Nama Perangkat</th>
                            <th>Status</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- row 1 -->
                        <tr v-for="(item, index) in 4" :key="index">
                            <th>1</th>
                            <td>Cy Ganderton</td>
                            <td>Quality Control Specialist</td>
                            <td>
                                <div class="flex w-max gap-2">
                                    <label for="edit" class="btn btn-sm btn-warning">
                                        <i class="fa fa-pen"></i>
                                        Edit
                                    </label>
                                    <label for="edit" class="btn btn-sm btn-error">
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
</template>
<script>
import Layout_page from "../../../layout/layout_page.vue";

export default {
    layout: Layout_page,
};
</script>
<style lang=""></style>
