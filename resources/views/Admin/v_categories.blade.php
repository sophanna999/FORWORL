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
                                            <th>Name</th>
                                            <th>Status</th>
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
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form id="FormAdd">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel"> {{$title_page}}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <!-- Orak photo -->
                    <div class="form-group">
                        <label for="add_photo">Photo</label>
                        <div id="orak_add_photo">
                            <div id="add_photo" orakuploader="on"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="add_name">Name</label>
                        <input type="text" class="form-control" name="name" id="add_name" placeholder="Name">
                    </div>
                    <!-- CKEditor -->
                    <div class="form-group">
                        <label for="add_detail">Detail</label>
                        <textarea type="text" class="form-control" name="detail" id="add_detail"></textarea>
                    </div>
                    <div class="form-check">
                        <label for="add_show_status" class="add_show_status checkbox form-check-label">
                            <input type="checkbox" class="form-check-input" data-toggle="checkbox" name="show_status" id="add_show_status"  value="T" checked="checked"> Use
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
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <input type="hidden" name="edit_user_id" id="edit_user_id">
            <form id="FormEdit">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel"> {{$title_page}}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <!-- Orak photo -->
                    <input type="hidden" name="org_photo" id="org_photo">
                    <div class="form-group">
                        <label for="edit_photo">Photo</label>
                        <div id="orak_edit_photo">
                            <div id="edit_photo" orakuploader="on"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="edit_name">Name</label>
                        <input type="text" class="form-control" name="name" id="edit_name"  placeholder="Name">
                    </div>
                    <!-- CKEditor -->
                    <div class="form-group">
                        <label for="edit_detail">Detail</label>
                        <textarea type="text" class="form-control" name="detail" id="edit_detail"></textarea>
                    </div>
                    <div class="form-check">
                        <label for="edit_show_status" class="edit_show_status checkbox form-check-label">
                            <input type="checkbox" class="form-check-input" data-toggle="checkbox" name="show_status" id="edit_show_status"  value="T"> Use
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
            "url": url_gb+"/admin/Categories/Lists",
            "data": function ( d ) {

            }
        },
        "columns": [
            { "data": "DT_Row_Index" , "className": "text-center", "searchable": false, "orderable": false  },
            {"data" : "name"},
            {"data" : "show_status","className":"action text-center"},
            { "data": "action","className":"action text-center" , "searchable" : false, "orderable": false}
        ]
    });
    $('body').on('click','.btn-add',function(data){
        resetFormCustom('#FormAdd');
        $('#add_photo').closest('#orak_add_photo').html('<div id="add_photo" orakuploader="on"></div>');
        $('#add_photo').orakuploader({
            orakuploader_path               : url_gb+'/',
            orakuploader_ckeditor           : false,
            orakuploader_use_dragndrop      : true,
            orakuploader_main_path          : 'uploads/temp/',
            orakuploader_thumbnail_path     : 'uploads/temp/',
            orakuploader_thumbnail_real_path: asset_gb+'uploads/temp/',
            orakuploader_add_image          : asset_gb+'images/add.png',
            orakuploader_loader_image       : asset_gb+'images/loader.gif',
            orakuploader_no_image           : asset_gb+'images/no-image.jpg',
            orakuploader_add_label          : 'เลือกรูปภาพ',
            orakuploader_use_rotation       : false,
            orakuploader_maximum_uploads    : 1,
            orakuploader_hide_on_exceed     : true,
            orakuploader_field_name         : 'photo',
            orakuploader_finished           : function(){

            }
        });
        $('.add_show_status').attr('class','add_show_status checkbox form-check-label checked');
        $('#add_show_status').prop('checked','checked');
        ShowModal('ModalAdd');
    });
    $('body').on('click','.btn-edit',function(data){
        var btn = $(this);
        btn.button('loading');
        var id = $(this).data('id');
        $('#edit_user_id').val(id);
        $.ajax({
            method : "GET",
            url : url_gb+"/admin/Categories/"+id,
            dataType : 'json'
        }).done(function(rec){
            $('#edit_name').val(rec.name);
            CKEDITOR.instances['edit_detail'].setData(rec.detail);
            $('#edit_photo').closest('#orak_edit_photo').html('<div id="edit_photo" orakuploader="on"></div>');
            $('#org_photo').val(rec.photo);
            if(rec.photo){
                var max_file = 0;
                var file = [];
                    file[0] = rec.photo;
                var photo = rec.photo;
            }else{
                var max_file = 1;
                var file = [];
                var photo = rec.photo;
            }
            $('#edit_photo').orakuploader({
                orakuploader_path               : url_gb+'/',
                orakuploader_ckeditor           : false,
                orakuploader_use_dragndrop      : true,
                orakuploader_main_path          : 'uploads/temp/',
                orakuploader_thumbnail_path     : 'uploads/temp/',
                orakuploader_thumbnail_real_path: asset_gb+'uploads/temp/',
                orakuploader_add_image          : asset_gb+'images/add.png',
                orakuploader_loader_image       : asset_gb+'images/loader.gif',
                orakuploader_no_image           : asset_gb+'images/no-image.jpg',
                orakuploader_add_label          : 'เลือกรูปภาพ',
                orakuploader_use_rotation       : false,
                orakuploader_maximum_uploads    : max_file,
                orakuploader_hide_on_exceed     : true,
                orakuploader_attach_images      : file,
                orakuploader_field_name         : 'photo',
                orakuploader_finished           : function(){

                }
            });
            $('#org_photo').val(photo);
            if(rec.show_status=='T'){
                $('.edit_show_status').attr('class','edit_show_status checkbox form-check-label checked');
                $('#edit_show_status').prop('checked','checked');
            }else{
                $('.edit_show_status').attr('class','edit_show_status checkbox form-check-label');
                $('#edit_show_status').removeAttr('checked');
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
            'name': 'required',
        },
        messages: {
            'name': 'Please insert.',
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
            if(CKEDITOR!==undefined){
                for ( instance in CKEDITOR.instances ){
                    CKEDITOR.instances[instance].updateElement();
                }
            }
            var btn = $(form).find('[type="submit"]');
            var data_ar = removePriceFormat(form,$(form).serializeArray());
            btn.button("loading");
            $.ajax({
                method : "POST",
                url : url_gb+"/admin/Categories",
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
            'name': 'required',
        },
        messages: {
            'name': 'Please insert.',
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
            if(CKEDITOR!==undefined){
                for ( instance in CKEDITOR.instances ){
                    CKEDITOR.instances[instance].updateElement();
                }
            }
            var btn = $(form).find('[type="submit"]');
            var id = $('#edit_user_id').val();
            btn.button("loading");
            $.ajax({
                method : "POST",
                url : url_gb+"/admin/Categories/"+id,
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
                url : url_gb+"/admin/Categories/Delete/"+id,
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

    CKEDITOR.replace('add_detail');
    CKEDITOR.replace('edit_detail');
</script>
@endsection
