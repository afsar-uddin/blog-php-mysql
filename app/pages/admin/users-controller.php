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

        if(empty($errors)) {
            // save to db 
            $data = [];
            $data['username'] = $_POST['username'];
            $data['email'] = $_POST['email'];
            $data['role'] = "user";
            $data['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);

            $query = "insert into users (username,email,password,role) values (:username,:email,:password,:role)";
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
    
            if(empty($errors)) {
                // save to db 
                $data = [];
                $data['username'] = $_POST['username'];
                $data['email'] = $_POST['email'];
                $data['role'] = $row['role'];
                $data['id'] = $id;
    
                if(empty($_POST['password'])) {
                  $query = "update users set username = :username, email = :email, role =:role where id = :id limit 1";  
                } else {
                  $data['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
                  $query = "update users set username = :username, email = :email, password =:password, role =:role where id = :id limit 1";
    
                }
    
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