<?php

class Posts extends Controller
{   
    private $postModel;
    public function __construct()
    {
        echo 'Postss Controller Loaded...';
        $this->postModel = $this->model('Post');
    }

    public function index()
    {
        //echo 'POST metodo index...';
        $posts = $this->postModel->getPosts();
        $data = ['title' => 'Mis Posts',
                'posts' => $posts];
        
        $this->view('posts/index', $data);
    }

    public function add(){

    }
    public function edit($id = null)
    {
        echo 'POST metodo edit...'.$id;
    }
    public function show($id){

    }
    public function delete($id){
        
    }
    
}
