<template>
    <div class="row">
        <div class="col-lg-12">
            <div class="card table-responsive">
                <div class="card-body table-responsive">
                    <loading :opacity="100" :active.sync="isLoading" :can-cancel="false" :is-full-page="false"></loading>
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a data-toggle="tab" :style="[dinasboptim.length === 0 ? {background:'#eee'} : '']" class="nav-link" href="#tim" :data-id="'tabtim'" @click="onChangeTabs($event)" :class="(last_tab == 'tim') ? 'active' : ''">
                                <i class="fa fa-user"></i> Tim
                            </a>
                        </li>
                        <li class="nav-item">
                            <a data-toggle="tab" :style="[dinasbopinspektur.length === 0 ? {background:'#eee'} : '']" class="nav-link" href="#inspektur" :data-id="'tabinspektur'" @click="onChangeTabs($event)" :class="(last_tab == 'inspektur') ? 'active' : ''">
                                <i class="fa fa-user"></i> Inspektur
                            </a>
                        </li>
                        <li class="nav-item">
                            <a data-toggle="tab" :style="[dinasbopsekretaris.length === 0 ? {background:'#eee'} : '']" class="nav-link" href="#sekretaris" :data-id="'tabsekretaris'" @click="onChangeTabs($event)" :class="(last_tab == 'sekretaris') ? 'active' : ''">
                                <i class="fa fa-user"></i> Sekretaris
                            </a>
                        </li>
                        <li class="nav-item">
                            <a data-toggle="tab" :style="[dinasbopdriver.length === 0 ? {background:'#eee'} : '']" class="nav-link" href="#driver" :data-id="'tabdriver'" @click="onChangeTabs($event)" :class="(last_tab == 'driver') ? 'active' : ''">
                                <i class="fa fa-user"></i> Pengemudi
                            </a>
                        </li>
                        <li class="nav-item">
                            <a data-toggle="tab" :style="[dinasbopreviu === null ? {background:'#eee'} : '']" class="nav-link" href="#reviu" :data-id="'tabreviu'" @click="onChangeTabs($event)" :class="(last_tab == 'reviu') ? 'active' : ''">
                                <i class="fa fa-user"></i> Reviu & Monitoring
                            </a>
                        </li>
                        <li class="nav-item">
                            <a data-toggle="tab" :style="[dinasbopsupervisi === null ? {background:'#eee'} : '']" class="nav-link" href="#supervisi" :data-id="'tabsupervisi'" @click="onChangeTabs($event)" :class="(last_tab == 'supervisi') ? 'active' : ''">
                                <i class="fa fa-user"></i> Supervisi
                            </a>
                        </li>
                        <li class="nav-item">
                            <a data-toggle="tab" :style="[dinasboptimpengumpuldata.length === 0 ? {background:'#eee'} : '']" class="nav-link" href="#pengumpuldata" :data-id="'tabpengumpuldata'" @click="onChangeTabs($event)" :class="(last_tab == 'pengumpuldata') ? 'active' : ''">
                                <i class="fa fa-user"></i> Pengumpul Data
                            </a>
                        </li>
                        <li class="nav-item">
                            <a data-toggle="tab" :style="[dinasboptimadministrasi.length === 0 ? {background:'#eee'} : '']" class="nav-link" href="#administrasi" :data-id="'tabadministrasi'" @click="onChangeTabs($event)" :class="(last_tab == 'administrasi') ? 'active' : ''">
                                <i class="fa fa-user"></i> Pengadministrasi
                            </a>
                        </li>
                        <li class="nav-item">
                            <a data-toggle="tab" :style="[dinasbopcustom.length === 0 ? {background:'#eee'} : '']" class="nav-link" href="#custom" :data-id="'tabcustom'" @click="onChangeTabs($event)" :class="(last_tab == 'custom') ? 'active' : ''">
                                <i class="fa fa-user"></i> Kustomisasi
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div id="tim" class="tab-pane fade" :class="{ 'active': (last_tab == 'tim'), 'show': (last_tab == 'tim') }">
                            <dinasboptim-detail
                                :dinasbop=dinasbop
                                :dinasboptim=dinasboptim
                                :dinasbopapproval=dinasbopapproval
                                :route=route
                                :print_action=print_action
                                :access=access
                                :approval_type=approval_type
                                :api=api>
                            </dinasboptim-detail>
                        </div>
                        <div id="inspektur" class="tab-pane fade" :class="{ 'active': (last_tab == 'inspektur'), 'show': (last_tab == 'inspektur') }">
                            <dinasbopinspektur-detail
                                :dinasbop=dinasbop
                                :dinasbopinspektur=dinasbopinspektur
                                :dinasbopapproval=dinasbopapproval
                                :route=route
                                :print_action=print_action
                                :access=access
                                :approval_type = approval_type
                                :api=api>
                            </dinasbopinspektur-detail>
                        </div>
                        <div id="sekretaris" class="tab-pane fade" :class="{ 'active': (last_tab == 'sekretaris'), 'show': (last_tab == 'sekretaris') }">
                            <dinasbopsekretaris-detail
                                :dinasbop = dinasbop
                                :dinasbopsekretaris = dinasbopsekretaris
                                :dinasbopapproval=dinasbopapproval
                                :route = route
                                :print_action = print_action
                                :approval_type = approval_type
                                :access=access
                                :api = api>
                            </dinasbopsekretaris-detail>
                        </div>
                        <div id="driver" class="tab-pane fade" :class="{ 'active': (last_tab == 'driver'), 'show': (last_tab == 'driver') }">
                            <dinasbopdriver-detail
                                :dinasbop = dinasbop
                                :dinasbopdriver = dinasbopdriver
                                :dinasbopapproval=dinasbopapproval
                                :route = route
                                :print_action = print_action
                                :approval_type = approval_type
                                :access=access
                                :api = api>
                            </dinasbopdriver-detail>
                        </div>
                        <div id="reviu" class="tab-pane fade" :class="{ 'active': (last_tab == 'reviu'), 'show': (last_tab == 'reviu') }">
                            <dinasbopreviu-detail
                                :dinasbop = dinasbop
                                :dinasbopreviu = dinasbopreviu
                                :dinasbopapproval=dinasbopapproval
                                :route = route
                                :print_action = print_action
                                :approval_type = approval_type
                                :access=access
                                :api = api>
                            </dinasbopreviu-detail>
                        </div>
                        <div id="supervisi" class="tab-pane fade" :class="{ 'active': (last_tab == 'supervisi'), 'show': (last_tab == 'supervisi') }">
                            <dinasbopsupervisi-detail
                                :dinasbop = dinasbop
                                :dinasbopsupervisi = dinasbopsupervisi
                                :dinasbopapproval=dinasbopapproval
                                :route = route
                                :print_action = print_action
                                :approval_type = approval_type
                                :access=access
                                :api = api>
                            </dinasbopsupervisi-detail>
                        </div>
                        <div id="pengumpuldata" class="tab-pane fade" :class="{ 'active': (last_tab == 'pengumpuldata'), 'show': (last_tab == 'pengumpuldata') }">
                            <dinasboppengumpuldata-detail
                                :dinasbop=dinasbop
                                :dinasboppengumpuldata=dinasboppengumpuldata
                                :dinasboptimpengumpuldata=dinasboptimpengumpuldata
                                :dinasbopapproval=dinasbopapproval
                                :route=route
                                :print_action=print_action
                                :approval_type = approval_type
                                :access=access
                                :api=api>
                            </dinasboppengumpuldata-detail>
                        </div>
                        <div id="administrasi" class="tab-pane fade" :class="{ 'active': (last_tab == 'administrasi'), 'show': (last_tab == 'administrasi') }">
                            <dinasbopadministrasi-detail
                                :dinasbop=dinasbop
                                :dinasbopadministrasi=dinasbopadministrasi
                                :dinasboptimadministrasi=dinasboptimadministrasi
                                :dinasbopapproval=dinasbopapproval
                                :route=route
                                :print_action=print_action
                                :approval_type = approval_type
                                :access=access
                                :api=api>
                            </dinasbopadministrasi-detail>
                        </div>
                        <div id="custom" class="tab-pane fade" :class="{ 'active': (last_tab == 'custom'), 'show': (last_tab == 'custom') }">
                            <dinasbopcustom-detail
                                :dinasbop=dinasbop
                                :dinasbopcustom=dinasbopcustom
                                :dinasbopapproval=dinasbopapproval
                                :route=route
                                :print_action=print_action
                                :approval_type = approval_type
                                :access=access
                                :api=api>
                            </dinasbopcustom-detail>
                        </div>
                    </div>
                    <a :href="route" class="btn btn-danger"><i class="fa fa-arrow-left"></i> Kembali</a>
                    <a v-if="lock > 0 && dinasbop.status === 0" href="#" @click="toggleLockModal"
                        class="btn btn-warning"><i class="fa fa-lock"></i> Selesai
                    </a>
                    <div class="modal fade" id="lock_modal" tabindex="-1" role="dialog" @close="'close'">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title"><i class="fa fa-exclamation-triangle"></i> Mohon Perhatian</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>
                                        Tindakan ini bertujuan untuk mengunci perubahan dan menyelesaikan proses pada data dinas BOP yang bersangkutan. Mohon diperhatikan bahwa tindakan ini akan <b>menyebabkan data dinas tidak dapat diubah kembali</b>. Klik <b>Ya</b> jika anda setuju.
                                    </p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-success" @click="lockDinas">
                                        <i class="fa fa-check-circle-o"></i> Ya
                                    </button>
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">
                                        <i class="fa fa-times-circle-o"></i> Batal
                                    </button>
                                </div>
                            </div>
                        </div>
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
                isLoading: false,
                last_tab: '',
                approval_type: ''
            }
        },
        props: [
            'dinasbop',
            'dinasboptim',
            'dinasbopdriver',
            'dinasbopinspektur',
            'dinasbopsekretaris',
            'dinasbopreviu',
            'dinasbopsupervisi',
            'dinasboppengumpuldata',
            'dinasboptimpengumpuldata',
            'dinasbopadministrasi',
            'dinasboptimadministrasi',
            'dinasbopcustom',
            'dinasbopapproval',
            'lock',
            'route',
            'print_action',
            'access',
            'api'
        ],
        methods: {
            toggleLockModal() {
                $("#lock_modal").modal('show');
            },
            lockDinas() {
                service.putData(this.api + '/lock?id='+this.dinasbop.id)
                .then(response => {
                    if(response.status === 'ok') {
                        $('#lock_modal').modal('hide');
                        window.scroll({ top: 0, left: 0, behavior: 'smooth' });
                        alert('DATA DINAS BERHASIL DIKUNCI');
                        location.reload();
                    }
                }).catch(error => {
                    this.alert.delete = false;
                    this.alert.error = true;
                    $('#lock_modal').modal('hide');
                    alert('TERJADI KESALAHAN PADA SISTEM!');
                    window.scroll({ top: 0, left: 0, behavior: 'smooth' });
                    console.log(error);
                });
            },
            onChangeTabs(evt) {
                const data_set = evt.target.dataset.id;
                switch (data_set) {
                    case 'tabtim':
                        this.$cookies.set("last_tab", "tim");
                        break;
                    case 'tabdriver':
                        this.$cookies.set("last_tab", "driver");
                        break;
                    case 'tabinspektur':
                        this.$cookies.set("last_tab", "inspektur");
                        break;
                    case 'tabsekretaris':
                        this.$cookies.set("last_tab", "sekretaris");
                        break;
                    case 'tabreviu':
                        this.$cookies.set("last_tab", "reviu");
                        break;
                    case 'tabsupervisi':
                        this.$cookies.set("last_tab", "supervisi");
                        break;
                    case 'tabpengumpuldata':
                        this.$cookies.set("last_tab", "pengumpuldata");
                        break;
                    case 'tabadministrasi':
                        this.$cookies.set("last_tab", "administrasi");
                        break;
                    case 'tabcustom':
                        this.$cookies.set("last_tab", "custom");
                        break;
                    default:
                        break;
                }
            }
        },
        created() {
            this.isLoading = true;
            if (this.$cookies.isKey('last_tab') == false) {
                this.$cookies.set("last_tab", 'tim');
                this.last_tab = 'tim';
            } else {
                this.last_tab = this.$cookies.get("last_tab");
            }

            let level = this.$cookies.get('level');
            if (level === '1') {
                this.approval_type = 'administrator';
            } else if (level == '3') {
                if (this.$cookies.get('jabatan') == 'Inspektur') {
                    this.approval_type = 'inspektur';
                } else if (this.$cookies.get('jabatan') == 'Sekretaris') {
                    this.approval_type = 'sekretaris';
                } else if (this.$cookies.get('jabatan') == 'Kepala Sub Bagian Kepegawaian dan Umum') {
                    this.approval_type = 'kassubag';
                } else if (this.$cookies.get('jabatan') == 'Kepala Sub Bagian Keuangan dan Aset') {
                    this.approval_type = 'kassubag';
                } else if (this.$cookies.get('jabatan') == 'Kepala Sub Bagian Perencanaan dan Pelaporan') {
                    this.approval_type = 'kassubag';
                }
            } else if (level == '2') {
                this.approval_type = 'operator';
            }
        },
        mounted() {
            this.isLoading = false;
        }
    };
</script>
