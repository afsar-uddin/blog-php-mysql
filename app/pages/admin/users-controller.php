<?php
    /**Add new user */
    if($action == "add") {
        if(!empty($_POST)) {
        // validate
        $errors = [];

        /**uernname */
        if(empty($_POST['username'])) {
            $errors['username'] = 'Username is required';
        } else if(!preg_match("/^[a-zA-Z]+/", $_POST['username'])) {
            $errors['username'] = 'Username can only letter and nospace';
        }

        /**email */
        $query = "select id from users where email=:email limit 1";
        $email = query($query, ['email'=>$_POST['email']]);

        if(empty($_POST['email'])) {
            $errors['email'] = 'Email is required';
        } else if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Email is not valid';
        } else if($email) {
            $errors['email'] = 'That email is already in used.';
        }

        /**password */
        if(empty($_POST['password'])) {
            $errors['password'] = 'Password is required';
        } else if (strlen($_POST['password']) < 4) {
            $errors['password'] = 'Password must be 4 characters longer or more';
        } else if ($_POST['password'] !== $_POST['cpassword']) {
            $errors['password'] = 'Password do not matched';
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

        if(empty($errors)) {
            // save to db 
            $data = [];
            $data['username'] = $_POST['username'];
            $data['email'] = $_POST['email'];
            $data['role'] = $_POST['role'];
            $data['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
            
            if(!empty($uploadFilePath)) {
                $data['image'] = $uploadFilePath;
                $query = "insert into users (username,email,password,role,image) values (:username,:email,:password,:role,:image)";
            }
            
            query($query, $data);

            redirect('admin/users');
        }
      }
    }
    
    /**Edit user */
    elseif ($action == 'edit') {
      
      $query = "select * from users where id = :id limit 1";
      $row = query_row($query, ['id' => $id]);

      // var_dump($row);

      if(!empty($_POST)) {
  
          if($row) {
            // validate
            $errors = [];
    
            /**uernname */
            if(empty($_POST['username'])) {
                $errors['username'] = 'Username is required';
            } else if(!preg_match("/^[a-zA-Z]+/", $_POST['username'])) {
                $errors['username'] = 'Username can only letter and nospace';
            }
    
            /**email */
            $query = "select id from users where email = :email && id != :id limit 1";
            $email = query($query, ['email'=>$_POST['email'], 'id' => $id]);
    
            if(empty($_POST['email'])) {
                $errors['email'] = 'Email is required';
            } else if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = 'Email is not valid';
            } else if($email) {
                $errors['email'] = 'That email is already in used.';
            }
    
            /**password */
            if(empty($_POST['password'])) {
                
            } else if (strlen($_POST['password']) < 4) {
                $errors['password'] = 'Password must be 4 characters longer or more';
            } else if ($_POST['password'] !== $_POST['cpassword']) {
                $errors['password'] = 'Password do not matched';
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
                $data['username']   = $_POST['username'];
                $data['email']      = $_POST['email'];
                $data['role']       = $_POST['role'];
                $data['id']         = $id;

                $password_str       = "";
                $image_str          = "";

                if(!empty($_POST['password'])) {
                    $data['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
                    $password_str = "password = : password";
                }

                if(!empty($uploadFilePath)){
                    $image_str      = "image = :image, ";
                    $data['image']  = $uploadFilePath;
                }

                $query = "update users set username = :username, email = :email, $password_str $image_str role = :role where id = :id limit 1";
    
                query($query, $data);
                redirect('admin/users');
                
            }
          }
      } 
    }

    /**Delete user */
    elseif ($action == 'delete') {
      
      $query = "select * from users where id = :id limit 1";
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

                $query = "delete from users where id = :id limit 1";
                query($query, $data);
                redirect('admin/users');
                
            }
          }
      } 
    }