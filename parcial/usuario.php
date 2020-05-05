<?php

class Usuario{
    public $email;
    public $clave;
  


    public function __construct($email,$clave)
    {
        $this->email = $email;
        $this->clave = $clave;
       
        
    } 

    public function verificacion()
    {   
        $path = "./users.txt";
        $retorno = false;
        $resp = Funciones::DatosCompletos($this,1); 

        if($resp == "1"){
    
             
                if(file_exists($path) && filesize($path) > 0)
                {
                    $lista = Archivos::retornarDatosSerializados($path);

                    if(Funciones::Existe($lista,"email",$this->email) == false)
                    {
                        $retorno = true;
                    }
                    else
                    {
                        $retorno = "Ya existe un usuario con este email";
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
        
       Archivos::guardarUnoSerializado("./users.txt",$this);
       return true;
    } 

    public static function login($dato,$nombreDato,$dato2,$nombreDato2,$path){
        $retorno = false;
        $lista = Archivos::retornarDatosSerializados($path);
        $objeto = Funciones::FilterDos($lista,$nombreDato,$dato,$nombreDato2,$dato2);
        if($objeto != false)
        { 
             $retorno = JsonWebToken::obtenerJWT($objeto);
            
        }
         return $retorno;
        
    }

    public  static function mostar()
    {   
        $retorno = false;
       
        $objeto = JsonWebToken::ValidarToken();
        if($objeto != false)
        { 
              
           $retorno = $objeto->data;

            
        }

      return $retorno;


    }
}