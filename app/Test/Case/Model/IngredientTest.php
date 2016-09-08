<?php
App::uses('Ingredient', 'Model');

/**
 * Ingredient Test Case
 */
class IngredientTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.ingredient',
		'app.recipe'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Ingredient = ClassRegistry::init('Ingredient');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Ingredient);

		parent::tearDown();
	}

}
