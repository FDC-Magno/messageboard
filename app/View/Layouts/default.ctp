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
		echo $this->Html->css('template.dark.min.css', array('media' => '(prefers-color-scheme: dark)'));
		echo $this->Html->css('style.css');
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

                    <!-- Friend -->
                    <li class="nav-item mt-lg-8">
                        <a class="nav-link position-relative p-0 py-2" data-toggle="tab" href="#tab-content-friends" title="Friends" role="tab">
							<i class="far fa-user fa-2x"></i>
                        </a>
                    </li>

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
                            <i class="icon-lg fe-user"></i>
                        </a>
                    </li>

                    <!-- Profile: Hidden on sm -->
                    <li class="nav-item mt-lg-8 d-none d-lg-block">
                        <a class="nav-link position-relative p-0 py-2" data-toggle="tab" href="#tab-content-user" title="User" role="tab">
                            <div class="avatar avatar-sm avatar-online mx-auto">
                                <img class="avatar-img" src="/img/no-photo.png" alt="">
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
													<i class="far fa-paper-plane"></i>
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
                                                        <input id="upload-chat-photo" class="d-none" type="file">
                                                        <label class="stretched-label mb-0" for="upload-chat-photo"></label>
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
                                                                <img class="avatar-img" src="/img/no-photo.png" alt="Anna Bridges">
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

                    <div class="tab-pane fade h-100" id="tab-content-friends" role="tabpanel">
                        <div class="d-flex flex-column h-100">

                            <div class="hide-scrollbar">
                                <div class="container-fluid py-6">

                                    <!-- Title -->
                                    <h2 class="font-bold mb-6">Friends</h2>
                                    <!-- Title -->

                                    <!-- Search -->
                                    <form class="mb-6">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Search for messages or users..." aria-label="Search for messages or users...">
                                            <div class="input-group-append">
                                                <button class="btn btn-ico btn-secondary btn-minimal" type="submit">
													<i class="far fa-paper-plane"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                    <!-- Search -->

                                    <!-- Button -->
                                    <button type="button" class="btn btn-block btn-secondary d-flex align-items-center mb-6" data-toggle="modal" data-target="#invite-friends">
                                        Invite friends
                                        <i class="fe-users ml-auto"></i>
                                    </button>

                                    <!-- Friends -->
                                    <nav class="mb-n6">

                                        <div class="mb-6">
                                            <small class="text-uppercase">A</small>
                                        </div>

                                        <!-- Friend -->
                                        <div class="card mb-6">
                                            <div class="card-body">

                                                <div class="media">
                                                    
                                                    <div class="avatar avatar-online mr-5">
                                                        <img class="avatar-img" src="/img/no-photo.png" alt="Anna Bridges">
                                                    </div>
                                                    
                                                    
                                                    <div class="media-body align-self-center">
                                                        <h6 class="mb-0">Anna Bridges</h6>
                                                        <small class="text-muted">Online</small>
                                                    </div>

                                                    <div class="align-self-center ml-5">
                                                        <div class="dropdown z-index-max">
                                                            <a href="#" class="btn btn-sm btn-ico btn-link text-muted w-auto" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <i class="fe-more-vertical"></i>
                                                            </a>
                                                            <div class="dropdown-menu">
                                                                <a class="dropdown-item d-flex align-items-center" href="#">
                                                                    New chat <span class="ml-auto fe-edit-2"></span>
                                                                </a>
                                                                <a class="dropdown-item d-flex align-items-center" href="#">
                                                                    Delete <span class="ml-auto fe-trash-2"></span>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Link -->
                                                <a href="chat-2.html" class="stretched-link"></a>

                                            </div>
                                        </div>
                                        <!-- Friend -->
                                    </nav>
                                    <!-- Friends -->

                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="tab-pane fade h-100 show active" id="tab-content-dialogs" role="tabpanel">
                        <div class="d-flex flex-column h-100">

                            <div class="hide-scrollbar">
                                <div class="container-fluid py-6">

                                    <!-- Title -->
                                    <h2 class="font-bold mb-6">Chats</h2>
                                    <!-- Title -->

                                    <!-- Search -->
                                    <form class="mb-6">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Search for messages or users..." aria-label="Search for messages or users...">
                                            <div class="input-group-append">
                                                <button class="btn btn-ico btn-secondary btn-minimal" type="submit">
													<i class="far fa-paper-plane"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                    <!-- Search -->

                                    <!-- Chats -->
                                    <nav class="nav d-block list-discussions-js mb-n6">
                                        <!-- Chat link -->
                                        <a class="text-reset nav-link p-0 mb-6" href="chat-1.html">
                                            <div class="card card-active-listener">
                                                <div class="card-body">

                                                    <div class="media">
                                                        
                                                        
                                                        <div class="avatar mr-5">
                                                            <img class="avatar-img" src="/img/no-photo.png" alt="Bootstrap Themes">
                                                        </div>
                                                        
                                                        <div class="media-body overflow-hidden">
                                                            <div class="d-flex align-items-center mb-1">
                                                                <h6 class="text-truncate mb-0 mr-auto">Bootstrap Themes</h6>
                                                                <p class="small text-muted text-nowrap ml-4">10:42 am</p>
                                                            </div>
                                                            <div class="text-truncate">Anna Bridges: Hey, Maher! How are you? The weather is great isn't it?</div>
                                                        </div>
                                                    </div>

                                                </div>

                                                
                                                <div class="badge badge-circle badge-primary badge-border-light badge-top-right">
                                                    <span>3</span>
                                                </div>
                                                
                                            </div>
                                        </a>
                                        <!-- Chat link -->
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

                                    <!-- Search -->
                                    <form class="mb-6">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Search for messages or users..." aria-label="Search for messages or users...">
                                            <div class="input-group-append">
                                                <button class="btn btn-ico btn-secondary btn-minimal" type="submit">
													<i class="far fa-paper-plane"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                    <!-- Search -->

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
                                                            <i class="text-muted icon-md fe-user"></i>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>

                                            <div id="profile-settings-account" class="collapse" data-parent="#profile-settings">
                                                <div class="card-body">

                                                    <form action="#">
                                                        <!-- Avatar -->
                                                        <div class="form-group">
                                                            <label class="small">Avatar</label>
                                                            <div class="bg-secondary rounded p-6">
                                                                <div class="media">
                                                                    <div class="avatar bg-primary text-white mr-5">
                                                                        <span>DG</span>
                                                                    </div>
                                                                    <div class="media-body">
                                                                        <label class="btn btn-sm btn-primary mb-3">
                                                                            Upload photo
                                                                            <input type="file" class="d-none">
                                                                        </label>
                                                                        <p class="small text-muted">You can upload jpg, gif or png image files. Max file size 3mb.</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="small" for="profile-name">Name</label>
                                                            <input name="profile-name" id="profile-name" type="text" class="form-control" placeholder="Type your name">
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="small" for="profile-email">Email</label>
                                                            <input name="profile-email" id="profile-email" type="email" class="form-control" placeholder="you@yoursite.com">
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="small" for="profile-phone">Phone</label>
                                                            <input name="profile-phone" id="profile-phone" type="text" class="form-control" placeholder="(123) 456-7890">
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="profile-about">Bio</label>
                                                            <textarea class="form-control" id="profile-about" rows="3" placeholder="Express yourself" data-autosize="true"></textarea>
                                                        </div>

                                                        <button class="btn btn-primary btn-block" type="submit">Save Preferences</button>
                                                    </form>

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
                                                            <i class="text-muted icon-md fe-shield"></i>
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

                                        <!-- Card -->
                                        <div class="card mb-6">
                                            <div class="card-header position-relative">
                                                <a href="#" class="text-reset d-block stretched-link collapsed" data-toggle="collapse" data-target="#profile-settings-notifications" aria-controls="profile-settings-notifications" aria-expanded="true">
                                                    <div class="row no-gutters align-items-center">
                                                        <!-- Title -->
                                                        <div class="col">
                                                            <h5>Notifications</h5>
                                                            <p>Update your profile details.</p>
                                                        </div>

                                                        <!-- Icon -->
                                                        <div class="col-auto">
                                                            <i class="text-muted icon-md fe-bell"></i>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>

                                            <div id="profile-settings-notifications" class="collapse" data-parent="#profile-settings">
                                                <div class="card-body">

                                                    <ul class="list-group list-group-flush">
                                                        <li class="list-group-item pt-0 px-0">
                                                            <div class="d-flex align-items-center justify-content-between mb-2">
                                                                <!-- Title -->
                                                                <h6 class="mb-0">Sound</h6>

                                                                <!-- Switch -->
                                                                <div class="custom-control custom-switch mr-n3">
                                                                    <input type="checkbox" class="custom-control-input" id="custom-switch-1">
                                                                    <label class="custom-control-label" for="custom-switch-1"></label>
                                                                </div>
                                                            </div>
                                                            <p>Update your profile details.</p>
                                                        </li>

                                                        <li class="list-group-item px-0">
                                                            <div class="d-flex justify-content-between mb-2">
                                                                <!-- Title -->
                                                                <h6 class="mb-0">Exceptions</h6>

                                                                <!-- Switch -->
                                                                <div class="custom-control custom-switch mr-n3">
                                                                    <input type="checkbox" class="custom-control-input" id="custom-switch-2">
                                                                    <label class="custom-control-label" for="custom-switch-2"></label>
                                                                </div>
                                                            </div>
                                                            <p>Update your profile details.</p>
                                                        </li>

                                                        <li class="list-group-item pb-0 px-0">
                                                            <div class="d-flex justify-content-between mb-2">
                                                                <!-- Title -->
                                                                <h6 class="mb-0">Message Preview</h6>

                                                                <!-- Switch -->
                                                                <div class="custom-control custom-switch mr-n3">
                                                                    <input type="checkbox" class="custom-control-input" id="custom-switch-3">
                                                                    <label class="custom-control-label" for="custom-switch-3"></label>
                                                                </div>
                                                            </div>
                                                            <p>Update your profile details.</p>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div><!-- .collapse -->

                                        </div>
                                        <!-- Card -->

                                        <!-- Card -->
                                        <div class="card mb-6">
                                            <div class="card-header position-relative">
                                                <a href="#" class="text-reset d-block stretched-link collapsed" data-toggle="collapse" data-target="#profile-settings-social" aria-controls="profile-settings-social" aria-expanded="true">
                                                    <div class="row no-gutters align-items-center">
                                                        <!-- Title -->
                                                        <div class="col">
                                                            <h5>Social</h5>
                                                            <p>Update your profile details.</p>
                                                        </div>

                                                        <!-- Icon -->
                                                        <div class="col-auto">
                                                            <i class="text-muted icon-md fe-share-2"></i>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>

                                            <div id="profile-settings-social" class="collapse" data-parent="#profile-settings">
                                                <div class="card-body">

                                                    <form action="#">

                                                        <!-- Twitter -->
                                                        <div class="form-group">
                                                            <label class="small" for="profile-twitter">Twitter</label>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <div class="btn btn-ico btn-secondary btn-minimal">
                                                                        <i class="fe-twitter"></i>
                                                                    </div>
                                                                </div>
                                                                <input id="profile-twitter" type="text" class="form-control" placeholder="Username" aria-label="Username">
                                                            </div>
                                                        </div>

                                                        <!-- Facebook -->
                                                        <div class="form-group">
                                                            <label class="small" for="profile-facebook">Facebook</label>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <div class="btn btn-ico btn-secondary btn-minimal">
                                                                        <i class="fe-facebook"></i>
                                                                    </div>
                                                                </div>
                                                                <input id="profile-facebook" type="text" class="form-control" placeholder="Username" aria-label="Username">
                                                            </div>
                                                        </div>

                                                        <!-- Instagram -->
                                                        <div class="form-group">
                                                            <label class="small" for="profile-instagram">Instagram</label>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <div class="btn btn-ico btn-secondary btn-minimal">
                                                                        <i class="fe-instagram"></i>
                                                                    </div>
                                                                </div>
                                                                <input id="profile-instagram" type="text" class="form-control" placeholder="Username" aria-label="Username">
                                                            </div>
                                                        </div>

                                                        <!-- Github -->
                                                        <div class="form-group">
                                                            <label class="small" for="profile-github">Github</label>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <div class="btn btn-ico btn-secondary btn-minimal">
                                                                        <i class="fe-github"></i>
                                                                    </div>
                                                                </div>
                                                                <input id="profile-github" type="text" class="form-control" placeholder="Username" aria-label="Username">
                                                            </div>
                                                        </div>

                                                        <button class="btn btn-primary btn-block" type="submit">Save Preferences</button>
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
													<i class="far fa-paper-plane"></i>
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
                                                    <img class="avatar-img" src="/img/no-photo.png" alt="">
                                                </div>

                                                <h5>Matthew Wiggins</h5>
                                                <p class="text-muted">Bootstrap is an open source toolkit for developing web with HTML.</p>
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
                                                            <p class="small text-muted mb-0">Country</p>
                                                            <p>Warsaw, Poland</p>
                                                        </div>
                                                        <i class="text-muted icon-sm fe-globe"></i>
                                                    </div>
                                                </li>

                                                <li class="list-group-item px-0 py-6">
                                                    <div class="media align-items-center">
                                                        <div class="media-body">
                                                            <p class="small text-muted mb-0">Phone</p>
                                                            <p>+39 02 87 21 43 19</p>
                                                        </div>
                                                        <i class="text-muted icon-sm fe-mic"></i>
                                                    </div>
                                                </li>

                                                <li class="list-group-item px-0 py-6">
                                                    <div class="media align-items-center">
                                                        <div class="media-body">
                                                            <p class="small text-muted mb-0">Email</p>
                                                            <p>anna@gmail.com</p>
                                                        </div>
                                                        <i class="text-muted icon-sm fe-mail"></i>
                                                    </div>
                                                </li>

                                                <li class="list-group-item px-0 py-6">
                                                    <div class="media align-items-center">
                                                        <div class="media-body">
                                                            <p class="small text-muted mb-0">Time</p>
                                                            <p>10:03 am</p>
                                                        </div>
                                                        <i class="text-muted icon-sm fe-clock"></i>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <!-- Card -->

                                    <!-- Card -->
                                    <div class="card mb-6">
                                        <div class="card-body">
                                            <ul class="list-group list-group-flush">
                                                <li class="list-group-item px-0 py-6">
                                                    <a href="#" class="media text-muted">
                                                        <div class="media-body align-self-center">
                                                            Twitter
                                                        </div>
                                                        <i class="icon-sm fe-twitter"></i>
                                                    </a>
                                                </li>

                                                <li class="list-group-item px-0 py-6">
                                                    <a href="#" class="media text-muted">
                                                        <div class="media-body align-self-center">
                                                        Facebook
                                                        </div>
                                                        <i class="icon-sm fe-facebook"></i>
                                                    </a>
                                                </li>

                                                <li class="list-group-item px-0 py-6">
                                                    <a href="#" class="media text-muted">
                                                        <div class="media-body align-self-center">
                                                            Github
                                                        </div>
                                                        <i class="icon-sm fe-github"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <!-- Card -->

                                    <!-- Button -->
                                    <button type="button" class="btn btn-block btn-secondary d-flex align-items-center">
                                        Logout
                                        <span class="fe-log-out ml-auto"></span>
                                    </button>

                                </div>
                            </div>

                        </div>




                    </div>
                </div>
            </div>
            <!-- Sidebar -->

            <!-- Main Content -->
            <div class="main" data-mobile-height="">
				
				<!-- Render Views Here -->				
					<?php echo $this->Flash->render(); ?>
					
					<?php echo $this->fetch('content'); ?>
				<!-- Render Views Here -->

            </div>
            <!-- Main Content -->

        </div>
        <!-- Layout -->

        <!-- DropzoneJS: Template -->
        <div id="dropzone-template-js">
            <div class="col-lg-6 my-3">
                <div class="card bg-light">
                    <div class="card-body p-3">
                        <div class="media align-items-center">

                            <div class="dropzone-file-preview">
                                <div class="avatar avatar rounded bg-secondary text-basic-inverse d-block mr-5">
                                    <i class="fe-paperclip"></i>
                                </div>
                            </div>

                            <div class="dropzone-image-preview">
                                <div class="avatar avatar mr-5">
                                    <img src="#" class="avatar-img rounded" data-dz-thumbnail="" alt="">
                                </div>
                            </div>

                            <div class="media-body overflow-hidden">
                                <h6 class="text-truncate small mb-0" data-dz-name></h6>
                                <p class="extra-small" data-dz-size></p>
                            </div>

                            <div class="ml-5">
                                <a href="#" class="btn btn-sm btn-link text-decoration-none text-muted" data-dz-remove>
                                    <i class="fe-x"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- DropzoneJS: Template -->

        <!-- Modal: Invite friends -->
        <div class="modal fade" id="invite-friends" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">

                    <div class="modal-header">
                        <div class="media flex-fill">
                            <div class="icon-shape rounded-lg bg-primary text-white mr-5">
                                <i class="fe-users"></i>
                            </div>
                            <div class="media-body align-self-center">
                                <h5 class="modal-title">Invite friends</h5>
                                <p>Invite colleagues, clients and friends.</p>
                            </div>
                        </div>

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <form action="#">
                            <div class="form-group">
                                <label for="invite-email" class="small">Email</label>
                                <input type="text" class="form-control" id="invite-email">
                            </div>

                            <div class="form-group mb-0">
                                <label for="invite-message" class="small">Invitation message</label>
                                <textarea class="form-control" id="invite-message" data-autosize="true"></textarea>
                            </div>
                        </form>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-block btn-primary d-flex align-items-center">
                            Invite friend
                            <i class="fe-user-plus ml-auto"></i>
                        </button>
                    </div>

                </div>
            </div>
        </div>
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
