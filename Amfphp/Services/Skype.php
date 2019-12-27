<?php

class Skype {

    public $db;
    public $skypename;
    
    public function __construct() {
        
        $this->db = new PDO('sqlite:main.db');
        $this->db->query('SET NAMES utf8');
        $this->db->query('SET CHARACTER_SET utf8_unicode_ci');
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $quu = $this->db->query("SELECT * FROM Accounts");
        $data = $quu->fetchAll();
        
        $this->skypename = $data[0]['skypename'];
        
    }

    public function GetConversations() {
        
        
        $quu = $this->db->query("SELECT * FROM Conversations ORDER BY last_activity_timestamp DESC");
        $data = $quu->fetchAll();

        $html = "";
        
        foreach($data as $data) {
            
            $qu = $this->db->query("SELECT * FROM Messages WHERE convo_id = ".$data['id']." AND body_xml IS NOT NULL");
            $qu->fetchColumn();
            
            if($qu->fetchColumn() > 0 ) {
     
                $html .= '<li class="clearfix" id="'.$data['id'].'" onclick="loadchat(\''.$data['id'].'\');">';
                $html .= '<div class="about">';
                $html .= '<div class="name">'.$data['displayname'].'</div>';
                $html .= '<div class="status">';
                $html .= $data['identity'];
                $html .= '</div>';
                $html .= '</div>';
                $html .= '</li>';
        
            }
        
        }
        
        return $html;
        
    }
    
    public function GetChat($id) {
        
        $html = "";
        
        $qu = $this->db->query("SELECT count(*) FROM Messages WHERE convo_id = '$id'");
        $html .= '<input type="hidden" class="nb_message" name="nb_message" value="'.$qu->fetchColumn().'">';
        
        $qu1 = $this->db->query("SELECT count(*) FROM Calls WHERE conv_dbid = '$id'");
        $qu2 = $this->db->query("SELECT count(*) FROM Videos WHERE convo_id = '$id'");
        $html .= '<input type="hidden" class="nb_appel" value="'.($qu1->fetchColumn() + $qu2->fetchColumn()).'">';
        
        
        
        $quu = $this->db->query("SELECT * FROM Messages WHERE convo_id = $id AND body_xml IS NOT NULL ORDER BY timestamp ASC");
        $data = $quu->fetchAll();
        
        
        foreach($data as $data) {
            
            if($data['author'] == $this->skypename) {
                $alignright = " align-right";
                $floatright = " float-right";
                $type = " other-message";
            } else {
                $alignright = "";
                $floatright = "";
                $type = " my-message";
            }

            $html .= '<li class="clearfix">';
            $html .= '<div class="message-data'.$alignright.'">';
            $html .= '<span class="message-data-time">'.date('d/m/Y H:m:s', $data['timestamp']).'</span> &nbsp; &nbsp;';
            $html .= '<span class="message-data-name">'.$data['author'].'</span>';
            $html .= '</div>';
            $html .= '<div class="message'.$type.''.$floatright.'">';
            $html .= str_replace('<a hr','<a target="_blank" hr', $data['body_xml']);
            $html .= '</div>';
            $html .= '</li>';
        
        }
        
        return $html;
        
    }
 
}
?>