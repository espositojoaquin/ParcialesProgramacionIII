<?php

class Profesor{
    public $nombre;
    public $legajo; 
    public $imagen;
  


    public function __construct($nombre,$legajo,$imagen)
    {
        $this->nombre = $nombre;
        $this->legajo = $legajo;
        $this->imagen = $imagen;  
    } 

    public function verificacion()
    {   
        $path = "./profesores.txt";
        $retorno = false;
        $resp = Funciones::DatosCompletos($this,1); 

        if($resp == "1"){
    
             
                if(file_exists($path) && filesize($path) > 0)
                {
                    $lista = Archivos::retornarDatosSerializados($path);

                    if(Funciones::Existe($lista,"legajo",$this->legajo) == false)
                    {
                        $retorno = true;
                    }
                    else
                    {
                        $retorno = "Ya existe un profesor con este legajo";
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

    public function guardar()
    {  
       Archivos::GuardarImagen("imagen","./imagenes/",$this->legajo,$this,"imagen");
       Archivos::guardarUnoSerializado("./profesores.txt",$this);
       return true;
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

    public  static function mostar()
    {   
        $retorno = false;
       
        $lista = Archivos::retornarDatosSerializados("./profesores.txt");

        $retorno = $lista;

        return $retorno;

    }
}