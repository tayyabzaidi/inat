<?php
$__dt_buttons_group = '<div class="btn-group  btn-group-sm" role="group" aria-label="Category Options" >'
    . '<button  dt_btn_action="edit"    type="button" class="btn btn-sm btn-primary" style="font-size:12px;"> <i class="fa fa-edit"></i> تعديل</button>'
    . '</div>';
?>
<script>
    console.log('تهيئة سكربت التصنيفات....');

    /*
     * قسم العناصر العامة
     */

    var __table;
    var __table_url = '<?php echo __AJAX_CALL_PATH__; ?>?_path=datatable/management/designations/designations';

    /*
     * قسم العناصر العامة
     */

    function __table_init() {
        __table = $('#dtc_table').DataTable({

            "ajax": {
                url: __table_url,
                "data": {
                    "_dtsis": 'بيانات للإرسال.'
                },
                type: 'POST',
                dataFilter: function (data) {

                    var json = jQuery.parseJSON(data);
                    console.log(json);
                    return JSON.stringify(json.datatable);
                }
            },
            "columns": [
                { data: 'desigId' },
                { data: 'name' },
                { data: 'status' },
                { data: 'options' }
            ],
            "columnDefs": [{
                "targets": 3,
                "searchable": false,
                "data": null,
                "orderable": false,
                "defaultContent": '<?php echo $__dt_buttons_group; ?>'
            }],
            "destroy": true,
            "lengthMenu": [5, 10, 25, 50, 100, 200],
            "ordering": true,
            "info": true,
            "processing": true,
            "serverSide": true,
            "order": [[0, 'desc']],
            "pageLength": 5,
            fixedHeader: {
                header: true,
                footer: true
            },
            "stateSave": false,
            "responsive": false,
            "language": {
                "buttons": {
                    "copyTitle": '',
                    "copyKeys": '',
                    "copySuccess": {
                        _: '%d',
                        1: '1'
                    }
                },
                "decimal": "",
                "emptyTable": "",
                "info": "",
                "infoEmpty": "",
                "infoFiltered": "",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "_MENU_",
                "loadingRecords": "...",
                "processing": "<?php echo $lib->_('spinner_text'); ?>",
                "search": "بحث",
                "zeroRecords": "لا توجد نتائج مطابقة.",
                "paginate": {
                    "first": "الأول",
                    "last": "الأخير",
                    "next": "التالي",
                    "previous": "السابق"
                },
                "aria": {
                    "sortAscending": ": تفعيل لترتيب العمود تصاعديًا",
                    "sortDescending": ": تفعيل لترتيب العمود تنازليًا"
                }
            }

        });

        __table.on('click', 'button', function () {
            var action = this.getAttribute('dt_btn_action');
            var data = __table.row($(this).parents('tr')).data();
            __call_table_actions(action, data);
        });


        /*
         __table.on('click', 'tr', function () {
         $(this).toggleClass('selected');
         let _sel_row = __table.row($(this)).data();
         console.log(_sel_row);
         });
         * 
         */

    }

    __table_init();

    function cb_reload__table(__r) {
        __table.ajax.url(__table_url).load();
    }


    function __call_table_actions(action, data) {

        let _handler = '';
        let _response = '';
        let _qs = '&__action_on=' + data.desigId;

        switch (action) {
            case 'edit':
                $("#_edit_record_modal").modal('show');
                _handler = 'management/designations/editor';
                _response = '_edit_record_ajax_interface';
                _ajaxGetContent(_handler, _response, _qs);

                break;

            case 'delete':
                console.log(data);
                console.log('الحذف المطلوب');
                break;

            default:
                console.log('إجراء غير معروف ' + action);
        }
    }

    function cb_close_the_editor(__r) {
        $("#_edit_record_modal").modal('hide');
    }




</script>