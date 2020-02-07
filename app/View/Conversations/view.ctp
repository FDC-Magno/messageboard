
<!-- Main Content -->
<div class="main main-visible" data-mobile-height="">

	<!-- Chat -->
	<div id="chat-1" class="chat dropzone-form-js" data-dz-url="some.php">

		<!-- Chat: body -->
		<div class="chat-body">

			<!-- Chat: Header -->
			<div class="chat-header border-bottom py-4 py-lg-7">
				<div class="container">

					<div class="row align-items-center">

						<!-- Close chat(mobile) -->
						<div class="col-3 d-lg-none">
							<ul class="list-inline mb-0">
								<li class="list-inline-item">
									<a class="text-muted px-0" href="#" data-chat="open">
										<i class="icon-md fe-chevron-left"></i>
									</a>
								</li>
							</ul>
						</div>

						<!-- Chat photo -->
						<div class="col-6 col-lg-6">
							<div class="media text-center text-lg-left">
								<div class="avatar avatar-sm d-none d-lg-inline-block mr-5">
									<img src="/files/profiles/<?php echo $conversation['Sender']['image'] ?>" class="avatar-img" alt="">
								</div>

								<div class="media-body align-self-center">
									<h6 class="mb-n2"><?php echo $conversation['Sender']['name'] ?></h6>
									<small class="text-muted">Last Log in Time: <?php echo date_format(date_create($conversation['Sender']['last_login_time']), 'H:i A'); ?></small>
								</div>
							</div>
						</div>

						<!-- Chat toolbar -->
						<div class="col-3 col-lg-6 text-right">
							<ul class="nav justify-content-end">

								<!-- Mobile nav -->
								<li class="nav-item list-inline-item d-block d-lg-none">
									<div class="dropdown">
										<a class="nav-link text-muted px-0" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											<i class="icon-md fe-more-vertical"></i>
										</a>
										<div class="dropdown-menu">
											<a class="dropdown-item d-flex align-items-center" href="#" data-chat-sidebar-toggle="#chat-1-info">
												Chat Info <span class="ml-auto pl-5 fe-more-horizontal"></span>
											</a>
											<a class="dropdown-item d-flex align-items-center" href="#" data-chat-sidebar-toggle="#chat-1-members">
												Add Members <span class="ml-auto pl-5 fe-user-plus"></span>
											</a>
										</div>
									</div>
								</li>
								<!-- Mobile nav -->
							</ul>
						</div>

					</div><!-- .row -->

				</div>
			</div>
			<!-- Chat: Header -->

			<!-- Chat: Content-->
			<div class="chat-content">
				<div class="container py-6 py-lg-9" id="chat-container">
					<?php 
						foreach ($conversation['Message'] as $key => $message) {
							$created = date_format(date_create($message['created']), 'h:i A');
							if ($message['user_id'] == AuthComponent::user('User')['id']) {
								echo "<div class='message message-right'>
					
											<!-- Avatar -->
											<a class='avatar avatar-sm mr-4 mr-lg-5' href='#' data-chat-sidebar-toggle='#chat-1-user-profile'>
												<img class='avatar-img' src='/files/profiles/{$conversation['Receiver']['image']}'>
											</a>
					
											<div class='message-body'>
												<div class='message-content bg-primary text-white'>
													<p>{$message['message']}</p>
												</div>
					
												<div class='message-footer'>
													<small class='text-muted'>{$created}</small>
												</div>
											</div>
										</div>";
							}
							else{
								echo "<div class='message'>
					
											<!-- Avatar -->
											<a class='avatar avatar-sm mr-4 mr-lg-5' href='#' data-chat-sidebar-toggle='#chat-1-user-profile'>
												<img class='avatar-img' src='/files/profiles/{$conversation['Sender']['image']}'>
											</a>
					
											<div class='message-body'>
												<div class='message-content bg-light'>
													<p>{$message['message']}</p>
												</div>
					
												<div class='message-footer'>
													<small class='text-muted'>{$created}</small>
												</div>
											</div>
										</div>";
							}
						}
					?>
				</div>

				<!-- Scroll to end -->
				<div class="end-of-chat"></div>
			</div>
			<!-- Chat: Content -->

			<!-- Chat: Footer -->
			<div class="chat-footer border-top py-4 py-lg-7">
				<div class="container">

					<form id="chat-form" data-emoji-form="">
						<input type="hidden" name="_method" value="POST">
						<div class="input-group">

							<!-- Textarea -->
							<textarea id="message" name="message" class="form-control" placeholder="Type your message..." rows="1" data-emoji-input="" data-autosize="true"></textarea>

							<!-- Emoji button -->
							<div class="input-group-append mr-n4">
								<button class="btn btn-ico btn-secondary btn-minimal" type="button" data-emoji-btn="">
									<i class="far fa-smile"></i>
								</button>
							</div>

							<!-- Submit button -->
							<div class="input-group-append">
								<button class="btn btn-ico btn-secondary btn-minimal" type="submit">
									<i class="far fa-paper-plane"></i>
								</button>
							</div>

						</div>
					</form>

				</div>
			</div>
			<!-- Chat: Footer -->
		</div>
		<!-- Chat: body -->
	</div>
	<!-- Chat -->

</div>
<!-- Main Content -->
<?php $this->start('script'); ?>
<script>
	$(function(){
		$('#chat-form').submit(function (e) { 
			e.preventDefault()
			let data = {
				message: $('#message').val(),
				user_id: <?php echo AuthComponent::user('User')['id']; ?>,
				conversation_id: <?php echo $conversation['Conversation']['id']; ?>
			}
			// console.log(data)
			/**
			 * TODO: Finish created time format
			 */
			$.ajax({
				type: "post",
				accepts: {
					json: 'application/json'
				},
				dataType: 'json',
				url: "/chat/<?php echo $conversation['Conversation']['id'] ?>/add",
				data: data,
				success: function (response) {
					let date = new Date(response.Message.created)
					console.log(date.getTime())
					let created = `${date.getHours()}:${date.getMinutes()}`
					console.log(response)
					let content = `<div class='message message-right'>
											<!-- Avatar -->
											<a class='avatar avatar-sm mr-4 mr-lg-5' href='#' data-chat-sidebar-toggle='#chat-1-user-profile'>
												<img class='avatar-img' src='/files/profiles/<?php echo AuthComponent::user('User')['image'] ?>'>
											</a>
					
											<div class='message-body'>
												<div class='message-content bg-primary text-white'>
													<p>${response.Message.message}</p>
												</div>
					
												<div class='message-footer'>
													<small class='text-muted'>${created}</small>
												</div>
											</div>
										</div>`
					$('#chat-container').append(content);
				}
			});
		});
	})
</script>
<?php $this->end(); ?>