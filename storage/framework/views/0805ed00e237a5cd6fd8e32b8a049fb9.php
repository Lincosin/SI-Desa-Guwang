<?php echo $__env->make('admin.layouts.components.asset_validasi', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('admin.layouts.components.asset_datatables', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>



<?php $__env->startSection('title'); ?>
    <h1>
        Rekam Surat Perseorangan
    </h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(ci_route('keluar')); ?>">Arsip Layanan Surat</a></li>
    <li class="active">Rekam Surat Perseorangan</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('admin.layouts.components.notifikasi', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <?php if (isset($component)) { $__componentOriginalc11c7292aaa9235aebed7379ae351e6a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc11c7292aaa9235aebed7379ae351e6a = $attributes; } ?>
<?php $component = App\View\Components\KembaliButton::resolve(['judul' => 'Kembali Ke Daftar Arsip Layanan Surat','url' => 'keluar'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
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
                <div class="box-header with-border">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover" style="width:75%">
                            <thead>
                                <tr>
                                    <td style="padding-top : 10px;padding-bottom : 10px;width:25%;">Nama Penduduk </td>
                                    <td>
                                        <div class="form-group">
                                            <div>
                                                <select class="form-control required input-sm select2-nik-ajax" id="nik" name="nik" data-url="<?php echo e(ci_route('surat/list_penduduk_bersurat_ajax')); ?>">
                                                    <?php if($penduduk): ?>
                                                        <option value="<?php echo e($penduduk->id); ?>">NIK/Tag ID Card : <?php echo e($penduduk->nik); ?> - <?php echo e($penduduk->nama); ?> Alamat: <?php echo e($penduduk->alamat_wilayah); ?></option>
                                                    <?php endif; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </thead>
                            <tbody class="info-penduduk">
                                <tr>
                                    <td style="padding-top : 10px;padding-bottom : 10px;" nowrap="">Tempat/ Tanggal Lahir (Umur)</td>
                                    <td class="ttl"> </td>
                                </tr>
                                <tr>
                                    <td style="padding-top : 10px;padding-bottom : 10px;">Alamat</td>
                                    <td class="alamat"> </td>
                                </tr>
                                <tr>
                                    <td style="padding-top : 10px;padding-bottom : 10px;">Pendidikan</td>
                                    <td class="pendidikan"> </td>
                                </tr>
                                <tr>
                                    <td style="padding-top : 10px;padding-bottom : 10px;">Warganegara / Agama</td>
                                    <td class="warganegara"> </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                                <form id="mainform" name="mainform" method="post">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="table-responsive">
                                                <table id="tabeldata" class="table table-bordered dataTable table-hover">
                                                    <thead class="bg-gray disabled color-palette">
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Aksi</th>
                                                            <th>Kode Surat</th>
                                                            <th>No. Urut</th>
                                                            <th>Jenis Surat</th>
                                                            <th>Nama Penduduk</th>
                                                            <th>Keterangan</th>
                                                            <th>Ditandatangani Oleh</th>
                                                            <th>Tanggal</th>
                                                            <th>User</th>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php echo $__env->make('admin.layouts.components.konfirmasi_hapus', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script src="<?php echo e(asset('js/custom-select2.js')); ?>"></script>
    <script>
        $(document).ready(function() {
            var TableData = $('#tabeldata').DataTable({
                ajax: {
                    url: "<?php echo e(ci_route('keluar.perorangan_datatables')); ?>",
                },
                columns: [{
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
                        data: 'kode_surat',
                        name: 'kode_surat',

                        searchable: false,
                        orderable: false
                    },
                    {
                        data: 'no_surat',
                        name: 'no_surat',

                        searchable: true,
                        orderable: true
                    },
                    {
                        data: 'id_format_surat',
                        name: 'id_format_surat',

                        searchable: true,
                        orderable: false
                    },
                    {
                        data: 'id_pend',
                        name: 'id_pend',

                        searchable: true,
                        orderable: true
                    },
                    {
                        data: 'keterangan',
                        name: 'keterangan',

                        searchable: true,
                        orderable: false
                    },
                    {
                        data: 'nama_pamong',
                        name: 'nama_pamong',

                        searchable: false,
                        orderable: false
                    },
                    {
                        data: 'tanggal',
                        name: 'tanggal',

                        searchable: false,
                        orderable: true
                    },
                    {
                        data: 'id_user',
                        name: 'id_user',

                        searchable: false,
                        orderable: false
                    },

                ],
                order: [
                    [8, 'desc']
                ],
                pageLength: 25,
                createdRow: function(row, data, dataIndex) {
                    if (data.status == 0) {
                        $(row).addClass('select-row');
                    }
                }
            });

            $('#nik').change(function() {
                TableData.column(5).search($(this).val()).draw()
                $('tbody.info-penduduk').hide()
                if ($(this).val() > 0) {
                    $('tbody.info-penduduk').show()
                    $.get("<?php echo e(ci_route('keluar.dataPenduduk')); ?>/" + $(this).val(), function(data) {
                        if (data) {
                            $('tbody.info-penduduk td.ttl').text(data.ttl)
                            $('tbody.info-penduduk td.alamat').text(data.alamat)
                            $('tbody.info-penduduk td.pendidikan').text(data.pendidikan)
                            $('tbody.info-penduduk td.warganegara').text(`${data.warganegara} / ${data.agama}`)
                        }
                    }, 'json')
                }
            })

            $('#nik').val(0)
            var penduduk = <?php echo json_encode($penduduk->id, 15, 512) ?>;
            if (penduduk) {
                $('#nik').val(penduduk)
            }
            $('#nik').trigger('change')
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\opensid\resources\views/admin/surat/keluar/perorangan.blade.php ENDPATH**/ ?>