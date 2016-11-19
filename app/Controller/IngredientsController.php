<?php
App::uses('AppController', 'Controller');
/**
 * Ingredients Controller
 *
 * @property Ingredient $Ingredient
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 * @property FlashComponent $Flash
 */
class IngredientsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session', 'Flash');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Ingredient->recursive = 0;
		$this->set('ingredients', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Ingredient->exists($id)) {
			throw new NotFoundException(__('Invalid ingredient'));
		}
		$options = array('conditions' => array('Ingredient.' . $this->Ingredient->primaryKey => $id));
		$this->set('ingredient', $this->Ingredient->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add($id=null) {
		if ($this->request->is('post')) {
			$this->Ingredient->create();
			$backward_id = $this->request->data['Ingredient']['recipe_id'];
			if ($this->Ingredient->save($this->request->data)) {
				$this->Flash->success(__('材料の追加を完了しました'));
				return $this->redirect(array('controller'=>'Recipes','action' => 'view',$backward_id));
			} else {
				$this->Flash->error(__('The ingredient could not be saved. Please, try again.'));
			}
		}
		$recipes = $this->Ingredient->Recipe->find('list');
		$this->set(compact('recipes'));
		$this->set('backward_id',$id);
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Ingredient->exists($id)) {
			throw new NotFoundException(__('Invalid ingredient'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Ingredient->save($this->request->data)) {
				$this->Flash->success(__('登録を完了しました'));
				return $this->redirect(array('controller'=>'Recipes','action' => 'view',$this->request->data['Ingredient']['recipe_id']));
			} else {
				$this->Flash->error(__('The ingredient could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Ingredient.' . $this->Ingredient->primaryKey => $id));
			$this->request->data = $this->Ingredient->find('first', $options);
		}
		$recipes = $this->Ingredient->Recipe->find('list');
		$this->set(compact('recipes'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Ingredient->id = $id;
		if (!$this->Ingredient->exists()) {
			throw new NotFoundException(__('Invalid ingredient'));
		}
		$this->request->allowMethod('post', 'delete');
		//check backward ID
		$delete_object = $this->Ingredient->find('first',array('conditions'=>array('Ingredient.id'=>$id)));
		$backward_id = $delete_object['Ingredient']['recipe_id'];
		
		if ($this->Ingredient->delete()) {
			$this->Flash->success(__('The ingredient has been deleted.'));
		} else {
			$this->Flash->error(__('The ingredient could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('controller'=>'Recipes','action' => 'view',$backward_id));
	}
}
