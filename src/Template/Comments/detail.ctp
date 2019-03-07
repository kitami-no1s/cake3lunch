<ul class="list-unstyled">
  <li>コメントID：<?= $comment->id ?></li>
  <li>投稿者：<?= $comment->user->name ?></li>
  <li>店名：<?= $comment->store->name ?></li>
  <li>投稿日時：<?= $comment->created ?></li>
</ul>
<div class="d-flex">
  <?php if($images) {
      foreach ($images as $image) {
  ?>
  <div>
    <?= $this->Html->image($image->image_url, 
        ['alt' => 'Image', 'data-toggle' => 'modal', 'data-target' => '#image-modal', 'width' => '100', 'height' => '100']); ?>
  </div>
  <div class="modal fade" id="image-modal">
  <div class="modal-dialog">
  <div class="modal-body">
  <?= $this->Html->image($image->image_url, 
      ['alt' => 'Image', 'data-toggle' => 'modal', 'data-target' => '#image-modal', 'class' => "aligncenter size-harf wp-image-425"]); ?>
  </div>
  </div>
  </div>
  <?php }
  }?>
</div>
<div>
<?= $comment->comment ?>
</div>
<div>
<?= $this->Html->link("投稿一覧へ", ['action' => 'index']);?></div>