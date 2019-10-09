<?php

include("conf.php");

class Poke{

    public $logged_in = false;

    public function __construct(){
        session_start();
        //Require necessary classes
        if(!@include("db.php")) die("Couldn't require Database Class.");
        if(!@include("conf.php")) die("Couldn't require configuration file.");

        //Attempt a connection to the database
        $this->db = new DB($db_host,$db_user,$db_pass,$db_name);
        if (!($this->db->connect())) {
            session_destroy();
            die("Database connection could not be established");
        }

        //Check for existing session
        $auth = $this->Authenticate();
        $url = $_SERVER['REQUEST_URI'];
        if($auth){
            if (strpos($url,'login.php') || strpos($url,'register.php')) header("Location:/");
        }else{
            if (strpos($url,'fave.php')) header("Location:/login.php");
        }
    }

    public function Authenticate(){
        if(isset($_SESSION['Username'])){
            $user = $_SESSION['Username'];
            $pass = $_SESSION['Password'];
            
            $result = $this->db->Login($user);
            if($result['success']){
                $dbpass = $result["results"][0]['Password'];
                if($pass = $dbpass) {
                    $this->logged_in = true;
                    $this->id = $result["results"][0]['ID'];
                    return true;
                }
            }
        }
        return false;
    }

    public function Login($user,$pass){

        if(!$user || !$pass){
            $r['success'] = false;
            $r['error'] = "Please fill in all fields.";
            return $r;
        }
        
        if(!ctype_alnum(str_replace(".", "", $user))){
            $r['success'] = false;
            $r['error'] = "Username may only contain letters, numbers and dots.";
            return $r;
        }

        if(!ctype_alnum($pass)){
            $r['success'] = false;
            $r['error'] = "Password may only contain letters and numbers.";
            return $r;
        }

        $return = array();
        $result = $this->db->Login($user);
        if($result['success'] && count($result['results']) > 0){
            $dbpassword = $result["results"][0]['Password'];
            $dbsalt = $result["results"][0]['Salt'];

            $hpass = $this->hashPass($pass,$dbsalt);

            if($dbpassword == $hpass){
                $return["success"] = true;

                $id = $result["results"][0]['id'];
                
                $_SESSION['Username'] = $user;
                $_SESSION['Password'] = $dbpassword;
                $_SESSION['id'] = $id;

                header("Location:/");
            } else {
                $return["success"] = false;
                $return["error"] = "Invalid login. Please verify your Username and Password";
            }

        } else {
            $return["success"] = false;
            $return["error"] = "Invalid login. Please verify your Username and Password";
        }
        return $return;
    }

    public function Register($user,$pass,$tname){

        if(!$user || !$pass){
            $r['success'] = false;
            $r['error'] = "Please fill in all fields.";
            return $r;
        }
        
        if(!ctype_alnum(str_replace(".", "", $user))){
            $r['success'] = false;
            $r['error'] = "Username may only contain letters, numbers and dots.";
            return $r;
        }

        if(!ctype_alnum($pass)){
            $r['success'] = false;
            $r['error'] = "Password may only contain letters and numbers.";
            return $r;
        }

        $s = $this->getUserDetails($user);
        if($s['success'] && count($s['results']) != 0){
            $r['success'] = false;
            $r['error'] = "Username already exists.";
            return $r;
        }

        $salt = $this->generateSalt();
        $hpass = $this->hashPass($pass,$salt);

        $u = $this->db->addUser($user,$hpass,$salt,$tname);

        $r['success'] = true;

        return $r;
    }

    private function generateSalt()
    {
        $bytes = mcrypt_create_iv(8, MCRYPT_DEV_URANDOM);
        $salt = bin2hex($bytes);
        return $salt;
    }

    private function hashPass($password, $salt)
    {
        $p_md5 = md5($password);
        $s_sha1 = sha1($salt);
        $pns = $p_md5 . $s_sha1;
        $hashed = md5($pns);
        return $hashed;
    }

    public function getUserDetails($user){
        if(!ctype_alnum(str_replace(".", "", $user))){
            $r['success'] = false;
            $r['error'] = "Username may only contain letters, numbers and dots.";
            return $r;
        }

        $s = $this->db->getUserDetails($user);
        return $s;
    }

    public function toggleFave($id,$name,$height,$weight){
        if(!$this->logged_in){
            $r['success'] = false;
            $r['error'] = "You must be logged in to save a Pokemon.";
            return $r;
        }

        if(!ctype_digit($id)){
            $r['success'] = false;
            $r['error'] = "Pokemon ID must be numeric.";
            return $r;
        }

        if(!ctype_alpha($name)){
            $r['success'] = false;
            $r['error'] = "Pokemon Name must be numeric.";
            return $r;
        }

        if(!ctype_digit($height)){
            $r['success'] = false;
            $r['error'] = "Pokemon ID must be numeric.";
            return $r;
        }

        if(!ctype_digit($weight)){
            $r['success'] = false;
            $r['error'] = "Pokemon ID must be numeric.";
            return $r;
        }

        $r = $this->db->getFave($this->id,$id);
        $count = count($r['results']);

        if($count == 0){
            $this->db->setFave($this->id,$id,$name,$height,$weight);
            $saved = true;
        }else{
            $this->db->remFave($this->id,$id);
            $saved = false;
        }

        $result['success'] = true;
        $result['saved'] = $saved;

        return $result;
    }

    public function getFaves(){
        return $this->db->getFaves($this->id);
    }


}

?>