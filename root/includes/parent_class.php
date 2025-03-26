<?php
class parent_class {


    protected $init_users_data;
    protected $init_users_visits;
    protected $init_randome;

    protected $path_to_photos;
    protected $path_to_base;


    protected $today_visits_list;
    public $today_visits_count;
    public $today_visits_date;

    protected $today_randome_list;
    public $today_randome_count;

    public function __construct(){

    	global $data;
    	$this->init_users_data = $data;

    	global $user_visits;
    	$this->init_users_visits = $user_visits;

    	global $randome;
    	$this->init_randome = $randome;


        global $url_to_photo;
        $this->path_to_photos = $url_to_photo;

        global $url_to_base;
        $this->path_to_base = $url_to_base;



    	$this->today_visits_date = $this->init_users_visits[count($this->init_users_visits)-1]['date'];
    	$this->today_visits_list = $this->init_users_visits[count($this->init_users_visits)-1]['list'];

        if($this->today_visits_list){
        	$this->today_visits_count = count($this->today_visits_list);
        }else{
            $this->today_visits_count = 0;
        }


        for ($v = 0, $i = 0, $j = 0; isset($this->init_randome[$v]); $j += $i, $v++) {
		    if ($this->init_randome[$v][1] == 0) {
		        $this->today_randome_list[$i] = $this->init_randome[$v][0];
		        $i++;
		    }
		}

		if($this->today_randome_list){
			$this->today_randome_count = count($this->today_randome_list);
		}else{
			$this->today_randome_count = 0;
		}


        //auto adding new week in base
        if(floor((time() - strtotime($this->today_visits_date))/(60*60*24)) >6){
            $this->init_users_visits[count($this->init_users_visits)]['date'] = date('d-m-Y');
            $this->init_users_visits[count($this->init_users_visits)-1]['list'] = array();

            unset($this->init_randome);

            $this->init_randome = array();


            file_put_contents($this->path_to_base.'visit.json', json_encode($this->init_users_visits));
            file_put_contents($this->path_to_base.'init_randome.json', json_encode($this->init_randome));

        }


    }
}