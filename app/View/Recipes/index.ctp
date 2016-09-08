<div class="recipes index">
	<h2><?php echo __('Recipes'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('category'); ?></th>
			<th><?php echo $this->Paginator->sort('advise'); ?></th>
			<th><?php echo $this->Paginator->sort('season'); ?></th>
			<th><?php echo $this->Paginator->sort('cal'); ?></th>
			<th><?php echo $this->Paginator->sort('fat'); ?></th>
			<th><?php echo $this->Paginator->sort('protain'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($recipes as $recipe): ?>
	<tr>
		<td><?php echo h($recipe['Recipe']['id']); ?>&nbsp;</td>
		<td><?php echo h($recipe['Recipe']['name']); ?>&nbsp;</td>
		<td><?php echo h($recipe['Recipe']['category']); ?>&nbsp;</td>
		<td><?php echo h($recipe['Recipe']['advise']); ?>&nbsp;</td>
		<td><?php echo h($recipe['Recipe']['season']); ?>&nbsp;</td>
		<td><?php echo h($recipe['Recipe']['cal']); ?>&nbsp;</td>
		<td><?php echo h($recipe['Recipe']['fat']); ?>&nbsp;</td>
		<td><?php echo h($recipe['Recipe']['protain']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $recipe['Recipe']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $recipe['Recipe']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $recipe['Recipe']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $recipe['Recipe']['id']))); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</tbody>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
		'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Recipe'), array('action' => 'add')); ?></li>
	</ul>
</div>
