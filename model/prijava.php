<?php
class Prijava{
    public $id;   
    public $naziv;   
    public $datum;   
    public $mesto;   
    public $organizator;
    
    public function __construct($id=null, $naziv=null, $datum=null, $mesto=null, $organizator=null)
    {
        $this->id = $id;
        $this->naziv = $naziv;
        $this->datum = $datum;
        $this->mesto = $mesto;
        $this->organizator = $organizator;
    }


    public static function getAll(mysqli $conn)
    {
        $query = "SELECT * FROM prijave";
        return $conn->query($query);
    }



    public static function getById($id, mysqli $conn){
        $query = "SELECT * FROM prijave WHERE id=$id";

        $myObj = array();
        $rezultat= $conn->query($query)
        if($rezultat){
            while($red = $rezultat->fetch_array(1)){
                $myObj[]= $red;
            }
        }

        return $myObj;

    }

  

    public function deleteById(mysqli $conn)
    {
        $query = "DELETE FROM prijave WHERE id=$this->id";
        return $conn->query($query);
    }


    public function update($id, mysqli $conn)
    {
        $query = "UPDATE prijave set naziv = $this->naziv,datum = $this->datum,mesto = $this->mesto,organizator = $this->organizator WHERE id=$id";
        return $conn->query($query);
    }


    public static function add(Prijava $prijava, mysqli $conn)
    {
        $query = "INSERT INTO prijave(naziv, datum, mesto, organizator) VALUES('$prijava->naziv','$prijava->datum','$prijava->mesto','$prijava->organizator')";
        return $conn->query($query);
    }
}

?>