<?php
class parent_class extends database_connection{


    protected $today_visits_list;
    public $today_visits_count;
    public $today_visits_date;

    protected $today_randome_list;
    public $today_randome_count;

    public function __construct(){
        parent::__construct(); 

        //today visit date
        if (!empty($this->data_visits)) {
            $this->today_visits_date = $this->data_visits[count($this->data_visits) - 1]['date'];
        } else {
            $this->today_visits_date = null; // if is empty
        }

        //today visit list
        $this->today_visits_list = $this->data_visits[count($this->data_visits)-1]['list'];

        //today visit count
        if($this->today_visits_list){
        	$this->today_visits_count = count($this->today_visits_list);
        }else{
            $this->today_visits_count = 0;
        }


        //set randome list
        for ($v = 0, $i = 0, $j = 0; isset($this->data_randome[$v]); $j += $i, $v++) {
		    if ($this->data_randome[$v][1] == 0) {
		        $this->today_randome_list[$i] = $this->data_randome[$v][0];
		        $i++;
		    }
		}


        //set randome count
		if($this->today_randome_list){
			$this->today_randome_count = count($this->today_randome_list);
		}else{
			$this->today_randome_count = 0;
		}


        //auto adding new week in base
        if(floor((time() - strtotime($this->today_visits_date))/(60*60*24)) >6){
            $this->data_visits[count($this->data_visits)]['date'] = date('d-m-Y');
            $this->data_visits[count($this->data_visits)-1]['list'] = array();

            unset($this->data_randome);

            $this->data_randome = array();
            
            $this->data_save_all();

        }


    }
}