@extends('template.template')
@section('css_top')
@endsection
@section('css_bottom')
@endsection
@section('body')
		<div class="custom_content custom">
			<div class="container large">
				<div class="row">
					<div class="col-xs-12 col-sm-6 col-sm-offset-3">
						<h3>Login</h3>
						<div class="single_content_left">
							<div class="contact_form">
								<form method="post" action="#">
									<div class="row">
										<div class="col-xs-12 col-sm-12">
											<div class="form-group">
												<label>Username <span class="error">*</span></label>
												<input type="text" class="form-control" name="email">
											</div>
										</div>
									</div><!--end row-->
									<div class="row">
										<div class="col-xs-12 col-sm-12">
											<div class="form-group">
												<label>Password <span class="error">*</span></label>
												<input type="password" class="form-control" name="email">
											</div>
										</div>
									</div><!--end row-->
									<button class="commonBtn">
										<i class="fa fa-user"></i> Register
									</button>
								</form>
							</div>  
						</div><!--end single content left-->
					
						<p class="hidden">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean consectetur ante volutpat sem aliquam lobortis. Mauris porta fermentum volutpat. Praesent est sapien, tincidunt vel arcu vitae, mattis sollicitudin lectus.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean consectetur ante volutpat sem aliquam lobortis. Mauris porta fermentum volutpat. Praesent est sapien, tincidunt vel arcu vitae, mattis sollicitudin lectus.Mauris porta fermentum volutpat. Praesent est sapien, tincidunt vel arcu vitae, mattis sollicitudin lectus.</p>
					</div>
				
					<div class="col-xs-12 col-sm-6">
					</div>
				</div><!--end row-->
			</div>
		</div><!--end custom content-->

@endsection
@section('js_top')
@endsection
@section('js_bottom')
@endsection