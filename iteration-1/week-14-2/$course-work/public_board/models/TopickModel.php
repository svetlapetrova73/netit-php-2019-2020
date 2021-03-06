<?php

namespace models;

class TopickModel {
    
    public static function create($title) {
        
        // $title = $_POST['topick_title'];
        $query = "INSERT INTO public_board.topicks(title) VALUES('$title')";
        \db\Database::getInstance()->query($query);
        
        return \db\Database::getInstance()->lastInsertedId();
    }
    
    public static function read($id = null) {
        
        if(is_null($id)) {
            $query = "SELECT * FROM public_board.topicks";
        }
        else {
            $query = "SELECT * FROM public_board.topicks WHERE id = $id";
        }
        
        \db\Database::getInstance()->query($query);
        return \db\Database::getInstance()->fetchCollection();
    }
    
    
    public static function readWithOpinion($arguments = array()) {
        
        $id     = $arguments['id'];       
        $limit  = isset($arguments['limit']) ?  $arguments['limit'] : 1;
        $offset = isset($arguments['offset']) ? $arguments['offset'] : 0;
        
        $query = "SELECT a.id AS topick_id, "
                . "a.title, "
                . "b.id AS opinion_id, "
                . "b.content, "
                . "b.author "
                . "FROM public_board.topicks a, public_board.opinions b "
                . "WHERE a.id = b.topick_id AND a.id = $id "
                . "LIMIT $offset , $limit";
        
        \db\Database::getInstance()->query($query);
        return \db\Database::getInstance()->fetchCollection();
    }

    public static function update() {
        
    }    
    
    public static function delete() {
        
    }
}