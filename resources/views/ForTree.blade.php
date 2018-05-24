@extends('template.template')
@section('css_top')
@endsection
@section('css_bottom')
@endsection
@section('body')
		<div class="content_top clearfix">
			<div class="container">
				<div class="row">
					<div class="col-xs-12 col-sm-6">
						<div class="content_left features">
							<h1>For Tree</h1>
							<form class="form-inline">

								<div class="selectBox clearfix">
									<select name="guiest_id1" id="">
										<option value="0">Country</option>
										<option value="1">20</option>
										<option value="2">30</option>
										<option value="3">40</option>
										<option value="3">50</option>
										<option value="3">60</option>
									</select>
								</div><!-- selectBox -->

								<div class="selectBox clearfix">
									<select name="guiest_id1" id="">
										<option value="0">Province</option>
										<option value="1">20</option>
										<option value="2">30</option>
										<option value="3">40</option>
										<option value="3">50</option>
										<option value="3">60</option>
									</select>
								</div><!-- selectBox -->

							  <button type="submit" class="btn btn-default btn-block commonBtn"><i class="fa fa-search"></i> Search</button>
							</form>
							<br>
							<div class="post_right_inner">

									<div class="related_post_sec">
										<div class="list_block">
											<h3>Top 10 User </h3>
											<table class="table">
												<thead>
													<tr>
														<th>No</th>
														<th>Name</th>
														<th></th>
													</tr>
												</thead>
												<tbody>
													@for($i=1;$i<=10;$i++)
													<tr>
														<td>{{$i}}</td>
														<td>Mr. Donate{{$i}} Donate{{$i}}</td>
														<td>$ {{number_format(1000000/$i,2)}}</td>
													</tr>
													@endfor
												</tbody>
											</table>
										</div>
									</div><!--end related_post_sec-->

								</div>
						
						</div><!--end content left-->
					</div>
					<div class="col-xs-12 col-sm-6">
						<div class="post_right_inner">
							<div class="related_post_sec">
								<div class="list_block">
									<h3>For Tree All</h3>
									<div class="text-center">
										<h2 class="text-success">$ 10,000,000</h2>
									</div>
								</div>
							</div><!--end related_post_sec-->

						</div>
						<div class="post_right_inner">
							<div class="related_post_sec">
								<div class="list_block">
									<h3>Top 10 Country Donate</h3>
									<table class="table">
										<thead>
											<tr>
												<th>No</th>
												<th>Country</th>
												<th>Donate</th>
											</tr>
										</thead>
										<tbody>
											@for($i=1;$i<=10;$i++)
											<tr>
												<td>{{$i}}</td>
												<td>Country{{$i}}</td>
												<td>$ {{number_format(1000000/$i,2)}}</td>
											</tr>
											@endfor
										</tbody>
									</table>
								</div>
							</div><!--end related_post_sec-->

						</div>
					</div>
				</div><!--end row-->
			</div><!--end container-->
		</div><!--end content top-->

@endsection
@section('js_top')
@endsection
@section('js_bottom')
<script>
	$('select').selectbox();
</script>
@endsection