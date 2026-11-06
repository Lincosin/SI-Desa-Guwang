<div class="box box-widget">
    <div class="box-footer no-padding">
        <ul class="nav nav-stacked">
            <li <?php echo e(jecho($selectedNav, 'induk', 'class="active"')); ?>><a href="<?php echo e(ci_route('bumindes_penduduk_induk')); ?>">Buku Induk Penduduk</a></li>
            <li <?php echo e(jecho($selectedNav, 'mutasi', 'class="active"')); ?>><a href="<?php echo e(ci_route('bumindes_penduduk_mutasi')); ?>">Buku Mutasi Penduduk <?php echo e(ucwords(setting('sebutan_desa'))); ?></a></li>
            <li <?php echo e(jecho($selectedNav, 'rekapitulasi', 'class="active"')); ?>><a href="<?php echo e(ci_route('bumindes_penduduk_rekapitulasi')); ?>">Buku Rekapitulasi Jumlah Penduduk</a></li>
            <li <?php echo e(jecho($selectedNav, 'sementara', 'class="active"')); ?>><a href="<?php echo e(ci_route('bumindes_penduduk_sementara')); ?>">Buku Penduduk Sementara</a></li>
            <li <?php echo e(jecho($selectedNav, 'ktpkk', 'class="active"')); ?>><a href="<?php echo e(ci_route('bumindes_penduduk_ktpkk')); ?>">Buku KTP dan KK</a></li>
        </ul>
    </div>
</div>

<div class="box box-widget">
    <div class="box-footer no-padding">
        <ul class="nav nav-stacked">
            <li <?php echo e(jecho($selectedNav, 'sinkronasi', 'class="active"')); ?>><a href="<?php echo e(ci_route('laporan_penduduk')); ?>">Sinkronasi Laporan Penduduk</a></li>
        </ul>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\opensid\resources\views/admin/bumindes/penduduk/side.blade.php ENDPATH**/ ?>