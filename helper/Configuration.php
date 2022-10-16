<?php
include_once("helper/MysqlDatabase.php");
include_once("helper/Render.php");
include_once("helper/UrlHelper.php");

//MODELOS
include_once("model/LoginModel.php");


//CONTROLADORES
include_once("controller/LoginController.php");


include_once('third-party/mustache/src/Mustache/Autoloader.php');
include_once("Router.php");

class Configuration{
    public function getPresentacionModel(){
        $database = $this->getDatabase();
        return new TourModel($database);
    }

    private function getDatabase(){
        $config = $this->getConfig();
        return new MysqlDatabase(
            $config["servername"],
            $config["username"],
            $config["password"],
            $config["dbname"]
        );
    }

    private function getConfig(){
        return parse_ini_file("config/config.ini");
    }

    public function getCancionModel(){
        $database = $this->getDatabase();
        return new SongModel($database);
    }

    public function getRender(){
        return new Render('public/view/partial');
    }

    public function getTourController(){
        $presentacionModel = $this->getPresentacionModel();
        return new TourController($presentacionModel, $this->getRender());
    }

    public function getSongController(){
        $cancionesModel = $this->getCancionModel();
        return new SongController($cancionesModel, $this->getRender());
    }

    public function getLaBandaController(){
        return new LaBandaController($this->getRender());
    }

    public function getQuieroSerParteController(){
        return new QuieroSerParteController($this->getRender());
    }

    public function getRouter(){
        return new Router($this);
    }

    public function getUrlHelper(){//interpreta la ruta
        return new UrlHelper();
    }
}