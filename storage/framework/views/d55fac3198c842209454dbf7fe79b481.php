<?php echo $__env->make('admin.layouts.components.asset_datatables', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->startSection('title'); ?>
    <h1>
        Dokumen / Kelengkapan <?php echo e($module_name); ?>

    </h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li><a href="<?php echo e(ci_route('penduduk')); ?>"> Data <?php echo e($module_name); ?></a></li>
    <li class="active">Dokumen / Kelengkapan <?php echo e($module_name); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('admin.layouts.components.notifikasi', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="box box-info">
        <div class="box-header with-border">
            <?php if(can('u')): ?>
                <a
                    href="<?php echo e(ci_route('penduduk.dokumen_form', $penduduk->id)); ?>"
                    title="Tambah"
                    data-remote="false"
                    data-toggle="modal"
                    data-target="#modalBox"
                    data-title="Tambah"
                    class="btn btn-social bg-olive btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block"
                ><i class='fa fa-plus'></i>Tambah</a>
            <?php endif; ?>
            <?php if(can('h')): ?>
                <a href="#confirm-delete" title="Hapus Data" onclick="deleteAllBox('mainform','<?php echo e(ci_route('penduduk.delete_dokumen', $penduduk->id)); ?>')" class="btn btn-social btn-danger btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block hapus-terpilih"><i
                        class='fa fa-trash-o'
                    ></i> Hapus</a>
            <?php endif; ?>
            <?php echo $__env->make('admin.layouts.components.tombol_kembali', [
                'url' => preg_match('/bumindes_arsip/i', $_SERVER['HTTP_REFERER']) ? ci_route('bumindes_arsip.clear') : ci_route('penduduk.detail', $penduduk->id),
                'label' => 'Halaman ' . $_SERVER['HTTP_REFERER'] == ci_route('bumindes_arsip') ? 'Bumindes Arsip' : 'Biodata Penduduk',
            ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        </div>
        <div class="box-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <tbody>
                        <tr>
                            <td nowrap style="padding-top : 10px;padding-bottom : 10px; width:15%;">Nama Penduduk</td>
                            <td nowrap> : <?php echo e($penduduk->nama); ?></td>
                        </tr>
                        <tr>
                            <td nowrap style="padding-top : 10px;padding-bottom : 10px;">NIK</td>
                            <td nowrap> : <?php echo e($penduduk->nik); ?></td>
                        </tr>
                        <tr>
                            <td nowrap style="padding-top : 10px;padding-bottom : 10px;">Alamat</td>
                            <td nowrap> : <?php echo e($penduduk->alamat_sekarang ?? $penduduk->alamat); ?> RT/RW :
                                <?php echo e($penduduk->wilayah->rt); ?>/<?php echo e($penduduk->wilayah->rw); ?>

                                <?php echo e(strtoupper(setting('sebutan_dusun'))); ?> : <?php echo e($penduduk->wilayah->dusun); ?> </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <?php echo form_open(null, 'id="mainform" name="mainform"'); ?>

            <div class="table-responsive">
                <?php if($parent_jenis): ?>
                    <h5 class="box-title text-center">Daftar Kategori <?php echo e($parent_jenis); ?></h5>
                <?php endif; ?>
                <table class="table table-bordered table-hover tabel-daftar" id="tabeldata">
                    <thead>
                        <tr>
                            <th><input type="checkbox" id="checkall"></th>
                            <th>No</th>
                            <th>Aksi</th>
                            <th>Nama Dokumen</th>
                            <th width="30%">Jenis Dokumen</th>
                            <th>Tanggal Upload</th>
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
                ajax: "<?php echo e(ci_route('penduduk.dokumen_datatables')); ?>?id_pend=<?php echo e($penduduk->id); ?>",
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
                        orderable: true
                    },
                    {
                        data: 'jenis_dokumen',
                        name: 'jenis_dokumen',
                        searchable: false,
                        orderable: false,
                    },
                    {
                        data: 'tgl_upload',
                        name: 'tgl_upload',
                        searchable: false,
                        orderable: false,
                        class: 'padat',
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

        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\opensid\resources\views/admin/penduduk/dokumen/index.blade.php ENDPATH**/ ?>