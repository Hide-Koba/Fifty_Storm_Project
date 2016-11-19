<div class="recipes view">
<h2><?php echo __('レシピ'); ?></h2>
	<dl>
		<dt><?php echo __('レシピ名'); ?></dt>
		<dd>
			<?php echo h($recipe['Recipe']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('カテゴリー'); ?></dt>
		<dd>
			<?php 
			switch($recipe['Recipe']['category']){
				case 0:
					echo "主食";
					break;
				case 1:
					echo "主菜";
					break;
				case 2:
					echo "副菜 和え物";
					break;
				case 3:
					echo "副菜 煮物";
					break;
				case 4:
					echo "副菜 サラダ";
					break;
				case 5:
					echo "副菜 その他(焼き物など)";
					break;
				case 6:
					echo "汁";
					break;
				default:
					break;
			} ?>
			&nbsp;
		</dd>
		<dt><?php echo __('アドバイス'); ?></dt>
		<dd>
			<?php echo h($recipe['Recipe']['advise']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('季節'); ?></dt>
		<dd>
			<?php
				switch($recipe['Recipe']['season']){
				case 0:
					echo "春";
					break;
				case 1:
					echo "夏";
					break;
				case 2:
					echo "秋";
					break;
				case 3:
					echo "冬";
					break;
				case 4:
					echo "一年を通じて";
				default:
					break;		
			} 
			 ?>
			&nbsp;
		</dd>
		<dt><?php echo __('カロリー'); ?></dt>
		<dd>
			<?php echo h($recipe['Recipe']['cal']); ?> カロリー
			&nbsp;
		</dd>
		<dt><?php echo __('脂質'); ?></dt>
		<dd>
			<?php echo h($recipe['Recipe']['fat']); ?> g
			&nbsp;
		</dd>
		<dt><?php echo __('タンパク質'); ?></dt>
		<dd>
			<?php echo h($recipe['Recipe']['protain']); ?> g
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('レシピを編集する'), array('action' => 'edit', $recipe['Recipe']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('レシピを削除する'), array('action' => 'delete', $recipe['Recipe']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $recipe['Recipe']['id']))); ?> </li>
		<li><?php echo $this->Html->link(__('一覧へ戻る'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('新しいレシピを登録する'), array('action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('素材リスト'); ?></h3>
	<?php if (!empty($recipe['Ingredient'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('名前'); ?></th>
		<th><?php echo __('重さ'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($recipe['Ingredient'] as $ingredient): ?>
		<tr>
			<td><?php echo $ingredient['name']; ?></td>
			<td><?php echo $ingredient['weight']; ?> <?php 
				switch($ingredient['weight_category']){
					case 0: echo "g";break;
					case 1: echo "cc";break;
					case 2:echo "手量り"; break;
				} ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('編集'), array('controller' => 'ingredients', 'action' => 'edit', $ingredient['id'])); ?>
				<?php echo $this->Form->postLink(__('削除'), array('controller' => 'ingredients', 'action' => 'delete', $ingredient['id']), array('confirm' => __('Are you sure you want to delete # %s?', $ingredient['id']))); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('材料を追加'), array('controller' => 'ingredients', 'action' => 'add',$recipe['Recipe']['id'])); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Steps'); ?></h3>
	<?php if (!empty($recipe['Step'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Step Count'); ?></th>
		<th><?php echo __('Comment'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($recipe['Step'] as $step): ?>
		<tr>
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
