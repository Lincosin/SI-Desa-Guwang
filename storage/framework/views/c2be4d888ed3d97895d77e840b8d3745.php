<div class="box box-info">
    <div class="box-header with-border">
        <?php if (isset($component)) { $__componentOriginal7a3eb12988970aebf81945dcf52d7c46 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7a3eb12988970aebf81945dcf52d7c46 = $attributes; } ?>
<?php $component = App\View\Components\TambahButton::resolve(['url' => $controller . '/form'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
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
<?php $component = App\View\Components\HapusButton::resolve(['url' => $controller . '/delete','confirmDelete' => true,'selectData' => true,'judul' => 'Hapus Data Terpilih'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
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
            $listBagan = [
                [
                    'url'   => "{$controller}/bagan",
                    'judul' => 'Bagan Tanpa BPD',
                    'icon'  => 'fa fa-sitemap',
                    'modal' => false
                ],
                [
                    'url'   => "{$controller}/bagan/bpd",
                    'judul' => 'Bagan Dengan BPD',
                    'icon'  => 'fa fa-sitemap',
                    'modal' => false
                ],
                [
                    'url'   => "{$controller}/atur_bagan",
                    'judul' => 'Atur Struktur Bagan',
                    'icon'  => 'fa fa-sitemap',
                    'modal' => true
                ]
            ];
        ?>

        <?php if (isset($component)) { $__componentOriginal8efe3807774add4f16598e058556e738 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8efe3807774add4f16598e058556e738 = $attributes; } ?>
<?php $component = App\View\Components\SplitButton::resolve(['judul' => 'Bagan Organisasi','list' => $listBagan,'icon' => 'fa fa-arrow-circle-down','type' => 'bg-olive'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
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

        <?php
            $listCetakUnduh = [
                [
                    'url'   => "{$controller}/dialog/cetak",
                    'judul' => 'Cetak',
                    'title' => 'Cetak Buku Pemerintah Desa',
                    'icon'  => 'fa fa-print',
                    'modal' => true
                ],
                [
                    'url'   => "{$controller}/dialog/unduh",
                    'judul' => 'Unduh',
                    'title' => 'Unduh Buku Pemerintah Desa',
                    'icon'  => 'fa fa-download',
                    'modal' => true
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

        <?php if (isset($component)) { $__componentOriginal0fd673fce629071b3dc828d9abc34190 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal0fd673fce629071b3dc828d9abc34190 = $attributes; } ?>
<?php $component = App\View\Components\BtnButton::resolve(['judul' => 'Jabatan','icon' => 'fa fa-list','type' => 'bg-navy','url' => $controller . '/jabatan'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
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

        <?php if(can('b', 'jam-kerja') || can('b', 'hari-libur') || can('b', 'rekapitulasi') || can('b', 'kehadiran-pengaduan')): ?>

            <?php
                $listKehadiran = [];

                if(can('b', 'jam-kerja'))
                {   
                    $listKehadiran[] = [
                        'url'   => "kehadiran_jam_kerja",
                        'judul' => 'Jam Kerja',
                        'icon'  => 'fa fa-clock-o',
                        'modal' => false
                    ];
                }

                if(can('b', 'hari-libur'))
                {   
                    $listKehadiran[] = [
                        'url'   => "kehadiran_hari_libur",
                        'judul' => 'Hari Libur',
                        'icon'  => 'fa fa-calendar',
                        'modal' => false
                    ];
                }

                if(can('b', 'rekapitulasi'))
                {   
                    $listKehadiran[] = [
                        'url'   => "kehadiran_rekapitulasi",
                        'judul' => 'Kehadiran',
                        'icon'  => 'fa fa-list',
                        'modal' => false
                    ];
                }

                if(can('b', 'kehadiran-pengaduan'))
                {   
                    $listKehadiran[] = [
                        'url'   => "kehadiran_pengaduan",
                        'judul' => 'Pengaduan',
                        'icon'  => 'fa fa-exclamation',
                        'modal' => false
                    ];
                }
            ?>

            <?php if (isset($component)) { $__componentOriginal8efe3807774add4f16598e058556e738 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8efe3807774add4f16598e058556e738 = $attributes; } ?>
<?php $component = App\View\Components\SplitButton::resolve(['judul' => 'Kehadiran','list' => $listKehadiran,'icon' => 'fa fa-arrow-circle-down','type' => 'bg-orange'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
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

    </div>
    <div class="box-body">
        <div class="row mepet">
            <div class="col-sm-2">
                <select id="status" class="form-control input-sm select2">
                    <option value="">Pilih Status</option>
                    <?php $__currentLoopData = $status; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option <?= ($default_status == $key) ? 'selected' : ''; ?> value="<?php echo e($key); ?>"><?php echo e($item); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="col-sm-3">
                <select id="kehadiran" class="form-control input-sm select2">
                    <option value="">Pilih Status Kehadiran</option>
                    <option value="1">Kehadiran Perangkat Aktif</option>
                    <option value="0">Kehadiran Perangkat Tidak Aktif</option>
                </select>
            </div>
        </div>
        <hr class="batas">
        <?php echo form_open(null, 'id="mainform" name="mainform"'); ?>

        <div class="table-responsive">
            <table class="table table-bordered table-hover" id="tabeldata">
                <thead>
                    <tr>
                        <th class="padat">#</th>
                        <th><input type="checkbox" id="checkall" /></th>
                        <th class="padat">NO</th>
                        <th class="padat">AKSI</th>
                        <th class="text-center">FOTO</th>
                        <th>NAMA, NIP/<?php echo e(setting('sebutan_nip_desa')); ?>, NIK, TAG ID CARD</th>
                        <th nowrap>TEMPAT, <p>TANGGAL LAHIR</p>
                        </th>
                        <th>JENIS KELAMIN</th>
                        <th>AGAMA</th>
                        <th>PANGKAT / GOLONGAN</th>
                        <th>JABATAN</th>
                        <th>PENDIDIKAN TERAKHIR</th>
                        <th>NOMOR KEPUTUSAN PENGANGKATAN</th>
                        <th>TANGGAL KEPUTUSAN PENGANGKATAN</th>
                        <th>NOMOR KEPUTUSAN PEMBERHENTIAN</th>
                        <th>TANGGAL KEPUTUSAN PEMBERHENTIAN</th>
                        <th>MASA/PERIODE JABATAN</th>
                    </tr>
                </thead>
                <tbody id="dragable">
                </tbody>
            </table>
        </div>
        </form>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
    <script>
        $(document).ready(function() {
            var TableData = $('#tabeldata').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: "<?php echo e(ci_route('pengurus.datatables')); ?>",
                    data: function(req) {
                        req.status = $('#status').val();
                        req.kehadiran = $('#kehadiran').val();
                    }
                },
                columns: [{
                        data: 'drag-handle',
                        class: 'padat',
                        searchable: false,
                        orderable: false
                    },
                    {
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
                        orderable: false
                    },
                    {
                        data: 'identitas',
                        name: 'identitas',
                        searchable: true,
                        orderable: false,
                        class: 'nowrap-left'
                    },
                    {
                        data: 'ttl',
                        name: 'ttl',
                        searchable: false,
                        orderable: false
                    },
                    {
                        data: 'pamong_sex',
                        name: 'sex',
                        searchable: false,
                        orderable: false
                    },
                    {
                        data: 'agama',
                        name: 'agama',
                        searchable: false,
                        orderable: false
                    },
                    {
                        data: 'pamong_pangkat',
                        name: 'pamong_pangkat',
                        searchable: false,
                        orderable: false
                    },
                    {
                        data: 'jabatan.nama',
                        name: 'jabatan.nama',
                        searchable: false,
                        orderable: false
                    },
                    {
                        data: 'pendidikan_kk',
                        name: 'pendidikan_kk',
                        searchable: false,
                        orderable: false
                    },
                    {
                        data: 'pamong_nosk',
                        name: 'pamong_nosk',
                        searchable: true,
                        orderable: true
                    },
                    {
                        data: 'pamong_tglsk',
                        name: 'pamong_tglsk',
                        searchable: true,
                        orderable: true
                    },
                    {
                        data: 'pamong_nohenti',
                        name: 'pamong_nohenti',
                        searchable: true,
                        orderable: true
                    },
                    {
                        data: 'pamong_tglhenti',
                        name: 'pamong_tglhenti',
                        searchable: true,
                        orderable: true
                    },
                    {
                        data: 'pamong_masajab',
                        name: 'pamong_masajab',
                        searchable: true,
                        orderable: true
                    },
                ],
                order: [],
                createdRow: function(row, data, dataIndex) {
                    $(row).attr('data-id', data.pamong_id)
                    $(row).addClass('dragable-handle');
                    var jabatan = <?php echo json_encode($jabatanKadesSekdes, 15, 512) ?>;
                    if (data.jabatan_id == jabatan['0'] || data.jabatan_id == jabatan['1']) {
                        $(row).addClass('select-row');
                    }
                },
            });

            $('#status, #kehadiran').change(function() {
                TableData.draw()
            })

            if (hapus == 0) {
                TableData.column(1).visible(false);
            }

            if (ubah == 0) {
                TableData.column(0).visible(false);
                TableData.column(3).visible(false);
            }

            // harus diletakkan didalam blok ini, jika tidak maka object TableData tidak dikenal
            <?php echo $__env->make('admin.layouts.components.draggable', ['urlDraggable' => ci_route('pengurus.tukar')], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        });
    </script>
<?php $__env->stopPush(); ?>
<?php /**PATH C:\xampp\htdocs\opensid\resources\views/admin/pengurus/index.blade.php ENDPATH**/ ?>