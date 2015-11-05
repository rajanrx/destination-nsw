<?php
if (isset($products->products->product_record) && count($products->products->product_record)) { ?>
    <div>
        <?php $counter = 0; ?>
        <?php foreach ($products->products->product_record as $product) { ?>
            <div class="row highlight"
                 style="background: <?= $counter % 2 == 0 ? 'whitesmoke' : '#eee' ?>;padding-top:5px;padding-bottom: 5px;">
                <div class="col-sm-2">
                    <img src="<?= $product->product_image ?>" style="max-width: 100%;height: auto;margin-top:20px;"/>
                </div>
                <div class="col-sm-10">
                    <a href="/functions.php?action=detail&product-id=<?= $product->product_id ?>" data-remote="false" data-target="#detailModal" class="displayModal">
                        <h3><?= $product->product_name ?></h3>
                    </a>

                    <p> <?= sizeof($product->product_description > 100) ? substr($product->product_description, 0, 500) . '... <a href="/functions.php?action=detail&product-id=' . $product->product_id . '." data-remote="false" data-target="#detailModal" class="displayModal"> Read More </a>' : $product->product_description ?></p>
                </div>
            </div>
            <?php $counter++; ?>
        <?php } ?>
    </div>
<?php } ?>

<div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog full-screen-modal">
        <div class="modal-content full-screen">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="detailModalLabel">Modal title</h4>
            </div>
            <div class="modal-body">
                Loading ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    initiateModal();
</script>
