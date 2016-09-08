<div class="recipes view">
<h2><?php echo __('Recipe'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($recipe['Recipe']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($recipe['Recipe']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Category'); ?></dt>
		<dd>
			<?php echo h($recipe['Recipe']['category']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Advise'); ?></dt>
		<dd>
			<?php echo h($recipe['Recipe']['advise']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Season'); ?></dt>
		<dd>
			<?php echo h($recipe['Recipe']['season']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Cal'); ?></dt>
		<dd>
			<?php echo h($recipe['Recipe']['cal']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Fat'); ?></dt>
		<dd>
			<?php echo h($recipe['Recipe']['fat']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Protain'); ?></dt>
		<dd>
			<?php echo h($recipe['Recipe']['protain']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Recipe'), array('action' => 'edit', $recipe['Recipe']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Recipe'), array('action' => 'delete', $recipe['Recipe']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $recipe['Recipe']['id']))); ?> </li>
		<li><?php echo $this->Html->link(__('List Recipes'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Recipe'), array('action' => 'add')); ?> </li>
	</ul>
</div>
