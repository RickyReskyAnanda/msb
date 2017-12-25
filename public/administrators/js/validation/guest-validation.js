$("#formlogin").validate({
    rules: {
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
    },
    //For custom messages
    messages: {
        username: {
            required: "Masukkan Username Anda",
            minlength: "Masukkan Username Minimal 6 karakter",
            maxlength: "Masukkan Username Maksimal 32 karakter",
        },
        password: {
            required: "Masukkan Password Anda",
            minlength: "Masukkan Password Minimal 6 karakter",
            maxlength: "Masukkan Password Maksimal 32 karakter",
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
        cp_nik: {
            required: true,
        },
        cp_nama: {
            required: true,
        },
        cp_telp: {
            required: true,
        },
        cp_alamat: {
            required: true,
        },
        rincianmasalah: {
            required: true,
        },
        bidang: "required",
        distrik: "required",
        rincianusulan: {
            required: true,
        },
    },
    //For custom messages
    messages: {
        cp_nik: {
            required: "Masukkan NIK Anda",
        },
        cp_nama: {
            required: "Masukkan Nama Anda",
        },
        cp_telp: {
            required: "Masukkan Nomor Telpon Anda",
        },
        cp_alamat: {
            required: "Masukkan Alamat Anda",
        },
        rincianmasalah: {
            required: "Masukkan Rincian Masalah",
        },
        bidang: {
            required: "Pilih Bidang Urusan",
        },
        distrik: {
            required: "Pilih Distrik dan Kampung",
        },
        rincianusulan: {
            required: "Masukkan Rincian Usulan Anda",
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


