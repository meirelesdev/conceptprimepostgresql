<?php

// CREATE TABLE public.clients
// (
//     id serial NOT NULL,
//     first_name character varying(35)[] NOT NULL,
//     last_name character varying(35)[] NOT NULL,
//     zipcode character varying(10)[] NOT NULL,
//     logradouro character varying(35)[] NOT NULL,
//     num integer NOT NULL,
//     neighborhood character varying(35)[] NOT NULL,
//     complement character varying(20)[],
//     uf character varying(15)[] NOT NULL,
//     city character varying(35)[] NOT NULL,
//     PRIMARY KEY (id)
// );

// ALTER TABLE public.clients
//     OWNER to postgres;
class Sql {

    private $conn;

    public function __construct(){
        
        try{

            $this->conn =  new PDO("pgsql:host=127.0.0.1;port=5432;dbname=conceptPrime;user=postgres;password=123456");
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
        } catch(PDOException $e){
            return $e.getMessage();

        }
        
    }

    public function listAll(){

        try{
            
            $stmt = $this->conn->query("SELECT * FROM public.clients");            

            if($stmt->rowCount() > 0){
                
                 $data = $stmt->fetchAll();

                return $data;    
            }           
        
        }catch(PDOException $e){
            
            return $e->getMessage();
        }
        
    }

    public function getData($id){
        try{
            $stmt = $this->conn->prepare("SELECT * FROM clients WHERE id = :ID");

            $stmt->execute(array(
                ":ID" => $id
            ));

            
            if($stmt->rowCount() > 0) {
                $data = $stmt->fetch();
               
                return $data;
            }
        }catch(PDOException $e){
            
            return $e->getMessage();
        }
    }

    public function insertData($data){

       
        try{

            $stmt = $this->conn->prepare("INSERT INTO clients ( first_name, last_name, zipcode, city, uf, num, complement, neighborhood, logradouro) VALUES (:FIRST_NAME, :LAST_NAME, :ZIPCODE , :CITY , :UF , :NUM , :COMPLEMENT , :NEIGHBORHOOD,:LOGRADOURO)");
                 
            $stmt->bindParam(":FIRST_NAME", $data['first_name']);
            $stmt->bindParam(":LAST_NAME", $data['last_name']);
            $stmt->bindParam(":ZIPCODE", $data['zipcode']);
            $stmt->bindParam(":CITY", $data['city']);
            $stmt->bindParam(":UF", $data['uf']);
            $stmt->bindParam(":NUM", $data['num']);
            $stmt->bindParam(":COMPLEMENT", $data['complement']);
            $stmt->bindParam(":NEIGHBORHOOD", $data['neighborhood']);
            $stmt->bindParam(":LOGRADOURO", $data['logradouro']);
            
            $stmt = $stmt->execute();
            return true;
        }catch (PDOException $e){
            echo $e->getMessage();
       }
    }

    public function updateData($id, $data){
        
        try {
            $stmt = $this->conn->prepare('UPDATE public.clients SET first_name = :FIRST_NAME, last_name = :LAST_NAME, zipcode = :ZIPCODE, logradouro = :LOGRADOURO, num = :NUM, neighborhood = :NEIGHBORHOOD, uf = :UF, city = :CITY, complement = :COMPLEMENT WHERE id = :ID');
            
            
            $stmt->bindParam(':ID', $data['id']);
            $stmt->bindParam(':FIRST_NAME', $data['first_name']);
            $stmt->bindParam(':LAST_NAME', $data['last_name']);
            $stmt->bindParam(':ZIPCODE', $data['zipcode']);
            $stmt->bindParam(':LOGRADOURO', $data['logradouro']);
            $stmt->bindParam(':NUM', $data['num']);
            $stmt->bindParam(':NEIGHBORHOOD', $data['neighborhood']);
            $stmt->bindParam(':UF', $data['uf']);
            $stmt->bindParam(':CITY', $data['city']);
            $stmt->bindParam(':COMPLEMENT', $data['complement']);
    
            $stmt->execute();
            return true;

        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function deleteData($id){
        try {
            $stmt = $this->conn->prepare('DELETE FROM clients WHERE id = :ID');
            $stmt->bindParam(':ID', $id);
            $stmt->execute();
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }
}
?>
