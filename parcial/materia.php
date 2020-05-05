<?php

class Materia{
    public $nombre;
    public $cuatrimestre;
    public $id;
  


    public function __construct($nombre,$cuatrimestre,$id)
    {
        $this->nombre = $nombre;
        $this->cuatrimestre = $cuatrimestre;
        $this->id = $id;
  
    } 

    public function verificacion()
    {   
        $path = "./materias.txt";
        $retorno = false;
        $resp = Funciones::DatosCompletos($this,1); 

        if($resp == "1"){
    
             
                if(file_exists($path) && filesize($path) > 0)
                {
                    $lista = Archivos::retornarDatosSerializados($path);

                    if(Funciones::Existe($lista,"id",$this->id) == false)
                    {
                        $retorno = true;
                    }
                    else
                    {
                        $retorno = "Ya existe un usuario con este id";
                    }
                }
                else
                {
                    $retorno = true;
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
        
       Archivos::guardarUnoSerializado("./materia.txt",$this);
       return true;
    } 

   

    public  static function mostar()
    {   
        $retorno = false;
       
        $lista = Archivos::retornarDatosSerializados("./materia.txt");

        $retorno = $lista;

        return $retorno;

    }
}