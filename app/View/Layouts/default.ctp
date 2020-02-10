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
    <script>
        function getIndex(e, index){
            e.preventDefault()
            document.cookie = `${index}`
            location.href = event.currentTarget.getAttribute('href')
        }
    </script>
	<?php
		echo $this->Html->meta('icon', '/img/logo.png');
		echo $this->Html->css('style.css');
		echo $this->Html->css('template.min.css');
		echo $this->Html->css('template.dark.min.css', array('media' => '(prefers-color-scheme: dark)'));
		echo $this->Html->script('https://use.fontawesome.com/releases/v5.12.0/js/all.js');
		echo $this->Html->script('https://use.fontawesome.com/releases/v5.12.0/js/v4-shims.js');
		echo $this->Html->script('jquery.min.js');
		echo $this->Html->script('bootstrap.bundle.min.js');
		echo $this->Html->script('plugins.bundle.js');
		echo $this->Html->script('template.js');
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
	<!-- <div id="container">
		<div id="header">
			<div class="title"><h1><?php echo $this->Html->link('MessageBoard: An online chat system', '/'); ?></h1></div>
			<div class="login-logout"><a href="http://">Login</a> <span>|</span> <a href="http://">Register</a></div>
		</div>
		<div id="content">

		</div> -->
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
                        <a class="nav-link position-relative p-0 py-2 active" data-toggle="tab" href="#tab-content-dialogs" title="Chats" role="tab">
							<i class="far fa-comment fa-2x"></i>
                            <div class="badge badge-dot badge-primary badge-bottom-center"></div>
                        </a>
                    </li>

                    <!-- Settings -->
                    <li class="nav-item mt-lg-8">
                        <a class="nav-link position-relative p-0 py-2" data-toggle="tab" href="#tab-content-settings" title="Settings" role="tab">
							<i class="fas fa-sliders-h fa-2x"></i>
                        </a>
                    </li>

                    <!-- Profile: Hidden on lg -->
                    <li class="nav-item mt-lg-8 d-block d-lg-none">
                        <a class="nav-link position-relative p-0 py-2" data-toggle="tab" href="#tab-content-user" title="User" role="tab">
                            <i class="fa fa-user fa-2x"></i>
                        </a>
                    </li>

                    <!-- Profile: Hidden on sm -->
                    <li class="nav-item mt-lg-8 d-none d-lg-block">
                        <a class="nav-link position-relative p-0 py-2" data-toggle="tab" href="#tab-content-user" title="User" role="tab">
                            <div class="avatar avatar-sm avatar-online mx-auto">
                                <img class="avatar-img" src="/files/profiles/<?php echo AuthComponent::user('User')['image'] ?>" alt="">
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

                                    <!-- Tabs -->
                                    <ul class="nav nav-tabs nav-justified mb-6" role="tablist">
                                        <li class="nav-item">
                                            <a href="#create-group-details" class="nav-link active" data-toggle="tab" role="tab" aria-selected="true">Details</a>
                                        </li>

                                        <li class="nav-item">
                                            <a href="#create-group-members" class="nav-link" data-toggle="tab" role="tab" aria-selected="false">Members</a>
                                        </li>
                                    </ul>
                                    <!-- Tabs -->

                                    <!-- Create chat -->
                                    <div class="tab-content" role="tablist">

                                        <!-- Chat details -->
                                        <div id="create-group-details" class="tab-pane fade show active" role="tabpanel">
                                            <form action="#">
                                                <div class="form-group">
                                                    <label class="small">Photo</label>
                                                    <div class="position-relative text-center bg-secondary rounded p-6">
                                                        <div class="avatar bg-primary text-white mb-5">
                                                            <i class="icon-md fe-image"></i>
                                                        </div>

                                                        <p class="small text-muted mb-0">You can upload jpg, gif or png files. <br> Max file size 3mb.</p>
                                                        <input id="photo" class="d-none" type="file">
                                                        <label class="stretched-label mb-0" for="photo"></label>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="small" for="new-chat-title">Title</label>
                                                    <input name="new-chat-title" id="new-chat-title" type="text" class="form-control" placeholder="Group name">
                                                </div>

                                                <div class="form-group mb-0">
                                                    <label class="small" for="new-chat-description">Description</label>
                                                    <textarea class="form-control" name="new-chat-description" id="new-chat-description" rows="6" placeholder="Group description..."></textarea>
                                                </div>
                                            </form>
                                        </div>
                                        <!-- Chat details -->

                                        <!-- Chat Members -->
                                        <div id="create-group-members" class="tab-pane fade" role="tabpanel">
                                            <nav class="list-group list-group-flush mb-n6">

                                                <div class="mb-6">
                                                    <small class="text-uppercase">A</small>
                                                </div>

                                                <!-- Friend -->
                                                <div class="card mb-6">
                                                    <div class="card-body">

                                                        <div class="media">
                                                            
                                                            <div class="avatar avatar-online mr-5">
                                                                <img class="avatar-img" src="/files/profiles/<?php echo AuthComponent::user('User')['image'] ?>" alt="Anna Bridges">
                                                            </div>
                                                            
                                                            

                                                            <div class="media-body align-self-center mr-6">
                                                                <h6 class="mb-0">Anna Bridges</h6>
                                                                <small class="text-muted">Online</small>
                                                            </div>

                                                            <div class="align-self-center ml-auto">
                                                                <div class="custom-control custom-checkbox">
                                                                    <input class="custom-control-input" id="id-user-1" type="checkbox">
                                                                    <label class="custom-control-label" for="id-user-1"></label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <!-- Label -->
                                                    <label class="stretched-label" for="id-user-1"></label>
                                                </div>
                                                <!-- Friend -->
                                            </nav>
                                        </div>
                                        <!-- Chat Members -->

                                    </div>
                                    <!-- Create chat -->

                                </div>
                            </div>

                            <!-- Button -->
                            <div class="pb-6">
                                <div class="container-fluid">
                                    <button class="btn btn-primary btn-block" type="submit">Create group</button>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="tab-pane fade h-100 show active" id="tab-content-dialogs" role="tabpanel">
                        <div class="d-flex flex-column h-100">

                            <div class="hide-scrollbar">
                                <div class="container-fluid py-6">

                                    <!-- Title -->
                                    <h2 class="font-bold mb-6">Chats <a href="#" class="btn btn-primary btn-sm float-right m-0">New Message <i class="fas fa-location-arrow ml-2"></i></a></h2>
                                    
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

                                    <!-- Chats -->
                                    <nav class="nav d-block list-discussions-js mb-n6" id="conversation-container">
                                        <!-- Chat link -->
                                        <?php 
                                            $conversations = $this->Session->read('conversations')['conversations'];
                                            if (empty($conversations)) {
                                                echo '<div class="text-center"><small>No Conversations yet!</small></div>';
                                            }
                                        ?>
                                        <?php foreach ($conversations as $key => $conversation) { ?>
                                        <a class="text-reset nav-link p-0 mb-6" onclick="getIndex(event, <?php echo $key ?>)" href="/chat/<?php echo $conversation['Conversation']['id'] ?>">
                                            <div class="card card-active-listener">
                                                <div class="card-body">
                                                    <div class="media">
                                                    
                                                        <div class="avatar mr-5">
                                                            <img class="avatar-img" src="/files/profiles/<?php echo $conversation['Sender']['image'] ?>" alt="Bootstrap Themes">
                                                        </div>
                                                        
                                                        <div class="media-body overflow-hidden">
                                                            <div class="d-flex align-items-center mb-1">
                                                                <h6 class="text-truncate mb-0 mr-auto"><?php echo $conversation['Sender']['name'] ?></h6>
                                                                <p class="small text-muted text-nowrap ml-4"><?php echo date_format(date_create($conversation['Message'][0]['created']), 'H:i A') ?></p>
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
                                                                        <img src="/files/profiles/<?php echo AuthComponent::user('User')['image'] ?>">
                                                                    </div>
                                                                    <div class="media-body">
                                                                        <label class="btn btn-sm btn-primary mb-3">
                                                                            Upload photo
                                                                            <!-- <input type="file" name="image" id="image" class="d-none" required> -->
                                                                            <?php echo $this->Form->input('image', array('class' => 'd-none', 'id' => 'upload-chat-photo', 'type' => 'file', 'label' => '')); ?>
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
                                                    <form action="#">
                                                        <div class="form-group">
                                                            <label class="small" for="current-password">Current Password</label>
                                                            <input name="current-password" id="current-password" type="password" class="form-control" placeholder="Current Password">
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="small" for="new-password">New Password</label>
                                                            <input name="new-password" id="new-password" type="password" class="form-control" placeholder="New Password">
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="small" for="verify-password">Verify Password</label>
                                                            <input name="verify-password" id="verify-password" type="password" class="form-control" placeholder="Verify Password">
                                                        </div>

                                                        <button class="btn btn-primary btn-block" type="submit">
                                                            Change Password
                                                        </button>
                                                    </form>
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
                                                    <img class="avatar-img" src="/files/profiles/<?php echo AuthComponent::user('User')['image'] ?>" alt="">
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
                                                            $gender = '';
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
                                                            <p><?php $date = date_create(AuthComponent::user('User')['birthdate']); echo date_format($date, 'M d, Y'); ?></p>
                                                        </div>
                                                        <i class="fas fa-birthday-cake"></i>
                                                    </div>
                                                </li>

                                                <li class="list-group-item px-0 py-6">
                                                    <div class="media align-items-center">
                                                        <div class="media-body">
                                                            <p class="small text-muted mb-0">Last Login Time</p>
                                                            <p><?php echo date_format(date_create(AuthComponent::user('User')['last_login_time']), 'H:i A') ?></p>
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

		<!-- <div id="footer">
			<?php echo $this->Html->link(
					$this->Html->image('cake.power.gif', array('alt' => $cakeDescription, 'border' => '0')),
					'https://cakephp.org/',
					array('target' => '_blank', 'escape' => false, 'id' => 'cake-powered')
				);
			?>
			<p>
				<?php echo $cakeVersion; ?>
			</p>
		</div> -->
	</div>
    <?php echo $this->element('sql_dump'); ?>
</body>
</html>
