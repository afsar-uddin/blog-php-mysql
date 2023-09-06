<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP | <?=APP_NAME?></title>
    <link rel="stylesheet" href="<?=ROOT ?>/assets/css/bootstrap.min.css">
</head>
<body>
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
</body>
</html>