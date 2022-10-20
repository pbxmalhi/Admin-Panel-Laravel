@if (session()->has('user_session'))
<html>

<head>
	<title>Admin panel</title>
	<link rel="stylesheet" href="http://localhost/adminPanel/resources/css/bootstrap.css">
	<link rel="stylesheet" href="http://localhost/adminPanel/resources/css/style.css">
	<link rel="stylesheet" href="http://localhost/adminPanel/resources/css/color.css">
    <link rel="stylesheet" href="http://localhost/adminPanel/resources/css/mybootstrap.css">
	<script src="js/tinymce/tinymce.min.js"></script>
	<script>
		tinymce.init({
			selector: '.tinymce'
		});
	</script>
</head>

<body>
	<?php
	include("header.php");
	?>
	</div>
	<div class="col-md-12" style="background:#1C5978">
		<div class="container">
			<div class="col-md-3">
				<p style="color:white; font-weight:bold; font-family:arial; font-size:12px; margin:7px 0px; float:left; letter-spacing:1; word-spacing:3"><?php echo date('l, d-m-y') ?></p>
			</div>
		</div>
	</div>
	<aside>
		<div class="container ">
			<?php
			include("sidemenu.php")
			?>
			<div class="col-md-10 main-section">
				<section>
					<h3 style="font-size:16px; font-weight:bold; color:#1C5978; text-align:left;margin-left:0px;">Page Manager</h3>
					<hr style="margin:0px; width:600px; margin-bottom:10px" />
					<!--font: font-style font-variant font-weight font-size/line-height font-family -->
					<div style=" background:#F3F1F1;border:1px solid silver; font: bold 13px/13px arial ;padding:5px 0px 5px 15px ">Add Page</div>
					<div>
						<form method="post" action="{{url(isset($data) ? 'page_update/'.$data[0]->id : 'page_save')}}">
							{{csrf_field()}}
							<input type="hidden" name="editid" value="">
							<table class="addpage-table">
								<tr>
									<td style="width:250px; text-align:right">Name<span style="color:red">*</span></td>
									<td>
										<input type="text" name="name" style="width:200px" value='{{isset($data[0]->name) ? $data[0]->name : ""}}'>
									</td>
								</tr>
								<tr>
									<td style="width:250px; text-align:right">Content</td>
									<td>
										<textarea name="content" class="tinymce" style="height:200px">{{isset($data[0]->content) ? $data[0]->content : ""}}</textarea>
									</td>
								</tr>
								<tr>
									<td style="width:250px; text-align:right">Status</td>
									<td>
										@if (isset($data[0]->status) && $data[0]->status == 1)
										<input checked type="checkbox" name="status" style="width:50px; margin-right:20px">
										@else
										<input type="checkbox" name="status" style="width:50px; margin-right:20px">
										@endif
									</td>
								</tr>
								<tr>
									<td colspan="2">
										<div style="padding-left:25%"><input type="submit" value='{{isset($data[0]->status) ? "Update" : "Save"}}' name="save" class="savebtn">
											&nbsp;&nbsp;
											<a href="#" class="cnclbtn">Cancel</a>
									</td>
								</tr>
							</table>
						</form>
					</div>
				</section>

			</div>
	</aside>
	<div class="footer-line" style="margin-top:15px">
		<footer></footer>
	</div>

</body>

</html>
@else
	<h4>You need To login First</h4>
	<button><a href="index">Back</a></button>
@endif