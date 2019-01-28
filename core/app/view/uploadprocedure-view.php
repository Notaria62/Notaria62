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
{
}

?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header" data-background-color="blue">
                <h4 class="title">
                    Carga de archivo masivo de escrituras y/o radicados.
                </h4>
            </div>
            <div class="card-content table-responsive">
                <form class="form-horizontal" action="./?action=uploadprocedure" method="post" role="form" enctype="multipart/form-data">


                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="uploadedfile" name="uploadedfile" />
                        <label class="custom-file-label" for="customFile">elegir archivo</label>
                    </div>

                        <br />
                        <button type="submit" id="submit" class="btn btn-primary" name="submit" data-loading-text="Loading...">Upload</button>
                    

                </form>
            </div>
        </div>
    </div>
</div>