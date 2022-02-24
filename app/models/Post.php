<?php

class Post
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getPosts()
    {
        //todos los posts y el nombre del autor correspondiente
        $this->db->query("SELECT users.name, 
                         posts.id as postId,
                         posts.title,
                         posts.body,
                         posts.created_at as postCreated
                         FROM posts 
                         INNER JOIN users
                         ON posts.user_id = users.id
                         ORDER BY posts.created_at DESC");
        return $this->db->resultSet();
    }

    public function addPost($data)
    {
        $this->db->query('INSERT INTO posts (title, body, user_id) 
                          VALUES (:title, :body, :user_id)');
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':body', $data['body']);
        $this->db->bind(':user_id', $data['user_id']);

        return $this->db->execute();
    }

    public function updatePost($data)
    {
        $this->db->query('UPDATE posts SET
                         title = :title,
                         body = :body
                         WHERE id = :id');
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':body', $data['body']);
        $this->db->bind(':id', $data['id']);

        return $this->db->execute();
    }

    public function getPostById($id)
    {
        $this->db->query("SELECT users.name,
                                users.id as userId,
                                posts.id as postId,
                                posts.title,
                                posts.body,
                                posts.created_at as postCreated
                        FROM posts 
                        INNER JOIN users
                        ON posts.user_id = users.id
                        WHERE posts.id = :id");
        $this->db->bind(':id', $id);

        $post =  $this->db->single();
        return $post;
    }

    public function deletePost($id)
    {
        $this->db->query("DELETE FROM posts WHERE id = :id");
        $this->db->bind(':id', $id);

        return $this->db->execute();
    }
}
