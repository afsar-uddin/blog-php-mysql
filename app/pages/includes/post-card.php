<div class="col-md-4">
    <div class="card" style="width: 18rem;">
        <img src="<?=get_image($row['image'])?>" class="card-img-top" alt="...">
        <div class="card-body">
            <h5 class="card-title"><?php $row['title'] ?> </h5>
            <i>Category : <?=$row['category']?></i>
            <div><?=date("jS M, Y", strtotime($row['date']))?></div>
            <div><?=$row['content']?></div>
        </div>
    </div>
</div>