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
                                            <th>username</th>
                                            <th>name</th>
                                            <th>firstname</th>
                                            <th>lastname</th>
                                            <th>nickname</th>
                                            <th>mobile</th>
                                            <th>email</th>
                                            <th>province</th>
                                            <th>country</th>
                                            <th>money</th>
                                            <th>withdraw type</th>
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
<div class="modal" id="ModalAdd" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form id="FormAdd">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel"> {{$title_page or 'ข้อมูลใหม่'}}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label for="add_username">username</label>
                        <input type="text" class="form-control" name="username" id="add_username" required="" placeholder="username">
                    </div>

                    <div class="form-group">
                        <label for="add_email">email</label>
                        <input type="text" class="form-control" name="email" id="add_email" required="" placeholder="email">
                    </div>

                    <div class="form-group">
                        <label for="add_password">password</label>
                        <input type="password" class="form-control" name="password" id="add_password" required="" placeholder="password">
                    </div>
                    <div class="form-group">
                        <label for="add_firstname">firstname</label>
                        <input type="text" class="form-control" name="firstname" id="add_firstname" required="" placeholder="firstname">
                    </div>

                    <div class="form-group">
                        <label for="add_lastname">lastname</label>
                        <input type="text" class="form-control" name="lastname" id="add_lastname"  placeholder="lastname">
                    </div>

                    <div class="form-group">
                        <label for="add_nickname">nickname</label>
                        <input type="text" class="form-control" name="nickname" id="add_nickname"  placeholder="nickname">
                    </div>

                    <div class="form-group">
                        <label for="add_mobile">mobile</label>
                        <input type="text" class="form-control" name="mobile" id="add_mobile"  placeholder="mobile">
                    </div>

                    <div class="form-group">
                        <label for="add_country_id">country</label>
                        <select name="country_id" class="country_id select2 form-control" tabindex="-1" data-placeholder="Select country" id="add_country_id"  >
                            <option value="">Select country</option>
                            @foreach($Countriess as $Countries)
                            <option value="{{$Countries->id}}">{{$Countries->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="add_province_id">province</label>
                        <select name="province_id" class="province_id select2 form-control" tabindex="-1" data-placeholder="Select province" id="add_province_id"  >
                            <option value="">Select province_id</option>

                        </select>
                    </div>
                    <div class="form-group">
                        <label for="add_withdraw_id">withdraw</label>
                        <select name="withdraw_id" class="select2 form-control" tabindex="-1" data-placeholder="Select withdraw" id="add_withdraw_id"  >
                            <option value="">Select withdraw</option>
                            @foreach($Withdraws as $Withdraw)
                            <option value="{{$Withdraw->id}}">{{$Withdraw->name}}</option>
                            @endforeach
                        </select>
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
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <input type="hidden" name="edit_user_id" id="edit_user_id">
            <form id="FormEdit">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel"> {{$title_page or 'ข้อมูลใหม่'}}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label for="edit_username">username</label>
                        <input type="text" class="form-control" name="username" id="edit_username" required="" placeholder="username" disabled>
                    </div>

                    <div class="form-group">
                        <label for="edit_email">email</label>
                        <input type="text" class="form-control" name="email" id="edit_email" required="" placeholder="email" disabled>
                    </div>
                    <div class="form-group">
                        <label for="edit_firstname">firstname</label>
                        <input type="text" class="form-control" name="firstname" id="edit_firstname" required="" placeholder="firstname">
                    </div>

                    <div class="form-group">
                        <label for="edit_lastname">lastname</label>
                        <input type="text" class="form-control" name="lastname" id="edit_lastname"  placeholder="lastname">
                    </div>

                    <div class="form-group">
                        <label for="edit_nickname">nickname</label>
                        <input type="text" class="form-control" name="nickname" id="edit_nickname"  placeholder="nickname">
                    </div>

                    <div class="form-group">
                        <label for="edit_mobile">mobile</label>
                        <input type="text" class="form-control" name="mobile" id="edit_mobile"  placeholder="mobile">
                    </div>
                    <div class="form-group">
                        <label for="edit_country_id">country</label>
                        <select name="country_id" data-placeholder="Select country" tabindex="-1" class="country_id select2 form-control" id="edit_country_id"  >
                            <option value="">Select country</option>
                            @foreach($Countriess as $Countries)
                            <option value="{{$Countries->id}}">{{$Countries->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="edit_province_id">province</label>
                        <select name="province_id" data-placeholder="Select province" tabindex="-1" class="province_id select2 form-control" id="edit_province_id"  >
                            <option value="">Select province</option>

                        </select>
                    </div>

                    <div class="form-group">
                        <label for="edit_withdraw_id">withdraw</label>
                        <select name="withdraw_id" class="select2 form-control" tabindex="-1" data-placeholder="Select withdraw" id="edit_withdraw_id"  >
                            <option value="">Select withdraw</option>
                            @foreach($Withdraws as $Withdraw)
                            <option value="{{$Withdraw->id}}">{{$Withdraw->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-check">
                        <label for="edit_show_status" class="checkbox form-check-label">
                            <input type="checkbox" class="form-check-input" data-toggle="checkbox" name="show_status" id="edit_show_status" value="T"> Band
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
<div class="modal" id="ModalChangePassword" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="FormChangePassword">
            <input type="hidden" name="id" id="user_id">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Change password</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="password">New password</label>
                    <input type="text" class="form-control bg-gray-lighter" name="password" id="password" placeholder="New password">
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Save</button>
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
$(function() {
    // getProvince();
});
function getProvince(modal,province=null) {
    var country = $('#'+modal).find('.country_id').val();
    if(country=='') {
        $('#'+modal).find('.country_id').parent().next().find('select').html('<option value="">Select province</option>');
    } else {
        $.ajax({
            method : "GET",
            url : url_gb+"/admin/GetProvince/"+country,
            dataType : 'json'
        }).done(function(rec){
            var text = '<option value="">Select province</option>\n';

            $.each(rec, function(k,v) {
                text += '<option value="'+v.id+'">'+v.name+'</option>\n';
            });
            $('#'+modal).find('.country_id').parent().next().find('select').html(text);
            if(province!=null) {
                $('#'+modal).find('.country_id').parent().next().find('select').find('option[value="'+province+'"]').attr('selected','selected');
            }
            $('#'+modal).find('.country_id').parent().next().find('select').select2();
        }).fail(function(){
            swal("system.system_alert","system.system_error","error");
            btn.button("reset");
        });
    }
}
$('.country_id').change(function() {
    getProvince($(this).closest('.modal')[0].id);
});
var TableList = $('#TableList').dataTable({
    "ajax": {
        "url": url_gb+"/admin/Member/Lists",
        "data": function ( d ) {
            //d.myKey = "myValue";
            // d.custom = $('#myInput').val();
            // etc
        }
    },
    "columns": [
        {"data": "DT_Row_Index","name" : "DT_Row_Index", "orderable" : false, "searchable" :false},
        {"data" : "username"},
        {"data" : "name","name":"firstname", "searchable" : false},
        {"data" : "firstname","visible" : false},
        {"data" : "lastname","visible" : false},
        {"data" : "nickname","visible" : false},
        {"data" : "mobile"},
        {"data" : "email"},
        {"data" : "province_name", "name" : "provinces.name","visible" : false},
        {"data" : "country_name", "name" : "countries.name","visible" : false},
        {"data" : "money","visible" : false},
        {"data" : "withdraw_id","visible" : false},
        { "data": "action","className":"action text-center","searchable" : false, "orderable": false }
    ]
});
$('body').on('click','.btn-add',function(data){
    resetFormCustom('#FormAdd');
    ShowModal('ModalAdd');
});
$('body').on('click','.btn-edit',function(data){
    resetFormCustom('#FormEdit');
    var btn = $(this);
    btn.button('loading');
    var id = $(this).data('id');
    $('#edit_user_id').val(id);
    $.ajax({
        method : "GET",
        url : url_gb+"/admin/Member/"+id,
        dataType : 'json'
    }).done(function(rec){
        $('#edit_firstname').val(rec.firstname);
        $('#edit_lastname').val(rec.lastname);
        $('#edit_nickname').val(rec.nickname);
        $('#edit_mobile').val(rec.mobile);
        $('#edit_country_id').val(rec.country_id);
        getProvince('ModalEdit',rec.province_id);
        $('#edit_province_id').val(rec.province_id);
        $('#edit_username').val(rec.username);
        if(rec.show_status=='T'){
            $('#edit_show_status').parent().attr('class','checkbox form-check-label checked');
            $('#edit_show_status').prop('checked',true);
        }else{
            $('#edit_show_status').parent().attr('class','checkbox form-check-label');
            $('#edit_show_status').prop('checked',false);
        }
        $('#edit_email').val(rec.email);
        $('#edit_province_id').select2();
        $('#edit_country_id').select2();
        btn.button("reset");
        ShowModal('ModalEdit');
    }).fail(function(){
        swal("system.system_alert","system.system_error","error");
        btn.button("reset");
    });
});
$('body').on('click','.btn-change-password',function(data){
    resetFormCustom('#FormChangePassword');
    var id = $(this).data('id');
    $('#user_id').val(id);
    ShowModal('ModalChangePassword');
});

$('#FormAdd').validate({
    errorElement: 'div',
    errorClass: 'invalid-feedback',
    focusInvalid: false,
    rules: {
        firstname: {
            required: true,
        },
        lastname: {
            required: true,
        },
        username: {
            required: true,
        },
        email: {
            required: true,
        },
        mobile: {
            number: true,
            minlength: 10,
            maxlength: 10,
        },
        password: {
            required: true,
            minlength: 4,
            maxlength: 16,
        },
    },
    messages: {
        firstname: {
            required: "Please insert.",
        },
        lastname: {
            required: "Please insert.",
        },
        username: {
            required: "Please insert.",
        },
        email: {
            required: "Please insert.",
        },
        mobile: {
            number: "Number only",
            maxlength: "10 charecter only",
            minlength: "10 charecter only",
        },
        password: {
            required: "Please insert.",
            minlength: "Mininum on 4 charecter",
            maxlength: "Maximum on 16 charecter",
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
    url : url_gb+"/admin/Member",
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
        firstname: {
            required: true,
        },
        lastname: {
            required: true,
        },
        username: {
            required: true,
        },
        email: {
            required: true,
        },
        mobile: {
            number: true,
            minlength: 10,
            maxlength: 10,
        },
        password: {
            required: true,
            minlength: 4,
            maxlength: 16,
        },
        },
        messages: {
        firstname: {
            required: "Please insert.",
        },
        lastname: {
            required: "Please insert.",
        },
        username: {
            required: "Please insert.",
        },
        email: {
            required: "Please insert.",
        },
        mobile: {
            number: "Number only",
            maxlength: "10 charecter only",
            minlength: "10 charecter only",
        },
        password: {
            required: "Please insert.",
            minlength: "Mininum on 4 charecter",
            maxlength: "Maximum on 16 charecter",
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
    url : url_gb+"/admin/Member/"+id,
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
$('#FormChangePassword').validate({
    errorElement: 'span',
    errorClass: 'help-block',
    focusInvalid: false,
    rules: {
        password: {
            required: true,
            minlength: 4,
            maxlength: 16,
        },
    },
    messages: {
        password: {
            required: "Please insert.",
            minlength: "Mininum on 4 charecter",
            maxlength: "Maximum on 16 charecter",
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
        var id = $(this).data('id');
        // $('#user_id').val(id);
        btn.button("loading");
        $.ajax({
            method : "POST",
            url : url_gb+"/admin/Member/ChangePassword",
            dataType : 'json',
            data : $(form).serialize()
        }).done(function(rec){
            btn.button("reset");
            if(rec.status==1){
                resetFormCustom(form);
                swal(rec.title,rec.content,"success");
                $('#ModalChangePassword').modal('hide');
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
            url : url_gb+"/admin/Member/Delete/"+id,
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

$('#add_province_id').select2();
$('#add_country_id').select2();
$('#add_withdraw_id').select2();
$('#edit_province_id').select2();
$('#edit_country_id').select2();
$('#edit_withdraw_id').select2();

</script>
@endsection
