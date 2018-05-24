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
							<h3>Article or Comments</h3>
							<p>** If less than 20 views in 7 days, this article or comments will be deleted.</p>
							<div class="contact_form">
								<form method="post" action="#">
									<div class="row">
										<div class="col-xs-12 col-sm-12">
											<div class="form-group">
												<label>Category <span class="error">*</span></label>
												<input type="text" class="form-control" name="name">
											</div>
										</div>
									</div><!--end row-->
									<div class="row">
										<div class="col-xs-12 col-sm-12">
											<div class="form-group">
												<label>Title <span class="error">*</span></label>
												<input type="text" class="form-control" name="name">
											</div>
										</div>
									</div><!--end row-->
									<div class="row">
										<div class="col-xs-12 col-sm-12">
											<div class="form-group">
												<label>Detail <span class="error">*</span></label>
												<div>
													<textarea>
													  <p style="text-align: center;">
													    <img title="TinyMCE Logo" src="//www.tinymce.com/images/glyph-tinymce@2x.png" alt="TinyMCE Logo" width="110" height="97" />
													  </p>

													  <h1 style="text-align: center;">Welcome to the TinyMCE editor demo!</h1>

													  <p>
													    Please try out the features provided in this basic example.<br>
													    Note that any <strong>MoxieManager</strong> file and image management functionality in this example is part of our commercial offering – the demo is to show the integration.
													  </p>

													  <h2>Got questions or need help?</h2>

													  <ul>
													    <li>Our <a href="https://www.tinymce.com/docs/">documentation</a> is a great resource for learning how to configure TinyMCE.</li>
													    <li>Have a specific question? Visit the <a href="https://community.tinymce.com/forum/" target="_blank">Community Forum</a>.</li>
													    <li>We also offer enterprise grade support as part of <a href="www.tinymce.com/pricing">TinyMCE Enterprise</a>.</li>
													  </ul>

													  <h2>A simple table to play with</h2>

													  <table style="text-align: center;">
													    <thead>
													      <tr>
													        <th>Product</th>
													        <th>Cost</th>
													        <th>Really?</th>
													      </tr>
													    </thead>
													    <tbody>
													      <tr>
													        <td>TinyMCE</td>
													        <td>Free</td>
													        <td>YES!</td>
													      </tr>
													      <tr>
													        <td>Plupload</td>
													        <td>Free</td>
													        <td>YES!</td>
													      </tr>
													    </tbody>
													  </table>

													  <h2>Found a bug?</h2>

													  <p>
													    If you think you have found a bug please create an issue on the <a href="https://github.com/tinymce/tinymce/issues">GitHub repo</a> to report it to the developers.
													  </p>

													  <h2>Finally ...</h2>

													  <p>
													    Don't forget to check out our other product <a href="http://www.plupload.com" target="_blank">Plupload</a>, your ultimate upload solution featuring HTML5 upload support.
													  </p>
													  <p>
													    Thanks for supporting TinyMCE! We hope it helps you and your users create great content.<br>All the best from the TinyMCE team.
													  </p>
													</textarea>
												</div>
											</div>
										</div>
									</div><!--end row-->
									<input type="submit" value="Post" class="commonBtn">
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