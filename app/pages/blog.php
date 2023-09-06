<?php include '../app/pages/includes/header.php'; ?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3>Blog</h3>
            </div>
        </div>
        <div class="row">
            <?php 
                $limit = 3;
                $offset = ($PGE_NUM['page_number'] - 1) * $limit;

                $query = "select posts.*, categories.category from posts join categories on posts.category_id = categories.id order by id desc limit $limit offset $offset";
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

    <div class="col-md-12">
        <a href="<?=$PGE_NUM['first_link']; ?>">First Page</a>
        <a href="<?=$PGE_NUM['prev_link']; ?>">Prev Page</a>
        <a href="<?=$PGE_NUM['next_link']; ?>">Next Page</a>
    </div>
<?php include '../app/pages/includes/footer.php'; ?>