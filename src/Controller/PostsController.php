<?php
namespace App\Controller;
 
use App\Controller\AppController;
 
class PostsController extends AppController {
	public function initialize() {
		$this->name = 'Posts';
		$this->viewBuilder()->autoLayout(true);
		$this->viewBuilder()->layout('post');
	}
    public function index() {

    }

    public function vote99() {
    	$data = $this->Posts->find('all');
    	$this->set('data',$data);
    	$this->set('entity', $this->Posts->newEntity());
    }

    public function addRecord() {
    	if($this->request->is('post')) {
    		$post = $this->Posts->newEntity($this->request->data);
    		$this->Posts->save($post);
    	}
    	return $this->redirect(['action' => 'complete']);
    }

    public function complete() {

    }
}