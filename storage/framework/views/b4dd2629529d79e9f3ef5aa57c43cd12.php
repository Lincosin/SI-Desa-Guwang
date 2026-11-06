<?php echo $__env->make('admin.layouts.components.asset_datatables', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>



<?php $__env->startSection('title'); ?>
    <h1>
        Master Analisis Data Potensi/Sumber Daya
    </h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="active">Master Analisis</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('admin.layouts.components.notifikasi', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <input id="mode-form" type="hidden" value="<?php echo e($session_success); ?>">
    <div class="box box-info">
        <div class="box-header with-border">
            <?php if(can('u')): ?>
                <div class="btn-group btn-group-vertical">
                    <a class="btn btn-social btn-success btn-sm" data-toggle="dropdown"><i class='fa fa-plus'></i>
                        Tambah Analisis Baru</a>
                    <ul class="dropdown-menu" role="menu">
                        <li>
                            <a href="<?php echo e(ci_route('analisis_master.form')); ?>" class="btn btn-social btn-block btn-sm" title="Analisis Baru"><i class="fa fa-plus"></i> Analisis Baru</a>
                        </li>
                        <li>
                            <a
                                href="<?php echo e(ci_route('analisis_master.import_gform')); ?>"
                                class="btn btn-social btn-block btn-sm"
                                title="Impor dari Google Form"
                                data-remote="false"
                                data-toggle="modal"
                                data-target="#modalBox"
                                data-title="Impor Google Form"
                            ><i class="fa fa-plus"></i> Impor dari Google Form</a>
                        </li>
                    </ul>
                </div>
            <?php endif; ?>
            <?php if(can('h')): ?>
                <a href="#confirm-delete" title="Hapus Data" onclick="deleteAllBox('mainform', '<?php echo e(ci_route('analisis_master.delete')); ?>')" class="btn btn-social btn-danger btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block hapus-terpilih"><i
                        class='fa fa-trash-o'
                    ></i>
                    Hapus</a>
            <?php endif; ?>
            <?php if(can('u')): ?>
                <a
                    href="<?php echo e(ci_route('analisis_master.import_analisis')); ?>"
                    class="btn btn-social bg-purple btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block"
                    title="Impor Analisis"
                    data-remote="false"
                    data-toggle="modal"
                    data-target="#modalBox"
                    data-title="Impor Analisis"
                ><i class="fa fa-upload"></i> Impor Analisis</a>
            <?php endif; ?>
        </div>
        <div class="box-body">
            <div class="row mepet">
                <div class="col-sm-2">
                    <select class="form-control input-sm  select2" id="lock" <?= ($disableFilter) ? 'disabled' : ''; ?>>
                        <option value="">Pilih Status</option>
                        <?php $__currentLoopData = App\Enums\AktifEnum::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($key ? 0 : 1); ?>"><?php echo e($item); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="col-sm-2">
                    <select class="form-control input-sm select2" id="subjek_tipe" <?= ($disableFilter) ? 'disabled' : ''; ?>>
                        <option value="">Pilih Subjek</option>
                        <?php $__currentLoopData = Modules\Analisis\Enums\AnalisisRefSubjekEnum::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($key); ?>"><?php echo e($item); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>
            <hr class="batas">
            <?php echo form_open(null, 'id="mainform" name="mainform"'); ?>

            <div class="row">
                <div class="col-sm-12">
                    <div class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="table-responsive">
                                    <table id="tabeldata" class="table table-bordered table-striped dataTable table-hover">
                                        <thead class="bg-gray disabled color-palette">
                                            <tr>
                                                <?php if(can('h')): ?>
                                                    <th><input type="checkbox" id="checkall" /></th>
                                                <?php endif; ?>
                                                <th>NO</th>
                                                <th>AKSI</th>
                                                <th>NAMA</th>
                                                <th>SUBJEK/UNIT ANALISIS</th>
                                                <th>ID GOOGLE FORM</th>
                                                <th>SINKRONISASI GOOGLE FORM</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
    <?php echo $__env->make('admin.layouts.components.konfirmasi_hapus', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('analisis::master.modal_pertanyaan', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('analisis::master.modal_jawaban_pilihan', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('analisis::master.modal_hasil_import', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
    <script type="text/javascript" src="<?php echo e(asset('js/custom-analisis.js')); ?>"></script>
    <script>
        $(document).ready(function() {
            var TableData = $('#tabeldata').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: "<?php echo e(ci_route('analisis_master.datatables')); ?>",
                columns: [{
                        data: 'ceklist',
                        class: 'padat',
                        searchable: false,
                        orderable: false,
                        visible: <?php echo e(can('h') ? 1 : 0); ?>

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
                        orderable: true
                    },
                    {
                        data: 'subjek_tipe',
                        name: 'subjek_tipe',
                        searchable: true,
                        orderable: true
                    },
                    {
                        data: 'gform_id',
                        name: 'gform_id',
                        searchable: true,
                        orderable: true
                    },
                    {
                        data: 'gform_last_sync',
                        name: 'gform_last_sync',
                        searchable: true,
                        orderable: true
                    }, {
                        data: 'lock',
                        name: 'lock',
                        searchable: true,
                        visible: false
                    },
                ],
                order: [
                    [3, 'asc']
                ]
            });

            if (hapus == 0) {
                TableData.column(0).visible(false);
            }

            if (ubah == 0) {
                TableData.column(2).visible(false);
            }

            $('#subjek_tipe').change(function() {
                TableData.column(4).search($(this).val()).draw()
            })
            $('#lock').change(function() {
                TableData.column(7).search($(this).val()).draw()
            })
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\opensid\Modules\Analisis\Views/master/index.blade.php ENDPATH**/ ?>