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
                        <form id="Form">
                            <input type="hidden" name="id" id="id" value="{{$contact[0]->id}}">
                            <h4 class="modal-title" id="myModalLabel"> {{$title_page}}</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <div class="form-group">
                                <label for="name">Address</label>
                                <textarea type="text" class="form-control" name="address" id="address">{{$contact[0]->address}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="text" class="form-control" name="phone" id="phone" value="{{$contact[0]->phone}}">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email" id="email" value="{{$contact[0]->email}}">
                            </div>
                            <!-- Orak photo -->
                            <!-- <input type="hidden" name="org_photo" id="org_photo">
                            <div class="form-group">
                                <label for="photo">Photo</label>
                                <div id="orak_photo">
                                    <div id="photo" orakuploader="on"></div>
                                </div>
                            </div> -->
                            <div class="form-group">
                                <label for="latitude">Latitude</label>
                                <input type="text" class="form-control" name="latitude" id="latitude" value="{{$contact[0]->latitude}}">
                            </div>
                            <div class="form-group">
                                <label for="longitude">Longitude</label>
                                <input type="text" class="form-control" name="longitude" id="longitude" value="{{$contact[0]->longitude}}">
                            </div>
                            <button type="submit" class="btn btn-primary text-right">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js_bottom')
<script src="{{asset('assets/global/plugins/orakuploader/orakuploader.js')}}"></script>
<script>
    // if("{{$contact[0]->photo}}"){
    //     var max_file = 0;
    //     var file = [];
    //         file[0] = "{{$contact[0]->photo}}";
    //     var photo = "{{$contact[0]->photo}}";
    // }else{
    //     var max_file = 1;
    //     var file = [];
    //     var photo = "{{$contact[0]->photo}}";
    // }
    // $('#photo').orakuploader({
    //     orakuploader_path               : url_gb+'/',
    //     orakuploader_ckeditor           : false,
    //     orakuploader_use_dragndrop      : true,
    //     orakuploader_main_path          : 'uploads/temp/',
    //     orakuploader_thumbnail_path     : 'uploads/temp/',
    //     orakuploader_thumbnail_real_path: asset_gb+'uploads/temp/',
    //     orakuploader_add_image          : asset_gb+'images/add.png',
    //     orakuploader_loader_image       : asset_gb+'images/loader.gif',
    //     orakuploader_no_image           : asset_gb+'images/no-image.jpg',
    //     orakuploader_add_label          : 'เลือกรูปภาพ',
    //     orakuploader_use_rotation       : false,
    //     orakuploader_maximum_uploads    : max_file,
    //     orakuploader_hide_on_exceed     : true,
    //     orakuploader_attach_images      : file,
    //     orakuploader_field_name         : 'photo',
    //     orakuploader_finished           : function(){

    //     }
    // });
    // $('#org_photo').val(photo);

    $('#Form').validate({
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
            var url = $('#id').val() !== "" && $('#id').val() !== null ? url_gb+"/admin/Contact/"+$('#id').val() : url_gb+"/admin/Contact" ;
            var btn = $(form).find('[type="submit"]');
            var data_ar = removePriceFormat(form,$(form).serializeArray());
            btn.button("loading");
            $.ajax({
                method : "POST",
                url : url,
                dataType : 'json',
                data : $(form).serialize()
            }).done(function(rec){
                btn.button("reset");
                if(rec.status==1){
                    swal(rec.title,rec.content,"success");
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
</script>
@endsection