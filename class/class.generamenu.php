<?php
/**
 * Clase Menu
 *
 * Clase para generar el menu del sistema
 *
 * @category   Configuracion
 * @package    base de datos
 * @copyright  Copyright (c) 2016 pseba20@gmail.com
 * @version    $Id:$
 */

class Menu extends MySQL
{

    public function __construct()
    {
        parent::__construct();
    }


    /*
     * Funcion que retorna los permisos de un recurso como menu
     *
     * @param int $usuario_id
     * @param int $recurso_id
     * @return object|stdClass
     */



    function display_children($parent, $level)
    {

        $sql = "SET sql_mode = ''";
        $result = $this->query($sql);        

        $sql = "SELECT m.menuID, m.nombre, m.link,Deriv1.parent, Deriv1.Count, m.icon FROM tbl_menu m  
						   LEFT JOIN (SELECT parent, COUNT(*) AS Count FROM tbl_menu GROUP BY parent) 
						   Deriv1 ON m.menuID = Deriv1.parent 
						   where m.parent =".$parent." group by m.menuID order by m.orden";

        $result = $this->query($sql);

        if ($this->num_rows($result) > 0)
        {

            while ($resultados = $this->fetch_array($result))
            {

                    if($resultados['Count'] >0)
                    {
                        echo '<li class="treeview">
                       
                            <a href="'.$resultados['link'].'" ><i class="'.$resultados['icon'].'"></i><span>'.$resultados['nombre'].'</span> 
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">';
                            $menu = new Menu();
                            $menu->display_children($resultados['menuID'], $level + 1);
                        echo '</ul></li>';
                    }
                    else if($resultados['Count'] ==0){
                        echo '<li><a href="'.$resultados['link'].'"><i class="'.$resultados['icon'].'"></i>'.$resultados['nombre'].'</a></li>'; //'<li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li>
                    }
                    else;
            }
        }

    }



}

/*
<li class="active"><a href="#"><i class="fa fa-link"></i> <span>Link</span></a></li>
        <li><a href="#"><i class="fa fa-link"></i> <span>Another Link</span></a></li>
        <li class="treeview">
          <a href="#"><i class="fa fa-link"></i> <span>Multilevel</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#">Link in level 2</a></li>
            <li><a href="#">Link in level 2</a></li>
          </ul>
        </li>
*/        

?>