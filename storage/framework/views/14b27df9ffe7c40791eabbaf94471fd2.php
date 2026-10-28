<div class="box">
    <div class="box-header">
        <h3 class="box-title">
            <i class="fas fa-calendar-alt mr-1"></i><?php echo e($judul_widget); ?>

        </h3>
    </div>
    <div class="box-body">
        <ul class="nav nav-tabs flex list-none border-b-0 pl-0 mb-4" id="tab-agenda" role="tablist">
            <?php if(count($hari_ini ?? []) > 0): ?>
                <li class="nav-item flex-grow text-center active" role="presentation"><a
                        href="#hari-ini"
                        class="nav-link font-medium border-x-0 border-t-0 border-b-2 border-transparent px-4 py-3 my-2 hover:border-transparent hover:bg-gray-100 focus:border-transparent active"
                        data-bs-toggle="pill"
                        data-bs-target="#hari-ini"
                        role="tab"
                        aria-controls="hari-ini"
                        aria-selected="true"
                        data-toggle="tab"
                        href="#hari-ini"
                    >Hari ini</a></li>
            <?php endif; ?>

            <?php if(count($yad ?? []) > 0): ?>
                <li class="nav-item flex-grow text-center" role="presentation"><a href="#yad"
                        class="nav-link font-medium border-x-0 border-t-0 border-b-2 border-transparent px-4 py-3 my-2 hover:border-transparent hover:bg-gray-100 focus:border-transparent <?php echo e(count($hari_ini ?? []) == 0 ? 'active' : ''); ?>" data-bs-toggle="pill" data-bs-target="#yad" role="tab"
                        aria-controls="yad"
                    >Yang akan datang</a></li>
            <?php endif; ?>

            <?php if(count($lama ?? []) > 0): ?>
                <li class="nav-item flex-grow text-center" role="presentation"><a href="#lama"
                        class="nav-link font-medium border-x-0 border-t-0 border-b-2 border-transparent px-4 py-3 my-2 hover:border-transparent hover:bg-gray-100 focus:border-transparent <?php echo e(count(array_merge($hari_ini, $yad) ?? []) == 0 ? 'active' : ''); ?>" data-bs-toggle="pill"
                        data-bs-target="#lama" role="tab" aria-controls="lama"
                    >Lama</a></li>
            <?php endif; ?>
        </ul>

        <div class="tab-content content">
            <?php if(count(array_merge($hari_ini, $yad, $lama) ?? []) > 0): ?>
                <div id="hari-ini" class="tab-pane fade show active" role="tabpanel">
                    <?php $__currentLoopData = $hari_ini; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $agenda): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <table class="w-full text-sm">
                            <tr>
                                <td colspan="3"><a href="<?php echo e(site_url('artikel/' . buat_slug($agenda))); ?>"><?php echo e($agenda['judul']); ?></a></td>
                            </tr>
                            <tr>
                                <th id="label-meta-agenda" width="40%">Waktu</th>
                                <td width="5%">:</td>
                                <td id="isi-meta-agenda" width="55%"><?php echo e(tgl_indo2($agenda['tgl_agenda'])); ?></td>
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
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                <div id="yad" class="tab-pane fade <?php echo e(count($hari_ini ?? []) == 0 ? 'show active' : ''); ?>" role="tabpanel">
                    <?php if(count($yad ?? []) > 0): ?>
                        <?php $__currentLoopData = $yad; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $agenda): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <table class="w-full text-sm">
                                <tr>
                                    <td colspan="3"><a href="<?php echo e(site_url('artikel/' . buat_slug($agenda))); ?>"><?php echo e($agenda['judul']); ?></a></td>
                                </tr>
                                <tr>
                                    <th id="label-meta-agenda" width="40%">Waktu</th>
                                    <td width="5%">:</td>
                                    <td id="isi-meta-agenda" width="55%"><?php echo e(tgl_indo2($agenda['tgl_agenda'])); ?></td>
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
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </div>

                <div id="lama" class="tab-pane fade <?php echo e(count(array_merge($hari_ini, $yad) ?? []) == 0 ? 'show active' : ''); ?>" role="tabpanel">
                    <marquee
                        onmouseover="this.stop()"
                        onmouseout="this.start()"
                        scrollamount="2"
                        direction="up"
                        width="100%"
                        height="150"
                        align="center"
                    >
                        <?php $__currentLoopData = $lama; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $agenda): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <table class="w-full text-sm">
                                <tr>
                                    <td colspan="3"><a href="<?php echo e(site_url('artikel/' . buat_slug($agenda))); ?>"><?php echo e($agenda['judul']); ?></a>
                                    </td>
                                </tr>
                                <tr>
                                    <th id="label-meta-agenda" width="40%">Waktu</th>
                                    <td width="5%">:</td>
                                    <td id="isi-meta-agenda" width="55%"><?php echo e(tgl_indo2($agenda['tgl_agenda'])); ?></td>
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
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </marquee>
                </div>
            <?php else: ?>
                <p>Belum ada agenda</p>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\opensid\/desa/themes/samudra/resources/views/widgets/agenda.blade.php ENDPATH**/ ?>