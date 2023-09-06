<?php if($action == "add"): ?>
    <div class="col-md-6 mx-auto add-users"> 
        <form method="post" class="form" enctype="multipart/form-data">
            <h4>Add new post</h4>
            <?php if(!empty($errors)): ?>
                <div style="color: red" class="bg-warning">Please fixed the error bellow</div>
            <?php endif; ?>

            <div class="my-2">
                <h6>Featured Image</h6>
                <label>
                    <img class="image-preview-edit" src="<?=get_image('')?>"style="width: 150px; height: 150px; boject-fit:cover">
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

            <input class="form-control"  type="text" name="title" placeholder="Title" value="<?=old_value('title')?>"> <br />
            <?php if(!empty($errors['title'])): ?>
                <div style="color: red"><?=$errors['title'];?></div>
            <?php endif; ?>

            <textarea name="content" type="content" cols="30" rows="10" placeholder="Content post" class="form-control"><?=old_value('content')?></textarea>
            
            <?php if(!empty($errors['content'])): ?>
                <div style="color: red"><?=$errors['content'];?></div>
            <?php endif; ?>

            <div class="my-1">
                <label for="floatingInput">Category</label>
                <select name="category_id" class="form-select">
                    <?php
                        $query = "select * from categories order by id desc";
                        $categories = query($query);
                    ?>
                    <option value="">--Select Category--</option>
                    <?php if(!empty($categories)): ?>
                        <?php foreach($categories as $cat): ?>
                            <option <?=old_select('category_id', $cat['id'])?> value="<?=$cat['id']?>"><?=$cat['category']?></option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
            </div>

            <?php if(!empty($errors['category_id'])):?>
                <div class="text-danger"><?=$errors['category_id']?></div>
            <?php endif;?>

            <a href="<?=ROOT?>/admin/posts" class="btn btn-success">Back</a>
            <input class="btn btn-primary"  type="submit" value="Create Post">
        </form>
    </div>
<?php elseif($action == "edit"): ?>
    <div class="col-md-6 mx-auto add-users"> 
        <form method="post" class="form" enctype="multipart/form-data">
            <h4>Edit Post</h4>
            
            <?php //var_dump($row); ?>
            
            <?php if(!empty($row)) : ?>

            <?php if(!empty($errors)): ?>
                <div style="color: red" class="bg-warning">Please fixed the error bellow</div>
            <?php endif; ?>

            <div class="my-2">
                <h6>Featured Image</h6>
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

            <input class="form-control"  type="text" name="title" placeholder="Title" value="<?=old_value('title', $row['title'])?>"> <br />
            <?php if(!empty($errors['title'])): ?>
                <div style="color: red"><?=$errors['title'];?></div>
            <?php endif; ?>

            <textarea name="content" type="content" cols="30" rows="10" placeholder="Content post" class="form-control"><?=old_value('content', $row['content'])?></textarea>
            
            <?php if(!empty($errors['content'])): ?>
                <div style="color: red"><?=$errors['content'];?></div>
            <?php endif; ?>

            <div class="my-1">
                <label for="floatingInput">Category</label>
                <select name="category_id" class="form-select">
                    <?php
                        $query = "select * from categories order by id desc";
                        $categories = query($query);
                    ?>
                    <option value="">--Select Category--</option>
                    <?php if(!empty($categories)): ?>
                        <?php foreach($categories as $cat): ?>
                            <option <?=old_select('category_id', $cat['id'], $row['category_id'])?> value="<?=$cat['id']?>"><?=$cat['category']?></option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
            </div>

            <?php if(!empty($errors['category_id'])):?>
                <div class="text-danger"><?=$errors['category_id']?></div>
            <?php endif;?>
            
            <a href="<?=ROOT?>/admin/posts" class="btn btn-success">Back</a>
            <input class="btn btn-primary"  type="submit" value="Save Info">
            
            <?php else: ?>
                <div class="alert alert-danger text-center">Record not found</div>
            <?php endif; ?>
        </form>
    </div>
<?php elseif($action == "delete"): ?>
    <div class="col-md-6 mx-auto add-users"> 
        <form method="post" class="form">
            <h4>Delete Post</h4>
            
            <?php //var_dump($row); ?>
            
            <?php if(!empty($row)) : ?>

            <?php if(!empty($errors)): ?>
                <div style="color: red" class="bg-warning">Please fixed the error bellow</div>
            <?php endif; ?>
            
            <div class="bg-danger p-3">
                <div><?=old_value('title', $row['title'])?></div>
                <div><?=old_value('slug', $row['slug'])?></div>
            </div>

            <br><br>
            
            <a href="<?=ROOT?>/admin/posts" class="btn btn-success">Back</a>
            <input class="btn btn-danger"  type="submit" value="Delete">
            
            <?php else: ?>
                <div class="alert alert-danger text-center">Record not found</div>
            <?php endif; ?>
        </form>
    </div>
<?php else: ?>


<div class="users-head d-flex justify-content-between">
    <h2>Posts</h2> <a href="<?=ROOT?>/admin/posts/add" class="btn btn-primary">Add New Post</a>
</div>
<div class="table-responsive">
    <table class="table">
        <tr>
            <th>#</th>
            <th>Title</th>
            <th>Slug</th>
            <th>Image</th>
            <th>Date</th>
            <th>Action</th>
        </tr>
        <?php
            $limit = 3;
            $offest = ($PGE_NUM['page_number'] - 1) * $limit;

            $query = "select * from posts order by id desc limit $limit offset $offest";
            $rows = query($query);
        ?>
        <?php if(!empty($rows)) : ?>
            <?php foreach($rows as $row) : ?>
                <tr>
                    <td><?=$row['id']?></td>
                    <td><?=esc($row['title'])?></td>
                    <td><?=$row['slug']?></td>
                    <td>
                        <?php //var_dump(get_image($row['image'])); ?>
                        <img src="<?=get_image($row['image'])?>"style="width: 50px; height: 50px; boject-fit:cover">
                    </td>
                    <td><?=date("jS M, Y", strtotime($row['date']))?></td>
                    <td>
                        <a href="<?=ROOT?>/admin/posts/edit/<?=$row['id']?>">
                            <button class="btn btn-warning">Edit</button>
                        </a>
                        <a href="<?=ROOT?>/admin/posts/delete/<?=$row['id']?>">
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