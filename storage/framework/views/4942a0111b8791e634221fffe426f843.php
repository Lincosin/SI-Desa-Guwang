<?php defined('BASEPATH') || exit('No direct script access allowed'); ?>
<?php echo $__env->make('theme::commons.asset_highcharts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<style type="text/css">
    .highcharts-xaxis-labels tspan {
        font-size: 8px;
    }
</style>
<div class="single_bottom_rightbar">
    <h2><a href="<?php echo e(site_url('data-statistik/jenis-kelamin')); ?>"><i class="fa fa-bar-chart"></i>&ensp;
            <?php echo e($judul_widget); ?>

        </a></h2>
    <script type="text/javascript">
        $(function() {
            var chart_widget;
            $(document).ready(function() {
                // Build the chart
                chart_widget = new Highcharts.Chart({
                    chart: {
                        renderTo: 'container_widget',
                        plotBackgroundColor: null,
                        plotBorderWidth: null,
                        plotShadow: false
                    },
                    title: {
                        text: 'Jumlah Penduduk'
                    },
                    yAxis: {
                        title: {
                            text: 'Jumlah'
                        }
                    },
                    xAxis: {
                        categories: [
                            <?php $__currentLoopData = $stat_widget; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($data['jumlah'] > 0 && $data['nama'] != 'JUMLAH'): ?>
                                    ['<?php echo e($data['jumlah']); ?> <br> <?php echo e($data['nama']); ?>'],
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        ]
                    },
                    legend: {
                        enabled: false
                    },
                    plotOptions: {
                        series: {
                            colorByPoint: true
                        },
                        column: {
                            pointPadding: 0,
                            borderWidth: 0
                        }
                    },
                    series: [{
                        type: 'column',
                        name: 'Populasi',
                        data: [
                            <?php $__currentLoopData = $stat_widget; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($data['jumlah'] > 0 && $data['nama'] != 'JUMLAH'): ?>
                                    ['<?php echo e($data['nama']); ?>', <?php echo e($data['jumlah']); ?>],
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        ]
                    }]
                });
            });

        });
    </script>
    <div id="container_widget" style="width: 100%; height: 300px; margin: 0 auto"></div>
</div>
<?php /**PATH C:\xampp\htdocs\opensid\/storage/app/themes/natra/resources/views/widgets/statistik.blade.php ENDPATH**/ ?>