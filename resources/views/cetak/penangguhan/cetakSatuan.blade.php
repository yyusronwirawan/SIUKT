<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>{{$title}}</title>

        <style>
            @page { size: A4 }
          
            h3 {
                font-weight: bold;
                text-align: center;
                font-size: 16px;
                line-height: inherit;
                font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
				color: #555;
            }
          
            .table {
                border-collapse: collapse;
                width: 100%;
                font-size: 12pt;
                line-height: inherit;
                font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
				color: #555;
            }
          
            .table th {
                padding: 1px 1px;
                border:1px solid #000000;
            }
          
            .table td {
                padding: 1px 1px;
                border:1px solid #000000;
            }
          
            .text-center {
                text-align: center;
            }
        </style>
		<style>
			.invoice-box {
				max-width: 800px;
				margin: auto;
				padding: 1px;
				border: 1px solid #eee;
				box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
				font-size: 12px;
				line-height: 8px;
				font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
				color: #555;
			}

			.invoice-box table {
				width: 100%;
				line-height: inherit;
				text-align: left;
			}

			.invoice-box table td {
				padding: 1px;
				vertical-align: top;
			}

			.invoice-box table tr td:nth-child(2) {
				text-align: left;
			}

			.invoice-box table tr.top table td {
				padding-bottom: 1px;
			}

			.invoice-box table tr.top table td.title {
				font-size: 45px;
				line-height: 45px;
				color: #333;
			}

			.invoice-box table tr.information table td {
				padding-bottom: 1px;
			}

			.invoice-box table tr.heading td {
				background: #eee;
				border-bottom: 1px solid #ddd;
				font-weight: bold;
			}

			.invoice-box table tr.details td {
				padding-bottom: 1px;
			}

			.invoice-box table tr.item td {
				border-bottom: 1px solid #eee;
			}

			.invoice-box table tr.item.last td {
				border-bottom: none;
			}

			.invoice-box table tr.total td:nth-child(2) {
				border-top: 2px solid #eee;
				font-weight: bold;
			}

			@media only screen and (max-width: 600px) {
				.invoice-box table tr.top table td {
					width: 100%;
					display: block;
					text-align: center;
				}

				.invoice-box table tr.information table td {
					width: 100%;
					display: block;
					text-align: center;
				}
			}

			/** RTL **/
			.invoice-box.rtl {
				direction: rtl;
				font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
			}

			.invoice-box.rtl table {
				text-align: left;
			}

			.invoice-box.rtl table tr td:nth-child(2) {
				text-align: left;
			}
		</style>
	</head>

	<body>

        <section class="sheet padding-10mm" style="margin: 28px;">

            <div>
                <table style="width: 100%;">
                    <tr>
                        <th style="text-align: left; border-left: 0;">Kepada</th>
                    </tr>
                    <tr>
                        <th style="text-align: left; border-left: 0;">Wakil Direktur II Politeknik Negeri Subang</th>
                    </tr>
                    <tr>
                        <th style="text-align: left; border-left: 0;">Di</th>
                    </tr>
                    <tr>
                        <th style="text-align: left; border-left: 0;">Tempat</th>
                    </tr>
                </table>
            </div>

            <div style="margin-top: 20px;">
                <table style="width: 100%;">
                    <tr>
                        <td style="text-align: left; border-left: 0;">Dengan hormat</td>
                    </tr>
                    <tr>
                        <td style="text-align: left; border-left: 0;">Yang bertanda tangan di bawah ini:</td>
                    </tr>
                </table>
            </div>
      
            <div style="margin-top: 10px;">
                <table style="width: 100%;">
                    <tr>
                        <td style="width: 200px;">Nama</td>
                        <td style="width: 10px;">:</td>
                        <td>{{$detail->nama_orang_tua}}</td>
                    </tr>
                    <tr>
                        <td>Alamat Orang Tua</td>
                        <td>:</td>
                        <td>{{$detail->alamat_orang_tua}}</td>
                    </tr>
                    <tr>
                        <td>No. HP</td>
                        <td>:</td>
                        <td>{{$detail->nomor_telepon_orang_tua}}</td>
                    </tr>
                </table>
            </div>

            <div style="margin-top: 10px;">
                <table style="width: 100%;">
                    <tr>
                        <td colspan="3">Orang tua/Wali dari Mahasiswa Politeknik Negeri Subang:</td>
                    </tr>
                    <tr>
                        <td style="width: 200px;">Nama</td>
                        <td style="width: 10px;">:</td>
                        <td>{{$detail->nama_mahasiswa}}</td>
                    </tr>
                    <tr>
                        <td>NIM</td>
                        <td>:</td>
                        <td>{{$detail->nim}}</td>
                    </tr>
                    <tr>
                        <td>Program Studi</td>
                        <td>:</td>
                        <td>{{$detail->prodi}}</td>
                    </tr>
                    <tr>
                        <td>No. HP</td>
                        <td>:</td>
                        <td>{{$detail->nomor_telepon}}</td>
                    </tr>
                </table>
            </div>

            <div style="margin-top: 10px;">
                <table style="width: 100%;">
                    <tr>
                        <td colspan="5">Bermaksud untuk mengajukan permohonan penangguhan pembayaran Uang Kuliah Tunggal (UKT) Semester {{$detail->semester}} sebesar Rp. {{number_format($detail->nominal_ukt, 0, ',', '.')}} dan Denda Keterlambatan {{$setting->persen_denda}}% dari UKT sebesar Rp. {{number_format($detail->denda, 0, ',', '.')}}. Permohonan penangguhan UKT tersebut dikarenakan {{$detail->alasan}}.</td>
                    </tr>
                    <tr>
                        <td colspan="5">Pembayaran UKT akan dibayar pada:</td>
                    </tr>
                    <tr>
                        <td style="width: 30px; text-align: right;">1.</td>
                        <td style="width: 100px;">Angsuran Pertama</td>
                        <td style="width: 100px;">Rp. {{number_format($detail->angsuran_pertama, 0, ',', '.')}}</td>
                        <td style="width: 50px;">Tanggal</td>
                        <td style="width: 100px;">{{date('d F Y', strtotime($detail->tanggal_angsuran_pertama))}}</td>
                    </tr>
                    <tr>
                        <td style="width: 30px; text-align: right;">2.</td>
                        <td>Angsuran Kedua</td>
                        <td>Rp. {{number_format($detail->angsuran_kedua, 0, ',', '.')}}</td>
                        <td>Tanggal</td>
                        <td>{{date('d F Y', strtotime($detail->tanggal_angsuran_kedua))}}</td>
                    </tr>
                </table>
            </div>

            <div style="margin-top: 10px;">
                <table style="width: 100%;">
                    <tr>
                        <td><strong>Jika saya tidak memenuhi kesanggupan dalam pembayaran UKT tersebut, maka saya bersedia menerima sanksi sesuai dengan peraturan yang berlaku di Politeknik Negeri Subang.</strong></td>
                    </tr>
                    <tr>
                        <td>Demikian surat permohonan ini kami buat. Atas perhatian Bapak/Ibu, kami ucapkan terima kasih.</td>
                    </tr>
                </table>
            </div>
            <div style="margin-top: 10px;">
                <table style="width: 100%;">
                    <tr>
                        <td colspan="3" style="text-align: right;">Subang, {{date('d F Y', strtotime($detail->tanggal_pengajuan))}}</td>
                    </tr>
                    <tr>
                        <td colspan="3">Menyetujui,</td>
                    </tr>
                    <tr>
                        <td>Koordinator Ketatausahaan,</td>
                        <td style="width: 5px;"></td>
                        <td style="width: 200px;">Orang tua/Wali Mahasiswa</td>
                    </tr>
                    <tr>
                        <td style="padding-top: 5px; padding-bottom: 5px;" @if($detail->kabag && $detail->status_penangguhan === 'Setuju') @else style="height: 80px;"@endif>@if($detail->kabag && $detail->status_penangguhan === 'Setuju') <img src="https://ukt.elearningpolsub.com/gambar/Tanda.png" width="33%" alt=""> @endif</td>
                        {{-- <td style="padding-top: 5px; padding-bottom: 5px;" @if($detail->kabag && $detail->status_penangguhan === 'Setuju') @else style="height: 80px;"@endif>@if($detail->kabag && $detail->status_penangguhan === 'Setuju') <img src="https://ukt.elearningpolsub.com/gambar/{{$setting->tanda_tangan_kabag}}" width="33%" alt=""> @endif</td> --}}
                        <td></td>
                        <td>Materai 10.0000</td>
                    </tr>
                    <tr>
                        <td>Zaenal Abidin, S.Pdl., M.Si</td>
                        <td></td>
                        <td>{{$detail->nama_orang_tua}}</td>
                    </tr>
                    <tr>
                        <td>NIP 196704221996011000</td>
                        <td></td>
                        <td></td>
                    </tr>
                </table>
            </div>
        </section>
	</body>
</html>