$("#kamususulan").validate({
    rules: {
        tahun:"required",
        skpd:"required",
        tipe:"required",
        nm_pekerjaan: {
            required: true
        },
        satuan:"required",
        harga: {
            required: true
        },
        target: {
            required: true
        },
        bidang_urusan:"required",
        nama_kelompok:"required",
        status:"required",
    },
    //For custom messages
    messages: {
        tahun:{
            required:"Pilih Tahun"
        },
        skpd:{
            required:"Pilih SKPD"
        },
        tipe:{
            required:"Pilih Tipe"
        },
        nm_pekerjaan: {
            required: "Masukkan Nama Pekerjaan"
        },
        satuan:{
            required:"Pilih Satuan"
        },
        harga: {
            required: "Masukkan Harga"
        },
        target: {
            required: "Masukkan Target"
        },
        bidang_urusan:{
            required: "Pilih Bidang Urusan"
        },
        nama_kelompok:{
            required: "Pilih Nama Kelompok"
        },
        status:{
            required: "Pilih Status"
        },
    },
    errorElement : 'div',
    errorPlacement: function(error, element) {
      var placement = $(element).data('error');
      if (placement) {
        $(placement).append(error)
      } else {
        error.insertAfter(element);
      }
    }
});

$("#manajemenuser").validate({
    rules: {
        name: {
            required: true
        },
        level:"required",
        skpd:"required",
        distrik:"required",
        desa:"required",
        username: {
            required: true,
            minlength:6,
            maxlength:32,
        },
        password: {
            required: true,
            minlength:6,
            maxlength:32,
        },
        confirmation: {
            required: true,
            minlength:6,
            maxlength:32,
        },
    },
    //For custom messages
    messages: {
        name: {
            required: "Masukkan Nama User"
        },
        level: {
            required: "Pilih Level Admin User"
        },
        skpd: {
            required: "Pilih SKPD User"
        },
        distrik: {
            required: "Pilih Distrik User"
        },
        desa: {
            required: "Pilih Kampung User"
        },
        status: {
            required: "Pilih Status"
        },
        username: {
            required: "Masukkan Username",
            minlength: "Masukkan Username Minimal 6 Karakter",
            maxlength: "Masukkan Username Maksimal 32 Karakter"
        },
        password: {
            required: "Masukkan Password",
            minlength: "Masukkan Password Minimal 6 Karakter",
            maxlength: "Masukkan Password Maksimal 32 Karakter"
        },
        confirmation: {
            required: "Masukkan Konfirmasi Password",
            minlength: "Masukkan Konfirmasi Password Minimal 6 Karakter",
            maxlength: "Masukkan Konfirmasi Password Maksimal 32 Karakter"
        },
    },
    errorElement : 'div',
    errorPlacement: function(error, element) {
      var placement = $(element).data('error');
      if (placement) {
        $(placement).append(error)
      } else {
        error.insertAfter(element);
      }
    }
});

$("#skoring").validate({
    rules: {
        nama_kelompok: {
            required: true
        },
        faktor1_nilai1: {
            required: true
        },
        faktor1_nilai2: {
            required: true
        },
        faktor1_nilai3: {
            required: true
        },
        faktor1_nilai4: {
            required: true
        },
        faktor2_nilai1: {
            required: true
        },
        faktor2_nilai2: {
            required: true
        },
        faktor2_nilai3: {
            required: true
        },
        faktor2_nilai4: {
            required: true
        },
        faktor3_nilai1: {
            required: true
        },
        faktor3_nilai2: {
            required: true
        },
        faktor3_nilai3: {
            required: true
        },
        faktor3_nilai4: {
            required: true
        }
    },
    //For custom messages
    messages: {
        nama_kelompok: {
            required: "Masukkan minimal 1 nama kelompok"
        },
        faktor1_nilai1: {
            required: "Masukkan Nilai 1"
        },
        faktor1_nilai2: {
            required: "Masukkan Nilai 2"
        },
        faktor1_nilai3: {
            required: "Masukkan Nilai 3"
        },
        faktor1_nilai4: {
            required: "Masukkan Nilai 4"
        },
        faktor2_nilai1: {
            required: "Masukkan Nilai 1"
        },
        faktor2_nilai2: {
            required: "Masukkan Nilai 2"
        },
        faktor2_nilai3: {
            required: "Masukkan Nilai 3"
        },
        faktor2_nilai4: {
            required: "Masukkan Nilai 4"
        },
        faktor3_nilai1: {
            required: "Masukkan Nilai 1"
        },
        faktor3_nilai2: {
            required: "Masukkan Nilai 2"
        },
        faktor3_nilai3: {
            required: "Masukkan Nilai 3"
        },
        faktor3_nilai4: {
            required: "Masukkan Nilai 4"
        },
    },
    errorElement : 'div',
    errorPlacement: function(error, element) {
      var placement = $(element).data('error');
      if (placement) {
        $(placement).append(error)
      } else {
        error.insertAfter(element);
      }
    }
});

$("#formjalan").validate({
    rules: {
        kd_desa:"required",
        nm_jalan: {
            required: true
        },
        status:"required",
    },
    //For custom messages
    messages: {
        kd_desa: {
            required: "Pilih Desa"
        },
        nm_jalan: {
            required: "Masukkan Nama Jalan"
        },
        status: {
            required: "Pilih Status"
        },
    },
    errorElement : 'div',
    errorPlacement: function(error, element) {
      var placement = $(element).data('error');
      if (placement) {
        $(placement).append(error)
      } else {
        error.insertAfter(element);
      }
    }
});

$("#formdesa").validate({
    rules: {
        kd_distrik:"required",
        nm_desa: {
            required: true
        },
        sts:"required",
    },
    //For custom messages
    messages: {
        kd_distrik: {
            required: "Pilih Distrik"
        },
        nm_desa:{
            required:"Masukkan Nama Desa"
        },
        sts: {
            required: "Pilih Status"
        },
    },
    errorElement : 'div',
    errorPlacement: function(error, element) {
      var placement = $(element).data('error');
      if (placement) {
        $(placement).append(error)
      } else {
        error.insertAfter(element);
      }
    }
});


$("#formdistrik").validate({
    rules: {
        nm_distrik: {
            required: true
        },
        sts:"required",
    },
    //For custom messages
    messages: {
        nm_distrik: {
            required: "Masukkan Nama Distrik"
        },
        sts: {
            required: "Pilih Status"
        },
    },
    errorElement : 'div',
    errorPlacement: function(error, element) {
      var placement = $(element).data('error');
      if (placement) {
        $(placement).append(error)
      } else {
        error.insertAfter(element);
      }
    }
});
$("#formaspirasi").validate({
    rules: {
        desa:"required",
        bidang:"required",
    },
    //For custom messages
    messages: {
        desa: {
            required: "Pilih Distrik dan Desa"
        },
        bidang: {
            required: "Pilih Bidang"
        },
    },
    errorElement : 'div',
    errorPlacement: function(error, element) {
      var placement = $(element).data('error');
      if (placement) {
        $(placement).append(error)
      } else {
        error.insertAfter(element);
      }
    }
});


$("#pencarianusulan").validate({
    rules: {
        tipe:"required",
    },
    //For custom messages
    messages: {
        tipe: {
            required: "Pilih Tipe Pekerjaan"
        },
    },
    errorElement : 'div',
    errorPlacement: function(error, element) {
      var placement = $(element).data('error');
      if (placement) {
        $(placement).append(error)
      } else {
        error.insertAfter(element);
      }
    }
});


$("#editusulan").validate({
    rules: {
        volume:{
            required:true
        },
        ket_nomor:{
            required:true
        },
        ket_lokasi:{
            required:true
        },
        link_maps:{
            required:true
        },
        status_lahan:"required",
        keterangan:{
            required:true
        },
    },
    //For custom messages
    messages: {
        volume:{
            required:"Masukkan Volume"
        },
        ket_nomor:{
            required:"Masukkan Keterangan Nomor"
        },
        ket_lokasi:{
            required:"Masukkan Keterangan Lokasi"
        },
        link_maps:{
            required:"Masukkan Link URL Maps"
        },
        status_lahan:{
            required:"true"
        },
        keterangan:{
            required:"true"
        },
    },
    errorElement : 'div',
    errorPlacement: function(error, element) {
      var placement = $(element).data('error');
      if (placement) {
        $(placement).append(error)
      } else {
        error.insertAfter(element);
      }
    }
});
$("#formalasan").validate({
    rules: {
        alasan:{
            required:true
        },
    },
    //For custom messages
    messages: {
        alasan: {
            required: "Masukkan Alasan Anda"
        },
    },
    errorElement : 'div',
    errorPlacement: function(error, element) {
      var placement = $(element).data('error');
      if (placement) {
        $(placement).append(error)
      } else {
        error.insertAfter(element);
      }
    }
});


$("#formakun").validate({
    rules: {
        old_pass: {
            required: true,
            minlength:6,
            maxlength:32,
        },
        new_pass: {
            required: true,
            minlength:6,
            maxlength:32,
        },
        confirm_pass: {
            required: true,
            minlength:6,
            maxlength:32,
        },
    },
    //For custom messages
    messages: {
        old_pass: {
            required: "Masukkan Password Lama Anda",
            minlength: "Masukkan Password Lama Minimal 6 karakter",
            maxlength: "Masukkan Password Lama Maksimal 32 karakter",
        },
        new_pass: {
            required: "Masukkan Password Baru Anda",
            minlength: "Masukkan Password Baru Minimal 6 karakter",
            maxlength: "Masukkan Password Baru Maksimal 32 karakter",
        },
        confirm_pass: {
            required: "Masukkan Password Konfirmasi Anda",
            minlength: "Masukkan Password Konfirmasi Minimal 6 karakter",
            maxlength: "Masukkan Password Konfirmasi Maksimal 32 karakter",
        },
    },
    errorElement : 'div',
    errorPlacement: function(error, element) {
      var placement = $(element).data('error');
      if (placement) {
        $(placement).append(error)
      } else {
        error.insertAfter(element);
      }
    }
});



$("#formakun").validate({
    rules: {
        old_pass: {
            required: true,
            minlength:6,
            maxlength:32,
        },
        new_pass: {
            required: true,
            minlength:6,
            maxlength:32,
        },
        confirm_pass: {
            required: true,
            minlength:6,
            maxlength:32,
        },
    },
    //For custom messages
    messages: {
        old_pass: {
            required: "Masukkan Password Lama Anda",
            minlength: "Masukkan Password Lama Minimal 6 karakter",
            maxlength: "Masukkan Password Lama Maksimal 32 karakter",
        },
        new_pass: {
            required: "Masukkan Password Baru Anda",
            minlength: "Masukkan Password Baru Minimal 6 karakter",
            maxlength: "Masukkan Password Baru Maksimal 32 karakter",
        },
        confirm_pass: {
            required: "Masukkan Password Konfirmasi Anda",
            minlength: "Masukkan Password Konfirmasi Minimal 6 karakter",
            maxlength: "Masukkan Password Konfirmasi Maksimal 32 karakter",
        },
    },
    errorElement : 'div',
    errorPlacement: function(error, element) {
      var placement = $(element).data('error');
      if (placement) {
        $(placement).append(error)
      } else {
        error.insertAfter(element);
      }
    }
});