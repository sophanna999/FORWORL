@extends('Admin.layouts.layout')
@section('css_bottom')
@endsection
@section('body')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="content">
                        <h4 class="title">
                            {{$title_page or '' }}
                            <button class="btn btn-success btn-add pull-right" >
                                + Create data
                            </button>
                        </h4>
                        <div class="toolbar">
                            <!--        Here you can write extra buttons/actions for the toolbar              -->
                        </div>
                        <div class="material-datatables">
                            <div class="table-responsive">
                                <table id="TableList" class="table table-striped table-no-bordered table-hover" style="width:100%;cellspacing:0">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Code</th>
                                            <th>Name</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('modal')
<div class="modal" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="FormAdd">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel"> {{$title_page}}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">

                <div class="form-group">
                    <label for="add_code">Code</label>
                    <input type="text" class="form-control" name="code" id="add_code" required="" placeholder="Code">
                </div>

                <div class="form-group">
                    <label for="add_name">Name</label>
                    <input type="text" class="form-control" name="name" id="add_name" required="" placeholder="Name">
                </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-warning text-left" data-dismiss="modal" aria-label="Close">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <input type="hidden" name="edit_user_id" id="edit_user_id">
            <form id="FormEdit">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel"> {{$title_page}}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">

                <div class="form-group">
                    <label for="edit_code">Code</label>
                    <input type="text" class="form-control" name="code" id="edit_code" required="" placeholder="Code">
                </div>

                <div class="form-group">
                    <label for="edit_name">Name</label>
                    <input type="text" class="form-control" name="name" id="edit_name" required="" placeholder="Name">
                </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-warning text-left" data-dismiss="modal" aria-label="Close">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('js_bottom')
<script src="{{asset('assets/global/plugins/orakuploader/orakuploader.js')}}"></script>
<script>

     var TableList = $('#TableList').dataTable({
        "ajax": {
            "url": url_gb+"/admin/Countries/Lists",
            "data": function ( d ) {

            }
        },
        "columns": [
            { "data": "DT_Row_Index" , "className": "text-center", "searchable": false, "orderable": false  },
            {"data" : "code"},
            {"data" : "name"},
            { "data": "action","className":"action text-center" , "searchable" : false, "orderable": false}
        ]
    });
    $('body').on('click','.btn-add',function(data){
        resetFormCustom('#FormAdd');
        ShowModal('ModalAdd');
    });
    $('body').on('click','.btn-edit',function(data){
        var btn = $(this);
        btn.button('loading');
        var id = $(this).data('id');
        $('#edit_user_id').val(id);
        $.ajax({
            method : "GET",
            url : url_gb+"/admin/Countries/"+id,
            dataType : 'json'
        }).done(function(rec){
            $('#edit_code').val(rec.code);
            $('#edit_name').val(rec.name);

            btn.button("reset");
            ShowModal('ModalEdit');
        }).fail(function(){
            swal("system.system_alert","system.system_error","error");
            btn.button("reset");
        });
    });

    $('#FormAdd').validate({
        errorElement: 'div',
        errorClass: 'invalid-feedback',
        focusInvalid: false,
        rules: {
            code: {
                required: true,
            },
            name: {
                required: true,
            },
        },
        messages: {
            code: {
                required: "Please insert.",
            },
            name: {
                required: "Please insert.",
            },
        },
        highlight: function (e) {
            validate_highlight(e);
        },
        success: function (e) {
            validate_success(e);
        },

        errorPlacement: function (error, element) {
            validate_errorplacement(error, element);
        },
        submitHandler: function (form) {
            var btn = $(form).find('[type="submit"]');
            var data_ar = removePriceFormat(form,$(form).serializeArray());
            btn.button("loading");
            $.ajax({
                method : "POST",
                url : url_gb+"/admin/Countries",
                dataType : 'json',
                data : $(form).serialize()
            }).done(function(rec){
                btn.button("reset");
                if(rec.status==1){
                    TableList.api().ajax.reload();
                    resetFormCustom(form);
                    swal(rec.title,rec.content,"success");
                    $('#ModalAdd').modal('hide');
                }else if(rec.status==2){
                    swal(rec.title,rec.content,"warning");
                }else{
                    swal(rec.title,rec.content,"error");
                }
            }).fail(function(){
                swal("system.system_alert","system.system_error","error");
                btn.button("reset");
            });
        },
        invalidHandler: function (form) {

        }
    });

    $('#FormEdit').validate({
        errorElement: 'div',
        errorClass: 'invalid-feedback',
        focusInvalid: false,
        rules: {
            code: {
                required: true,
            },
            name: {
                required: true,
            },
        },
        messages: {
            code: {
                required: "Please insert.",
            },
            name: {
                required: "Please insert.",
            },
        },
        highlight: function (e) {
            validate_highlight(e);
        },
        success: function (e) {
            validate_success(e);
        },

        errorPlacement: function (error, element) {
            validate_errorplacement(error, element);
        },
        submitHandler: function (form) {
            var btn = $(form).find('[type="submit"]');
            var id = $('#edit_user_id').val();
            btn.button("loading");
            $.ajax({
                method : "POST",
                url : url_gb+"/admin/Countries/"+id,
                dataType : 'json',
                data : $(form).serialize()
            }).done(function(rec){
                btn.button("reset");
                if(rec.status==1){
                    TableList.api().ajax.reload();
                    resetFormCustom(form);
                    swal(rec.title,rec.content,"success");
                    $('#ModalEdit').modal('hide');
                }else if(rec.status==2){
                    swal(rec.title,rec.content,"warning");
                }else{
                    swal(rec.title,rec.content,"error");
                }
            }).fail(function(){
                swal("system.system_alert","system.system_error","error");
                btn.button("reset");
            });
        },
        invalidHandler: function (form) {

        }
    });

    $('body').on('click','.btn-delete',function(e){
        e.preventDefault();
        var btn = $(this);
        var id = btn.data('id');
        swal({
            title: "Do you want to delete the data?",
            text: "If you delete, you will not be able to restore it.",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, I want to delete",
            cancelButtonText: "Cancel",
            showLoaderOnConfirm: true,
        }).then(function() {
            $.ajax({
                method : "POST",
                url : url_gb+"/admin/Countries/Delete/"+id,
                data : {ID : id}
            }).done(function(rec){
                if(rec.status==1){
                    swal(rec.title,rec.content,"success");
                    TableList.api().ajax.reload();
                }else{
                    swal("System error","Please contact the administrator.","error");
                }
            }).fail(function(data){
                swal("System error","Please contact the administrator.","error");
            });
        }).catch(function(e){
            //console.log(e);
        });
    });


</script>
@endsection
