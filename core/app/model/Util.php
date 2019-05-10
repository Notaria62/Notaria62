<?php
class Util
{
    public static function getDatetimeNow()
    {
        $tz_object = new DateTimeZone('America/Bogota');
        $datetime = new DateTime();
        $datetime->setTimezone($tz_object);
        return $datetime->format('Y\-m\-d\ H:i');
    }
    /*--------------------------------------------------------------*/
    /* Find current log in user by session id
    /*--------------------------------------------------------------*/
    public static function current_user()
    {
        static $current_user;
        global $db;
        if (!$current_user) {
            if (isset($_SESSION['user_id'])) :
                $user_id = intval($_SESSION['user_id']);
                $current_user = UserData::getById($user_id);
            endif;
        }
        return $current_user;
    }

    public static function getUrlGropus($id)
    {
        $sql = "SELECT * FROM categorymenu cm inner JOIN user_groups_categorymenu ugcm WHERE user_groups_id=$id and cm.id = ugcm.category_id";
        $query = Executor::doit($sql);
        return Model::many($query[0], new CategoryMenuData());
    }

    /*--------------------------------------------------------------*/
    /* Function for Remove html characters
    /*--------------------------------------------------------------*/
    public static function remove_junk($str)
    {
        $str = nl2br($str);
        $str = htmlspecialchars(strip_tags($str, ENT_QUOTES));
        return $str;
    }
    /*--------------------------------------------------------------*/
    /* Function for Display Session Message
       Ex echo displayt_msg($message);
    /*--------------------------------------------------------------*/
    public static function display_msg($msg = '')
    {
        $output = array();
        if (!empty($msg)) {
            foreach ($msg as $key => $value) {
                $output = "<div class=\"alert alert-{$key} alert-with-icon\" data-notify=\"container\">";
                $output .= "<i class=\"material-icons\" data-notify=\"icon\">notifications</i>";
                $output .= "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><i class=\"material-icons\">close</i></button>";
                $output .= "<span data-notify=\"icon\" class=\"now-ui-icons ui-1_bell-53\"></span>";
                $output .= "<span data-notify=\"message\">";
                $output .= self::remove_junk(self::first_character($value));
                $output .= "</span></div>";
            }
            return $output;
        } else {
            return "";
        }
    }

    /*--------------------------------------------------------------*/
    /* Function for Uppercase first character
    /*--------------------------------------------------------------*/
    public static function first_character($str)
    {
        $val = str_replace('-', " ", $str);
        $val = ucfirst($val);
        return $val;
    }
    public static function generateRadioButtons($name, $values = 5, $flag = false, $valueA = "")
    {
        $i = $flag == true ? 0 : 1;
        $values = $flag == true ? $values - 1 : $values;
        $o = '<label>' . "\n";
        for ($v = $i; $v <= $values; $v++) {
            $b = '';
            if ($flag == true) {
                $b = $v == 0 ? 'No' : 'Si';
            }
            $selected = (empty($valueA) && $valueA != $v) ? '' : ' checked="checked"';
            $o .= '<input type="radio" class="" id="' . $name . '" name="' . $name . '" value="' . $v . '"' . $selected . '> ' . $b . "\n";
        }
        $o .= '</label>' . "\n";
        return $o;
    }
    public static function generateTextArea($name, $values = 1, $rows = 3, $cols = 3)
    {
        $o = '<label>' . "\n";
        for ($v = 1; $v <= $values; $v++) {
            $o .= '<textarea class="" name="' . $name . '" id="' . $name . '" rows="' . $rows . '" cols="' . $cols . '"> </textarea>' . "\n";
        }
        $o .= '</label>' . "\n";
        return $o;
    }

    public static function pagination($links, $list_class, $_total, $_limit, $_page)
    {
        if ($_limit == 'all') {
            return '';
        }
        $last       = ceil($_total / $_limit);

        $start      = (($_page - $links) > 0) ? $_page - $links : 1;
        $end        = (($_page + $links) < $last) ? $_page + $links : $last;

        $html       = '<ul class="' . $list_class . '">';
        $class      = ($_page == 1) ? "disabled" : "";
        $html       .= '<li class="page-item ' . $class . '"><a class="page-link" href="./?view=' . $_GET['view'] . '&page=' . ($_page - 1) . '">&laquo;</a></li>';
        if ($start > 1) {
            $html   .= '<li class="page-item"><a href="./?view=' . $_GET['view'] . '&page=1">1</a></li>';
            $html   .= '<li class="disabled"><span>...</span></li>';
        }
        for ($i = $start; $i <= $end; $i++) {
            $class  = ($_page == $i) ? "active" : "";
            $html   .= '<li class="page-item ' . $class . '"><a class="page-link" href="./?view=' . $_GET['view'] . '&page=' . $i . '">' . $i . '</a></li>';
        }
        if ($end < $last) {
            $html   .= '<li class="disabled"><span>...</span></li>';
            $html   .= '<li class="page-item" ><a class="page-link" href="./?view=' . $_GET['view'] . '&page=' . $last . '">' . $last . '</a></li>';
        }
        $class      = ($_page == $last) ? "disabled" : "";
        $html       .= '<li class="page-item ' . $class . '"><a  class="page-link"  href="./?view=' . $_GET['view'] . '&page=' . ($_page + 1) . '">&raquo;</a></li>';
        $html       .= '</ul>';
        return $html;
    }

    /*
 * zero_fill
 *
 * Rellena con ceros a la izquierda
 *
 * @param $valor  valor a rellenar
 * @param $long   longitud total del valor
 * @return        valor rellenado
 */

    public static function zero_fill($valor, $long = 0)
    {
        return str_pad($valor, $long, '0', STR_PAD_LEFT);
    }
    public static function eliminar_puntos_tres_digitos($valor)
    {
        return preg_replace('/(\d)\.(?=\d{3}(?!\d))/', '$1', $valor);
    }
    public static function toDot($valor)
    {
        return preg_replace('/\B(?=(\d{3})+\b)/', '.', $valor);
    }
    public static function antiXSS($valor)
    {    //Variable de búsqueda
        $consultaBusqueda = $valor;

        //Filtro anti-XSS
        $caracteres_malos = array("<", ">", "\"", "'", "/", "<", ">", "'", "/");
        $caracteres_buenos = array("& lt;", "& gt;", "& quot;", "& #x27;", "& #x2F;", "& #060;", "& #062;", "& #039;", "& #047;");
        $consultaBusqueda = str_replace($caracteres_malos, $caracteres_buenos, $consultaBusqueda);
        return $consultaBusqueda;
    }
}