<template>
    <div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <v-alert :alert=alert></v-alert>
                        <loading :opacity="100" :active.sync="isLoading" :can-cancel="false" :is-full-page="false"></loading>
                        <form method="POST" v-on:submit.prevent="onSubmit" enctype="multipart/form-data" autocomplete="off">
                            <div class="col-md-12 col-sm-12">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label>Nomor Surat Perintah *</label>
                                        <input type="text" class="form-control" v-model="dinasboptim.nomor_sp" placeholder="Isi Nomor Surat Perintah" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Tanggal Surat Perintah *</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                            </div>
                                            <date-picker
                                                id="tgl_sp"
                                                name="tgl_sp"
                                                v-model="dinasboptim.tgl_sp"
                                                :config="options"
                                                class="form-control"
                                                placeholder="Tanggal Surat Perintah" autocomplete="off" required>
                                            </date-picker>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label>Irban *</label>
                                        <select v-model="dinasboptim.irban_id" @change="onChangeIrban($event)" class="form-control" required>
                                            <option value="">Pilih Irban</option>
                                            <option v-for="v in this.irban_data" :value="v.id" :key="v.id">{{ v.nama_irban }}</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>Auditan *</label>
                                        <select v-model="dinasboptim.auditan" class="form-control" required>
                                            <option value="">Pilih Auditan</option>
                                            <optgroup v-for="(k,v) in this.audit_data" :key="v" :label="v">
                                                <option v-for="val in k" :key="val" :value="val">{{ val }}</option>
                                            </optgroup>
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label>Wakil Penanggung Jawab *</label>
                                        <select v-model="dinasboptim.wakilpenanggungjawab" class="form-control" required>
                                            <option value="">Pilih Wakil Penanggung Jawab</option>
                                            <option v-for="v in personil_data.wakilpenanggungjawab" :key="v.id" :value="v.nip">
                                                {{ v.nama }} - {{ v.jabatan }}
                                            </option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Pengendali Teknis *</label>
                                        <select v-model="dinasboptim.pengendaliteknis" class="form-control" required>
                                            <option value="">Pilih Pengendali Teknis</option>
                                            <option v-for="v in personil_data.pengendaliteknis" :key="v.id" :value="v.nip">
                                                {{ v.nama }} - {{ v.jabatan }}
                                            </option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Ketua Tim *</label>
                                        <select v-model="dinasboptim.ketuatim" class="form-control" required>
                                            <option value="">Pilih Ketua Tim</option>
                                            <option v-for="v in personil_data.ketuatim" :key="v.id" :value="v.nip">
                                                {{ v.nama }} - {{ v.jabatan }}
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label>Anggota *</label>
                                        <multiselect
                                            :multiple="true"
                                            :taggable="true"
                                            placeholder="Pilih Anggota"
                                            v-model="dinasboptim.anggota"
                                            :options="anggota_data"
                                            track-by="key"
                                            label="label"
                                            :allow-empty="true"
                                        >
                                        </multiselect>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label>Lampirkan Bukti Pendukung (PDF / DOC / JPG / RAR / ZIP) *</label>
                                        <br>
                                        <input type="file" ref="file" @change="handleFileUpload()" required>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan Data</button>
                                        <a :href="route" class="btn btn-danger"><i class="fa fa-arrow-left"></i> Kembali</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
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
                options: {
                    format: 'YYYY-MM-DD',
                    useCurrent: false,
                    locale: 'id',
                    minDate: moment(this.dinasbop_data.dari),
                    maxDate: moment(this.dinasbop_data.sampai).add(1, 'day'),
                    disabledDates: [
                        moment(this.dinasbop_data.sampai).add(1, 'day')
                    ]
                },
                dinasboptim: {
                    'nomor_sp': '',
                    'tgl_sp': '',
                    'auditan': '',
                    'irban_id': '',
                    'wakilpenanggungjawab':'',
                    'pengendaliteknis':'',
                    'ketuatim':'',
                    'anggota':[],
                    'lampiran':''
                },
                form:'',
                personil_data:[],
                anggota_data:[],
                audit_data:[],
                alert: {
                    error: false,
                    save: false,
                    duplicate: false
                },
                isLoading: false,
                usernip:''
            }
        },
        props: [
            'auditan_data',
            'driver_data',
            'irban_data',
            'dinasbop',
            'dinasbop_data',
            'api',
            'route'
        ],
        methods: {
            handleFileUpload() {
                this.dinasboptim.lampiran = this.$refs.file.files[0];
            },
            formReady() {
                let formData = new FormData();
                formData.append('nomor_sp', this.dinasboptim.nomor_sp);
                formData.append('tgl_sp', this.dinasboptim.tgl_sp);
                formData.append('auditan', this.dinasboptim.auditan);
                formData.append('irban_id', this.dinasboptim.irban_id);
                formData.append('wakilpenanggungjawab', this.dinasboptim.wakilpenanggungjawab);
                formData.append('pengendaliteknis', this.dinasboptim.pengendaliteknis);
                formData.append('ketuatim', this.dinasboptim.ketuatim);
                formData.append('anggota', JSON.stringify(this.dinasboptim.anggota));
                if(this.dinasboptim.lampiran !== '') {
                    formData.append('lampiran', this.dinasboptim.lampiran);
                }

                return formData;
            },
            onSubmit(evt) {
                this.form = this.formReady();
                service.postUploadData(this.api + '/tim?nip='+this.usernip+'&dinasbop=' + this.dinasbop, this.form)
                .then(result => {
                    this.response(result);
                }).catch(error => {
                    this.isLoading = false;
                    this.alert.error = true;
                    this.alert.duplicate = false;
                    this.alert.save = false;
                    window.scroll({ top: 0, left: 0, behavior: 'smooth' });
                    console.log(error);
                });
            },
            onChangeIrban(evt) {
                const irban = evt.target.value;
                service.fetchData('../../api/ajax/dinasbop/tujuan?dinas=tim&act=create&dinasbop='+this.dinasbop+'&irban='+ irban)
                .then(response => {
                    this.dinasboptim.auditan = '';
                    this.audit_data = response;
                })
                .catch(error => {
                    console.log(error);
                });

                service.fetchData('../../api/ajax/dinasbop/personil?irban='+ irban)
                .then(response => {
                    this.dinasboptim.wakilpenanggungjawab = '';
                    this.dinasboptim.pengendaliteknis = '';
                    this.dinasboptim.ketuatim = '';
                    this.dinasboptim.anggota = '';
                    this.personil_data = response;
                    this.anggota_data = [];
                    this.personil_data.anggota.forEach(item => {
                        this.anggota_data.push({'label': item.nama +' - '+ item.jabatan , 'key':item.nip})
                    });
                })
                .catch(error => {
                    console.log(error);
                });
            },
            response(result) {
                if (result.status === 'ok') {
                    this.alert.error = false;
                    this.alert.duplicate = false;
                    this.alert.save = true;
                    window.scroll({ top: 0, left: 0, behavior: 'smooth' });
                    this.reset();
                    setTimeout(() => this.alert.save = false, 2000);
                } else if (result.status === 'duplicate') {
                    this.alert.duplicate = true;
                    this.alert.error = false;
                    this.alert.save = false;
                    window.scroll({ top: 0, left: 0, behavior: 'smooth' });
                }
            },
            reset() {
                this.$refs.file.value = '';
                this.dinasboptim.irban_id = '';
                this.dinasboptim.auditan = '';
                this.dinasboptim.nomor_sp = '';
                this.dinasboptim.tgl_sp = '';
                this.dinasboptim.wakilpenanggungjawab = '';
                this.dinasboptim.pengendaliteknis = '';
                this.dinasboptim.ketuatim = '';
                this.dinasboptim.anggota = [];
                this.dinasboptim.driver = '';
                this.dinasboptim.lampiran = '';
            }
        },
        created() {
            this.$cookies.set("last_tab", "tim");
            this.isLoading = true;
            this.audit_data = this.auditan_data;
        },
        mounted() {
            this.isLoading = false;
            this.usernip = this.$cookies.get('nip');
        }
    };
</script>
