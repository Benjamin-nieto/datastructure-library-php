<?php
include("multilistas.php");
//include("nodoEditorial.php");
include("nodoLibro.php");

session_start();

if (isset($_SESSION["multi"]) == false) {
    ##echo "no existia y se creo";
    $_SESSION["multi"] = new Multilista();
}
function phpAlert($msg)
{
    echo '<script type="text/javascript">alert("' . $msg . '")</script>';
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.indigo-pink.min.css">
    <script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>

    <link rel="stylesheet" href="./css/general.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">

    <link rel="shortcut icon" type="image/jpg" href="https://www.cuc.edu.co/templates/it_university3/favicon.ico" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>Biblioteca C.U.C</title>
</head>

<body style="background: rgb(70 38 23 / 100%);">
    <div class="gradient-background-color" style="min-height: 900px;">
        <div class="mdl-grid ">
            <div class="mdl-cell mdl-cell--8-col" style="display: flex !important;">
                <div>
                    <h1>Biblioteca C.U.C</h1>
                </div> <img src="./img/logo.png" style="width:23%;">
            </div>
            <div class="mdl-cell mdl-cell--2-col">

            <h5>Integrantes</h5>
            <p>- Benjamin E. Nieto Garcia.</p>
            <p>- Juan Jimenez Yancy.</p>
            </div>
            <div class="mdl-cell mdl-cell--2-col div-reverse-direction">
                <!-- Right aligned menu below button -->
                <button id="demo-menu-lower-right" class="reformat-option-button mdl-button mdl-js-button mdl-button--icon">
                <p style="padding-left: 10%;">Opciones</p>
                    <i class="material-icons" style="padding-left:34%;">more_vert</i>
                </button>

                <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect" for="demo-menu-lower-right">
                    <li class="mdl-menu__item" onclick="location.href='index.php?action=searchE';"><a href="index.php?action=searchE">Buscar Editorial</a></li>
                    <li class="mdl-menu__item" onclick="location.href='index.php?action=searchL';"><a href="index.php?action=searchL">Buscar Libro</a></li>
                    <li class="mdl-menu__item" onclick="location.href='index.php?action=deleteE';"><a href="index.php?action=deleteE">Eliminar Editorial</a></li>
                    <li class="mdl-menu__item mdl-menu__item--full-bleed-divider" onclick="location.href='index.php?action=deleteL';"><a href="index.php?action=deleteL">Eliminar Libro</a></li>
                    <li class="mdl-menu__item" onclick="location.href='index.php?action=contXAnho';"><a href="index.php?action=contXAnho">Contardor de libros por año especifico</a></li>
                    <li class="mdl-menu__item" onclick="location.href='index.php?action=contXEdit';"><a href="index.php?action=contXEdit">Contardor de libros por editorial especifica</a></li>

                </ul>
                <?php
                $action = null;
                if ($_GET["action"] == "searchE") {
                    echo '<div class="spam-search">
     <div class="mdl-grid">
            <div class="mdl-cell mdl-cell--3-col"></div>
            <div class="mdl-cell mdl-cell--6-col" style="background-color:white;">
                <div class="mdl-grid" style="padding-right: 20px;padding-left: 20px;padding-top: 12px;" >
                    <div style="display:flex;width:100%;"><p>Buscar Editorial</p>
                    <form method="post" style="margin-left: 70%;">
                        <button  name="exit" class="mdl-button mdl-js-button " formaction="/index.php">
                            <i class="material-icons">close</i>
                        </button>
                    </form>
                    </div>
                </div>

        

                <div class="mdl-grid">
                    <form method="post">

                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                <input class="mdl-textfield__input" type="number" id="txtSearch" name="txtSearch">
                                <label class="mdl-textfield__label" for="txtSearch">Id Editorial</label>
                                </div>
                                <input type="submit" value="Buscar" name="btn-seach1" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">

                
                    </form>                    
                </div>
                <div class="mdl-grid">';

                    if (isset($_POST["btn-seach1"])) {

                        $nse = $_POST["txtSearch"];

                        if ($nse != null && $nse != "") {
                            $nodoSeach = $_SESSION["multi"]->buscarEditorial($nse);
                            echo "Id Editorial: " . $nodoSeach->getIdEditorial() . " Denominacion: " . $nodoSeach->getDenominacion();
                        } else {
                            phpAlert("Digite editorial a buscar");
                        }
                    }
                    echo '
                
                </div>

            </div>
            <div class="mdl-cell mdl-cell--3-col"></div>
     
     </div>';
                } elseif ($_GET["action"] == "searchL") {


                    echo '<div class="spam-search">
                    <div class="mdl-grid">
                           <div class="mdl-cell mdl-cell--3-col"></div>
                           <div class="mdl-cell mdl-cell--6-col" style="background-color:white;">
                               <div class="mdl-grid" style="padding-right: 20px;padding-left: 20px;padding-top: 12px;" >
                                   <div style="display:flex;width:100%;"><p>Buscar Libro</p>
                                   <form method="post" style="margin-left: 70%;">
                                       <button  name="exit" class="mdl-button mdl-js-button " formaction="/index.php">
                                           <i class="material-icons">close</i>
                                       </button>
                                   </form>
                                   </div>
                               </div>
               
                       
               
                               <div class="mdl-grid">
                                   <form method="post">
                                   <div style="height: 40px; display: flex;"> 
                                   <p style="margin-right: 15px;">Editorial:</p>
                                   <select id="select-seach-l" name="select-seach-l" class="select-editoriales">


                                                                                       
';

                    $v = $_SESSION["multi"]->visualizarListaEditoriales();
                    if ($v == "Esta vacia") {
                        echo '<option value="null">null</option>';
                    } else {
                        echo $_SESSION["multi"]->crearCombo();
                    }



                    echo ' </select></div>      

  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                               <input class="mdl-textfield__input" type="number" id="txtSeachLibro" name="txtSeachLibro">
                                               <label class="mdl-textfield__label" for="txtSeachLibro">Id Libro</label>
                                               </div>
                                               <input type="submit" value="Buscar" name="btn-seach2" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
               
                               
                                   </form>                    
                               </div>
                               <div class="mdl-grid">';

                    if (isset($_POST["btn-seach2"])) {

                        $nsel = $_POST["txtSeachLibro"];
                        $sec = $_POST["select-seach-l"];
                        if ($nsel != null && $sec != null) {

                            $nodoSeachLibro = $_SESSION["multi"]->buscarLibro($sec, $nsel);
                            if ($nodoSeachLibro) {
                                echo "Id Libro: " . $nodoSeachLibro->getIdLibro() . " Titulo: " . $nodoSeachLibro->getTitulo() . " Autor: " . $nodoSeachLibro->getAutor() . " Pais: " . $nodoSeachLibro->getPais() . " Año de edicion: " . $nodoSeachLibro->getAnho() . " Cantidad: " . $nodoSeachLibro->getCant();
                            } else {
                                echo "No se encontro su libro en esa editorial";
                            }
                        } else {
                            phpAlert("Digite libro a buscar y selecciones una editorial valida");
                        }
                    }
                    echo '
                               
                               </div>
               
                           </div>
                           <div class="mdl-cell mdl-cell--3-col"></div>
                    
                    </div>';
                } elseif ($_GET["action"] == "deleteE") {
                    echo '<div class="spam-search">
                    <div class="mdl-grid">
                           <div class="mdl-cell mdl-cell--3-col"></div>
                           <div class="mdl-cell mdl-cell--6-col" style="background-color:white;">
                               <div class="mdl-grid" style="padding-right: 20px;padding-left: 20px;padding-top: 12px;" >
                                   <div style="display:flex;width:100%;"><p>Eliminar Editorial</p>
                                   <form method="post" style="margin-left: 70%;">
                                       <button  name="exit" class="mdl-button mdl-js-button " formaction="/index.php">
                                           <i class="material-icons">close</i>
                                       </button>
                                   </form>
                                   </div>
                               </div>
               
                       
               
                               <div class="mdl-grid">
                                   <form method="post">
               
                                               <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                               <input class="mdl-textfield__input" type="number" id="txtDelete" name="txtDelete">
                                               <label class="mdl-textfield__label" for="txtDelete">Id Editorial</label>
                                               </div>
                                               <input type="submit" value="Eliminar" name="btn-delete1" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
                                               <input type="submit" value="Forzar Eliminacion" id="btn-delete-complete" name="btn-delete-complete" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
                                           
                                   </form>                    
                               </div>
                               <div class="mdl-grid">';

                    if (isset($_POST["btn-delete1"])) {
                        
                        $nodoDelete = null;
                        $tee = $_POST["txtDelete"];

                        if ($tee != null && $tee != "") {
                            if ($_SESSION["multi"]->buscarEditorial($tee)) {
                                $nodoDelete = $_SESSION["multi"]->eliminarEditorial($tee);
                                if ($nodoDelete != false) {
                                    echo "Editorial eliminada o vacia";
                                } else {
                                    echo '<p>Editorial contiene libros desea borrar la editorial con todos sus libros debe forzar la eliminacion?</p>';
                                                                                
                                }
                            }else{
                                echo "Editorial no existe";

                            }


                            
                          
                        } else {
                            phpAlert("Digite identificador de editorial a eliminar");
                        }                    
                    }elseif(isset($_POST["btn-delete-complete"]) ) {
                        $tee2 = $_POST["txtDelete"];
                        if ($tee2 != "" && $tee2 != null) {
                            
                            $resp = $_SESSION["multi"]->eliminarEditorialCompleta($tee2);
                            if ($resp == false) {
                                phpAlert("No se pudo eliminar correctamente");
                            }else {
                                phpAlert("Se elimino la editorial completamente");
                            }                                                
                        
                        } else {
                            phpAlert("Digitar la editorial a eliminar");
                        }
                        
                       
                    
                    }
                    echo '
                               
                               </div>
               
                           </div>
                           <div class="mdl-cell mdl-cell--3-col"></div>
                    
                    </div>';
                } elseif ($_GET["action"] == "deleteL") {

                    echo '<div class="spam-search">
                    <div class="mdl-grid">
                           <div class="mdl-cell mdl-cell--3-col"></div>
                           <div class="mdl-cell mdl-cell--6-col" style="background-color:white;">
                               <div class="mdl-grid" style="padding-right: 20px;padding-left: 20px;padding-top: 12px;" >
                                   <div style="display:flex;width:100%;"><p>Eliminar Libros</p>
                                   <form method="post" style="margin-left: 70%;">
                                       <button  name="exit" class="mdl-button mdl-js-button " formaction="/index.php">
                                           <i class="material-icons">close</i>
                                       </button>
                                   </form>
                                   </div>
                               </div>
               
                       
               
                               <div class="mdl-grid">
                                   <form method="post">
                                   <div style="height: 40px; display: flex;"> 
                                   <p style="margin-right: 15px;">Editoriales:</p>
                                   <select id="select-delete-l" name="select-delete-l" class="select-editoriales">
                                                                                       
';
                    $v = $_SESSION["multi"]->visualizarListaEditoriales();
                    if ($v == "Esta vacia") {
                        echo '<option value="null">null</option>';
                    } else {
                        echo $_SESSION["multi"]->crearCombo();
                    }

                    echo ' </select></div>
                                               <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                               <input class="mdl-textfield__input" type="number" id="txtDeleteLibro" name="txtDeleteLibro">
                                               <label class="mdl-textfield__label" for="txtDeleteLibro">Id Libro</label>
                                               </div>
                                               <input type="submit" value="Eliminar Libro" name="btn-deletel2" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
               
                               
                                   </form>                    
                               </div>
                               <div class="mdl-grid">';

                    if (isset($_POST["btn-deletel2"])) {

                        $ndl = $_POST["txtDeleteLibro"];
                        $secdl = $_POST["select-delete-l"];
                        if ($ndl != null && $secdl != null) {
                            echo $tee;
                            $responsedl = $_SESSION["multi"]->eliminarLibro($secdl, $ndl);
                            if ($responsedl != false) {
                                echo "Libro eliminado";
                            } else {
                                echo "Libro no eliminada validar datos";
                            }
                        } else {
                            phpAlert("Validar selecion de editorial y editorial del libro a eliminar");
                        }
                    }
                    echo '     
                               </div>
                           </div>
                           <div class="mdl-cell mdl-cell--3-col"></div>
                    
                    </div>';
                }elseif ($_GET["action"] == "contXAnho"){

                    echo '<div class="spam-search">
                    <div class="mdl-grid">
                           <div class="mdl-cell mdl-cell--3-col"></div>
                           <div class="mdl-cell mdl-cell--6-col" style="background-color:white;">
                               <div class="mdl-grid" style="padding-right: 20px;padding-left: 20px;padding-top: 12px;" >
                                   <div style="display:flex;width:100%;"><p style="width:70%">Contar libros de año especifico</p>
                                   <form method="post" style="margin-left: 30%;">
                                       <button  name="exit" class="mdl-button mdl-js-button " formaction="/index.php">
                                           <i class="material-icons">close</i>
                                       </button>
                                   </form>
                                   </div>
                               </div>
                               <div class="mdl-grid">
                                   <form method="post">
               
                                               <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                               <input class="mdl-textfield__input" type="number" id="txtAnho" name="txtAnho">
                                               <label class="mdl-textfield__label" for="txtAnho">Año Especifico</label>
                                               </div>
                                               <input type="submit" value="Buscar Cantidad" name="btn-seach-x-anho" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">                                              
                                   </form>                    
                               </div>
                               <div class="mdl-grid">';
                                   if (isset($_POST["btn-seach-x-anho"])) {
               
                                       $nta = $_POST["txtAnho"];
               
                                       if ($nta != null && $nta != "") {
                                         $conta = $_SESSION["multi"]->contadorLibroXAnho($nta);
                                         echo $conta;
                                       } else {
                                           phpAlert("Digite año a buscar");
                                       }
                                   }
                                   echo '
                               </div>
                           </div>
                           <div class="mdl-cell mdl-cell--3-col"></div>
                    </div>';
                }elseif ($_GET["action"] == "contXEdit"){


                    echo '<div class="spam-search">
                    <div class="mdl-grid">
                           <div class="mdl-cell mdl-cell--3-col"></div>
                           <div class="mdl-cell mdl-cell--6-col" style="background-color:white;">
                               <div class="mdl-grid" style="padding-right: 20px;padding-left: 20px;padding-top: 12px;" >
                                   <div style="display:flex;width:100%;"><p style="width:70% !important;">Contador de libros por editorial especifica</p>
                                   <form method="post" style="margin-left: 30%;">
                                       <button  name="exit" class="mdl-button mdl-js-button " formaction="/index.php">
                                           <i class="material-icons">close</i>
                                       </button>
                                   </form>
                                   </div>
                               </div>              
                               <div class="mdl-grid">
                                   <form method="post" style="width:50% !important;">
                                   <div style="height: 40px; display: flex;"> 
                                   <p style="margin-right: 15px;">Editorial:</p>
                                   <select id="select-cont-x-edit" name="select-cont-x-edit" class="select-editoriales">
                                                                                     
';

                    $v = $_SESSION["multi"]->visualizarListaEditoriales();
                    if ($v == "Esta vacia") {
                        echo '<option value="null">null</option>';
                    } else {
                        echo $_SESSION["multi"]->crearCombo();
                    }
                    echo ' </select></div>      

                                               <input type="submit" value="Buscar Cantidad" name="btn-cont-x-edit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
               
                               
                                   </form>                    
                               </div>
                               <div class="mdl-grid">';

                    if (isset($_POST["btn-cont-x-edit"])) {

                        $secxe = $_POST["select-cont-x-edit"];
                        if ($secxe != null && $secxe != "") {

                            $traeNodo = $_SESSION["multi"]->buscarEditorial($secxe);


                            if ($traeNodo != null && $traeNodo != "") {
                                
                               $contaxe = $_SESSION["multi"]->contadorLibroXEditorial($traeNodo);
                               echo $contaxe;
                            }else{

                                echo "Error encontrando editorial";
                            }
                                                       
                        } else {
                            phpAlert("Error al selecionar editorial, valide que debe existir alguna editorial");
                        }
                    }
                    echo '
                               
                               </div>
               
                           </div>
                           <div class="mdl-cell mdl-cell--3-col"></div>
                    
                    </div>';









                }
                ?>

            </div>
        </div>
        <div class="mdl-grid">
            <div class="mdl-cell mdl-cell--4-col">
                <h4>Creacion de editoriales</h4>

                <form method="post">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" type="number" id="idEditorial" name="idEditorial">
                        <label class="mdl-textfield__label" for="idEditorial">Id Editorial</label>
                    </div>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" type="text" id="denominacion" name="denominacion">
                        <label class="mdl-textfield__label" for="denominacion">Denominacion</label>
                    </div>
                    <input type="submit" value="Agregar Editorial" name="addedit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
                </form>

                <?php
                if (isset($_POST["addedit"])) {
                    $id = null;
                    $deno = null;
                    $id = $_POST["idEditorial"];
                    $deno = $_POST["denominacion"];

                    if ($id == null || $deno == null) {
                        phpAlert("No se puede crear una editorial sin [ID]] ni [Denominacion].");
                    } else {
                       $va =  $_SESSION["multi"]->validateIdNoRepeatEditorial($id);
                       if ($va == "no valido") {
                        phpAlert("No se puede repetir id de la editorial");
                       } else {
                           $n = new nodoEditorial($id, $deno);
                           $_SESSION["multi"]->agregarEditorial($n);
                       } 
                    }
                }
                ?>
            </div>
            <div class="mdl-cell mdl-cell--4-col">
                <div>
                    <h4>Creacion de libros</h4>
                    <form method="post">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                            <input class="mdl-textfield__input" type="number" id="idLibro" name="idLibro">
                            <label class="mdl-textfield__label" for="idLibro">Id Libro</label>
                        </div>
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                            <input class="mdl-textfield__input" type="text" id="titulo" name="titulo">
                            <label class="mdl-textfield__label" for="titulo">Titulo libro</label>
                        </div>
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                            <input class="mdl-textfield__input" type="text" id="autor" name="autor">
                            <label class="mdl-textfield__label" for="autor">Autor</label>
                        </div>
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                            <input class="mdl-textfield__input" type="text" id="pais" name="pais">
                            <label class="mdl-textfield__label" for="pais">Pais</label>
                        </div>
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                            <input class="mdl-textfield__input" type="number" id="anho" name="anho">
                            <label class="mdl-textfield__label" for="anho">Año de edicion</label>
                        </div>
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                            <input class="mdl-textfield__input" type="number" id="cant" name="cant">
                            <label class="mdl-textfield__label" for="nat">Cantidad</label>
                        </div>
                        <div style="height: 40px; display: flex;">
                            <p style="margin-right: 15px;">Editorial:</p>
                            <select id="editoriales" name="select-edito" class="select-editoriales">
                                <?php
                                $v = $_SESSION["multi"]->visualizarListaEditoriales();
                                if ($v == "Esta vacia") {
                                    echo '<option value="null">null</option>';
                                } else {
                                    echo $_SESSION["multi"]->crearCombo();
                                }

                                ?>
                            </select>
                        </div>
                        <input type="submit" value="Crear Libro" name="addlibro" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
                        <?php
                        if (isset($_POST["addlibro"])) {
                            $il = $_POST["idLibro"];
                            $tit = $_POST["titulo"];
                            $aut = $_POST["autor"];
                            $pa = $_POST["pais"];
                            $an = $_POST["anho"];
                            $can = $_POST["cant"];
                            $sele = $_POST["select-edito"];

                            $option = isset($_POST['select-edito']) ? $_POST['select-edito'] : false;
                            if ($option == true && $option != "null") {
                                if ($il == "" || $tit == "" || $an == "" || $can == "") {
                                    phpAlert("Validar Id libro, Titulo, Año de edicion o Cantidad ninguno puede ser nulo");
                                } else {
                                    $nl = new nodoLibro($il, $tit, $aut, $pa, $an, $can);
                                    $nodoe = $_SESSION["multi"]->buscarEditorial($sele);

                                   $valida_il = $_SESSION["multi"]->validateIdNoRepeatLibro($nodoe,$il);
                                 
                                    if ($valida_il == "valido") {
                                        $_SESSION["multi"]->agregarLibro($nodoe, $nl);
                                    } else {
                                       phpAlert("No puede repetir identificadores para esta editorial");
                                    }
                                    
                                }

                                $il = null;
                                $tit = null;
                                $aut = null;
                                $pa = null;
                                $an = null;
                                $can = null;
                                $sele = null;
                            } else {
                                phpAlert("Error al intentar crear libro revisar editorial seleccionada");
                            }
                        }

                        ?>
                    </form>
                </div>
            </div>

            <div class="mdl-cell mdl-cell--4-col">
                <div style="display: flex;">
                    <h4>Inventario</h4>

                </div>
                <div class="inventory-box">
                    <?php
                    if (isset($_SESSION["multi"]) == true) {
                        echo $_SESSION["multi"]->visualizarListaCompleta();
                    }

                    ?>
                </div>

            </div>
        </div>
    </div>

</body>

</html>
