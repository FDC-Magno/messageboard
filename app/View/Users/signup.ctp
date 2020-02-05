<div class="col-12 col-md-5 col-lg-4 py-8 py-md-11">

	<!-- Heading -->
	<h1 class="font-bold text-center">Sign up</h1>

	<!-- Text -->
	<p class="text-center mb-6">Welcome to the official Chat web-client.</p>

	<!-- Form -->
	<?php echo $this->Form->create('User', array('class' => 'mb-6')); ?>
		<input type="hidden" name="data[User][id]" id="UserId">
		<div class="form-group input text">
			<label class="small">Photo</label>
			<div class="position-relative text-center bg-secondary rounded p-6">
				<div class="avatar bg-primary text-white mb-5 pt-5">
					<i class="far fa-image fa-lg"></i>
				</div>

				<p class="small text-muted mb-0">You can upload jpg, gif or png files. <br> Max file size 3mb.</p>
				<?php echo $this->Form->input('image', array('class' => 'd-none', 'id' => 'upload-chat-photo', 'type' => 'file')); ?>
				<label class="stretched-label mb-0" for="upload-chat-photo"></label>
			</div>
		</div>
		<!-- Name -->
		<?php echo $this->Form->input('name', array('class' => 'form-control mt-0', 'label' => '', 'placeholder' => 'Enter full name')); ?>

		<!-- Email -->
		<input type="email" name="email" id="email" class="form-control mt-5" placeholder="Enter Email">

		<!-- Password -->
		<?php echo $this->Form->input('password', array('class' => 'form-control mb-5', 'label' => '', 'placeholder' => 'Enter Password')); ?>

		<!-- gender -->
		<div class="form-group input text">
			<label for="UserBirthdate" class="sr-only">Birthdate</label>
			<?php echo $this->Form->input('birthdate', array('type' => 'date', 'class' => 'form-control')); ?>
		</div>

		<!-- Gender -->
		<?php echo $this->Form->input('gender', array('class' => 'form-control', 'options' => array('m' => 'Male', 'f' => 'Female', 'o' => 'Others'))); ?>

		<!-- Hubby -->
		<?php echo $this->Form->input('hubby', array('class' => 'form-control mb-5', 'label' => '', 'placeholder' => 'Enter your Hubby here')); ?>

		<!-- Hidden inputs -->
			<!-- Last Login Time -->
			<?php 
				$lastLoginDate = date('Y-m-d H:i:s');
				echo $this->Form->input('last_login_time', array('type' => 'hidden', 'value' => $lastLoginDate)); 
			?>

		<!-- Submit -->
		<?php echo $this->Form->end(array('class' => 'btn btn-block btn-primary', 'label' => 'Signup')); ?>

	<!-- Text -->
	<p class="text-center">
		Already have an account? <a href="/login">Sign in</a>.
	</p>

</div>

