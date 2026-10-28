$("#dragable").sortable({
    cursor: 'move',
    handle: '.fa-sort-alpha-desc',
    placeholder: 'ui-state-highlight',
    items: '.dragable-handle',
    axis: 'y',
    update: function(event, ui) {
        var order = [];
        $('tr.dragable-handle').each(function(index, element) {
            order.push($(this).attr('data-id'))
        })
        $.ajax({
            type: "POST",
            dataType: "json",
            url: '<?php echo e($urlDraggable); ?>',
            data: {
                data: order,
            },
            success: function(response) {
                TableData.draw();
            }
        });
    }
}).disableSelection();<?php /**PATH C:\xampp\htdocs\opensid\resources\views/admin/layouts/components/draggable.blade.php ENDPATH**/ ?>