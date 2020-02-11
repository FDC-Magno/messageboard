<div class="col-12 col-md-5 col-lg-4 py-8 py-md-11">

	<!-- Heading -->
	<h1 class="font-bold text-center">Sign up</h1>

	<!-- Text -->
	<p class="text-center mb-6">Welcome to the official Chat web-client.</p>

	<!-- Form -->
	<?php echo $this->Form->create(false, array('class' => 'mb-6', 'type' => 'file', 'url' => '/signup')); ?>
		<div class="form-group input text">
			<!-- <label class="small">Image</label> -->
			<div class="position-relative text-center bg-secondary rounded p-6">
				<div class="avatar bg-primary text-white mb-5 pt-5">
					<i class="far fa-image fa-lg"></i>
				</div>

				<p class="small text-muted mb-0">You can upload jpg, gif or png files. <br> Max file size 3mb.</p>
				<input type="file" name="data[image]" id="image" class="d-none" label=''>
				<label class="stretched-label mb-0" for="image"></label>
			</div>
		</div>
		<!-- Name -->
		<div class="form-group">
			<label for="name" class="sr-only">Name</label>
			<input type="text" name="name" id="name" class="form-control" placeholder="Enter Fullname" value="<?php echo $this->request->data('name'); ?>">
		</div>

		<!-- Email -->
		<div class="form-group">
			<label for="email" class="sr-only">Email</label>
			<input type="email" name="email" id="email" class="form-control" placeholder="Enter Email" value="<?php echo $this->request->data('email'); ?>">
		</div>

		<!-- Password -->
		<div class="form-group">
			<label for="password" class="sr-only">Password</label>
			<input type="password" name="password" id="password" class="form-control" placeholder="Enter Password">
		</div>

		<!-- Password Confirm-->
		<div class="form-group">
			<label for="password_confirm" class="sr-only">Confirm Password</label>
			<input type="password" name="password_confirm" id="password_confirm" class="form-control" placeholder="Confirm Password">
		</div>

		<!-- Birthdate -->
		<div class="form-group">
			<label for="birthdate" class="sr-only">Birthdate</label>
			<input type="text" name="birthdate" id="birthdate" class="form-control datepicker" placeholder="Enter Birthdate" value="<?php echo $this->request->data('email'); ?>">
		</div>

		<!-- FIXME: give fields their respective default values -->
		<!-- Gender -->
		<div class="form-group">
			<label for="gender" class="sr-only">Gender</label>
			<select name="gender" id="gender" class="form-control">
				<option value="<?php echo $this->request->data('gender'); ?>" selected hidden><?php echo $this->request->data('gender') ?></option>
				<option value="m">Male</option>
				<option value="f">Female</option>
				<option value="o">Others</option>
			</select>
		</div>

		<!-- Hubby -->
		<div class="form-group">
			<label for="hubby" class="sr-only">Hubby</label>
			<textarea name="hubby" id="hubby" class="form-control" placeholder="" rows="6">Enter you hubby here</textarea>
		</div>

		<!-- Submit -->
		<?php echo $this->Form->end(array('class' => 'btn btn-block btn-primary', 'label' => 'Signup')); ?>

	<!-- Text -->
	<p class="text-center">
		Already have an account? <a href="/login">Sign in</a>.
	</p>

</div>

