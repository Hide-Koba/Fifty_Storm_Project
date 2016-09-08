<?php echo $this->Html->script( 'jquery-1.9.1', array( 'inline' => true ) ); ?>
<script>
$(function() {

$('#add-option-button').click(function(event){
	//console.log("test");
    var optionCount = ($('#poll-options > div').size()/3)+1;
    
    var inputHtml = '<div class="input text"><label for="Ingredient' + optionCount + 'Name">材料 ' + optionCount
        + '</label><input id="Ingredient' + optionCount + 'Name" type="text" name="data[Ingredient][' + optionCount + '][name]" />'+
        '</div><div class="input text"><label for="Ingredient' + optionCount + 'weight">数量 ' + optionCount
        + '</label><input id="Ingredient' + optionCount + 'weight" type="text" name="data[Ingredient][' + optionCount + '][weight]" />'+
        '</div><div class="input text"><label for="Ingredient' + optionCount + 'weight_category">単位 ' + optionCount
        + '</label><input id="Ingredient' + optionCount + 'weight_category" type="text" name="data[Ingredient][' + optionCount + '][weight_category]" />'+
        '</div>';
    event.preventDefault();
    $('#poll-options').append(inputHtml);
});
$('#add-step-button').click(function(event){
	//console.log("test");
    var optionCount = $('#step-options > div').size() + 1;
    var inputHtml = '<input id="Step' + optionCount + 'Name" type="hidden" value='+optionCount+' name="data[Step][' + optionCount + '][step_count]" />'+
        '</div><div class="input text"><label for="Step' + optionCount + 'comment">工程 ' + optionCount
        + '</label><input id="Step' + optionCount + 'comment" type="text" name="data[Step][' + optionCount + '][comment]" />'+
        '</div>';
    event.preventDefault();
    $('#step-options').append(inputHtml);
});
});
</script>
<div class="recipes form">
<?php echo $this->Form->create('Recipe'); ?>
	<fieldset>
		<legend><?php echo __('五十嵐プロジェクト・レシピ・入力フォーム'); ?></legend>
	<?php
		echo $this->Form->input('Recipe.name',array('label'=>'料理名を入力して下さい'));
		echo $this->Form->input('Recipe.category',array('label'=>'種別を選んでください'));
		?>
		ここに、材料名<br />
		<div id="poll-options">
<?php 
//if (isset($this->data['Ingredient'])) {
    $i = 0;
    //foreach ($this->data['Ingredient'] as $opt) {
        //echo $form->hidden("Ingredient.$i.id");
        echo $this->Form->input("Ingredient.$i.name", array('label' => "材料 " . ($i + 1)));
		echo $this->Form->input("Ingredient.$i.weight", array('label' => "数量 " . ($i+1)));
		echo $this->Form->input("Ingredient.$i.weight_category", array('label' => "単位 " . ($i+1)));
        $i++;
    //}
//}
?>
</div>
<input type="button" value="増やす" id="add-option-button">
		ここに、手順<br/>
		<div id="step-options">
			<?php 
//if (isset($this->data['Ingredient'])) {
    $i = 0;
    //foreach ($this->data['Ingredient'] as $opt) {
        echo $this->Form->hidden("Ingredient.$i.step_count",array('value'=>$i+1));
        echo $this->Form->input("Step.$i.comment", array('label' => "工程 " . ($i + 1)));
        $i++;
    //}
//}
?>
		</div>
		<input type="button" value="増やす" id="add-step-button">
		<?php
		echo $this->Form->input('Recipe.advise',array('label'=>'作り方のコツやお勧め一言をお願いします'));
		echo $this->Form->input('Recipe.season',array('label'=>'料理の季節を選んでください'));
		echo $this->Form->input('Recipe.cal',array('label'=>'カロリーを入力して下さい'));
		echo $this->Form->input('Recipe.fat',array('label'=>'脂質を入力して下さい'));
		echo $this->Form->input('Recipe.protain',array('label'=>'タンパク質を入力して下さい'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Recipes'), array('action' => 'index')); ?></li>
	</ul>
</div>
