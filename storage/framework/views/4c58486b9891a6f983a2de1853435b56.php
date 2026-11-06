<div class="modal fade" id="modalJawaban" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Modal Jawaban Pilihan</h4>
            </div>

            <form id="form-jawaban" action="<?php echo e(site_url('analisis_master/save_import_gform')); ?>" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="box box-info">
                                <div class="box-body">
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label class="control-label">Informasi Umum Form Analisis</label>
                                                
                                                <input type="hidden" id="id-row-nik-kk" name="id-row-nik-kk">
                                                <input type="hidden" id="gform-id-nik-kk" name="gform-id-nik-kk">
                                                <input type="hidden" id="gform-form-id" name="gform-form-id">
                                                
                                                <div class="table-responsive">
                                                    <table class="table table-bordered table-striped dataTable table-hover">
                                                        <tbody>
                                                            <tr>
                                                                <td>1</td>
                                                                <td>Nama Form Analisis</td>
                                                                <td>
                                                                    <input type="text" name="nama_form" id="nama_form" class="form-control input-sm">
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>2</td>
                                                                <td>Tahun Pendataan</td>
                                                                <td>
                                                                    <input type="text" name="tahun_pendataan" id="tahun_pendataan" class="form-control input-sm">
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>3</td>
                                                                <td>Subjek/Unit Analisis</td>
                                                                <td>
                                                                    <select name="subjek_analisis" id="subjek_analisis" class="form-control input-sm">
                                                                        <option value="0">Subjek Analisis</option>
                                                                        <option value="1">Penduduk</option>
                                                                        <option value="2">Keluarga/KK</option>
                                                                    </select>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    
                                    <label class="control-label" id="caption-jawaban">
                                        Tidak Ada Pilhan Jawaban Tunggal yang harus diatur. Silahkan melanjutkan ke tahap selanjutnya
                                    </label>

                                    
                                    <?php $__currentLoopData = $data_import['pertanyaan']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="form-group" id="row-jawaban-<?php echo e($key); ?>">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label class="control-label">
                                                        Jawaban untuk kategori <span><?php echo e($data['title']); ?></span>
                                                    </label>
                                                    
                                                    
                                                    <input type="hidden" class="is-selected" name="is_selected[]">
                                                    <input type="hidden" class="is-nik-kk" name="is_nik_kk[]">
                                                    <input type="hidden" name="pertanyaan[]" value="<?php echo e($data['title']); ?>">
                                                    <input type="hidden" class="tipe" name="tipe[]">
                                                    <input type="hidden" class="kategori" name="kategori[]">
                                                    <input type="hidden" class="bobot" name="bobot[]">
                                                    
                                                    <div class="table-responsive">
                                                        <table class="table table-bordered table-striped dataTable table-hover">
                                                            <thead class="bg-gray disabled color-palette">
                                                                <tr>
                                                                    <th>Kode</th>
                                                                    <th>Jawaban</th>
                                                                    <th>Nilai/Ukuran</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php $__currentLoopData = $data['choices']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $unique_key => $unique_value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <tr>
                                                                        <input type="hidden" name="unique-param-key-<?php echo e($key); ?>[]" value="<?php echo e($unique_key); ?>">
                                                                        <input type="hidden" name="unique-param-value-<?php echo e($key); ?>[]" value="<?php echo e($unique_value); ?>">
                                                                        <td><?php echo e($unique_key + 1); ?></td>
                                                                        <td><?php echo e($unique_value); ?></td>
                                                                        <td>
                                                                            <input type="number" name="unique-param-nilai-<?php echo e($key); ?>[]" class="form-control input-sm">
                                                                        </td>
                                                                    </tr>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>

                                
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-social btn-flat btn-danger btn-sm pull-left" id="btn-prev-jawaban">
                                        <i class="fa fa-arrow-left"></i> Kembali
                                    </button>
                                    <button type="button" class="btn btn-social btn-flat btn-info btn-sm" id="btn-next-jawaban">
                                        <i class="fa fa-arrow-right"></i> Lanjutkan
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div><?php /**PATH C:\xampp\htdocs\opensid\Modules\Analisis\Views/master/modal_jawaban_pilihan.blade.php ENDPATH**/ ?>