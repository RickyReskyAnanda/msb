<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>BERITA ACARA MUSRENBANG</title>
<style>
table
{
border-collapse:collapse;
}

.tabel table, .tabel th,.tabel td
{
	

border:1px solid black;
}
</style>

</head>

<body style="width: 760px	">
<p align="center">BERITA  ACARA<br />
  HASIL KESEPAKATAN  MUSRENBANG RKPD<br />
  KABUPATEN YALIMO<br />
  DI DISTRIK  {{strtoupper($detail->distrik->nm_distrik)}} TAHUN 2016</p>
<p align="center">&nbsp;</p>
<p>Pada hari {{ucfirst($detail->hari)}} tanggal {{$detail->tgl}} bertempat di 
 {{$detail->tempat}} di Distrik {{$detail->kode_wilayah}} telah  diselenggarakan Musrenbang RKPD Kabupaten Yalimo di Distrik {{$detail->kode_wilayah}} yang dihadiri  pemangku kepentingan sesuai dengan daftar hadir peserta yang tercantum dalam LAMPIRAN  I berita acara ini.<br />
  Setelah memperhatikan,  mendengar dan mempertimbangkan:</p>
<ol>
  <li>Sambutan-sambutan  yang disampaikan oleh.</li>
  <ol type="a">
  @foreach($detail->sambutan as $sambut)
  	<li>{{$sambut->sambutan_oleh}}</li>
  @endforeach
  </ol>
  
<p>Pada Acara pembukaan Musrenbang Distrik</p>

  <li>Pemaparan  materi lainnya  Dakwah</li>
  <li>Tanggapan  dan saran dari seluruh peserta Musrenbang Distrik terhadap bahan diskusi  sebagaimana telah dirangkum menjadi hasil keputusan kelompok diskusi Musrenbang  Distrik, maka pada:</li>
</ol>

<p style="margin-left: 100px">
<table><tr><td>Hari, Tanggal</td><td>:</td><td>{{$detail->hari}}, {{$detail->tgl}}  </td></tr>
  <tr><td>J a m </td><td>:</td><td>{{$detail->pukul}}</td></tr>
 <tr><td>Tempat </td><td>:</td><td>{{$detail->tempat}}</td></tr>
 <tr><td> Musrenbang Distrik  </td><td>:</td><td><?=ucwords($detail->distrik->nm_distrik)?></td></tr>
</table>
</p>
<p style="margin-left: 10px">
<table><tr><td colspan="3" style="text-align: center">MENYEPAKATI</td></tr>
  <tr><td valign="top">KESATU</td><td valign="top">:</td><td>Pekerjaan  dan sasaran &nbsp;prioritas yang disertai  target dan kebutuhan pendanaan dalam Daftar Pekerjaan Prioritas Distrik <?=ucwords($kec_name)?> Kabupaten Yalimo Tahun 2017 sebagaimana  tercantum dalam LAMPIRAN II berita acara ini.</td></tr>
 <tr><td valign="top">KEDUA </td><td valign="top">:</td><td>Usulan  pekerjaan yang belum dapat diakomodir sebagai usulan Distrik dan usulan cadangan tercantum dalam LAMPIRAN III&nbsp; berita acara ini</td></tr>
 <tr><td valign="top"> KETIGA  </td><td valign="top">:</td><td>Hasil  sidang-sidang kelompok Musrenbang Distrik <?=ucwords($kec_name)?> Kabupaten Yalimo Tahun {{date('Y')}} dan daftar&nbsp; hadir peserta Musrenbang Distrik sebagaimana  tercantum dalam Lampiran I, LAMPIRAN II dan LAMPIRAN III merupakan satu  kesatuan dan merupakan bagian yang tidak terpisahkan dari berita acara ini.</td></tr>
 
 <tr><td valign="top"> KEEMPAT  </td><td valign="top">:</td><td>Untuk pekerjaan fisik, apabila lokasi yang diusulkan merupakan milik perorangan atau sedang dalam konflik gugatan, atau berada dalam perumahan yang prasarana, sarana, dan utilitas (PSU) belum diserah terimakan kepada Pemerintah Kabupaten Yalimo atau milik Instansi Lain (Kementrian/BUMD/BUMN) maka Pemerintah Kabupaten Yalimo dapat membatalkan usulan tersebut.</td>
 </tr>

 <tr>
   <td valign="top"> KELIMA  </td>
   <td valign="top">:</td><td>Berita acara ini dapat dijadikan sebagai bahan penyusunan rancangan RKPD Kabupaten Yalimo Tahun {{date('Y')}}.</td></tr>
<tr>
   <td valign="top"> KEENAM  </td>
   <td valign="top">:</td><td>Sesuai ketentuan yang tertuang dalam Pasal 298 ayat (5) Undang-Undang Nomor 23 Tahun 2014 tentang Pemerintahan Daerah yang menyebutkan bahwa penerima Belanja Hibah dapat diberikan kepada badan, lembaga, dan organisasi kemasyarakatan yang berbadan hukum Indonesia. Maka untuk usulan pekerjaan non fisik antara lain: <br>
	1) Alat Permainan Eduikasi (APE), 
	2) Bola, 
	3) Gerobak Sampah, 
	4) Keranjang Takakura, 
	5) Meja Ping Pong, 
	6) Net Voly, 
	7) Paket Hidroponik, 
	8) Paket Perikanan Tangkap Perahu dan Mesin Perahu, 
	9) Paket Bibit Perikanan Raket Badminton, 
	10) Tabulapot, 
	11) Terompah Panjang, 
	12) Tong Komposter, dapat di realisasi sesuai dengan ketentuan yang berlaku yaitu penerima barang tersebut harus berbadan hukum. Untuk proses verifikasi usulan tersebut pengusul harus menyampaikan Surat Keputusan Status Badan Hukum sebelum bulan {{date('M Y')}}. </td></tr>

</table>
<p>Demikian berita acara ini  dibuat dan disahkan untuk digunakan sebagaimana mestinya.
   </p>
 <div style="float: right; display: block;">
   Yalimo, {{$detail->hari.','.$detail->tgl}}<br />
  <p align="center">Pimpinan Sidang </p>
  
  
  <br>
  <Br>
<p align="center">&nbsp;(  {{$detail->pimpinan_sidang}})</p>
</div>


<br/><br/><br/><br/><br/><br/><br/><br/>


<DIV style="page-break-after:always"></DIV>

  <div style="margin-left: 400px">
<table width="100%"><tr><td nowrap=""  valign="top">LAMPIRAN I </td><td  valign="top">:</td><td>Berita Acara Kesepakatan Hasil Musrenbang Distrik <?=ucwords($kec_name)?>  </td></tr>
  <tr><td></td><td> </td><td>Nomor   : {{$detail->no_ba}}  </td></tr>
 <tr><td></td><td> </td><td>Tanggal   : {{$detail->tgl_ba}}  </td></tr>
 <tr><td colspan="3"><hr> </td></tr>
 </table>
</div>

<p style="margin-left: 10px">
<table width="100%"><tr><td colspan="3" style="text-align: center"><h4>Daftar Hadir Musrenbang Distrik</h4>  </td></tr>
  <tr><td valign="top" width="10px">Distrik</td><td valign="top" width="1px">:</td><td> {{ucwords($kec_name)}} </td></tr>
</table>
 
 <table width="100%" cellpadding="5px" cellspacing="0px"   class="tabel">
 	<tr><td>No </td><td>Nama</td><td>Alamat</td><td>Asal</td><td>Tanda tangan</td></tr>
 	<?php $i=1;?>
	@foreach($detail->peserta as $peserta)
		<tr>
    <td>{{$i++}}</td>
    <td>{{$peserta->anggota}}</td>
    <td>{{$peserta->alamat}}</td>
    <td>{{$peserta->asal}}</td>
    <td>&nbsp;</td>
    </tr>
	@endforeach
	
 </table>
</p>


<DIV style="page-break-after:always"></DIV>

  <div style="margin-left: 400px">
<table width="100%"><tr><td nowrap=""  valign="top">LAMPIRAN II </td><td  valign="top">:</td><td>Berita Acara Kesepakatan Hasil Musrenbang Distrik <?=ucwords($kec_name)?>  </td></tr>
  <tr><td></td><td> </td><td>Nomor   : {{$detail->no_ba}}  </td></tr>
 <tr><td></td><td> </td><td>Tanggal   : {{$detail->tgl_ba}}  </td></tr>
 <tr><td colspan="3"><hr> </td></tr>
 </table>
</div>


<p style="margin-left: 10px">
<table width="100%"><tr><td colspan="3" style="text-align: center"><h4>Daftar Usulan yang Disetujui</h4>  </td></tr>
  <tr><td valign="top" width="10px">Distrik</td><td valign="top" width="1px">:</td><td> {{ucwords($kec_name)}} </td></tr>
</table>
 <table width="100%" cellpadding="5px" cellspacing="0px"    bordercolordark ="white" class="tabel">
 	<tr bgcolor="#e7de45"><td nowrap="" >No </td><td>Pengusul</td><td>Usulan</td><td>Lokasi</td><td>Keterangan</td><td>Volume</td><td>Catatan Distrik-SKPD</td><td>Biaya</td></tr>
  <?php $i=1;?>
  @foreach($usulan as $usul)
    @if($usul->level == 'UTAMA' && $usul->sts_usulan=='DIPROSES SKPD')
		<tr>
      <td nowrap="" >{{$i++}} </td>
      <td>Kampung {{$usul->desa->nm_desa}}</td>
      <td>{{$usul->nama_pekerjaan}}</td>
      <td>{{$usul->jalan}} ({{$usul->ket_lokasi}})</td>
      <td>{{$usul->keterangan}}</td>
      <td>{{$usul->volume.'/'.$usul->satuan}}</td>
      <td>{{$usul->keterangan_distrik}}</td>
      <td>{{"Rp." .number_format($usul->harga  * $usul->volume)}}</td>
    </tr>
    @endif
  @endforeach
 </table>
<br>


<DIV style="page-break-after:always"></DIV>

  <div style="margin-left: 400px">
<table width="100%"><tr><td nowrap=""  valign="top">LAMPIRAN III </td><td  valign="top">:</td><td>Berita Acara Kesepakatan Hasil Musrenbang Distrik <?=ucwords($kec_name)?>  </td></tr>
  <tr><td></td><td> </td><td>Nomor   : {{$detail->no_ba}}  </td></tr>
 <tr><td></td><td> </td><td>Tanggal   : {{$detail->tgl_ba}}  </td></tr>
 <tr><td colspan="3"><hr> </td></tr>
 </table>
</div>



<p style="margin-left: 10px">
<table width="100%"><tr><td colspan="3" style="text-align: center"><h4>Daftar Usulan yang Belum Disetujui</h4>  </td></tr>
  <tr><td valign="top" width="10px">Distrik</td><td valign="top" width="1px">:</td><td> <?php echo $kec_name ; ?> </td></tr>
</table>

<table width="100%" cellpadding="5px" cellspacing="0px"    bordercolordark ="white" class="tabel">
 	<tr bgcolor="#e7de45"><td nowrap="" >No </td><td>Pengusul</td><td>Usulan</td><td>Lokasi</td><td>Keterangan</td><td>Volume</td><td>Catatan Distrik-SKPD</td><td>Biaya</td></tr>
		<?php $i=1;?>
  @foreach($usulan as $usul)
    @if($usul->level == 'UTAMA' && $usul->sts_usulan!='DIPROSES SKPD')
    <tr><td nowrap="" >{{$i++}} </td><td>Kampung {{$usul->desa->nm_desa}}</td><td>{{$usul->nama_pekerjaan}}</td><td>{{$usul->jalan}} ({{$usul->ket_lokasi}})</td><td>{{$usul->keterangan}}</td><td>{{$usul->volume.'/'.$usul->satuan}}</td><td>{{$usul->keterangan_distrik}}</td><td>{{"Rp." .number_format($usul->harga  * $usul->volume)}}</td></tr>
    @endif
  @endforeach
 </table>
</p>
<br>


<br/>
<br/>


<p style="margin-left: 10px">
<table width="100%"><tr><td colspan="3" style="text-align: center"><h4>Daftar Usulan Cadangan</h4>  </td></tr>
  <tr><td valign="top" width="10px">Distrik</td><td valign="top" width="1px">:</td><td> <?php echo $kec_name ; ?> </td></tr>
</table>

<table width="100%" cellpadding="5px" cellspacing="0px"    bordercolordark ="white" class="tabel">
 	<tr bgcolor="#e7de45"><td nowrap="" >No </td><td>Pengusul</td><td>Usulan</td><td>Lokasi</td><td>Keterangan</td><td>Volume</td><td>Catatan Distrik-SKPD</td><td>Biaya</td></tr>
	  <?php $i=1;?>
  @foreach($usulan as $usul)
    @if($usul->level == 'CADANGAN')
    <tr><td nowrap="" >{{$i++}} </td><td>Kampung {{$usul->desa->nm_desa}}</td><td>{{$usul->nama_pekerjaan}}</td><td>{{$usul->jalan}} ({{$usul->ket_lokasi}})</td><td>{{$usul->keterangan}}</td><td>{{$usul->volume.'/'.$usul->satuan}}</td><td>{{$usul->keterangan_distrik}}</td><td>{{"Rp." .number_format($usul->harga  * $usul->volume)}}</td></tr>
    @endif
  @endforeach
</table>
</p>




<DIV style="page-break-after:always"></DIV>

  <div style="margin-left: 400px">
<table width="100%"><tr><td nowrap=""  valign="top">LAMPIRAN IV </td><td  valign="top">:</td><td>Berita Acara Kesepakatan Hasil Musrenbang Distrik <?php echo $kec_name; ?>  </td></tr>
  <tr><td></td><td> </td><td>Nomor   : {{$detail->no_ba}}  </td></tr>
 <tr><td></td><td> </td><td>Tanggal   : {{$detail->tgl_ba}}  </td></tr>
 <tr><td colspan="3"><hr> </td></tr>
 </table>
</div>

<p style="margin-left: 10px">
<table width="100%"><tr><td colspan="3" style="text-align: center"><h4>Daftar Delegasi Distrik <?php echo $kec_name ; ?> Untuk Forum SKPD dan Musrenbang Kota</h4>  </td></tr>
</table>

 <table width="100%" cellpadding="5px" cellspacing="0px"    bordercolordark ="white" class="tabel">
        <tr><td nowrap="" >No </td><td>Nama</td><td>Lembaga/Instansi</td><td>Alamat, Telp</td><td>Tanda tangan</td></tr>
       
       	@foreach($detail->delegasi as $delegasi)
            <tr><td nowrap="" >{{$i++}}</td><td>{{$delegasi->delegasi_nama}}</td><td>{{$delegasi->asal}}</td><td>{{$delegasi->alamat}}</td><td>&nbsp;</td></tr>
           @endforeach
 </table>
</p>



</body>
</html>
