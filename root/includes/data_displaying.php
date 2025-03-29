<?php


class data_displaying extends R_user{

    //general info
    protected $last_visits_of_users = 10;
    public $array_position = 0;
    public $is_data;

    
    
    
    public function __construct($args){
        parent::__construct();

        
        // Set the number of last visits to be displayed
        if (isset($args["max_last_visits_of_users"])) {
            for ($i = count($this->data_users) - 1; $i >= 1; $i--) { 
                $this->get_user_by_position($i);
                if(isset($args["max_last_visits_of_users"])) {
                    $skip_by_admin = $this->is_admin;
                }else{
                    $skip_by_admin = false;
                }
                if ($this->user_last_visit > $args["max_last_visits_of_users"]|| $skip_by_admin) {
                    array_splice($this->data_users, $i, 1);
                }
            }
        }
        
        if (isset($args["have_birthday"])) {
            for ($i = count($this->data_users) - 1; $i >= 1; $i--) { 
                $this->get_user_by_position($i);
        
                if ($this->user_last_visit > $args["have_birthday"]) {
                    array_splice($this->data_users, $i, 1);
                }
            }
        }


        // Sort the array by 'points' in descending order
        if(isset($args["sort"])){
            if($args["sort"]){
                usort($this->data_users, function($x, $y) {
                    // Check if 'points' key exists in both arrays because exisit easter egg
                    if (!isset($x['points']) || !isset($y['points'])) {
                        return 0; // or you can handle it differently if the 'points' key is missing
                    }
                    return $y['points'] <=> $x['points'];
                });
            }
        }
        
        $this->is_data = isset($this->data_users[$this->array_position+1]);
        
    }
    
    public function load_user(){

        $this->get_user_by_position(++$this->array_position);
        $this->is_data = isset($this->data_users[$this->array_position+1]);
    }

    public function update_data(){

    }
}