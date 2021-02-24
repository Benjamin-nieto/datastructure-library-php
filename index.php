<?php
include("multilistas.php");
//include("nodoEditorial.php");
include("nodoLibro.php");

session_start();

if (isset($_SESSION["multi"]) == false) {
    echo "no existia y se creo";
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

<body>
    <div class="gradient-background-color">
        <div class="mdl-grid ">
            <div class="mdl-cell mdl-cell--8-col" style="display: flex !important;">
                <div>
                    <h1>Biblioteca C.U.C</h1>
                </div> <img src="./img/logo.png" style="width:23%;">
            </div>
            <div class="mdl-cell mdl-cell--2-col"></div>
            <div class="mdl-cell mdl-cell--2-col"></div>
        </div>
        <div class="mdl-grid">
            <div class="mdl-cell mdl-cell--4-col">
                <h4>Creacion de editoriales</h4>

                <form method="post">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" type="text" id="idEditorial" name="idEditorial">
                        <label class="mdl-textfield__label" for="idEditorial">Id Editorial</label>
                    </div>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" type="text" id="denominacion" name="denominacion">
                        <label class="mdl-textfield__label" for="denominacion">Denominacion</label>
                    </div>
                    <input type="submit" value="Agregar Editorial" name="addedit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
                </form>

                <?php
                if (isset($_POST["denominacion"])) {
                    $id = $_POST["idEditorial"];
                    $deno = $_POST["denominacion"];
                    
                        $Mesaje = "";
                        $n = new nodoEditorial($id, $deno);
                        //$_SESSION["multi"]->agregarEditorial($n);
                       $_SESSION["multi"]->agregarEditorial($n);
//                        $p = $_SESSION["multi"]->getPTR();
                       echo $_SESSION["multi"]->visualizarLista();
                     /*  
                       // echo "".$p->getIdEditorial();
                        //echo "".$p->getDenominacion();
                        if ($p == null) { // si el nodo 
                            return "Esta vacia";
                        }else{
                            while($p != null){
                                $Mesaje = $Mesaje . "<br>- ".$p->getIdEditorial();
                                $p  = $p ->getSig();
                            }
                        }
                        echo $Mesaje;*/                        
                    
                }else{
                    phpAlert("No se puede crear una editorial sin [ID]] ni [Denominacion].");
                }

                ?>
            </div>
            <div class="mdl-cell mdl-cell--4-col">
                <div>
                    <h4>Creacion de libros</h4>
                    <form action="post">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                            <input class="mdl-textfield__input" type="text" id="idLibro">
                            <label class="mdl-textfield__label" for="idLibro">Id Libro</label>
                        </div>
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                            <input class="mdl-textfield__input" type="text" id="titulo">
                            <label class="mdl-textfield__label" for="titulo">Titulo libro</label>
                        </div>
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                            <input class="mdl-textfield__input" type="text" id="autor">
                            <label class="mdl-textfield__label" for="autor">Autor</label>
                        </div>
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                            <input class="mdl-textfield__input" type="text" id="pais">
                            <label class="mdl-textfield__label" for="pais">Pais</label>
                        </div>
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                            <input class="mdl-textfield__input" type="text" id="anho">
                            <label class="mdl-textfield__label" for="anho">Año de edicion</label>
                        </div>
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                            <input class="mdl-textfield__input" type="text" id="cant">
                            <label class="mdl-textfield__label" for="nat">Cantidad</label>
                        </div>
                        <input type="submit" value="Crear Libro" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
                    </form>
                </div>
            </div>

            <div class="mdl-cell mdl-cell--4-col">
                <div style="display: flex;">
                    <h4>Inventario</h4>
                    <form method="post">
                        <button class="mdl-button mdl-js-button mdl-button--icon mdl-button--colored" style="margin-top: 7%;" name="autorenew">
                            <i class="material-icons">autorenew</i>
                        </button>
                    </form>
                </div>
                <div>
                    <?php if (isset($_POST["autorenew"])) {
                        echo $_SESSION["multi"]->visualizarLista();
                    } ?>
                </div>

            </div>
        </div>
    </div>
</body>

</html>