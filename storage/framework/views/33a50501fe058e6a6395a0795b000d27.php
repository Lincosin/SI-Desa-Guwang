<?php $__env->startSection('content'); ?>
    <form id="validasi" action="<?php echo e($form_action); ?>" method="POST">
        <div class="box box-solid">
            <div class="box-header with-border bg-green">
                <h4 class="box-title">Surat</h4>
            </div>
            <div class="box-body box-line">
                <h4><b>PERMOHONAN SURAT</b></h4>
                <input type="hidden" id="id_permohonan" name="id_permohonan" value="<?php echo e($permohonan['id']); ?>" />
            </div>
            <div class="box-body box-line">
                <?php if($permohonan): ?>
                    <div class="alert alert-warning" role="alert">
                        <span style="font-size: larger;">Lengkapi permohonan surat tanggal <?php echo e($permohonan['updated_at']); ?></span>
                    </div>
                <?php endif; ?>
                <div class="form-group">
                    <label for="nama_surat" class="col-sm-3 control-label">Jenis Surat Yang Dimohon</label>
                    <div class="col-sm-9">
                        <select class="form-control select2 required" name="id_surat" id="id_surat">
                            <option value=""> -- Pilih Jenis Surat -- </option>
                            <?php $__currentLoopData = $menu_surat_mandiri; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($data['id']); ?>" <?php echo e($data['id'] == $permohonan['id_surat'] ? 'selected' : ''); ?>>
                                    <?php echo e($data['nama']); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="keterangan_tambahan" class="col-sm-3 control-label">Keterangan Tambahan</label>
                    <div class="col-sm-9">
                        <textarea class="form-control <?php echo e($cek_anjungan['keyboard'] == 1 ? 'kbvtext' : ''); ?>" name="keterangan" id="keterangan" placeholder="Ketik di sini untuk memberikan keterangan tambahan."><?php echo e($permohonan['keterangan']); ?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="no_hp_aktif" class="col-sm-3 control-label">No. HP aktif</label>
                    <div class="col-sm-9">
                        <input
                            class="form-control bilangan_spasi required <?php echo e($cek_anjungan['keyboard'] == 1 ? 'kbvnumber' : ''); ?>"
                            type="text"
                            name="no_hp_aktif"
                            id="no_hp_aktif"
                            placeholder="Ketik No. HP"
                            maxlength="14"
                            value="<?php echo e($permohonan['no_hp_aktif'] ?? $ci->is_login->telepon); ?>"
                        />
                    </div>
                </div>
            </div>
        </div>

        <!-- Kelengkapan Dokumen Yang Dibutuhkan -->
        <div class="box box-solid">
            <div class="ada_syarat" style="display: none">
                <div class="box-header with-border bg-green">
                    <h4 class="box-title">SYARAT SURAT</h4>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-data" id="syarat_surat" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Syarat</th>
                                    <th>Dokumen Melengkapi Syarat</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
            <div class="box-footer">
                <button type="reset" class="btn btn-social btn-sm btn-danger"><i class="fa fa-times"></i> Batal</button>
                <button type="submit" class="btn btn-social btn-primary btn-sm pull-right" id="isi_form"><i class="fa fa-file-text"></i>Isi Form</button>
            </div>
        </div>
    </form>

    <div class="modal fade in" id="dialog" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header btn-danger">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel"><i class="fa fa-exclamation-triangle"></i> &nbsp;Peringatan
                    </h4>
                </div>
                <div class="modal-body">
                    <p id="kata_peringatan"></p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-social btn-danger btn-sm" data-dismiss="modal"><i class='fa fa-sign-out'></i>
                        Tutup</button>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script>
        function cek_perhatian(elem) {
            if ($(elem).val() == '-1') {
                $(elem).next('.perhatian').show();
            } else {
                $(elem).next('.perhatian').hide();
            }
        }

        $(function() {
            $(document).on("keydown", ":input:not(textarea):not(:submit)", function(event) {
                if (event.key === "Enter" && !$("#validasi").valid()) {
                    event.preventDefault();
                    return false;
                }
            });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layanan_mandiri.layouts.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\opensid\resources\views/layanan_mandiri/surat/buat.blade.php ENDPATH**/ ?>