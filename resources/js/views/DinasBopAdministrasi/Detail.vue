<template>
    <div style="margin-top:25px;" v-if="emptyData === false">
        <transition name="fade">
            <table class="table table-hover table-striped table-bordered">
                <tbody>
                <tr>
                    <td style="width:15%;"><b>Program</b></td>
                    <td style="width:85%;" >
                        {{ dinasbop.program.nama_program }}
                    </td>
                </tr>
                <tr>
                    <td style="width:15%;"><b>Kegiatan</b></td>
                    <td style="width:85%;">
                        {{ dinasbop.kegiatan.nama_kegiatan }}
                    </td>
                </tr>
                <tr>
                    <td style="width:15%;"><b>Belanja</b></td>
                    <td style="width:85%;">
                        {{ dinasbop.belanja.nama_belanja }}
                    </td>
                </tr>
                <tr>
                    <td style="width:15%;"><b>Anggaran Tersedia</b></td>
                    <td>Rp.{{ anggaran_tersedia | rupiah }}</td>
                </tr>
                <tr>
                    <td style="width:15%;"><b>Dasar Surat Perintah</b></td>
                    <td>
                        <div v-if="dinasbopadministrasi.dasar !== undefined && dinasbopadministrasi.dasar.length > 1">
                            <ol style="margin-left:-25px;">
                                <li v-for="(v,k) in dinasbopadministrasi.dasar" :key="k">
                                    {{ v }}
                                </li>
                            </ol>
                        </div>
                        <div v-else>
                            <span v-if="dinasbopadministrasi.dasar !== undefined">
                                {{ dinasbopadministrasi.dasar[0] }}
                            </span>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="width:15%;"><b>Waktu Pemeriksaan</b></td>
                    <td style="width:85%;">{{ dinasbopadministrasi.dari | moment }} s.d {{ dinasbopadministrasi.sampai | moment }}</td>
                </tr>
                <tr>
                    <td style="width:15%;"><b>Tujuan Pemeriksaan</b></td>
                    <td>
                        <div v-if="dinasbopadministrasi.untuk !== undefined && dinasbopadministrasi.untuk.length > 1">
                            <ol style="margin-left:-25px;">
                                <li v-for="(v,k) in dinasbopadministrasi.untuk" :key="k">
                                    {{ v }}
                                </li>
                            </ol>
                        </div>
                        <div v-else>
                            <span v-if="dinasbopadministrasi.untuk !== undefined">
                                {{ dinasbopadministrasi.untuk[0] }}
                            </span>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="width:15%;">
                        <b>Status Approval</b>
                    </td>
                    <td>
                        <span v-if="approval_tab.kassubag.approval === 1" class="badge badge-success" style="padding:0.75em 0.75em !important;">KASSUBAG SUDAH MENYETUJUI</span>
                        <span v-if="approval_tab.sekretaris.approval === 1" class="badge badge-success" style="padding:0.75em 0.75em !important;">SEKRETARIS SUDAH MENYETUJUI</span>
                        <span v-if="approval_tab.inspektur.approval === 1" class="badge badge-success" style="padding:0.75em 0.75em !important;">INSPEKTUR SUDAH MENYETUJUI</span>
                    </td>
                </tr>
                </tbody>
            </table>
        </transition>

        <div style="margin-top:25px;"></div>

        <div class="row" >
            <div class="col-md-12">
                <div class="pull-left" v-if="emptyData === false">
                    <a v-if="(approval_tab.lock === 0 && access.update === 1) && (dinasbop.status === 0 && access.update === 1)" :href="route + '/administrasi/edit?id='+dinasbopadministrasi.id+'&dinasbop=' + dinasbop.id" class="btn btn-warning mb-2 mr-2"><i class="fa fa-wrench"></i> Ubah Data Dinas</a>
                    <a v-if="(approval_tab.lock === 0 && access.write === 1) && (dinasbop.status === 0 && access.write === 1)" :href="route + '/timadministrasi/create?administrasi='+dinasbopadministrasi.id+'&dinasbop=' + dinasbop.id" class="btn btn-success mb-2 mr-2"><i class="fa fa-plus"></i> Tambah Tim Pengadministrasi</a>

                    <span v-if="dinasboptimadministrasi.length !== 0 && access.approval === 1 && dinasbop.status === 0">
                        <a v-if="(approval_type === 'kassubag' || approval_type === 'administrator') && (approval_tab.kassubag.approval === 0)" class="btn btn-warning mb-2 mr-2" href="#" @click="toggleRevisiModal('kassubag')">
                            <i class="fa fa-edit"></i> Form Revisi Kassubag
                        </a>
                        <a v-if="(approval_type === 'kassubag' || approval_type === 'administrator') && (approval_tab.kassubag.approval === 0)" class="btn btn-success mb-2 mr-2" href="#" @click="toggleApprovalModal('kassubag')">
                            <i class="fa fa-check"></i> Approval Kassubag
                        </a>
                        <a v-if="(approval_type === 'sekretaris' || approval_type === 'administrator') && (approval_tab.sekretaris.approval === 0)" class="btn btn-warning mb-2 mr-2" href="#" @click="toggleRevisiModal('sekretaris')">
                            <i class="fa fa-edit"></i> Form Revisi Sekretaris
                        </a>
                        <a v-if="(approval_type === 'sekretaris' || approval_type === 'administrator') && (approval_tab.sekretaris.approval === 0)" class="btn btn-success mb-2 mr-2" href="#" @click="toggleApprovalModal('sekretaris')">
                            <i class="fa fa-check"></i> Approval Sekretaris
                        </a>
                        <a v-if="(approval_type === 'inspektur' || approval_type === 'administrator') && (approval_tab.inspektur.approval === 0)" class="btn btn-warning mb-2 mr-2" href="#" @click="toggleRevisiModal('inspektur')">
                            <i class="fa fa-edit"></i> Form Revisi Inspektur
                        </a>
                        <a v-if="(approval_type === 'inspektur' || approval_type === 'administrator') && (approval_tab.inspektur.approval === 0)" class="btn btn-success mb-2 mr-2" href="#" @click="toggleApprovalModal('inspektur')">
                            <i class="fa fa-check"></i> Approval Inspektur
                        </a>
                    </span>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <v-alert :alert="alert"></v-alert>
                <!-- tampil tim -->
                <transition name="fade">
                    <table class="table table-hover table-striped table-bordered" v-if="showTable == true">
                        <thead>
                        <tr>
                            <th style="width:15%;text-align:center;">Auditan</th>
                            <th style="width:15%;text-align:center;">Personil</th>
                            <th style="width:15%;text-align:center;">Rincian Biaya</th>
                            <th style="width:15%;text-align:center;">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="v in dinasboptimadministrasi" :key="v.id">
                            <td style="text-align: center;vertical-align:middle;">
                                {{ v.auditan }}
                                <br>
                                Nomor : <b>{{ v.nomor_sp }}</b>
                                <br>
                                Tanggal : {{ v.tgl_sp | moment }}
                            </td>
                            <td>
                                <b>Ketua Tim</b>
                                <br>
                                {{ v.tim.ketuatim.nama }}
                                <br><br>
                                <b>Anggota Tim</b>
                                <ol style="margin-left:-25px;">
                                    <li v-for="y in v.tim.anggota" :key="y.nip">{{ y.nama }}</li>
                                </ol>
                            </td>
                            <td>
                                <div style="margin-top:19px;"></div>
                                {{ v.tim.ketuatim.hari }} hari
                                x
                                Rp.{{ v.tim.ketuatim.biaya | rupiah }} =
                                Rp.{{ v.tim.ketuatim.total | rupiah }}
                                <br><br><br>
                                <ul style="list-style:none;margin-left: -40px;">
                                    <li v-for="z in v.tim.anggota" :key="z.nip">
                                        {{ z.hari }} hari
                                        x
                                        Rp.{{ z.biaya | rupiah }} =
                                        Rp.{{ z.total | rupiah }}
                                    </li>
                                </ul>
                                <br>
                                <b>Total : Rp.{{ v.total_anggaran | rupiah }}</b>
                            </td>
                            <td style="text-align: center; vertical-align:middle;">
                                <div style="text-align: center;">
                                    <a v-if="(approval_tab.lock === 0 && access.update === 1) && (dinasbop.status === 0 && access.update === 1)" :href="route + '/timadministrasi/edit?administrasi='+ v.dinasbop_administrasi_id +'&id=' + v.id" class="btn btn-sm btn-warning mr-sm-1">
                                        <i class="fa fa-wrench"></i> Ubah
                                    </a>
                                    <button v-else class="btn btn-sm btn-warning disabled mr-sm-1"><i class="fa fa-wrench"></i> Ubah</button>
                                    <a v-if="(approval_tab.lock === 0 && access.delete === 1) && (dinasbop.status === 0 && access.delete === 1)" href="#" @click="toggleModal(v.id)"
                                        class="btn btn-sm btn-danger">
                                        <i class="fa fa-trash-o"></i> Hapus
                                    </a>
                                    <button v-else class="btn btn-sm btn-danger disabled"><i class="fa fa-trash-o"></i> Hapus</button>
                                    <div class="btn-group" v-if="approval_tab.lock === 1 || dinasbop.status === 1">
                                        <button type="button" class="btn btn-default"><i class="fa fa-print"></i> Print</button>
                                        <button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                            <span class="sr-only">Toggle Dropdown</span>
                                            <div class="dropdown-menu" role="menu">
                                                <a class="dropdown-item" href="#" @click="print_sp(v.id)">Surat Perintah</a>
                                                <a class="dropdown-item" href="#" @click="print_spd(v.id)">Surat Perjalanan Dinas (SPD)</a>
                                                <a class="dropdown-item" href="#" @click="print_rbpd(v.id)">Rincian Biaya Perjalanan Dinas</a>
                                                <a class="dropdown-item" href="#" @click="print_dpbo(v.id)">Daftar Pembayaran</a>
                                            </div>
                                        </button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" style="text-align:right;"><b>Jumlah</b></td>
                            <td style="text-align:right;"><b>Rp.{{ total_biaya_tim | rupiah }}</b></td>
                            <td></td>
                        </tr>
                        </tbody>
                    </table>
                </transition>
                <transition name="fade"><v-delete :element="'administrasi_delete_modal'" :id="administrasiid" @delete="deleteData"></v-delete></transition>
            </div>
            <div class="col-md-12 col-xs-12" v-if="dinasboptimadministrasi.length !== 0">
                <hr>
                <transition name="fade"><v-revision-log :element="element" :revision="approval_tab"></v-revision-log></transition>
                <transition name="fade"><v-revision :role="approval_role" :element="'administrasi_revision_modal'" @revision="createRevision"></v-revision></transition>
                <transition name="fade"><v-approval :role="approval_role" :element="'administrasi_approval_modal'" @approve="createApproval"></v-approval></transition>
            </div>
        </div>
    </div>
    <div style="margin-top:25px;" v-else>
        <a v-if="(approval_tab.lock === 0 && access.write === 1) && (dinasbop.status === 0 && access.write === 1)" :href="route + '/administrasi/create?dinasbop=' + dinasbop.id" class="btn btn-success mb-2 mr-2"><i class="fa fa-plus"></i> Tambah Data</a>
        <v-alert :alert="alert"></v-alert>
    </div>
</template>

<script>

    import service from './../../services.js';
    export default {
        data() {
            return {
                isLoading: false,
                options: {},
                alert: {
                    error:false,
                    empty:false,
                    delete:false
                },
                total_biaya_tim:0,
                showTable: false,
                emptyData:false,
                administrasiid:'',
                approval_tab: {
                    kassubag:{
                        catatan:[],
                        approval:0
                    },
                    sekretaris:{
                        catatan:[],
                        approval:0
                    },
                    inspektur:{
                        catatan:[],
                        approval:0
                    },
                    lock:0
                },
                element: {
                    kassubag_href: '#administrasirevlogkassubag',
                    kassubag_id: 'administrasirevlogkassubag',
                    sekretaris_href: '#administrasirevlogsekretaris',
                    sekretaris_id: 'administrasirevlogsekretaris',
                    inspektur_href: '#administrasirevloginspektur',
                    inspektur_id: 'administrasirevloginspektur'
                },
                approval_role:'',
                usernip:'',
                anggaran_tersedia: 0
            }
        },
        props: ['dinasbop', 'dinasbopapproval', 'dinasbopadministrasi','dinasboptimadministrasi', 'route', 'print_action', 'api', 'access', 'approval_type'],
        methods: {
            print_sp(id) {
                let new_window = window.open();
                new_window.location = this.api + '/print/sp/'+ id +'/administrasi';
            },
            print_spd(id) {
                let new_window = window.open();
                new_window.location = this.api + '/print/spd/'+ id +'/administrasi';
            },
            print_rbpd(id) {
                let new_window = window.open();
                new_window.location = this.api + '/print/rbpd/'+ id +'/administrasi';
            },
            print_personil(id) {
                let new_window = window.open();
                new_window.location = this.api + '/print/personil/'+ id +'/administrasi';
            },
            print_personil_all(id) {
                let new_window = window.open();
                new_window.location = this.api + '/print/personil/all/'+ id;
            },
            print_dpbo(id) {
                let new_window = window.open();
                new_window.location = this.api + '/print/dpbo/'+ id +'/administrasi';
            },
            toggleModal(id) {
                $("#administrasi_delete_modal").modal('show');
                this.administrasiid = id;
            },
            deleteData(id) {
                service.deleteData(this.api + '/timadministrasi?nip='+this.usernip+'&nip='+this.usernip+'&id=' + id)
                    .then(response => {
                        if(response.status === 'ok') {
                            this.alert.delete = true;
                            $('#administrasi_delete_modal').modal('hide');
                            window.scroll({ top: 0, left: 0, behavior: 'smooth' });
                            setTimeout(function() {
                                this.alert.delete=false;
                                location.reload();
                            }, 1000);
                        }
                    }).catch(error => {
                    this.alert.delete = false;
                    this.alert.error = true;
                    $('#administrasi_delete_modal').modal('hide');
                    window.scroll({ top: 0, left: 0, behavior: 'smooth' });
                    console.log(error);
                });
            },
            toggleRevisiModal(role) {
                this.approval_role = role;
                $("#administrasi_revision_modal").modal('show');
            },
            toggleApprovalModal(role) {
                this.approval_role = role;
                $("#administrasi_approval_modal").modal('show');
            },
            createRevision(callback) {
                service.putData(this.api + '/approval?nip='+this.usernip+'&act=revision&type='+callback.role+'&tab=administrasi&id=' + this.dinasbop.id, {catatan: callback.catatan})
                    .then(response => {
                        if(response.status === 'ok') {
                            this.alert.delete = true;
                            $('#administrasi_revision_modal').modal('hide');
                            window.scroll({ top: 0, left: 0, behavior: 'smooth' });
                            alert('CATATAN REVISI BERHASIL DIBUAT');
                            location.reload();
                        }
                    }).catch(error => {
                    this.alert.delete = false;
                    this.alert.error = true;
                    $('#administrasi_revision_modal').modal('hide');
                    alert('TERJADI KESALAHAN PADA SISTEM!');
                    window.scroll({ top: 0, left: 0, behavior: 'smooth' });
                    console.log(error);
                });
            },
            createApproval(role) {
                service.putData(this.api + '/approval?nip='+this.usernip+'&act=approve&type='+role+'&tab=administrasi&id=' + this.dinasbop.id)
                    .then(response => {
                        if(response.status === 'ok') {
                            $('#administrasi_approval_modal').modal('hide');
                            window.scroll({ top: 0, left: 0, behavior: 'smooth' });
                            alert('PROSES APPROVAL BERHASIL');
                            location.reload();
                        }
                    }).catch(error => {
                    $('#approval_modal').modal('hide');
                    window.scroll({ top: 0, left: 0, behavior: 'smooth' });
                    alert('TERJADI KESALAHAN PADA SISTEM!');
                    console.log(error);
                });
            },
            getAnggaranTersedia() {
                service.postData('../api/ajax/sisa_anggaran', { 'tahun': this.dinasbop.created_at, 'kegiatan': this.dinasbop.kegiatan_id })
                    .then(result => {
                        this.anggaran_tersedia = parseInt(result.sisa_anggaran);
                    }).catch(error => {
                        console.log(error);
                    });
            }
        },
        created() {
            this.isLoading = true;
            this.getAnggaranTersedia();
        },
        mounted() {
            this.isLoading = false;
            if (this.dinasbopadministrasi.length === 0) {
                this.emptyData = true;
            } else {
                this.emptyData = false;
            }

            if (this.dinasboptimadministrasi.length === 0) {
                this.showTable = false;
                this.alert.empty = true;
            } else {
                this.showTable = true;
                this.alert.empty = false;
                let x = 0;
                for (x in this.dinasboptimadministrasi) {
                    this.total_biaya_tim += this.dinasboptimadministrasi[x].total_anggaran;
                }
            }
            this.approval_tab = this.dinasbopapproval.find(dinasbopapproval => dinasbopapproval.tab === 'administrasi');
            this.usernip = this.$cookies.get('nip');
        }
    };
</script>
