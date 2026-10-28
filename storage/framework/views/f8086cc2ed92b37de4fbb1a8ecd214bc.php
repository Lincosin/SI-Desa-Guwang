<?php $__env->startPush('styles'); ?>
    <style type="text/css">
        #agenda .tab-content {
            margin-top: 0px;
        }
    </style>
<?php $__env->stopPush(); ?>

<div class="single_bottom_rightbar">
    <h2><i class="fa fa-calendar"></i>&ensp;<?php echo e($judul_widget); ?></h2>
    <div id="agenda" class="box-body">
        <ul class="nav nav-tabs">
            <?php if(count($hari_ini ?? []) > 0): ?>
                <li class="active"><a data-toggle="tab" href="#hari-ini">Hari ini</a></li>
            <?php endif; ?>
            <?php if(count($yad ?? []) > 0): ?>
                <li class="<?php if(count($hari_ini ?? []) == 0): ?> active <?php endif; ?>"><a data-toggle="tab" href="#yad">Mendatang</a></li>
            <?php endif; ?>
            <?php if(count($lama ?? []) > 0): ?>
                <li class="<?php if(count(array_merge($hari_ini, $yad) ?? []) == 0): ?> active <?php endif; ?>"><a data-toggle="tab" href="#lama">Lama</a></li>
            <?php endif; ?>
        </ul>
        <div class="tab-content">
            <?php $merge = array_merge($hari_ini, $yad, $lama); ?>
            <?php if(count($merge ?? []) > 0): ?>
                <div id="hari-ini" class="tab-pane fade in active">
                    <ul class="sidebar-latest">
                        <?php $__currentLoopData = $hari_ini; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $agenda): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li>
                                <table id="table-agenda" width="100%">
                                    <tr>
                                        <td colspan="3"><a href="<?php echo e(site_url('artikel/' . buat_slug($agenda))); ?>"><?php echo e($agenda['judul']); ?></a></td>
                                    </tr>
                                    <tr>
                                        <th id="label-meta-agenda" width="30%">Waktu</th>
                                        <td width="5%">:</td>
                                        <td id="isi-meta-agenda" width="65%"><?php echo e(tgl_indo2($agenda['tgl_agenda'])); ?></td>
                                    </tr>
                                    <tr>
                                        <th id="label-meta-agenda">Lokasi</th>
                                        <td>:</td>
                                        <td id="isi-meta-agenda"><?php echo e($agenda['lokasi_kegiatan']); ?></td>
                                    </tr>
                                    <tr>
                                        <th id="label-meta-agenda">Koordinator</th>
                                        <td>:</td>
                                        <td id="isi-meta-agenda"><?php echo e($agenda['koordinator_kegiatan']); ?></td>
                                    </tr>
                                </table>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>

                <div id="yad" class="tab-pane fade <?php if(count($hari_ini ?? []) == 0): ?> in active <?php endif; ?>">
                    <ul class="sidebar-latest">
                        <?php if(count($yad ?? []) > 0): ?>
                            <?php $__currentLoopData = $yad; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $agenda): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li>
                                    <table id="table-agenda" width="100%">
                                        <tr>
                                            <td colspan="3"><a href="<?php echo e(site_url('artikel/' . buat_slug($agenda))); ?>"><?php echo e($agenda['judul']); ?></a></td>
                                        </tr>
                                        <tr>
                                            <th id="label-meta-agenda" width="30%">Waktu</th>
                                            <td width="5%">:</td>
                                            <td id="isi-meta-agenda" width="65%"><?php echo e(tgl_indo2($agenda['tgl_agenda'])); ?></td>
                                        </tr>
                                        <tr>
                                            <th id="label-meta-agenda">Lokasi</th>
                                            <td>:</td>
                                            <td id="isi-meta-agenda"><?php echo e($agenda['lokasi_kegiatan']); ?></td>
                                        </tr>
                                        <tr>
                                            <th id="label-meta-agenda">Koordinator</th>
                                            <td>:</td>
                                            <td id="isi-meta-agenda"><?php echo e($agenda['koordinator_kegiatan']); ?></td>
                                        </tr>
                                    </table>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </ul>
                </div>

                <div id="lama" class="tab-pane fade <?php if(count($merge ?? []) == 0): ?> in active <?php endif; ?>">
                    <marquee
                        onmouseover="this.stop()"
                        onmouseout="this.start()"
                        scrollamount="2"
                        direction="up"
                        width="100%"
                        height="100"
                        align="center"
                        behavior="alternate"
                    >
                        <ul class="sidebar-latest">
                            <?php $__currentLoopData = $lama; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $agenda): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li>
                                    <table id="table-agenda" width="100%">
                                        <tr>
                                            <td colspan="3"><a href="<?php echo e(site_url('artikel/' . buat_slug($agenda))); ?>"><?php echo e($agenda['judul']); ?></a></td>
                                        </tr>
                                        <tr>
                                            <th id="label-meta-agenda" width="30%">Waktu</th>
                                            <td width="5%">:</td>
                                            <td id="isi-meta-agenda" width="65%"><?php echo e(tgl_indo2($agenda['tgl_agenda'])); ?></td>
                                        </tr>
                                        <tr>
                                            <th id="label-meta-agenda">Lokasi</th>
                                            <td>:</td>
                                            <td id="isi-meta-agenda"><?php echo e($agenda['lokasi_kegiatan']); ?></td>
                                        </tr>
                                        <tr>
                                            <th id="label-meta-agenda">Koordinator</th>
                                            <td>:</td>
                                            <td id="isi-meta-agenda"><?php echo e($agenda['koordinator_kegiatan']); ?></td>
                                        </tr>
                                    </table>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </marquee>
                </div>
            <?php else: ?>
                <p>Belum ada agenda</p>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\opensid\/storage/app/themes/natra/resources/views/widgets/agenda.blade.php ENDPATH**/ ?>