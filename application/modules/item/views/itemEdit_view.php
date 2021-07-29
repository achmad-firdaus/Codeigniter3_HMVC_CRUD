

    <div class="form-row">
        <div class="col-md-1 mb-0">
            <label for="validationCustom01">ID</label>
        </div>
        <div class="col-md-3 mb-0">
            <label for="validationCustom02">Name</label>
        </div>
        <div class="col-md-2 mb-0">
            <label for="validationCustom03">Qty</label>
        </div>
        <div class="col-md-3 mb-0">
            <label for="validationCustom04">Price</label>
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
                        placeholder="ID User" value="<?= $getMaster->id_item ?>" readonly="readonly" name="ID_Item">
                </div>
                <div class="col-md-3 mb-2">
                    <input type="text" class="form-control" id="validationCustom02"
                        placeholder="Name" required name="Name" value="<?= $getMaster->name ?>">
                </div>
                <div class="col-md-2 mb-2">
                    <input type="number" class="form-control" id="validationCustom03"
                        placeholder="Qty" required name="Qty" value="<?= $getMaster->qty ?>">
                </div>
                <div class="col-md-3 mb-2">
                    <input type="number" class="form-control" id="validationCustom04"
                        placeholder="Price" required name="Price" value="<?= $getMaster->price ?>">
                </div>
            </div>
        </div>
        <button class="btn btn-primary mt-2 mb-2 inputItemEdit" type="submit">Save Item</button>
    </form>


<script>
	$(document).ready(function () {
		// for save data from input category with serialize
		$(".inputItem").click(function () {
            console.log('test');
			$.ajax({
				url		: '<?= base_url('item/insert') ?>',
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
				url		: '<?= base_url('item/update') ?>',
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
				url		: '<?= base_url('item/edit'); ?>',
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
					window.location.href = "<?php echo base_url('item/delete/')?>" + eid;
				}
			})
		});
	});
</script>