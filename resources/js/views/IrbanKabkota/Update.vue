<template>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <v-alert :alert=alert></v-alert>
                    <loading :opacity="100" :active.sync="isLoading" :can-cancel="false" :is-full-page="false"></loading>
                    <form method="POST" v-on:submit.prevent="onSubmit">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>Irban</label>
                                <select v-model="irbankabkota.irban_id" class="form-control mb-2 mr-sm-2" :class="{ 'is-invalid': validasi.irban_id }">
                                    <option value="">Pilih Irban</option>
                                    <option v-for="v in this.irban_data" :value="v.id" :key="v.id">{{ v.nama_irban }}</option>
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <label>Kabupaten / Kota</label>
                                <select v-model="irbankabkota.kabkota_id" class="form-control mb-2 mr-sm-2" :class="{ 'is-invalid': validasi.kabkota_id }">
                                    <option value="">Pilih Kabupaten / Kota</option>
                                    <option v-for="v in this.kabkota_data" :value="v.id" :key="v.id">{{ v.nama_kabkota }}</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-12">
                                <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan Data</button>
                                <a :href="route" class="btn btn-danger"><i class="fa fa-arrow-left"></i> Kembali</a>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-12">
                                <b>*) Wajib Diisi</b>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import service from './../../services.js';

export default {
    data() {
        return {
            alert: {
                error: false,
                update: false,
                validate: false
            },
            validasi: {
                irban_id:'',
                kabkota_id:''
            },
            isLoading: false
        }
    },
    props: ['api', 'kabkota_data', 'irban_data', 'irbankabkota', 'route'],
    methods: {
        clearAlert() {
            this.alert.error = false;
            this.alert.update = false;
            this.alert.validate = false;
        },
        onSubmit(evt) {
            evt.preventDefault();
            this.clearAlert();
            let validasi = this.validate();
            if (validasi === true) {
                this.isLoading = true;
                service.putData(this.api, this.irbankabkota)
                    .then(result => {
                        this.response(result);
                    }).catch(error => {
                        this.isLoading = false;
                        this.alert.error = true;
                        window.scroll({top: 0, left: 0, behavior: 'smooth'});
                        console.log(error);
                    });
            } else {
                this.alert.validate = true;
                setTimeout(() => this.alert.validate = false, 2000);
            }
        },
        response(result) {
            setTimeout(() => { this.isLoading = false }, 1000);
            if (result.status === 'ok') {
                this.alert.update = true;
                window.scroll({ top: 0, left: 0, behavior: 'smooth' });
                setTimeout(() => this.alert.update = false, 5000);
            }
            this.isLoading = false;
        },
        validate() {
            let condition = 0;

            if (this.irbankabkota.kabkota_id.length === 0) {
                this.validasi.kabkota_id = true;
                condition++;
            } else {
                this.validasi.kabkota_id = false;
            }

            if (this.irbankabkota.irban_id.length === 0) {
                this.validasi.irban_id = true;
                condition++;
            } else {
                this.validasi.irban_id = false;
            }

            if (condition > 0) {
                return false;
            } else {
                return true;
            }
        }
    },
    created() {
        this.isLoading = true;
    },
    mounted() {
        this.isLoading = false;
    }
};
</script>
