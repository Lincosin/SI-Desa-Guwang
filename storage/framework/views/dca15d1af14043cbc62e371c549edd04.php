<?php $__env->startPush('css'); ?>
<style>
    .table {
        font-size: 12px;
    }

    .bg-identitas {
        width: 100%;
        height: 300px;
        background: url("<?php echo e(gambar_desa($main['path_kantor_desa'], true)); ?>");
        background-repeat: no-repeat;
        background-position: center center;
    }

    .img-identitas {
        margin: 30px auto;
        width: 100px;
        padding: 3px;
    }

    .text-identitas {
        text-align: center;
        font-weight: bold;
        color: #fff;
        text-shadow: 2px 2px 2px #0c83c5;
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('title'); ?>
<h1>
    <?php echo e(SebutanDesa('Identitas [Desa]')); ?>

</h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
<li class="active"><?php echo e(SebutanDesa('Identitas [Desa]')); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('admin.layouts.components.notifikasi', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('admin.identitas_desa.info_kades', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div class="box box-info">
    <?php if(can('u')): ?>
    <div class="box-header with-border">
        <a href="<?php echo e(ci_route('identitas_desa.form')); ?>" class="btn btn-social btn-warning btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block" title="Ubah Data <?php echo e(ucwords(setting('sebutan_desa'))); ?>"><i class="fa fa-edit"></i> Ubah Data
            <?php echo e(ucwords(setting('sebutan_desa'))); ?></a>
        <a href="<?php echo e(ci_route('identitas_desa.maps.kantor')); ?>" class="btn btn-social bg-purple btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block" title="Lokasi Kantor <?php echo e(ucwords(setting('sebutan_desa'))); ?>"><i class='fa fa-map-marker'></i>
            Lokasi
            Kantor <?php echo e(ucwords(setting('sebutan_desa'))); ?></a>
        <a href="<?php echo e(ci_route('identitas_desa.maps.wilayah')); ?>" class="btn btn-social btn-info btn-sm btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block" title="Peta Wilayah <?php echo e(ucwords(setting('sebutan_desa'))); ?>"><i class='fa fa-map'></i>
            Peta Wilayah
            <?php echo e(ucwords(setting('sebutan_desa'))); ?></a>
        <?php if(!$main): ?>
        <a href="<?php echo e(ci_route('identitas_desa.reset')); ?>" class="btn btn-social btn-danger btn-sm btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block" title="Reset AppKey"><i class="fa fa-times"></i> Reset AppKey</a>
        <?php endif; ?>
    </div>
    <?php endif; ?>
    <div class="box-body">
        <div class="box-body bg-identitas">
            <img class="img-identitas img-responsive" src="<?php echo e(gambar_desa($main['path_logo'])); ?>" alt="logo-desa">
            <h3 class="text-identitas"><?php echo e(ucwords(setting('sebutan_desa') . ' ' . $main['nama_desa'])); ?></h3>
            <p class="text-identitas">
                <b><?php echo e(ucwords(setting('sebutan_kecamatan') . ' ' . $main['nama_kecamatan'] . ', ' . setting('sebutan_kabupaten') . ' ' . $main['nama_kabupaten'] . ', Provinsi ' . $main['nama_propinsi'])); ?></b>
            </p>
        </div>
        <br>
    </div>

    <div class="nav-tabs-custom">
        <?php if($cek_profil_desa): ?>
        <ul class="nav nav-tabs">
            <li class="active"><a href="#umum" data-toggle="tab">Umum</a></li>
            <li><a href="#profil" data-toggle="tab">Profil</a></li>
        </ul>
        <?php endif; ?>
        <div class="tab-content">
            <div class="tab-pane active" id="umum">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover tabel-rincian">
                        <tbody>
                            <tr>
                                <th colspan="3" class="subtitle_head">
                                    <strong><?php echo e(strtoupper(setting('sebutan_desa'))); ?></strong>
                                </th>
                            </tr>
                            <tr>
                                <td width="300">Nama <?php echo e(ucwords(setting('sebutan_desa'))); ?></td>
                                <td width="1">:</td>
                                <td><?php echo e($main['nama_desa']); ?></td>
                            </tr>
                            <tr>
                                <td>Kode <?php echo e(ucwords(setting('sebutan_desa'))); ?></td>
                                <td>:</td>
                                <td><?php echo e(kode_wilayah($main['kode_desa'])); ?></td>
                            </tr>
                            <tr>
                                <td>Kode BPS <?php echo e(ucwords(setting('sebutan_desa'))); ?></td>
                                <td>:</td>
                                <td><?php echo e($main['kode_desa_bps']); ?></td>
                            </tr>
                            <tr>
                                <td>Kode Pos <?php echo e(ucwords(setting('sebutan_desa'))); ?></td>
                                <td>:</td>
                                <td><?php echo e($main['kode_pos']); ?></td>
                            </tr>
                            <tr>
                                <td>Nama <?php echo e(ucwords(setting('sebutan_kepala_desa'))); ?></td>
                                <td>:</td>
                                <td><?php echo e($main['nama_kepala_desa']); ?></td>
                            </tr>
                            <tr>
                                <td>NIP <?php echo e(ucwords(setting('sebutan_kepala_desa'))); ?></td>
                                <td>:</td>
                                <td><?php echo e($main['nip_kepala_desa']); ?></td>
                            </tr>
                            <tr>
                                <td>Alamat Kantor <?php echo e(ucwords(setting('sebutan_desa'))); ?></td>
                                <td>:</td>
                                <td><?php echo e($main['alamat_kantor']); ?></td>
                            </tr>
                            <tr>
                                <td>E-Mail <?php echo e(ucwords(setting('sebutan_desa'))); ?></td>
                                <td>:</td>
                                <td><?php echo e($main['email_desa']); ?></td>
                            </tr>
                            <tr>
                                <td>Nomor Telepon <?php echo e(ucwords(setting('sebutan_desa'))); ?></td>
                                <td>:</td>
                                <td><?php echo e($main['telepon']); ?></td>
                            </tr>
                            <tr>
                                <td>Nomor Ponsel <?php echo e(ucwords(setting('sebutan_desa'))); ?></td>
                                <td>:</td>
                                <td><?php echo e($main['nomor_operator']); ?></td>
                            </tr>
                            <tr>
                                <td>Website <?php echo e(ucwords(setting('sebutan_desa'))); ?></td>
                                <td>:</td>
                                <td><?php echo e($main['website']); ?></td>
                            </tr>
                            <tr>
                                <th colspan="3" class="subtitle_head">
                                    <strong><?php echo e(strtoupper(setting('sebutan_kecamatan'))); ?></strong>
                                </th>
                            </tr>
                            <tr>
                                <td>Nama <?php echo e(ucwords(setting('sebutan_kecamatan'))); ?></td>
                                <td>:</td>
                                <td><?php echo e($main['nama_kecamatan']); ?></td>
                            </tr>
                            <tr>
                                <td>Kode <?php echo e(ucwords(setting('sebutan_kecamatan'))); ?></td>
                                <td>:</td>
                                <td><?php echo e(kode_wilayah($main['kode_kecamatan'])); ?></td>
                            </tr>
                            <tr>
                                <td>Nama <?php echo e(ucwords(setting('sebutan_camat'))); ?></td>
                                <td>:</td>
                                <td><?php echo e($main['nama_kepala_camat']); ?></td>
                            </tr>
                            <tr>
                                <td>NIP <?php echo e(ucwords(setting('sebutan_camat'))); ?></td>
                                <td>:</td>
                                <td><?php echo e($main['nip_kepala_camat']); ?></td>
                            </tr>
                            <tr>
                                <th colspan="3" class="subtitle_head">
                                    <strong><?php echo e(strtoupper(setting('sebutan_kabupaten'))); ?></strong>
                                </th>
                            </tr>
                            <tr>
                                <td>Nama <?php echo e(ucwords(setting('sebutan_kabupaten'))); ?></td>
                                <td>:</td>
                                <td><?php echo e($main['nama_kabupaten']); ?></td>
                            </tr>
                            <tr>
                                <td>Kode <?php echo e(ucwords(setting('sebutan_kabupaten'))); ?></td>
                                <td>:</td>
                                <td><?php echo e(kode_wilayah($main['kode_kabupaten'])); ?></td>
                            </tr>
                            <tr>
                                <th colspan="3" class="subtitle_head"><strong>PROVINSI</strong></th>
                            </tr>
                            <tr>
                                <td>Nama Provinsi</td>
                                <td>:</td>
                                <td><?php echo e($main['nama_propinsi']); ?></td>
                            </tr>
                            <tr>
                                <td>Kode Provinsi</td>
                                <td>:</td>
                                <td><?php echo e(kode_wilayah($main['kode_propinsi'])); ?></td>
                            </tr>
                            <tr>
                                <th colspan="3" class="subtitle_head"><strong>KONTAK PEMBERITAHUAN</strong></th>
                            </tr>
                            <tr>
                                <td>Nama <?php echo e(ucwords(setting('sebutan_pemerintah_desa'))); ?></td>
                                <td>:</td>
                                <td><?php echo e($main['nama_kontak']); ?></td>
                            </tr>
                            <tr>
                                <td>No. HP/WA</td>
                                <td>:</td>
                                <td><?php echo e($main['hp_kontak']); ?></td>
                            </tr>
                            <tr>
                                <td>Jabatan</td>
                                <td>:</td>
                                <td><?php echo e($main['jabatan_kontak']); ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <?php if($cek_profil_desa): ?>
            <div class="tab-pane" id="profil">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover tabel-rincian">
                        <tbody>
                            
                            <tr>
                                <th colspan="3" class="subtitle_head"><strong>EKOLOGI</strong></th>
                            </tr>
                            <?php $__currentLoopData = $profil_desa['ekologi']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td width="300"><?php echo e($item->judul); ?></td>
                                <td width="1">:</td>
                                <td><?php echo e($item->value); ?></td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            
                            <tr>
                                <th colspan="3" class="subtitle_head"><strong>INTERNET</strong></th>
                            </tr>
                            <?php $__currentLoopData = $profil_desa['internet']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($item->judul); ?></td>
                                <td>:</td>
                                <td><?php echo e($item->value); ?></td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            
                            <tr>
                                <th colspan="3" class="subtitle_head"><strong>ADAT</strong></th>
                            </tr>
                            <?php $__currentLoopData = $profil_desa['adat']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <?php if($item->key === 'status_desa'): ?>
                                        <td><?php echo e(SebutanDesa("Status [Desa]")); ?></td>
                                    <?php else: ?>
                                        <td><?php echo e($item->judul); ?></td>
                                    <?php endif; ?>
                                    <td>:</td>
                                    <td>
                                    <?php if($item->key == 'struktur_adat' && $item->value): ?>
                                        <?php if (isset($component)) { $__componentOriginal0fd673fce629071b3dc828d9abc34190 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal0fd673fce629071b3dc828d9abc34190 = $attributes; } ?>
<?php $component = App\View\Components\BtnButton::resolve(['judul' => 'Lihat','icon' => 'fa fa-eye','blank' => 'true','type' => 'bg-blue','file' => 'true','url' => LOKASI_DOKUMEN . $item->value] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('btn-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\BtnButton::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal0fd673fce629071b3dc828d9abc34190)): ?>
<?php $attributes = $__attributesOriginal0fd673fce629071b3dc828d9abc34190; ?>
<?php unset($__attributesOriginal0fd673fce629071b3dc828d9abc34190); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal0fd673fce629071b3dc828d9abc34190)): ?>
<?php $component = $__componentOriginal0fd673fce629071b3dc828d9abc34190; ?>
<?php unset($__componentOriginal0fd673fce629071b3dc828d9abc34190); ?>
<?php endif; ?>
                                    <?php else: ?>
                                        <?php echo e($item->value); ?>

                                    <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            <?php $__currentLoopData = $profil_desa['lainnya']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e(SebutanDesa($item->judul)); ?></td>
                                    <td>:</td>
                                    <td>
                                    <?php if($item->key == 'dokumen_regulasi_penetapan_kampung_adat' && $item->value): ?>
                                        <?php if (isset($component)) { $__componentOriginal0fd673fce629071b3dc828d9abc34190 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal0fd673fce629071b3dc828d9abc34190 = $attributes; } ?>
<?php $component = App\View\Components\BtnButton::resolve(['judul' => 'Lihat','icon' => 'fa fa-eye','blank' => 'true','type' => 'bg-blue','file' => 'true','url' => LOKASI_DOKUMEN . $item->value] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('btn-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\BtnButton::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal0fd673fce629071b3dc828d9abc34190)): ?>
<?php $attributes = $__attributesOriginal0fd673fce629071b3dc828d9abc34190; ?>
<?php unset($__attributesOriginal0fd673fce629071b3dc828d9abc34190); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal0fd673fce629071b3dc828d9abc34190)): ?>
<?php $component = $__componentOriginal0fd673fce629071b3dc828d9abc34190; ?>
<?php unset($__componentOriginal0fd673fce629071b3dc828d9abc34190); ?>
<?php endif; ?>
                                    <?php else: ?>
                                        <?php echo e($item->value); ?>

                                    <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </tbody>
                    </table>
                </div>

            </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\opensid\resources\views/admin/identitas_desa/index.blade.php ENDPATH**/ ?>