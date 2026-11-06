<div class="modal fade" id="modalPertanyaan" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Modal Pertanyaan</h4>
            </div>

            
            <form id="form-pertanyaan" action="<?php echo e($form_action); ?>" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="box box-info">
                                <div class="box-body">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label class="control-label">
                                                    Pilih pertanyaan yang akan disimpan pada tabel berikut
                                                </label>

                                                
                                                <div class="table-responsive">
                                                    <table class="table table-bordered table-striped dataTable table-hover">
                                                        <thead class="bg-gray disabled color-palette">
                                                            <tr>
                                                                <th>
                                                                    <input type="checkbox" 
                                                                           id="select-all-question" 
                                                                           checked 
                                                                           data-waschecked="true" />
                                                                </th>
                                                                <th>NIK/KK</th>
                                                                <th>Pertanyaan</th>
                                                                <th>Tipe Pertanyaan</th>
                                                                <th>Kategori/Variabel</th>
                                                                <th>Bobot</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php $__empty_1 = true; $__currentLoopData = $data_import['pertanyaan']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                                <tr class="row-pertanyaan">
                                                                    
                                                                    <input type="hidden" class="input-id" value="<?php echo e($key); ?>">
                                                                    <input type="hidden" class="input-item-id" value="<?php echo e($data['itemId']); ?>">

                                                                    
                                                                    <td>
                                                                        <input type="checkbox" 
                                                                               class="input-is-selected" 
                                                                               checked 
                                                                               data-waschecked="true">
                                                                    </td>

                                                                    
                                                                    <td class="padat">
                                                                        <input type="radio" class="input-is-nik-kk">
                                                                    </td>

                                                                    
                                                                    <td class="input-pertanyaan">
                                                                        <?php echo e($data['title']); ?>

                                                                    </td>

                                                                    
                                                                    <td>
                                                                        <select name="tipe_pertanyaan" class="form-control input-sm input-tipe">
                                                                            <option value="0">Tipe Pertanyaan</option>
                                                                            <option value="1" <?php echo e($data['type'] == 'MULTIPLE_CHOICE' ? 'selected' : ''); ?>>
                                                                                Pilihan (Tunggal)
                                                                            </option>
                                                                            <option value="2">Pilihan (Ganda)</option>
                                                                            <option value="3">Isian Jumlah (Kuantitatif)</option>
                                                                            <option value="4" <?php echo e($data['type'] != 'MULTIPLE_CHOICE' ? 'selected' : ''); ?>>
                                                                                Isian Teks (Kualitatif)
                                                                            </option>
                                                                        </select>
                                                                    </td>

                                                                    
                                                                    <td>
                                                                        <input type="text" class="form-control input-sm input-kategori">
                                                                    </td>

                                                                    
                                                                    <td>
                                                                        <input type="number" 
                                                                               class="form-control input-sm input-bobot" 
                                                                               value="0">
                                                                    </td>
                                                                </tr>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                                <tr>
                                                                    <td colspan="6" class="text-center">
                                                                        Tidak ada data pertanyaan
                                                                    </td>
                                                                </tr>
                                                            <?php endif; ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                
                <div class="modal-footer">
                    <button type="button" class="btn btn-social btn-flat btn-info btn-sm" id="btn-next-pertanyaan">
                        <i class="fa fa-arrow-right"></i> Lanjutkan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\opensid\Modules\Analisis\Views/master/modal_pertanyaan.blade.php ENDPATH**/ ?>