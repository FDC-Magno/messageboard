<!-- FINISHED(Jann 02/12/2020): redirect if there are no messages -->
<!-- Chat -->
<div id="chat-1" class="chat dropzone-form-js" data-dz-url="some.php">
<?php
	$index = count($conversation['messages']) - 1;
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
								<img src="/files/profiles/<?php echo $conversation['otherUser']['image'] ?>" class="avatar-img" alt="">
							</div>

							<div class="media-body align-self-center">
								<h6 class="mb-n2"><?php echo $conversation['otherUser']['name'] ?></h6>
								<small class="text-muted">Last Log in Time: <?php echo date_format(date_create($conversation['otherUser']['last_login_time']), 'h:i A'); ?></small>
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
									<div class="dropdown-menu">
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
		<!-- FINISHED(Jann 02/13/2020): continue formatting data -->
		<!-- Chat: Content-->
		<div class="chat-content" id="chat-container2">
			<div class="container py-6 py-lg-9" id="chat-container">
				<?php 
					foreach (array_reverse($conversation['messages']) as $key => $message) {
						if ($message['user_id'] == AuthComponent::user('User')['id']) {
							echo "<div class='message message-right message-{$message['id']}'>
										<div class='dropdown' id='dropdown-message-right'>
											<a class='nav-link text-muted px-0' href='#' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
												<i class='fas fa-ellipsis-v'></i>
											</a>
											<div class='dropdown-menu'>
												<a class='dropdown-item d-flex align-items-center' onclick='deleteMessage(event, {$message['id']})' href='#'>
													Delete
													<i class='far fa-trash-alt ml-auto'></i>
												</a>
											</div>
										</div>
										<!-- Avatar -->
										<a class='avatar avatar-sm mr-4 mr-lg-5' href='#'>
											<img class='avatar-img' src='/files/profiles/{$message['image']}'>
										</a>

										<div class='message-body'>
											<div class='message-content bg-primary text-white'>
												<p>".nl2br($message['message'])."</p>
											</div>
				
											<div class='message-footer'>
												<small class='text-muted'>{$message['created']}</small>
											</div>
										</div>
									</div>";
						} else {
							echo "<div class='message'>
										<!-- Avatar -->
										<a class='avatar avatar-sm mr-4 mr-lg-5' href='#' data-chat-sidebar-toggle='#chat-1-user-profile'>
											<img class='avatar-img' src='/files/profiles/{$message['image']}'>
										</a>
				
										<div class='message-body'>
											<div class='message-content bg-light'>
												<p>".str_ireplace('\n', '<br />', nl2br($message['message']))."</p>
											</div>
				
											<div class='message-footer'>
												<small class='text-muted'>{$message['created']}</small>
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
	window.conversationId = <?php echo $conversation['conversation_id'] ?>;
	window.conversation_count = <?php echo count($conversation['messages']); ?>;
	window.auth_user = {
		id: "<?php echo AuthComponent::user('User')['id']; ?>",
		name: "<?php echo AuthComponent::user('User')['name']; ?>",
		image: "<?php echo AuthComponent::user('User')['image']; ?>"
	};
	window.messageTemplate = `<div class="message">
								<!-- Avatar -->
								<a class="avatar avatar-sm mr-4 mr-lg-5" href="#" data-chat-sidebar-toggle="#chat-1-user-profile">
									<img class="avatar-img" src="">
								</a>
		
								<div class="message-body">
									<div class="message-content bg-light">
										<p></p>
									</div>
		
									<div class="message-footer">
										<small class="text-muted"></small>
									</div>
								</div>
							</div>`
	
	$(function() {
		//open main chat when page loads
		$('.main').addClass('main-visible')
		
		setInterval(() => {
			updateChatbox(conversationId)
		}, 5000);

		//integrate infinite scrolling on chat messages
		$('#chat-container2').endlessScroll({
			inflowPixels: 10,
			ceaseFireOnEmpty: false,
			insertBefore: `#chat-container .message:first`,
			loader: `<i class="fas fa-spinner"></i>`,
			callback: function(i, p, d) {
				if(p <= 0){
					console.log('getting data...', p * 8)
					let data = {
						offset: p * 8,
					}
					let id = <?php echo $conversation['conversation_id']; ?>;
					$.ajax({
						type: "get",
						url: `/${id}/getMessages`,
						data: data,
						dataType: "json",
						success: function (response) {
							// console.log(i, p, d)
							let messages = []
							if (response.messages != undefined) {
									// console.log('test')
								response.messages.forEach(function(value) {
									if (auth_user.id == value.user_id) {
										messageClone.removeClass()
										messageClone.addClass(`message message-right message-${value.id}`)
										messageClone.find('.dropdown-item').attr('onclick', `deleteMessage(event, ${value.id})`)
										messageClone.find('.avatar-img').attr('src', `/files/profiles/${auth_user.image}`)
										messageClone.find('.message-content').find('p').html(value.message)
										messageClone.find('.message-footer').find('small').html(value.created)
										messages.push(messageClone)
									} else {
										messageClone.removeClass()
										messageClone.addClass(`message message-${value.id}`)
										messageClone.find('.message-content').removeClass('bg-primary text-white')
										messageClone.find('.message-content').addClass('bg-light')
										messageClone.find('.dropdown').remove()
										messageClone.find('.avatar-img').attr('src', `/files/profiles/${response.otherUser.image}`)
										messageClone.find('.message-content').find('p').html(value.message)
										messageClone.find('.message-footer').find('small').html(value.created)
										messages.push(messageClone)
									}
								});
								messages.reverse()
							}else{
								ceaseFire = true
							}
							// console.log(conversation)
							$('#chat-container').prepend(messages)
						}
					});
				}
			},
			ceaseFire: function(i) {
				return ceaseFire;
			}
		})
		//setting key enter to send message and ctrl+enter to enter newline
		$('#message').keydown(function (e) { 
			if (!e.ctrlKey && e.keyCode === 13) {
				sendMessage()
			}
			else if (e.ctrlKey && e.keyCode == 13) {
				$('#message').val($('#message').val() + "\n");
			}
		});

		$('#deleteConversationBtn').click(function (e) { 
			e.preventDefault();
			//get conversation id with the use of $id params
			let id = '<?php echo $conversation['conversation_id']; ?>'
			deleteConversation(id)
		});		
	})

	//send message and store message in database
	function sendMessage() {
		let id = <?php echo $conversation['conversation_id'] ?>;
		let data = {
			message: $('#message').val(),
			user_id: <?php echo AuthComponent::user('User')['id']; ?>,
			conversation_id: id
		}

		// FINISHED(Jann 02/10/2020): Finish created time format
		$.ajax({
			type: "post",
			dataType: 'json',
			url: `/messages/add`,
			data: data,
			success: function (response) {
				let date = new Date(response.Message.created)
				let created = `${date.toLocaleTimeString('en-us', {
					hour:'2-digit', minute:'2-digit'
				})}`
				index++
				// FINISHED(Jann 02/12/2020): clone existing conversation then append using jquery
				$('#message').val("")
				let content = $('#chat-container').find('.message-right:last').clone();
				if (content.length != 0) {	
					content.removeClass();
					content.addClass(`message message-right message-${response.Message.id}`)
					content.find('.dropdown-item').attr('onclick', `deleteMessage(event, ${response.Message.id})`)
					content.find('p').html(`${response.Message.message.replace("\n", "<br />")}`)
					content.find('small').html(`${created}`)
					$('#chat-container').append(content);
					content.hide()
					content.fadeIn('1000')
					$('.chat-content').scrollTop($('#chat-container')[0].scrollHeight);
				} else {
					let content = $('#chat-container').find('.message:last').clone();
					content.addClass(`message message-right message-${response.Message.id}`)
					content.prepend('<div class="dropdown" id="dropdown-message-right"></div>')
					content.find('.dropdown').append(`<a class='nav-link text-muted px-0' href='#' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><i class='fas fa-ellipsis-v'</i></a>`)
					content.find('.dropdown').append(`<div class='dropdown-menu'><a class='dropdown-item d-flex align-items-center' onclick='deleteMessage(event, ${response.Message.id})' href='#'>Delete<i class='far fa-trash-alt ml-auto'></i></a></div>`)
					content.find('.dropdown-item').attr('onclick', `deleteMessage(event, ${response.Message.id})`)
					content.find('.message-content').removeClass('bg-light')
					content.find('.message-content').addClass('bg-primary text-white')
					content.find('.avatar-img').attr('src', `/files/profiles/${response.User.image}`)
					content.find('p').html(`${response.Message.message.replace("\n", "<br />")}`)
					content.find('small').html(`${created}`)
					$('#chat-container').append(content);
					content.hide()
					content.fadeIn('1000')
					$('.chat-content').scrollTop($('#chat-container')[0].scrollHeight);
				}
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
	function deleteMessage(e, id) {
		e.preventDefault()
		//call ajax to server for deletion
		$.ajax({
			type: "DELETE",
			url: `/messages/${id}/delete`,
			dataType: "json",
			success: function (response) {
				if(response.status == 'ok'){
					//animate message deletion on success use ($('#chat-container').find('div').eq(0).animate({ opacity: 0, height: 0 }, 300, 'linear')) for animation
					$(`.message-${id}`).animate({ opacity: 0, height: 0 }, 300, 'linear', function(){ $(this).delay().remove() })
				}
			}
		});
	}
	// FINISHED(Jann 02/17/2020): Implement realtime chat
	function updateChatbox(conversationId) {
		//get latest messages using the conversationId
		$.ajax({
			type: "GET",
			url: `/messages/${conversationId}/getUpdatedMessages`,
			dataType: "json",
			success: function (response) {
				if(response){
					//checking if the number of messages from the database has increased to limit the times the function will update the chat box
					if (response.messages.length != conversation_count) {
						let messages = []
						//templating messages for UI
						response.messages.map(function(value){
							//template messages for authenticated user
							if (auth_user.id == value.user_id) {
								let messageClone = $(messageTemplate).clone()
								messageClone.addClass(`message message-right message-${value.id}`)
								messageClone.prepend('<div class="dropdown" id="dropdown-message-right"></div>')
								messageClone.find('.dropdown').append(`<a class='nav-link text-muted px-0' href='#' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><i class='fas fa-ellipsis-v'</i></a>`)
								messageClone.find('.dropdown').append(`<div class='dropdown-menu'><a class='dropdown-item d-flex align-items-center' onclick='deleteMessage(event, ${value.id})' href='#'>Delete<i class='far fa-trash-alt ml-auto'></i></a></div>`)
								messageClone.find('.dropdown-item').attr('onclick', `deleteMessage(event, ${value.id})`)
								messageClone.find('.message-content').removeClass('bg-light')
								messageClone.find('.message-content').addClass('bg-primary text-white')
								messageClone.find('.avatar-img').attr('src', `/files/profiles/${auth_user.image}`)
								messageClone.find('p').html(`${value.message.replace("\n", "<br />")}`)
								messageClone.find('small').html(`${value.created}`)
								messages.push(messageClone)
							} else {
								//template for the user on the other end of the conversation
								let messageClone = $(messageTemplate).clone()
								messageClone.removeClass()
								messageClone.addClass(`message message-${value.id}`)
								messageClone.find('.message-content').removeClass('bg-primary text-white')
								messageClone.find('.message-content').addClass('bg-light')
								messageClone.find('.dropdown').remove()
								messageClone.find('.avatar-img').attr('src', `/files/profiles/${response.otherUser.image}`)
								messageClone.find('.message-content').find('p').html(value.message)
								messageClone.find('.message-footer').find('small').html(value.created)
								messages.push(messageClone)
							}
						})
						//setting global variable conversation_count to the messages length of the response to let the function check the messages count again
						conversation_count = response.messages.length
						$('#chat-container').find('.message').remove()
						$('#chat-container').append(messages);
						$('.chat-content').scrollTop($('#chat-container')[0].scrollHeight);
					}
				}
			}
		});
	}
</script>
<?php $this->end(); ?>