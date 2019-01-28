<?php
class AdminError
{
    /**
     * Atributo
     *
     **/
    
    public $_contexto;

    public function __construct($contexto)
    {
        $this->_contexto =& $contexto;
        $GLOBALS['_OBJETO_CONTEXTO'] =& $this->_contexto;
        $this->activo(false);
    }
    
    public function iniciar()
    {
        if (!function_exists('adm_error')) {
            function adm_error($numero, $mensaje, $archivo, $linea, $contexto, $retorna=false)
            {
                $objContexto =& $GLOBALS['_OBJETO_CONTEXTO'];
                $objContexto->inicializar($numero, $mensaje, $archivo, $linea, $contexto);
                if ($retorna) {
                    return $objContexto->leer();
                } else {
                    print $objContexto->leer();
                    print_r($contexto);
                }
            }
        }
          
        if (!function_exists('errorFatal')) {
            function errorFatal($buffer)
            {
                $buffer_temporal = $buffer;
                $texto = strip_tags($buffer_temporal);
                if (preg_match('/Parse error: (.+) in (.+)? on line (\d+)/', $texto, $c)) {
                    return adm_error(E_USER_ERROR, $c[1], $c[2], $c[3], "", true);
                }
                if (preg_match('/Fatal error: (.+) in (.+)? on line (\d+)/', $texto, $c)) {
                    return adm_error(E_USER_ERROR, $c[1], $c[2], $c[3], "", true);
                }
                return $buffer;
            }
        }

        if ($this->activo()) {
            error_reporting(E_ALL);
            ob_start('errorFatal');
            set_error_handler('adm_error');
        } else {
            error_reporting(0);
        }
    }
    
    public function activo()
    {
        switch (func_num_args()) {
            case 1: $this->_activo = func_get_arg(0); $this->iniciar(); break;
            case 0: return $this->_activo;
        }
    }
}
