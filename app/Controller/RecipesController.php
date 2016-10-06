<?php
App::uses('AppController', 'Controller');
/**
 * Recipes Controller
 *
 * @property Recipe $Recipe
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 * @property FlashComponent $Flash
 */
class RecipesController extends AppController {

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
		$this->Recipe->recursive = 0;
		$this->set('recipes', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Recipe->exists($id)) {
			throw new NotFoundException(__('Invalid recipe'));
		}
		$options = array('conditions' => array('Recipe.' . $this->Recipe->primaryKey => $id));
		$this->set('recipe', $this->Recipe->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$this->loadModel('Ingredient');
		$this->loadModel('Step');
		if ($this->request->is('post')) {
			//debug($this->request->data);
			//check and trim blank column at Ingredient and Step
			$cnt=0;
			foreach ($this->request->data['Ingredient'] as $var){
				if ($var['name']===""){
					unset($this->request->data['Ingredient'][$cnt]);
				}
				$cnt++;
			}
			$cnt=0;
			foreach($this->request->data['Step'] as $var){
				if ($var['comment']===""){
					unset($this->request->data['Step'][$cnt]);
				}
				$cnt++;
			}

			$this->Recipe->create();
			if ($this->Recipe->saveAll($this->request->data)) {
				$this->Flash->success(__('The recipe has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The recipe could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Recipe->exists($id)) {
			throw new NotFoundException(__('Invalid recipe'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Recipe->save($this->request->data)) {
				$this->Flash->success(__('The recipe has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The recipe could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Recipe.' . $this->Recipe->primaryKey => $id));
			$this->request->data = $this->Recipe->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Recipe->id = $id;
		if (!$this->Recipe->exists()) {
			throw new NotFoundException(__('Invalid recipe'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Recipe->delete()) {
			$this->Flash->success(__('The recipe has been deleted.'));
		} else {
			$this->Flash->error(__('The recipe could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
