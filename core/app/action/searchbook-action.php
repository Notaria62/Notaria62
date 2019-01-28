<?php if (isset($_GET["product"]) && $_GET["product"]!=""):?>
<?php
          $products = BookData::getLike($_GET["product"]);
          if (count($products)>0) {
              ?>
<h3>Resultados de la Busqueda</h3>
<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Serial</th>
            <th>Titulo</th>
            <th>Cantidad</th>
        </tr>
    </thead>
    <?php
              $products_in_cero=0;
              foreach ($products as $product):
    ?>

    <tr>
        <td style="width:80px;"><?php echo $product->isbn; ?>
        </td>
        <td>
            <?php echo $product->title; ?>
        </td>
        <td style="width:30%;">
            <form method="post" action="./?action=addtocart">
                <input type="hidden" name="book_id" value="<?php echo $product->id; ?>">
                <?php $items = ItemData::getAvaiableByBookId($product->id); ?>
                <div class="form-group bmd-form-group is-filled">
                    <select class="custom-select" name="item_id" required>
                        <option value=""> -- EJEMPLAR --</option>
                        <?php foreach ($items as $item):?>
                        <option value="<?php echo $item->id; ?>"> <?php echo $item->code; ?>
                        </option>
                        <?php endforeach; ?>
                    </select>

                </div>
                <span class="input-group-btn">
                    <button type="submit" class="btn-sm btn-primary"><i class="material-icons">add</i>Agregar</button>
                </span>

            </form>
        </td>
    </tr>

    <?php endforeach; ?>
</table>

<?php
          } else {
              echo "<br><p class='alert alert-danger'>No se encontro el producto</p>";
          }
    ?>
<hr>
<br>
<?php else:
?>
<?php endif;
