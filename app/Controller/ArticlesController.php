<?php
class ArticlesController extends AppController {
	public $uses     = array('Article', 'Kodawari', 'Categories', 'Sub_categories', 'Genre');
	public $helpers  = array('Html', 'Form');
	public $paginate = array(
		'page'  => 1,
		'limit' => 5,
		'order' => array('' => 'dsc')
	);

	public function index() {
		$this->Session->write('login_user_id', '0312015091');
		$this->set('articles', $this->paginate());
	}

	public function view($article_id = null) {
		$this->Article->article_id = $article_id;
		$conditions                = array("article_id"                        => $article_id);
		$this->set('article', $this->Article->find('first', array('conditions' => $conditions)));
	}
	public function form() {
		$this->Session->write('login_user_id', '0312015091');
		$this->set('category_id', $this->Categories->find('list',
				array('fields' => array('category_id', 'name'))));
		$this->set('sub_category_id', $this->Sub_categories->find('list',
				array('fields' => array('sub_category_id', 'name'))));
		$this->set('genre_id', $this->Genre->find('list',
				array('fields' => array('genre_id', 'name'))));
	}
	public function check() {
		if ($this->request->is('post')) {
			$this->request->data["Article"]["Content"];
			$this->Article->save($this->data);
		}
	}
}
