<?php

class projector{
    public $init_projector;
    
    protected $path_to_base;

	public $count = 20;

	public function __construct(){
        global $url_to_base;
        $this->path_to_base = $url_to_base;

		global $projector;
		$this->init_projector = $projector;


	}

	public function change_stat($arg){
        file_put_contents($this->path_to_base.'projecto.json', $arg);
	}
}