<?php

    class Db{
        private $cnx;

        public function __construct()
        {
            $this->cnx =  new PDO("mysql:host=localhost;port=3306;dbname=tawjih","root","");
        }

        public function selectDb($req){
            $res = $this->cnx->query($req);
            return $res;
        }

        public function updateDb($req){
            $res = $this->cnx->exec($req);
            return $res;
        }

        public function prepare($req){
            $stmt = $this->cnx->prepare($req);
            return $stmt;
        }

        public function execute($stmt, $params){
            $stmt->execute($params);
            return $stmt->rowCount();
        }

        public function executeQuery($req, $params = null){
            if ($params) {
                $stmt = $this->cnx->prepare($req);
                $stmt->execute($params);
                return true;
            } else {
                $res = $this->cnx->query($req);
                return $res;
            }
        }

        public function selectProcedure($nomp){
            $res = $this->cnx->query("CALL $nomp");
            return $res;
        }

        public function updateProcedure($nomp){
            $res = $this->cnx->exec("CALL $nomp");
            return $res;
        }

        public function test_input($data){
            $data= trim($data);
            $data = stripcslashes($data);
            $data = htmlspecialchars($data);
            return $data;
    }

    }

?>