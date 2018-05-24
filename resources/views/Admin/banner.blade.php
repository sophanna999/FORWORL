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
                                        <th class="text-center">Name</th>
                                        <th class="text-center">Articles</th>
                                        <th class="text-center">Users</th>
                                        <th class="text-center">Countries</th>
                                        <th class="text-center">Categories</th>
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
<div class="modal" id="ModalAdd" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="FormAdd">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Add {{$title_page or 'New Data'}} Data</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">

                <div class="form-group">
                    <label for="add_photo">photo</label>
                    <div id="orak_add_photo">
                        <div id="add_photo" name="photo" orakuploader="on"></div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="add_name">name</label>
                    <input type="text" class="form-control" name="name" id="add_name" required="" placeholder="name">
                </div>
                <div class="form-group">
                    <label for="add_article_id">Articles</label>
                    <select name="article_id" class="select2 form-control" tabindex="-1" data-placeholder="Select articles" id="add_article_id" required="" >
                        <option value="">Select articles</option>
                        @foreach($Articles as $Article)
                        <option value="{{$Article->id}}">{{$Article->title}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="add_user_id">Users</label>
                    <select name="user_id" class="select2 form-control" tabindex="-1" data-placeholder="Select users" id="add_user_id" required="" >
                        <option value="">Select users</option>
                        @foreach($Users as $User)
                        <option value="{{$User->id}}">{{$User->firstname.' '.$User->lastname}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="add_country_id">Countries</label>
                    <select name="country_id" class="select2 form-control country_id" tabindex="-1" data-placeholder="Select countries" id="add_country_id" required="" >
                        <option value="">Select countries</option>
                        @foreach($Countriess as $Countries)
                        <option value="{{$Countries->id}}">{{$Countries->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="add_province_id">Provinces</label>
                    <select name="province_id" class="select2 form-control" tabindex="-1" data-placeholder="Select provinces" id="add_province_id" required="" >
                        <option value="">Select provinces</option>
                        @foreach($Provinces as $Province)
                        <option value="{{$Province->id}}">{{$Province->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="add_writer_id">Writers</label>
                    <select name="writer_id" class="select2 form-control" tabindex="-1" data-placeholder="Select writers" id="add_writer_id" required="" >
                        <option value="">Select writers</option>
                        @foreach($Users as $User)
                        <option value="{{$User->id}}">{{$User->firstname .' '. $User->lastname}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="add_category_id">Categories</label>
                    <select name="category_id" class="select2 form-control" tabindex="-1" data-placeholder="Select categories" id="add_category_id" required="" >
                        <option value="">Select categories</option>
                        @foreach($Categoriess as $Categories)
                        <option value="{{$Categories->id}}">{{$Categories->name}}</option>
                        @endforeach
                    </select>
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

<div class="modal" id="ModalEdit" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <input type="hidden" name="edit_user_id" id="edit_user">
            <form id="FormEdit">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Edit {{$title_page or 'New Data'}} Data</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">

                <input type="hidden" name="org_photo" id="org_photo">
                <div class="form-group">
                    <label for="edit_photo">Photo</label>
                    <div id="orak_edit_photo">
                        <div id="edit_photo" orakuploader="on"></div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="edit_name">Name</label>
                    <input type="text" class="form-control" name="name" id="edit_name" required="" placeholder="name">
                </div>

                <div class="form-group">
                    <label for="edit_article_id">Articles</label>
                    <select name="article_id" data-placeholder="Select article" tabindex="-1" class="select2 form-control" id="edit_article_id" required="" >
                        <option value="">Select articles</option>
                        @foreach($Articles as $Article)
                        <option value="{{$Article->id}}">{{$Article->title}}</option>
                        @endforeach
                    </select>
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
                    <label for="edit_country_id">Countries</label>
                    <select name="country_id" data-placeholder="Select countries" tabindex="-1" class="select2 form-control country_id" id="edit_country_id" required="" >
                        <option value="">Select countries</option>
                        @foreach($Countriess as $Countries)
                        <option value="{{$Countries->id}}">{{$Countries->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="edit_province_id">Provinces</label>
                    <select name="province_id" data-placeholder="Select provinces" tabindex="-1" class="select2 form-control" id="edit_province_id" required="" >
                        <option value="">Select provinces</option>
                        @foreach($Provinces as $Province)
                        <option value="{{$Province->id}}">{{$Province->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="edit_writer_id">Writers</label>
                    <select name="writer_id" data-placeholder="Select writers" tabindex="-1" class="select2 form-control" id="edit_writer_id" required="" >
                        <option value="">Select writers</option>
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
function getProvince(modal, province = null) {
var btn = $(this).find('[type="submit"]');
    var country_id = $('#'+modal).find('.country_id').val();
    if (country_id == '') {
        $('#'+modal).find('.country_id').parent().next().find('select').html('<option value="">Select province</option>');
    }else{
        $.ajax({
            method: "GET",
            url : url_gb+"/admin/GetProvince/"+country_id,
            dataType: "json"
        }).done(function(rec){
            var text = '';
            if (province==null) {
                text += '<option value="">Select provinces</option>\n';
            }
            $.each(rec, function(k,v) {
                text += '<option value="'+v.id+'">'+v.name+'</option>\n';
            });
            $('#'+modal).find('.country_id').parent().next().find('select').html(text);
            if (province != null) {
                $('#'+modal).find('.country_id').parent().next().find('select').find('option[value="'+province+'"]').attr('selected','selected');
            }
            $('#'+modal).find('.country_id').parent().next().find('select').select2();
        }).fail(function(){
            swal("system.system_alert","system.system_error","error");
            btn.button("reset");
        })
    }
}

$('.country_id').change(function(){
    getProvince($(this).closest('.modal')[0].id);
});
     var TableList = $('#TableList').dataTable({
        "ajax": {
            "url": url_gb+"/admin/Banner/Lists",
            "data": function ( d ) {
                //d.myKey = "myValue";
                // d.custom = $('#myInput').val();
                // etc
            }
        },
        "columns": [
            {"data": "DT_Row_Index", "className": "text-center", "orderable": false, "searchable": false},
            {"data" : "name"},
            {"data" : "article_id", "className":"text-center"},
            {"data" : "user_id", "className":"text-center"},
            {"data" : "country_id", "className":"text-center"},
            {"data" : "category_id", "className":"text-center"},
            {"data" : "banner_view_history_count", "className":"text-center","orderable": false, "searchable": false},
            { "data": "action","className":"action text-center" }
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
        $('#add_article_id').select2();
        $('#add_user_id').select2();
        $('#add_country_id').select2();
        $('#add_province_id').select2();
        $('#add_category_id').select2();
        $('#add_writer_id').select2();
        ShowModal('ModalAdd');
    });
    $('body').on('click','.btn-edit',function(data){
        document.getElementById("FormEdit").reset();
        var btn = $(this);
        btn.button('loading');
        var id = $(this).data('id');
        $('#edit_user').val(id);
        $.ajax({
            method : "GET",
            url : url_gb+"/admin/Banner/"+id,
            dataType : 'json'
        }).done(function(rec){
            $('#edit_article_id').val(rec.article_id);
            $('#edit_user_id').val(rec.user_id);
            $('#edit_country_id').val(rec.country_id);
            $('#edit_province_id').val(rec.province_id);
            $('#edit_writer_id').val(rec.writer_id);
            $('#edit_category_id').val(rec.category_id);
            getProvince('ModalEdit',rec.province_id);
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
                $('#edit_ban').prop('checked',false);
                // $('#edit_ban').removeAttr('checked');
            }
            $('#edit_name').val(rec.name);
            $('#edit_user_id').select2();
            $('#edit_article_id').select2();
            $('#edit_country_id').select2();
            $('#edit_province_id').select2();
            $('#edit_writer_id').select2();
            $('#edit_category_id').select2();
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
            orakuploader_add_label          : 'Select the picture',
            orakuploader_use_rotation       : false,
            orakuploader_maximum_uploads    : max_file,
            orakuploader_hide_on_exceed     : true,
            orakuploader_attach_images      : file,
            orakuploader_field_name         : 'photo',
            orakuploader_finished           : function(){

            }
        });
        $('#org_photo').val(photo)

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

            article_id: {
                required: true,
            },
            user_id: {
                required: true,
            },
            country_id: {
                required: true,
            },
            province_id: {
                required: true,
            },
            writer_id: {
                required: true,
            },
            category_id: {
                required: true,
            },
            name: {
                required: true,
            },
            'photo[]': {
                required: true,
            },
        },
        messages: {

            article_id: {
                required: "Please insert.",
            },
            user_id: {
                required: "Please insert.",
            },
            country_id: {
                required: "Please insert.",
            },
            province_id: {
                required: "Please insert.",
            },
            writer_id: {
                required: "Please insert.",
            },
            category_id: {
                required: "Please insert.",
            },
            name: {
                required: "Please insert.",
            },
            'photo[]': {
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
                url : url_gb+"/admin/Banner",
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

            article_id: {
                required: true,
            },
            user_id: {
                required: true,
            },
            country_id: {
                required: true,
            },
            province_id: {
                required: true,
            },
            writer_id: {
                required: true,
            },
            category_id: {
                required: true,
            },
            name: {
                required: true,
            },
        },
        messages: {

            article_id: {
                required: "Please insert.",
            },
            user_id: {
                required: "Please insert.",
            },
            country_id: {
                required: "Please insert.",
            },
            province_id: {
                required: "Please insert.",
            },
            writer_id: {
                required: "Please insert.",
            },
            category_id: {
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
                url : url_gb+"/admin/Banner/"+id,
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
                url : url_gb+"/admin/Banner/Delete/"+id,
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

    $('#add_article_id').select2();
    $('#add_user_id').select2();
    $('#add_country_id').select2();
    $('#add_province_id').select2();
    $('#add_category_id').select2();
    $('#add_writer_id').select2();
    $('#edit_article_id').select2();
    $('#edit_user_id').select2();
    $('#edit_country_id').select2();
    $('#edit_province_id').select2();
    $('#edit_writer_id').select2();
    $('#edit_category_id').select2();

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

</script>
@endsection
