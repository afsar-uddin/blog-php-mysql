<?php if($action == "add"): ?>
<div class="col-md-6 mx-auto add-users"> 
    <form method="post" class="form">
        <h4>Add new account</h4>
        <?php if(!empty($errors)): ?>
            <div style="color: red" class="bg-warning">Please fixed the error bellow</div>
        <?php endif; ?>
        
        <input class="form-control"  type="text" name="username" placeholder="Username" value="<?=old_value('username')?>"> <br />
        <?php if(!empty($errors['username'])): ?>
            <div style="color: red"><?=$errors['username'];?></div>
        <?php endif; ?>
        <input class="form-control"  type="email" name="email" placeholder="Email" value="<?=old_value('email')?>"> <br />
        <?php if(!empty($errors['email'])): ?>
            <div style="color: red"><?=$errors['email'];?></div>
        <?php endif; ?>
        <input class="form-control"  type="text" name="password" placeholder="Password" value="<?=old_value('password')?>"> <br />
        <?php if(!empty($errors['password'])): ?>
            <div style="color: red"><?=$errors['password'];?></div>
        <?php endif; ?>
        <input class="form-control"  type="text" name="cpassword" placeholder="Confirm Password" value="<?=old_value('cpassword')?>"> <br />
        <?php if(!empty($errors['cpassword'])): ?>
            <div style="color: red"><?=$errors['cpassword'];?></div>
        <?php endif; ?>
        <a href="<?=ROOT?>/admin/users" class="btn btn-success">Back</a>
        <input class="btn btn-primary"  type="submit" value="Create account">
    </form>
</div>
<?php elseif($action == "edit"): ?>
    <div class="col-md-6 mx-auto add-users"> 
        <form method="post" class="form" enctype="multipart/form-data">
            <h4>Edit Account</h4>
            
            <?php //var_dump($row); ?>
            
            <?php if(!empty($row)) : ?>

            <?php if(!empty($errors)): ?>
                <div style="color: red" class="bg-warning">Please fixed the error bellow</div>
            <?php endif; ?>

            <div class="my-2">
                <label>
                    <img class="image-preview-edit" src="<?=get_image($row['image'])?>"style="width: 150px; height: 150px; boject-fit:cover">
                    <input onchange="display_image_edit(this.files[0])" type="file" name="image" class="d-none">
                </label>
                <?php if(!empty($errors['image'])):?>
			      <div class="text-danger"><?=$errors['image']?></div>
			    <?php endif;?>
            </div>

            <script>
                function display_image_edit(file) {
                    document.querySelector('.image-preview-edit').src = URL.createObjectURL(file);
                }
            </script>
            
            <input class="form-control"  type="text" name="username" placeholder="Username" value="<?=old_value('username', $row['username'])?>"> <br />
            <?php if(!empty($errors['username'])): ?>
                <div style="color: red"><?=$errors['username'];?></div>
            <?php endif; ?>
            <input class="form-control"  type="email" name="email" placeholder="Email" value="<?=old_value('email', $row['email'])?>"> <br />
            <?php if(!empty($errors['email'])): ?>
                <div style="color: red"><?=$errors['email'];?></div>
            <?php endif; ?>

            <div class="my-3">
                <label for="floatingInput">Role</label>
                <select name="role" class="form-select">
                    <option <?=old_select('role','user',$row['role'])?> value="user">User</option>
                    <option <?=old_select('role','admin',$row['role'])?> value="admin">Admin</option>
                </select>
		    </div>

            <input class="form-control"  type="text" name="password" placeholder="Password (Leav empty to keep old)" value="<?=old_value('password')?>"> <br />
            <?php if(!empty($errors['password'])): ?>
                <div style="color: red"><?=$errors['password'];?></div>
            <?php endif; ?>
            <input class="form-control"  type="text" name="cpassword" placeholder="Confirm Password" value="<?=old_value('cpassword')?>"> <br />
            <?php if(!empty($errors['cpassword'])): ?>
                <div style="color: red"><?=$errors['cpassword'];?></div>
            <?php endif; ?>
            <a href="<?=ROOT?>/admin/users" class="btn btn-success">Back</a>
            <input class="btn btn-primary"  type="submit" value="Save Info">
            
            <?php else: ?>
                <div class="alert alert-danger text-center">Record not found</div>
            <?php endif; ?>
        </form>
    </div>
<?php elseif($action == "delete"): ?>
    <div class="col-md-6 mx-auto add-users"> 
        <form method="post" class="form">
            <h4>Delete Account</h4>
            
            <?php //var_dump($row); ?>
            
            <?php if(!empty($row)) : ?>

            <?php if(!empty($errors)): ?>
                <div style="color: red" class="bg-warning">Please fixed the error bellow</div>
            <?php endif; ?>
            
            <div class="bg-danger p-3">
                <div><?=old_value('username', $row['username'])?></div>
                <div><?=old_value('email', $row['email'])?></div>
            </div>

            <br><br>
            
            <a href="<?=ROOT?>/admin/users" class="btn btn-success">Back</a>
            <input class="btn btn-danger"  type="submit" value="Delete">
            
            <?php else: ?>
                <div class="alert alert-danger text-center">Record not found</div>
            <?php endif; ?>
        </form>
    </div>
<?php else: ?>


<div class="users-head d-flex justify-content-between">
    <h2>Users</h2> <a href="<?=ROOT?>/admin/users/add" class="btn btn-primary">Add New</a>
</div>
<div class="table-responsive">
    <table class="table">
        <tr>
            <th>#</th>
            <th>Username</th>
            <th>Email</th>
            <th>Role</th>
            <th>Image</th>
            <th>Date</th>
            <th>Action</th>
        </tr>
        <?php
            $query = "select * from users order by id desc";
            $rows = query($query);
        ?>
        <?php if(!empty($rows)) : ?>
            <?php foreach($rows as $row) : ?>
                <tr>
                    <td><?=$row['id']?></td>
                    <td><?=esc($row['username'])?></td>
                    <td><?=$row['email']?></td>
                    <td><?=$row['role']?></td>
                    <td>
                        <?php //var_dump(get_image($row['image'])); ?>
                        <img src="<?=get_image($row['image'])?>"style="width: 50px; height: 50px; boject-fit:cover">
                    </td>
                    <td><?=date("jS M, Y", strtotime($row['date']))?></td>
                    <td>
                        <a href="<?=ROOT?>/admin/users/edit/<?=$row['id']?>">
                            <button class="btn btn-warning">Edit</button>
                        </a>
                        <a href="<?=ROOT?>/admin/users/delete/<?=$row['id']?>">
                            <button class="btn btn-danger">Delete</button>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </table>
</div>
<?php endif; ?>