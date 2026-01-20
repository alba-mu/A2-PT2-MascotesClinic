<?php
class ConnectDb {
    
    public function __construct() {  
        
    }
    
    // connexió a la BD
    public function getConnection() {
        $hostname='192.168.143.230'; // servidor de bases de dades (maquina virtual - proven)
        //$hostname='localhost'; // XAMPP local
        $username='user';
        $password='password';
        $dbname='mascotesClinic';

        $conn=NULL;
        
        try {
            $conn=new PDO("mysql:host=$hostname;dbname=$dbname;charset=utf8", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch (PDOException $e) {
            printf("<p>Error code:</p><p>%s</p>", $e->getCode());
            printf("<p>Error message:</p><p>%s</p>", $e->getMessage());
            printf("<p>Stack trace:</p><p>%s</p>", nl2br($e->getTraceAsString()));
        }
        
        return $conn;
    }
    
}
