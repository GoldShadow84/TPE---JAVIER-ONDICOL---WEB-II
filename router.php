<?php
require_once './app/controllers/series.controller.php';
require_once './app/controllers/admin.controller.php';

require_once('./libs/smarty/Smarty.class.php');

define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

$action = 'home'; // acción por defecto
if (!empty($_GET['action'])) {
    $action = $_GET['action'];
}

// parsea la accion Ej: dev/juan --> ['dev', juan]
$params = explode('/', $action);

// instancio el unico controller que existe por ahora
$serieController = new SeriesController();
$adminController = new AdminController();

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
    case 'viewTask':
        $serieController->viewTask($params[1]);
        break;    
    case 'login':
        $adminController->login();
        break;
    case 'add':
        $adminController->addNewSerie();
        break;
    case 'update':
        $adminController->updateSerie();     
    case 'deleteSerie':
        $id = $params[1];
        $adminController->deleteSerie($id);
        break;
    case 'deletePlatform':
        $id = $params[1];
        $adminController->deletePlatform($id);
        break;
    default:
        echo('404 Page not found');
        break;
}
