<?php
namespace App\Controllers;

class AnnoncesController extends Controller
{
    public function index(){
        include_once ROOT.'/Views/annonces/index.php';
    }
}