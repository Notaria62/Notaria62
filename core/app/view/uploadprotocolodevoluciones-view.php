<?php

/**
 * uploadprocedure_view short summary.
 *
 * uploadprocedure_view description.
 *
 * @version 1.0
 * @author sistemas
 */
class uploadprocedure_view
{ }

?>

<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">Cargar archivo masivo de devoluciones <i class="material-icons">import_contacts</i></h4>
        <p class="card-category"></p>
    </div>
    <div class="card-body">
        <div class="card-title">
            <!-- Session comments -->
            <?= Util::display_msg(Session::$msg); ?>
            <!-- End session comments-->
            <h2></h2>
            <form class="form-horizontal" action="./?action=uploadprotocolodevoluciones" method="post" role="form"
                enctype="multipart/form-data">
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="uploadedfile" name="uploadedfile" />
                    <label class="custom-file-label" for="customFile">elegir archivo</label>
                </div>

                <br />
                <button type="submit" id="submit" class="btn btn-primary" name="submit"
                    data-loading-text="Loading...">Upload</button>


            </form>
        </div>
    </div>
</div>