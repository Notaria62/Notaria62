<?php
//unset($_SESSION["cart"]);
?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header" data-background-color="blue">
                <h4 class="title">
                    Buscar papel notarial perdido
                </h4>
            </div>
            <div class="card-content table-responsive">
                <a href="./?view=newsafetypaper" class="btn btn-default">
                    <i class='fa fa-paperclip'></i>Nuevo papel de seguridad
                </a>
                <form id="searchp">
                    <div class="row">
                        <div class="col-md-6">
                            <input type="hidden" name="view" value="sell" />
                            <div class="form-group">
                                <input name="paper_code" required="" class="form-control" id="paper_code" placeholder="C&oacute;d. hoja" type="text" />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-primary">
                                <i class="material-icons">search</i>Buscar
                            </button>
                        </div>
                    </div>
                </form>
                <div id="show_search_results"></div>
            </div>
            
        </div>
    </div>
</div>
<script>
    //jQuery.noConflict();

    $(document).ready(function () {
        $("#searchp").on("submit", function (e) {
            e.preventDefault();

            $.get("./?action=searchsafetypaper", $("#searchp").serialize(), function (data) {
                $("#show_search_results").html(data);
            });
            $("#paper_code").val("");

        });
    });
</script>


