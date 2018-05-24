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
                                            <th>main_menu_id</th>
                                            <th>name</th>
                                            <th>icon</th>
                                            <th>link</th>
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

<!-- Modal -->
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
                    <label for="add_main_menu_id">main_menu_id</label>
                    <div class="select">
                        <select name="main_menu_id" class="select2 form-control" tabindex="-1" data-placeholder="Select main_menu_id" id="add_main_menu_id"  >
                            <option value="0">Select main_menu_id</option>
                            @foreach($AdminMenus as $AdminMenu)
                            <option value="{{$AdminMenu->id}}">{{$AdminMenu->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
        
                <div class="form-group">
                    <label for="add_name">name</label>
                    <input type="text" class="form-control" name="name" id="add_name"  placeholder="name">
                </div>
        
                <div class="form-group">
                    <label for="add_icon">icon</label>
                    <input type="text" class="form-control" name="icon" id="add_icon"  placeholder="icon">
                </div>
        
                <div class="form-group">
                    <label for="add_link">link</label>
                    <input type="text" class="form-control" name="link" id="add_link"  placeholder="link">
                </div>
        
                <div class="form-group">
                    <label for="add_sort_id">sort_id</label>
                    <input type="text" class="form-control number-only" name="sort_id" id="add_sort_id"  placeholder="sort_id">
                </div>
        
                <div class="checkbox form-check-label">
                    <label for="add_show" class="checkbox form-check-label" >
                        <input type="checkbox" class="form-check-input" data-toggle="checkbox" name="show" id="add_show" checked=""  value="T"> show
                    </label>
                </div>
        
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">ปิด</button>
                <button type="submit" class="btn btn-primary">บันทึกข้อมูล</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <input type="hidden" name="edit_user_id" id="edit_user_id">
            <form id="FormEdit">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">แก้ไขข้อมูล {{$title_page or 'ข้อมูลใหม่'}}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
            <div class="modal-body">
                
                <div class="form-group">
                    <label for="edit_main_menu_id">main_menu_id</label>
                    <div class="select">
                        <select name="main_menu_id" data-placeholder="Select main_menu_id" tabindex="-1" class="select2 form-control" id="edit_main_menu_id"  >
                            <option value="0">Select main_menu_id</option>
                            @foreach($AdminMenus as $AdminMenu)
                            <option value="{{$AdminMenu->id}}">{{$AdminMenu->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
        
                <div class="form-group">
                    <label for="edit_name">name</label>
                    <input type="text" class="form-control" name="name" id="edit_name"  placeholder="name">
                </div>
        
                <div class="form-group">
                    <label for="edit_icon">icon</label>
                    <input type="text" class="form-control" name="icon" id="edit_icon"  placeholder="icon">
                </div>
        
                <div class="form-group">
                    <label for="edit_link">link</label>
                    <input type="text" class="form-control" name="link" id="edit_link"  placeholder="link">
                </div>
        
                <div class="form-group">
                    <label for="edit_sort_id">sort_id</label>
                    <input type="text" class="form-control number-only" name="sort_id" id="edit_sort_id"  placeholder="sort_id">
                </div>
        
                <div class="form-check">
                    <label for="edit_show" class="checkbox form-check-label">
                        <input type="checkbox" class="form-check-input" data-toggle="checkbox" name="show" id="edit_show"  value="T"> show
                    </label>
                </div>
        
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> บันทึก</button>
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
            "url": url_gb+"/admin/Menu/Lists",
            "data": function ( d ) {
                //d.myKey = "myValue";
                // d.custom = $('#myInput').val();
                // etc
            }
        },
        "columns": [
            {"data" : "main_menu_id"},
            {"data" : "name"},
            {"data" : "icon"},
            {"data" : "link"},
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
            url : url_gb+"/admin/Menu/"+id,
            dataType : 'json'
        }).done(function(rec){
            $('#edit_main_menu_id').val(rec.main_menu_id).trigger("change");
            $('#edit_name').val(rec.name);
            $('#edit_icon').val(rec.icon);
            $('#edit_link').val(rec.link);
            $('#edit_sort_id').val(rec.sort_id);
            if(rec.show=='T'){
                $('#edit_show').prop('checked','checked');
            }else{
                $('#edit_show').removeAttr('checked');
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
                url : url_gb+"/admin/Menu",
                dataType : 'json',
                data : data_ar
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
            if(CKEDITOR!==undefined){
                for ( instance in CKEDITOR.instances ){
                    CKEDITOR.instances[instance].updateElement();
                }
            }
            var data_ar = removePriceFormat(form,$(form).serializeArray());
            var btn = $(form).find('[type="submit"]');
            var id = $('#edit_user_id').val();
            btn.button("loading");
            $.ajax({
                method : "POST",
                url : url_gb+"/admin/Menu/"+id,
                dataType : 'json',
                data : data_ar
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
                url : url_gb+"/admin/Menu/Delete/"+id,
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
        }, function(dismiss) {
          console.log('Cancel');
        });
    });

    $('#add_main_menu_id').select2();
$('#edit_main_menu_id').select2();

</script>
@endsection