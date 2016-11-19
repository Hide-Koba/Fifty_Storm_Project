<?php
App::uses('AppModel', 'Model');
/**
 * Step Model
 *
 * @property Recipe $Recipe
 */
class Step extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'step';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'id';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'recipe_id' => array(
			'uuid' => array(
				'rule' => array('uuid'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'step_count' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'comment' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	// The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Recipe' => array(
			'className' => 'Recipe',
			'foreignKey' => 'recipe_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	public function set_add_options($id=null){
		$add_options = array('0'=>'末尾に追加');
		$list_qitems = $this->find('all',array('conditions'=>array('Recipe.id'=>$id)));
		$cnt=1;
		foreach ($list_qitems as $list_qitem){
			$add_options[$list_qitem['Step']['id']]=$cnt.":".$list_qitem['Step']['comment'];
			$cnt++;
		}
		return $add_options;
	}
	public function intrrupt_update_prepare($update_item,$inturrupt_id){
		debug($update_item);
		$update_item['add_option'] = (int)$update_item['add_option'];
		$list_qitems = $this->find('all',array('conditions'=>array('recipe_id'=>$update_item['recipe_id'])));
		//prepare before inturrupt
		$cnt=0;
		foreach ($list_qitems as $qitem){
			unset($list_qitems[$cnt]['Recipe']);
			$cnt++;
		}
		
		$cnt=0;
		$item_max = count($list_qitems);
		$flip_flag = false;
		
		//manipulate orders
		for($i=0;$i<$item_max;$i++){
			echo $i.":".$list_qitems[$i]['Step']['comment'];
			if ($flip_flag){
				$tmp2 = $list_qitems[$i];
				$list_qitems[$i] = $tmp;
				$tmp=$tmp2;
			}
			if (!isset($list_qitems[$i]['Step']['id'])){continue;}
			$this_id = (string)$list_qitems[$i]['Step']['id'];
			if ((isset($update_item['add_option']))&&($this_id===$inturrupt_id)){
				unset($update_item['add_option']);
				$tmp['Step'] = $update_item;
				$flip_flag=true;
			}
		}

		//put the last one
		$list_qitems[$i]=$tmp;
		return $list_qitems;
	}
}
