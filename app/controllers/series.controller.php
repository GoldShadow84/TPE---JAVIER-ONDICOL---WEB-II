<?php
require_once './app/models/series.model.php';
require_once './app/views/series.view.php';



class SeriesController {
    private $model;
    private $view;

    public function __construct() {
        $this->model = new SeriesModel();
        $this->view = new SeriesView();
    }

    //ver pagina principal
    public function showHome() {

        $this->view->showHome();
    }

            //ver todas las series
    public function showAllSeries() {
        
        //se traen todas las series junto a la plataforma a la que pertenecen
        $series = $this->model->getAllSeriesWithPlatforms();
        $platforms = $this->model->getAllPlatforms();


        //pasamos plataformas/series para poder elegirlas en el formulario de nuevas series
        $this->view->showAllSeries($series, $platforms);
    }


        //ver todas las plataformas
    public function showAllPlatforms() {
        $platforms = $this->model->getAllPlatforms();

        $this->view->showAllPlatforms($platforms);
    }


        //select para ver las series filtradas por plataforma
    public function searchByPlatform() {
        $platforms = $this->model->getAllPlatforms();

        $this->view->searchByPlatform($platforms);
    }

    //ver series con la plataforma elegida con el select
    public function seriesFiltred() {

        if(isset($_POST['choice']) && !empty($_POST['choice'])) {
            $choice = $_POST['choice'];

            $list = $this->model->getSeriesByPlatforms($choice);
            $this->view->showSeriesByPlatform($list);
        }
    }   


        //ver en detalle una serie particular
    public function viewTask($id) {

        $series = $this->model->getSeriesById($id);
   
       $this->view->viewTask($series);

    }

    //añadir nueva serie

    public function addNewSerie() {

        if(isset($_POST['name']) && !empty($_POST['name'])&&isset($_POST['genre']) && !empty($_POST['genre'])&&isset($_POST['choice']) && !empty($_POST['choice'])) {   
            $name = $_POST['name'];
            $genre = $_POST['genre'];
            $choice = $_POST['choice'];
            
            $this->model->addNewSerie($name, $genre, $choice);

           // header("Location: ver");
           //     header("Location: " . VER);
           header("Location: ". BASE_URL);
            

        }   
        else {
            $this->view->showErrorEmptyForm();
        }
           

    
    }


    //añadir nueva plataforma

    public function addNewPlatform() {

        if(isset($_POST['company']) && !empty($_POST['company'])&&isset($_POST['price'])) {
            $company = $_POST['company'];
            $price = $_POST['price'];

            $this->model->addNewPlatform($company, $price);
 
           // header("Location: ver");
            //header("Location: " . VER);
            header("Location: ". BASE_URL);
            
        }
        else {
            $this->view->showErrorEmptyForm();
        }
    }


    //borrar una serie
    public function deleteSerie($id) {


            $this->model->deleteSerie($id);
             header("Location: ". BASE_URL);

    
    }


    //borrar una plataforma (no debe estar vinculada con ninguna serie)
    public function deletePlatform($id) {

        $this->model->deletePlatform($id);
      //  header("Location: ../ver");
      //  header("Location: " . VER);
      header("Location: ". BASE_URL);


    }


    //ir al formulario para actualizar una serie
    public function updateSerie($id) {

        $series = $this->model->getAllSeries();
        $platforms = $this->model->getAllPlatforms();
        
        $this->view->formUpdateSerie($id, $series, $platforms);
    }



    //realizamos el update sql en la base de datos


    public function confirmUpdateSerie() {

        if(isset($_POST['id']) && !empty($_POST['id'])&&isset($_POST['name']) && !empty($_POST['name'])&&isset($_POST['genre']) && !empty($_POST['genre'])&&isset($_POST['choice']) && !empty($_POST['choice'])) {

            $id = $_POST['id'];
            $name = $_POST['name'];
            $genre = $_POST['genre'];
            $choice = $_POST['choice'];

            $this->model->updateSerie($id, $name, $genre, $choice);

           // header("Location: ../ver");
           // header("Location: " . VER);
           header("Location: ". BASE_URL);

        }
        else {
            $this->view->showErrorEmptyForm();
            
        }   

             
    }


    //ir al formulario para actualizar una  plataforma

    public function updatePlatform($id) {

        $series = $this->model->getAllSeries();
        $platforms = $this->model->getAllPlatforms();
        
        $this->view->formUpdatePlatform($id, $series, $platforms);
    }



    //realizamos el update sql en la base de datos
    public function confirmUpdatePlatform() {

        
        if(isset($_POST['id']) && !empty($_POST['id'])&&isset($_POST['company']) && !empty($_POST['company'])&&isset($_POST['price']) && !empty($_POST['price'])) {

            $id = $_POST['id'];
            $company = $_POST['company'];
            $price = $_POST['price'];

            $this->model->updatePlatform($id, $company, $price);
 
            //header("Location: ../ver");
            //header("Location: " . VER);
            header("Location: ". BASE_URL);
            
    
        }
        else {
            $this->view->showErrorEmptyForm();

        }
    }
 


 


}
