<?php
    /**Add new category */
    if($action == "add") {
        if(!empty($_POST)) {
        // validate
        $errors = [];

        /** category */
        if(empty($_POST['category'])) {
            $errors['category'] = 'category is required';
        } else if(!preg_match("/^[a-zA-Z0-9 \-\_\&]+/", $_POST['category'])) {
            $errors['category'] = 'Category can only letters';
        }

        /** slug */
        $slug = str_to_url($_POST['category']);

        $query = "select id from categories where slug=:slug limit 1";
        $slug_row = query($query, ['slug'=>$slug]);

        if($slug_row) {
            $slug .= rand(1000, 9999);
        }
        

        if(empty($errors)) {
            // save to db 
            $data = [];
            $data['category'] = $_POST['category'];
            $data['slug'] = $slug;
            $data['disabled'] = $_POST['disabled'];
            
            $query = "insert into categories (category,slug,disabled) values (:category,:slug,:disabled)";
            
            query($query, $data);

            redirect('admin/categories');
        }
      }
    }
    
    /**Edit category */
    elseif ($action == 'edit') {
      
      $query = "select * from categories where id = :id limit 1";
      $row = query_row($query, ['id' => $id]);

      // var_dump($row);

      if(!empty($_POST)) {
  
          if($row) {
            // validate
            $errors = [];
    
            /** category */
            if(empty($_POST['category'])) {
                $errors['category'] = 'category is required';
            } else if(!preg_match("/^[a-zA-Z0-9 \-\_\&]+/", $_POST['category'])) {
                $errors['category'] = 'Category can only letters';
            }

            if(empty($errors)) {
                // save to db 
                $data = [];
                $data['category']   = $_POST['category'];
                $data['disabled']      = $_POST['disabled'];
                $data['id']      = $id;
                

                $query = "update categories set category = :category, disabled = :disabled where id = :id limit 1";
    
                query($query, $data);
                redirect('admin/categories');
                
            }
          }
      } 
    }

    /**Delete category */
    elseif ($action == 'delete') {
      
      $query = "select * from categories where id = :id limit 1";
      $row = query_row($query, ['id' => $id]);

      // var_dump($row);

      if($_SERVER['REQUEST_METHOD'] == 'POST') { 
  
          if($row) {

            // validate
            $errors = [];
        
            if(empty($errors)) {
                
                // save to db 
                $data = [];
                $data['id'] = $id;

                $query = "delete from categories where id = :id limit 1";
                query($query, $data);
                    
                redirect('admin/categories');
                
            }
          }
      } 
    }