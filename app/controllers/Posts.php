<?php

class Posts
{
    public function __construct()
    {
        echo 'Postss Controller Loaded...';
    }

    public function index()
    {
        echo 'POST metodo index...';
    }

    public function edit($id = null)
    {
        echo 'POST metodo edit...'.$id;
    }
    
}
