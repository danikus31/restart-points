<?php 

class randome extends parent_class{

	public $randome_teams;

	public $user_id;
	public $user_name;
	public $user_surname;
	public $user_photo;
    public $user_points;

	public function __construct(){
        parent::__construct();

        $this->today_visits_list = $this->init_users_visits[count($this->init_users_visits)-1]['list'];


		//create array with only active peoples
		$j = 0; // Initialize $j

		for ($v = 0, $i = 0; isset($this->init_randome[$v]); $j += $i, $v++) {

		    if ($this->init_randome[$v][1] == 0) {
		        $this->today_randome_list[$i] = $this->init_randome[$v][0];
		        $i++;
		    }
		}
	}

	public function get_today_tracking_randome_one(){



		shuffle($this->today_randome_list);
		shuffle($this->today_randome_list);
		shuffle($this->today_randome_list);
		
		$randome_user_position_in_array = random_int(0, count($this->today_randome_list)-1);
		$this->user_id = $this->today_randome_list[$randome_user_position_in_array];


		//get user info
		$this->user_name = $this->init_users_data[$this->user_id]['name'];
		$this->user_surname = $this->init_users_data[$this->user_id]['surname'];
        $this->user_points = $this->init_users_data[$this->user_id]['points'];
        $this->user_photo = $this->path_to_photos . $this->user_id.".jpg";


		//changing to 1 selectet person
		foreach ($this->init_randome as $key2 => $value) {
		    if ($value[0] == $this->user_id) {
		        $this->init_randome[$key2][1] = 1;
		    }
		}
		$this->today_randome_count--;
        // encode array to json and save to file
        file_put_contents($this->path_to_base.'randome.json', json_encode($this->init_randome));

	}

	public function reset_today_randome(){
		$this->init_randome= array();


		for ($i = 0; isset($this->today_visits_list[$i]); $i++) {
		    $this->init_randome[$i][0] = $this->today_visits_list[$i];
		    $this->init_randome[$i][1] = 0;
		}
		file_put_contents($this->path_to_base.'randome.json', json_encode($this->init_randome));

		$this->today_randome_count = count($this->init_randome);
	}

	public function randome_team_shuffle($num){

		shuffle($this->today_visits_list);


		foreach($this->today_visits_list as $key => $value){
			$this->randome_teams[$key]['img'] = $this->path_to_photos.$value.'.jpg';
			$this->randome_teams[$key]['user_name'] = $this->init_users_data[$value]['name'];
		}


		//team shuffle
		function partition(Array $list, $p) {
		    $listlen = count($list);
		    $partlen = floor($listlen / $p);
		    $partrem = $listlen % $p;
		    $partition = array();
		    $mark = 0;
		    for($px = 0; $px < $p; $px ++) {
		        $incr = ($px < $partrem) ? $partlen + 1 : $partlen;
		        $partition[$px] = array_slice($list, $mark, $incr);
		        $mark += $incr;
		    }
		    return $partition;
		}

		print_r(json_encode(partition($this->randome_teams,$num)));
	}
}