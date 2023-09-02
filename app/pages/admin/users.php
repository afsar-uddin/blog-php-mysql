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
        <form method="post" class="form">
            <h4>Edit Account</h4>
            
            <?php //var_dump($row); ?>
            
            <?php if(!empty($row)) : ?>

            <?php if(!empty($errors)): ?>
                <div style="color: red" class="bg-warning">Please fixed the error bellow</div>
            <?php endif; ?>
            
            <input class="form-control"  type="text" name="username" placeholder="Username" value="<?=old_value('username', $row['username'])?>"> <br />
            <?php if(!empty($errors['username'])): ?>
                <div style="color: red"><?=$errors['username'];?></div>
            <?php endif; ?>
            <input class="form-control"  type="email" name="email" placeholder="Email" value="<?=old_value('email', $row['email'])?>"> <br />
            <?php if(!empty($errors['email'])): ?>
                <div style="color: red"><?=$errors['email'];?></div>
            <?php endif; ?>
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
                    <td>Image</td>
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