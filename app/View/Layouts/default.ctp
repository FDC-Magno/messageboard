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

                    <div class="tab-pane fade h-100" id="tab-content-friends" role="tabpanel">
                        <div class="d-flex flex-column h-100">

                            <div class="hide-scrollbar">
                                <div class="container-fluid py-6">

                                    <!-- Title -->
                                    <h2 class="font-bold mb-6">User List</h2>
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
                                                        <img class="avatar-img" src="/files/profiles/<?php echo AuthComponent::user('User')['image'] ?>" alt="Anna Bridges">
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
                                                            <img class="avatar-img" src="/files/profiles/<?php echo AuthComponent::user('User')['image'] ?>" alt="Bootstrap Themes">
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
                                                            <p><?php echo AuthComponent::user('User')['last_login_time'] ?></p>
                                                        </div>
                                                        <i class="far fa-clock"></i>
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
    <script>
        $(function(){
            $('#profile-edit-submit').click(function (e) { 
                e.preventDefault()
                console.log($('#profile-form')[0])
                let id = $('#profile-id').val();
                $.ajax({
                    url: `/users/edit/${id}`,
                    type: 'put',
                    dataType: 'json',
                    data: $('#profile-form').serialize(),
                    success: function(data) {
                        console.log(data)
                    },
                    error: function(error){
                        console.log(error)
                    }
                });
            });
            
        })
    </script>
</body>
</html>
