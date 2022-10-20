@if (session()->has('user_session'))
<html>

<head>
	<title>Admin panel</title>
	<link rel="stylesheet" href="http://localhost/adminPanel/resources/css/bootstrap.css">
	<link rel="stylesheet" href="http://localhost/adminPanel/resources/css/style.css">
	<link rel="stylesheet" href="http://localhost/adminPanel/resources/css/color.css">
    <link rel="stylesheet" href="http://localhost/adminPanel/resources/css/mybootstrap.css">
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
					<p class="text-left">This section displays the list of Pages.</p>
					<p class="bordered text-center" style="padding:3px">Click here to create
						<a href="addpage" style="text-decoration:underline; color:blue; font-size:12px">New Page</a>
					</p>
					<form method="post" action="{{url('search')}}">
						{{csrf_field()}}
						<table class="table1">
							<tr class="table-1-head">
								<td colspan="2" style="padding:8px 15px 8px 15px; background:#EBEBEB;border-bottom:1px solid">Search</td>
							</tr>
							<tr class="table-1-row">
								<td style="padding:8px 15px 8px 15px">Search By Page Name</td>
								<td>
									<input type="text" style="height:20px; width:180px" name="pagename">
									<input type="submit" class="srchbtn" style="margin-left:10px" name="srch" value="Search">
								</td>
							</tr>
							
						</table>
					</form>
					<p style="padding-top:20px">Page 1 of 2, showing 10 records out of 13 total, starting on record 1, ending on 10</p>
					<form method="post">
						{{csrf_field()}}
						<table class="table2">
							<thead>
								<tr>
									<th style="width:50px">Sr. No</th>
									<th>Page Name</th>
									<th>No. of Sub Pages</th>
									<th>Status</th>
									<th>Edit</th>
									<th style="width:100px">Delete</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($data as $data )
									
								<tr>
									<td>{{$data->id}}</td>
										<td>{{$data->name}}</td>
										<td>{{$data->content}}</td>
										<td>{{$data->status}}</td>
										<td><a href="{{'addpage/'.$data->id}}"><img src="./Images/edit.jpg"></a></td>
										<td><a href="{{'deletePage/'.$data->id}}">Delete</a></td>
										{{-- <td><input type="checkbox" name="deleteBox[]" value=""></td> --}}
								</tr>
									@endforeach
							</tbody>
						</table>
					</form>
				</section>

			</div>
	</aside>
	<div class="footer-line">
		<footer></footer>
	</div>

</body>

</html>


@else
	<h4>You need To login First</h4>
	<button><a href="index">Back</a></button>
@endif