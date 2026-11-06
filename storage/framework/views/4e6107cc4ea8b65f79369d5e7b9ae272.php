<?php $__env->startSection('title'); ?>
<h1>
    Detail <?php echo e($module_name); ?>

</h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
<li><a href="<?php echo e(ci_route('penduduk')); ?>">Data <?php echo e($module_name); ?></a></li>
<li class="active">Biodata <?php echo e($module_name); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
<style>
    .table {
        font-size: 12px;
    }

    .detail {
        margin-top: 5px;
        margin-bottom: 5px;
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('admin.layouts.components.notifikasi', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<div class="box box-info">
    <div class="box-header with-border">
        <div class="btn-toolbar" role="toolbar">
            <!-- Dokumen Management -->
            <div class="btn-group" role="group">
                <?php if (isset($component)) { $__componentOriginal0fd673fce629071b3dc828d9abc34190 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal0fd673fce629071b3dc828d9abc34190 = $attributes; } ?>
<?php $component = App\View\Components\BtnButton::resolve(['url' => 'penduduk/dokumen/' . $penduduk->id,'judul' => 'Manajemen Dokumen','icon' => 'fa fa-book','type' => 'btn-success'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
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
            </div>

            <!-- Edit and Print Actions -->
            <?php if(can('u') && $penduduk->status_dasar == App\Enums\StatusDasarEnum::HIDUP): ?>
                <?php if (isset($component)) { $__componentOriginal0fd673fce629071b3dc828d9abc34190 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal0fd673fce629071b3dc828d9abc34190 = $attributes; } ?>
<?php $component = App\View\Components\BtnButton::resolve(['url' => 'penduduk/form/' . $penduduk->id,'judul' => 'Ubah Biodata','icon' => 'fa fa-edit','type' => 'btn-warning'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
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
            <?php endif; ?>

            <?php if (isset($component)) { $__componentOriginal0fd673fce629071b3dc828d9abc34190 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal0fd673fce629071b3dc828d9abc34190 = $attributes; } ?>
<?php $component = App\View\Components\BtnButton::resolve(['url' => 'penduduk/cetak_biodata/' . $penduduk->id,'judul' => 'Cetak Biodata','icon' => 'fa fa-print','type' => 'bg-purple','blank' => true] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
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

            <!-- Family Actions -->
            <?php if($penduduk->keluarga->no_kk && $penduduk->status_dasar == App\Enums\StatusDasarEnum::HIDUP && !empty($penduduk->id_kk)): ?>
                <div class="btn-group" role="group">
                    <?php if (isset($component)) { $__componentOriginal0fd673fce629071b3dc828d9abc34190 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal0fd673fce629071b3dc828d9abc34190 = $attributes; } ?>
<?php $component = App\View\Components\BtnButton::resolve(['url' => 'keluarga/anggota/' . $penduduk->id_kk,'judul' => 'Anggota Keluarga','icon' => 'fa fa-users','type' => 'btn-danger'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
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
                </div>
            <?php endif; ?>

            <!-- Add Resident Dropdown -->
            <?php if(can('u')): ?>
                <?php
                    $listTambahPenduduk = [
                        [
                            'url' => 'penduduk/form_peristiwa/1',
                            'judul' => 'Penduduk Lahir',
                            'icon' => 'fa fa-plus',
                            'modal' => false,
                            'target' => false
                        ],
                        [
                            'url' => 'penduduk/form_peristiwa/5',
                            'judul' => 'Penduduk Masuk',
                            'icon' => 'fa fa-plus',
                            'modal' => false,
                            'target' => false
                        ]
                    ];
                ?>
                
                <div class="btn-group" role="group">
                    <?php if (isset($component)) { $__componentOriginal8efe3807774add4f16598e058556e738 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8efe3807774add4f16598e058556e738 = $attributes; } ?>
<?php $component = App\View\Components\SplitButton::resolve(['judul' => 'Tambah Penduduk','list' => $listTambahPenduduk,'icon' => 'fa fa-plus','type' => 'btn-success'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('split-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\SplitButton::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal8efe3807774add4f16598e058556e738)): ?>
<?php $attributes = $__attributesOriginal8efe3807774add4f16598e058556e738; ?>
<?php unset($__attributesOriginal8efe3807774add4f16598e058556e738); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8efe3807774add4f16598e058556e738)): ?>
<?php $component = $__componentOriginal8efe3807774add4f16598e058556e738; ?>
<?php unset($__componentOriginal8efe3807774add4f16598e058556e738); ?>
<?php endif; ?>
                </div>
            <?php endif; ?>

            <!-- Back Button -->
            <div class="btn-group" role="group">
                <?php if (isset($component)) { $__componentOriginalc11c7292aaa9235aebed7379ae351e6a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc11c7292aaa9235aebed7379ae351e6a = $attributes; } ?>
<?php $component = App\View\Components\KembaliButton::resolve(['url' => 'penduduk/clear','judul' => 'Kembali Ke Daftar Penduduk'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('kembali-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\KembaliButton::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc11c7292aaa9235aebed7379ae351e6a)): ?>
<?php $attributes = $__attributesOriginalc11c7292aaa9235aebed7379ae351e6a; ?>
<?php unset($__attributesOriginalc11c7292aaa9235aebed7379ae351e6a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc11c7292aaa9235aebed7379ae351e6a)): ?>
<?php $component = $__componentOriginalc11c7292aaa9235aebed7379ae351e6a; ?>
<?php unset($__componentOriginalc11c7292aaa9235aebed7379ae351e6a); ?>
<?php endif; ?>
            </div>
        </div>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-md-12">
                <div class="box-header with-border">
                    <h3 class="box-title">Biodata Penduduk (NIK : <?php echo e($penduduk->nik); ?>)</h3>
                    <br>
                    <?php if(!empty($penduduk->pembuat)): ?>
                    <p class="kecil">
                        Terdaftar pada:
                        <i class="fa fa-clock-o"></i><?php echo e(tgl_indo2($penduduk->created_at)); ?>

                        <i class="fa fa-user"></i> <?php echo e($penduduk->pembuat->nama); ?>

                    </p>
                    <?php else: ?>
                    <p class="kecil">
                        Terdaftar sebelum:
                        <i class="fa fa-clock-o"></i><?php echo e(tgl_indo2($penduduk->created_at)); ?>

                    </p>
                    <?php endif; ?>
                    <?php if(!empty($penduduk->pengubah)): ?>
                    <p class="kecil">
                        Terakhir diubah:
                        <i class="fa fa-clock-o"></i><?php echo e(tgl_indo2($penduduk->updated_at)); ?>

                        <i class="fa fa-user"></i> <?php echo e($penduduk->pengubah->nama); ?>

                    </p>
                    <?php endif; ?>
                </div>
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover">
                            <tr>
                                <td colspan="3">
                                    <img class="penduduk" src="<?php echo e(AmbilFoto($penduduk->foto, '', $penduduk->sex)); ?>" alt="Foto Penduduk">
                                </td>
                            </tr>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover">
                                    <tbody>
                                        <tr>
                                            <td>Status Dasar</td>
                                            <td>:</td>
                                            <td><span class="<?php echo e($penduduk->status_dasar != App\Enums\StatusDasarEnum::HIDUP ? 'label label-danger' : ''); ?>"><strong><?php echo e(strtoupper(App\Enums\StatusDasarEnum::valueOf($penduduk->status_dasar))); ?></strong></span></td>
                                        </tr>
                                        <tr>
                                            <td width="300">Nama</td>
                                            <td width="1">:</td>
                                            <td><?php echo e(strtoupper($penduduk->nama)); ?></td>
                                        </tr>
                                        <tr>
                                            <td>Status Kepemilikan Identitas</td>
                                            <td>:</td>
                                            <td>
                                                <table class="table table-bordered table-striped table-hover detail">
                                                    <tr>
                                                        <th>Wajib Identitas</th>
                                                        <th>Identitas-EL</th>
                                                        <th>Status Rekam</th>
                                                        <th>Tag ID Card</th>
                                                    </tr>
                                                    <tr>
                                                        <td><?php echo e(strtoupper($penduduk->wajib_ktp)); ?></td>
                                                        <td><?php echo e(strtoupper(App\Enums\StatusRekamEnum::valueOf($penduduk->ktp_el))); ?></td>
                                                        <td><?php echo e(strtoupper(App\Enums\StatusKTPEnum::valueOf($penduduk->status_rekam))); ?></td>
                                                        <td><?php echo e($penduduk->tag_id_card); ?></td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Nomor Kartu Keluarga</td>
                                            <td>:</td>
                                            <td>
                                                <?php echo e($penduduk->keluarga->no_kk); ?>

                                                <?php if($penduduk->status_dasar != '1' && $penduduk->no_kk != $penduduk->log_no_kk): ?>
                                                    ( waktu peristiwa [<?php echo e($penduduk->status_dasar); ?>]: [<?php echo e($penduduk->log_no_kk); ?>] )
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Nomor KK Sebelumnya</td>
                                            <td>:</td>
                                            <td><?php echo e($penduduk->no_kk_sebelumnya); ?></td>
                                        </tr>
                                        <tr>
                                            <td>Hubungan Dalam Keluarga</td>
                                            <td>:</td>
                                            <td><?php echo e(App\Enums\SHDKEnum::valueOf($penduduk->kk_level)); ?></td>
                                        </tr>
                                        <tr>
                                            <td>Jenis Kelamin</td>
                                            <td>:</td>
                                            <td><?php echo e(strtoupper(App\Enums\JenisKelaminEnum::valueOf($penduduk->sex))); ?></td>
                                        </tr>
                                        <tr>
                                            <td>Agama</td>
                                            <td>:</td>
                                            <td><?php echo e(strtoupper($penduduk->agama)); ?></td>
                                        </tr>
                                        <tr>
                                            <td>Status Penduduk</td>
                                            <td>:</td>
                                            <td><?php echo e(strtoupper(App\Enums\StatusPendudukEnum::valueOf($penduduk->status))); ?></td>
                                        </tr>
                                        <tr>
                                            <th colspan="3" class="subtitle_head"><strong>DATA KELAHIRAN</strong></th>
                                        </tr>
                                        <tr>
                                            <td>Akta Kelahiran</td>
                                            <td>:</td>
                                            <td><?php echo e(strtoupper($penduduk->akta_lahir)); ?></td>
                                        </tr>
                                        <tr>
                                            <td>Tempat / Tanggal Lahir</td>
                                            <td>:</td>
                                            <td><?php echo e(strtoupper($penduduk->tempatlahir)); ?> / <?php echo e(strtoupper($penduduk->tanggallahir?->format('d-m-Y'))); ?></td>
                                        </tr>
                                        <tr>
                                            <td>Tempat Dilahirkan</td>
                                            <td>:</td>
                                            <td><?php echo e(strtoupper($penduduk->dilahirkan)); ?></td>
                                        </tr>
                                        <tr>
                                            <td>Jenis Kelahiran</td>
                                            <td>:</td>
                                            <td><?php echo e(strtoupper($penduduk->jenisLahir)); ?></td>
                                        </tr>
                                        <tr>
                                            <td>Kelahiran Anak Ke</td>
                                            <td>:</td>
                                            <td><?php echo e($penduduk->kelahiran_anak_ke); ?></td>
                                        </tr>
                                        <tr>
                                            <td>Penolong Kelahiran</td>
                                            <td>:</td>
                                            <td><?php echo e(strtoupper($penduduk->penolongLahir)); ?></td>
                                        </tr>
                                        <tr>
                                            <td>Berat Lahir</td>
                                            <td>:</td>
                                            <td><?php echo e($penduduk->berat_lahir); ?> Gram</td>
                                        </tr>
                                        <tr>
                                            <td>Panjang Lahir</td>
                                            <td>:</td>
                                            <td><?php echo e($penduduk->panjang_lahir); ?> cm</td>
                                        </tr>
                                        <tr>
                                            <th colspan="3" class="subtitle_head"><strong>DATA PENDIDIKAN DAN PEKERJAAN</strong></th>
                                        </tr>
                                        <tr>
                                            <td>Pendidikan dalam KK</td>
                                            <td>:</td>
                                            <td><?php echo e($penduduk->pendidikan_kk); ?></td>
                                        </tr>
                                        <tr>
                                            <td>Pendidikan sedang ditempuh</td>
                                            <td>:</td>
                                            <td><?php echo e(strtoupper($penduduk->pendidikan_sedang)); ?></td>
                                        </tr>
                                        <tr>
                                            <td>Pekerjaan</td>
                                            <td>:</td>
                                            <td><?php echo e(strtoupper($penduduk->pekerjaan)); ?></td>
                                        </tr>
                                        <tr>
                                            <td>Pekerja Migran</td>
                                            <td>:</td>
                                            <td><?php echo e(strtoupper($penduduk->pekerja_migran)); ?></td>
                                        </tr>
                                        <tr>
                                            <th colspan="3" class="subtitle_head"><strong>DATA KESUKUAN</strong></th>
                                        </tr>
                                        <tr>
                                            <td>Suku/Etnis</td>
                                            <td>:</td>
                                            <td><?php echo e(strtoupper($penduduk->suku)); ?></td>
                                        </tr>
                                        <tr>
                                            <td>Marga</td>
                                            <td>:</td>
                                            <td><?php echo e(strtoupper($penduduk->marga)); ?></td>
                                        </tr>
                                        <tr>
                                            <td>Adat</td>
                                            <td>:</td>
                                            <td><?php echo e(strtoupper($penduduk->adat)); ?></td>
                                        </tr>
                                        <tr>
                                            <th colspan="3" class="subtitle_head"><strong>DATA KEWARGANEGARAAN</strong></th>
                                        </tr>
                                        <tr>
                                            <td>Warga Negara</td>
                                            <td>:</td>
                                            <td><?php echo e(strtoupper($penduduk->warganegara)); ?></td>
                                        </tr>
                                        <tr>
                                            <td>Nomor Paspor</td>
                                            <td>:</td>
                                            <td><?php echo e(strtoupper($penduduk->dokumen_pasport)); ?></td>
                                        </tr>
                                        <tr>
                                            <td>Tanggal Berakhir Paspor</td>
                                            <td>:</td>
                                            <td><?php echo e(strtoupper(tgl_indo_out($penduduk->tanggal_akhir_paspor))); ?></td>
                                        </tr>
                                        <tr>
                                            <td>Nomor KITAS/KITAP</td>
                                            <td>:</td>
                                            <td><?php echo e(strtoupper($penduduk->dokumen_kitas)); ?></td>
                                        </tr>
                                        <tr>
                                            <th colspan="3" class="subtitle_head"><strong>ORANG TUA</strong></th>
                                        </tr>
                                        <tr>
                                            <td>NIK Ayah</td>
                                            <td>:</td>
                                            <td><?php echo e(strtoupper($penduduk->ayah_nik)); ?></td>
                                        </tr>
                                        <tr>
                                            <td>Nama Ayah</td>
                                            <td>:</td>
                                            <td><?php echo e(strtoupper($penduduk->nama_ayah)); ?></td>
                                        </tr>
                                        <tr>
                                            <td>NIK Ibu</td>
                                            <td>:</td>
                                            <td><?php echo e(strtoupper($penduduk->ibu_nik)); ?></td>
                                        </tr>
                                        <tr>
                                            <td>Nama Ibu</td>
                                            <td>:</td>
                                            <td><?php echo e(strtoupper($penduduk->nama_ibu)); ?></td>
                                        </tr>
                                        <tr>
                                            <th colspan="3" class="subtitle_head"><strong>ALAMAT</strong></th>
                                        </tr>
                                        <tr>
                                            <td>Alamat</td>
                                            <td>:</td>
                                            <td><?php echo e(strtoupper($penduduk->keluarga->alamat)); ?></td>
                                        </tr>
                                        <tr>
                                            <td>Dusun</td>
                                            <td>:</td>
                                            <td><?php echo e(strtoupper($penduduk->wilayah->dusun)); ?></td>
                                        </tr>
                                        <tr>
                                            <td>RT/ RW</td>
                                            <td>:</td>
                                            <td><?php echo e(strtoupper($penduduk->wilayah->rt)); ?> / <?php echo e($penduduk->wilayah->rw); ?></td>
                                        </tr>
                                        <tr>
                                            <td>Alamat Sebelumnya</td>
                                            <td>:</td>
                                            <td><?php echo e(strtoupper($penduduk->alamat_sebelumnya)); ?></td>
                                        </tr>
                                        <tr>
                                            <td>Nomor Telepon</td>
                                            <td>:</td>
                                            <td><?php echo e(strtoupper($penduduk->telepon)); ?></td>
                                        </tr>
                                        <tr>
                                            <td>Alamat Email</td>
                                            <td>:</td>
                                            <td><?php echo e(strtoupper($penduduk->email)); ?></td>
                                        </tr>
                                        <tr>
                                            <td>Telegram</td>
                                            <td>:</td>
                                            <td><?php echo e($penduduk->telegram); ?></td>
                                        </tr>
                                        <tr>
                                            <td>Cara Hubung Warga</td>
                                            <td>:</td>
                                            <td><?php echo e($penduduk->hubung_warga); ?></td>
                                        </tr>
                                        <tr>
                                            <th colspan="3" class="subtitle_head"><strong>DATA PERKAWINAN</strong></th>
                                        </tr>
                                        <tr>
                                            <td>Status Kawin</td>
                                            <td>:</td>
                                            <td><?php echo e(strtoupper($penduduk->statusPerkawinan)); ?></td>
                                        </tr>
                                        <?php if($penduduk->status_kawin != 1): ?>
                                            <tr>
                                                <td>Akta perkawinan</td>
                                                <td>:</td>
                                                <td><?php echo e(strtoupper($penduduk->akta_perkawinan)); ?></td>
                                            </tr>
                                            <tr>
                                                <td>Tanggal perkawinan</td>
                                                <td>:</td>
                                                <td><?php echo e(tgl_indo_out($penduduk->tanggalperkawinan)); ?></td>
                                            </tr>
                                        <?php endif; ?>
                                        <?php if($penduduk->status_kawin != 1 && $penduduk->status_kawin != 2): ?>
                                            <tr>
                                                <td>Akta perceraian</td>
                                                <td>:</td>
                                                <td><?php echo e(strtoupper($penduduk->akta_perceraian)); ?></td>
                                            </tr>
                                            <tr>
                                                <td>Tanggal perceraian</td>
                                                <td>:</td>
                                                <td><?php echo e(tgl_indo_out($penduduk->tanggalperceraian)); ?></td>
                                            </tr>
                                        <?php endif; ?>
                                        <tr>
                                            <th colspan="3" class="subtitle_head"><strong>DATA KESEHATAN</strong></th>
                                        </tr>
                                        <tr>
                                            <td>Golongan Darah</td>
                                            <td>:</td>
                                            <td><?php echo e($penduduk->golongan_darah ?? 'TIDAK TAHU'); ?></td>
                                        </tr>
                                        <tr>
                                            <td>Cacat</td>
                                            <td>:</td>
                                            <td><?php echo e($penduduk->cacat); ?></td>
                                        </tr>
                                        <tr>
                                            <td>Sakit Menahun</td>
                                            <td>:</td>
                                            <td><?php echo e(strtoupper($penduduk->sakit_menahun)); ?></td>
                                        </tr>
                                        <?php if($penduduk->status_kawin == App\Enums\StatusKawinEnum::KAWIN): ?>
                                            <tr>
                                                <td>Akseptor KB</td>
                                                <td>:</td>
                                                <td><?php echo e($penduduk->cara_kb); ?></td>
                                            </tr>
                                        <?php endif; ?>
                                        <?php if($penduduk->id_sex == App\Enums\JenisKelaminEnum::PEREMPUAN): ?>
                                            <tr>
                                                <td>Status Kehamilan</td>
                                                <td>:</td>
                                                <td><?php echo e(strtoupper(App\Enums\HamilEnum::valueOf($penduduk->hamil))); ?></td>
                                            </tr>
                                        <?php endif; ?>
                                        <tr>
                                            <td>Nama/Nomor Asuransi Kesehatan</td>
                                            <td>:</td>
                                            <td><?php echo e($penduduk->asuransi . ' / ' . strtoupper($penduduk->no_asuransi)); ?></td>
                                        </tr>
                                        <tr>
                                            <td>Nomor BPJS Ketenagakerjaan</td>
                                            <td>:</td>
                                            <td><?php echo e($penduduk->bpjs_ketenagakerjaan); ?></td>
                                        </tr>
                                        <tr>
                                            <td>Status Kepersertaan Asuransi Kesehatan</td>
                                            <td>:</td>
                                            <td><?php echo e(strtoupper(\App\Enums\AktifEnum::valueOf($penduduk->status_asuransi))); ?></td>
                                        </tr>

                                    <tr>
                                        <th colspan="3" class="subtitle_head"><strong>DATA LAINNYA</strong></th>
                                    </tr>
                                    <tr>
                                        <td>Bahasa</td>
                                        <td>:</td>
                                        <td><?php echo e($penduduk->bahasa); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Keterangan</td>
                                        <td>:</td>
                                        <td><?php echo e($penduduk->ket); ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover">
                                <tbody>
                                    <tr>
                                        <th colspan="3" class="subtitle_head"><strong>PROGRAM BANTUAN</strong></th>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="table-responsive">
                                                <table
                                                    class="table table-bordered dataTable table-striped table-hover tabel-daftar">
                                                    <thead class="bg-gray disabled color-palette">
                                                        <tr>
                                                            <th class="padat">No</th>
                                                            <th>Waktu / Tanggal</th>
                                                            <th>Nama Program</th>
                                                            <th>Keterangan</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $__currentLoopData = $program; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <tr>
                                                            <td class="text-center"><?php echo e($key + 1); ?></td>
                                                            <td><?php echo e(fTampilTgl($item->bantuanPenduduk->sdate,
                                                                $item->bantuanPenduduk->edate)); ?></td>
                                                            <td><a
                                                                    href="<?php echo e(ci_route('peserta_bantuan.data_peserta', [$item->id, $item->program_id])); ?>"><?php echo e($item->bantuanPenduduk->nama); ?></a></td>
                                                            <td><?php echo e($item->bantuanPenduduk->ndesc); ?></td>
                                                        </tr>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th colspan="3" class="subtitle_head"><strong>DOKUMEN / KELENGKAPAN
                                                PENDUDUK</strong></th>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="table-responsive">
                                                <table
                                                    class="table table-bordered dataTable table-striped table-hover tabel-daftar">
                                                    <thead class="bg-gray disabled color-palette">
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Aksi</th>
                                                            <th>Nama Dokumen</th>
                                                            <th>Tanggal Upload</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $__currentLoopData = $list_dokumen; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <tr>
                                                            <td class="padat"><?php echo e($key + 1); ?></td>
                                                            <td class="aksi">
                                                                <a href="<?php echo e(ci_route("penduduk.unduh_berkas.{$item->id}")); ?>" class="btn
                                                                    bg-purple btn-sm" title="Unduh Dokumen"><i
                                                                        class="fa fa-download"></i></a>
                                                                <a href="<?php echo e(ci_route("penduduk.unduh_berkas.{$item->id}.1")); ?>"
                                                                    class="btn bg-info btn-sm" title="Lihat Dokumen" target="_blank"><i
                                                                        class="fa fa-eye"></i></a>
                                                            </td>
                                                            <td><?php echo e($item->nama); ?></td>
                                                            <td><?php echo e(tgl_indo2($item->tgl_upload)); ?></td>
                                                        </tr>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\opensid\resources\views/admin/penduduk/detail.blade.php ENDPATH**/ ?>