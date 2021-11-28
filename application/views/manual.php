<div class="container-fluid">

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="datatable" class="table table-bordered table-responsive dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>t</th>
                                <th>Data Pengunjung (At)</th>
                                <th>Centered Moving Average</th>
                                <th>Ratio</th>
                                <th>Seasonal Index</th>
                                <th>Smoothed</th>
                                <th>Unadjusted</th>
                                <th>Adjusted</th>
                                <th>Error</th>
                                <th>MAD</th>
                                <th>MAPE</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $n0 = 1; ?>
                            <?php foreach ($data_manual as $data_manual) : ?>

                            <tr>
                                <td>
                                <?=$data_manual['t']?>
                                </td>
                                <td><?=$data_manual['t']?></td>
                                <td><?=$data_manual['data_pengunjung']?></td>
                                <td><?=$data_manual['ctdma']?></td>
                                <td><?=$data_manual['ratio']?></td>
                                <td><?=$data_manual['seasonal_index']?></td>
                                <td><?=$data_manual['smoothed']?></td>
                                <td><?=$data_manual['unadjusted']?></td>
                                <td><?=$data_manual['adjusted']?></td>
                                <td><?=$data_manual['error']?></td>
                                <td><?=$data_manual['mad']?></td>
                                <td><?=$data_manual['mape']?></td>
                            </tr>
                            <?php $n0++ ?>
                            <?php endforeach ?>
                        </tbody>


                    </table>

                </div>
            </div>
        </div>
        <!-- end col -->
    </div>
</div>





<!-- End Page-content -->