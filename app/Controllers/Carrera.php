<?php

namespace App\Controllers;

class Carrera extends BaseController{

  /**
   * Retorna la vista de la Web de Ingeniería de Software
   */
  public function showIngenieria(): string
  {
    //Los métodos en los controladores pueden realizar operaciones complejas
    //una de estas tareas es enviar datos al frontend (vista)
    
    $lista = array("Javascript", "Python", "Java", "PHP", "SQL");

    return view('ingenieria', ["desarrollador" => "Jhon Francia Minaya", "lenguajes" => $lista]);
  }

  /**
   * Retorna la vista de la Web de Diseño Gráfico Digital
   */
  public function showDesign(): string
  {
    $aplicaciones = ["Photoshop", "Premier", "Corel Draw", "Figma", "SoundBox"];
    return view('design', ["aplicaciones" => $aplicaciones]);
  }

}