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
							<h3>My Profile</h3>
							<div class="contact_form">
								<form method="post" action="#">
									<div class="row">
										<div class="col-xs-12 col-sm-7">
											<div class="form-group">
												<label>First Name <span class="error">*</span></label>
												<input type="text" class="form-control" name="name">
											</div>
										</div>
									</div><!--end row-->
									<div class="row">
										<div class="col-xs-12 col-sm-7">
											<div class="form-group">
												<label>Last Name <span class="error">*</span></label>
												<input type="text" class="form-control" name="name">
											</div>
										</div>
									</div><!--end row-->
									<div class="row">
										<div class="col-xs-12 col-sm-7">
											<div class="form-group">
												<label>Email <span class="error">*</span></label>
												<input type="text" class="form-control" name="name">
											</div>
										</div>
									</div><!--end row-->
									<div class="row">
										<div class="col-xs-12 col-sm-7">
											<div class="form-group">
												<label>Mobile <span class="error">*</span></label>
												<input type="text" class="form-control" name="name">
											</div>
										</div>
									</div><!--end row-->
									<input type="submit" value="Send Message" class="commonBtn">
								</form>
							</div>
						</div><!--end single content left-->
					</div>
					
					
				</div><!--end row-->
			</div>
		</div><!--end custom content-->


@endsection
@section('js_top')
@endsection
@section('js_bottom')
@endsection