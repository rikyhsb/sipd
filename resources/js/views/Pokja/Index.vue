<template>
    <div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card table-responsive">
                    <div class="card-header">
                        <div class="pull-right">
                            <button type="button" v-on:click.prevent="toggle" class="btn btn-info mb-2"><i class="fa fa-search"></i> Form Pencarian</button>
                            <a v-if="access.write === 1" :href="route + '/create'" class="btn btn-success mb-2"><i class="fa fa-plus"></i> Tambah Data</a>
                        </div>
                        <transition name="fade">
                            <div class="card" style="margin-top:50px;" v-show="showForm">
                                <div class="card-body table-responsive">
                                    <form v-on:submit.prevent="fetchData()">
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <select v-model="search.irban" class="form-control">
                                                    <option value="">Pilih Irban</option>
                                                    <option v-for="v in this.irban_data" :value="v.id" :key="v.id">{{ v.nama_irban }}</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <input type="text" class="form-control" v-model="search.q" placeholder="NAMA / NIP">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="input-group col-md-4">
                                                <button type="submit" class="btn btn-success mr-sm-2"><i class="fa fa-search"></i> Cari Data</button>
                                                <button type="button" v-on:click.prevent="clear" class="btn btn-info"><i class="fa fa-refresh"></i> Reset</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </transition>
                    </div>
                    <div class="card-body">
                        <v-alert :alert="alert"></v-alert>
                        <loading :opacity="100" :active.sync="isLoading" :can-cancel="false" :is-full-page="false"></loading>
                        <transition name="fade">
                            <table class="table table-hover table-striped table-bordered" v-if="showTable === true">
                                <thead>
                                    <tr>
                                        <th style="width:15%; text-align: center;">NIP</th>
                                        <th style="width:20%; text-align: center;">Nama</th>
                                        <th style="width:30%; text-align: center;">Irban</th>
                                        <th style="width:15%; text-align: center;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="v in pokja" :key="v.id">
                                        <td>{{ v.pegawai.nip }}</td>
                                        <td>{{ v.pegawai.nama }}</td>
                                        <td>{{ v.irban.nama_irban }}</td>
                                        <td>
                                            <div style="text-align: center;">
                                                <a v-if="(access.update === 1)" :href="route + '/edit?id=' + v.id" class="btn btn-sm btn-warning mr-sm-1">
                                                    <i class="fa fa-wrench"></i> Ubah
                                                </a>
                                                <button v-else class="btn btn-sm btn-warning disabled mr-sm-1"><i class="fa fa-wrench"></i> Ubah</button>
                                                <a v-if="(access.delete === 1)" href="#" @click="toggleModal(v.id)"
                                                    class="btn btn-sm btn-danger">
                                                    <i class="fa fa-trash-o"></i> Hapus
                                                </a>
                                                <button v-else class="btn btn-sm btn-danger disabled"><i class="fa fa-trash-o"></i> Hapus</button>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </transition>

                        <transition name="fade"><v-delete :element="'pokja_delete_modal'" :id="id" @delete="deleteData"></v-delete></transition>
                        <transition name="fade">
                            <div class="card-footer clearfix">
                                <v-pagination
                                    :pagination="pagination"
                                    v-on:next="nextPage"
                                    v-on:previous="prevPage"
                                    v-if="showTable === true">
                                </v-pagination>
                            </div>
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
            pokja: {},
            search: {
                irban:'',
                q:''
            },
            alert: {
                error:false,
                empty:false,
                delete:false
            },
            pagination: {
                page: 1,
                last:0,
                total:0,
                to:0,
                from:0
            },
            isLoading: false,
            showForm: false,
            showTable: false,
            id:'',
            usernip:''
        }
    },
    props: ['irban_data','api','route','access'],
    methods: {
        toggle() {
            this.showForm = !this.showForm
        },
        clear() {
            this.search.irban = '';
            this.search.q = '';
            this.fetchData();
        },
        nextPage() {
            this.pagination.page++;
            this.fetchData();
        },
        prevPage() {
            this.pagination.page--;
            this.fetchData();
        },
        toggleModal(id) {
            $("#pokja_delete_modal").modal('show');
            this.id = id;
        },
        fetchData() {
            this.isLoading = true;
            let query  = this.generateParams();
            service.fetchData(this.api + '?'+ query + '&page='+ this.pagination.page)
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
                this.pokja = response.data;
                this.pagination.last = response.last_page;
                this.pagination.from = response.from;
                this.pagination.to = response.to;
                this.pagination.total = response.total;
            }
            this.isLoading = false;
        },
        generateParams() {
            return Object.keys(this.search).map(key => key + '=' + this.search[key]).join('&');
        },
        deleteData(id) {
            service.deleteData(this.api + '?nip='+this.usernip+'&id=' + id)
            .then(response => {
                if(response.status === 'ok') {
                    this.alert.delete = true;
                    $('#pokja_delete_modal').modal('hide');
                    this.fetchData();
                    window.scroll({ top: 0, left: 0, behavior: 'smooth' });
                    setTimeout(() => this.alert.delete=false, 5000);
                }
            }).catch(error => {
                this.isLoading = false;
                this.alert.delete = false;
                this.alert.error = true;
                $('#pokja_delete_modal').modal('hide');
                window.scroll({ top: 0, left: 0, behavior: 'smooth' });
                this.fetchData();
                console.log(error);
            });
        }
    },
    created() {
        this.isLoading = true;
        this.usernip = this.$cookies.get('nip');
        this.fetchData();
    }
};
</script>
