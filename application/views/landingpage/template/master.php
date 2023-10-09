<!DOCTYPE html>
<html lang="en">

<?php echo $page["head"]; ?>

<body>



    <?php echo $page["header"]; ?>

    <?php echo $content; ?>

    <?php echo $page["footer"]; ?>

    <!--/#app -->
    <?php echo $page['main_js']; ?>
    <script type="text/javascript">
        < ? php
        if (isset($javascript)) {
            echo $javascript;
        } ? >
    </script>
</body>

</html>


<script>
    new Splide('#clientss', {
        type: 'loop',
        perPage: 5,
        autoplay: true,
    }).mount();
</script>

<script>
    // CHART KEKERASAN PERTAHUN
    Highcharts.chart('pasien-daerah', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Trend Pasien SJP Berdasarkan Kecamatan'
        },
        // subtitle: {
        //     text: 'Source: <a href="https://worldpopulationreview.com/world-cities" target="_blank">World Population Review</a>'
        // },
        xAxis: {
            type: 'category',
            labels: {
                rotation: -45,
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Total Kasus'
            }
        },
        legend: {
            enabled: false
        },
        tooltip: {
            pointFormat: 'Population in 2021: <b>{point.y:.1f} millions</b>'
        },
        colors: [
            '#4caefe',
            '#3fbdf3',
            '#35c3e8',
            '#2bc9dc',
            '#20cfe1',
            '#16d4e6',
            '#0dd9db',
            '#03dfd0',
            '#00e4c5',
            '#00e9ba',
            '#00eeaf'
        ],
        xAxis: {
            categories: ['Beji', 'Bojongsari', 'Cilodong', 'Cimanggis', 'Cinere', 'Cipayung', 'Limo',
                'Pancoranmas', 'Sawangan', 'Sukmajaya', 'Tapos'
            ]
        },
        series: [{
            type: 'column',
            name: 'Unemployed',
            borderRadius: 5,
            colorByPoint: true,
            data: [5412, 4977, 4730, 4437, 3947, 3707, 4143, 3609,
                3311, 3072, 2899
            ],
            showInLegend: false
        }]
    });



    // TREND KEKERASAN PADA DAERAH

    Highcharts.chart('pasien-kelurahan', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Trend Pasien SJP Berdasarkan Kelurahan'
        },
        // subtitle: {
        //     text: 'Source: <a href="https://worldpopulationreview.com/world-cities" target="_blank">World Population Review</a>'
        // },
        xAxis: {
            type: 'category',
            labels: {
                rotation: -45,
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Total Kasus'
            }
        },
        legend: {
            enabled: false
        },
        tooltip: {
            pointFormat: 'Population in 2021: <b>{point.y:.1f} millions</b>'
        },
        colors: [
            '#4caefe',
            '#3fbdf3',
            '#35c3e8',
            '#2bc9dc',
            '#20cfe1',
            '#16d4e6',
            '#0dd9db',
            '#03dfd0',
            '#00e4c5',
            '#00e9ba',
            '#00eeaf',

            '#4caefe',
            '#3fbdf3',
            '#35c3e8',
            '#2bc9dc',
            '#20cfe1',
            '#16d4e6',
            '#0dd9db',
            '#03dfd0',
            '#00e4c5',
            '#00e9ba',
            '#00eeaf'
        ],
        xAxis: {
            categories: [
                'Abdi Jaya',
                'beji',
                'bojongsari',
                'Cilodong',
                'Cinere',
                'cisalak',
                'Curug(Cimanggis)',
                'Duren Mekar',
                'Grogol',
                'Jatimulya',
                'Kedaung',
                'Kukusan',
                'Luar Depok',
                'Mekar Sari',
                'Pangkalan Jati',
                'Pasir Putih',
                'Pondok Petir',
                'Ratu Jaya',
                'Sawangan Lama',
                'Sukamaju Baru',
                'Tanah Baru tugu',
                'Tugu'
            ]
        },
        series: [{
            type: 'column',
            name: 'Unemployed',
            borderRadius: 5,
            colorByPoint: true,
            data: [5412, 4977, 4730, 4437, 3947, 3707, 4143, 3609,
                3311, 3072, 2899, 5412, 4977, 4730, 4437, 3947, 3707, 4143, 3609,
                3311, 3072, 2899
            ],
            showInLegend: false
        }]
    });


    // CHART KEKERASAN PERTAHUN
    Highcharts.chart('pasien-pertahun', {

        title: {
            text: 'Trend Pasien SJP Berdasarkan keseluruhan'
        },

        subtitle: {
            text: '<b>Pertahun</b>'
        },

        yAxis: {
            title: {
                text: 'Total Kasus'
            }
        },

        xAxis: {
            accessibility: {
                rangeDescription: 'Range: 2017 to 2022'
            }
        },

        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle'
        },
        colors: [
            '#013289',
            '#66B9BF',
            '#ECA869'
        ],

        plotOptions: {
            series: {
                label: {
                    connectorAllowed: false
                },
                pointStart: 2010
            }
        },

        series: [{
            name: 'Jumlah SJP yang di setujui',
            data: [934, 503, 177, 658, 031, 931, 133, 175]
        }, {
            name: 'jumlah Pengajuan SJP',
            data: [916, 064, 742, 851, 490, 282, 121, 434]
        }, {
            name: 'jumlah SJP yang sedang di survey',
            data: [744, 722, 005, 771, 185, 377, 147, 387]
        }],

        responsive: {
            rules: [{
                condition: {
                    maxWidth: 500
                },
                chartOptions: {
                    legend: {
                        layout: 'horizontal',
                        align: 'center',
                        verticalAlign: 'bottom'
                    }
                }
            }]
        }

    });
    // END CHART KEKERASAN PERTAHUN

    Highcharts.chart('pasien-keseluruhan', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Pasien SJP Pada Perempuan dan Laki-laki',
        },
        subtitle: {
            text: '<b>hari ini</b>'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        accessibility: {
            point: {
                valueSuffix: '%'
            }
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: false
                },
                showInLegend: true
            }
        },
        series: [{
            name: 'Brands',
            colorByPoint: true,
            data: [
                // {
                //     name: 'Chrome',
                //     y: 74.77,
                //     sliced: true,
                //     selected: true
                // },
                {
                    name: 'Laki-Laki',
                    y: 12.82
                }, {
                    name: 'Perempuan',
                    y: 16.63
                },
            ],
        }]
    });

    // END TRREN PADA DAERAN
</script>