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
		<li><?php echo $this->Html->link(__('List Ingredients'), array('controller' => 'ingredients', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Ingredient'), array('controller' => 'ingredients', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Steps'), array('controller' => 'steps', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Step'), array('controller' => 'steps', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Ingredients'); ?></h3>
	<?php if (!empty($recipe['Ingredient'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Recipe Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Weight'); ?></th>
		<th><?php echo __('Weight Category'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($recipe['Ingredient'] as $ingredient): ?>
		<tr>
			<td><?php echo $ingredient['id']; ?></td>
			<td><?php echo $ingredient['recipe_id']; ?></td>
			<td><?php echo $ingredient['name']; ?></td>
			<td><?php echo $ingredient['weight']; ?></td>
			<td><?php echo $ingredient['weight_category']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'ingredients', 'action' => 'view', $ingredient['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'ingredients', 'action' => 'edit', $ingredient['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'ingredients', 'action' => 'delete', $ingredient['id']), array('confirm' => __('Are you sure you want to delete # %s?', $ingredient['id']))); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Ingredient'), array('controller' => 'ingredients', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Steps'); ?></h3>
	<?php if (!empty($recipe['Step'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Recipe Id'); ?></th>
		<th><?php echo __('Step Count'); ?></th>
		<th><?php echo __('Comment'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($recipe['Step'] as $step): ?>
		<tr>
			<td><?php echo $step['id']; ?></td>
			<td><?php echo $step['recipe_id']; ?></td>
			<td><?php echo $step['step_count']; ?></td>
			<td><?php echo $step['comment']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'steps', 'action' => 'view', $step['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'steps', 'action' => 'edit', $step['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'steps', 'action' => 'delete', $step['id']), array('confirm' => __('Are you sure you want to delete # %s?', $step['id']))); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Step'), array('controller' => 'steps', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
