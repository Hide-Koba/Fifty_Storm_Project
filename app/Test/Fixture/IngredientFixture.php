<?php
/**
 * Ingredient Fixture
 */
class IngredientFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'ingredient';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 36, 'collate' => 'utf8_bin', 'charset' => 'utf8', 'key' => 'primary'),
		'recipe_id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 36, 'collate' => 'utf8_bin', 'charset' => 'utf8'),
		'name' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 50, 'collate' => 'utf8_bin', 'charset' => 'utf8'),
		'weight' => array('type' => 'float', 'null' => false, 'default' => null, 'length' => '9,2', 'unsigned' => false),
		'weight_category' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 50, 'collate' => 'utf8_bin', 'charset' => 'utf8'),
		'indexes' => array(
			
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_bin', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => '57d168c1-bfd4-40c6-aa3f-0d9432c3ae04',
			'recipe_id' => 'Lorem ipsum dolor sit amet',
			'name' => 'Lorem ipsum dolor sit amet',
			'weight' => 1,
			'weight_category' => 'Lorem ipsum dolor sit amet'
		),
	);

}
