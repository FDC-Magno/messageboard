 <!-- Default Page -->
	<div class="chat flex-column justify-content-center text-center">
		<div class="container">

			<div class="avatar avatar-lg mb-5">
				<img class="avatar-img" src="/files/profiles/<?php echo AuthComponent::user('User')['image'] ?>" alt="">
			</div>

			<h6>Hey! <?php echo AuthComponent::user('User')['name'] ?></h6>
			<p>Please select a chat to start messaging.</p>
		</div>
	</div>
<!-- Default Page -->