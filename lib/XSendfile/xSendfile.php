<?php 
namespace XSendfile;

class XSendfile
{

    const SERVER_TYPE_APACHE = "apache";
    const SERVER_TYPE_NGINX = "nginx";

    public static function xSendfile($file, $serverType)
    { 
        header("Content-type: application/octet-stream");
        header('Content-Disposition: attachment; filename="' . basename($file) . '"');
        header("Content-Length: ". filesize($file));
        
        if($serverType){
            switch ($serverType) {
                case self::SERVER_TYPE_APACHE:
                    header("X-Sendfile: $file");
                    break;
                case self::SERVER_TYPE_NGINX:
                    header("X-Accel-Redirect: $file");
                    break;
                    
                default:
                    # code...
                    break;
            }
        }else{
            // unknown server , use php stream
            readfile($file);
        }
    }
}