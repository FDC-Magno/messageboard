<div class="conversations view">
<h2><?php echo __('Conversation'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($conversation['Conversation']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($conversation['Conversation']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($conversation['Conversation']['modified']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Receiver'); ?></dt>
		<dd>
			<?php echo $this->Html->link($conversation['Receiver']['name'], array('controller' => 'users', 'action' => 'view', $conversation['Receiver']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Conversation'), array('action' => 'edit', $conversation['Conversation']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Conversation'), array('action' => 'delete', $conversation['Conversation']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $conversation['Conversation']['id']))); ?> </li>
		<li><?php echo $this->Html->link(__('List Conversations'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Conversation'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Receiver'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Messages'), array('controller' => 'messages', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Message'), array('controller' => 'messages', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Messages'); ?></h3>
	<?php if (!empty($conversation['Message'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Conversation Id'); ?></th>
		<th><?php echo __('Message'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($conversation['Message'] as $message): ?>
		<tr>
			<td><?php echo $message['id']; ?></td>
			<td><?php echo $message['user_id']; ?></td>
			<td><?php echo $message['conversation_id']; ?></td>
			<td><?php echo $message['message']; ?></td>
			<td><?php echo $message['created']; ?></td>
			<td><?php echo $message['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'messages', 'action' => 'view', $message['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'messages', 'action' => 'edit', $message['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'messages', 'action' => 'delete', $message['id']), array('confirm' => __('Are you sure you want to delete # %s?', $message['id']))); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Message'), array('controller' => 'messages', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
