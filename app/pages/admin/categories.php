<?php if($action == "add"): ?>
    <div class="col-md-6 mx-auto add-users"> 
        <form method="post" class="form" enctype="multipart/form-data">
            <h4>Add new account</h4>
            <?php if(!empty($errors)): ?>
                <div style="color: red" class="bg-warning">Please fixed the error bellow</div>
            <?php endif; ?>

            <input class="form-control"  type="text" name="category" placeholder="category" value="<?=old_value('category')?>"> <br />
            <?php if(!empty($errors['category'])): ?>
                <div style="color: red"><?=$errors['category'];?></div>
            <?php endif; ?>

            <div class="my-1">
                <label for="floatingInput">Active</label>
                <select name="disabled" class="form-select">
                    <option value="0">Yes</option>
                    <option value="1">No</option>
                </select>
            </div>
            <br/>
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
            
            <input class="form-control"  type="text" name="category" placeholder="category" value="<?=old_value('category', $row['category'])?>"> <br />
            <?php if(!empty($errors['category'])): ?>
                <div style="color: red"><?=$errors['category'];?></div>
            <?php endif; ?>

            <div class="my-1">
                <label for="floatingInput">Active</label>
                <select name="disabled" class="form-select">
                    <option <?=old_select('disabled', '0', $row)?> value="0">Yes</option>
                    <option <?=old_select('disabled', '1', $row)?> value="1">No</option>
                </select>
            </div>
            <br/>
            
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
            <h4>Delete Category</h4>
            
            <?php //var_dump($row); ?>
            
            <?php if(!empty($row)) : ?>

            <?php if(!empty($errors)): ?>
                <div style="color: red" class="bg-warning">Please fixed the error bellow</div>
            <?php endif; ?>
            
            <div class="bg-danger p-3">
                <div><?=old_value('category', $row['category'])?></div>
                <div><?=old_value('slug', $row['slug'])?></div>
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
    <h2>Categories</h2> <a href="<?=ROOT?>/admin/categories/add" class="btn btn-primary">Add New</a>
</div>
<div class="table-responsive">
    <table class="table">
        <tr>
            <th>#</th>
            <th>Category</th>
            <th>Slug</th>
            <th>Disabled</th>
            <th>Action</th>
        </tr>
        <?php
            $limit = 3;
            $offest = ($PGE_NUM['page_number'] - 1) * $limit;

            $query = "select * from categories order by id desc limit $limit offset $offest";
            $rows = query($query);
        ?>
        <?php if(!empty($rows)) : ?>
            <?php foreach($rows as $row) : ?>
                <tr>
                    <td><?=$row['id']?></td>
                    <td><?=esc($row['category'])?></td>
                    <td><?=$row['slug']?></td>
                    <td><?=$row['disabled']?></td>
                    <td>
                        <a href="<?=ROOT?>/admin/categories/edit/<?=$row['id']?>">
                            <button class="btn btn-warning">Edit</button>
                        </a>
                        <a href="<?=ROOT?>/admin/categories/delete/<?=$row['id']?>">
                            <button class="btn btn-danger">Delete</button>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </table>
    <div class="col-md-12">
        <a href="<?=$PGE_NUM['first_link']; ?>">First Page</a>
        <a href="<?=$PGE_NUM['prev_link']; ?>">Prev Page</a>
        <a href="<?=$PGE_NUM['next_link']; ?>">Next Page</a>
    </div>
</div>
<?php endif; ?>