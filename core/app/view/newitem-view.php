<?php $book = BookData::getById($_GET["book_id"]); ?>



<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title"><?php echo $book->title; ?>
            <small>Nuevo Ejemplar</small> <i class="material-icons">item</i></h4>
        <p class="card-category"></p>
    </div>
    <div class="card-body">
        <div class="card-title">
            <!-- Session comments -->
            <?= Util::display_msg(Session::$msg); ?>
            <!-- End session comments-->
            <h2></h2>
        </div>

        <form class="form-horizontal" method="post" id="addcategory" action="./?action=additem" role="form">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="code" class="bmd-label-floating">Codigo*</label>
                        <input type="text" name="code" required class="form-control" id="code">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="status_id" class="bmd-label-floating">Status*</label>
                        <select name="status_id" class="form-control"><?php foreach (StatusData::getAll() as $p) : ?>
                            <option value="<?php echo $p->id; ?>"><?php echo $p->name; ?>
                            </option><?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-offset-2 col-lg-10">
                        <input type="hidden" name="book_id" value="<?php echo $book->id; ?>">
                        <button type="submit" class="btn btn-primary">Agregar Ejemplar</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>