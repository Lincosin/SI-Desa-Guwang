<div class="modal fade" id="modalHasilImport" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Modal Hasil Import</h4>
            </div>

            <form id="form-error" action="<?php echo e($form_action); ?>" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="box box-danger">
                                <div class="box-body">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label class="control-label">Terjadi beberapa error, antara lain</label>
                                                <input type="hidden" id="jml_error" value="<?php echo e(count($list_error)); ?>">
                                                
                                                <div class="table-responsive">
                                                    <table class="table table-bordered table-striped dataTable table-hover">
                                                        <thead class="bg-gray disabled color-palette">
                                                            <tr>
                                                                <th>No</th>
                                                                <th>Error</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php $__currentLoopData = $list_error; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <tr class="row-pertanyaan">
                                                                    <td><?php echo e($key + 1); ?></td>
                                                                    <td><?php echo e($data); ?></td>
                                                                </tr>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                    
                </div>
            </form>
        </div>
    </div>
</div><?php /**PATH C:\xampp\htdocs\opensid\Modules\Analisis\Views/master/modal_hasil_import.blade.php ENDPATH**/ ?>