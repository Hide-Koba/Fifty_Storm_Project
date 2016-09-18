<div class="recipes index">
	<h2><?php echo __('レシピ一覧'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('name','レシピ名'); ?></th>
			<th><?php echo $this->Paginator->sort('category','カテゴリ'); ?></th>
			<th><?php echo $this->Paginator->sort('advise','アドバイス'); ?></th>
			<th><?php echo $this->Paginator->sort('season','季節'); ?></th>
			<th><?php echo $this->Paginator->sort('cal','カロリー'); ?></th>
			<th><?php echo $this->Paginator->sort('fat','脂質'); ?></th>
			<th><?php echo $this->Paginator->sort('protain','タンパク質'); ?></th>
			<th class="actions"><?php echo __('操作'); ?></th>
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
			<?php echo $this->Html->link(__('レシピの確認'), array('action' => 'view', $recipe['Recipe']['id'])); ?>
			<?php echo $this->Html->link(__('レシピの編集'), array('action' => 'edit', $recipe['Recipe']['id'])); ?>
			<?php //echo $this->Form->postLink(__('レシピの削除'), array('action' => 'delete', $recipe['Recipe']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $recipe['Recipe']['id']))); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</tbody>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
		'format' => __(' {:page} / {:pages}ページ, {:count} レシピ中の{:current} を表示しています。')
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
	<h3><?php //echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('新しいメニューを登録'), array('action' => 'add')); ?></li>
	</ul>
</div>
