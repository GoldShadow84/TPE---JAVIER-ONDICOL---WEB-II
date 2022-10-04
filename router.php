<?php
require_once './app/controllers/series.controller.php';
require_once './app/controllers/login.controller.php';

require_once('./libs/smarty/Smarty.class.php');

define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

define('LOGIN', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/login');



$action = 'home'; // acción por defecto




if(!empty($_GET['action'])) {
    $action = $_GET['action'];
}




// parsea la accion Ej: dev/juan --> ['dev', juan]
$params = explode('/', $action);




// instancio ambos controladores
$serieController = new SeriesController();
$loginController = new LoginController();




// tabla de ruteo

switch ($params[0]) {
   
    case 'home':
        $serieController->showHome();
        break;
    case 'series':
        $serieController->showAllSeries();
        break;
    case 'platforms':
        $serieController->showAllPlatforms();
        break;   
    case 'search':
        $serieController->searchByPlatform();
        break;       
    case 'filter':
        $serieController->seriesFiltred();
        break;
    case 'viewSerie':
        $serieController->viewSerie($params[1]);
        break;    

        //Casos para Usuarios Logueados
    case 'login':
        $loginController->showLogin();
        break;
    case 'verify':
        $loginController->verifyLogin();
        break;
    case 'logout':
        $loginController->logout();      
    case 'addSerie':
        $serieController->addNewSerie();
        break;
    case 'addPlatform':
        $serieController->addNewPlatform();
        break;      
    case 'updateSerie':
        $id = $params[1];
       $serieController->updateSerie($id);   
        break;
    case 'confirmUpdSerie':
       $serieController->confirmUpdateSerie();  
        break;
    case 'updatePlatform':
        $id = $params[1];
    $serieController->updatePlatform($id);   
        break;
    case 'confirmUpdPlatform':
    $serieController->confirmUpdatePlatform();  
        break;
    case 'deleteSerie':
        $id = $params[1];
        $serieController->deleteSerie($id);
        break;
    case 'deletePlatform':
        $id = $params[1];
        $serieController->deletePlatform($id);
        break;  
    default:
        echo('404 Page not found');
        break;
}
