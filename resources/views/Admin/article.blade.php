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
                                + Add New Data
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
                                        <th class="text-center">No.</th>
                                        <th class="text-center">Users</th>
                                        <th class="text-center">firstname</th>
                                        <th class="text-center">lastname</th>
                                        <th class="text-center">Categories</th>
                                        <th class="text-center">Title</th>
                                        <th class="text-center">Detail</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Bands</th>
                                        <th class="text-center">Countries</th>
                                        <th class="text-center">View</th>
                                        <th></th>
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
                    <h4 class="modal-title" id="myModalLabel">Add {{$title_page or 'New Data'}} Data</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">

                <div class="form-group">
                    <label for="add_photo">Photo</label>
                    <div id="orak_add_photo">
                        <div id="add_photo" name="photo" orakuploader="on"></div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="add_user_id">Users</label>
                    <select name="user_id" class="select2 form-control" tabindex="-1" data-placeholder="Select user name" id="add_user_id" required="" >
                        <option value="">Select users</option>
                        @foreach($Users as $User)
                        <option value="{{$User->id}}">{{$User->firstname.' '. $User->lastname}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="add_category_id">Categories</label>
                    <select name="category_id" class="select2 form-control" tabindex="-1" data-placeholder="Select Categories" id="add_category_id" required="" >
                        <option value="">Select Categories</option>
                        @foreach($Categoriess as $Categories)
                        <option value="{{$Categories->id}}">{{$Categories->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="add_title">Title</label>
                    <input type="text" class="form-control" name="title" id="add_title" required="" placeholder="title">
                </div>

                <div class="form-group">
                    <label for="add_detail">Detail</label>
                    <textarea id="add_detail" name="detail" class="form-control"></textarea>
                </div>

                <div class="form-check">
                    <label for="add_show_status" class="checkbox form-check-label">
                        <input type="checkbox" class="form-check-input" data-toggle="checkbox" name="show_status" id="add_show_status" required="" value="T" checked="checked"> Use
                    </label>
                </div>
                <!-- <div class="form-check">
                    <label for="add_ban" class="checkbox form-check-label">
                        <input type="checkbox" class="form-check-input" data-toggle="checkbox" name="ban" id="add_ban" required="" value="T" checked="checked"> ban
                    </label>
                </div> -->

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
            <input type="hidden" name="edit_user_id" id="edit_user">
            <form id="FormEdit">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Update {{$title_page or 'New Data'}} Data</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">

                <input type="hidden" name="org_photo" id="org_photo">
                <div class="form-group">
                    <label for="edit_photo">Photo</label>
                    <div id="orak_edit_photo">
                        <div id="edit_photo" name="photo" orakuploader="on"></div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="edit_user_id">Users</label>
                    <select name="user_id" data-placeholder="Select users" tabindex="-1" class="select2 form-control" id="edit_user_id" required="" >
                        <option value="">Select users</option>
                        @foreach($Users as $User)
                        <option value="{{$User->id}}">{{$User->firstname.' '.$User->lastname}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="edit_category_id">Categories</label>
                    <select name="category_id" data-placeholder="Select categories" tabindex="-1" class="select2 form-control" id="edit_category_id" required="" >
                        <option value="">Select categories</option>
                        @foreach($Categoriess as $Categories)
                        <option value="{{$Categories->id}}">{{$Categories->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="edit_title">Title</label>
                    <input type="text" class="form-control" name="title" id="edit_title" required="" placeholder="title">
                </div>

                <div class="form-group">
                    <label for="edit_detail">Detail</label>
                    <textarea id="edit_detail" name="detail" class="form-control"></textarea>
                </div>

                <div class="form-check">
                    <label for="edit_show_status" class="edit_show_status checkbox form-check-label">
                        <input type="checkbox" class="form-check-input" data-toggle="checkbox" name="show_status" id="edit_show_status" required="" value="T"> Use
                    </label>
                </div>
                <div class="form-check">
                    <label for="edit_ban" class="edit_ban checkbox form-check-label">
                        <input type="checkbox" class="form-check-input" data-toggle="checkbox" name="ban" id="edit_ban" required="" value="T"> Band
                    </label>
                </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
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
            "url": url_gb+"/admin/Article/Lists",
            "data": function ( d ) {
                //d.myKey = "myValue";
                // d.custom = $('#myInput').val();
                // etc
            }
        },
        "columns": [
            {"data": "DT_Row_Index", "className": "text-center", "orderable": false, "searchable": false},
            {"data" : "user_id", "className":"text-center" },
            {"data" : "firstname", "name":"users.firstname", "visible":false},
            {"data" : "lastname", "name":"users.lastname","visible":false},
            {"data" : "cate_name" ,"name":"categories.name", "className":"text-center"},
            {"data" : "title"},
            {"data" : "detail", "visible":false,"searchable": false},
            {"data" : "show_status" , "className":"text-center"},
            {"data" : "ban" , "className":"text-center"},
            {"data" : "country_code" , "className":"text-center"},
            {"data" : "article_view_history_count" , "className":"text-center", "orderable": false, "searchable": false},
            { "data": "action","className":"action text-center", "orderable": false, "searchable": false }
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
        $('#add_user_id').select2();
        $('#add_category_id').select2();
        ShowModal('ModalAdd');
    });
    $('body').on('click','.btn-edit',function(data){
        document.getElementById("FormEdit").reset();
        var btn = $(this);
        btn.button('loading');
        var id = $(this).data('id');
        var user_id = $('#edit_user').val(id);
        $.ajax({
            method : "GET",
            url : url_gb+"/admin/Article/"+id,
            dataType : 'json'
        }).done(function(rec){
            // $('#edit_user_id').val(rec.user_id);
            $('#edit_category_id').val(rec.category_id);
            $('#edit_title').val(rec.title);
            CKEDITOR.instances['edit_detail'].setData(rec.detail);
            $('#edit_user_id').val(rec.user_id);
            $('#edit_user_id').select2();
            $('#edit_category_id').select2();
            if(rec.show_status=='T'){
                $('#edit_show_status').parent().attr('class','checkbox form-check-label checked');
                $('#edit_show_status').prop('checked',true);
            }else{
                $('#edit_show_status').parent().attr('class','checkbox form-check-label');
                $('#edit_show_status').prop('checked',false);
            }
            if(rec.ban == "T"){
                $('.edit_ban').attr('class','edit_ban checkbox form-check-label checked');
                $('#edit_ban').attr('checked',true);
            }else{
                $('.edit_ban').attr('class','edit_ban checkbox form-check-label');
                $('#edit_ban').removeAttr('checked');
            }
            $('#edit_photo').closest('#orak_edit_photo').html('<div id="edit_photo" orakuploader="on"></div>');
        $('#org_photo').val(rec.photo);
        if(rec.photo){
            var max_file = 0;
            var file     = [];
                file[0] = rec.photo;
            var photo = rec.photo;
        }else{
            var max_file = 1;
            var file     = [];
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
        $('#org_photo').val(photo)
            if(rec.ban=='T'){
                $('#edit_ban').prop('checked','checked');
            }else{
                $('#edit_ban').removeAttr('checked');
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

            user_id: {
                required: true,
            },
            category_id: {
                required: true,
            },
            title: {
                required: true,
            },
            detail: {
                required: true,
            },
            show_status: {
                required: true,
            },
            'photo[]': {
                required: true,
            },
            ban: {
                required: true,
            },
        },
        messages: {

            user_id: {
                required: "Please insert.",
            },
            category_id: {
                required: "Please insert.",
            },
            title: {
                required: "Please insert.",
            },
            detail: {
                required: "Please insert.",
            },
            show_status: {
                required: "Please insert.",
            },
            'photo[]': {
                required: "Please insert.",
            },
            ban: {
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
                url : url_gb+"/admin/Article",
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

            user_id: {
                required: true,
            },
            category_id: {
                required: true,
            },
            title: {
                required: true,
            },
            detail: {
                required: true,
            },
            show_status: {
                required: true,
            },
            'photo[]': {
                required: true,
            },
            ban: {
                required: true,
            },
        },
        messages: {

            user_id: {
                required: "Please insert.",
            },
            category_id: {
                required: "Please insert.",
            },
            title: {
                required: "Please insert.",
            },
            detail: {
                required: "Please insert.",
            },
            show_status: {
                required: "Please insert.",
            },
            'photo[]': {
                required: "Please insert.",
            },
            ban: {
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

            if(CKEDITOR!==undefined){
                for ( instance in CKEDITOR.instances ){
                    CKEDITOR.instances[instance].updateElement();
                }
            }

            var btn = $(form).find('[type="submit"]');
            var id = $('#edit_user').val();
            btn.button("loading");
            $.ajax({
                method : "POST",
                url : url_gb+"/admin/Article/"+id,
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
                url : url_gb+"/admin/Article/Delete/"+id,
                data : {ID : id}
            }).done(function(rec){
                if(rec.status==1){
                    swal(rec.title,rec.content,"success");
                    TableList.api().ajax.reload();
                }else{
                    swal("System Error","Contact to administrator please","error");
                }
            }).fail(function(data){
                swal("System Error","Contact to administrator please","error");
            });
        }).catch(function(e){
            //console.log(e);
        });
    });

    $('#add_user_id').select2();
    $('#add_category_id').select2();
    $('#edit_user_id').select2();
    $('#edit_category_id').select2();
    CKEDITOR.replace('add_detail');
    CKEDITOR.replace('edit_detail');
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
    orakuploader_add_label          : 'Select the picture',
    orakuploader_use_rotation       : false,
    orakuploader_maximum_uploads    : 1,
    orakuploader_hide_on_exceed     : true,
    orakuploader_field_name         : 'photo',
    orakuploader_finished           : function(){

    }
});


</script>
@endsection
