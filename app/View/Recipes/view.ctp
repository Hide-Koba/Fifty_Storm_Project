<div class="recipes view">
<h2><?php echo __('レシピ'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($recipe['Recipe']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('レシピ名'); ?></dt>
		<dd>
			<?php echo h($recipe['Recipe']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('カテゴリ'); ?></dt>
		<dd>
			<?php echo h($recipe['Recipe']['category']); ?>
			&nbsp;
		</dd>
		<dt>
			<?php echo __('材料');?>
		</dt>
		<dd>
			<?php
				$i=0;
				foreach ($recipe['Ingredient'] as $key=>$var){
					echo "".$recipe['Ingredient'][$i]['name'].": ".$recipe['Ingredient'][$i]['weight']." ".$recipe['Ingredient'][$i]['weight_category']."<br />";
					$i++;
				}
			?>
		</dd>
		<dt>
			<?php echo __('作り方');?>
		</dt>
		<dd>
			<?php
				$i=0;
				foreach ($recipe['Step'] as $key=>$var){
					echo "".$recipe['Step'][$i]['step_count'].": ".$recipe['Step'][$i]['comment']."<br />";
					$i++;
				}
			?>
		</dd>
		<dt><?php echo __('アドバイス'); ?></dt>
		<dd>
			<?php echo h($recipe['Recipe']['advise']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('季節'); ?></dt>
		<dd>
			<?php echo h($recipe['Recipe']['season']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('カロリー'); ?></dt>
		<dd>
			<?php echo h($recipe['Recipe']['cal']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('脂質'); ?></dt>
		<dd>
			<?php echo h($recipe['Recipe']['fat']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('タンパク質'); ?></dt>
		<dd>
			<?php echo h($recipe['Recipe']['protain']); ?>
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
