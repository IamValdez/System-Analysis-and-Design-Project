<?php
session_start();
include ('db_connect.php');
$faculty= $conn->query("SELECT * FROM facultys_list ");
	while($row = $faculty->fetch_assoc()){
		$doc_arr[$row['id']] = $row;
	}
	$request= $conn->query("SELECT * FROM users where type = 3 ");
	while($row = $request->fetch_assoc()){
		$p_arr[$row['id']] = $row;
	}
	if(isset($_GET['id'])){
	$qry = $conn->query("SELECT * FROM appointment_list where id =".$_GET['id']);
	foreach ($qry->fetch_array() as $key => $value) {
		$$key = $value;
	}

	}

?>
<style>
	#uni_modal .modal-footer{
		display: none
	}
</style>
<div class="container-fluid">
	<div class="col-lg-12">
		<div id="msg"></div>
		<form action="" id="manage-appointment">
			<input type="hidden" name="id" value="<?php echo isset($_GET['id']) ? $_GET['id'] : ''; ?>">
			<?php if($_SESSION['login_type'] == 2): ?>
			<input type="hidden" name="faculty_id" value="<?php echo isset($_SESSION['login_faculty_id']) ? $_SESSION['login_faculty_id'] : ''; ?>">
				<?php else: ?>
			<div class="form-group">
				<label for="" class="control-label">Faculty</label>
				<select class="browser-default custom-select select2" name="faculty_id">
					<option value=""></option>
					<?php foreach($doc_arr as $row): ?>
					<option value="<?php echo $row['id'] ?>" <?php echo isset($faculty_id) && $faculty_id == $row['id'] ? 'selected' : '' ?>><?php echo " ".$row['name'] ?></option>
					<?php endforeach; ?>
				</select>
			</div>
		<?php endif; ?>
			<div class="form-group">
				<label for="" class="control-label">Request</label>
				<select class="browser-default custom-select select2" name="request_id">
					<option value=""></option>
					<?php foreach($p_arr as $row): ?>
					<option value="<?php echo $row['id'] ?>" <?php echo isset($request_id) && $request_id == $row['id'] ? 'selected' : '' ?>><?php echo $row['name'] ?></option>
					<?php endforeach; ?>
				</select>
			</div>
			<div class="form-group">
				<label for="" class="control-label">Date</label>
				<input type="date"  name="date" class="form-control" value="<?php echo isset($schedule) ? date("Y-m-d",strtotime($schedule)) : '' ?>" required>
			</div>

			<div class="form-group">
				<label for="" class="control-label">Time</label>
				<input type="time"  name="time" class="form-control" value="<?php echo isset($schedule) ? date("H:i",strtotime($schedule)) : '' ?>" required>
			</div>
			<div class="form-group">
				<label for="" class="control-label">Status</label>
				<select class="browser-default custom-select" name="status">
					<option value="0" <?php echo isset($status) && $status == 0 ? "selected" : '' ; ?>>Request</option>
					<option value="1" <?php echo isset($status) && $status == 1 ? "selected" : '' ; ?>>Confirm</option>
					<option value="2" <?php echo isset($status) && $status == 2 ? "selected" : '' ; ?>>Rescheduled</option>
					<option value="3" <?php echo isset($status) && $status == 3 ? "selected" : '' ; ?>>Done</option>
				</select>
			</div>


			<hr>
			<div class="col-md-12 text-center">
				<button class="btn-primary btn btn-sm col-md-4">Update</button>
				<button class="btn btn-secondary btn-sm col-md-4  " type="button" data-dismiss="modal" id="">Close</button>
			</div>
		</form>
	</div>
</div>

<script>
	
	$("#manage-appointment").submit(function(e){
		e.preventDefault()
		start_load()
		$.ajax({
			url:'ajax.php?action=set_appointment',
			method:'POST',
			data:$(this).serialize(),
			success:function(resp){
				resp = JSON.parse(resp)
				if(resp.status == 1){
					alert_toast("Request submitted successfully");
					// end_load();
					$('.modal').modal("hide");
					setTimeout(function(){
						location.reload();
					},1500)
				}else{
					$('#msg').html('<div class="alert alert-danger">'+resp.msg+'</div>')
					end_load();
				}
			}
		})
	})
</script>

