<?php

namespace Birdder\Core;

use Birdder\Core\Interface\ControllerInterface;

/**
* Esta classe é responsável por instanciar um model e chamar a view correta
* passando os dados que serão usados.
*/
abstract class BaseController implements ControllerInterface
{

  function __construct($model)
  {
        
  }

  function model($model)
  {

  }

  public function view(string $view, $data = [])
  {

  }

  public function pageNotFound()
  {
    //$this->view('erro404');
  }
}
