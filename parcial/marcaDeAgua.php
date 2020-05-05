<?php

class MarcaDeAgua {
    
    public static function marcaAg($path)
    {
        $im = imagecreatefromjpeg($path);
        $marcaAgua = imagecreatefromjpeg('./imagenes/marcaDeAgua.jpg');
        
        $margenAncho = 10;
        $marchenInferior = 10;
        $ax = imagesx($marcaAgua);
        $ay = imagesy($marcaAgua);
        
        imagecopymerge($im,$marcaAgua,imagesx($im) - $ax - $margenAncho , imagesy($im) - $ay - $marchenInferior,0,0,$ax,$ay,30);
      
        imagepng($im,$path);

    }
}

?>