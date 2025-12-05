<?php
 
error_reporting(E_ALL); /* it is going to report all types of errors */
ini_set('display_errors', 1); /* it is going to show the error to the user */

class Post {
    /* Post properties */
    public $id;
    public $title;
    public $category_id;
    public $description;
    public $created_at;

    /* Database data */
    private $connection;
    private $table = 'posts';

    public function __construct($db) { /* constructor to initialize database connection */
        $this->connection = $db;
    }
    
    /* Methods to read all the saved posts from database */
    public function readPosts() {
        /* Query to read all posts from the table */
        $query = 'SELECT
        category.name as category,
        posts.id,
        posts.title,
        posts.category_id,
        posts.description,
        posts.created_at
        FROM ' . $this->table . ' 
        LEFT JOIN category ON posts.category_id = category.id
        ORDER BY posts.created_at DESC';
        
        $post = $this->connection->prepare($query);
        $post->execute();
        return $post;
    }
    /* Method to read a single post  */
    public function read_single_post($id) {
        /* Query to read a single post based on ID */
        $query = 'SELECT
        category.name as category,
        posts.id,
        posts.title,
        posts.category_id,
        posts.description,
        posts.created_at
        FROM ' . $this->table . ' 
        LEFT JOIN category ON posts.category_id = category.id
        WHERE posts.id = ?
        LIMIT 0,1';
        
        $post = $this->connection->prepare($query);
        $post->bindValue(1, $this->id);
        return $post;
    
    }
    /* Method to create a new post */
    public function create_new_post($params){
       


         /* Query to insert a new post into the database */
        try{
        /*values*/
        $this->title = $params['title'];
        $this->category_id = $params['category_id'];
        $this->description = $params['description'];
        $query='INSERT INTO '.$this->table.' SET title=:title, category_id=:category_id,
                    description=:description';/*creating a place of properties before giving the values for security*/

        $post=$this->connection->prepare($query);
        $post->bindValue(':title',$this->title);
        $post->bindValue(':category_id',$this->category_id);
        $post->bindValue(':description',$this->description);    
        if($post->execute()){
            return true;
        }
        return false;




        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }


    public function update($params){
        
        try{
            // Assign properties (best to add ?? null safety here too, but fixing syntax first)
            $this->id = $params['id'];
            $this->title = $params['title'];
            $this->category_id = $params['category_id'];
            $this->description = $params['description'];

            // FIX 3A: Correct the SQL typo 'UPDTE' to 'UPDATE'
            $query = 'UPDATE '.$this->table.'
            SET 
            title= :title,
            category_id= :category_id,
            description= :description
            WHERE id= :id';
            
            $post = $this->connection->prepare($query);
            $post->bindValue(':id',$this->id);
            $post->bindValue(':title',$this->title);
            $post->bindValue(':category_id',$this->category_id);
            $post->bindValue(':description',$this->description);
            
            if($post->execute()){
                return true;
            } else {
                return false;
            }
        
        // FIX 3B: Correct the try-catch block structure
        } catch(PDOException $e){ 
            echo $e->getMessage();
            return false; // Return false on exception
        }
    }

     public function deleate($params){
        
        try{
            // Assign properties (best to add ?? null safety here too, but fixing syntax first)
            $this->id = $params['id'];


            // FIX 3A: Correct the SQL typo 'UPDTE' to 'UPDATE'
            $query = 'DELETE FROM '.$this->table.'
            WHERE id= :id';
            
            $post = $this->connection->prepare($query);
            $post->bindValue(':id',$this->id);
          
            if($post->execute()){
                return true;
            } else {
                return false;
            }
        
        // FIX 3B: Correct the try-catch block structure
        } catch(PDOException $e){ 
            echo $e->getMessage();
            return false; // Return false on exception
        }
    }
}

?>