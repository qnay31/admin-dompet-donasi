// grafik dompet yatim
$.getJSON("http://localhost/admin_dompet/data/data_dompet_2021.php", function (data) {

    var isi_labels  = [];
    var isi_data1   = [];
    var isi_data2   = [];

    // console.log(isi_data2);

    $(data).each(function (i) {
        isi_labels.push(data[i].bulan);
        isi_data1.push(data[i].donasi_terkumpul);
        isi_data2.push(data[i].pencairan_dana);
    });

    // Set new default font family and font color to mimic Bootstrap's default styling
    Chart.defaults.global.defaultFontFamily = 'Nunito',
        '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = '#858796';

    // Bar Chart Example
    var ctx = document.getElementById("chartarea_campaign");
    var myBarChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: isi_labels,
            datasets: [
                {
                    label: "Donasi Terkumpul",
                    backgroundColor: "#FF0000",
                    hoverBackgroundColor: "#FF6347",
                    borderColor: "#FF0000",
                    data: isi_data1,
                }, {
                    label: "Dana Terpakai",
                    backgroundColor: "#FF0000",
                    hoverBackgroundColor: "#FF6347",
                    borderColor: "#FF0000",
                    data: isi_data2,
                }
            ],
        },
        options: {
            maintainAspectRatio: false,
            responsive: true,
            layout: {
                padding: {
                    left: 10,
                    right: 25,
                    top: 0,
                    bottom: 0
                }
            },
            scales: {
                xAxes: [{
                    time: {
                        unit: 'month'
                    },
                    gridLines: {
                        display: false,
                        drawBorder: false
                    },
                    ticks: {
                        maxTicksLimit: 12
                    }
                }],
                yAxes: [{
                    ticks: {
                        min: 0,
                        max: 100000000,
                        maxTicksLimit: 10,
                        callback: function (value) {
                            if (parseInt(value) > 999) {
                                return 'Rp. ' + value.toString().replace(
                                    /\B(?=(\d{3})+(?!\d))/g, ".");
                            } else if (parseInt(value) < -999) {
                                return '-Rp. ' + Math.abs(value).toString().replace(
                                    /\B(?=(\d{3})+(?!\d))/g, ".");
                            } else {
                                return 'Rp. ' + value;
                            }
                        }
                    },
                    gridLines: {
                        color: "rgb(234, 236, 244)",
                        zeroLineColor: "rgb(234, 236, 244)",
                        drawBorder: false,
                        borderDash: [2],
                        zeroLineBorderDash: [2]
                    }
                }],
            },
            legend: {
                display: false
            },
            tooltips: {
                titleMarginBottom: 10,
                titleFontColor: '#e0e0e0',
                titleFontSize: 14,
                backgroundColor: "rgb(32,32,32)",
                bodyFontColor: "#e0e0e0",
                borderColor: '#202020',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                caretPadding: 10,
                callbacks: {
                    label: function (tooltipItem, chart) {
                        var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label ||
                            '';
                        return datasetLabel + ': Rp. ' + Number(tooltipItem.yLabel)
                            .toFixed(0)
                            .replace(/./g,
                                function (c,
                                    i, a) {
                                    return i > 0 && c !== "." && (a.length - i) % 3 === 0 ?
                                        "." +
                                        c : c;
                                });
                    }
                }
            },
        }
    });
});