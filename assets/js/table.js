$(document).ready(function () {
    // tabel check laporan 
    $('#tabel-data_campaign').DataTable({
        "scrollX": true,
        // "autoWidth": true,
        columnDefs: [{
            width: '15%',
            targets: 1
        }, {
            width: '35%',
            targets: 2
        }],

        "footerCallback": function (row, data, start, end, display) {
            var api = this.api(),
                data;

            // Remove the formatting to get integer data for summation
            var intVal = function (i) {
                return typeof i === 'string' ?
                    i.replace(/[\Rp,.]/g, '') * 1 :
                    typeof i === 'number' ?
                    i : 0;
            };

            // sum
            pageTotal = api
                .column(4, {
                    page: 'current'
                })
                .data()
                .reduce(function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0);

            var number_string = pageTotal.toString(),
                sisa = number_string.length % 3,
                rupiah = number_string.substr(0, sisa),
                ribuan = number_string.substr(sisa).match(/\d{3}/g);

            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }
            // Update footer
            $(api.column(4).footer()).html(
                'Rp. ' + rupiah + ''
            );

            // sum
            pageTotal = api
                .column(5, {
                    page: 'current'
                })
                .data()
                .reduce(function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0);

            var number_string = pageTotal.toString(),
                sisa = number_string.length % 3,
                rupiah = number_string.substr(0, sisa),
                ribuan = number_string.substr(sisa).match(/\d{3}/g);

            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }
            // Update footer
            $(api.column(5).footer()).html(
                'Rp. ' + rupiah + ''
            );

            // sum
            pageTotal = api
                .column(6, {
                    page: 'current'
                })
                .data()
                .reduce(function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0);

            var number_string = pageTotal.toString(),
                sisa = number_string.length % 3,
                rupiah = number_string.substr(0, sisa),
                ribuan = number_string.substr(sisa).match(/\d{3}/g);

            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }
            // Update footer
            $(api.column(6).footer()).html(
                'Rp. ' + rupiah + ''
            );
        }
    });

    // tabel data pemasukan
    $('#tabel-data_donatur').DataTable({
        dom: 'Blfrtip',
        buttons: [
            'excel', 'pdf'
        ],
        "scrollX": true,
        columnDefs: [{
            width: '10%',
            targets: 3
        }],

        "footerCallback": function (row, data, start, end, display) {
            var api = this.api(),
                data;

            // Remove the formatting to get integer data for summation
            var intVal = function (i) {
                return typeof i === 'string' ?
                    i.replace(/[\Rp,.]/g, '') * 1 :
                    typeof i === 'number' ?
                    i : 0;
            };

            pageTotal = api
                .column(5, {
                    page: 'current'
                })
                .data()
                .reduce(function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0);

            var number_string = pageTotal.toString(),
                sisa = number_string.length % 3,
                rupiah = number_string.substr(0, sisa),
                ribuan = number_string.substr(sisa).match(/\d{3}/g);

            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }
            // Update footer
            $(api.column(5).footer()).html(
                'Rp. ' + rupiah + ''
            );
        }
    });
});