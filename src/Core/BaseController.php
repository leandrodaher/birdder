<?php

namespace Birdder\Core;

use Birdder\Core\Interface\ControllerInterface;

/**
* Esta classe é responsável por instanciar um model e chamar a view correta
* passando os dados que serão usados.
*/
abstract class BaseController implements ControllerInterface
{

  function __construct($model, $view)
  {
        
  }

  public function index()
  {

  }

  private function model($model)
  {

  }

  private function view(string $view, $data = [])
  {

  }

  private function pageNotFound()
  {
    //$this->view('erro404');
  }
}
