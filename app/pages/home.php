<?php include '../app/pages/includes/header.php'; ?>
    <div class="container">
        <div class="row">
            <?php 
                $query = "select posts.*, categories.category from posts join categories on posts.category_id = categories.id order by id desc limit 6";
                $rows = query($query);
                if($rows) {
                    foreach($rows as $row) {
                        include '../app/pages/includes/post-card.php'; 
                    }
                } else {
                    echo "No posts found";
                }
            ?>
        </div>
    </div>
<?php include '../app/pages/includes/footer.php'; ?>