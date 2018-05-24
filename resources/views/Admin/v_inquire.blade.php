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
                                            <th>Firstname</th>
                                            <th>Lastname</th>
                                            <th>Subject</th>
                                            <th>Phone</th>
                                            <th>Email</th>
                                            <th>Message</th>
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
@section('js_bottom')
<script src="{{asset('assets/global/plugins/orakuploader/orakuploader.js')}}"></script>
<script>
    var TableList = $('#TableList').dataTable({
        "ajax": {
            "url": url_gb+"/admin/Inquire/Lists",
            "data": function ( d ) {

            }
        },
        "columns": [
            { "data": "DT_Row_Index" , "className": "text-center", "searchable": false, "orderable": false },
            { "data": "firstname"},
            { "data": "lastname"},
            { "data": "subject"},
            { "data": "phone"},
            { "data": "email"},
            { "data": "message"},
            { "data": "show_status","className":"action text-center"},
            { "data": "action","className":"action text-center" , "searchable" : false, "orderable": false}
        ]
    });

    $('body').on('click','.btn-condensed',function(data){
        e.preventDefault();
        var btn = $(this);
        var id = btn.data('id');
        swal({
            title: "Do you want to confirm?",
            text: "If you confirm, status will change.",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#f3bb45",
            confirmButtonText: "Yes, I want to confirm",
            cancelButtonText: "Cancel",
            showLoaderOnConfirm: true,
        }).then(function() {
            $.ajax({
                method : "POST",
                url : url_gb+"/admin/Inquire/"+$(this).attr('data-id'),
                dataType : 'json',
                data : {
                    status : $(this).attr('data-stat')
                }
            }).done(function(rec){
                btn.button("reset");
                if(rec.status==1){
                    TableList.api().ajax.reload();
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
        }).catch(function(e){
            //console.log(e);
        });
    });
</script>
@endsection