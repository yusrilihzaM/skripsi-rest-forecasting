<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesdesign" name="author" />


    <!-- Bootstrap Css -->
    <link href="<?= base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="<?= base_url(); ?>assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="<?= base_url(); ?>assets/css/app.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
</head>

<body>

    <!-- <div class="row" style=" height: 100%;">
        <div class="col" style="height: 100%;">
            <div class="card" style="height: 100%;">
                <div class="card-body">

                    <div id="line_chart_datalabel" class="apex-charts" dir="ltr"></div>
                </div>
            </div>
        </div>
    </div> -->
    <div class="container-fluid">
        <div class="row" style=" height: 100%;">
            <div class="col" style="height: 100%;">
                <div class="card" style="height: 100%;">
                    <div class="card-body">

                        <div id="chart"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
    var options = {
        chart: {
            zoom: {
                enabled: true,
                type: 'x',
                autoScaleYaxis: false,
                zoomedArea: {
                    fill: {
                        color: '#90CAF9',
                        opacity: 0.4
                    },
                    stroke: {
                        color: '#0D47A1',
                        opacity: 0.4,
                        width: 1
                    }
                }
            },
            toolbar: {
                show: true,
                offsetX: 0,
                offsetY: 0,
                tools: {
                    download: true,
                    selection: true,
                    zoom: true,
                    zoomin: true,
                    zoomout: true,
                    pan: true,
                    customIcons: []
                },
                export: {
                    csv: {
                        filename: undefined,
                        columnDelimiter: ',',
                        headerCategory: 'category',
                        headerValue: 'value',
                        dateFormatter(timestamp) {
                            return new Date(timestamp).toDateString()
                        }
                    },
                    svg: {
                        filename: undefined,
                    },
                    png: {
                        filename: undefined,
                    }
                },
                autoSelected: 'zoom'
            },
            type: 'bar',
            height: 400
        },
        series: [{
            name: 'Dekomposisi Aditif',
            data: [<?php
                    foreach($aditif as $aditif):?>
                <?= (double)$aditif['smape'].','?>
                <?php
                    endforeach;?>]
        }, {
            name: 'Dekomposisi Multiplikatif',
            data: [<?php
                    foreach($multiplikatif as $multiplikatif):?>
                <?= (double)$multiplikatif['smape'].','?>
                <?php
                    endforeach;?>]
        }, ],
        chart: {
            type: 'bar',
            height: 350
        },
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: '55%',
                endingShape: 'rounded'
            },
        },

        dataLabels: {
            enabled: false,
            enabledOnSeries: [0, 1],


        },
        yaxis: {
            title: {
                text: 'SMAPE'
            }
        },
        xaxis: {
            title: {
                text: 'Tempat Wisata / Tipe Data Wisata'
            },
            categories: [
                <?php
                    foreach($tempat as $tempat):
                    ?>
                <?php 
                    // $data_bulan=$bulan['m'];
                    $label=(string)$tempat['tourist_data_type'];
                    echo "'$label'".',';
                ?>

                <?php
                    endforeach;?>
                    ],
        },
        legend: {
            position: 'bottom'
        },
        responsive: [{
            breakpoint: undefined,
            options: {},
        }]
    }

    var chart = new ApexCharts(document.querySelector("#chart"), options);

    chart.render();
    </script>
    <!-- JAVASCRIPT -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.3.0/Chart.bundle.js"></script>
    <script src="<?= base_url(); ?>assets/libs/jquery/jquery.min.js"></script>
    <script src="<?= base_url(); ?>assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url(); ?>assets/libs/metismenu/metisMenu.min.js"></script>
    <script src="<?= base_url(); ?>assets/libs/simplebar/simplebar.min.js"></script>
    <script src="<?= base_url(); ?>assets/libs/node-waves/waves.min.js"></script>

    <script src="https://unicons.iconscout.com/release/v2.0.1/script/monochrome/bundle.js"></script>

    <!-- Plugin Js-->
    <script src="<?= base_url(); ?>assets/libs/apexcharts/apexcharts.min.js"></script>
    <!-- apexcharts -->
    <script src="<?= base_url(); ?>assets/libs/apexcharts/apexcharts.min.js"></script>

    <script src="<?= base_url(); ?>assets/libs/jquery-knob/jquery.knob.min.js"></script>
    <!-- demo js-->
    <script src="<?= base_url(); ?>assets/js/pages/apex.init.js"></script>

    <script src="<?= base_url(); ?>assets/js/app.js"></script>

</body>

</html>