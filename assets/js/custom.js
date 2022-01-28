// no hp

function hanyaAngka(evt) {
    var charCode = (evt.which) ? evt.which : e.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))

        return false;
    return true;
}

// rupiah
var rupiah = document.getElementById('rupiah');
rupiah.addEventListener('keyup', function () {
    // tambahkan 'Rp.' pada saat form di ketik
    // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
    rupiah.value = formatRupiah(this.value, 'Rp. ');
});

/* Fungsi formatRupiah */
function formatRupiah(angka, prefix) {
    var number_string = angka.replace(/[^,\d]/g, '').toString(),
        split = number_string.split(','),
        sisa = split[0].length % 3,
        rupiah = split[0].substr(0, sisa),
        ribuan = split[0].substr(sisa).match(/\d{3}/gi);

    // tambahkan titik jika yang di input sudah menjadi angka ribuan
    if (ribuan) {
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
    }

    rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
    return prefix == undefined ? rupiah : (rupiah ? '' + rupiah : '');
}


// hanya angka dan huruf
$(document).ready(function () {

    $('#judul').keyup(function () {
        var $th = $(this);
        $th.val($th.val().replace(/[^a-zA-Z0-9 /,-. )(]/g, function (str) {
            alert('Kamu menulis " ' + str + ' ".\n\ dimohon huruf dan angka saja.');
            return '';
        }));
    });

    $('#tanpaspasi').keyup(function () {
        var $th = $(this);
        $th.val($th.val().replace(/[^a-zA-Z0-9]/g, function (str) {
            alert('Kamu menulis " ' + str + ' ".\n\ dimohon huruf dan angka saja.');
            return '';
        }));
    });

})

function Hitung() {

    var curText = document.buat_campaign.judul.value.length;


    var maxText = 50;

    var sisa = maxText - curText;

    var isi = document.getElementById('asalbagus');
    isi.innerHTML = 'Sisa Karakter : ' + sisa + '/50';

}

$("#tanpaspasi").on({
    keydown: function(e) {
    if (e.which === 32)
        return false;
    },
    keyup: function(){
    this.value = this.value.toLowerCase();
    },
    change: function() {
    this.value = this.value.replace(/\s/g, "");
    
    }
})

// validasi donasi
function validasi_campaign(form) {
    var minchar = 3;
    var nama_minchar = 4;
    var minchar2 = 4;
    var minchar3 = 9;
    pola_email = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+.[a-zA-Z]{2,4}$/;
    //membuat pattern inputan email

    //validasi dimulai
    if (form.nama.value == "") {
        alert("Nama Tidak Boleh Kosong!");
        form.nama.focus();
        return (false);
        
    }

    else if (form.nama.value.length <= nama_minchar) {
        alert("Nama Penggalang Terlalu Pendek!");
        form.nama.focus();
        return (false);
    }

    else if (form.judul.value == "") {
        alert("Judul Tidak Boleh Kosong!");
        form.judul.focus();
        return (false);
    } 

    else if (form.judul.value.length <= minchar) {
        alert("Judul Terlalu Pendek!");
        form.judul.focus();
        return (false);
    }

    else if (form.link_donasi.value == "") {
        alert("Link Donasi Tidak Boleh Kosong!");
        form.link_donasi.focus();
        return (false);
    }    

    else if (form.link_donasi.value.length <= minchar2) {
        alert("Link Donasi Terlalu Pendek!");
        form.link_donasi.focus();
        return (false);
    }

    else if (form.target.value == "") {
        alert("Target Harus diisi!");
        form.target.focus();
        return (false);
    }

    else if (form.target.value.length <= minchar3) {
        alert("Target Donasi Minimal 10.000.000!");
        form.target.focus();
        return (false);
    }

    else if (form.periode.value == "") {
        alert("periode pilih satu!");
        form.periode.focus();
        return (false);
    }  

    else if (form.deskripsi.value == "") {
        alert("Cerita Campaign Harus diisi!");
        form.deskripsi.focus();
        return (false);
    }

}
// validasi donasi
function validasi_donasi(form) {

    if (form.view_name.value == "") {
        alert("Nama Tidak Boleh Kosong!");
        form.view_name.focus();
        return (false);
        
    }

    else if (form.bank.value == "") {
        alert("Via Bank Harus diisi!");
        form.bank.focus();
        return (false);
    }

    else if (form.donasi.value == "") {
        alert("Donasi yang diberikan Harus diisi!");
        form.donasi.focus();
        return (false);
    }

}

