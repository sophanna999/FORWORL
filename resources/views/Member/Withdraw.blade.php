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
					<div class="col-xs-12 col-sm-8">
						<div class="row">
							<div class="col-sm-6 col-xs-12">
								<div class="post_right_inner">

									<div class="related_post_sec">
										<div class="list_block">
											<h3>Your Balance</h3>
											<div class="text-center">
												<h2>$ {{number_format(rand(1,10000))}}.{{number_format(rand(1,10))}}</h2>
											</div>
										</div>
									</div><!--end related_post_sec-->

								</div>
							</div><div class="col-sm-6 col-xs-12">
								<div class="post_right_inner">

									<div class="related_post_sec">
										<div class="list_block">
											<h3>Money Cut Off</h3>
											
												<form class="form-inline">
												  <div class="selectBox clearfix">
													  <select name="guiest_id1" id="guiest_id1">
														  <option value="0">10</option>
														  <option value="1">20</option>
														  <option value="2">30</option>
														  <option value="3">40</option>
														  <option value="3">50</option>
														  <option value="3">60</option>
													  </select>
													</div><!-- selectBox -->

												  <button type="submit" class="btn btn-default btn-block commonBtn"><i class="fa fa-save"></i> Save</button>
												</form>
											
										</div>
									</div><!--end related_post_sec-->

								</div>
							</div>
						</div>
						
						<div class="single_content_left">
							<h3>Withdraw History</h3>
							<table class="table table-bordered">
								<thead>
									<tr>
										<th>#</th>
										<th>Date</th>
										<th>Balance</th>
										<th>Status</th>
									</tr>
								</thead>
								<tbody>
									@for($i=1;$i<=10;$i++)
									<tr>
										<td>{{$i}}</td>
										<td>{{ date('Y-m-d H:i',strtotime('-'.$i.' day')) }}</td>
										<td>{{number_format(rand(1,10000))}}</td>
										<td>
											Approve
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
	$('select').selectbox();
</script>
@endsection