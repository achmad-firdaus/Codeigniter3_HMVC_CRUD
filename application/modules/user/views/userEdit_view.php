

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
                        placeholder="ID User" value="<?= $getMaster->id_user ?>" readonly="readonly" name="ID_User">
                </div>
                <div class="col-md-2 mb-2">
                    <input type="text" class="form-control" id="validationCustom02"
                        placeholder="Username" required name="Username" value="<?= $getMaster->username ?>" >
                </div>
                <div class="col-md-1 mb-2">
                    <select class="form-control" id="validationCustom03" required
                        name="Role">
                        <option value="<?= $getMaster->role ?>" selected><?= ($getMaster->role === 'A') ? 'Admin' : 'User' ?></option>
                        <option value="Admin">Admin</option>
                        <option value="User">User</option>
                    </select>
                </div>
                <div class="col-md-2 mb-2">
                    <input type="text" class="form-control" id="validationCustom04"
                        placeholder="Full Name" required name="Full_Name" value="<?= $getMaster->full_name ?>" >
                </div>
                <div class="col-md-1 mb-2">
                    <select class="form-control" id="validationCustom05" required
                        name="Gender">
                        <option value="<?= $getMaster->gender ?>" selected><?= ($getMaster->gender === 'P') ? 'Male' : 'Female' ?></option>
                        <option value="P">Male</option>
                        <option value="W">Female</option>
                    </select>
                </div>
                <div class="col-md-2 mb-2">
                    <input type="number" class="form-control" id="validationCustom06"
                        placeholder="Telepon" required name="Telepon" value="<?= $getMaster->telp ?>">
                </div>
                <div class="col-md-3 mb-2">
                    <input type="text" class="form-control" id="validationCustom07"
                        placeholder="Address" required name="Address" value="<?= $getMaster->address ?>">
                </div>
            </div>
        </div>
        <button class="btn btn-primary mt-2 mb-2 inputItemEdit" type="submit">Update Item</button>
    </form>

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

		$(".inputItemEdit").click(function () {
            console.log('test');
			$.ajax({
				url		: '<?= base_url('user/update') ?>',
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