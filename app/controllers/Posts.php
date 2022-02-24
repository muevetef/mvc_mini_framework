<?php

class Posts extends Controller
{   
    private $postModel;
    public function __construct()
    {
        if(!isLoggedIn()){
            redirect('users/login');
        }
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
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $data = [
                'title' => trim($_POST['title']),
                'body' => trim($_POST['body']),
                'user_id' => $_SESSION['user_id'],
                'title_err' => '',
                'body_err' => ''
            ];

            if(empty($data['title'])){
                $data['title_err'] = "Por favor escribe un titulo";
            }
            if(empty($data['body'])){
                $data['body_err'] = "Por favor escribe algo an el post";
            }

            if(empty($data['title_err']) && empty($data['body_err'])){
                $this->postModel->addPost($data);
                redirect('posts');
            }else{
                $this->view('posts/add', $data);
            }

   }else{
            $data = [
                'title' => '',
                'body' => ''
            ];
            $this->view('posts/add', $data);
        }


    }

    public function edit($id)
    {
        echo 'POST metodo edit...'.$id;
    }

    public function show($id){
        
        $post = $this->postModel->getPostById($id);

        $this->view('posts/show', $post);
    }

    public function delete($id){
           if($_SERVER['REQUEST_METHOD'] == 'POST'){

                $post = $this->postModel->getPostById($id);
                if($post->userId !== $_SESSION['user_id']){
                    //redirect('posts');
                    echo "SADFSDA";
                }

                if($this->postModel->deletePost($id)){
                    //ENseñar que el post se ha borardo correctamente
                    //redirect('posts');
                    echo "borrado!";
                }else{
                    die("algo va mal...");
                }
           }else{
               redirect(('posts'));
           }
    }
}
