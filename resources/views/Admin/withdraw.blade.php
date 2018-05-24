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
                                            <th>no.</th>
                                            <th>name</th>
                                            <th>show status</th>
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
                    <h4 class="modal-title" id="myModalLabel"> {{$title_page or 'ข้อมูลใหม่'}}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label for="add_name">name</label>
                        <input type="text" class="form-control" name="name" id="add_name" required="" placeholder="name">
                    </div>

                    <div class="form-check">
                        <label for="add_show_status" class="checkbox form-check-label">
                            <input type="checkbox" class="form-check-input" data-toggle="checkbox" name="show_status" id="add_show_status" required="" value="T" checked="checked"> Use
                        </label>
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
                    <h4 class="modal-title" id="myModalLabel"> {{$title_page or 'ข้อมูลใหม่'}}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label for="edit_name">name</label>
                        <input type="text" class="form-control" name="name" id="edit_name" required="" placeholder="name">
                    </div>

                    <div class="form-check">
                        <label for="edit_show_status" class="checkbox form-check-label">
                            <input type="checkbox" class="form-check-input" data-toggle="checkbox" name="show_status" id="edit_show_status" value="T"> Use
                        </label>
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
        "url": url_gb+"/admin/Withdraw/Lists",
        "data": function ( d ) {
            //d.myKey = "myValue";
            // d.custom = $('#myInput').val();
            // etc
        }
    },
    "columns": [
        {"data": "DT_Row_Index","name" : "DT_Row_Index", "orderable" : false, "searchable" :false},
        {"data" : "name"},
        {"data" : "show_status"},
        { "data": "action","className":"action text-center", "orderable" : false, "searchable" :false}
    ]
});
$('body').on('click','.btn-add',function(data){
    document.getElementById("FormAdd").reset();
    ShowModal('ModalAdd');
});
$('body').on('click','.btn-edit',function(data){
    document.getElementById("FormEdit").reset();
    var btn = $(this);
    btn.button('loading');
    var id = $(this).data('id');
    $('#edit_user_id').val(id);
    $.ajax({
        method : "GET",
        url : url_gb+"/admin/Withdraw/"+id,
        dataType : 'json'
    }).done(function(rec){
        $('#edit_name').val(rec.name);
        if(rec.show_status=='T'){
            $('#edit_show_status').parent().attr('class','checkbox form-check-label checked');
            $('#edit_show_status').prop('checked',true);
        }else{
            $('#edit_show_status').parent().attr('class','checkbox form-check-label');
            $('#edit_show_status').prop('checked',false);
        }

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

        name: {
            required: true,
        },
        // show_status: {
        //     required: true,
        // },
    },
    messages: {

        name: {
            required: "Please insert.",
        },
        // show_status: {
        //     required: "Please insert.",
        // },
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
        /*
        if(CKEDITOR!==undefined){
        for ( instance in CKEDITOR.instances ){
        CKEDITOR.instances[instance].updateElement();
    }
}
*/
var btn = $(form).find('[type="submit"]');
var data_ar = removePriceFormat(form,$(form).serializeArray());
btn.button("loading");
$.ajax({
    method : "POST",
    url : url_gb+"/admin/Withdraw",
    dataType : 'json',
    data : $(form).serialize()
}).done(function(rec){
    btn.button("reset");
    if(rec.status==1){
        TableList.api().ajax.reload();
        resetFormCustom(form);
        swal(rec.title,rec.content,"success");
        $('#ModalAdd').modal('hide');
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

        name: {
            required: true,
        },
        // show_status: {
        //     required: true,
        // },
    },
    messages: {

        name: {
            required: "Please insert.",
        },
        // show_status: {
        //     required: "Please insert.",
        // },
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
        /*
        if(CKEDITOR!==undefined){
        for ( instance in CKEDITOR.instances ){
        CKEDITOR.instances[instance].updateElement();
    }
}
*/
var btn = $(form).find('[type="submit"]');
var id = $('#edit_user_id').val();
btn.button("loading");
$.ajax({
    method : "POST",
    url : url_gb+"/admin/Withdraw/"+id,
    dataType : 'json',
    data : $(form).serialize()
}).done(function(rec){
    btn.button("reset");
    if(rec.status==1){
        TableList.api().ajax.reload();
        resetFormCustom(form);
        swal(rec.title,rec.content,"success");
        $('#ModalEdit').modal('hide');
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
            url : url_gb+"/admin/Withdraw/Delete/"+id,
            data : {ID : id}
        }).done(function(rec){
            if(rec.status==1){
                swal(rec.title,rec.content,"success");
                TableList.api().ajax.reload();
            }else{
                swal("ระบบมีปัญหา","กรุณาติดต่อผู้ดูแล","error");
            }
        }).fail(function(data){
            swal("ระบบมีปัญหา","กรุณาติดต่อผู้ดูแล","error");
        });
    }).catch(function(e){
        //console.log(e);
    });
});


</script>
@endsection
