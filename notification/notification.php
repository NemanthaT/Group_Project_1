<?php

    class Notification {
        public $sender_id;
        public $sender_type;
        public $receiver_id;
        public $receiver_type;
        public $description;
        public $status;
    
        public function __construct($sender_id, $sender_type, $receiver_id, $receiver_type, $description, $status) {
            $this->sender_id = $sender_id;
            $this->sender_type = $sender_type;
            $this->receiver_id = $receiver_id;
            $this->receiver_type = $receiver_type;
            $this->description = $description;
            $this->status = $status;
        }
        public function changeStatus($new_status) {
            $this->status = $new_status;
        }
    }

?>