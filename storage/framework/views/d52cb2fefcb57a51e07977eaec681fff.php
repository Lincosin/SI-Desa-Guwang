<?php echo $__env->make('admin.layouts.components.asset_datatables', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('admin.layouts.components.datetime_picker', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->startSection('title'); ?>
    <h1>
        <?php echo e($module_name); ?>

    </h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="active"><?php echo e($module_name); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('admin.layouts.components.notifikasi', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="box box-info">
        <div class="box-header with-border">
            <?php if(can('u')): ?>
                <?php
                    $listTambahKK = [
                        [
                            'url' => 'keluarga/form',
                            'judul' => 'Tambah Penduduk Masuk',
                            'icon' => 'fa fa-plus',
                            'modal' => false,
                            'target' => false
                        ],
                        [
                            'url' => 'keluarga/add_exist/0',
                            'judul' => 'Dari Penduduk Sudah Ada',
                            'icon' => 'fa fa-plus',
                            'modal' => true,
                            'target' => '#modalBox'
                        ]
                    ];
                ?>
                
                <?php if (isset($component)) { $__componentOriginal8efe3807774add4f16598e058556e738 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8efe3807774add4f16598e058556e738 = $attributes; } ?>
<?php $component = App\View\Components\SplitButton::resolve(['judul' => 'Tambah KK Baru','list' => $listTambahKK,'icon' => 'fa fa-plus','type' => 'btn-success'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
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
            
            <?php
                $listAksiDataTerpilih = [
                    [
                        'url' => '#',
                        'judul' => 'Cetak Kartu Keluarga',
                        'icon' => 'fa fa-print',
                        'modal' => false,
                        'target' => false,
                        'data' => [
                            'onclick' => "formAction('mainform','" . ci_route('keluarga.cetak_kk') . "', '_blank'); return false;",
                            'class' => 'aksi-terpilih'
                        ]
                    ],
                    [
                        'url' => '#',
                        'judul' => 'Unduh Kartu Keluarga',
                        'icon' => 'fa fa-download',
                        'modal' => false,
                        'target' => false,
                        'data' => [
                            'onclick' => "formAction('mainform','" . ci_route('keluarga.doc_kk') . "'); return false;",
                            'class' => 'aksi-terpilih'
                        ]
                    ]
                ];
                
                if (can('u')) {
                    $listAksiDataTerpilih[] = [
                        'url' => 'keluarga/tambah_rtm_all',
                        'judul' => 'Tambah Rumah Tangga Kolektif',
                        'icon' => 'fa fa-random',
                        'modal' => true,
                        'target' => '#tambah-rtm', // id modal konfirmasi
                        'data' => [
                            'class' => 'aksi-tambah-rtm aksi-terpilih', // tambahkan class unik untuk event handler
                            'data-url' => ci_route('keluarga.tambah_rtm_all'), // simpan URL target di data attribute
                            'data-form' => 'mainform', // simpan form yang akan diproses
                        ]
                    ];


                    $listAksiDataTerpilih[] = [
                        'url' => 'keluarga/pindah_kolektif',
                        'judul' => 'Pindah Wilayah Kolektif',
                        'icon' => 'fa fa-random',
                        'modal' => true,
                        'target' => '#modalBox',
                        'data' => [
                            'id' => 'pindah_kolektif',
                            'class' => 'aksi-terpilih'
                        ]
                    ];
                }
                
                if (can('h') && !data_lengkap()) {
                    $listAksiDataTerpilih[] = [
                        'url' => '#',
                        'judul' => 'Hapus Data Terpilih',
                        'icon' => 'fa fa-trash-o',
                        'modal' => false,
                        'target' => false,
                        'data' => [
                            'onclick' => "deleteAllBox('mainform', '" . ci_route('keluarga.delete_all') . "')",
                            'class' => 'hapus-terpilih'
                        ]
                    ];
                }
            ?>

            <?php if (isset($component)) { $__componentOriginal8efe3807774add4f16598e058556e738 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8efe3807774add4f16598e058556e738 = $attributes; } ?>
<?php $component = App\View\Components\SplitButton::resolve(['judul' => 'Aksi Data Terpilih','list' => $listAksiDataTerpilih,'icon' => 'fa fa-arrow-circle-down','type' => 'bg-maroon'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
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
            <?php
                $listAksiLainnya = [];

                if ($disableFilter) {
                    $listAksiLainnya = [
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
                            'judul' => 'Pilihan Kumpulan KK',
                            'icon' => 'fa fa-search',
                            'modal' => false,
                            'target' => false,
                            'can' => false
                        ],
                        [
                            'url' => '#',
                            'judul' => 'No KK Sementara',
                            'icon' => 'fa fa-search',
                            'modal' => false,
                            'target' => false,
                            'can' => false
                        ]
                    ];
                } else {
                    $listAksiLainnya = [
                        [
                            'url' => 'keluarga/program_bantuan',
                            'judul' => 'Pencarian Program Bantuan',
                            'icon' => 'fa fa-search',
                            'modal' => true,
                            'target' => '#modalBox'
                        ],
                        [
                            'url' => 'keluarga/search_kumpulan_kk',
                            'judul' => 'Pilihan Kumpulan KK',
                            'icon' => 'fa fa-search',
                            'modal' => true,
                            'target' => '#modalBox',
                            'data' => [
                                'onclick' => "$('#status').val('');$('#tabeldata').data('kk_sementara', null);$('#tabeldata').data('bantuan', null)"
                            ]
                        ],
                        [
                            'url' => '#',
                            'judul' => 'No KK Sementara',
                            'icon' => 'fa fa-search',
                            'modal' => false,
                            'target' => false,
                            'data' => [
                                'onclick' => "$('#tabeldata').data('kk_sementara', 1);$('#tabeldata').data('kumpulanKK', []);$('#tabeldata').data('bantuan', null);$('#tabeldata').DataTable().draw();return false;"
                            ]
                        ]
                    ];
                }
                
                // Gabungkan dengan menu cetak/unduh untuk satu dropdown
                if (!empty($listAksiLainnya)) {
                    $listAksiLainnya = array_merge($listAksiLainnya, [
                        [
                            'url' => 'keluarga/ajax_cetak/cetak',
                            'judul' => 'Cetak',
                            'icon' => 'fa fa-print',
                            'modal' => true,
                            'target' => '#modalBox',
                            'data' => [
                                'id' => 'cetak_id'
                            ]
                        ],
                        [
                            'url' => 'keluarga/ajax_cetak/unduh',
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
            
        </div>
        <div class="box-body">
            <div class="row mepet">
                <div class="col-sm-2">
                    <select id="status" class="form-control input-sm select2" <?= ($disableFilter) ? 'disabled' : ''; ?>>
                        <option value="">Pilih Status</option>
                        <?php $__currentLoopData = $status; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option <?= ($key == $defaultStatus) ? 'selected' : ''; ?> value="<?php echo e($key); ?>"><?php echo e($item); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="col-sm-2">
                    <select id="jenis_kelamin" class="form-control input-sm select2" <?= ($disableFilter) ? 'disabled' : ''; ?>>
                        <option value="">Pilih Jenis Kelamin</option>
                        <?php $__currentLoopData = $jenis_kelamin; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($key); ?>"><?php echo e($item); ?></option>
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
                <table class="table table-bordered table-hover tabel-daftar" id="tabeldata" data-statistikfilter='<?php echo json_encode($statistikFilter); ?>'>
                    <thead>
                        <tr>
                            <th nowrap><input type="checkbox" id="checkall"></th>
                            <th nowrap>NO</th>
                            <th nowrap>AKSI</th>
                            <th nowrap>FOTO</th>
                            <th nowrap>NOMOR KK</th>
                            <th nowrap>KEPALA KELUARGA</th>
                            <th nowrap>NIK</th>
                            <th nowrap>TAG ID CARD</th>
                            <th nowrap>JUMLAH ANGGOTA</th>
                            <th nowrap>JENIS KELAMIN</th>
                            <th nowrap>ALAMAT</th>
                            <th nowrap><?php echo e(strtoupper(setting('sebutan_dusun'))); ?></th>
                            <th nowrap>RW</th>
                            <th nowrap>RT</th>
                            <th nowrap>TANGGAL TERDAFTAR</th>
                            <th nowrap>TANGGAL CETAK KK</th>
                        </tr>
                    </thead>
                </table>
            </div>
            </form>
        </div>
    </div>

    <?php echo $__env->make('admin.layouts.components.konfirmasi_hapus', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('admin.layouts.components.konfirmasi_tambah', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
            var urlParams = new URLSearchParams(window.location.search);
            let kumpulanKK = urlParams.getAll('kumpulanKK');

            let filterColumn = <?php echo json_encode($filterColumn); ?>

            var TableData = $('#tabeldata').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: "<?php echo e(ci_route('keluarga.datatables')); ?>",
                    data: function(req) {
                        req.status = $('#status').val();
                        req.jenis_kelamin = $('#jenis_kelamin').val();
                        req.dusun = $('#dusun').val();
                        req.rw = $('#rw').val();
                        req.rt = $('#rt').val();
                        req.kumpulanKK = $('#tabeldata').data('kumpulanKK') ?? kumpulanKK
                        req.kk_sementara = $('#tabeldata').data('kk_sementara')
                        req.bantuan = $('#tabeldata').data('bantuan')
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
                        data: 'no_kk',
                        name: 'no_kk',
                        render: function(item, data, row) {
                            return !item ? '' :
                                `<a href='<?php echo e(ci_route('keluarga.kartu_keluarga')); ?>/${row.id}'>${item}</a>`
                        },
                        searchable: true,
                        orderable: true,
                    },
                    {
                        data: 'kepala_keluarga.nama',
                        name: 'kepala_keluarga.nama',
                        defaultContent: '',
                        searchable: true,
                        orderable: true
                    },
                    {
                        data: 'kepala_keluarga.nik',
                        name: 'kepalaKeluarga.nik',
                        defaultContent: '',
                        render: function(item, data, row) {
                            return !item ? '' :
                                `<a href='<?php echo e(ci_route('penduduk.detail')); ?>/${row.nik_kepala}'>${item}</a>`
                        },
                        searchable: true,
                        orderable: false
                    },
                    {
                        data: 'kepala_keluarga.tag_id_card',
                        name: 'kepalaKeluarga.tag_id_card',
                        defaultContent: '',
                        searchable: false,
                        orderable: false
                    },
                    {
                        data: 'anggota_count',
                        name: 'anggota_count',
                        className: 'text-center',
                        searchable: false,
                        orderable: true
                    },
                    {
                        data: 'jenis_kelamin',
                        name: 'kepalaKeluarga.sex',
                        searchable: true,
                        orderable: false
                    },
                    {
                        data: 'kepala_keluarga.alamat_wilayah',
                        name: 'alamat_wilayah',
                        searchable: false,
                        orderable: false,
                        defaultContent: '-',
                    },
                    {
                        data: 'kepala_keluarga.keluarga.wilayah.dusun',
                        name: 'dusun',
                        searchable: false,
                        orderable: false,
                        defaultContent: '-',
                    },
                    {
                        data: 'kepala_keluarga.keluarga.wilayah.rw',
                        name: 'rw',
                        searchable: false,
                        orderable: false,
                        defaultContent: '-',
                    },
                    {
                        data: 'kepala_keluarga.keluarga.wilayah.rt',
                        name: 'rt',
                        searchable: false,
                        orderable: false,
                        defaultContent: '-',
                    },
                    {
                        data: 'tgl_daftar',
                        name: 'tgl_daftar',
                        searchable: false,
                        orderable: true
                    },
                    {
                        data: 'tgl_cetak_kk',
                        name: 'tgl_cetak_kk',
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

            let filterSelector = '#status, #jenis_kelamin, #dusun, #rw, #rt';

            // Saat user memilih dari Select2 hide judul statistik
            $(document).on('select2:select select2:clear', filterSelector, function (e) {
                $('#judul-statistik').hide();
            });

            $(filterSelector).change(function() {
                TableData.draw()
            })

            if (filterColumn) {
                if (filterColumn['status'] > 0) {
                    $('#status').val(filterColumn['status'])
                    $('#status').trigger('change')
                }

                if (filterColumn['dusun']) {
                    $('#dusun').val(filterColumn['dusun'])
                    $('#dusun').trigger('change')

                    if (filterColumn['rw']) {
                        $('#rw').val(filterColumn['dusun'] + '__' + filterColumn['rw'])
                        $('#rw').trigger('change')
                    }

                    if (filterColumn['rt']) {
                        $('#rt').find('optgroup[value="' + filterColumn['dusun'] + '__' + filterColumn['rw'] +
                            '"] option').filter(function() {
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

            // Initialize disabled state for action buttons
            enableHapusTerpilih();

            // Handle checkbox changes to enable/disable action buttons
            $('#tabeldata').on('change', 'input[name="id_cb[]"]', function() {
                enableHapusTerpilih();
            });

            // Handle "select all" checkbox
            $('#checkall').on('change', function() {
                enableHapusTerpilih();
            });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\opensid\resources\views/admin/penduduk/keluarga/index.blade.php ENDPATH**/ ?>