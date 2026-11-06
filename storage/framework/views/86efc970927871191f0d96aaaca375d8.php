<?php echo $__env->make('admin.layouts.components.asset_datatables', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>



<?php $__env->startSection('title'); ?>
    <h1>
        Daftar Permohonan Surat
    </h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="active">Daftar Permohonan Surat</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('admin.layouts.components.notifikasi', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    
    <?php if($tugas): ?>
        <?php
            $sebutanKades = ucwords(setting('sebutan_kepala_desa') ?: 'Kepala Desa');
        ?>
        <div class="callout callout-info tugas-permohonan">
            <h4><i class="fa fa-tasks"></i> Tugas Anda</h4>
            <ul>
                <?php if($tugas['kadus']): ?>
                    <li><b><?php echo e($tugas['diperiksa']); ?></b> permohonan perlu diperiksa (tombol <b>Sedang Diperiksa</b>), lalu suratnya dikirim ke <?php echo e($sebutanKades); ?>.</li>
                    <li><b><?php echo e($tugas['disetujui']); ?></b> surat menunggu persetujuan Anda (tombol hijau <b>Periksa &amp; Setujui</b>).</li>
                    <li><b><?php echo e($tugas['diperbaiki']); ?></b> surat ditolak <?php echo e($sebutanKades); ?> dan perlu ditindaklanjuti (tombol merah <b>Ditolak, Perbaiki</b>).</li>
                <?php else: ?>
                    <li><b><?php echo e($tugas['disetujui']); ?></b> surat menunggu persetujuan Anda (tombol hijau <b>Periksa &amp; Setujui</b>).</li>
                    <li>Kelengkapan permohonan diperiksa oleh Kepala Dusun pemohon sebelum suratnya sampai ke Anda.</li>
                <?php endif; ?>
                <li>Arsip Layanan hanya berisi arsip surat. Semua pemeriksaan dan persetujuan dilakukan di halaman ini.</li>
            </ul>
        </div>
    <?php endif; ?>

    <?php if($surat_lain->isNotEmpty()): ?>
        <div class="box box-warning">
            <div class="box-header with-border">
                <h3 class="box-title">Surat dari Cetak Surat yang perlu tindakan Anda</h3>
            </div>
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="padat">NO</th>
                                <th class="aksi">AKSI</th>
                                <th>JENIS SURAT</th>
                                <th>NAMA PENDUDUK</th>
                                <th class="padat">TANGGAL</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $surat_lain; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td class="padat"><?php echo e($loop->iteration); ?></td>
                                    <td class="aksi">
                                        <?php if($item->verifikasi_operator == -1): ?>
                                            <a href="<?php echo e(ci_route('keluar.periksa', $item->id)); ?>?kembali=permohonan" class="btn btn-social btn-danger btn-sm" title="Alasan ditolak: <?php echo e($item->alasanTolakTerakhir()); ?>"><i class="fa fa-exclamation-circle"></i>Ditolak, Periksa</a>
                                        <?php else: ?>
                                            <a href="<?php echo e(ci_route('keluar.periksa', $item->id)); ?>?kembali=permohonan" class="btn btn-social bg-olive btn-sm" title="Lihat surat, lalu setujui atau tolak"><i class="fa fa-check-square-o"></i>Periksa &amp; Setujui</a>
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo e($item->formatSurat->nama ?? ''); ?></td>
                                    <td><?php echo e($item->penduduk->nama ?? $item->nama_non_warga); ?></td>
                                    <td class="padat"><?php echo e(tgl_indo2($item->tanggal)); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <div class="box box-info">
        <?php echo form_open(null, 'id="mainform" name="mainform"'); ?>

        <div class="box-body">
            <div class="row mepet">
                <div class="col-sm-3">
                    <select class="form-control input-sm select2" id="status" name="status">
                        <option value="">Pilih Status</option>
                        <?php $__currentLoopData = $list_status_permohonan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($id); ?>"><?php echo e($value); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>
            <hr class="batas">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="tabeldata">
                    <thead>
                        <tr>
                            <th class="padat">NO</th>
                            <th class="aksi">AKSI</th>
                            <th class="padat">NO ANTREAN</th>
                            <th class="padat">NIK</th>
                            <th class="padat">NAMA PENDUDUK</th>
                            <th class="padat">NO HP AKTIF</th>
                            <th>JENIS SURAT</th>
                            <th>KETERANGAN</th>
                            <th class="padat">TANGGAL KIRIM</th>
                        </tr>
                    </thead>
                </table>
            </div>
            </form>
        </div>
    </div>

    
    <?php if($ttd_kades): ?>
        <?php
            $sebutanKades = ucwords(setting('sebutan_kepala_desa') ?: 'Kepala Desa');
            $adaTtd       = (bool) $ttd_kades['gambar'];
        ?>
        <div class="box box-default <?php echo e($adaTtd ? 'collapsed-box' : ''); ?>">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-pencil-square-o"></i> Tanda Tangan <?php echo e($sebutanKades); ?></h3>
                <span class="label <?php echo e($adaTtd ? 'label-success' : 'label-warning'); ?>"><?php echo e($adaTtd ? 'Sudah diunggah' : 'Belum diunggah'); ?></span>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa <?php echo e($adaTtd ? 'fa-plus' : 'fa-minus'); ?>"></i></button>
                </div>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-sm-4 text-center">
                        <?php if($adaTtd): ?>
                            <img src="<?php echo e($ttd_kades['gambar']); ?>" alt="Tanda tangan <?php echo e($sebutanKades); ?>" style="max-width: 100%; max-height: 140px; background: #fff; border: 1px dashed #ccc; padding: 8px;">
                        <?php else: ?>
                            <p class="text-muted" style="padding: 30px 0;">Belum ada tanda tangan.</p>
                        <?php endif; ?>
                    </div>
                    <div class="col-sm-8">
                        <?php echo form_open_multipart(ci_route('permohonan_surat_admin.ttd_kades')); ?>

                        <div class="form-group">
                            <label for="ttd">Unggah gambar tanda tangan (PNG atau JPG, paling besar 2 MB)</label>
                            <input type="file" id="ttd" name="ttd" accept="image/png,image/jpeg" class="form-control input-sm" required>
                            <p class="help-block">
                                Latar putih otomatis dibuat transparan dan ruang kosong dipotong.
                                Tulis kode <code>[ttd_kades]</code> di template surat (Pengaturan Surat), di baris kosong di atas nama <?php echo e($sebutanKades); ?>.
                                Tanda tangan hanya muncul pada surat yang sudah disetujui <?php echo e($sebutanKades); ?>; sebelum itu tempatnya kosong.
                            </p>
                        </div>
                        <button type="submit" class="btn btn-social btn-primary btn-sm"><i class="fa fa-upload"></i> Simpan Tanda Tangan</button>
                        </form>
                        <?php if($adaTtd): ?>
                            <?php echo form_open(ci_route('permohonan_surat_admin.ttd_kades'), 'style="margin-top: 8px;"'); ?>

                            <input type="hidden" name="hapus" value="1">
                            <button type="submit" class="btn btn-social btn-danger btn-sm" onclick="return confirm('Hapus tanda tangan <?php echo e($sebutanKades); ?>?')"><i class="fa fa-trash"></i> Hapus Tanda Tangan</button>
                            </form>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

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
                    url: "<?php echo e(ci_route('permohonan_surat_admin.datatables')); ?>",
                    data: function(req) {
                        req.status = $('#status').val();
                        console.log(req.status);
                        
                    }
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
                        data: 'no_antrian',
                        name: 'no_antrian',
                        searchable: true,
                        orderable: true
                    },
                    {
                        data: 'penduduk.nik',
                        name: 'penduduk.nik',
                        class: 'padat',
                        searchable: true,
                        orderable: true,
                        defaultContent: ''
                    },
                    {
                        data: 'penduduk.nama',
                        name: 'penduduk.nama',
                        searchable: true,
                        orderable: true,
                        defaultContent: ''
                    },
                    {
                        data: 'no_hp_aktif',
                        name: 'no_hp_aktif',
                        searchable: true,
                        orderable: true
                    },
                    {
                        data: 'surat.nama',
                        name: 'surat.nama',
                        searchable: true,
                        orderable: true
                    },
                    {
                        data: 'keterangan',
                        name: 'keterangan',
                        searchable: false,
                        orderable: false
                    },
                    {
                        data: 'created_at',
                        name: 'created_at',
                        searchable: true,
                        orderable: true
                    },
                ],
                order: [
                    [8, 'desc']
                ],
                pageLength: 25
            });

            $('#status').on('select2:select', function(e) {
                TableData.draw();
            });

            if (ubah == 0) {
                TableData.column(1).visible(false);
            }
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\opensid\resources\views/admin/permohonan_surat/index.blade.php ENDPATH**/ ?>