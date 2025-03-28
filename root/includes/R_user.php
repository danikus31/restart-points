<?php


class R_user extends parent_class{

    public $user_id;
    public $user_name;
    public $user_surname;
    public $user_photo;
    public $user_points;
    public $user_last_visit;
    
    public $is_banned;
    public $is_admin;
    public $is_user_present;
    
    //birthday info
    public $is_set_birthday;
    public $user_age;

    public $user_date; 
    public $user_birth_d;
    public $user_birth_m;
    public $user_birth_y;

    public function __construct(... $args){
        parent::__construct();
        
        if(count($args)===1){
            $this->get_user_by_position($args[0]);
        }
    }

    public function get_user_by_position($request_position){
        $this->user_id = $this->data_users[$request_position]['id'];


        $this->is_user_present = in_array($this->user_id, $this->today_visits_list);

        
        $this->user_name = $this->data_users[$request_position]['name'];
        $this->user_surname = $this->data_users[$request_position]['surname'];
        $this->user_photo = $this->url_to_photo.$this->user_id.".jpg";
        $this->user_points = $this->data_users[$request_position]['points'];
        

        //find last visit
        $this->user_last_visit = 0;
        $weekIndex = count($this->data_visits) - 1;
        while ($weekIndex >= 0) {
            if (in_array($this->user_id, $this->data_visits[$weekIndex]['list'])) {
                break;
            }
            $weekIndex--;
            $this->user_last_visit++;
        }
        $this->is_banned = isset($this->data_users[$request_position]['banned']);

        if(isset($this->data_users[$request_position]['admin'])){
            $this->is_admin = $this->data_users[$request_position]['admin'];
        }else{
            $this->is_admin = false;
        }


        $this->is_set_birthday = isset($this->data_users[$request_position]['birth']);
        
        if($this->is_set_birthday){
            $this->user_birth_d = date("d",strtotime($this->data_users[$request_position]['birth']));
            $this->user_birth_m = date("m",strtotime($this->data_users[$request_position]['birth']));
            $this->user_birth_y = date("Y",strtotime($this->data_users[$request_position]['birth']));
            $this->user_date = $this->data_users[$request_position]['birth'];
            
            
            $this->user_age = date('Y') - date("Y",strtotime($this->user_date));
            if(date('m') < date("m",strtotime($this->user_date))){
                $this->user_age--;
            }else if(date('m') == date("m",strtotime($this->user_date))){
                if(date('d') < date("d",strtotime($this->user_date))){
                    $this->user_age--;
                }
            }
        }else{
            $this->user_birth_d = '';
            $this->user_birth_m = '';
            $this->user_birth_y = '';
        }
    }






    public function today_add_point(){
        if(!in_array($this->user_id,  $this->today_visits_list)){

            $this->user_points++;
            $this->today_visits_count++;
            
            //adding point to data
            $this->data_users[$this->user_id]['points']++;

            //adding to visit list
            $this->data_visits[count($this->data_visits)-1]['list'] [count($this->data_visits[count($this->data_visits)-1]['list'])] = $this->user_id;
           
            //adding to today randome
            $this->data_randome[count($this->data_randome)][0]=$this->user_id;
            $this->data_randome[count($this->data_randome)-1][1]=0;

            //var_dump($this->data_randome);
           
            $this->data_save_all();
        }
    }

    public function today_substract_point(){
        if(in_array($this->user_id,  $this->today_visits_list)){

            $this->user_points--;
            $this->today_visits_count--;
            
            //substracting point from data
            $this->data_users[$this->user_id]['points']--;
            file_put_contents($this->path_to_base.'users.json', json_encode($this->data_users));
            
            //substracting from today visits
            $visits_key = array_search($this->user_id, $this->init_users_visits[count($this->init_users_visits)-1] ['list']);
            array_splice($this->init_users_visits[count($this->init_users_visits)-1] ['list'], $visits_key,1);
            file_put_contents($this->path_to_base.'visit.json', json_encode($this->init_users_visits));


            //substracting from today randome
            $user_key = array_search($this->user_id, haystack: array_column($this->init_randome , 0));
            array_splice($this->init_randome, $user_key,1);
            file_put_contents($this->path_to_base.'randome.json', json_encode($this->init_randome));

        }
    }

    public function update_birthday($date){
        $this->data_users[$this->user_id]['birth']=$date;
        $this->data_save_all();
    }
}