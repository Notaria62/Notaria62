<?php
/**
 * Clase que implementa un coversor de números
 * a letras.
 *
 * Soporte para PHP >= 5.4
 * Para soportar PHP 5.3, declare los arreglos
 * con la función array.
 *
 * @author AxiaCore S.A.S
 *
 */

class NumeroALetras
{
    private static $UNIDADES = [
        '',
        'UN ',
        'DOS ',
        'TRES ',
        'CUATRO ',
        'CINCO ',
        'SEIS ',
        'SIETE ',
        'OCHO ',
        'NUEVE ',
        'DIEZ ',
        'ONCE ',
        'DOCE ',
        'TRECE ',
        'CATORCE ',
        'QUINCE ',
        'DIECISÉIS ',
        'DIECISIETE ',
        'DIECIOCHO ',
        'DIECINUEVE ',
        'VEINTE '
    ];

    private static $UNIDADESCARDINALES = [
        '',
        'UNO ',
        'DOS ',
        'TRES ',
        'CUATRO ',
        'CINCO ',
        'SEIS ',
        'SIETE ',
        'OCHO ',
        'NUEVE ',
        'DIEZ ',
        'ONCE ',
        'DOCE ',
        'TRECE ',
        'CATORCE ',
        'QUINCE ',
        'DIECISÉIS ',
        'DIECISIETE ',
        'DIECIOCHO ',
        'DIECINUEVE ',
        'VEINTE '
    ];

    private static $DECENAS = [
        'VEINTI',
        'TREINTA ',
        'CUARENTA ',
        'CINCUENTA ',
        'SESENTA ',
        'SETENTA ',
        'OCHENTA ',
        'NOVENTA ',
        'CIEN '
    ];

    private static $CENTENAS = [
        'CIENTO ',
        'DOSCIENTOS ',
        'TRESCIENTOS ',
        'CUATROCIENTOS ',
        'QUINIENTOS ',
        'SEISCIENTOS ',
        'SETECIENTOS ',
        'OCHOCIENTOS ',
        'NOVECIENTOS '
    ];

    public static function convertir($number, $moneda = '', $centimos = '', $forzarCentimos = false)
    {
        $converted = '';
        $decimales = '';

        if (($number < 0) || ($number > 999999999)) {
            return 'No es posible convertir el numero a letras';
        }

        $div_decimales = explode('.', $number);

        if (count($div_decimales) > 1) {
            $number = $div_decimales[0];
            $decNumberStr = (string) $div_decimales[1];
            if (strlen($decNumberStr) == 2) {
                $decNumberStrFill = str_pad($decNumberStr, 9, '0', STR_PAD_LEFT);
                $decCientos = substr($decNumberStrFill, 6);
                $decimales = self::convertGroup($decCientos);
            }
        } elseif (count($div_decimales) == 1 && $forzarCentimos) {
            $decimales = 'CERO ';
        }

        $numberStr = (string) $number;
        $numberStrFill = str_pad($numberStr, 9, '0', STR_PAD_LEFT);
        $millones = substr($numberStrFill, 0, 3);
        $miles = substr($numberStrFill, 3, 3);
        $cientos = substr($numberStrFill, 6);

        if (intval($millones) > 0) {
            if ($millones == '001') {
                $converted .= 'UN MILLON ';
            } elseif (intval($millones) > 0) {
                $converted .= sprintf('%sMILLONES ', self::convertGroup($millones));
            }
        }

        if (intval($miles) > 0) {
            if ($miles == '001') {
                $converted .= 'MIL ';
            } elseif (intval($miles) > 0) {
                $converted .= sprintf('%sMIL ', self::convertGroup($miles));
            }
        }

        if (intval($cientos) > 0) {
            if ($cientos == '001') {
                $converted .= 'UN ';
            } elseif (intval($cientos) > 0) {
                $converted .= sprintf('%s', self::convertGroup($cientos));
            }
        }

        if (empty($decimales)) {
            $valor_convertido = $converted . strtoupper($moneda);
        } else {
            $valor_convertido = $converted . strtoupper($moneda) . ' CON ' . $decimales . ' ' . strtoupper($centimos);
        }

        return $valor_convertido;
    }

    public static function convertirEscritura($number, $moneda = '', $centimos = '', $forzarCentimos = false)
    {
        $converted = '';
        $decimales = '';

        if (($number < 0) || ($number > 999999999)) {
            return 'No es posible convertir el numero a letras';
        }

        $div_decimales = explode('.', $number);

        if (count($div_decimales) > 1) {
            $number = $div_decimales[0];
            $decNumberStr = (string) $div_decimales[1];
            if (strlen($decNumberStr) == 2) {
                $decNumberStrFill = str_pad($decNumberStr, 9, '0', STR_PAD_LEFT);
                $decCientos = substr($decNumberStrFill, 6);
                $decimales = self::convertGroupCarninales($decCientos);
            }
        } elseif (count($div_decimales) == 1 && $forzarCentimos) {
            $decimales = 'CERO ';
        }

        $numberStr = (string) $number;
        $numberStrFill = str_pad($numberStr, 9, '0', STR_PAD_LEFT);
        $millones = substr($numberStrFill, 0, 3);
        $miles = substr($numberStrFill, 3, 3);
        $cientos = substr($numberStrFill, 6);

        if (intval($millones) > 0) {
            if ($millones == '001') {
                $converted .= 'UN MILLON ';
            } elseif (intval($millones) > 0) {
                $converted .= sprintf('%sMILLONES ', self::convertGroupCarninales($millones));
            }
        }

        if (intval($miles) > 0) {
            if ($miles == '001') {
                $converted .= 'MIL ';
            } elseif (intval($miles) > 0) {
                $converted .= sprintf('%sMIL ', self::convertGroupCarninales($miles));
            }
        }

        if (intval($cientos) > 0) {
            if ($cientos == '001') {
                $converted .= 'UNO ';
            } elseif (intval($cientos) > 0) {
                $converted .= sprintf('%s', self::convertGroupCarninales($cientos));
            }
        }

        if (empty($decimales)) {
            $valor_convertido = $converted . strtoupper($moneda);
        } else {
            $valor_convertido = $converted . strtoupper($moneda) . ' CON ' . $decimales . ' ' . strtoupper($centimos);
        }

        return $valor_convertido;
    }
    private static function convertGroupCarninales($n)
    {
        $output = '';

        if ($n == '100') {
            $output = "CIEN ";
        } elseif ($n[0] !== '0') {
            $output = self::$CENTENAS[$n[0] - 1];
        }

        $k = intval(substr($n, 1));

        if ($k <= 20) {
            $output .= self::$UNIDADESCARDINALES[$k];
        } else {
            if (($k > 30) && ($n[2] !== '0')) {
                $output .= sprintf('%sY %s', self::$DECENAS[intval($n[1]) - 2], self::$UNIDADESCARDINALES[intval($n[2])]);
            } else {
                $output .= sprintf('%s%s', self::$DECENAS[intval($n[1]) - 2], self::$UNIDADESCARDINALES[intval($n[2])]);
            }
        }

        return $output;
    }

    private static function convertGroup($n)
    {
        $output = '';

        if ($n == '100') {
            $output = "CIEN ";
        } elseif ($n[0] !== '0') {
            $output = self::$CENTENAS[$n[0] - 1];
        }

        $k = intval(substr($n, 1));

        if ($k <= 20) {
            $output .= self::$UNIDADES[$k];
        } else {
            if (($k > 30) && ($n[2] !== '0')) {
                $output .= sprintf('%sY %s', self::$DECENAS[intval($n[1]) - 2], self::$UNIDADES[intval($n[2])]);
            } else {
                $output .= sprintf('%s%s', self::$DECENAS[intval($n[1]) - 2], self::$UNIDADES[intval($n[2])]);
            }
        }

        return $output;
    }

    public static function obtenerFechaEnLetra($fecha)
    {
        //echo $fecha;
        // asigno a la variable $dia el dia de la semana dada una fecha ver funcion conocerDiaSemanaFecha
        //$dia = self::conocerDiaSemanaFecha($fecha);
        // asigno a la variable $num el número del dia de la fecha dada ejemplo: 17/06/2016 $num = 17 ver date en http://php.net/manual/es/function.date.php
        $num = date("j", strtotime($fecha));
        // asigno a la variable $anno el año de la fecha dada ejemplo: 17/06/2016 $anno = 2016 ver date en http://php.net/manual/es/function.date.php
        $anno = date("Y", strtotime($fecha));
        // asigno a la variable $mes una lista de los meses donde cada elemento de la lista concide con el numero del mes - 1
        $mes = array('ENERO', 'FEBRERO', 'MARZO', 'ABRIL', 'MAYO', 'JUNIO', 'JULIO', 'AGOSTO', 'SEPTIEMBRE', 'OCTUBRE', 'NOVIEMBRE', 'DICIEMBRE');
        // redefino la variable $mes que es una lista con el número de mes que me devuelve la (date('m', strtotime($fecha)), lo multiplico x1 y le
        // resto -1 ejemplo : fecha-> 17/06/2016 (date('m', strtotime($fecha))-> m= 07*1 -> 7-1 = 6 -> $mes[6] = junio
        $mes = $mes[(date('m', strtotime($fecha)) * 1) - 1];
        // retorno todo los valores concatenados como quiero ejemplo: Viernes, 17 de junio del 2016
        
        return self::convertir($num).'('.$num.') DÍAS DEL MES ' . $mes . ' DEL AÑO ' .self::convertir($anno)."(". $anno.")";
    }

    public static function obtenerFechaEnLetraEscritura($fecha)
    {
        //echo $fecha;
        // asigno a la variable $dia el dia de la semana dada una fecha ver funcion conocerDiaSemanaFecha
        //$dia = self::conocerDiaSemanaFecha($fecha);
        // asigno a la variable $num el número del dia de la fecha dada ejemplo: 17/06/2016 $num = 17 ver date en http://php.net/manual/es/function.date.php
        $num = date("j", strtotime($fecha));
        // asigno a la variable $anno el año de la fecha dada ejemplo: 17/06/2016 $anno = 2016 ver date en http://php.net/manual/es/function.date.php
        $anno = date("Y", strtotime($fecha));
        // asigno a la variable $mes una lista de los meses donde cada elemento de la lista concide con el numero del mes - 1
        $mes = array('ENERO', 'FEBRERO', 'MARZO', 'ABRIL', 'MAYO', 'JUNIO', 'JULIO', 'AGOSTO', 'SEPTIEMBRE', 'OCTUBRE', 'NOVIEMBRE', 'DICIEMBRE');
        // redefino la variable $mes que es una lista con el número de mes que me devuelve la (date('m', strtotime($fecha)), lo multiplico x1 y le
        // resto -1 ejemplo : fecha-> 17/06/2016 (date('m', strtotime($fecha))-> m= 07*1 -> 7-1 = 6 -> $mes[6] = junio
        $mes = $mes[(date('m', strtotime($fecha)) * 1) - 1];
        // retorno todo los valores concatenados como quiero ejemplo: Viernes, 17 de junio del 2016
        $diaNum = (self::convertir($num) == "UN ") ? $diaNum = "PRIMERO ": $diaNum =self::convertir($num);
        return $diaNum.'('.$num.') DE ' . $mes . ' DEL ' .self::convertir($anno)."(". $anno.")";
    }

    public static function dateShortToWordsCreate($fecha)
    {
        //echo $fecha;
        // asigno a la variable $dia el dia de la semana dada una fecha ver funcion conocerDiaSemanaFecha
        //$dia = self::conocerDiaSemanaFecha($fecha);
        // asigno a la variable $num el número del dia de la fecha dada ejemplo: 17/06/2016 $num = 17 ver date en http://php.net/manual/es/function.date.php
        $num = date("j", strtotime($fecha));
        // asigno a la variable $anno el año de la fecha dada ejemplo: 17/06/2016 $anno = 2016 ver date en http://php.net/manual/es/function.date.php
        $anno = date("Y", strtotime($fecha));
        // asigno a la variable $mes una lista de los meses donde cada elemento de la lista concide con el numero del mes - 1
        $mes = array('ENERO', 'FEBRERO', 'MARZO', 'ABRIL', 'MAYO', 'JUNIO', 'JULIO', 'AGOSTO', 'SEPTIEMBRE', 'OCTUBRE', 'NOVIEMBRE', 'DICIEMBRE');
        // redefino la variable $mes que es una lista con el número de mes que me devuelve la (date('m', strtotime($fecha)), lo multiplico x1 y le
        // resto -1 ejemplo : fecha-> 17/06/2016 (date('m', strtotime($fecha))-> m= 07*1 -> 7-1 = 6 -> $mes[6] = junio
        $mes = $mes[(date('m', strtotime($fecha)) * 1) - 1];
        // retorno todo los valores concatenados como quiero ejemplo: Viernes, 17 de junio del 2016
        return self::convertir($num).'('.$num.') DÍAS DE ' . $mes . ' DEL ' .self::convertir($anno)."(". $anno.")";
    }
    public static function dateShortToWords($fecha)
    {
        //echo $fecha;
        // asigno a la variable $dia el dia de la semana dada una fecha ver funcion conocerDiaSemanaFecha
        //$dia = self::conocerDiaSemanaFecha($fecha);
        // asigno a la variable $num el número del dia de la fecha dada ejemplo: 17/06/2016 $num = 17 ver date en http://php.net/manual/es/function.date.php
        $num = date("j", strtotime($fecha));
        // asigno a la variable $anno el año de la fecha dada ejemplo: 17/06/2016 $anno = 2016 ver date en http://php.net/manual/es/function.date.php
        $anno = date("Y", strtotime($fecha));
        // asigno a la variable $mes una lista de los meses donde cada elemento de la lista concide con el numero del mes - 1
        $mes = array('ENERO', 'FEBRERO', 'MARZO', 'ABRIL', 'MAYO', 'JUNIO', 'JULIO', 'AGOSTO', 'SEPTIEMBRE', 'OCTUBRE', 'NOVIEMBRE', 'DICIEMBRE');
        // redefino la variable $mes que es una lista con el número de mes que me devuelve la (date('m', strtotime($fecha)), lo multiplico x1 y le
        // resto -1 ejemplo : fecha-> 17/06/2016 (date('m', strtotime($fecha))-> m= 07*1 -> 7-1 = 6 -> $mes[6] = junio
        $mes = $mes[(date('m', strtotime($fecha)) * 1) - 1];
        // retorno todo los valores concatenados como quiero ejemplo: Viernes, 17 de junio del 2016
        return $num . ' DE ' . $mes . " DEL ". $anno;
    }

    //Para conocer el dia de la semana que cae una fecha dada
    public static function conocerDiaSemanaFecha($fecha)
    {
        // asigno a la variable $dia una lista de los dias donde cada elemento de la lista concide con el numero del dia
        $dias = array('DOMINGO', 'LUNES', 'MARTES', 'MIERCOLES', 'JUEVES', 'VIERNES', 'SABADO');
        // redefino la lista $dia con el resultado de la funcion date('w', strtotime($fecha)) que devuelve el numero del dia
        // que coincide con la posicion de los dias en la lista $dia ejemplo: fecha = 17/06/2016 -> date('w', strtotime($fecha)) = 5 -> $dias[5] = Viernes
        $dia = $dias[date('w', strtotime($fecha))];
        // retorno el valor de la variable $dia que ya no es una lista sino una cadena de caracters que corresponde a Viernes
        return $dia;
    }

    public static function generarCodigo($longitud)
    {
        $key = '';
        $pattern = '1234567890abcdefghijklmnopqrstuvwxyz';
        $max = strlen($pattern)-1;
        for ($i=0;$i < $longitud;$i++) {
            $key .= $pattern{mt_rand(0, $max)};
        }
        return $key;
    }

    public static function getDatetimeNow()
    {
        $tz_object = new DateTimeZone('America/Bogota');
        $datetime = new DateTime();
        $datetime->setTimezone($tz_object);
        return $datetime->format('Y\-m\-d\ h:i:s');
    }

    public static function getDays($fecha_inicial, $fecha_final)
    {
        $dias = (strtotime($fecha_inicial)-strtotime($fecha_final))/86400;
        $dias = abs($dias);
        $dias = floor($dias);
        return $dias;
    }
    public static function tabOdtXml($string)
    {
        return str_replace("\t", '<text:tab/>', $string);
    }
    public static function tabXml($string)
    {
        return str_replace("\t", '</w:t></w:r><w:r><w:tab/></w:r><w:r><w:t>', $string);
    }
    public static function obtenerListadoDeArchivos($directorio, $recursivo=false)
    {
 
  // Array en el que obtendremos los resultados
        $res = array();
 
        // Agregamos la barra invertida al final en caso de que no exista
        if (substr($directorio, -1) != "/") {
            $directorio .= "/";
        }
 
        // Creamos un puntero al directorio y obtenemos el listado de archivos
        $dir = @dir($directorio) or die("getFileList: Error abriendo el directorio $directorio para leerlo");
        while (($archivo = $dir->read()) !== false) {
            // Obviamos los archivos ocultos
            if ($archivo[0] == ".") {
                continue;
            }
            if (is_dir($directorio . $archivo)) {
                $res[] = array(
        "Nombre" => $directorio . $archivo . "/",
        "Tamaño" => 0,
        "Modificado" => filemtime($directorio . $archivo)
      );
                if ($recursivo && is_readable($directorio . $archivo . "/")) {
                    $directorioInterior= $directorio . $archivo . "/";
                    $res = array_merge($res, obtenerListadoDeArchivos($directorioInterior, true));
                }
            } elseif (is_readable($directorio . $archivo)) {
                $res[] = array(
          "Nombre" => $directorio . $archivo,
          "Tamaño" => filesize($directorio . $archivo),
          "Modificado" => filemtime($directorio . $archivo)
        );
            }
        }
        $dir->close();
        return $res;
    }
}
