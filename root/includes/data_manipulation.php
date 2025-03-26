<?php


class user_data_manipulation extends parent_class{

    public $user_id;
    public $user_name;
    public $user_surname;
    public $user_photo;
    public $user_points;
    public $user_last_visit;
    
    //birthday info
    public $is_set_birthday;
    public $user_age;

    public $is_user_present;
    public $user_date; 
    public $user_birth_d;
    public $user_birth_m;
    public $user_birth_y;

    public function __construct($id){
        parent::__construct();
    	$this->user_id = strval($id);


        if (in_array($this->user_id, (array) $this->today_visits_list)) {
            $this->is_user_present = true;
        } else {
            $this->is_user_present = false;
        }
        
        $this->user_name = $this->init_users_data[$this->user_id]['name'];
        $this->user_surname = $this->init_users_data[$this->user_id]['surname'];
        $this->user_photo = $this->path_to_photos.$this->user_id.".jpg";
        $this->user_points = $this->init_users_data[$this->user_id]['points'];
        $this->user_last_visit = $this->init_users_data[$this->user_id]['date'];

        $this->is_set_birthday = isset($this->init_users_data[$this->user_id]['birth']);
        
        if($this->is_set_birthday){
            $this->user_birth_d = date("d",strtotime($this->init_users_data[$this->user_id]['birth']));
            $this->user_birth_m = date("m",strtotime($this->init_users_data[$this->user_id]['birth']));
            $this->user_birth_y = date("Y",strtotime($this->init_users_data[$this->user_id]['birth']));
            $this->user_date = $this->init_users_data[$this->user_id]['birth'];
            
            
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
            $this->init_users_data[$this->user_id]['points']++;
            $this->init_users_data[$this->user_id]['date'] = date('d-m-Y');
            file_put_contents($this->path_to_base.'users.json', json_encode($this->init_users_data));

            //adding to visit list
            $this->init_users_visits[count($this->init_users_visits)-1] ['list'] [count($this->init_users_visits[count($this->init_users_visits)-1]['list'])] = $this->user_id;
            file_put_contents($this->path_to_base.'visit.json', json_encode($this->init_users_visits));

            //adding to today randome
            $this->init_randome[count($this->init_randome)][0]=$this->user_id;
            $this->init_randome[count($this->init_randome)-1][1]=0;
            file_put_contents($this->path_to_base.'randome.json', json_encode($this->init_randome));
            
        }
    }

    public function today_substract_point(){
        if(in_array($this->user_id,  $this->today_visits_list)){

            $this->user_points--;
            $this->today_visits_count--;
            
            //substracting point from data
            $this->init_users_data[$this->user_id]['points']--;
            $this->init_users_data[$this->user_id]['visit'] = date("d-m-y",strtotime("-1 week"));
            file_put_contents($this->path_to_base.'users.json', json_encode($this->init_users_data));
            
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
}