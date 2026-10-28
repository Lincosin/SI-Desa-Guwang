<?php echo $__env->make('admin.layouts.components.asset_datatables', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('admin.layouts.components.datetime_picker', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->startSection('title'); ?>
    <h1>
        Data <?php echo e($module_name); ?>

    </h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="active">Data <?php echo e($module_name); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('admin.layouts.components.notifikasi', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="box box-info">
        <div class="box-header with-border">
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
            <?php endif; ?>
            <?php if (isset($component)) { $__componentOriginal27eceb85e0e48badafeabec05cfe7eea = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal27eceb85e0e48badafeabec05cfe7eea = $attributes; } ?>
<?php $component = App\View\Components\HapusButton::resolve(['url' => 'penduduk/delete_all','confirmDelete' => true,'selectData' => true,'judul' => 'Hapus Data Terpilih'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
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
                $listAksiLainnya = [];

                if ($disableFilter) {
                    $listAksiLainnya = [
                        [
                            'url' => '#',
                            'judul' => 'Pencarian Spesifik',
                            'icon' => 'fa fa-search',
                            'modal' => false,
                            'target' => false,
                            'can' => false
                        ],
                        [
                            'url' => '#',
                            'judul' => 'Pencarian Program Bantuan',
                            'icon' => 'fa fa-search',
                            'modal' => false,
                            'target' => false,
                            'can' => false
                        ],
                        [
                            'url' => '#',
                            'judul' => 'Pilihan Kumpulan NIK',
                            'icon' => 'fa fa-search',
                            'modal' => false,
                            'target' => false,
                            'can' => false
                        ],
                        [
                            'url' => '#',
                            'judul' => 'NIK Sementara',
                            'icon' => 'fa fa-search',
                            'modal' => false,
                            'target' => false,
                            'can' => false
                        ]
                    ];
                } else {
                    $listAksiLainnya = [
                        [
                            'url' => 'penduduk/ajax_adv_search',
                            'judul' => 'Pencarian Spesifik',
                            'icon' => 'fa fa-search',
                            'modal' => true,
                            'target' => '#modalBox'
                        ],
                        [
                            'url' => 'penduduk/program_bantuan',
                            'judul' => 'Pencarian Program Bantuan',
                            'icon' => 'fa fa-search',
                            'modal' => true,
                            'target' => '#modalBox'
                        ],
                        [
                            'url' => 'penduduk/search_kumpulan_nik',
                            'judul' => 'Pilihan Kumpulan NIK',
                            'icon' => 'fa fa-search',
                            'modal' => true,
                            'target' => '#modalBox'
                        ],
                        [
                            'url' => '#',
                            'judul' => 'NIK Sementara',
                            'icon' => 'fa fa-search',
                            'modal' => false,
                            'target' => false,
                            'data' => [
                                'onclick' => "$('#tabeldata').data('nik_sementara', 1); $('#tabeldata').data('kumpulanNIK', []);$('#tabeldata').data('bantuan', null);$('#tabeldata').DataTable().draw(); return false;"
                            ]
                        ]
                    ];
                }

                // Gabungkan dengan menu cetak/unduh untuk satu dropdown
                if (!empty($listAksiLainnya)) {
                    $listAksiLainnya = array_merge($listAksiLainnya, [
                        [
                            'url' => "{$controller}/ajax_cetak/cetak",
                            'judul' => 'Cetak',
                            'icon' => 'fa fa-print',
                            'modal' => true,
                            'target' => '#modalBox',
                            'data' => [
                                'id' => 'cetak_id'
                            ]
                        ],
                        [
                            'url' => "{$controller}/ajax_cetak/unduh",
                            'judul' => 'Unduh',
                            'icon' => 'fa fa-download',
                            'modal' => true,
                            'target' => '#modalBox',
                            'data' => [
                                'id' => 'unduh_id'
                            ]
                        ]
                    ]);
                }
            ?>

            <?php if(!empty($listAksiLainnya)): ?>
                <?php if (isset($component)) { $__componentOriginal8efe3807774add4f16598e058556e738 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8efe3807774add4f16598e058556e738 = $attributes; } ?>
<?php $component = App\View\Components\SplitButton::resolve(['judul' => 'Pilih Aksi Lainnya','list' => $listAksiLainnya,'icon' => 'fa fa-arrow-circle-down','type' => 'btn-info'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
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
            <?php endif; ?>

            <?php
                $listImporEkspor = [];
                
                if (ci_auth()->id_grup == $akses) {
                    $listImporEkspor[] = [
                        'url' => 'penduduk/impor',
                        'judul' => 'Impor Penduduk',
                        'icon' => 'fa fa-upload',
                        'modal' => false,
                        'target' => false
                    ];
                    
                    if (!setting('multi_desa')) {
                        $listImporEkspor[] = [
                            'url' => 'penduduk/impor_bip',
                            'judul' => 'Impor BIP',
                            'icon' => 'fa fa-upload',
                            'modal' => false,
                            'target' => false
                        ];
                    }
                }

                $listImporEkspor = array_merge($listImporEkspor, [
                    [
                        'url' => 'penduduk/ekspor',
                        'judul' => 'Ekspor Penduduk',
                        'icon' => 'fa fa-download',
                        'modal' => false,
                        'target' => true,
                        'data' => [
                            'class' => 'btn-ekspor'
                        ]
                    ],
                    [
                        'url' => 'penduduk/ekspor/1',
                        'judul' => 'Ekspor Penduduk Huruf',
                        'icon' => 'fa fa-download',
                        'modal' => false,
                        'target' => true,
                        'data' => [
                            'class' => 'btn-ekspor'
                        ]
                    ]
                ]);
            ?>

            <?php if (isset($component)) { $__componentOriginal8efe3807774add4f16598e058556e738 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8efe3807774add4f16598e058556e738 = $attributes; } ?>
<?php $component = App\View\Components\SplitButton::resolve(['judul' => 'Impor / Ekspor','list' => $listImporEkspor,'icon' => 'fa fa-arrow-circle-down','type' => 'bg-navy'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
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
            <?php if($disableFilter): ?>
                <?php if (isset($component)) { $__componentOriginal0fd673fce629071b3dc828d9abc34190 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal0fd673fce629071b3dc828d9abc34190 = $attributes; } ?>
<?php $component = App\View\Components\BtnButton::resolve(['url' => 'penduduk','judul' => 'Bersihkan','icon' => 'fa fa-refresh','type' => 'bg-purple'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
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
        </div>
        <div class="box-body">
            <div class="row mepet">
                <div class="col-sm-2">
                    <select class="form-control input-sm select2" id="status_penduduk" <?= ($disableFilter) ? 'disabled' : ''; ?>>
                        <option value="">Pilih Status Penduduk</option>
                        <?php $__currentLoopData = $list_status_penduduk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($key); ?>"><?php echo e($item); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="col-sm-2">
                    <select class="form-control input-sm  select2" id="status_dasar" <?= ($disableFilter) ? 'disabled' : ''; ?>>
                        <option value="">Pilih Status Dasar</option>
                        <?php $__currentLoopData = $list_status_dasar; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($key); ?>" <?= ($defaultStatusDasar == $key) ? 'selected' : ''; ?>><?php echo e(set_ucwords($item)); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="col-sm-2">
                    <select class="form-control input-sm select2" id="jenis_kelamin" <?= ($disableFilter) ? 'disabled' : ''; ?>>
                        <option value="">Pilih Jenis Kelamin</option>
                        <?php $__currentLoopData = $list_jenis_kelamin; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($key); ?>"><?php echo e(set_ucwords($item)); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <?php echo $__env->make('admin.layouts.components.wilayah', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
            <hr class="batas">
            <?php echo form_open(null, 'id="mainform" name="mainform"'); ?>

            <?php if($judul_statistik): ?>
                <h5 id="judul-statistik" class="box-title text-center"><b><?php echo e($judul_statistik); ?></b></h5>
            <?php endif; ?>
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="tabeldata" data-advancesearch='<?php echo json_encode($advanceSearch); ?>' data-statistikfilter='<?php echo json_encode($statistikFilter); ?>'>
                    <thead>
                        <tr>
                            <th nowrap><input type="checkbox" id="checkall"></th>
                            <th nowrap>NO</th>
                            <th nowrap>AKSI</th>
                            <th nowrap>FOTO</th>
                            <th nowrap>NIK</th>
                            <th nowrap>TAG ID CARD</th>
                            <th nowrap>NAMA</th>
                            <th nowrap>NO. KK</th>
                            <th nowrap>NAMA AYAH</th>
                            <th nowrap>NAMA IBU</th>
                            <th nowrap>NO. RUMAH TANGGA</th>
                            <th nowrap>JENIS KELAMIN</th>
                            <th nowrap>ALAMAT</th>
                            <th nowrap><?php echo e(strtoupper(setting('sebutan_dusun'))); ?></th>
                            <th nowrap>RW</th>
                            <th nowrap>RT</th>
                            <th nowrap>PENDIDIKAN DALAM KK</th>
                            <th nowrap>UMUR</th>
                            <th nowrap>PEKERJAAN</th>
                            <th nowrap>KAWIN</th>
                            <th nowrap>TGL PERISTIWA</th>
                            <th nowrap>TGL TERDAFTAR</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
            </form>
        </div>
    </div>

    <?php echo $__env->make('admin.layouts.components.konfirmasi_hapus', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('admin.layouts.components.konfirmasi', ['periksa_data' => true], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('css'); ?>
    <style>
        .select2-results__option[aria-disabled=true] {
            display: none;
        }
    </style>
<?php $__env->stopPush(); ?>
<?php $__env->startPush('scripts'); ?>
    <script>
        $(document).ready(function() {
            let filterColumn = <?php echo json_encode($filterColumn); ?>

            var TableData = $('#tabeldata').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: "<?php echo e(ci_route('penduduk.datatables')); ?>",
                    data: function(req) {
                        req.status_penduduk = $('#status_penduduk').val();
                        req.status_dasar = $('#status_dasar').val();
                        req.jenis_kelamin = $('#jenis_kelamin').val();
                        req.dusun = $('#dusun').val();
                        req.rw = $('#rw').val();
                        req.rt = $('#rt').val();
                        req.kumpulan_nik = $('#tabeldata').data('kumpulanNIK')
                        req.nik_sementara = $('#tabeldata').data('nik_sementara')
                        req.bantuan = $('#tabeldata').data('bantuan')
                        req.advancesearch = $('#tabeldata').data('advancesearch')
                        req.statistikfilter = $('#tabeldata').data('statistikfilter')
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
                        data: 'foto',
                        name: 'foto',
                        searchable: false,
                        orderable: false,
                        defaultContent: ''
                    },
                    {
                        data: 'nik',
                        name: 'nik',
                        render: function(item, data, row) {
                            return `<a href='<?php echo e(ci_route('penduduk.detail')); ?>/${row.id}'>${item}</a>`
                        },
                        searchable: true,
                        orderable: true,
                        defaultContent: ''
                    },
                    {
                        data: 'tag_id_card',
                        name: 'tag_id_card',
                        searchable: true,
                        orderable: false,
                        defaultContent: ''
                    },
                    {
                        data: 'nama',
                        name: 'nama',
                        searchable: true,
                        orderable: true,
                        defaultContent: ''
                    },
                    {
                        data: 'keluarga.no_kk',
                        name: 'keluarga.no_kk',
                        render: function(item, data, row) {
                            return !item ? '' : `<a href='<?php echo e(ci_route('keluarga.kartu_keluarga')); ?>/${row.id_kk}'>${item}</a>`
                        },
                        searchable: true,
                        orderable: true,
                    },
                    {
                        data: 'nama_ayah',
                        name: 'nama_ayah',
                        defaultContent: '',
                        searchable: false,
                        orderable: false
                    },
                    {
                        data: 'nama_ibu',
                        name: 'nama_ibu',
                        defaultContent: '',
                        searchable: false,
                        orderable: false
                    },
                    {
                        data: 'rtm.no_kk',
                        name: 'rtm.no_kk',
                        searchable: false,
                        orderable: false,
                        defaultContent: ''
                    },
                    {
                        data: 'jenis_kelamin',
                        name: 'jenis_kelamin',
                        searchable: false,
                        orderable: false,
                        defaultContent: '-',
                    },
                    {
                        data: 'alamat_wilayah',
                        name: 'alamat_wilayah',
                        searchable: false,
                        orderable: false,
                        defaultContent: '-',
                    },
                    {
                        data: 'wilayah.dusun',
                        name: 'dusun',
                        searchable: false,
                        orderable: false,
                        defaultContent: '-',
                    },
                    {
                        data: 'wilayah.rw',
                        name: 'tw',
                        searchable: false,
                        orderable: false,
                        defaultContent: '-',
                    },
                    {
                        data: 'wilayah.rt',
                        name: 'rt',
                        searchable: false,
                        orderable: false,
                        defaultContent: '-',
                    },
                    {
                        data: 'pendidikan_kk',
                        name: 'pendidikan_kk',
                        searchable: false,
                        orderable: false,
                        defaultContent: '-',
                    },
                    {
                        data: 'umur',
                        name: 'tanggallahir',
                        searchable: false,
                        orderable: true,
                        defaultContent: '-',
                    },
                    {
                        data: 'pekerjaan',
                        name: 'pekerjaan',
                        searchable: false,
                        orderable: false,
                        defaultContent: '-',
                    },
                    {
                        data: 'status_perkawinan',
                        name: 'status_perkawinan',
                        searchable: false,
                        orderable: false,
                        defaultContent: '-',
                    },
                    {
                        data: 'tgl_peristiwa',
                        name: 'log_latest.tgl_peristiwa',
                        searchable: false,
                        orderable: true
                    },
                    {
                        data: 'created_at',
                        name: 'created_at',
                        searchable: false,
                        orderable: true
                    },

                ],
                order: [
                    [4, 'asc']
                ],
                createdRow: function(row, data, dataIndex) {
                    if (data.valid_kk) {
                        $(row).addClass(data.valid_kk);
                    }
                },
            });

            if (hapus == 0) {
                TableData.column(0).visible(false);
            }

            let filterSelector = '#status_dasar, #status_penduduk, #jenis_kelamin, #dusun, #rw, #rt';

            // Saat user memilih dari Select2 hide judul statistik
            $(document).on('select2:select select2:clear', filterSelector, function (e) {
                $('#judul-statistik').hide();
                $('#tabeldata').data('statistikfilter', {});
                TableData.draw()
            });

            $(filterSelector).change(function() {
                TableData.draw()
            })

            if (filterColumn) {
                if (filterColumn['status_dasar'] > 0) {
                    $('#status_dasar').val(filterColumn['status_dasar'])
                    $('#status_dasar').trigger('change')
                }

                if (filterColumn['dusun']) {
                    $('#dusun').val(filterColumn['dusun'])
                    $('#dusun').trigger('change')

                    if (filterColumn['rw']) {
                        $('#rw').val(filterColumn['dusun'] + '__' + filterColumn['rw'])
                        $('#rw').trigger('change')
                    }

                    if (filterColumn['rt']) {
                        $('#rt').find('optgroup[value="' + filterColumn['dusun'] + '__' + filterColumn['rw'] + '"] option').filter(function() {
                            return $(this).text() == filterColumn['rt']
                        }).prop('selected', 1)
                        $('#rt').trigger('change')
                    }
                }

                if (filterColumn['sex']) {
                    $('#jenis_kelamin').val(filterColumn['sex'])
                    $('#jenis_kelamin').trigger('change')
                }
            }

            $('.btn-ekspor').click(function() {
                let _href = $(this).attr('href')
                let _newHref = _href + '?params=' + JSON.stringify($('#tabeldata').DataTable().ajax.params())
                location.href = _newHref
            })
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\opensid\resources\views/admin/penduduk/index.blade.php ENDPATH**/ ?>