<?php

class Asignacion{
    public $legajo;
    public $idMateria;
    public $turno;
  


    public function __construct($legajo,$idMateria,$turno)
    {
        $this->legajo = $legajo;
        $this->idMateria = $idMateria;
        $this->turno = $turno;
  
    } 

    public function verificacion($turno,$materia,$legajo)
    {   
        $path = "./materia-profesores.txt";
        $retorno = false;
        $resp = Funciones::DatosCompletos($this,1); 
       
        if($resp == "1"){
    
             if(Funciones::datosEspecificos2($turno,"manana","noche"))
             {   
                 if(file_exists($path) && filesize($path) > 0)
                 {   
                   
                     $lista = Archivos::retornarDatosSerializados($path);
                     $aux = Funciones::FilterDos($lista,"idMateria",$materia,"turno",$turno);
                     if($aux!=false)
                     {
                        if($aux->legajo != $legajo)
                        {
                            $retorno = true;
 
                        }
                        else
                        {
                            $retorno = "No se puede asignar el legajo en el mismo turno y materia ";
                        }
                     }
                     else
                     {
                         $retorno = true;
                     }
                    
                     
                 }
                 else
                 {
                     $retorno = true;
                 }

             }
             else
             {
                $retorno = "El turno debe ser manana o noche ";
             }
            

        }
        else
        {
           $retorno = $resp;
        }

        return $retorno;
    }

    public static function validacionToken()
    { 
          
        $retorno = false;
        $objeto = JsonWebToken::ValidarToken();        
        if($objeto!=false)
        {   
            
                $retorno = true;

        }
       

        return $retorno;

    }

    public function guardar()
    {     
       Archivos::guardarUnoSerializado("./materia-profesores.txt",$this);
       return true;
    } 

   

    public  static function mostar()
    {   
        $retorno = false;
       
        $lista = Archivos::retornarDatosSerializados("./materia-profesores.txt");

        $retorno = $lista;

        return $retorno;

    }
}