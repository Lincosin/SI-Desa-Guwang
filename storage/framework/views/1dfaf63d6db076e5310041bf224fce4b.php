<?php
    if (empty($ekstensi)) {
        $ekstensi = 'xls';
    }

    if ($aksi == 'unduh') {
        header('Content-type: application/' . $ekstensi);
        header('Content-Disposition: attachment; filename=' . namafile($file) . '.' . $ekstensi);
        header('Pragma: no-cache');
        header('Expires: 0');
    }
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php if($aksi == 'cetak' && !isset($headjs)): ?>
    <?php echo $__env->make('admin.layouts.components.headjs', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php elseif($aksi == 'cetak' && $headjs): ?>
    <?php echo $__env->make('admin.layouts.components.headjs', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>

<head>
    <title><?php echo e(ucwords($file)); ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link href="<?php echo e(base_url('assets/css/report.css')); ?>" rel="stylesheet">
    <?php echo $__env->yieldPushContent('css'); ?>
    <?php echo $__env->yieldPushContent('scripts'); ?>
</head>

<body>
    <div id="container">
        <div id="body"> <?php echo $__env->make($isi, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> </div>
        <?php if($letak_ttd && count($letak_ttd) > 0): ?>
            <br />
            <table width="10%" style="text-align: center; <?php if(isset($ispdf)): ?> margin: auto; <?php endif; ?>">
                <tr>
                    <td colspan="<?php echo e($letak_ttd[0]); ?>" width=<?php echo e($width ? '"' . 0.1 * $width . 'mm;"' : '5%'); ?>>&nbsp;</td>
                    <?php if(!empty($pamong_ketahui)): ?>
                        <td colspan="<?php echo e($letak_ttd[1]); ?>" width=<?php echo e($width ? '"' . 0.2 * $width . 'mm;"' : '40%'); ?>>
                            MENGETAHUI
                            <br><?php echo e(strtoupper($pamong_ketahui['pamong_jabatan'] . ' ' . $desa['nama_desa'])); ?>

                            <br><br><br><br>
                            <br><u><?php echo e(strtoupper($pamong_ketahui['nama'] ?? $pamong_ketahui['pamong_nama'])); ?></u>
                            <br><?php echo e(setting('sebutan_nip_desa')); ?>/NIP : <?php echo e($pamong_ketahui['pamong_nip']); ?>

                        </td>
                    <?php endif; ?>
                    <td colspan="<?php echo e($letak_ttd[2]); ?>" <?php if(isset($ispdf)): ?> style="width: 700px" <?php else: ?> width=<?php echo e($width ? '"' . 0.4 * $width . 'mm;"' : '10%'); ?> <?php endif; ?>>&nbsp;</td>
                    <td width=<?php echo e($width ? '"' . 0.2 * $width . 'mm;"' : '40%'); ?> nowrap>
                        <?php echo e(strtoupper($desa['nama_desa'] . ', ' . tgl_indo($tgl_cetak ? date('Y m d', strtotime($tgl_cetak)) : date('Y m d')))); ?>

                        <br><?php echo e(strtoupper($pamong_ttd['pamong_jabatan'] . ' ' . $desa['nama_desa'])); ?>

                        <br><br><br><br>
                        <br><u><?php echo e(strtoupper($pamong_ttd['nama'] ?? $pamong_ttd['pamong_nama'])); ?></u>
                        <br><?php echo e(setting('sebutan_nip_desa')); ?>/NIP : <?php echo e($pamong_ttd['pamong_nip']); ?>

                    </td>
                    <td width=<?php echo e($width ? '"' . 0.1 * $width . 'mm;"' : '5%'); ?>>&nbsp;</td>
                </tr>
            </table>
        <?php endif; ?>
    </div>
</body>

</html>
<?php /**PATH D:\laragon\www\opensid\resources\views/admin/layouts/components/format_cetak.blade.php ENDPATH**/ ?>