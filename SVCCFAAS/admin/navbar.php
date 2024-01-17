
<style>
</style>
<nav id="sidebar" class='mx-lt-5 bg-dark' >
		
		
		<div class="sidebar-list">

				<a href="index.php?page=home" class="nav-item nav-home"><span class='icon-field'><i class="fa fa-home"></i></span> Home</a>
				<a href="index.php?page=appointments" class="nav-item nav-appointments"><span class='icon-field'><i class="fa fa-calendar"></i></span> Appointments</a>
				<a href="index.php?page=facultys" class="nav-item nav-facultys"><span class='icon-field'><i class="fa fa-user-md"></i></span> Facultys</a>
				<a href="index.php?page=categories" class="nav-item nav-categories"><span class='icon-field'><i class="fa fa-book-medical"></i></span> College Department</a>			
				<?php if($_SESSION['login_type'] == 1): ?>
				<a href="index.php?page=users" class="nav-item nav-users"><span class='icon-field'><i class="fa fa-users"></i></span> Users</a>
				<a href="index.php?page=site_settings" class="nav-item nav-site_settings"><span class='icon-field'><i class="fa fa-cog"></i></span> Site Settings</a>
			<?php endif; ?>
		</div>

</nav>
<script>
	$('.nav-<?php echo isset($_GET['page']) ? $_GET['page'] : '' ?>').addClass('active')
</script>
<?php if($_SESSION['login_type'] == 2): ?>
	<style>
		.nav-sales ,.nav-users,.nav-facultys,.nav-categories{
			display: none!important;
		}
	</style>
<?php endif ?>