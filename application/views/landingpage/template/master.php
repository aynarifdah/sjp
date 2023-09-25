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
		<?php if (isset($javascript)) {
			echo $javascript;
		} ?>
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
    Highcharts.chart('kekerasan-pertahun', {

        title: {
        text: 'Trend Kekerasan Pada Perempuan & Anak'
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
            '#4154f1'
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
        name: 'Kekerasan Fisik',
        data: [934, 503, 177, 658, 031, 931, 133, 175]
        }, {
        name: 'Kekerasan Psikis',
        data: [916, 064, 742, 851, 490, 282, 121, 434]
        }, {
        name: 'Kekerasan Seksual',
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

        // TREND KEKERASAN PADA DAERAH
        
        Highcharts.chart('kekerasan-daerah', {
        chart: {
            type: 'column'
        },
        title: {
            align: 'center',
            text: 'Trend Kekerasan Perempuan & Anak Berdasarkan Kecamatan'
        },
        subtitle: {
            align: 'left',
            text: ''
        },
        accessibility: {
            announceNewData: {
            enabled: true
            }
        },
        xAxis: {
            type: 'Kecamatan'
        },
        yAxis: {
            title: {
            text: 'Total Kasus'
            }

        },
        legend: {
            enabled: false
        },
        colors: [
            '#013289',
            '#66B9BF',
            '#4154f1'
        ],
        plotOptions: {
            series: {
            borderWidth: 0,
            dataLabels: {
                enabled: true,
                format: '{point.y:.1f}%'
            }
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
        },

        series: [
            {
            name: "Kecamatan",
            colorByPoint: true,
            data: [
                {
                name: "Cilodong",
                y: 62.74,
                drilldown: "Cilodong"
                },
                {
                name: "Pancoranmas",
                y: 10.57,
                drilldown: "Pancoranmas"
                },
                {
                name: "Cinere",
                y: 7.23,
                drilldown: "Cinere"
                }
            ]
            }
        ],
        drilldown: {
            breadcrumbs: {
            position: {
                align: 'right'
            }
            },
            series: [
            {
                name: "Cilodong",
                id: "Cilodong",
                data: [
                [
                    "v65.0",
                    0.1
                ],
                [
                    "v64.0",
                    1.3
                ],
                [
                    "v63.0",
                    53.02
                ],
                [
                    "v62.0",
                    1.4
                ],
                [
                    "v61.0",
                    0.88
                ],
                [
                    "v60.0",
                    0.56
                ],
                [
                    "v59.0",
                    0.45
                ],
                [
                    "v58.0",
                    0.49
                ],
                [
                    "v57.0",
                    0.32
                ],
                [
                    "v56.0",
                    0.29
                ],
                [
                    "v55.0",
                    0.79
                ],
                [
                    "v54.0",
                    0.18
                ],
                [
                    "v51.0",
                    0.13
                ],
                [
                    "v49.0",
                    2.16
                ],
                [
                    "v48.0",
                    0.13
                ],
                [
                    "v47.0",
                    0.11
                ],
                [
                    "v43.0",
                    0.17
                ],
                [
                    "v29.0",
                    0.26
                ]
                ]
            },
            {
                name: "Pancoranmas",
                id: "Pancoranmas",
                data: [
                [
                    "v58.0",
                    1.02
                ],
                [
                    "v57.0",
                    7.36
                ],
                [
                    "v56.0",
                    0.35
                ],
                [
                    "v55.0",
                    0.11
                ],
                [
                    "v54.0",
                    0.1
                ],
                [
                    "v52.0",
                    0.95
                ],
                [
                    "v51.0",
                    0.15
                ],
                [
                    "v50.0",
                    0.1
                ],
                [
                    "v48.0",
                    0.31
                ],
                [
                    "v47.0",
                    0.12
                ]
                ]
            },
            {
                name: "Cinere",
                id: "Cinere",
                data: [
                [
                    "v11.0",
                    6.2
                ],
                [
                    "v10.0",
                    0.29
                ],
                [
                    "v9.0",
                    0.27
                ],
                [
                    "v8.0",
                    0.47
                ]
                ]
            }
            ]
        }
        });
        // END TRREN PADA DAERAN
</script>

