<?php  
require '../function.php';
error_reporting(0);

if(isset($_POST["data_id"])){
	$data_id = $_POST["data_id"];
	$output = "";
	$q = mysqli_query($conn, "SELECT * FROM donasi WHERE id = '$data_id'");
    
    // die(var_dump($s3));
    $output .= '
    <div class="table-responsive">  
        <div class="owl-carousel owl-theme">'; 
	$output .= 
    $i++;
    $sql = $q;
    while($data = mysqli_fetch_array($sql))
    {
        $output .= '  
        <form method="post" enctype="multipart/form-data" action="" id="postForm"
        onsubmit="return validasi_donasi(this)" autocomplete="off" name="buat_campaign">
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Nama  Donatur</label>
            <input type="hidden" name="key" value="'.$data_id.'">
            <input type="hidden" name="unik" value="'.$data["dibuat"].'">
            <input type="hidden" name="jenis" value="'.$data["jenis"].'">
            <input type="text name="nama" class="form-control" id="exampleFormControlInput1"
                value="'.$data["nama_donatur"].'" style="text-transform: capitalize;" readonly>
        </div>

        <div class="mb-3">
            <label for="exampleFormControlInput3" class="form-label">Nama Yang Ditampilkan (Anonim/Nama Donatur)</label>
            <input type="text" name="view_name" class="form-control" id="exampleFormControlInput3"
            value="'.$data["nama_tampil"].'" style="text-transform: capitalize;" placeholder="harap input '.$data["nama_donatur"].' ">
        </div>

        <div class="mb-3">
            <label class="form-label">Via Bank</label>
            <input type="text" name="bank" class="form-control"
                value="'.$data["via"].'" style="text-transform: capitalize;" placeholder="Harap input Midtrans">
        </div>

        <label for="exampleFormControlInput2" class="form-label">Donasi</label>
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Rp</span>
            <input type="text" name="donasi" class="form-control" id="exampleFormControlInput2"
                value="'.number_format($data["jumlah_donasi"],0,"." , ".").'" placeholder="Jumlah donasi yang diberikan" onkeypress="return hanyaAngka(event)">
        </div>
        <input type="submit" name="konfirmasi" class="btn btn-success w-100" value="Konfirmasi">
        </form>
        ';
}
$output .= "
</div>
</div>";

echo $output;
}

?>

<script>
// rupiah
var rupiah = document.getElementById('exampleFormControlInput2');
rupiah.addEventListener('keyup', function() {
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
</script>