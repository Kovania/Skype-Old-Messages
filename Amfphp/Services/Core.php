<?php
class Core {

    public function Check() {
        
        if (file_exists("main.db")) {
             return true;
        } else {
             return false;
        }
        
    }
}
?>