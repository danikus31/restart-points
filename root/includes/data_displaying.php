<?php


class data_displaying extends parent_class{

    //general info
    protected $last_visits_of_users = 10;
    protected $bann ;
    public $array_position = 0;

    
    //user info
    public $is_user_present;
    public $is_data;

    public $user_name;
    public $user_surname;
    public $user_id;
    public $user_photo;
    public $user_points;
    public $user_last_visit;
    
    //birthday info
    public $is_set_birthday;
    public $user_age;
    public $user_date; 
    public $user_birth_d;
    public $user_birth_m;
    public $user_birth_y;
    
    
    
    
    public function __construct($args){
        parent::__construct();
        

        //filtre of none exists users
        for($i=0,$x=0,$y=null;$this->init_users_data;$i++){
            if(isset($this->init_users_data[$i])){
                $y[$x]=$this->init_users_data[$i];
                $x++;
            }
            unset($this->init_users_data[$i]);
        }
        $this->init_users_data=$y;


        //filtre by last visit
        if(isset($args['last_visits_of_users'])){
            $x=0;
            for($i=0,$y=null;$this->init_users_data[$i];$i++){

                //фультры на остуствее
                if(!((floor((time() - strtotime($this->init_users_data[$i]['date']))/(60*60*24*7)))>$args['last_visits_of_users'])){
                    $y[$x]=$this->init_users_data[$i];
                    $x++;
                }
            }
            $this->init_users_data = $y;
        }
        //sorting

        /*
        if($args['sort']==true){
            array_multisort(
                array_column($this->init_users_data, "points"),SORT_DESC,
                array_column($this->init_users_data, "name"),
                $this->init_users_data
            );
        }
        */
        if($this->init_users_data[$this->array_position][0] == 'easter_egg'){$this->array_position++;}
        
        $this->is_data = true;
        

        
    }
    
    public function load_user(){
        $this->update_data();
        $this->array_position++;
    }

    public function update_data(){
        if (in_array($this->init_users_data[$this->array_position]['id'] , (array)  $this->init_users_visits[count($this->init_users_visits)-1]['list'])or $this->init_users_data[$this->array_position]['points']=== '∞'){
            $this->is_user_present = true;
        }else{
            $this->is_user_present = false;
        }
        
        $this->user_name = $this->init_users_data[$this->array_position]['name'];
        $this->user_surname = $this->init_users_data[$this->array_position]['surname'];
        $this->user_id = $this->init_users_data[$this->array_position]['id'];
        $this->user_photo = $this->path_to_photos . $this->init_users_data[$this->array_position]['id'].".jpg";
        $this->user_points = $this->init_users_data[$this->array_position]['points'];
        $this->user_last_visit = $this->init_users_data[$this->array_position]['date'];

        $this->is_set_birthday = isset($this->init_users_data[$this->array_position]['birth']);
        
        if($this->is_set_birthday){
            $this->user_birth_d = date("d",strtotime($this->init_users_data[$this->array_position]['birth']));
            $this->user_birth_m = date("m",strtotime($this->init_users_data[$this->array_position]['birth']));
            $this->user_birth_y = date("Y",strtotime($this->init_users_data[$this->array_position]['birth']));
            $this->user_date = $this->init_users_data[$this->array_position]['birth'];
            
            
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
        $this->is_data = isset($this->init_users_data[$this->array_position+1]);
    }
}