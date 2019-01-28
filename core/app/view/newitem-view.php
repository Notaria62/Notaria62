<?php $book = BookData::getById($_GET["book_id"]); ?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header" data-background-color="blue">
                <h4 class="title"><?php echo $book->title;?>
                    <small>Nuevo Ejemplar</small>
                </h4>
            </div>
            <div class="card-content table-responsive">
                <form class="form-horizontal" method="post" id="addcategory" action="./?action=additem" role="form">

                    <div class="form-group">
                        <label for="inputEmail1" class="bmd-label-floating">Codigo*</label>
                        <div class="col-md-6">
                            <input type="text" name="code" required class="form-control" id="code" placeholder="Codigo">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail1" class="bmd-label-floating">Status*</label>
                        <div class="col-md-6">
                            <select name="status_id" class="form-control"><?php foreach(StatusData::getAll() as $p):?>
                                <option value="<?php echo $p->id; ?>"><?php echo $p->name; ?></option><?php endforeach; ?>
                            </select>
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="col-lg-offset-2 col-lg-10">
                            <input type="hidden" name="book_id" value="<?php echo $book->id; ?>">
                            <button type="submit" class="btn btn-primary">Agregar Ejemplar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

