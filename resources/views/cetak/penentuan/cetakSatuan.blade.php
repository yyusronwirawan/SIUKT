
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
                font-size: 16px;
                line-height: inherit;
                font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
				color: #555;
            }
          
            .table th {
                padding: 8px 8px;
                border:1px solid #000000;
                text-align: left;
            }
          
            .table td {
                padding: 3px 3px;
                border:1px solid #000000;
            }
          
            .text-left {
                text-align: left;
            }
        </style>
		<style>
			.invoice-box {
				max-width: 800px;
				margin: auto;
				padding: 30px;
				border: 1px solid #eee;
				box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
				font-size: 16px;
				line-height: 24px;
				font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
				color: #555;
			}

			.invoice-box table {
				width: 100%;
				line-height: inherit;
				text-align: left;
			}

			.invoice-box table td {
				padding: 5px;
				vertical-align: top;
			}

			.invoice-box table tr.top table td {
				padding-bottom: 20px;
			}

			.invoice-box table tr.top table td.title {
				font-size: 45px;
				line-height: 45px;
				color: #333;
			}

			.invoice-box table tr.information table td {
				padding-bottom: 40px;
			}

			.invoice-box table tr.heading td {
				background: #eee;
				border-bottom: 1px solid #ddd;
				font-weight: bold;
			}

			.invoice-box table tr.details td {
				padding-bottom: 20px;
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
					text-align: left;
				}

				.invoice-box table tr.information table td {
					width: 100%;
					display: block;
					text-align: left;
				}
			}

			/** RTL **/
			.invoice-box.rtl {
				direction: rtl;
				font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
			}

			.invoice-box.rtl table {
				text-align: right;
			}

			.invoice-box.rtl table tr td:nth-child(2) {
				text-align: left;
			}
			.bor {
				width: 200px; 
				border:1px solid black; 
				padding: 10px;
				text-align: left;
			}
		</style>
	</head>

	<body>
        <section>
            <div class="invoice-box">
                <table cellpadding="0" cellspacing="0">
                    <tr class="top">
                        <td colspan="2">
                            <table>
                                <tr>
                                    <td class="title">
                                        <img src="https://polsub.ac.id/wp-content/uploads/2021/12/logoPOLSUB-HD.png" style="width: 100%; max-width: 300px" />
                                    </td>

                                    <td style="text-align: right;">
                                        Politeknik Negeri Subang<br />
                                        Belakang RSUD, Jl. Brigjen Katamso No.37, Dangdeur, Kec. Subang, Kabupaten Subang, Jawa Barat 41211<br />
                                        info@polsub.ac.id<br />
                                        (0260) 417648
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </div>
        </section>

        <section class="sheet padding-10mm" style="margin-top: -30px;">
			<div class="invoice-box">
            <h3>{{$title}}</h3>
      
				<div style="margin-top: 10px;">
					<table style="width: 100%;">
						<tr>
							<td style="width: 200px;">Nama Lengkap</td>
							<td style="width: 10px;">:</td>
							<td>{{$detail->nama_mahasiswa}}</td>
						</tr>
						<tr>
							<td>NIM</td>
							<td>:</td>
							<td>{{$detail->nim}}</td>
						</tr>
						<tr>
							<td>Tahun Angkatan</td>
							<td>:</td>
							<td>{{$detail->tahun_angkatan}}</td>
						</tr>
						<tr>
							<td>Program Studi</td>
							<td>:</td>
							<td>{{$detail->prodi}}</td>
						</tr>
						<tr>
							<td>Email</td>
							<td>:</td>
							<td>{{$detail->email}}</td>
						</tr>
						<tr>
							<td>Uang Kuliah Tunggal (UKT)</td>
							<td>:</td>
							<td>{{$detail->kelompok_ukt}} / {{'Rp '.number_format($detail->nominal, 0, ',', '.')}}</td>
						</tr>
					</table>
				</div>

				<div style="margin-top: 20px;">
					<table style="width: 100%;">
						<tr>
							<th style="width: 200px; text-align: left;">Keterangan:</th>
						</tr>
						<tr>
							@if ($detail->status_penentuan == 'Setuju')
							<td>Proses Penentuan UKT <strong>Disetujui</strong>.</td>
							@elseif($detail->status_penentuan == 'Tidak Setuju')
							<td>Proses Penentuan UKT <strong>Tidak Disetujui</strong>.</td>
							@elseif($detail->status_penentuan == 'Proses')
							<td>Proses Penentuan UKT sedang <strong>Diproses</strong>.</td>
							@endif
						</tr>
					</table>
				</div>

				<div style="margin-top: 20px;">
					<table style="width: 100%; border:1px solid black; border-collapse: collapse;">
					<tr>
						<th class="bor">Dokumen</th>
						<th class="bor">Status</th>
					</tr>
                    @if ($detail->kk != null)
                    <tr>
                        <td class="bor">Kartu keluarga</td>
                        <td class="bor">
                            @if ($detail->kk)
                                Terlampir di Sistem
                            @else
                                Tidak Terlampir
                            @endif
                        </td>
                    </tr>
                    @endif
                    @if ($detail->struk_listrik != null)
                    <tr>
                        <td class="bor">Struk Listrik</td>
                        <td class="bor">
                            @if ($detail->struk_listrik)
                                Terlampir di Sistem
                            @else
                                Tidak Terlampir
                            @endif
                        </td>
                    </tr> 
                    @endif
                    @if ($detail->struk_air != null)
                    <tr>
                        <td class="bor">Struk Listrik</td>
                        <td class="bor">
                            @if ($detail->struk_air)
                                Terlampir di Sistem
                            @else
                                Tidak Terlampir
                            @endif
                        </td>
                    </tr> 
                    @endif
                    @if ($detail->slip_gaji != null)
                    <tr>
                        <td class="bor">Slip Gaji</td>
                        <td class="bor">
                            @if ($detail->slip_gaji)
                                Terlampir di Sistem
                            @else
                                Tidak Terlampir
                            @endif
                        </td>
                    </tr> 
                    @endif
					</table>
				</div>
			</div>
        </section>
	</body>
</html>