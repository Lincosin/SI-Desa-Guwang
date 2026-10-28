<div class="box box-info">
    <div class="box-header with-border">
        <?php if (isset($component)) { $__componentOriginal7a3eb12988970aebf81945dcf52d7c46 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7a3eb12988970aebf81945dcf52d7c46 = $attributes; } ?>
<?php $component = App\View\Components\TambahButton::resolve(['url' => $controller . '/form/' . $kat] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('tambah-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\TambahButton::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal7a3eb12988970aebf81945dcf52d7c46)): ?>
<?php $attributes = $__attributesOriginal7a3eb12988970aebf81945dcf52d7c46; ?>
<?php unset($__attributesOriginal7a3eb12988970aebf81945dcf52d7c46); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal7a3eb12988970aebf81945dcf52d7c46)): ?>
<?php $component = $__componentOriginal7a3eb12988970aebf81945dcf52d7c46; ?>
<?php unset($__componentOriginal7a3eb12988970aebf81945dcf52d7c46); ?>
<?php endif; ?>
        <?php if (isset($component)) { $__componentOriginal27eceb85e0e48badafeabec05cfe7eea = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal27eceb85e0e48badafeabec05cfe7eea = $attributes; } ?>
<?php $component = App\View\Components\HapusButton::resolve(['confirmDelete' => 'true','selectData' => 'true','url' => 'dokumen_sekretariat/delete_all/'.$kat] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('hapus-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\HapusButton::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal27eceb85e0e48badafeabec05cfe7eea)): ?>
<?php $attributes = $__attributesOriginal27eceb85e0e48badafeabec05cfe7eea; ?>
<?php unset($__attributesOriginal27eceb85e0e48badafeabec05cfe7eea); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal27eceb85e0e48badafeabec05cfe7eea)): ?>
<?php $component = $__componentOriginal27eceb85e0e48badafeabec05cfe7eea; ?>
<?php unset($__componentOriginal27eceb85e0e48badafeabec05cfe7eea); ?>
<?php endif; ?>
        <?php
            $listCetakUnduh = [
                [
                    'url' => "{$controller}/dialog_cetak/{$kat}/cetak",
                    'judul' => 'Cetak',
                    'icon' => 'fa fa-print',
                    'modal' => true,
                ],
                [
                    'url' => "{$controller}/dialog_cetak/{$kat}/unduh",
                    'judul' => 'Unduh',
                    'icon' => 'fa fa-download',
                    'modal' => true,
                ]
            ];
        ?>

        <?php if (isset($component)) { $__componentOriginal8efe3807774add4f16598e058556e738 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8efe3807774add4f16598e058556e738 = $attributes; } ?>
<?php $component = App\View\Components\SplitButton::resolve(['judul' => 'Cetak/Unduh','list' => $listCetakUnduh,'icon' => 'fa fa-arrow-circle-down','type' => 'bg-purple'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('split-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\SplitButton::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['target' => true]); ?>
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
    <div class="box-body">
        <form id="mainform" name="mainform" method="post">
            <input name="kategori" id="kategori" type="hidden" value="<?php echo e($kat); ?>">
            <div class="row mepet">
                <div class="col-sm-2">
                    <select class="form-control input-sm select2" name="filter" id="filter">
                        <option value="">Pilih Status</option>
                        <option value="1" <?= ($active == 1) ? 'selected' : ''; ?>>Berlaku</option>
                        <option value="2" <?= ($active == 2) ? 'selected' : ''; ?>>Dicabut/Tidak Berlaku</option>
                    </select>
                </div>
                <?php if($kat == 3): ?>
                    <div class="col-sm-3">
                        <select class="form-control input-sm select2" name="jenis_peraturan" id="jenis_peraturan">
                            <option value="">Pilih Jenis Peraturan</option>
                            <?php $__currentLoopData = $jenis_peraturan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $jenis): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($jenis); ?>">
                                    <?php echo e($jenis); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                <?php endif; ?>
                <div class="col-sm-2">
                    <select class="form-control input-sm select2 " name="tahun" id="tahun">
                        <option value="">Pilih Tahun</option>
                        <?php $__currentLoopData = $list_tahun; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $thn): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($thn['tahun']); ?>" <?= ($tahun == $thn['tahun']) ? 'selected' : ''; ?>>
                                <?php echo e($thn['tahun']); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>
            <hr class="batas">
            <div class="row">
                <div class="col-sm-12">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="tabeldata">
                            <thead class="bg-gray color-palette">
                                <tr>
                                    <th><input type="checkbox" id="checkall" /></th>
                                    <th>No</th>
                                    <th>Aksi</th>
                                    <th>Judul</th>
                                    <?php if($kat == 1): ?>
                                        <th>Kategori Info Publik</th>
                                        <th>Tahun</th>
                                    <?php elseif($kat == 2): ?>
                                        <th nowrap>No./Tgl Keputusan</th>
                                        <th nowrap>Uraian Singkat</th>
                                    <?php elseif($kat == 3): ?>
                                        <th>Jenis Peraturan</th>
                                        <th>No./Tgl Ditetapkan</th>
                                        <th>Uraian Singkat</th>
                                    <?php endif; ?>
                                    <th nowrap>Aktif</th>
                                    <th nowrap>Dimuat Pada</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<?php $__env->startPush('scripts'); ?>
    <script>
        $(document).ready(function() {
            var kategori = $('#kategori').val();
            var TableData = $('#tabeldata').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: "<?php echo e(route('buku-umum.dokumen_sekretariat.datatables')); ?>",
                    data: function(req) {
                        req.kategori = kategori;
                        req.tahun = $('#tahun').val();
                    }
                },
                columns: [{
                        data: 'ceklist',
                        class: 'padat',
                        searchable: false,
                        orderable: false
                    },
                    {
                        data: 'DT_RowIndex',
                        class: 'padat',
                        searchable: false,
                        orderable: false
                    },
                    {
                        data: 'aksi',
                        class: 'aksi',
                        searchable: false,
                        orderable: false
                    },
                    {
                        data: 'nama',
                        name: 'nama',
                        searchable: true,
                        orderable: true,
                    },
                    <?php if($kat == 1): ?>
                        {
                            data: 'additional.kategori_info_publik',
                            name: 'kategori_info_publik',
                            searchable: true,
                            orderable: false,
                        }, {
                            data: 'additional.tahun',
                            name: 'tahun',
                            searchable: true,
                            orderable: false,
                        },
                    <?php elseif($kat == 2): ?> {
                            data: 'additional.tgl_keputusan',
                            name: 'attr->tgl_kep_kades',
                            searchable: true,
                            orderable: true,
                        }, {
                            data: 'additional.uraian_singkat',
                            name: 'attr',
                            searchable: true,
                            orderable: false,
                        },
                    <?php elseif($kat == 3): ?> {
                            data: 'additional.jenis_peraturan',
                            name: 'attr',
                            searchable: true,
                            orderable: false,
                        }, {
                            data: 'additional.tgl_ditetapkan',
                            name: 'attr->tgl_ditetapkan',
                            searchable: true,
                            orderable: true,
                        }, {
                            data: 'additional.uraian_singkat',
                            name: 'attr',
                            searchable: true,
                            orderable: false,
                        },
                    <?php endif; ?> {
                        data: 'enabled',
                        name: 'enabled',
                        searchable: true,
                        orderable: true
                    },
                    {
                        data: 'tgl_upload',
                        name: 'tgl_upload',
                        searchable: true,
                        orderable: true
                    }
                ],
                order: [
                    <?php switch($kat):
                        case (2): ?>[4, 'asc']
                        <?php break; ?>

                        <?php case (3): ?>[5, 'asc']
                        <?php break; ?>
                    <?php endswitch; ?>
                ],
            });

            // buat kondisi sesuai kategori untuk data nomor column\
            // default colfilter dan tahun set ke kategori 1 / 2
            var colFilter = 6;
            var colTahun = 4;

            if (kategori == 3 || kategori == 2) {
                if (kategori == 3) {
                    colFilter = 7;
                }
                colTahun = 5;
            }

            $('#filter').change(function() {
                if ($(this).attr("data-reset")) {
                    return;
                }

                TableData.column(colFilter).search($(this).val()).draw()
            })

            $('#tahun').change(function() {
                if ($(this).attr("data-reset")) {
                    return;
                }

                if (kategori == 2 || kategori == 3) {
                    // Untuk SK Kades dan Perdes, filter di server-side
                    TableData.draw()
                } else {
                    // Untuk kategori lain, filter di client-side
                    TableData.column(colTahun).search($(this).val()).draw()
                }
            })

            $('#jenis_peraturan').change(function() {
                if ($(this).attr("data-reset")) {
                    return;
                }

                TableData.column(4).search($(this).val()).draw()
            })

            if (hapus == 0) {
                TableData.column(0).visible(false);
            }

            if (ubah == 0) {
                TableData.column(2).visible(false);
            }
            <?php if($active): ?>
                $('#filter').trigger('change')
            <?php endif; ?>
        });
    </script>
<?php $__env->stopPush(); ?>
<?php /**PATH C:\xampp\htdocs\opensid\resources\views/admin/dokumen/buku_kades/table_buku_umum.blade.php ENDPATH**/ ?>