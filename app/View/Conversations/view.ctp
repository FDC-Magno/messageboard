<!-- FINISHED(Jann 02/12/2020): redirect if there are no messages -->
<!-- Chat -->
<div id="chat-1" class="chat dropzone-form-js" data-dz-url="some.php">
<?php
	$index = count($conversation['Message']) - 1;
?>
	<!-- Chat: body -->
	<div class="chat-body">

		<!-- Chat: Header -->
		<div class="chat-header border-bottom py-4 py-lg-7">
			<div class="container">

				<div class="row align-items-center">
					<!-- FIXED(Jann 02/10/2020): fix icons and layouts -->
					<!-- Close chat(mobile) -->
					<div class="col-3 d-lg-none">
						<ul class="list-inline mb-0">
							<li class="list-inline-item">
								<a class="text-muted px-0" href="#" data-chat="open">
								<i class="fas fa-chevron-left"></i>
								</a>
							</li>
						</ul>
					</div>

					<!-- Chat photo -->
					<div class="col-6 col-lg-6">
						<div class="media text-center text-lg-left">
							<div class="avatar avatar-sm d-none d-lg-inline-block mr-5">
								<img src="/files/profiles/<?php echo $conversation['Receiver']['id'] == AuthComponent::user('User')['id'] ? $conversation['Sender']['image'] : $conversation['Receiver']['image']; ?>" class="avatar-img" alt="">
							</div>

							<div class="media-body align-self-center">
								<h6 class="mb-n2"><?php echo $conversation['Receiver']['id'] == AuthComponent::user('User')['id'] ? $conversation['Sender']['name'] : $conversation['Receiver']['name'] ?></h6>
								<small class="text-muted">Last Log in Time: <?php echo $conversation['Receiver']['id'] == AuthComponent::user('User')['id'] ? date_format(date_create($conversation['Sender']['last_login_time']), 'H:i A') : date_format(date_create($conversation['Receiver']['last_login_time']), 'H:i A'); ?></small>
							</div>
						</div>
					</div>

					<div class="col-3 col-lg-6 text-right">
						<ul class="nav justify-content-end">

							<li class="nav-item list-inline-item">
								<div class="dropdown">
									<a class="nav-link text-muted px-0" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										<i class="fas fa-ellipsis-v"></i>
									</a>
									<div class="dropdown-menu" style="">
										<a class="dropdown-item d-flex align-items-center" id="deleteConversationBtn" href="#">
											Delete
											<i class="far fa-trash-alt ml-auto"></i>
										</a>
									</div>
								</div>
							</li>

							<!-- Mobile nav -->
							<li class="nav-item list-inline-item d-block d-lg-none">
								<div class="dropdown">
									<div class="dropdown-menu">
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
							echo "<div class='message message-right message-{$key}'>
										<div class='dropdown' id='dropdown-message-right'>
											<a class='nav-link text-muted px-0' href='#' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
												<i class='fas fa-ellipsis-v'></i>
											</a>
											<div class='dropdown-menu'>
												<a class='dropdown-item d-flex align-items-center' onclick='deleteMessage(event, {$key}, {$message['id']})' href='#'>
													Delete
													<i class='far fa-trash-alt ml-auto'></i>
												</a>
											</div>
										</div>
										<!-- Avatar -->
										<a class='avatar avatar-sm mr-4 mr-lg-5' href='#'>
											<img class='avatar-img' src='/files/profiles/{$message['User']['image']}'>
										</a>

										<div class='message-body'>
											<div class='message-content bg-primary text-white'>
												<p>".nl2br($message['message'])."</p>
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
											<img class='avatar-img' src='/files/profiles/{$message['User']['image']}'>
										</a>
				
										<div class='message-body'>
											<div class='message-content bg-light'>
												<p>".str_ireplace('\n', '<br />', nl2br($message['message']))."</p>
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

					</div>
				</form>
			</div>
		</div>
		<!-- Chat: Footer -->
	</div>
</div>
<!-- Chat -->
<?php $this->start('script'); ?>
<script>
	window.index = <?php echo $index; ?>;
	$(function(){
		//open main chat when page loads
		$('.main').addClass('main-visible')
		//setting key enter to send message and ctrl+enter to enter newline
		$('#message').keydown(function (e) { 
			if(!e.ctrlKey && e.keyCode === 13){
				sendMessage()
			}
			else if (e.ctrlKey && e.keyCode == 13) {
				$('#message').val($('#message').val() + "\n");
			}
		});

		$('#deleteConversationBtn').click(function (e) { 
			e.preventDefault();
			//get conversation id with the use of $id params
			let id = '<?php echo $conversation['Conversation']['id']; ?>'
			deleteConversation(id)
		});		
	})

	//send message and store message in database
	function sendMessage(){
		let data = {
			message: $('#message').val(),
			user_id: <?php echo AuthComponent::user('User')['id']; ?>,
			conversation_id: <?php echo $conversation['Conversation']['id']; ?>
		}
		let id = <?php echo $conversation['Conversation']['id'] ?>;

		// FINISHED(Jann 02/10/2020): Finish created time format
		$.ajax({
			type: "post",
			accepts: {
				json: 'application/json'
			},
			dataType: 'json',
			url: `/chat/${id}/add`,
			data: data,
			success: function (response) {
				let date = new Date(response.Message.created)
				// console.log(date.getTime())
				let created = `${date.toLocaleTimeString('en-us', {
					hour:'2-digit', minute:'2-digit'
				})}`
				index++
				// FINISHED(Jann 02/12/2020): clone existing conversation then append using jquery
				$('#message').val("")
				let content = $('#chat-container').find('.message-right:last').clone();
				content.removeClass();
				content.addClass(`message message-right message-${index}`)
				content.find('.dropdown-item').attr('onclick', `deleteMessage(event, ${index}, ${response.Message.id})`)
				content.find('p').html(`${response.Message.message.replace("\n", "<br />")}`)
				content.find('small').html(`${created}`)
				$('#chat-container').append(content);
				content.hide()
				content.fadeIn('1000')
				$('.chat-content').scrollTop($('#chat-container')[0].scrollHeight);
			},
			error: function(error, err){
				console.log(error, err)
			}
		})
	}
	
	//delete selected conversation and its messages
	function deleteConversation(id) { 
		//initialize data object to send
		//call ajax to delete route
		$.ajax({
			type: "DELETE",
			url: `/conversations/${id}/delete`,
			dataType: "json",
			success: function (response, text) {
				//check if response is ok
				if (response.status == 'ok') {
					//remove conversation in the list and update conversations in the session
					//FINISHED(Jann 02/10/2020): find a way to fade out the deleted conversation using jquery
					let index = document.cookie[document.cookie.length - 1]
					$(`#conversation-${id}`).animate({ marginLeft: '150px', opacity: 0, height: 0 }, 1000);
					setTimeout(() => {
						location.href = '/'
					}, 1500);
					$('.main').removeClass('main-visible');
				}
			},
			catch(request, error) {
				console.log(error)
			}
		});
	}

	// delete user's message on a given conversation
	// FINISHED(Jann 02/11/2020): find a way to get message index and pass it to view for the animation
	function deleteMessage(e, key, id) {
		e.preventDefault()
		//call ajax to server for deletion
		$.ajax({
			type: "DELETE",
			url: `/messages/${id}/delete`,
			dataType: "json",
			success: function (response) {
				if(response.status == 'ok'){
					//animate message deletion on success use ($('#chat-container').find('div').eq(0).animate({ opacity: 0, height: 0 }, 300, 'linear')) for animation
					$(`.message-${key}`).animate({ opacity: 0, height: 0 }, 300, 'linear', function(){ $(this).delay().remove() })
				}
			}
		});
	}
</script>
<?php $this->end(); ?>