<div class="tab-pane" id="sumber-penduduk">
    <div class="box-body">
        <div class="callout callout-info">
            <p><?php echo e(sebutanDesa($list_setting->where('key', 'form_penduduk_luar')->first()->keterangan)); ?></p>
        </div>
        <a data-target="#form-penduduk-luar" data-remote="false" data-toggle="modal" data-backdrop="false" data-keyboard="false" class="btn btn-social btn-success btn-sm btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block">
            <i class="fa fa-plus"></i>Form Penduduk Luar
        </a>
        <br /><br />
        <div id="list-form-penduduk">
            <?php $count = 0; ?>
            <?php $__currentLoopData = $penduduk_luar; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $penduduk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($count % 3 === 0): ?>
                    <div class="row">
                <?php endif; ?>
                <div class="col-sm-4" data-index="<?php echo e($index); ?>">
                    <div class="panel panel-primary">
                        <?php if($index > 3): ?>
                            <div class="btn-group pull-right" style="padding:6px">
                                <span
                                    class="btn btn-sm btn-warning can-edit"
                                    data-index="<?php echo e($index); ?>"
                                    data-target="#form-penduduk-luar"
                                    data-remote="false"
                                    data-toggle="modal"
                                    data-backdrop="false"
                                    data-keyboard="false"
                                >
                                    <i class="fa fa-pencil"></i>
                                </span>
                                <span class="btn  btn-sm btn-danger" onclick="$(this).closest('.col-sm-4').remove()" style="margin-left: 5px">
                                    <i class="fa fa-trash"></i>
                                </span>
                            </div>
                        <?php endif; ?>
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <?php echo e(strtoupper(SebutanDesa($penduduk['title']))); ?>

                            </h4>
                        </div>
                        <div class="panel-body">
                            <ul>
                                <?php $__currentLoopData = explode(',', $penduduk['input']); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><?php echo e($p_luar_map[$item]); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                            <input type="hidden" value="<?php echo e($penduduk['title']); ?>" name="penduduk_luar[<?php echo e($index); ?>][title]" />
                            <input type="hidden" value='<?php echo e($penduduk['input']); ?>' name="penduduk_luar[<?php echo e($index); ?>][input]" />
                        </div>
                    </div>
                </div>
                <?php $count++; ?>
                <?php if($count % 3 === 0 || $loop->last): ?>
        </div>
        <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>
</div>
<?php echo $__env->make('admin.pengaturan_surat.partials.modal_sumber_penduduk', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->startPush('scripts'); ?>
    <script type="text/javascript">
        $(function() {
            $('#form-penduduk-luar').on('shown.bs.modal', function(ev) {
                let _btn = $(ev.relatedTarget)
                const modal = $(this)
                modal.data('index', null)
                modal.find(`.modal-body :checkbox:not(:disabled)`).prop('checked', false)
                modal.find(`.modal-body input.judul`).val('')
                if (_btn.hasClass('can-edit')) {
                    const _panel = _btn.closest('.panel')
                    const _panelBody = _panel.find('.panel-body')
                    const _title = _panelBody.find(`input[name="penduduk_luar[${_btn.attr('data-index')}][title]"]`).val()
                    const _items = _panelBody.find(`input[name="penduduk_luar[${_btn.attr('data-index')}][input]"]`).val()
                    modal.data('index', _btn.attr('data-index'))
                    modal.find('.modal-body input.judul').val(_title)

                    _items.split(',').forEach(function(item) {
                        modal.find(`.modal-body :checkbox[data-id="${item}"]:not(:disabled)`).prop('checked', true)
                    })
                }
            });
            $('.form-penduduk-btn').on('click', function() {
                let _panel = $(this).closest('.modal')
                let _panelBody = _panel.find('.modal-body')
                let _judul = _panelBody.find('input.judul')
                if ($.isEmptyObject(_judul.val())) {
                    _error('Judul harus diisi')
                    return
                }
                let _selected = ['<ul>']
                let _input = [],
                    _index = _panel.data('index') ?? new Date().getTime()
                _panelBody.find(':checked').each(function() {
                    _selected.push(`<li>${$(this).closest('label').text()}</li>`)
                    _input.push($(this).data('id'))
                })
                _selected.push('</ul>')
                _selected.push(`<input type="hidden" value="${_judul.val()}" name="penduduk_luar[${_index}][title]">`)
                _selected.push(`<input type="hidden" value="${_input}" name="penduduk_luar[${_index}][input]">`)
                let _template = `
                <div class="col-sm-4" data-index="${_index}">
                    <div class="panel panel-primary">
                        <div class="btn-group pull-right" style="padding:6px">
                            <span class="btn btn-sm btn-warning can-edit" 
                            data-index="${_index}"
                            data-target="#form-penduduk-luar"
                            data-remote="false"
                            data-toggle="modal"
                            data-backdrop="false"
                            data-keyboard="false">
                                <i class="fa fa-pencil"></i>
                            </span>
                            <span class="btn btn-sm btn-danger" onclick="$(this).closest('.col-sm-4').remove()" style="margin-left: 5px">
                                <i class="fa fa-trash"></i>
                            </span>
                        </div>
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                ${_judul.val()}
                            </h4>
                        </div>
                        <div class="panel-body">
                            ${_selected.join('')}
                        </div>
                    </div>
                </div>`

                if ($(`#list-form-penduduk .row:last-child .col-sm-4`).length % 3 === 0) {
                    $(`<div class="row"></div>`).appendTo('#list-form-penduduk')
                }

                if (_panel.data('index') == null) {
                    $(_template).appendTo('#list-form-penduduk .row:last-child')
                } else {
                    $(`#list-form-penduduk div[data-index=${_index}]`).find('.panel-title').html(_judul.val())
                    $(`#list-form-penduduk div[data-index=${_index}]`).find('.panel-body').html(_selected.join(''))
                }
                _panel.modal('hide')
            })
        });
    </script>
<?php $__env->stopPush(); ?>
<?php /**PATH C:\xampp\htdocs\opensid\resources\views/admin/pengaturan_surat/partials/pengaturan_sumber_penduduk.blade.php ENDPATH**/ ?>