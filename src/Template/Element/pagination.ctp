<div class="paginator">
    <ul class="pagination">
        <?=$this->Paginator->numbers([
            'before' => $this->Paginator->first("<<"),
            'after'  => $this->Paginator->last(">>"),
        ]) ?>
    </ul>
</div>