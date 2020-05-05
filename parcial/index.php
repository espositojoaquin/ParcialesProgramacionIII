<?php
require_once __DIR__ .'/vendor/autoload.php';
require "./archivos.php";
require "./usuario.php";
require "./materia.php";
require "./profesor.php";
require "./asignacion.php";
require "./marcaDeAgua.php";
require "./funciones.php";
require "./jwt.php";
require "./response.php";


$caso = $_SERVER['PATH_INFO'];
switch($caso){
  
    case '/usuario':
      $usuario = new Usuario($_POST['email'] ?? "0",$_POST['clave']??"0");
      $resp = $usuario->verificacion();
         if($resp === true) 
         {
          
           try
            {  
              $re = $usuario->guardar();
              if($re)
              {  
                echo json_encode(Response::Respuesta("Success","Guardado con Exito"));
              }
              else
              { 
                $respuesta->data = $re;
                echo json_encode(Response::Respuesta("Success",$re));
              }
             
            }catch(Exception $e)
            {   
              echo json_encode(Response::Respuesta("ERROR",$e->getMessage()));
               
            } 
  
         }
         else
         {         
          echo json_encode(Response::Respuesta("ERROR",$resp));
         }

    
    break;

    case '/login':
     if($_POST['email'] ?? "0" != "0" && $_POST['clave'] ?? "0" != "0")
     {  
         try
         { 

           $resp = Usuario::login($_POST['email'] ?? "0",'email',$_POST['clave'] ?? "0",'clave',"./users.txt");
           if($resp!=false)
           { 

            echo json_encode(Response::Respuesta("Success",$resp));
           }
           else
           {  

            echo json_encode(Response::Respuesta("ERROR","Se produjo un error al generar el token"));

           }
             
          
         }catch(Exception $e)
         {   
          echo json_encode(Response::Respuesta("ERROR",$e->getMessage()));
            
         }
     }
     else
     {   
     
       echo json_encode(Response::Respuesta("ERROR","Faltan datos"));
         
     }
        

    break;

    case '/materia': 
      if(Archivos::existePeticionPOST())
      {
        $id = Funciones::generateID("./materia.txt");
        $materia = new Materia($_POST['nombre'] ?? "0",$_POST['cuatrimestre']?? "0",$id);
         $resp = $materia->verificacion();
            if($resp === true) 
            {
              if(Materia::validacionToken())
              {
                try
                 {  
                   $re = $materia->guardar();
                   if($re)
                   {  
                     echo json_encode(Response::Respuesta("Success","Guardado con Exito"));
                   }
                   else
                   { 
                     $respuesta->data = $re;
                     echo json_encode(Response::Respuesta("Success",$re));
                   }
                  
                 }catch(Exception $e)
                 {   
                   echo json_encode(Response::Respuesta("ERROR",$e->getMessage()));
                    
                 } 
   
              }
              else
              {
               echo json_encode(Response::Respuesta(false,"Token invalido"));
              }
              
     
            }
            else
            {         
             echo json_encode(Response::Respuesta("ERROR",$resp));
            }

      }
      if(Archivos::existePeticionGET())
      { 
        $resp = Materia::validacionToken();
        if($resp === true) 
        {
             $re = Materia::mostar();
             if($re!=false)
             {
              echo json_encode(Response::Respuesta("Success",$re));
             }

        }
        else
        {         
         echo json_encode(Response::Respuesta("ERROR","Token invalido"));
        }

         
      }
     
    

    break;
    case '/profesor':
      if(Archivos::existePeticionPOST())
      {
        $Profesor = new Profesor($_POST['nombre'] ?? "0",$_POST['legajo']?? "0",$_FILES['imagen']??"0");
        $resp = $Profesor->verificacion();
           if($resp === true) 
           {
             if(Profesor::validacionToken())
             {
               try
                {  
                  $re = $Profesor->guardar();
                  if($re)
                  {  
                    echo json_encode(Response::Respuesta("Success","Guardado con Exito"));
                  }
                  else
                  { 
                    $respuesta->data = $re;
                    echo json_encode(Response::Respuesta("Success",$re));
                  }
                 
                }catch(Exception $e)
                {   
                  echo json_encode(Response::Respuesta("ERROR",$e->getMessage()));
                   
                } 
  
             }
             else
             {
              echo json_encode(Response::Respuesta(false,"Token invalido"));
             }
             
    
           }
           else
           {         
            echo json_encode(Response::Respuesta("ERROR",$resp));
           }

      } 
      if(Archivos::existePeticionGET())
      {   
        $resp = Profesor::validacionToken();
        if($resp === true) 
        {
             $re = Profesor::mostar();
             if($re!=false)
             {
              echo json_encode(Response::Respuesta("Success",$re));
             }

        }
        else
        {         
         echo json_encode(Response::Respuesta("ERROR","Token invalido"));
        }

      }
    
       
    break;
    case '/asignacion':
      if(Archivos::existePeticionPOST())
      {
        $asignacion = new Asignacion($_POST['legajo'] ?? "0",$_POST['id']?? "0",$_POST['turno']?? "0");
        $resp = $asignacion->verificacion($_POST['turno']?? "0",$_POST['id']?? "0",$_POST['legajo'] ?? "0");
           if($resp === true) 
           {
             if(Materia::validacionToken())
             {
               try
                {  
                  $re = $asignacion->guardar();
                  if($re)
                  {  
                    echo json_encode(Response::Respuesta("Success","Guardado con Exito"));
                  }
                  else
                  { 
                    $respuesta->data = $re;
                    echo json_encode(Response::Respuesta("Success",$re));
                  }
                 
                }catch(Exception $e)
                {   
                  echo json_encode(Response::Respuesta("ERROR",$e->getMessage()));
                   
                } 
  
             }
             else
             {
              echo json_encode(Response::Respuesta(false,"Token invalido"));
             }
             
    
           }
           else
           {         
            echo json_encode(Response::Respuesta("ERROR",$resp));
           }

      } 
      if(Archivos::existePeticionGET())
      {   
        $resp = Asignacion::validacionToken();
        if($resp === true) 
        {
             $re = Asignacion::mostar();
             if($re!=false)
             {
              echo json_encode(Response::Respuesta("Success",$re));
             }

        }
        else
        {         
         echo json_encode(Response::Respuesta("ERROR","Token invalido"));
        }

      }

      break;
    
    default:
   echo json_encode( Response::Respuesta(true,"Cargar un caso valido"));
    
}

?>


