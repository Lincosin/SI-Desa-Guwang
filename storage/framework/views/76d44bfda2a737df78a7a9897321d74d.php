<table>
    <tbody>
        <tr>
            <td align="center">
                <?php if($aksi != 'unduh'): ?>
                    <img class="logo" src="<?php echo e(gambar_desa($desa['logo'])); ?>" alt="logo-desa">
                <?php endif; ?>
                <h1 class="judul">
                    PEMERINTAH <?php echo strtoupper(setting('sebutan_kabupaten') . ' ' . $desa['nama_kabupaten'] . ' <br>' . setting('sebutan_kecamatan') . ' ' . $desa['nama_kecamatan'] . ' <br>' . setting('sebutan_desa') . ' ' . $desa['nama_desa']); ?>

                </h1>
                <h1 style="text-align: center;">LAPORAN DATA STATISTIK KEPENDUDUKAN MENURUT <?php echo e(strtoupper($judul)); ?></h1>
            </td>
        </tr>
        <tr>
            <td style="padding: 5px 20px;">
                <br>
                <table>
                    <tbody>
                        <?php if($dusun): ?>
                            <tr>
                                <td class="top" width="60%">
                                    <div class="nowrap">
                                        <label style="width: 150px;"><?php echo e(ucwords(setting('sebutan_dusun'))); ?></label>
                                        <label>:</label>
                                        <span><?php echo e(ucwords($dusun)); ?></span>
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                        <?php if($rw): ?>
                            <tr>
                                <td class="top" width="60%">
                                    <div class="nowrap">
                                        <label style="width: 150px;">RW</label>
                                        <label>:</label>
                                        <span><?php echo e($rw); ?></span>
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                        <?php if($rt): ?>
                            <tr>
                                <td class="top" width="60%">
                                    <div class="nowrap">
                                        <label style="width: 150px;">RT</label>
                                        <label>:</label>
                                        <span><?php echo e($rt); ?></span>
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
                <br>
                <table class="border thick data">
                    <thead>
                        <tr class="thick">
                            <th class="thick">No</th>
                            <th class="thick" width="50%"><?php echo e($stat); ?></th>
                            <th class="thick" width="16%">Jumlah</th>
                            <th class="thick" width="16%">Laki-laki</th>
                            <th class="thick" width="16%">Perempuan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $main; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $no => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                if ($data['id'] == 666 || $data['id'] == 777 || $data['id'] == 888) {
                                    $no = '';
                                } else {
                                    $no++;
                                }
                            ?>
                            <tr>
                                <td class="thick" align="center" width="2"><?php echo e($no); ?></td>
                                <td class="thick"><?php echo e(strtoupper($data['nama'])); ?></td>
                                <td class="thick" align="right"><?php echo e($data['jumlah']); ?></td>
                                <td class="thick" align="right"><?php echo e($data['laki']); ?></td>
                                <td class="thick" align="right"><?php echo e($data['perempuan']); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
                <br>
                <table class="noborder">
                    <tbody>
                        <tr>
                            <td class="top" colspan="5">
                                <div class="nowrap">
                                    <label>Laporan data statistik kependudukan menurut <?php echo e(strtolower($stat)); ?> pada tanggal</label>
                                    <label>:</label>
                                    <strong><?php echo e(tgl_indo(date('Y m d'))); ?></strong>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </tbody>
</table>
<?php /**PATH D:\laragon\www\opensid\resources\views/web/statistik/cetak.blade.php ENDPATH**/ ?>