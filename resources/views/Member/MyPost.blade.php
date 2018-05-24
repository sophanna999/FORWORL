@extends('template.template')
@section('css_top')
@endsection
@section('css_bottom')
@endsection
@section('body')
		<div class="custom_content custom">
			<div class="container large">
				<div class="row">
					@include('Member.Sidebar')
					<div class="col-xs-12 col-sm-8 custom_right">
						<div class="single_content_left">
							<h3>My Post</h3>
							<table class="table table-bordered">
								<thead>
									<tr>
										<th>#</th>
										<th>Title</th>
										<th>View</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									@for($i=1;$i<=10;$i++)
									<tr>
										<td>{{$i}}</td>
										<td>What is Lorem Ipsum?</td>
										<td>{{number_format(rand(1,10000))}}</td>
										<td>
											<button class="btn btn-xs btn-warning"><i class="fa fa-edit"></i></button>
											<button class="btn btn-xs btn-success"><i class="fa fa-calendar"></i></button>
										</td>
									</tr>
									@endfor
								</tbody>
							</table>
						</div><!--end single content left-->
					</div>
				</div><!--end row-->
			</div>
		</div><!--end custom content-->


@endsection
@section('js_top')
@endsection
@section('js_bottom')
<script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
<script>

	tinymce.init({
	  selector: 'textarea',
	  height: 500,
	  menubar: false,
	  plugins: [
	    'advlist autolink lists link image charmap print preview anchor textcolor',
	    'searchreplace visualblocks code fullscreen',
	    'insertdatetime media table contextmenu paste code help wordcount'
	  ],
	  toolbar: 'insert | undo redo |  formatselect | bold italic backcolor  | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help',
	  content_css: [
	    '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
	    '//www.tinymce.com/css/codepen.min.css']
	});
</script>
@endsection