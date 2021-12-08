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
                <table id="datatable" class="table table-bordered table-responsive dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>Tempat Wisata</th>
                                <th>SMAPE</th>
                                <th>Metode</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                         
                            <?php foreach ($data as $data) : ?>

                            <tr>
                                <td><?=$data['tourist_data_type']?></td>
                                <td><?=round($data['smape'],4)?></td>
                                <td><?=$data['method_type']?></td>
                                
                            </tr>
                           
                            <?php endforeach ?>
                        </tbody>


                    </table>

                </div>
            </div>
        </div>
    </div>
    </div>
    

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