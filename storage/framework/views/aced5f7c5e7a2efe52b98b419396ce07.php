<?php $__env->startSection('title'); ?>
    <h1>
        Laporan Kelompok Rentan
    </h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="active">Laporan Kelompok Rentan</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('admin.layouts.components.notifikasi', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="row">
        <div class="col-md-12">
            <form id="mainform" name="mainform" action="<?php echo e(ci_route('laporan.bulan')); ?>" method="post" class="form-horizontal">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <a href="<?php echo e(ci_route('laporan_rentan.cetak.cetak')); ?>" class="btn btn-social bg-purple btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block" target="_blank"><i class="fa fa-print "></i> Cetak</a>
                        <a href="<?php echo e(ci_route('laporan_rentan.cetak.unduh')); ?>" class="btn btn-social bg-navy btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block" target="_blank"><i class="fa  fa-download"></i> Unduh</a>
                    </div>
                    <div class="box-header  with-border">
                        <h4 class="text-center"><strong>PEMERINTAH KABUPATEN/KOTA
                                <?php echo e(strtoupper($desa['nama_kabupaten'])); ?></strong></h4>
                        <h5 class="text-center"><strong>DATA PILAH KEPENDUDUKAN MENURUT UMUR DAN FAKTOR KERENTANAN (LAMPIRAN
                                A - 9)</strong></h5>
                    </div>
                    <div class="box-header  with-border">
                        <div class="form-group">
                            <label class="col-sm-2 col-md-1 control-label" for="kelurahan"><?php echo e(ucwords(setting('sebutan_desa'))); ?>/Kel</label>
                            <div class="col-sm-4 col-md-2">
                                <input type="text" class="form-control input-sm" value="<?php echo e($desa['nama_desa']); ?>" disabled /></input>
                            </div>
                            <label class="col-sm-2 col-md-1 control-label" for="kecamatan"><?php echo e(ucwords(setting('sebutan_kecamatan'))); ?></label>
                            <div class="col-sm-4 col-md-2">
                                <input type="text" class="form-control input-sm" value="<?php echo e($desa['nama_kecamatan']); ?>" disabled /></input>
                            </div>
                            <label class="col-sm-2 col-md-1 control-label" for="laporan">Lap. Bulan</label>
                            <div class="col-sm-4 col-md-2">
                                <input type="text" class="form-control input-sm" value="<?php echo e(getBulan(date('m'))); ?>" disabled /></input>
                            </div>
                            <label class="col-sm-2 col-md-1 control-label" for="filter"><?php echo e(ucwords(setting('sebutan_dusun'))); ?></label>
                            <div class="col-sm-4 col-md-2">
                                <select class="form-control input-sm select2" name="dusun" onchange="formAction('mainform','<?php echo e(ci_route('laporan_rentan.dusun')); ?>')">
                                    <option value="">Pilih <?php echo e(ucwords(setting('sebutan_dusun'))); ?></option>
                                    <?php $__currentLoopData = $wilayah; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $keyDusun => $dusun): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($keyDusun); ?>" <?= ($keyDusun == $dusunTerpilih) ? 'selected' : ''; ?>>
                                            <?php echo e($keyDusun); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="box-body">
                        <?php if($dusunTerpilih != ''): ?>
                            <h4>DATA PILAH <?php echo e(strtoupper(setting('sebutan_dusun'))); ?> <?php echo e($dusunTerpilih); ?></h4>
                        <?php endif; ?>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover nowrap">
                                <thead class="bg-gray">
                                    <tr>
                                        <th rowspan="2" class="text-center"><?php echo e(ucwords(setting('sebutan_dusun'))); ?></th>
                                        <th rowspan="2" class="text-center">RW</th>
                                        <th rowspan="2" class="text-center">RT</th>
                                        <th colspan="2" class="text-center">KK</th>
                                        <th colspan="6" class="text-center">Kondisi dan Kelompok Umur</th>
                                        <th colspan="7" class="text-center">Cacat</th>
                                        <th colspan="2" class="text-center">Sakit Menahun</th>
                                        <th rowspan="2" class="text-center">Hamil</th>
                                    </tr>
                                    <tr>
                                        <th class="text-center">L</th>
                                        <th class="text-center">P</th>
                                        <th class="text-center">Di bawah 1 Tahun</th>
                                        <th class="text-center">1-5 Tahun</th>
                                        <th class="text-center">6-12 Tahun</th>
                                        <th class="text-center">13-15 Tahun</th>
                                        <th class="text-center">16-18 Tahun</th>
                                        <th class="text-center">Di atas 60 Tahun</th>
                                        <th class="text-center">Cacat Fisik</th>
                                        <th class="text-center">Cacat Netra/ Buta</th>
                                        <th class="text-center">Cacat Rungu/ Wicara</th>
                                        <th class="text-center">Cacat Mental/ Jiwa</th>
                                        <th class="text-center">Cacat Fisik dan Mental</th>
                                        <th class="text-center">Cacat Lainnya</th>
                                        <th class="text-center">Tidak Cacat</th>
                                        <th class="text-center">L</th>
                                        <th class="text-center">P</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $bayi = 0;
                                        $balita = 0;
                                        $sd = 0;
                                        $smp = 0;
                                        $sma = 0;
                                        $lansia = 0;
                                        $cacat = 0;
                                        $sakit_L = 0;
                                        $sakit_P = 0;
                                        $hamil = 0;
                                        $jenis_cacat = App\Enums\CacatEnum::all();
                                        $totalCacat = [];
                                    ?>
                                    <?php $__currentLoopData = $wilayah; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $namaDusun => $dusunObj): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php $__currentLoopData = $dusunObj; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $namaRw => $rwObj): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php $__currentLoopData = $rwObj; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php
                                                    $totalBarisCacat = 0;
                                                    $totalPenduduk = 0;
                                                    $totalPendudukPria = 0;
                                                    $totalPendudukWanita = 0;
                                                    if ($main['jenisKelamin'][$rt->id]) {
                                                        if ($main['jenisKelamin'][$rt->id][App\Enums\JenisKelaminEnum::LAKI_LAKI]) {
                                                            $totalPendudukPria += $main['jenisKelamin'][$rt->id][App\Enums\JenisKelaminEnum::LAKI_LAKI]['total'];
                                                        }
                                                        if ($main['jenisKelamin'][$rt->id][App\Enums\JenisKelaminEnum::PEREMPUAN]) {
                                                            $totalPendudukWanita += $main['jenisKelamin'][$rt->id][App\Enums\JenisKelaminEnum::PEREMPUAN]['total'];
                                                        }
                                                    }
                                                    $totalPenduduk = $totalPendudukPria + $totalPendudukWanita;
                                                ?>
                                                <?php if(!$totalPenduduk): ?>
                                                    <?php continue; ?>
                                                <?php endif; ?>
                                                <tr>
                                                    <td class="text-right"><?php echo e($namaDusun); ?></td>
                                                    <td class="text-right"><?php echo e($namaRw); ?></td>
                                                    <td class="text-right"><?php echo e($rt->rt); ?></td>
                                                    <td class="text-right"><a href="<?php echo e(ci_route("penduduk.lap_statistik.{$rt->id}.1")); ?>?dusun=<?php echo e($namaDusun); ?>&rw=<?php echo e($namaRw); ?>&rt=<?php echo e($rt->rt); ?>"><?php echo e($totalPendudukPria); ?></a>
                                                    </td>
                                                    <td class="text-right"><a href="<?php echo e(ci_route("penduduk.lap_statistik.{$rt->id}.2")); ?>?dusun=<?php echo e($namaDusun); ?>&rw=<?php echo e($namaRw); ?>&rt=<?php echo e($rt->rt); ?>"><?php echo e($totalPendudukWanita); ?></a>
                                                    </td>
                                                    <td class="text-right"><a href="<?php echo e(ci_route("penduduk.lap_statistik.{$rt->id}.3")); ?>?dusun=<?php echo e($namaDusun); ?>&rw=<?php echo e($namaRw); ?>&rt=<?php echo e($rt->rt); ?>"><?php echo e($main['bayi'][$rt->id]['total'] ?? 0); ?></a>
                                                    </td>
                                                    <td class="text-right"><a href="<?php echo e(ci_route("penduduk.lap_statistik.{$rt->id}.4")); ?>?dusun=<?php echo e($namaDusun); ?>&rw=<?php echo e($namaRw); ?>&rt=<?php echo e($rt->rt); ?>"><?php echo e($main['balita'][$rt->id]['total'] ?? 0); ?></a>
                                                    </td>
                                                    <td class="text-right"><a href="<?php echo e(ci_route("penduduk.lap_statistik.{$rt->id}.5")); ?>?dusun=<?php echo e($namaDusun); ?>&rw=<?php echo e($namaRw); ?>&rt=<?php echo e($rt->rt); ?>"><?php echo e($main['sd'][$rt->id]['total'] ?? 0); ?></a>
                                                    </td>
                                                    <td class="text-right"><a href="<?php echo e(ci_route("penduduk.lap_statistik.{$rt->id}.6")); ?>?dusun=<?php echo e($namaDusun); ?>&rw=<?php echo e($namaRw); ?>&rt=<?php echo e($rt->rt); ?>"><?php echo e($main['smp'][$rt->id]['total'] ?? 0); ?></a>
                                                    </td>
                                                    <td class="text-right"><a href="<?php echo e(ci_route("penduduk.lap_statistik.{$rt->id}.7")); ?>?dusun=<?php echo e($namaDusun); ?>&rw=<?php echo e($namaRw); ?>&rt=<?php echo e($rt->rt); ?>"><?php echo e($main['sma'][$rt->id]['total'] ?? 0); ?></a>
                                                    </td>
                                                    <td class="text-right"><a href="<?php echo e(ci_route("penduduk.lap_statistik.{$rt->id}.8")); ?>?dusun=<?php echo e($namaDusun); ?>&rw=<?php echo e($namaRw); ?>&rt=<?php echo e($rt->rt); ?>"><?php echo e($main['lansia'][$rt->id]['total'] ?? 0); ?></a>
                                                    </td>
                                                    <?php $__currentLoopData = $jenis_cacat; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kode_cacat => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php
                                                            $cacat = $main['cacat'][$rt->id][$kode_cacat]['total'] ?? 0;

                                                            if ($kode_cacat == App\Enums\CacatEnum::TIDAK_CACAT) {
                                                                $cacat = $totalPenduduk - $totalBarisCacat;
                                                            } else {
                                                                $totalBarisCacat += $cacat;
                                                            }
                                                            $totalCacat[$kode_cacat] += $cacat;
                                                        ?>
                                                        <td class="text-right"><a href="<?php echo e(ci_route("penduduk.lap_statistik.{$rt->id}.9{$kode_cacat}")); ?>?dusun=<?php echo e($namaDusun); ?>&rw=<?php echo e($namaRw); ?>&rt=<?php echo e($rt->rt); ?>"><?php echo e($cacat); ?></a>
                                                        </td>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <td class="text-right"><a href="<?php echo e(ci_route("penduduk.lap_statistik.{$rt->id}.10")); ?>?dusun=<?php echo e($namaDusun); ?>&rw=<?php echo e($namaRw); ?>&rt=<?php echo e($rt->rt); ?>"><?php echo e($main['sakit'][$rt->id][App\Enums\JenisKelaminEnum::LAKI_LAKI]['total'] ?? 0); ?></a>
                                                    </td>
                                                    <td class="text-right"><a href="<?php echo e(ci_route("penduduk.lap_statistik.{$rt->id}.11")); ?>?dusun=<?php echo e($namaDusun); ?>&rw=<?php echo e($namaRw); ?>&rt=<?php echo e($rt->rt); ?>"><?php echo e($main['sakit'][$rt->id][App\Enums\JenisKelaminEnum::PEREMPUAN]['total'] ?? 0); ?></a>
                                                    </td>
                                                    <td class="text-right"><a href="<?php echo e(ci_route("penduduk.lap_statistik.{$rt->id}.12")); ?>?dusun=<?php echo e($namaDusun); ?>&rw=<?php echo e($namaRw); ?>&rt=<?php echo e($rt->rt); ?>"><?php echo e($main['hamil'][$rt->id]['total'] ?? 0); ?></a>
                                                    </td>
                                                    <?php
                                                        $bayi += $main['bayi'][$rt->id]['total'] ?? 0;
                                                        $balita += $main['balita'][$rt->id]['total'] ?? 0;
                                                        $sd += $main['sd'][$rt->id]['total'] ?? 0;
                                                        $smp += $main['smp'][$rt->id]['total'] ?? 0;
                                                        $sma += $main['sma'][$rt->id]['total'] ?? 0;
                                                        $lansia += $main['lansia'][$rt->id]['total'] ?? 0;
                                                        $sakit_L += $main['sakit'][App\Enums\JenisKelaminEnum::LAKI_LAKI][$rt->id]['total'] ?? 0;
                                                        $sakit_P += $main['sakit'][App\Enums\JenisKelaminEnum::PEREMPUAN][$rt->id]['total'] ?? 0;
                                                        $hamil += $main['hamil'][$rt->id]['total'] ?? 0;
                                                    ?>

                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                                <tfoot class="bg-gray disabled color-palette">
                                    <tr>
                                        <th colspan="5" class="text-right">Total</th>
                                        <th class="text-right"><?php echo e($bayi); ?></th>
                                        <th class="text-right"><?php echo e($balita); ?></th>
                                        <th class="text-right"><?php echo e($sd); ?></th>
                                        <th class="text-right"><?php echo e($smp); ?></th>
                                        <th class="text-right"><?php echo e($sma); ?></th>
                                        <th class="text-right"><?php echo e($lansia); ?></th>
                                        <?php $__currentLoopData = $totalCacat; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cacat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <th class="total text-right"><?php echo e($cacat); ?></th>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <th class="text-right"><?php echo e($sakit_L); ?></th>
                                        <th class="text-right"><?php echo e($sakit_P); ?></th>
                                        <th class="text-right"><?php echo e($hamil); ?></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\opensid\resources\views/admin/laporan/rentan/index.blade.php ENDPATH**/ ?>