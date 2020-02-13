<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		MessageBoard:
		<?php echo $this->fetch('title'); ?>
	</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, maximum-scale=1, shrink-to-fit=no">
	<?php
		echo $this->Html->meta('icon', '/img/logo.png');
		echo $this->Html->css('style.css');
		echo $this->Html->css('template.min.css');
		echo $this->Html->css('template.dark.min.css', array('media' => '(prefers-color-scheme: dark)'));
		echo $this->Html->css('https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css');
		echo $this->Html->css('dark-adminlte.css');
		echo $this->Html->css('jquery-ui.min.css');
		echo $this->Html->script('https://use.fontawesome.com/releases/v5.12.0/js/all.js');
		echo $this->Html->script('https://use.fontawesome.com/releases/v5.12.0/js/v4-shims.js');
		echo $this->Html->script('jquery.min.js');
		echo $this->Html->script('jquery.endless-scroll.js');
		echo $this->Html->script('jquery-ui.min.js');
		echo $this->Html->script('bootstrap.bundle.min.js');
		echo $this->Html->script('https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js');
		echo $this->Html->script('plugins.bundle.js');
		echo $this->Html->script('template.js');
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>

    <!-- some basic UX elements fixing -->
    <script>
        
        $('.datepicker').datepicker({
            inline: true
        })
        
        //get file before uploading to server
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                
                reader.onload = function(e) {
                    $('#welcomeForm').find('img').attr('src', e.target.result);
                }
                
                reader.readAsDataURL(input.files[0]);
            }
        }

        $(function() {
            var timer = null;
            window.cease_fire = false;

            //change preview after an image is selected
            $('#upload-chat-photo').change(function() {
                readURL(this)
            })
            // FINISHED(Jann 02/12/2020): Limit endless scrolling if content is empty
            $('#conversation-container2').endlessScroll({
                ceaseFireOnEmpty: false,
                inflowPixels: 10,
                callback: function(i, p, d) {
                    if(p >= 0){
                        console.log('getting data...', p * 8)
                        let data = {
                            offset: p * 8,
                        }
                        $.ajax({
                            type: "get",
                            url: "/getConversations",
                            data: data,
                            dataType: "json",
                            success: function (response) {
                                // console.log(i, p, d)
                                console.log(response.length)
                                let conversation = []
                                if (response.length > 0) {
                                    response.forEach(function(value) {
                                        let conversationClone = $('#conversation-container').find('a:last').clone()
                                        conversationClone.attr('id', `conversation-${value.id}`)
                                        conversationClone.attr('href', `/chat/${value.id}`)
                                        conversationClone.find('img').attr('src', `/files/profiles/${value.image}`)
                                        conversationClone.find('h6').html(value.name)
                                        conversationClone.find('.text-truncate:last').html(value.message)
                                        conversationClone.find('p').html(value.created)
                                        conversation.push(conversationClone)
                                    });
                                } else {
                                    cease_fire = true
                                }
                                // console.log(conversation)
                                $('#conversation-container').append(conversation)
                            }
                        });
                    }
                },
                ceaseFire: function(i) {
                    return cease_fire;
                }
            })

            $('#search').keydown(function(){
                clearTimeout(timer); 
                timer = setTimeout(getUser, 1000)
            });

            $('#create-chat').click(function (e) { 
                e.preventDefault();
                $('#chat').removeClass('active');
            });

            $('#chat, #settings, #user, #mobile-user').click(function (e) { 
                e.preventDefault();
                $('#create-chat').removeClass('active');
            });

            $('#search').select2({
                ajax: {
                    url: '/users/index',
                    dataType: 'json',
                    data: function (params) {
                        var query = {
                            search: params.term
                        }
                        return query;
                    },
                    processResults: function (data) {
                        // Transforms the top-level key of the response object from 'items' to 'results'
                        return {
                            results: data
                        };
                    }
                },
                placeholder: "Search for users here....",
                theme: 'dark-adminlte',
                width: 'resolve',
                minimumInputLength: 3,
                minimumResultsForSearch: 10,
                templateResult: formatOptionState,
                templateSelection: formatSelectionState
            });

            $('#createConversationBtn').click(function (e) { 
                e.preventDefault()
                let data = {
                    receiver_id: $('#search').val(),
                    message: $('#message-create').val(),
                    sender_id: <?php echo AuthComponent::user('User')['id'] ?>
                }
                $.ajax({
                    type: "post",
                    url: "<?php echo Router::url(array('controller' => 'conversations', 'action' => 'add')); ?>",
                    data: data,
                    dataType: "json",
                    success: function (response) {
                        if (response.status == 'ok') {
                            location.href = response.url
                        }else{
                            location.href = response.url
                        }
                    }   
                });
            });
        })

        function formatOptionState(state) {
            if (!state.id) {
                return state.text;
            }
            var baseUrl = "/files/profiles";
            var $state = $(
                '<span><img src="' + baseUrl + '/' + state.image + '" class="img-flag avatar avatar-sm mr-5" /> ' + state.name + '</span>'
            );
            return $state;
        };

        function formatSelectionState(state) {
            if (!state.id) {
                return state.text;
            }

            var baseUrl = "/files/profiles";
            var $state = $(
                '<span><img class="img-flag avatar avatar-xs mr-3 mb-3" /> <span></span></span>'
            );

            // Use .text() instead of HTML string concatenation to avoid script injection issues
            $state.find("span").text(state.name);
            $state.find("img").attr("src", baseUrl + "/" + state.image);

            return $state;
        }
    </script>
</head>
<body>
    <?php 
        $baseURL = '/files/profiles/';
    ?>
    <div class="layout">

        <!-- Navbar -->
        <div class="navigation navbar navbar-light py-lg-7">

            <!-- Brand -->
            <a href="/" class="d-none d-lg-block">
                <img src="/img/logo.png" class="mx-auto fill-primary" data-inject-svg="" alt="" style="height: 46px;">
            </a>

            <!-- Menu -->
            <ul class="nav navbar-nav flex-row flex-lg-column flex-grow-1 justify-content-between py-2 py-lg-0" role="tablist">

                <!-- Chats -->
                <li class="nav-item mt-lg-8 flex-lg-grow-1">
                    <a class="nav-link position-relative p-0 py-2 active" id="chat" data-toggle="tab" href="#tab-content-dialogs" title="Chats" role="tab">
                        <i class="far fa-comment fa-2x"></i>
                        <div class="badge badge-dot badge-primary badge-bottom-center"></div>
                    </a>
                </li>

                <!-- Settings -->
                <li class="nav-item mt-lg-8">
                    <a class="nav-link position-relative p-0 py-2" id="settings" data-toggle="tab" href="#tab-content-settings" title="Settings" role="tab">
                        <i class="fas fa-sliders-h fa-2x"></i>
                    </a>
                </li>

                <!-- Profile: Hidden on lg -->
                <li class="nav-item mt-lg-8 d-block d-lg-none">
                    <a class="nav-link position-relative p-0 py-2" id="mobile-user" data-toggle="tab" href="#tab-content-user" title="User" role="tab">
                        <i class="fa fa-user fa-2x"></i>
                    </a>
                </li>

                <!-- Profile: Hidden on sm -->
                <li class="nav-item mt-lg-8 d-none d-lg-block">
                    <a class="nav-link position-relative p-0 py-2" id="user" data-toggle="tab" href="#tab-content-user" title="User" role="tab">
                        <div class="avatar avatar-sm avatar-online mx-auto">
                            <img class="avatar-img" src="<?php echo $baseURL.AuthComponent::user('User')['image'] ?>" alt="">
                        </div>
                    </a>
                </li>

            </ul>
            <!-- Menu -->
        </div>
        <!-- Navbar -->

        <!-- Sidebar -->
        <div class="sidebar">
            <div class="tab-content h-100" role="tablist">
                <div class="tab-pane fade h-100" id="tab-content-create-chat" role="tabpanel">
                    <div class="d-flex flex-column h-100">

                        <div class="hide-scrollbar">
                            <div class="container-fluid py-6">

                                <!-- Title -->
                                <h2 class="font-bold mb-6">Create group</h2>
                                <!-- Title -->

                                <!-- Search -->
                                    <select style="width: 100%" class="search form-control" id="search"></select>
                                <!-- Search -->

                                <!-- Create chat -->
                                <div class="tab-content" role="tablist">

                                    <!-- Chat details -->
                                    <div id="create-group-details" class="tab-pane fade show active" role="tabpanel">
                                        <div class="form-group mb-0">
                                            <label class="small" for="message-create">Message</label>
                                            <textarea class="form-control" name="message-create" id="message-create" rows="6" placeholder="Type your message here..."></textarea>
                                        </div>
                                    </div>
                                    <!-- Chat details -->
                                </div>
                                <!-- Create chat -->

                            </div>
                        </div>

                        <!-- Button -->
                        <div class="pb-6">
                            <div class="container-fluid">
                                <button class="btn btn-primary btn-block" id="createConversationBtn" type="submit">Create Conversation</button>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="tab-pane fade h-100 show active" id="tab-content-dialogs" role="tabpanel">
                    <div class="d-flex flex-column h-100">

                        <div class="hide-scrollbar" id="conversation-container2">
                            <div class="container-fluid py-6">

                                <!-- Title -->
                                <h2 class="font-bold mb-6">Chats <a href="#tab-content-create-chat" id="create-chat" data-toggle="tab" class="btn btn-primary btn-sm float-right m-0" role="tab" aria-selected="true">New Message <i class="fas fa-location-arrow ml-2"></i></a></h2>
                                <hr>
                                <!-- Title -->

                                <!-- Chats -->
                                <nav class="nav d-block list-discussions-js mb-n6" id="conversation-container">
                                    <!-- Chat link -->
                                    <?php 
                                        $conversations = $this->Session->read('conversations')['conversations'];
                                        if (empty($conversations)) {
                                            echo '<div class="text-center"><small>No Conversations yet!</small></div>';
                                        }
                                    ?>
                                    <!-- FIXED(Jann 02/12/2020): fix conversation now showing on the receiver -->
                                    <?php foreach ($conversations as $key => $conversation) { ?>
                                    <a class="text-reset nav-link p-0 mb-6" id="conversation-<?php echo $conversation['Conversation']['id']; ?>" href="/chat/<?php echo $conversation['Conversation']['id'] ?>">
                                        <div class="card card-active-listener">
                                            <div class="card-body">
                                                <div class="media">
                                                
                                                    <div class="avatar mr-5">
                                                        <img class="avatar-img" src="<?php echo $conversation['Sender']['id'] == AuthComponent::user('User')['id'] ? $baseURL.$conversation['Receiver']['image'] : $baseURL.$conversation['Sender']['image'] ?>" alt="Bootstrap Themes">
                                                    </div>
                                                    
                                                    <div class="media-body overflow-hidden">
                                                        <div class="d-flex align-items-center mb-1">
                                                            <h6 class="text-truncate mb-0 mr-auto"><?php echo $conversation['Sender']['id'] == AuthComponent::user('User')['id'] ? $conversation['Receiver']['name'] : $conversation['Sender']['name'] ?></h6>
                                                            <p class="small text-muted text-nowrap ml-4"><?php echo date_format(date_create($conversation['Message'][0]['created']), 'h:i A') ?></p>
                                                        </div>
                                                        <div class="text-truncate"><?php echo $conversation['Message'][count($conversation['Message'])-1]['User']['id'] == AuthComponent::user('User')['id'] ? 'You' : explode(" ", $conversation['Message'][count($conversation['Message'])-1]['User']['name'])[0] ?> : <?php echo $conversation['Message'][count($conversation['Message'])-1]['message'] ?></div>
                                                    </div>
                                                </div>
                                            </div>

                                            <?php 
                                                // filter out messsages that is unred
                                                $unreadMessages = array_filter($conversation['Message'], function($value){
                                                    return is_null($value['read']) && $value['user_id'] != AuthComponent::user('User')['id']; 
                                                });
                                                // count the unred messages to display on frontend
                                                $unreadCount = count($unreadMessages);
                                                // display badge if there are unred messages
                                                if(count($unreadMessages) > 0){
                                                    echo "<div class=\"badge badge-circle badge-danger badge-border-light badge-top-right\">
                                                            <span>{$unreadCount}</span>
                                                        </div>";
                                                }

                                            ?>
                                            
                                            
                                        </div>
                                    </a>
                                    <!-- Chat link -->
                                    <?php } ?>
                                </nav>
                                <!-- Chats -->

                            </div>
                        </div>

                    </div>
                </div>

                <div class="tab-pane fade h-100" id="tab-content-settings" role="tabpanel">
                    <div class="d-flex flex-column h-100">

                        <div class="hide-scrollbar">
                            <div class="container-fluid py-6">

                                <!-- Title -->
                                <h2 class="font-bold mb-6">Settings</h2>
                                <!-- Title -->

                                <!-- Accordion -->
                                <div class="accordion mb-n6" id="profile-settings">

                                    <!-- Card -->
                                    <div class="card mb-6">
                                        <div class="card-header position-relative">
                                            <a href="#" class="text-reset d-block stretched-link collapsed" data-toggle="collapse" data-target="#profile-settings-account" aria-controls="profile-settings-account" aria-expanded="true">
                                                <div class="row no-gutters align-items-center">
                                                    <!-- Title -->
                                                    <div class="col">
                                                        <h5>Account</h5>
                                                        <p>Update your profile details.</p>
                                                    </div>

                                                    <!-- Icon -->
                                                    <div class="col-auto">
                                                        <i class="far fa-user-circle fa-2x"></i>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>

                                        <div id="profile-settings-account" class="collapse" data-parent="#profile-settings">
                                            <div class="card-body">
                                                <!-- <form id='profile-form' enctype="multipart/form-data", charset="utf-8"> -->
                                                <?php echo $this->Form->create(false, array( 'enctype' => 'multipart/form-data', 'url' => '/users/edit/'. AuthComponent::user('User')['id'])); ?>
                                                    <input type="hidden" name="id" id="profile-id" value="<?php echo AuthComponent::user('User')['id']; ?>">
                                                    <!-- Avatar -->
                                                    <div class="form-group">
                                                        <label class="small">Avatar</label>
                                                        <div class="bg-secondary rounded p-6">
                                                            <div class="media">
                                                                <div class="avatar bg-primary text-white mr-5">
                                                                    <img src="<?php echo $baseURL.AuthComponent::user('User')['image'] ?>">
                                                                </div>
                                                                <div class="media-body">
                                                                    <label class="btn btn-sm btn-primary mb-3">
                                                                        Upload photo
                                                                        <input type="file" name="data[image]" id="upload-chat-photo" class="d-none" label=''>
                                                                    </label>
                                                                    <p class="small text-muted">You can upload jpg, gif or png image files. Max file size 3mb.</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="small" for="name">Name</label>
                                                        <input name="name" id="name" type="text" class="form-control" placeholder="Type your fullname" value="<?php echo AuthComponent::user('User')['name'] ?>">
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="small" for="email">Email</label>
                                                        <input name="email" id="email" type="email" class="form-control" placeholder="you@yoursite.com" value="<?php echo AuthComponent::user('User')['email'] ?>">
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="small" for="gender">Gender</label>
                                                        <select name="gender" id="gender" class='form-control'>
                                                            <option value="" hidden>Choose your Gender</option>
                                                            <option value="m" <?php echo AuthComponent::user('User')['gender'] == 'm' ? 'selected' : '' ?>>Male</option>
                                                            <option value="f" <?php echo AuthComponent::user('User')['gender'] == 'f' ? 'selected' : '' ?>>Female</option>
                                                            <option value="o" <?php echo AuthComponent::user('User')['gender'] == 'o' ? 'selected' : '' ?>>Others</option>
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="small" for="birthdate">Birthdate</label>
                                                        <input name="birthdate" id="birthdate" type="date" class="form-control" placeholder="you@yoursite.com" value="<?php echo AuthComponent::user('User')['birthdate'] ?>">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="hubby">Hubby</label>
                                                        <textarea class="form-control" id="hubby" rows="3" name="hubby" placeholder="Express yourself" data-autosize="true"><?php echo AuthComponent::user('User')['hubby'] ?></textarea>
                                                    </div>
                                                    <?php echo $this->Form->end(array('label' => 'Save Preferences', 'class' => 'btn btn-primary btn-block')); ?>
                                                    <!-- <button id="profile-edit-submit" class="btn btn-primary btn-block">Save Preferences</button>
                                                </form> -->
                                            </div>
                                        </div><!-- .collapse -->

                                    </div>
                                    <!-- Card -->

                                    <!-- Card -->
                                    <div class="card mb-6">
                                        <div class="card-header position-relative">
                                            <a href="#" class="text-reset d-block stretched-link collapsed" data-toggle="collapse" data-target="#profile-settings-security" aria-expanded="true" aria-controls="profile-settings-security">
                                                <div class="row no-gutters align-items-center">
                                                    <!-- Title -->
                                                    <div class="col">
                                                        <h5>Security</h5>
                                                        <p>Update your profile details.</p>
                                                    </div>

                                                    <!-- Icon -->
                                                    <div class="col-auto">
                                                        <i class="fas fa-user-shield fa-2x"></i>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>

                                        <div id="profile-settings-security" class="collapse" data-parent="#profile-settings">
                                            <div class="card-body">
                                                <?php echo $this->Form->create('false', array('url' => Router::url(array('controller' => 'users', 'action' => 'editPassword', 'id' => AuthComponent::user('User')['id'])))); ?>
                                                    <div class="form-group">
                                                        <label class="small" for="current-password">Current Password</label>
                                                        <input name="current-password" id="current-password" type="password" class="form-control" placeholder="Current Password">
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="small" for="password">New Password</label>
                                                        <input name="password" id="password" type="password" class="form-control" placeholder="New Password">
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="small" for="confirm_password">Verify Password</label>
                                                        <input name="confirm_password" id="confirm_password" type="password" class="form-control" placeholder="Verify Password">
                                                </div>
                                                <?php echo $this->Form->end(array('label' => 'Change Password', 'class' => 'btn btn-primary btn-block')); ?>
                                            </div>
                                        </div><!-- .collapse -->

                                    </div>
                                    <!-- Card -->

                                </div>
                                <!-- Accordion -->

                            </div>
                        </div>

                    </div>
                </div>

                <div class="tab-pane fade h-100" id="tab-content-user" role="tabpanel">
                    <div class="d-flex flex-column h-100">

                        <div class="hide-scrollbar">
                            <div class="container-fluid py-6">

                                <!-- Title -->
                                <h2 class="font-bold mb-6">Profile</h2>
                                <!-- Title -->

                                <!-- Search -->
                                <form class="mb-6">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Search for messages or users..." aria-label="Search for messages or users...">
                                        <div class="input-group-append">
                                            <button class="btn btn-ico btn-secondary btn-minimal" type="submit">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                                <!-- Search -->

                                <!-- Card -->
                                <div class="card mb-6">
                                    <div class="card-body">
                                        <div class="text-center py-6">
                                            <!-- Photo -->
                                            <div class="avatar avatar-xl mb-5">
                                                <img class="avatar-img" src="<?php echo $baseURL.AuthComponent::user('User')['image'] ?>" alt="">
                                            </div>

                                            <h5><?php echo AuthComponent::user('User')['name'] ?></h5>
                                            <p class="text-muted"><?php echo AuthComponent::user('User')['hubby'] ?></p>
                                        </div>
                                    </div>
                                </div>
                                <!-- Card -->

                                <!-- Card -->
                                <div class="card mb-6">
                                    <div class="card-body">
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item px-0 py-6">
                                                <div class="media align-items-center">
                                                    <div class="media-body">
                                                        <p class="small text-muted mb-0">Gender</p>
                                                        <?php
                                                            $gender = '';
                                                            switch (AuthComponent::user('User')['gender']) {
                                                                case 'm':
                                                                    echo $gender = 'Male';
                                                                    break;
                                                                
                                                                case 'f':
                                                                    echo $gender = 'Female';
                                                                    break;
                                                                
                                                                default:
                                                                    echo $gender = 'Others';
                                                                    break;
                                                            }
                                                        ?>
                                                    </div>
                                                    <?php
                                                        switch (AuthComponent::user('User')['gender']) {
                                                            case 'm':
                                                                echo '<i class="fas fa-mars"></i>';
                                                                break;
                                                            
                                                            case 'f':
                                                                echo '<i class="fas fa-venus"></i>';
                                                                break;
                                                            
                                                            default:
                                                                echo '<i class="fas fa-genderless"></i>';
                                                                break;
                                                        }
                                                    ?>
                                                </div>
                                            </li>

                                            <li class="list-group-item px-0 py-6">
                                                <div class="media align-items-center">
                                                    <div class="media-body">
                                                        <p class="small text-muted mb-0">Email</p>
                                                        <p><?php echo AuthComponent::user('User')['email'] ?></p>
                                                    </div>
                                                    <i class="far fa-envelope"></i>
                                                </div>
                                            </li>

                                            <li class="list-group-item px-0 py-6">
                                                <div class="media align-items-center">
                                                    <div class="media-body">
                                                        <p class="small text-muted mb-0">Birthday</p>
                                                        <p><?php echo date_format(date_create(AuthComponent::user('User')['birthdate']), 'M d, Y'); ?></p>
                                                    </div>
                                                    <i class="fas fa-birthday-cake"></i>
                                                </div>
                                            </li>

                                            <li class="list-group-item px-0 py-6">
                                                <div class="media align-items-center">
                                                    <div class="media-body">
                                                        <p class="small text-muted mb-0">Last Login Time</p>
                                                        <p><?php echo date_format(date_create(AuthComponent::user('User')['last_login_time']), 'h:i A') ?></p>
                                                    </div>
                                                    <i class="far fa-clock"></i>
                                                </div>
                                            </li>

                                            <li class="list-group-item px-0 py-6">
                                                <div class="media align-items-center">
                                                    <div class="media-body">
                                                        <p class="small text-muted mb-0">Joined</p>
                                                        <p><?php echo date_format(date_create(AuthComponent::user('User')['created']), 'M d, Y') ?></p>
                                                    </div>
                                                    <i class="fas fa-sign-in-alt"></i>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- Card -->

                                <!-- Button -->
                                <a href="/logout" class="btn btn-block btn-secondary d-flex align-items-center">
                                    Logout
                                    <i class="fas fa-power-off ml-auto"></i>
                                </a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Sidebar -->

        <!-- Main Content -->
        <div class="main" data-mobile-height>
            
            <!-- Render Views Here -->				
                <?php echo $this->Flash->render(); ?>
                
                <?php echo $this->fetch('content'); ?>
            <!-- Render Views Here -->

        </div>
        <!-- Main Content -->

    </div>
    <!-- Layout -->
</body>
</html>
