<?php

class database_connection {

    public $site_url;
    public $url_to_site;
    public $url_to_sub_base;
    public $url_to_sub_base_for_photo;
    public $url_to_base;
    public $url_to_photo;

    protected $data_users;
    protected $data_visits;
    protected $data_randome;
    protected $projector;






    //test    
    protected $init_users_visits;
    protected $init_randome;

    protected $path_to_photos;
    protected $path_to_base;
    //end test ends

    public function __construct() {
        $this->site_url = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/';

        $this->url_to_site = $this->site_url . "root/";
        $this->url_to_sub_base = $_SERVER['DOCUMENT_ROOT'] . "/database/";
        $this->url_to_sub_base_for_photo = $this->site_url . "database/";

        $this->url_to_base = $this->url_to_sub_base . "tables/";
        $this->url_to_photo = $this->url_to_sub_base_for_photo . "photos/";

        $this->data_users = json_decode(file_get_contents($this->url_to_base . "users.json"), true);
        $this->data_visits = json_decode(file_get_contents($this->url_to_base . "visit.json"), true);
        $this->data_randome = json_decode(file_get_contents($this->url_to_base . "randome.json"), true);
        $this->projector = json_decode(file_get_contents($this->url_to_base . "projecto.json"), true);


        
        if(true){//if is test
            $this->init_users_visits = $this->data_visits;
            $this->init_randome = $this->data_randome;
            $this->path_to_photos = $this->url_to_photo;
            $this->path_to_base = $this->url_to_base;
        }


        
        //to delete last visit
        $numbOfUsers = count($this->data_users);
        if(isset($this->data_users[1]['date'])){

            for ($i = 0; $i < $numbOfUsers; $i++) {
                unset($this->data_users[$i]['date']);
                unset($this->data_users[$i]['visit']);
            }
            $this->data_save_users();
        }

    }

    public function data_save_users(){
        file_put_contents($this->url_to_base.'users.json', json_encode($this->data_users));
    }
    public function data_save_visits(){
        file_put_contents($this->url_to_base.'visit.json', json_encode($this->data_visits));
    }
    public function data_save_randome(){
        file_put_contents($this->url_to_base.'randome.json', json_encode($this->data_randome));
    }
    public function data_save_all(){
        $this->data_save_users();
        $this->data_save_visits();
        $this->data_save_randome();
    }


}
