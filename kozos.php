<?php

    function loadUsers($filename){
        $felhasznalok = [];
        
        $file = fopen($filename,"r");

        while(($line = fgets($file)) !== false){
            $felhasznalok[] = unserialize($line);
        }

        fclose($file);

        return $felhasznalok;
    }

    function saveUser($filename, $user){
        $file = fopen($filename, "a");
        
        fwrite($file, serialize($user)."\n");

        fclose($file);
    }

    function hashPassword($password) {
        return password_hash($password, PASSWORD_DEFAULT);
    }

?>