<template>
    <div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body table-responsive">
                        <v-alert :alert="alert"></v-alert>
                        <loading :opacity="100" :active.sync="isLoading" :can-cancel="false" :is-full-page="false"></loading>
                        <transition name="fade">
                            <table class="table table-hover table-striped table-bordered" v-if="showTable === true">
                                <thead>
                                    <tr>
                                        <th style="width:50%; text-align:center;">Jabatan</th>
                                        <th style="width:10%; text-align:center;">Biaya Per Hari</th>
                                        <th style="width:5%; text-align:center;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="v in bop" :key="v.id">
                                        <td>{{ v.jabatan }}</td>
                                        <td style="text-align:right;">{{ v.biaya_per_hari | rupiah }}</td>
                                        <td>
                                            <div style="text-align: center;">
                                                <a v-if="(access.update === 1)" :href="route + '/edit?id=' + v.id" class="btn btn-sm btn-warning mr-sm-1">
                                                    <i class="fa fa-wrench"></i> Ubah
                                                </a>
                                                <button v-else class="btn btn-sm btn-warning disabled mr-sm-1"><i class="fa fa-wrench"></i> Ubah</button>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </transition>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import service from './../../services.js';

export default {
    data: function() {
        return {
            bop: {},
            alert: {
                error:false,
                empty:false,
                delete:false
            },
            isLoading: false,
            showForm: false,
            showTable: false,
            id:''
        }
    },
    props: ['api','route','access'],
    methods: {
        fetchData() {
            this.isLoading = true;
            service.fetchData(this.api)
            .then(response => {
                this.renderData(response);
            })
            .catch(error => {
                this.isLoading = false;
                this.alert.error = true;
                console.log(error);
            });
        },
        renderData(response) {
            if (response.total === 0) {
                this.showTable = false;
                this.alert.empty = true;
                this.alert.error = false;
            } else {
                this.showTable = true;
                this.alert.empty = false;
                this.alert.error = false;
                this.bop = response.data;
            }
            this.isLoading = false;
        },
    },
    created() {
        this.isLoading = true;
        this.fetchData();
    }
};
</script>
