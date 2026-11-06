<?php echo $__env->make('admin.layouts.components.asset_datatables', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>



<?php $__env->startSection('title'); ?>
    <h1>
        Daftar Persil
    </h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="active">Daftar Persil</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('admin.layouts.components.notifikasi', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="box box-info">
        <div class="box-header with-border">
            <?php if (isset($component)) { $__componentOriginal7a3eb12988970aebf81945dcf52d7c46 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7a3eb12988970aebf81945dcf52d7c46 = $attributes; } ?>
<?php $component = App\View\Components\TambahButton::resolve(['url' => 'data_persil/form'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
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
            <?php
                $listCetakUnduh = [
                    [
                        'url' => "data_persil/dialog/cetak",
                        'judul' => 'Cetak',
                        'icon' => 'fa fa-print',
                        'modal' => true,
                    ],
                    [
                        'url' => "data_persil/dialog/unduh",
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
            <?php echo form_open(null, 'id="mainform" name="mainform"'); ?>

            <div class="row mepet">
                <div class="col-sm-2">
                    <select class="form-control input-sm select2" name="tipe">
                        <option value="">Tipe Tanah</option>
                        <option value="BASAH">Tanah Basah</option>
                        <option value="KERING">Tanah Kering</option>
                    </select>
                </div>
                <div class="col-sm-2">
                    <select class="form-control input-sm select2" name="kelas">
                        <option value="">Kelas Tanah</option>
                        <?php $__currentLoopData = $list_kelas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $groups): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <optgroup value="<?php echo e($key); ?>" label="<?php echo e($key); ?>">
                                <?php $__currentLoopData = $groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($data->refKelas->id); ?>"><?php echo e($data->refKelas->kode); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </optgroup>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="col-sm-2">
                    <select class="form-control input-sm select2" name="lokasi">
                        <option value="">Tipe Lokasi</option>
                        <option value="1">Dalam Desa</option>
                        <option value="2">Luar Desa</option>
                    </select>
                </div>
                <?php echo $__env->make('admin.layouts.components.wilayah', ['colDusun' => 'col-sm-3'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
            <hr class="batas">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="tabeldata">
                    <thead>
                        <tr class="bg-gray judul-besar">
                            <th>No</th>
                            <th>Aksi</th>
                            <th>No. Persil : No. Urut Bidang</th>
                            <th>Tipe</th>
                            <th>Kelas Tanah</th>
                            <th>Luas (M2)</th>
                            <th>Lokasi</th>
                            <th>C-Desa Awal</th>
                            <th>Jml Mutasi</th>
                        </tr>
                    </thead>
                </table>
            </div>
            </form>
        </div>
    </div>

    <?php echo $__env->make('admin.layouts.components.konfirmasi_hapus', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
    <script>
        $(document).ready(function() {
            var TableData = $('#tabeldata').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: "<?php echo e(ci_route('data_persil.datatables')); ?>",
                    data: function(req) {
                        req.tipe = $('select[name="tipe"]').val()
                        req.kelas = $('select[name="kelas"]').val()
                        req.lokasi = $('select[name=lokasi]').val()
                        req.dusun = $('#dusun').val()
                        req.rw = $('#rw').val()
                        req.rt = $('#rt').val()
                    }
                },
                columns: [{
                        data: 'DT_RowIndex',
                        class: 'padat',
                        searchable: false,
                        orderable: false,
                        className: 'padat'
                    },
                    {
                        data: 'aksi',
                        class: 'aksi',
                        searchable: false,
                        orderable: false,
                        className: 'aksi'
                    },
                    {
                        data: 'nomor',
                        name: 'nomor',
                        searchable: true,
                        orderable: false
                    },
                    {
                        data: 'ref_kelas.tipe',
                        name: 'refKelas.tipe',
                        searchable: true,
                        orderable: false,
                        visible: false,
                    },
                    {
                        data: 'kelas',
                        name: 'kelas',
                        searchable: true,
                        orderable: false
                    },
                    {
                        data: 'luas_persil',
                        name: 'luas_persil',
                        searchable: false,
                        orderable: false
                    },
                    {
                        data: 'lokasi',
                        name: 'lokasi',
                        searchable: false,
                        orderable: false,
                    },
                    {
                        data: 'cdesa_awal',
                        name: 'cdesa_awal',
                        searchable: false,
                        orderable: false,
                    },
                    {
                        data: 'mutasi_count',
                        name: 'mutasi_count',
                        searchable: false,
                        orderable: true,
                        className: 'padat'
                    },
                ],
                order: [],
                aaSorting: []
            });

            $('select[name=tipe]').change(function() {
                let _val = $(this).val()
                $('select[name=kelas]').find('optgroup').prop('disabled', 1)
                $('select[name=kelas]').find(`optgroup[label="${_val}"]`).prop('disabled', 0)
                TableData.draw();
            })
            $('select[name=kelas]').change(function() {
                TableData.draw();
            })
            $('select[name=lokasi]').change(function() {
                if ($(this).val() == 1) {
                    $('#dusun').closest('div').show()
                } else {
                    $('#dusun').closest('div').hide()
                    $('#dusun').val('')
                    $('#dusun').trigger('change')
                }
                TableData.draw();
            })
            $('#rt, #rw, #dusun').change(function() {
                TableData.draw();
            })

            $('select[name=kelas]').find('optgroup').prop('disabled', 1)
            $('select[name=lokasi]').trigger('change')
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\opensid\resources\views/admin/pertanahan/persil/index.blade.php ENDPATH**/ ?>