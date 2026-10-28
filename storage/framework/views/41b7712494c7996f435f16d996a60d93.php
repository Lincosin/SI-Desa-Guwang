<?php echo $__env->make('admin.pengaturan_surat.asset_tinymce', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('admin.layouts.components.asset_datatables', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>



<?php $__env->startSection('title'); ?>
    <h1>
        Periksa Surat <?php echo e(ucwords($surat->formatSurat->nama)); ?>

    </h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(ci_route('surat')); ?>">Daftar Cetak Surat</a></li>
    <li class="active"> Surat <?php echo e(ucwords($surat->nama)); ?></li>
    <li class="active"> Konsep Surat <?php echo e(ucwords($surat->nama)); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('admin.layouts.components.notifikasi', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo form_open(null, 'class="form-horizontal"'); ?>

    <input type="hidden" id="idsurat" value="<?php echo e($surat->id); ?>">
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">Pemohon</h3>
        </div>

        <div class="box-body">
            <div class="form-group">
                <label class="control-label col-sm-3">NIK / Nama Penduduk</label>
                <div class="col-sm-9">
                    <input class="form-control input-sm" readonly="readonly" value="<?php echo e($surat->penduduk->nik); ?> - <?php echo e($surat->penduduk->nama); ?>">
                </div>
            </div>
            <?php echo $__env->make('admin.surat.konfirmasi_pemohon', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <div class="form-group">
                <input type="hidden" name="id_surat" value="<?php echo e($surat['id']); ?>">
                <label class="col-sm-3 control-label">Nomor Surat</label>
                <div class="col-sm-4">
                    <input
                        id="nomor"
                        class="form-control input-sm digits required"
                        type="text"
                        placeholder="Nomor Surat"
                        name="nomor"
                        value="<?php echo e($surat->Formatpenomoransurat); ?>"
                        disabled
                    >
                </div>
            </div>
        </div>
    </div>
    <?php if($mandiri): ?>
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Kelengkapan Dokumen</h3>
            </div>
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-bordered dataTable table-striped table-hover tabel-daftar">
                        <thead class="bg-gray disabled color-palette">
                            <tr>
                                <th>No</th>
                                <th>Nama Dokumen</th>
                                <th>Kelengkapan Dokumen</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if($list_dokumen_syarat != null): ?>
                                <?php $__currentLoopData = $list_dokumen_syarat; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $syarat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td class="padat"><?= $key + 1 ?></td>
                                        <td> <?php echo e($syarat['nama']); ?></td>
                                        <td class="padat">
                                            <?php if($syarat['id'] == '-1'): ?>
                                                <strong class="text-red"><i class="fa fa-exclamation-triangle text-red"></i>Bawa bukti fisik ke Kantor Desa</strong>
                                            <?php else: ?>
                                                <a href="<?php echo e(ci_route('permohonan_surat_admin.tampilkan', "{$syarat['id']}/{$syarat['id_pend']}")); ?>" class="btn btn-social btn-info btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block syarat"
                                                    title="Tampilkan"><i class="fa fa-eye"></i> Cek Dokumen</a>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                                <tr>
                                    <td class="text-center" colspan="9">Data Tidak Tersedia</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    <?php endif; ?>

    <?php if($surat->verifikasi_operator == '-1'): ?>
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Alasan Ditolak</h3>
            </div>
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-bordered dataTable table-striped table-hover tabel-daftar">
                        <thead class="bg-gray disabled color-palette">
                            <tr>
                                <th>No</th>
                                <th>Pesan</th>
                                <th>Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if($surat->tolak): ?>
                                <?php $__currentLoopData = $surat->tolak; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $keterangan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td class="padat"><?= $key + 1 ?></td>
                                        <td> <?php echo e($keterangan->keterangan); ?></td>
                                        <td class="padat"><?php echo e($keterangan->created_at->format('d-m-Y')); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                                <tr>
                                    <td class="text-center" colspan="9">Data Tidak Tersedia</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">Lampiran</h3>
        </div>
        <div class="box-body">
            <div class="table-responsive">
                <table class="table table-bordered dataTable table-striped table-hover tabel-daftar">
                    <thead class="bg-gray disabled color-palette">
                        <tr>
                            <th>No</th>
                            <th>Nama Dokumen</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if($surat->lampiran != null): ?>
                            <tr>
                                <td class="padat">1</td>
                                <td>Lampiran <?php echo e($surat->formatSurat->nama); ?></td>
                                <td class="padat">
                                    <button type="button" class="btn btn-social btn-info btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block lampiran" title="Cek Dokumen"><i class="fa fa-eye"></i> Cek Dokumen</button>
                                </td>
                            </tr>
                        <?php else: ?>
                            <tr>
                                <td class="text-center" colspan="9">Tidak Terdapat Lampiran</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="box-footer text-center">
            <?php echo $__env->make('admin.layouts.components.tombol_kembali', ['url' => ci_route('keluar.masuk'), 'label' => 'Daftar Permohonan', 'id' => 'back'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <?php if(is_file($surat->filesurat . '.pdf')): ?>
                <button type="button" class="btn btn-social btn-primary btn-sm preview"><i class="fa fa-file-pdf-o"></i>Lihat PDF</button>
            <?php elseif(is_file($surat->filesurat . '.rtf')): ?>
                <a href="<?php echo e(ci_route('keluar.unduh.rtf', $surat->id)); ?>" class="btn bg-purple btn-sm" title="Unduh Surat RTF" target="_blank"><i class="fa fa-file-word-o"></i> Unduh File</a>
            <?php endif; ?>

            <button type="button" class="btn btn-social btn-success btn-sm verifikasi" data-ulang="<?php echo e($surat->verifikasi_operator == -1 ? 'true' : 'false'); ?>"><i class="fa fa-check-circle"></i><?php echo e($surat->verifikasi_operator == -1 ? 'Kirim Ulang' : 'Setujui'); ?></button>

            <?php if(!$operator): ?>
                <button type="button" class="btn btn-social btn-danger btn-sm ditolak"><i class="fa fa-times"></i>Tolak</button>
            <?php endif; ?>

            <?php if($surat->verifikasi_operator == -1 && $operator && $mandiri): ?>
                <button type="button" class="btn btn-social btn-danger btn-sm kembalikan"><i class="fa fa-times"></i>Kembalikan</button>
            <?php endif; ?>
        </div>
    </div>

    </form>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script type="text/javascript">
        $(function() {
            $('button.verifikasi').click(function(e) {
                e.preventDefault();
                var id = $('#idsurat').val();
                var next = `<?php echo e($next ?? ''); ?>`;
                var tte = `<?php echo e(setting('tte') ?? ''); ?>`;
                var ulang = $(this).data('ulang')
                var pesan = `Apakah setuju surat ini di teruskan ke ${next}?`
                if (next != '' && ulang) {
                    pesan = `Kirim ulang surat ini untuk diperiksa?`
                } else if (next == '' && tte == '0') {
                    pesan = `Apakah setuju surat ini di teruskan ke Arsip?`
                } else if (next == '' && tte == '1') {
                    pesan = 'Apakah setuju surat ini untuk ditandatangani secara elektronik?'
                }

                var ulr_ajax = {
                    'confirm': `<?php echo e(ci_route('keluar.verifikasi')); ?>`,
                }

                var redirect = {
                    'confirm': `<?php echo e(ci_route('keluar.masuk')); ?>`,
                }
                var data = {
                    id: id
                };
                swal2_question(ulr_ajax, redirect, pesan, data, false);
            });

            $('button.ditolak').click(function(e) {
                e.preventDefault();
                var id = $('#idsurat').val();
                var ulr_ajax = `<?php echo e(ci_route('keluar.tolak')); ?>`;
                var redirect = `<?php echo e(ci_route('keluar.masuk')); ?>`;
                ditolak(id, ulr_ajax, redirect, 'Konfirmasi Pengembalian Surat', 'Pesan singkat alasan pengembalian', 'Pesan singkat alasan permohonan surat dikembalikan');
            });

            $('button.kembalikan').click(function(e) {
                e.preventDefault();
                console.log(e)
                var id = $('#idsurat').val();
                var ulr_ajax = `<?php echo e(ci_route('keluar.kembalikan')); ?>`;
                var redirect = `<?php echo e(ci_route('keluar.masuk')); ?>`;
                ditolak(id, ulr_ajax, redirect, 'Konfirmasi Pengembalian Permohonan', 'Pesan singkat alasan permohonan surat dikembalikan', 'Pesan singkat alasan permohonan surat dikembalikan');
            });

            $('button.preview').click(function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                Swal.fire({
                    customClass: {
                        popup: 'swal-lg',
                    },
                    title: 'Lihat',
                    html: `<object data="<?php echo e(ci_route('keluar.unduh/tinymce', $surat->id . '/true')); ?>#toolbar=0" style="width: 100%;min-height: 400px;" type="application/pdf"></object>`,
                    showCancelButton: true,
                    cancelButtonText: 'tutup',
                    showConfirmButton: false,
                })
            });

            $('button.lampiran').click(function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                Swal.fire({
                    customClass: {
                        popup: 'swal-lg',
                    },
                    title: 'Lihat',
                    html: `<object data="<?php echo e(ci_route('keluar.unduh/lampiran', $surat->id . '/true')); ?>#toolbar=0" style="width: 100%;min-height: 400px;" type="application/pdf"></object>`,
                    showCancelButton: true,
                    cancelButtonText: 'tutup',
                    showConfirmButton: false,
                })
            });

            $('a.syarat').click(function(e) {
                e.preventDefault();
                var attr = $(this).attr('href');
                Swal.fire({
                    customClass: {
                        popup: 'swal-lg',
                    },
                    title: 'Lihat',
                    html: `<object data="${attr}#toolbar=0" style="width: 100%;min-height: 400px;" ></object>`,
                    showCancelButton: true,
                    cancelButtonText: 'tutup',
                    showConfirmButton: false,
                })
            });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\opensid\resources\views/admin/surat/periksa.blade.php ENDPATH**/ ?>