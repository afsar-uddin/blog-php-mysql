<?php
    /** Add new post */
    if($action == "add") {
            
        if(!empty($_POST)) {
            // validate
            $errors = [];

            /** Title */
            if(empty($_POST['title'])) {
                $errors['title'] = 'title is required';
            }

            /** category */
            if(empty($_POST['category_id'])) {
                $errors['category_id'] = 'Category is required';
            }

            /**validate image */
            $format_allowed = ['image/png', 'image/jpg', 'image/jpeg', 'image/webp'];
            if(!empty($_FILES['image']['name'])) {
                $destination = '';
                if(!in_array($_FILES['image']['type'], $format_allowed)) {
                    $errors['image'] = 'Image format not supported, only png, jpg, and webp allowed';
                } else {
                    $folder = 'uploads/';

                    $file_extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);

                    $uploadFileName = generateUniqueFileName($file_extension);
                
                    $uploadFilePath = $folder . $uploadFileName;

                    if(!file_exists($folder)) {
                        mkdir($folder, true);
                    }

                    move_uploaded_file($_FILES['image']['tmp_name'], $uploadFilePath);
                    resize_image($uploadFilePath);
                }
            } else {
                $errors['image'] = 'A featured image is required';
            }

            /** slug */
            $slug = str_to_url($_POST['title']);

            $query = "select id from posts where slug=:slug limit 1";
            $slug_row = query($query, ['slug'=>$slug]);

            if($slug_row) {
                $slug .= rand(1000, 9999);
            }

            if(empty($errors)) {
                // save to db 
                $data = [];
                $data['title']      = $_POST['title'];
                $data['content']    = $_POST['content'];
                $data['category_id']    = $_POST['category_id'];
                $data['slug']       = $slug;
                $data['user_id']    = user('id');
                
                $query = "insert into posts (title,content,slug,category_id,user_id) values (:title,:content,:slug,:category_id,:user_id)";

                if(!empty($uploadFilePath)) {
                    $data['image'] = $uploadFilePath;
                    $query = "insert into posts (title,content,slug,category_id,user_id,image) values (:title,:content,:slug,:category_id,:user_id,:image)";
                }
                
                query($query, $data);

                redirect('admin/posts');
            }
        }
    }
    
    /**Edit user */
    elseif ($action == 'edit') {
      
      $query = "select * from posts where id = :id limit 1";
      $row = query_row($query, ['id' => $id]);

      // var_dump($row);

      if(!empty($_POST)) {
  
          if($row) {
            // validate
            $errors = [];
    
            /** Title */
            if(empty($_POST['title'])) {
                $errors['title'] = 'title is required';
            }

            /** category */
            if(empty($_POST['category_id'])) {
                $errors['category_id'] = 'Category is required';
            }

            /**validate image */
            $format_allowed = ['image/png', 'image/jpg', 'image/jpeg', 'image/webp'];
            if(!empty($_FILES['image']['name'])) {
                $destination = '';
                if(!in_array($_FILES['image']['type'], $format_allowed)) {
                    $errors['image'] = 'Image format not supported, only png, jpg, and webp allowed';
                } else {
                    $folder = 'uploads/';

                    $file_extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);

                    $uploadFileName = generateUniqueFileName($file_extension);
                
                    $uploadFilePath = $folder . $uploadFileName;

                    if(!file_exists($folder)) {
                        mkdir($folder, true);
                    }

                    move_uploaded_file($_FILES['image']['tmp_name'], $uploadFilePath);
                    resize_image($uploadFilePath);
                }
            }

            /**validate image */
            $format_allowed = ['image/png', 'image/jpg', 'image/jpeg', 'image/webp'];

            if(!empty($_FILES['image']['name'])) {
                $destination = '';
                if(!in_array($_FILES['image']['type'], $format_allowed)) {
                    $errors['image'] = 'Image format not supported, only png, jpg, and webp allowed';
                } else {
                    $folder = 'uploads/';

                    $file_extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);

                    $uploadFileName = generateUniqueFileName($file_extension);
                
                    $uploadFilePath = $folder . $uploadFileName;

                    if(!file_exists($folder)) {
                        mkdir($folder, true);
                    }

                    // var_dump($destination);
                    move_uploaded_file($_FILES['image']['tmp_name'], $uploadFilePath);
                    resize_image($uploadFilePath);
                }
            }
            if(empty($errors)) {
                // save to db 
                $data = [];
                $data['title']          = $_POST['title'];
                $data['content']        = $_POST['content'];
                $data['category_id']    = $_POST['category_id'];
                $data['id']             = $id;

                $image_str              = "";

                if(!empty($uploadFilePath)){
                    $image_str      = "image = :image, ";
                    $data['image']  = $uploadFilePath;
                }

                $query = "update posts set title = :title, content = :content, $image_str category_id = :category_id where id = :id limit 1";
    
                query($query, $data);
                redirect('admin/posts');
                
            }
          }
      } 
    }

    // /**Delete user */
    elseif ($action == 'delete') {
      
      $query = "select * from posts where id = :id limit 1";
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

                $query = "delete from posts where id = :id limit 1";
                query($query, $data);

                if(file_exists($row['image']))
                    unlink($row['image']);
                    
                redirect('admin/posts');
                
            }
          }
      } 
    }