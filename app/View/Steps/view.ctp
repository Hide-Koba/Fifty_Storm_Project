<div class="steps view">
<h2><?php echo __('Step'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($step['Step']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Recipe'); ?></dt>
		<dd>
			<?php echo $this->Html->link($step['Recipe']['name'], array('controller' => 'recipes', 'action' => 'view', $step['Recipe']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Step Count'); ?></dt>
		<dd>
			<?php echo h($step['Step']['step_count']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Comment'); ?></dt>
		<dd>
			<?php echo h($step['Step']['comment']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Step'), array('action' => 'edit', $step['Step']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Step'), array('action' => 'delete', $step['Step']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $step['Step']['id']))); ?> </li>
		<li><?php echo $this->Html->link(__('List Steps'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Step'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Recipes'), array('controller' => 'recipes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Recipe'), array('controller' => 'recipes', 'action' => 'add')); ?> </li>
	</ul>
</div>
