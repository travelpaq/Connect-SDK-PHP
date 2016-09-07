$(function () {
    $('[data-toggle="modal"]').on('click', function (e) {
            e.preventDefault();

            var url = $(this).attr('href');
            if (!url.indexOf('#') == 0) {
                var modal, modalDialog, modalContent;
                modal = $('<div class="modal fade" id="miModal" />');
                modalDialog = $('<div class="modal-dialog modal-lg" />');
                modalContent = $('<div class="modal-content" style="border-radius: 0px !important;"><div id="circularG"><div id="circularG_1" class="circularG blue"></div><div id="circularG_2" class="circularG blue"></div><div id="circularG_3" class="circularG blue"></div><div id="circularG_4" class="circularG blue"></div><div id="circularG_5" class="circularG blue"></div><div id="circularG_6" class="circularG blue"></div><div id="circularG_7" class="circularG blue"></div><div id="circularG_8" class="circularG blue"></div></div></div>');

                modal.modal('show')
                        .append(modalDialog)
                        .on('hidden.bs.modal', function () {
                            $(this).remove();
                        })
                        .appendTo('body');

                modalDialog.append(modalContent);

                $.get(url, function (data) {
                    modalContent.html(data);
                    modal.modal('show');
                });
            }
        });
});