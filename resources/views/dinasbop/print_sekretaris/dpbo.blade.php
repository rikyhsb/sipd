<?php
use App\Libraries\Common;
use App\Libraries\TimDinas;

$common = new Common();
$timdinas = new TimDinas();
$dari = date_create($dinasbopsekretaris->dari);
$sampai = date_create($dinasbopsekretaris->sampai);
$diff = date_diff($dari, $sampai);
$durasi = $diff->days + 1;
$kpa = $timdinas->get_sekretaris();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Pembayaran Biaya Operasional Inspektorat</title>
    <link rel="stylesheet" href="{!! asset('css/bootstrap.min.css') !!}">
    <style type="text/css" media="print">
        @page {
            size: auto;
        }
    </style>
    <style type="text/css">
        body {
            margin: 0px;
        }

        * {
            font-family: 'Times New Roman', Times, serif;
            font-size: 9pt;
        }

        h4 {
            font-size: 14pt;
        }
    </style>
</head>
<body onload="window.print()">
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <strong><u><h4 class="text-center">INSPEKTORAT DAERAH PROVINSI JAWA BARAT</h4></u></strong>
            <br>
            <div style="text-align: center;">
                <table width="75%">
                    <tr>
                        <td style="width:2%;vertical-align:top;">DAFTAR</td>
                        <td style="width:2%;vertical-align:top;">: </td>
                        <td style="width:70%;vertical-align:top;text-align: justify;">PENERIMAAN BIAYA OPERASIONAL INSPEKTORAT BELANJA {!! strtoupper($dinasbopsekretaris->dinasbop->belanja->nama_belanja) !!} SELAMA {!! $durasi !!} ({!! strtoupper($common->terbilang($durasi)) !!}) HARI MULAI TANGGAL {!! strtoupper($common->generate_indonesia_date($dinasbopsekretaris->dari)) !!} SAMPAI DENGAN {!! strtoupper($common->generate_indonesia_date($dinasbopsekretaris->sampai)) !!} UNTUK MELAKUKAN {!! strtoupper($dinasbopsekretaris->dinasbop->program->nama_program) !!}</td>
                    </tr>
                </table>
            </div>
            <br>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th width="2%" style="text-align: center;vertical-align:middle;">NO</th>
                    <th width="20%" style="text-align:center;vertical-align:middle;">NAMA</th>
                    <th width="20%" style="text-align:center;vertical-align:middle;">JABATAN &nbsp; GOL</th>
                    <th width="7%" style="text-align:center;vertical-align:middle;">BIAYA OPERASIONAL</th>
                    <th width="2%" style="text-align:center;vertical-align:middle;">UANG SAKU</th>
                    <th width="2%" style="text-align:center;vertical-align:middle;">TRANSPORTASI</th>
                    <th width="10%" style="text-align:center;vertical-align:middle;">JUMLAH YANG DITERIMA</th>
                    <th width="10%" style="text-align:center;vertical-align:middle;">TANDA TANGAN PENERIMA</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td style="text-align: center;">1</td>
                    <td>{!! $dinasbopsekretaris->sekretaris['nama'] !!}</td>
                    <td style="text-align: center;">WAKIL PENANGGUNGJAWAB {!! $dinasbopsekretaris->sekretaris['golongan'] !!}</td>
                    <td style="text-align: right;">Rp.{!! $common->rupiah($dinasbopsekretaris->sekretaris['total']) !!}</td>
                    <td></td>
                    <td></td>
                    <td style="text-align: right;">Rp.{!! $common->rupiah($dinasbopsekretaris->sekretaris['total']) !!}</td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="6" style="text-align: center;"><b>JUMLAH</b></td>
                    <td style="text-align: right;"><b>Rp.{!! $common->rupiah($dinasbopsekretaris->total) !!}</b></td>
                    <td></td>
                </tr>
                </tbody>
            </table>
            Terbilang : <i>{!! $common->terbilang($dinasbopsekretaris->total) !!} rupiah *</i>
            <br><br>
            <table width="100%">
                <tr>
                    <td width="25%"></td>
                    <td width="25%">
                        <div style="text-align: center;">
                            <table cellpadding="2" cellspacing="2">
                                <tr>
                                    <td width="10%" style="text-align: center;">Bandung, {!! Carbon\Carbon::parse(date('Y-m-d'))->formatLocalized('%d %B %Y') !!}</td>
                                </tr>
                            </table>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td width="25%">
                        <table cellpadding="2" cellspacing="2" style="width:100%;">
                            <tr>
                                <td width="20%" style="text-align: center;">Setuju dibayar</td>
                            </tr>
                            <tr>
                                <td width="20%" style="text-align: center;"><b>KUASA PENGGUNA ANGGARAN</b></td>
                            </tr>
                            <tr>
                                <td width="10%" style="text-align: center;"><br><br><br><br></td>
                            </tr>
                            <tr>
                                <td width="10%" style="text-align: center;">{!! $kpa['nama'] !!}</td>
                            </tr>
                            <tr>
                                <td width="10%" style="text-align: center;">{!! $kpa['pangkat'] !!}</td>
                            </tr>
                            <tr>
                                <td width="10%" style="text-align: center;">NIP. {!! $kpa['nip'] !!}</td>
                            </tr>
                        </table>
                    </td>
                    <td width="25%">
                        <table cellpadding="2" cellspacing="2" style="width:100%;">
                            <tr>
                                <td width="20%" style="text-align: center;">Lunas dibayar</td>
                            </tr>
                            <tr>
                                <td width="20%" style="text-align: center;"><b>Bendahara Pengeluaran Pembantu</b></td>
                            </tr>
                            <tr>
                                <td width="10%" style="text-align: center;"><br><br><br><br></td>
                            </tr>
                            <tr>
                                <td width="10%" style="text-align: center;">{!! $dinasbopsekretaris->dinasbop->kegiatan->pegawai->nama !!}</td>
                            </tr>
                            <tr>
                                <td width="10%" style="text-align: center;">{!! $dinasbopsekretaris->dinasbop->kegiatan->pegawai->pangkat !!}</td>
                            </tr>
                            <tr>
                                <td width="10%" style="text-align: center;">NIP. {!! $dinasbopsekretaris->dinasbop->kegiatan->pegawai->nip !!}</td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
</body>
</html>
