<?php
namespace App\Controllers;

class MainController extends Controller
{
   public function index()
   {
      include_once ROOT.'/Views/main/index.php';
   } 
}