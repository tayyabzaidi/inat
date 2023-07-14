<?php
$__dt_buttons_group = '<div class="btn-group  btn-group-sm" role="group" aria-label="Category Options" >'
    . '<button  dt_btn_action="edit"    type="button" class="btn btn-sm btn-primary" style="font-size:12px;"> <i class="fa fa-edit"></i> Manage</button>'
    . '</div>';
?>


<script>
    console.log('employees script init....');
    var __table;
    var __table_url = '<?php echo __AJAX_CALL_PATH__; ?>?_path=datatable/management/employees/employees';

    function __table_init() {
        __table = $('#dtc_table').DataTable({

            "ajax": {
                url: __table_url,
                "data": {
                    "_dtsis": 'data to send.'
                },
                type: 'POST',
                dataFilter: function (data) {

                    var json = jQuery.parseJSON(data);
                    console.log(json);
                    return JSON.stringify(json.datatable);
                }
            },
            "columns": [
                { data: 'empId' },
                { data: 'empCode' },
                { data: 'info_fullname_en' },
                { data: 'info_fathername_en' },
                { data: 'usedLeaves' },
                { data: 'leavesRemaining' },
                { data: 'usedTickets' },
                { data: 'ticketsRemaining' },
                { data: 'options' }
            ],
            "columnDefs": [{
                "targets": 8,
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
            "pageLength": 10,
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
                "search": "Search",
                "zeroRecords": "No match found.",
                "paginate": {
                    "first": "<<",
                    "last": ">>",
                    "next": ">",
                    "previous": "<"
                },
                "aria": {
                    "sortAscending": ": activate to sort column ascending",
                    "sortDescending": ": activate to sort column descending"
                }
            }

        });

        __table.on('click', 'button', function () {
            var action = this.getAttribute('dt_btn_action');
            var data = __table.row($(this).parents('tr')).data();
            __call_table_actions(action, data);
        });


        setTimeout(function () {
            __global_inteface_init();
        }, 500);
    }

    __table_init();

    function cb_reload__table(__r) {
        __table.ajax.url(__table_url).load();
    }

    function cb_create_completed(__r) {
        cb_reload__table(__r);
        __manage_modal(__r.empId);
    }

    function __create_modal() {
        $("#_create_record_modal").modal('show');
    }

    function __save_excel_employees() {
        $("#myModal1").modal('show');
    }
    function __alott_items() {
        $("#myModal2").modal('show');
    }
    function __manage_modal(empId) {

        $("#_create_record_modal").modal('hide');
        $("#_edit_record_modal").modal('show');


        let _qs = '&__action_on=' + empId;
        let _handler = 'management/employees/editor';
        let _response = '_edit_record_ajax_interface';

        _ajaxGetContent(_handler, _response, _qs);
    }


    function __call_table_actions(action, data) {
        switch (action) {
            case 'edit':
                __manage_modal(data.empId);
                break;

            case 'delete':
                console.log(data);
                console.log('delete called');
                break;

            default:
                console.log('undefined action ' + action);
        }
    }


    function __update_type_feild(empId, typId, callKey, fldId, fldValue) {

        let _d = new FormData();

        _d.append('_path', 'management/employees/tabs/__tabs_handler/update-request-types');
        _d.append('empId', empId);
        _d.append('typId', typId);
        _d.append('callKey', callKey);
        _d.append('fldId', fldId);
        _d.append('fldValue', fldValue);

        _ajaxCallWithDataObjectMute(_d);


    }




</script>