<?php

/*GUEST*/
Route::get('/','GuestController@viewBeranda')->middleware('guest');
Route::get('kamus-usulan','GuestController@viewKamusUsulan');
Route::get('usulan','GuestController@viewUsulan');
Route::get('aspirasi-masyarakat','GuestController@viewAspirasiMasyarakat');
Route::post('aspirasi-masyarakat','GuestController@postAspirasiMasyarakat');
Route::get('akun','GuestController@viewAkun')->middleware('ceklogin:all');
Route::post('akun','GuestController@postAkun')->middleware('ceklogin:all');
/*BATAS GUEST*/

/*DESA*/
Route::namespace('Desa')->group(function(){
	Route::get('desa','DesaController@viewBeranda')->middleware('ceklogin:desa');
	Route::get('desa/usulan','UsulanDesaController@viewUsulan')->middleware('ceklogin:desa');

	Route::get('desa/usulan/input','UsulanDesaController@viewPilihUsulan')->middleware('ceklogin:desa');
	Route::get('desa/usulan/input/{id}','UsulanDesaController@viewInputUsulan')->middleware('ceklogin:desa');
	Route::post('desa/usulan/input','UsulanDesaController@postInputUsulan')->middleware('ceklogin:desa');


	Route::get('desa/usulan/edit/{id}','UsulanDesaController@viewEditUsulan')->middleware('ceklogin:desa');
	Route::post('desa/usulan/edit','UsulanDesaController@postEditUsulan')->middleware('ceklogin:desa');

	Route::get('desa/usulan/kirim/{id}','UsulanDesaController@kirimUsulan')->middleware('ceklogin:desa');
	Route::get('desa/usulan/hapus/{id}','UsulanDesaController@hapusUsulan')->middleware('ceklogin:desa');

	Route::get('desa/usulan/pantau','UsulanDesaController@viewPantauUsulan')->middleware('ceklogin:desa');
});
/*BATAS DESA*/

/*DISTRIK*/
Route::namespace('Distrik')->group(function () {
	Route::get('distrik','DistrikController@viewBeranda')->middleware('ceklogin:distrik');
	Route::get('distrik/usulan/masuk','UsulanDistrikController@viewUsulanMasuk')->middleware('ceklogin:distrik');
	Route::get('distrik/usulan/edit/{id}','UsulanDistrikController@viewEditUsulan')->middleware('ceklogin:distrik');
	Route::post('distrik/usulan/edit','UsulanDistrikController@postEditUsulan')->middleware('ceklogin:distrik');
	Route::get('distrik/usulan/edit/hapus-gambar/{id}','UsulanDistrikController@viewHapusGambarUsulan')->middleware('ceklogin:distrik');
	Route::get('distrik/usulan/edit/delete-gambar/{id}','UsulanDistrikController@hapusGambarUsulan')->middleware('ceklogin:distrik');
	Route::get('distrik/usulan/komentar/{status}/{id}','UsulanDistrikController@komentarUsulan')->middleware('ceklogin:distrik');
	Route::post('distrik/usulan/komentar','UsulanDistrikController@postKomentarUsulan')->middleware('ceklogin:distrik');

	Route::get('distrik/usulan/dikirim','UsulanDistrikController@viewUsulanDikirim')->middleware('ceklogin:distrik');
	Route::get('distrik/usulan/ditolak','UsulanDistrikController@viewUsulanDitolak')->middleware('ceklogin:distrik');

	Route::get('distrik/usulan/pilih','UsulanDistrikController@viewPilihUsulan')->middleware('ceklogin:distrik');
	Route::get('distrik/usulan/input/{id}','UsulanDistrikController@viewInputUsulan')->middleware('ceklogin:distrik');
	Route::post('distrik/usulan/input','UsulanDistrikController@postInputUsulan')->middleware('ceklogin:distrik');
	
	Route::get('distrik/usulan/pantau','UsulanDistrikController@viewPantauUsulan')->middleware('ceklogin:distrik');
	
	Route::get('distrik/berita-acara','BADistrikController@viewBeritaAcara')->middleware('ceklogin:distrik');
	Route::post('distrik/berita-acara','BADistrikController@postBeritaAcara')->middleware('ceklogin:distrik');
	Route::post('distrik/berita-acara/sambutan','BADistrikController@postSambutan')->middleware('ceklogin:distrik');
	Route::post('distrik/berita-acara/peserta','BADistrikController@postPeserta')->middleware('ceklogin:distrik');
	Route::post('distrik/berita-acara/delegasi','BADistrikController@postDelegasi')->middleware('ceklogin:distrik');

	Route::get('distrik/berita-acara/hapus/{posisi}/{id}','BADistrikController@viewHapus')->middleware('ceklogin:distrik');
	Route::get('distrik/berita-acara/delete/{posisi}/{id}','BADistrikController@deletePosisi')->middleware('ceklogin:distrik');
	Route::get('distrik/berita-acara/cetak','BADistrikController@cetakBeritaAcara')->middleware('ceklogin:distrik');
});
/*BATAS DISTRIK*/

/*SKPD*/
Route::namespace('SKPD')->group(function () {
	Route::get('skpd','SKPDController@viewBeranda')->middleware('ceklogin:skpd');
	Route::get('skpd/verifikasi','UsulanSKPDController@viewVerifikasi')->middleware('ceklogin:skpd');
	Route::post('skpd/verifikasi','UsulanSKPDController@postVerifikasi')->middleware('ceklogin:skpd');
	Route::get('skpd/verifikasi/persetujuan/{persetujuan}/{id}','UsulanSKPDController@alasanVerifikasi')->middleware('ceklogin:skpd');
	Route::get('skpd/verifikasi/edit/{id}','UsulanSKPDController@viewEditUsulan')->middleware('ceklogin:skpd');
	Route::post('skpd/verifikasi/edit','UsulanSKPDController@postEditUsulan')->middleware('ceklogin:skpd');
	Route::get('skpd/usulan/pilih','UsulanSKPDController@viewPilihUsulan')->middleware('ceklogin:skpd');
	Route::get('skpd/usulan/input/{id}','UsulanSKPDController@viewInputUsulan')->middleware('ceklogin:skpd');
	Route::post('skpd/usulan/input','UsulanSKPDController@postInputUsulan')->middleware('ceklogin:skpd');


	Route::get('skpd/berita-acara','BASKPDController@viewBeritaAcara')->middleware('ceklogin:skpd');
	Route::post('skpd/berita-acara','BASKPDController@postBeritaAcara')->middleware('ceklogin:skpd');
});
/*BATAS SKPD*/

/*DPRD*/
Route::middleware('ceklogin:dprd')->group(function () {
	Route::prefix('dprd')->group(function () {
		Route::namespace('DPRD')->group(function () {
			Route::get('/','DPRDController@viewBeranda');
			Route::get('pokok-pikiran','DPRDController@viewPokokPikiran');
			Route::get('pokok-pikiran/tambah','DPRDController@viewTambahPokokPikiran');
			Route::post('pokok-pikiran/tambah','DPRDController@postTambahPokokPikiran');
			Route::get('pokok-pikiran/edit/{id}','DPRDController@viewEditPokokPikiran');
			Route::post('pokok-pikiran/edit','DPRDController@postEditPokokPikiran');
			Route::get('pokok-pikiran/hapus/{id}','DPRDController@viewDeletePokokPikiran');
			Route::get('pokok-pikiran/delete/{id}','DPRDController@deletePokokPikiran');
		});
	});
});
/*BATAS DPRD*/

/*ADMIN*/
Route::middleware('ceklogin:administrator')->group(function () {
	Route::prefix('administrator')->group(function () {
		Route::namespace('Admin')->group(function () {
			
			Route::get('/','UserController@viewBeranda')->middleware('ceklogin:administrator');

			Route::get('manajemen-user/{level}','UserController@viewManajemenUser');
			Route::get('manajemen-user/{level}/tambah','UserController@viewAddUser');
			Route::post('manajemen-user/{level}/tambah','UserController@postAddUser');
			Route::get('manajemen-user/{level}/{id}','UserController@viewEditUser');
			Route::post('manajemen-user/{level}/edit','UserController@postEditUser');
			Route::get('manajemen-user/{level}/delete/{id}','UserController@viewDeleteUser');
			Route::get('manajemen-user/delete/{id}/{level}','UserController@deleteUser');

			Route::get('skoring','SkoringController@viewSkoring');
			Route::get('skoring/tambah','SkoringController@viewAddSkoring');
			Route::post('skoring/tambah','SkoringController@postAddSkoring');
			Route::get('skoring/{id}','SkoringController@viewEditSkoring');
			Route::post('skoring/edit','SkoringController@postEditSkoring');
			Route::get('skoring/hapus/{id}','SkoringController@viewDeleteSkoring');
			Route::get('skoring/delete/{id}','SkoringController@deleteSkoring');

			Route::get('kamus-usulan','KamusUsulanController@viewKamusUsulan');
			Route::get('kamus-usulan/tambah','KamusUsulanController@viewAddKamusUsulan');
			Route::post('kamus-usulan/tambah','KamusUsulanController@postAddKamusUsulan');
			Route::get('kamus-usulan/{id}','KamusUsulanController@viewEditKamusUsulan');
			Route::post('kamus-usulan/edit','KamusUsulanController@postEditKamusUsulan');
			Route::get('kamus-usulan/hapus/{id}','KamusUsulanController@viewDeleteKamusUsulan');
			Route::get('kamus-usulan/delete/{id}','KamusUsulanController@deleteKamusUsulan');

			Route::prefix('data-master')->group(function () {
				Route::get('distrik','DistrikController@viewDistrik');
				Route::get('distrik/tambah','DistrikController@viewAddDistrik');
				Route::post('distrik/tambah','DistrikController@postAddDistrik');
				Route::get('distrik/{id}','DistrikController@viewEditDistrik');
				Route::post('distrik/edit','DistrikController@postEditDistrik');
				Route::get('distrik/hapus/{id}','DistrikController@viewDeleteDistrik');
				Route::get('distrik/delete/{id}','DistrikController@deleteDistrik');

				Route::get('desa','DesaController@viewDesa');
				Route::get('desa/tambah','DesaController@viewAddDesa');
				Route::post('desa/tambah','DesaController@postAddDesa');
				Route::get('desa/{id}','DesaController@viewEditDesa');
				Route::post('desa/edit','DesaController@postEditDesa');
				Route::get('desa/hapus/{id}','DesaController@viewDeleteDesa');
				Route::get('desa/delete/{id}','DesaController@deleteDesa');

				Route::get('jalan','JalanController@viewJalan');
				Route::get('jalan/tambah','JalanController@viewAddJalan');
				Route::post('jalan/tambah','JalanController@postAddJalan');
				Route::get('jalan/{id}','JalanController@viewEditJalan');
				Route::post('jalan/edit','JalanController@postEditJalan');
				Route::get('jalan/hapus/{id}','JalanController@viewDeleteJalan');
				Route::get('jalan/delete/{id}','JalanController@deleteJalan');

			});

			Route::get('aspirasi-masyarakat','AspirasiController@viewAspirasi');
			Route::get('aspirasi-masyarakat/hapus/{id}','AspirasiController@viewDeleteAspirasi');
			Route::get('aspirasi-masyarakat/delete/{id}','AspirasiController@deleteAspirasi');

			Route::get('pokok-pikiran','PokirDPRDController@viewPokokPikiran');
			Route::get('pokok-pikiran/konfirmasi/{id}','PokirDPRDController@konfirmasiPokokPikiran');

			Route::get('usulan','UsulanBappedaController@viewUsulanMasuk');
			Route::get('usulan/verifikasi','UsulanBappedaController@viewUsulanVerifikasi');
			Route::get('usulan/ditolak','UsulanBappedaController@viewUsulanDitolak');

			Route::get('usulan/edit/{id}','UsulanBappedaController@viewEditUsulanMasuk');
			Route::post('usulan/edit','UsulanBappedaController@postEditUsulan');
			Route::get('usulan/edit/hapus-gambar/{id}','UsulanBappedaController@viewHapusGambar');
			Route::get('usulan/edit/delete-gambar/{id}','UsulanBappedaController@postHapusGambar');
			Route::get('usulan/persetujuan/{persetujuan}/{id}','UsulanBappedaController@viewAlasanPersetujuan');
			Route::post('usulan/persetujuan','UsulanBappedaController@postAlasanPersetujuan');


		});
	});
});
/*BATAS ADMIN*/

/*AUTH*/
Route::post('login','Auth\LoginController@postLogin');
Route::get('logout/{program}','Auth\LoginController@logout');
/*BATAS AUTH*/


/*Data Api*/
Route::get('desa/{id}','DataCOntroller@getDesa');


/*----------------------------------RKPD-------------------------------------------*/
Route::prefix('rkpd')->group(function () {
	Route::post('login','Auth\LoginController@postLoginRKPD')->middleware('guest');

	Route::namespace('RKPD')->group(function () {
		Route::get('/','BasicController@login')->middleware('guest');

		Route::prefix('administrator')->group(function () {
				
			Route::get('/','BasicController@viewBeranda');
			Route::get('profil','BasicController@profil');
			Route::post('profil','BasicController@postProfil');

			Route::get('laporan-rkpd','LaporanRKPDController@viewLaporanRKPD');
			Route::get('laporan-rkpd/tambah','LaporanRKPDController@viewLaporanRKPD');
			Route::get('excel-rkpd/{skpd}/{kode}','LaporanRKPDController@viewExcel');
			Route::get('input-rkpd/{jenis}/{id?}','LaporanRKPDController@viewInputRKPD');
			Route::post('input-rkpd','LaporanRKPDController@postInputRKPD');
			Route::get('review-rkpd','LaporanRKPDController@reviewRKPD');
			Route::get('review-rkpd/pengesahan/{id}','LaporanRKPDController@pengesahan');
			Route::get('laporan-rkpd/report/{skpd}/{tahun}','LaporanRKPDController@viewExcel');

			Route::get('anggaran-perubahan','AnggaranPerubahanController@viewAP');
			Route::get('anggaran-perubahan/input/{id}','AnggaranPerubahanController@viewInputAP');
			Route::post('anggaran-perubahan/input','AnggaranPerubahanController@postInputAP');
			Route::get('anggaran-perubahan/pengesahan/{id}','AnggaranPerubahanController@pengesahan');
			Route::get('anggaran-perubahan/report/{skpd}/{tahun}','AnggaranPerubahanController@viewExcel');
			Route::get('anggaran-perubahan/edit/{id}','AnggaranPerubahanController@viewEditAP');
			Route::post('anggaran-perubahan/edit','AnggaranPerubahanController@postEditAP');

			Route::get('laporan-renja','LaporanRenjaController@viewLaporanRenja');
			Route::get('laporan-renja/{id}/{kode}','LaporanRenjaController@viewEdit');
			Route::post('laporan-renja/edit','LaporanRenjaController@postEdit');
			Route::get('laporan-renja/report/{skpd}/{tahun}','LaporanRenjaController@viewExcel');

			Route::get('review-renstra','RenstraController@viewRenstra');
			Route::get('review-renstra/edit/{id}','RenstraController@viewEditRenstra');
			Route::post('review-renstra/edit','RenstraController@postEditRenstra');

			Route::get('review-musrenbang','MusrenbangController@viewMusrenbang');

			Route::get('user','UserController@viewUser');
			Route::get('user/tambah','UserController@viewAddUser');
			Route::post('user/tambah','UserController@postAddUser');
			Route::get('user/edit/{id}','UserController@viewEditUser');
			Route::post('user/edit','UserController@postEditUser');
			Route::get('user/hapus/{id}','UserController@viewDeleteUser');
			Route::get('user/delete/{id}','UserController@deleteUser');
		});
	});
});
