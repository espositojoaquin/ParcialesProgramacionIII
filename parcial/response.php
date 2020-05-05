<?php
class Response
{ 

    public static function Respuesta($resp,$data)
    {   
        $respuesta = new stdClass;
       /* if($respuesta == true)
        {
            $respuesta->respuesta = "Success";

        }
        else
        {
            $respuesta->respuesta = "ERROR";
        }*/
        $respuesta->respuesta = $resp;
        $respuesta->data = $data;

        return $respuesta;
    }

}
?>