<aside class="main-sidebar sidebar-dark-primary elevation-2">
    <a href="#" class="brand-link">
        <span class="brand">SIPD</span>
        <span class="brand-text font-weight-light">Inspektorat</span>
    </a>
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-flat nav-compact mt-sm-4" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    <a @if($link=='dashboard') class="nav-link active" @else class="nav-link" @endif
                    href="{!! url('dashboard') !!}">
                        <i class="nav-icon fa fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li @if (in_array($link, ['dinasregular','dinasbop'])) class="nav-item has-treeview" @else
                class="nav-item has-treeview" @endif>
                    <a class="nav-link" href="#"><i class="nav-icon fa fa-envelope-o"></i>
                        <p>Data Perjalanan Dinas <i class="fa fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a class="nav-link" href="{!! url('dinasregular') !!}">
                                <i class="nav-icon fa fa-circle-o"></i>
                                <p>Perjalanan Dinas Reguler</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{!! url('dinasbop') !!}">
                                <i class="nav-icon fa fa-circle-o"></i>
                                <p>Perjalanan Dinas BOP</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <?php
                $routes_master = [
                    'program',
                    'kegiatan',
                    'belanja',
                    'pegawai',
                    'pokja',
                    'perangkatdaerah',
                    'user',
                    'irban',
                    'irbanskpd',
                    'irbankabkota',
                    'logaktifitas'
                ];

                $routes_keuangan = [
                    'anggaran',
                    'bop',
                    'harian',
                    'akomodasi',
                    'bbm',
                    'hargabbm'
                ];
                ?>
                @if (in_array(Cookie::get('level'), ['1','2']))
                    <li @if (in_array($link, $routes_master)) class="nav-item has-treeview" @else class="nav-item has-treeview" @endif>
                        <a class="nav-link" href="#"><i class="nav-icon fa fa-database"></i>
                            <p>Data Master <i class="fa fa-angle-left right"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a class="nav-link" href="{!! url('user') !!}">
                                    <i class="nav-icon fa fa-circle-o"></i>
                                    <p>User</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{!! url('pegawai') !!}">
                                    <i class="nav-icon fa fa-circle-o"></i>
                                    <p>Pegawai Inspektorat</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{!! url('pokja') !!}">
                                    <i class="nav-icon fa fa-circle-o"></i>
                                    <p>Kelompok Kerja</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{!! url('perangkatdaerah') !!}">
                                    <i class="nav-icon fa fa-circle-o"></i>
                                    <p>Perangkat Daerah</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{!! url('irban') !!}">
                                    <i class="nav-icon fa fa-circle-o"></i>
                                    <p>Irban</p>
                                </a>
                            </li>
                            <li @if (in_array($link, ['irbanskpd','irbankabkota'])) class="nav-item has-treeview" @else class="nav-item has-treeview" @endif>
                                <a class="nav-link" href="#">
                                    <i class="nav-icon fa fa-circle-o"></i>
                                    <p>Pembagian Wilayah Irban</p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a class="nav-link" href="{!! url('irbanskpd') !!}">
                                            <i class="nav-icon fa fa-star"></i>
                                            <p>Pembagian Perangkat Daerah</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{!! url('irbankabkota') !!}">
                                            <i class="nav-icon fa fa-star"></i>
                                            <p>Pembagian Kabupaten / Kota</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{!! url('program') !!}">
                                    <i class="nav-icon fa fa-circle-o"></i>
                                    <p>Program</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{!! url('kegiatan') !!}">
                                    <i class="nav-icon fa fa-circle-o"></i>
                                    <p>Kegiatan</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{!! url('belanja') !!}">
                                    <i class="nav-icon fa fa-circle-o"></i>
                                    <p>Data Belanja</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif

                @if (in_array(Cookie::get('level'), ['1','2']))
                    <li @if (in_array($link, $routes_keuangan)) class="nav-item has-treeview" @else class="nav-item has-treeview" @endif>
                        <a class="nav-link" href="#"><i class="nav-icon fa fa-dollar"></i>
                            <p>Master Keuangan <i class="fa fa-angle-left right"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a class="nav-link" href="{!! url('anggaran') !!}">
                                    <i class="nav-icon fa fa-circle-o"></i>
                                    <p>Anggaran Kas Bulanan</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{!! url('bop') !!}">
                                    <i class="nav-icon fa fa-circle-o"></i>
                                    <p>Besaran BOP</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{!! url('harian') !!}">
                                    <i class="nav-icon fa fa-circle-o"></i>
                                    <p>Besaran Uang Harian</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{!! url('akomodasi') !!}">
                                    <i class="nav-icon fa fa-circle-o"></i>
                                    <p>Besaran Uang Akomodasi</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{!! url('bbm') !!}">
                                    <i class="nav-icon fa fa-circle-o"></i>
                                    <p>Besaran BBM Per Liter</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{!! url('hargabbm') !!}">
                                    <i class="nav-icon fa fa-circle-o"></i>
                                    <p>Harga BBM Per Liter</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif

                <li class="nav-item">
                    <a @if($link=='logaktifitas' ) class="nav-link active" @else class="nav-link" @endif href="{!! url('logaktifitas') !!}">
                        <i class="nav-icon fa fa-file-text-o"></i>
                        <p>Log Aktifitas</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a @if($link=='report' ) class="nav-link active" @else class="nav-link" @endif
                    href="{!! url('report') !!}">
                        <i class="nav-icon fa fa-file-excel-o"></i>
                        <p>Cetak Laporan</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a @if($link=='profile' ) class="nav-link active" @else class="nav-link" @endif
                    href="{!! url('profile') !!}">
                        <i class="nav-icon fa fa-lock"></i>
                        <p>Ganti Password</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{!! url('logout') !!}">
                        <i class="nav-icon fa fa-sign-out"></i>
                        <p>Log Out</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
