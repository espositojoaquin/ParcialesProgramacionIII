<?php
class Funciones{
    
    public static function DatosCompletos($objeto,$op){
     
        $vars_clase = get_class_vars(get_class($objeto));
        $aux = array_keys($vars_clase);
      
        $sinDatos = "Falta completar: ";
        $flag = true;    
        foreach ($aux as $item) {
            if($objeto->$item =="0")
            {   
              
                $sinDatos.= $item.",";
              
              $flag = false;
            }
        }
         if($op == 1)
         {   
             if($flag == true)
             {
                 $sinDatos ="1";
             }
             return $sinDatos;

         }
         else
         {
             return $flag;

         }

    }

    public static function Filter($lista,$nombreDato,$dato)
    {
        $arrayResponse = array();

        foreach ($lista as $item) {
            if(strcasecmp($item->$nombreDato,$dato) == 0)
            {
                array_push($arrayResponse,$item);
            }
        } 

        return $arrayResponse;
    } 

    public static function FilterUno($lista,$nombreDato,$dato)
    {
        $response = false;

        foreach ($lista as $item) {

            if(strcasecmp($item->$nombreDato,$dato) == 0)
            {
                $response = $item;
            }
        } 

       
        return $response;
    } 
    public static function FilterDos($lista,$nombreDato,$dato,$nombreDato2,$dato2)
    {
        $response = false;

        foreach ($lista as $item) {
         
            if(strcasecmp($item->$nombreDato,$dato) == 0 && strcasecmp($item->$nombreDato2,$dato2) == 0)
            {
                $response = $item;
            }
        } 

       
        return $response;
    } 



    public static function Existe($lista,$nombreDato,$dato)
    {
        $retorno = false;
        foreach ($lista as $item) {
            if(strcasecmp($item->$nombreDato,$dato) == 0)
            {
               $retorno = true;
            }
        } 

        return $retorno;
    } 

    public static function generateID($path)
    {   
        $retorno = 1;
        if(file_exists($path) && filesize($path) > 0) {

            $objeto = Archivos::retornarDatosSerializados($path);

            $retorno = $objeto[count($objeto)-1]->id +1;

        }

        return $retorno;
    }

    public static function generateIDJson($path)
    {   
        $retorno = 1;
        if(file_exists($path) && filesize($path) > 0) {

            $objeto = Archivos::retornarDatos($path);

            $retorno = $objeto[count($objeto)-1]->id +1;

        }

        return $retorno;
    }

    // Se fija si hay una cantidad solicitada de X y descuenta la cantidad;
    // Lista de objetos
    // $id indenficador del obejto
    // $nombreDato, es el nombre del campo a descontar
    // $cantidad es el numero a descontar.
    // return true en caso de haber podido descontar, false en caso de no

    public static function Descontar($lista,$id,$nombreId,$nombreDato,$cantidad,$path)
    {  
        $retorno = false;
           foreach($lista as $item ){
               if($item->$nombreId == $id)
               {
                   if($item->$nombreDato >= $cantidad)
                   {
                       $item->$nombreDato -= $cantidad;
                       $retorno = true;
                       break;
                   }
               }

           }

           Archivos::guardarTodos($path,$lista);

           return $retorno;

    }



    public static function datoEspecifico($dato,$nombreDato){

        if($nombreDato == $dato)
        {
            return true;
        }
        else
        {
            return false;
        }

    } 
    public static function datosEspecificos2($dato,$opcion1,$opcion2)
    {
        if(strcasecmp($dato,$opcion1)==0 || strcasecmp($dato,$opcion2)==0) 
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public static function datosEspecificos3($dato,$opcion1,$opcion2,$opcion3)
    {
        if(strcasecmp($dato,$opcion1)==0 || strcasecmp($dato,$opcion2)==0 || strcasecmp($dato,$opcion3)==0) 
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public static function montoTotal($nombreDato,$lista)
    {
       $retorno = 0; 

       foreach($lista as $item)
       {
            $retorno += $item->$nombreDato;
       }
       return $retorno;
    }

    public static function Modificar($id,$nombreId,$dato,$nombreDato,$path)
    { 
        $lista = Archivos::retornarDatos($path);
        foreach($lista as $item)
        {
            if($item->$nombreId == $id)
            {
                $item->$nombreDato = $dato;
            }
        } 

        Archivos::guardarTodos($path,$lista);

    }

    





}
?>