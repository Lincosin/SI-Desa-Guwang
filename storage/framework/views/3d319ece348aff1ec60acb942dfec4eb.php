<!-- Print Body -->
<div id="body">
    <div align="center">
        <h3>KARTU KELUARGA</h3>
        <h4>SALINAN</h4>
        <h5>No. <?php echo e(get_nokk($kepala_kk->keluarga->no_kk)); ?> </h5>
    </div>
    <br>
    <table width="100%" cellpadding="3" cellspacing="4">
        <tr>
            <td width="100">Nama KK</td>
            <td width="600">: <?php echo e(strtoupper($kepala_kk['nama'])); ?></td>
            <td width="160"><?php echo e(ucwords(setting('sebutan_kecamatan'))); ?></td>
            <td width="150">: <?php echo e(strtoupper($desa['nama_kecamatan'])); ?></td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>:
                <?php if($kepala_kk->wilayah->dusun != '-' && $kepala_kk->wilayah->dusun != ''): ?>
                    <?php echo e(strtoupper(trim($kepala_kk->keluarga->alamat . ' ' . ucwords(setting('sebutan_dusun')) . ' ' . $kepala_kk->wilayah->dusun))); ?>

                <?php elseif($kepala_kk->keluarga->alamat): ?>
                    <?php echo e(strtoupper($kepala_kk->keluarga->alamat)); ?>

                <?php endif; ?>
            </td>
            <td>Kabupaten/Kota</td>
            <td>: <?php echo e($desa['nama_kabupaten']); ?></td>
        </tr>
        <tr>
            <td>RT / RW</td>
            <td>: <?php echo e($kepala_kk->wilayah->rt); ?> / <?php echo e($kepala_kk->wilayah->rw); ?></td>
            <td>Kode Pos</td>
            <td>: <?php echo e(strtoupper($desa['kode_pos'])); ?></td>
        </tr>
        <tr>
            <td>Kelurahan/<?php echo e(ucwords(setting('sebutan_desa'))); ?></td>
            <td>: <?php echo e(strtoupper($desa['nama_desa'])); ?></td>
            <td>Provinsi</td>
            <td>: <?php echo e(strtoupper($desa['nama_propinsi'])); ?></td>
        </tr>
    </table>

    <br>

    <table class="border thick ">
        <thead>
            <tr class="border thick">
                <th class="text-center" width="7">No</th>
                <th class="text-center" width='180'>Nama</th>
                <th class="text-center" width='100'>NIK</th>
                <th class="text-center" width='100'>Jenis Kelamin</th>
                <th class="text-center" width='100'>Tempat Lahir</th>
                <th class="text-center" width='120'>Tanggal Lahir</th>
                <th class="text-center" width='100'>Agama</th>
                <th class="text-center" width='100'>Pendidikan</th>
                <th class="text-center" width='100'>Pekerjaan</th>
                <th class="text-center" width='70'>Golongan darah</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $main; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr class="data">
                    <td class="text-center" width="2"><?php echo e($key + 1); ?></td>
                    <td><?php echo e(strtoupper($data['nama'])); ?></td>
                    <td><?php echo e($data['nik']); ?></td>
                    <td><?php echo e($data->jenis_kelamin); ?></td>
                    <td><?php echo e($data['tempatlahir']); ?></td>
                    <td><?php echo e(tgl_indo_out($data['tanggallahir'])); ?></td>
                    <td><?php echo e(strtoupper($data->agama)); ?></td>
                    <td><?php echo e($data->pendidikan_kk); ?></td>
                    <td><?php echo e($data->pekerjaan); ?></td>
                    <td align="center"><?php echo e($data->golongan_darah); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>

    <br>

    <table class="border thick ">
        <thead>
            <tr class="border thick">
                <th class="text-center" width="7">No</th>
                <th class="text-center" width='150'>Status Perkawinan</th>
                <th class="text-center" width='150'>Tanggal Perkawinan</th>
                <th class="text-center" width="130">Tanggal Perceraian</th>
                <th class="text-center" width='240'>Status Hubungan dalam Keluarga</th>
                <th class="text-center" width='140'>Kewarganegaraan</th>
                <th class="text-center" width='100'>No. Paspor</th>
                <th class="text-center" width='100'>No. KITAS / KITAP</th>
                <th class="text-center" width='170'>Nama Ayah</th>
                <th class="text-center" width='170'>Nama Ibu</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $main; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr class="data">
                    <td class="text-center" width="2"><?php echo e($key + 1); ?></td>
                    <td>
                        <?php echo e(strtoupper($data->status_perkawinan)); ?>

                    </td>
                    <td class="text-center"><?php echo e(tgl_indo_out($data['tanggalperkawinan'])); ?></td>
                    <td class="text-center"><?php echo e(tgl_indo_out($data['tanggalperceraian'])); ?></td>
                    <td><?php echo e($data->penduduk_hubungan); ?></td>
                    <td><?php echo e($data->warganegara); ?></td>
                    <td><?php echo e($data['dokumen_pasport']); ?></td>
                    <td><?php echo e($data['dokumen_kitas']); ?></td>
                    <td><?php echo e(strtoupper($data['nama_ayah'])); ?></td>
                    <td><?php echo e(strtoupper($data['nama_ibu'])); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>

    <br>

    <table width="100%" cellpadding="3" cellspacing="4">
        <tr>
            <td width="25%"></td>
            <td width="50%"></td>
            <td width="25%" align="center"><?php echo e($desa['nama_desa']); ?>, <?php echo e(tgl_indo(date('Y m d'))); ?></td>
        </tr>
        <tr>
            <td width="25%" align="center">KEPALA KELUARGA</td>
            <td width="50%"></td>
            <td align="center" width="150"><?php echo e(strtoupper(setting('sebutan_kepala_desa') . ' ' . $desa['nama_desa'])); ?></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td width="25%" align="center"><?php echo e(strtoupper($kepala_kk['nama'])); ?></td>
            <td width="50%"></td>
            <td width="25%" align="center" width="150"><?php echo e(strtoupper($desa['nama_kepala_desa'])); ?></td>
        </tr>
    </table>
</div>
<?php /**PATH C:\xampp\htdocs\opensid\resources\views/layanan_mandiri/kependudukan/cetak_kk.blade.php ENDPATH**/ ?>