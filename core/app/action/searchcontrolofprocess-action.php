<?php
/**
* searchcontrolofprocess short summary.
*
* searchcontrolofprocess description.
*
* @version 1.0
* @author DigitalesWeb
*/

$numeroescriturapublica = $_GET['numeroescriturapublica'];
$checklists_id = $_GET['ddllists'];
$client_id = $_GET['ddlabogado'];
$anho = $_GET['ep_anho'];
$questions = ChecklistsquestionData::getAllQuestionsOn("open", $checklists_id);
$checkanswers = ChecklistsanswerData::getByEP($numeroescriturapublica, $anho);
if (empty($checkanswers)) {
    ?>
<form class="" method="post" id="addcontrolofprocess" action="./?action=addcontrolofprocess" role="form">
    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Pregunta</th>
                        <th>Si</th>
                        <th>No</th>
                    </tr>
                </thead>
                <?php
                        $display_number = 1;
    foreach ($questions as $key => $value) :
        $q_format= $value->q_format;
    $question1 = $value->pregunta;
    $description = $value->description;
    $checklistsquestions_id = $value->clq_id;
    $description = $value->description;
    $linkpdf = $value->linkpdf;
    $created_at = new DateTime($value->created_at);
    $today = new DateTime(NumeroALetras::getDatetimeNow());
    $diff =$created_at->diff($today); ?>
                <tr data-background-color-approval="<?php echo ($diff->days <= 30) ? " approval " : "
                    "; ?>">
                    <td>
                        <?php echo $display_number; ?>.
                        <?php echo $question1; ?>.
                        <?php if (!empty($description) || (!empty($linkpdf))) :  ?>
                        <a href="" data-toggle="modal" data-target="#myModal-<?php echo $checklistsquestions_id; ?>"
                            title="<?php echo $description; ?>" class="btn-simple btn btn-danger btn-xs">
                            Ver m&aacute;s
                            <i class="material-icons">visibility</i>
                        </a>
                        <!-- Modal -->
                        <div class="modal fade" id="myModal-<?php echo $checklistsquestions_id; ?>" tabindex="-1"
                            role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <h4 class="modal-title" id="myModalLabel">Acotaci&oacute;n</h4>
                                    </div>
                                    <div class="modal-body">
                                        <?php echo $description; ?>
                                        <?php if (!empty($linkpdf)): ?>
                                        <object width="100%" height="350px" data="<?php echo $linkpdf; ?>#zoom=85"
                                            type="application/pdf" trusted="yes" application="yes"></object>
                                        <?php endif?>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default"
                                            data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                        <input type="hidden" name="qid[]" id="qid[]" value='<?php echo $checklistsquestions_id; ?>'>
                    </td>
                    <td class="col-md-1">
                        <label>
                            <input type="radio" name="question<?php echo $checklistsquestions_id; ?>_answer" value="1"
                                required>
                        </label>
                    </td>
                    <td class="col-md-1">
                        <label>
                            <input type="radio" name="question<?php echo $checklistsquestions_id; ?>_answer" value="0">
                        </label>
                    </td>
                </tr>
                <?php
                    $display_number++;
    endforeach; ?>
            </table>
        </div>
    </div>
    <div class="form-group">
        <div class="col-lg-offset-2 col-lg-10">
            <input type="hidden" name="numeroescriturapublica" id="numeroescriturapublica"
                value="<?php echo $_GET['numeroescriturapublica']; ?>" />
            <input type="hidden" name="checklists_id" id="checklists_id" value="<?php echo $_GET['ddllists']; ?>" />
            <input type="hidden" name="client_id" id="client_id" value="<?php echo $_GET['ddlabogado']; ?>" />
            <input type="hidden" name="ep_anho" id="ep_anho" value="<?php echo $_GET['ep_anho']; ?>" />
            <button type="submit" class="btn btn-success">Guardar control proceso</button>
        </div>
    </div>
</form>
<?php
} else {
        echo "<p class='alert alert-danger'>El control proceso para la escritura publica: ".$_GET['numeroescriturapublica']." del a&ntilde;: ".$_GET['ep_anho']." ya esta creada. <a href='./?view=controlofprocess'>Haga click para ver</a></p>";
    }