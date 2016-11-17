<div class="recipes index">
	<h2><?php echo __('レシピ一覧'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('レシピ名'); ?></th>
			<th><?php echo $this->Paginator->sort('カテゴリ'); ?></th>
			<th><?php echo $this->Paginator->sort('季節'); ?></th>
			<th><?php echo $this->Paginator->sort('カロリー'); ?></th>
			<th><?php echo $this->Paginator->sort('脂質'); ?></th>
			<th><?php echo $this->Paginator->sort('タンパク質'); ?></th>
			<th class="actions"><?php echo __('操作'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($recipes as $recipe): ?>
	<tr>
		<td><?php echo h($recipe['Recipe']['name']); ?>&nbsp;</td>
		<td><?php echo h($recipe['Recipe']['category']); ?>&nbsp;</td>
		<td><?php echo h($recipe['Recipe']['season']); ?>&nbsp;</td>
		<td><?php echo h($recipe['Recipe']['cal']); ?>&nbsp;</td>
		<td><?php echo h($recipe['Recipe']['fat']); ?>&nbsp;</td>
		<td><?php echo h($recipe['Recipe']['protain']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('レシピの確認'), array('action' => 'view', $recipe['Recipe']['id'])); ?>
			<?php echo $this->Html->link(__('レシピの編集'), array('action' => 'edit', $recipe['Recipe']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</tbody>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
		'format' => __('{:page}/{:pages}ページ, {:current}品目中の{:count}品目を表示しています。')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('前ページ'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('次ページ') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<!--<h3><?php echo __('Actions'); ?></h3>-->
	<ul>
		<li><?php echo $this->Html->link(__('新しいレシピを登録'), array('action' => 'add')); ?></li>
		<!--<li><?php echo $this->Html->link(__('List Ingredients'), array('controller' => 'ingredients', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Ingredient'), array('controller' => 'ingredients', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Steps'), array('controller' => 'steps', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Step'), array('controller' => 'steps', 'action' => 'add')); ?> </li>-->
	</ul>
</div>
