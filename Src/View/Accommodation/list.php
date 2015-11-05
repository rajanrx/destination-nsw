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
                    <a href="<?= $product->product_id ?>">
                        <h3><?= $product->product_name ?></h3>
                    </a>

                    <p> <?= sizeof($product->product_description > 100) ? substr($product->product_description, 0, 500) . '... <a href="' . $product->product_id . '."> Read More </a>' : $product->product_description ?></p>
                </div>
            </div>
            <?php $counter++; ?>
        <?php } ?>
    </div>
<?php } ?>


