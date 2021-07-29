<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1>DataTables</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active">DataTables</li>
					</ol>
				</div>
			</div>
		</div><!-- /.container-fluid -->
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-header">
							<h3 class="card-title">Master User</h3>
						</div>
						<!-- table input value -->
						<!-- /.card-header -->
						<div class="card-body" id="contents-edit">
                            <p>Password automatic created (Username + ID)</p>
							<div class="form-row">
								<div class="col-md-1 mb-0">
									<label for="validationCustom01">ID</label>
								</div>
								<div class="col-md-2 mb-0">
									<label for="validationCustom02">Username</label>
								</div>
								<div class="col-md-1 mb-0">
									<label for="validationCustom03">Role</label>
								</div>
								<div class="col-md-2 mb-0">
									<label for="validationCustom04">Full Name</label>
								</div>
								<div class="col-md-1 mb-0">
									<label for="validationCustom05">Gender</label>
								</div>
								<div class="col-md-2 mb-0">
									<label for="validationCustom06">Telepon</label>
								</div>
								<div class="col-md-3 mb-0">
									<label for="validationCustom07">Address</label>
								</div>
							</div>
							<form class="needs-validation" role="form" method="post" enctype="multipart/form-data"
								id="addFormItem" novalidate>
								<div id="dynamic_field">
									<div class="form-row">
										<div class="data" id="contents-token">
											<!-- this for token Csrf -->
										</div>
										<div class="col-md-1 mb-2">
											<input type="text" class="form-control txt_itemid" id="validationCustom01"
												placeholder="ID User" value="<?= $generateID ?>" readonly="readonly" name="ID_User">
										</div>
										<div class="col-md-2 mb-2">
											<input type="text" class="form-control" id="validationCustom02"
												placeholder="Username" required name="Username">
										</div>
										<div class="col-md-1 mb-2">
											<select class="form-control" id="validationCustom03" required
												name="Role">
												<option value="" selected>--SELECT--</option>
												<option value="Admin">Admin</option>
												<option value="User">User</option>
											</select>
										</div>
										<div class="col-md-2 mb-2">
											<input type="text" class="form-control" id="validationCustom04"
												placeholder="Full Name" required name="Full_Name">
										</div>
										<div class="col-md-1 mb-2">
											<select class="form-control" id="validationCustom05" required
												name="Gender">
												<option value="" selected>--SELECT--</option>
												<option value="P">Male</option>
												<option value="W">Female</option>
											</select>
										</div>
										<div class="col-md-2 mb-2">
											<input type="number" class="form-control" id="validationCustom06"
												placeholder="Telepon" required name="Telepon">
										</div>
										<div class="col-md-3 mb-2">
											<input type="text" class="form-control" id="validationCustom07"
												placeholder="Address" required name="Address">
										</div>
									</div>
								</div>
								<button class="btn btn-primary mt-2 mb-2 inputItem" type="submit">Save Item</button>
							</form>
						</div>
						<!-- /.card-body -->
						<!-- /.card-header -->
						<div class="card-body">
							<table id="example1" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th></th>
										<th>ID</th>
										<th>Username</th>
										<th>Last Login</th>
										<th>Role</th>
										<th>Full Name</th>
										<th>Gender</th>
										<th>Telepon</th>
										<th>Address</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
									<?php
                                    $i=0;
                                    foreach ($getMaster as $a):
                                    ?>
									<tr>
										<td><?= str_pad(++$i, 2, "0", STR_PAD_LEFT) ?></td>
										<td><?= $a->id_user?></td>
										<td><?= $a->username?></td>
										<td><?= $a->last_login?></td>
										<td><?= ($a->role === 'A') ? 'Admin' : 'User' ?></td>
										<td><?= $a->full_name?></td>
										<td><?= ($a->gender === 'P') ? 'Male' : 'Female' ?></td>
										<td><?= $a->telp?></td>
										<td><?= $a->address?></td>
										<td>
                                            <a href="#"
                                                class="text-secondary font-weight-bold text-xs ClassEditModal"
                                                ddata-original-title="Edit user"
                                                Dom-eid="<?php echo $a->id_user ?>">
													<i class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>
                                                Edit
                                            </a>
                                            &nbsp;||&nbsp;
                                            <a href="#" onclick="sweets()"
                                                class="text-secondary font-weight-bold text-xs ClassDeleteModal"
                                                ddata-original-title="Edit user"
                                                Dom-eid="<?php echo $a->id_user ?>">
                                                <i class="far fa-trash-alt me-2"></i>
                                                Delete
                                            </a>
                                        </td>
									</tr>
									<?php
                                    endforeach;
                                    ?>
								</tbody>
								<tfoot>
									<tr>
										<th></th>
										<th>ID</th>
										<th>Username</th>
										<th>Last Login</th>
										<th>Role</th>
										<th>Full Name</th>
										<th>Gender</th>
										<th>Telepon</th>
										<th>Address</th>
										<th></th>
									</tr>
								</tfoot>
							</table>
						</div>
						<!-- /.card-body -->
					</div>
					<!-- /.card -->
				</div>
				<!-- /.col -->
			</div>
			<!-- /.row -->
		</div>
		<!-- /.container-fluid -->
	</section>
	<!-- /.content -->
</div>

<script>
	$(document).ready(function () {
		// for save data from input category with serialize
		$(".inputItem").click(function () {
            console.log('test');
			$.ajax({
				url		: '<?= base_url('user/insert') ?>',
				method	: 'POST',
				data	: $('#addFormItem').serialize(),
				cache	: false,
				success	: function(response) {
					if(response == 'success'){ // if true (1)
						setTimeout(function(){
							window.location.reload();
						}, 30);
					}
				}
			});	
				return false;
		});

		$(".ClassEditModal").click(function () {
            console.log('test');
			var eid = $(this).attr('dom-eid');
			$.ajax({
				url		: '<?= base_url('user/edit'); ?>',
				type	: 'POST',
				cache	: false,
				data	: {
					eid: eid
				},
				success	: function(response) {
					$('#contents-edit').html(response);
				}
			});
		});

		$(".ClassDeleteModal").click(function () {
			var eid = $(this).attr('dom-eid');
			console.log(eid);
			Swal.fire({
				title: 'Are you sure?',
				text: "You won't be able to revert this!",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Yes, delete it!'
			}).then((result) => {
				if (result.isConfirmed) {
					window.location.href = "<?php echo base_url('user/delete/')?>" + eid;
				}
			})
		});
	});
</script>