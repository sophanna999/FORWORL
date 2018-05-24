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
                                + เพิ่มข้อมูล
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
                                        <th>firstname</th>
                                        <th>lastname</th>
                                        <th>nickname</th>
                                        <th>mobile</th>
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
<div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="FormAdd">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">เพิ่ม {{$title_page or 'ข้อมูลใหม่'}}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">

                <div class="form-group">
                    <label for="add_firstname">firstname</label>
                    <input type="password" class="form-control" name="firstname" id="add_firstname"  placeholder="firstname">
                </div>

                <div class="form-group">
                    <label class="" >lastname</label>
                    @foreach($CrudPermissions as $CrudPermission)
                    <div class="form-check">
                        <label for="add_lastname-{{$CrudPermission->id}}" class="radio form-check-label">
                            <input type="radio" class="form-check-input" data-toggle="radio" name="lastname" id="add_lastname-{{$CrudPermission->id}}" value="{{$CrudPermission->id}}"  > {{$CrudPermission->id}}
                        </label>
                    </div>
                    @endforeach
                </div>

                <div class="form-check">
                    <label for="add_nickname" class="checkbox form-check-label">
                        <input type="checkbox" class="form-check-input" data-toggle="checkbox" name="nickname" id="add_nickname"  value="1" checked="checked"> nickname
                    </label>
                </div>

                <div class="form-group">
                    <label for="add_mobile">mobile</label>
                    <textarea class="form-control" name="mobile" id="add_mobile"  placeholder="mobile"></textarea>
                </div>

                <div class="form-group">
                    <label for="add_address">address</label>
                    <textarea id="add_address" name="address" class="form-control"></textarea>
                </div>

                <label for="add_amphur_id">amphur_id</label>
                <div class="input-group" data-date="{{date('Y-m-d')}}">
                    <input type="text" value="" readonly="readonly" class="form-control form_date" name="amphur_id" id="add_amphur_id"  placeholder="amphur_id">
                    <span class="input-group-addon remove_date_time"><i class="glyphicon glyphicon-remove icon-remove"></i></span>
                    <span class="input-group-addon trigger_date_time" for="add_amphur_id"><i class="glyphicon glyphicon-calendar icon-calendar"></i></span>
                </div>

                <label for="add_province_id">province_id</label>
                <div class="input-group" data-date="{{date('Y-m-d')}}">
                    <input type="text" value="" readonly="readonly" class="form-control form_date_time" name="province_id" id="add_province_id"  placeholder="province_id">
                    <span class="input-group-addon remove_date_time"><i class="glyphicon glyphicon-remove icon-remove"></i></span>
                    <span class="input-group-addon trigger_date_time" for="add_province_id"><i class="glyphicon glyphicon-calendar icon-calendar"></i></span>
                </div>

                <div class="form-group">
                    <label for="add_email">email</label>
                    <input type="text" class="form-control number-only" name="email" id="add_email"  placeholder="email">
                </div>

                <div class="form-group">
                    <label for="add_username">username</label>
                    <input type="text" class="form-control number-only price" name="username" id="add_username"  placeholder="username">
                </div>

                <div class="form-group">
                    <label for="add_remember_token">remember_token</label>
                    <input type="text" class="form-control" name="remember_token" id="add_remember_token"  placeholder="remember_token">
                </div>

                <div class="form-group">
                    <label for="add_created_at">created_at</label>
                    <select name="created_at" class="select2 form-control" tabindex="-1" data-placeholder="Select created_at" id="add_created_at"  >
                        <option value="">Select created_at</option>
                        @foreach($AdminMenus as $AdminMenu)
                        <option value="{{$AdminMenu->id}}">{{$AdminMenu->id}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="add_updated_at">updated_at</label>
                    <input type="text" class="form-control date-range" name="updated_at" id="add_updated_at"  placeholder="updated_at">
                </div>

                <div class="form-group">
                    <label for="add_photo_profile">photo_profile</label>
                    <input type="text" class="form-control date-time-range" name="photo_profile" id="add_photo_profile"  placeholder="photo_profile">
                </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">บันทึก</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="FormEdit">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">แก้ไขข้อมูล {{$title_page or 'ข้อมูลใหม่'}}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">

                <div class="form-group">
                    <label>lastname</label>
                    @foreach($CrudPermissions as $CrudPermission)
                    <div class="form-check">
                        <label for="edit_lastname-{{$CrudPermission->id}}" class="radio form-check-label" >
                            <input type="radio" class="form-check-input" data-toggle="radio" name="lastname" id="edit_lastname-{{$CrudPermission->id}}" value="{{$CrudPermission->id}}"  > {{$CrudPermission->id}}
                        </label>
                    </div>
                    @endforeach
                </div>

                <div class="form-check">
                    <label for="edit_nickname" class="checkbox form-check-label">
                        <input type="checkbox" class="form-check-input" data-toggle="checkbox" name="nickname" id="edit_nickname"  value="1"> nickname
                    </label>
                </div>

                <div class="form-group">
                    <label for="edit_mobile">mobile</label>
                    <textarea class="form-control" name="mobile" id="edit_mobile"  placeholder="mobile"></textarea>
                </div>

                <div class="form-group">
                    <label for="edit_address">address</label>
                    <textarea id="edit_address" name="address" class="form-control"></textarea>
                </div>

                <label for="edit_amphur_id">amphur_id</label>
                <div class="input-group" data-date="{{date('Y-m-d')}}">
                    <input type="text" value="" readonly="readonly" class="form-control form_date" name="amphur_id" id="edit_amphur_id"  placeholder="amphur_id">
                    <span class="input-group-addon remove_date_time"><i class="glyphicon glyphicon-remove icon-remove"></i></span>
                    <span class="input-group-addon trigger_date_time" for="edit_amphur_id"><i class="glyphicon glyphicon-calendar icon-calendar"></i></span>
                </div>

                <label for="edit_province_id">province_id</label>
                <div class="input-group" data-date="{{date('Y-m-d')}}">
                    <input type="text" value="" readonly="readonly" class="form-control form_date_time" name="province_id" id="edit_province_id"  placeholder="province_id">
                    <span class="input-group-addon remove_date_time"><i class="glyphicon glyphicon-remove icon-remove"></i></span>
                    <span class="input-group-addon trigger_date_time" for="edit_province_id"><i class="glyphicon glyphicon-calendar icon-calendar"></i></span>
                </div>

                <div class="form-group">
                    <label for="edit_email">email</label>
                    <input type="text" class="form-control number-only" name="email" id="edit_email"  placeholder="email">
                </div>

                <div class="form-group">
                    <label for="edit_username">username</label>
                    <input type="text" class="form-control number-only price" name="username" id="edit_username"  placeholder="username">
                </div>

                <div class="form-group">
                    <label for="edit_remember_token">remember_token</label>
                    <input type="text" class="form-control" name="remember_token" id="edit_remember_token"  placeholder="remember_token">
                </div>

                <div class="form-group">
                    <label for="edit_created_at">created_at</label>
                    <select name="created_at" data-placeholder="Select created_at" tabindex="-1" class="select2 form-control" id="edit_created_at"  >
                        <option value="">Select created_at</option>
                        @foreach($AdminMenus as $AdminMenu)
                        <option value="{{$AdminMenu->id}}">{{$AdminMenu->id}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="edit_updated_at">updated_at</label>
                    <input type="text" class="form-control date-range" name="updated_at" id="edit_updated_at"  placeholder="updated_at">
                </div>

                <div class="form-group">
                    <label for="edit_photo_profile">photo_profile</label>
                    <input type="text" class="form-control date-time-range" name="photo_profile" id="edit_photo_profile"  placeholder="photo_profile">
                </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">บันทึก</button>
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
            "url": url_gb+"/admin/Test/Lists",
            "data": function ( d ) {
                //d.myKey = "myValue";
                // d.custom = $('#myInput').val();
                // etc
            }
        },
        "columns": [
            {"data" : "firstname"},
            {"data" : "lastname"},
            {"data" : "nickname"},
            {"data" : "mobile"},
            { "data": "action","className":"action text-center" }
        ]
    });
    $('body').on('click','.btn-add',function(data){
        ShowModal('ModalAdd');
    });
    $('body').on('click','.btn-edit',function(data){
        var btn = $(this);
        btn.button('loading');
        var id = $(this).data('id');
        $('#edit_user_id').val(id);
        $.ajax({
            method : "GET",
            url : url_gb+"/admin/Test/"+id,
            dataType : 'json'
        }).done(function(rec){
            $('#edit_lastname-'+rec.lastname).prop('checked','checked');
            if(rec.nickname=='1'){
                $('#edit_nickname').prop('checked','checked');
            }else{
                $('#edit_nickname').removeAttr('checked');
            }
                                        $('#edit_mobile').val(rec.mobile);
            CKEDITOR.instances['edit_address'].setData(rec.address);
            $('#edit_amphur_id').val(rec.amphur_id);
            $('#edit_province_id').val(rec.province_id);
            $('#edit_email').val(rec.email);
            $('#edit_username').val(addNumformat(rec.username));
            $('#edit_remember_token').val(rec.remember_token);
            $('#edit_created_at').val(rec.created_at);
            $('#edit_updated_at').val(rec.updated_at);
            $('#edit_photo_profile').val(rec.photo_profile);

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

        },
        messages: {

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
                url : url_gb+"/admin/Test",
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

        },
        messages: {

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
                url : url_gb+"/admin/Test/"+id,
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
            title: "คุณต้องการลบสินค้าใช่หรือไม่",
            text: "หากคุณลบจะไม่สามารถุเรียกคืนข้อมูกลับมาได้",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "ใช่ ฉันต้องการลบ",
            cancelButtonText: "ยกเลิก",
            showLoaderOnConfirm: true,
            closeOnConfirm: false
        }, function(data) {
            if(data){
                $.ajax({
                    method : "POST",
                    url : url_gb+"/admin/Test/Delete/"+id,
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
            }
        });
    });

    CKEDITOR.replace('add_address');
    CKEDITOR.replace('edit_address');
$('#add_remember_token').select2({
            tags: []
        });$('#add_created_at').select2();
$('#edit_created_at').select2();

</script>
@endsection
