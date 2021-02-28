<?php
include("nodoEditorial.php");
class Multilista
{
    // nodos editoriales
    private $ptr; // hilo
    private $final;

    function __construct()
    {
        $this->ptr = null;
        $this->final = null;
    }
    // for debug is not required
    function getPTR()
    {
        return $this->ptr;
    }
    function getFinal()
    {
        return $this->ptr;
    }

    // 
    function agregarNodoPrincio($P)
    {
        // si el primero es nulo entonces final es igual al nodo pasado
        if ($this->ptr == null) {
            $mjs = 'esta vacio';
            # code...
            $this->final = $P;
        } else {
            // el primero se mueve al siguiente del nodo nuevo (agregado)
            $P->setSig($this->ptr);
        }
        $this->ptr = $P;
    }


    function agregarEditorial($p)
    {

        if ($this->ptr == null) {
            $this->ptr = $p;
        } else {
            $this->final->setSig($p);
            $p->setAnt($this->final);
        }
        $this->final = $p;
    }
    function buscarEditorial($i)
    {
        // nodo editorial
        $p = $this->ptr;
        $encontrado = false;

        while ($p != null && $encontrado == false) {
            if ($p->getIdEditorial() == $i) {
                $encontrado = true;
            } else {
                $p = $p->getSig();
            }
        }
        return $p;
    }

    function editorialVacia($p)
    {
        //p editorial a validar
        if ($p->getAbajo() == null) {
            return true;
        } else {
            return false;
        }
    }

    function apuntarFinalEditorial($p)
    {
        $r = $p->getAbajo(); // $p nodoLibro
        while ($r->getAbajo() != null) {
            $r = $r->getAbajo();
        }
        return $r;
        /* retornar el ultimo nodo de 
        la sublista libro de la editorial */
    }

    function agregarLibro($p, $q)
    {
        // p editorial
        // q libros
        if ($this->editorialVacia($p)) {
            $p->setAbajo($q);
        } else {
            $finLibro = $this->apuntarFinalEditorial($p);
            $finLibro->setAbajo($q);
        }
    }

    function buscarLibro($e, $l)
    {
        //$e = idEditorial; $l = idLibro;
        $ne = $this->buscarEditorial($e);
        ## NE = editorial buscada
        if ($ne === null) {
            return null;
        } else {
            $r = $ne->getAbajo(); // nodolibro = abajo
            $encontrado = false;
            while ($r != null && $encontrado == false) {
                if ($r->getIdlibro() === $l) {
                    $encontrado = true;
                } else {
                    $r = $r->getAbajo();
                }
            }
            return $r;
        }
    }

    function detalleLibro($iEd, $iLi)
    {
        $msj = "";
        $nl = $this->buscarLibro($iEd, $iLi);
        if ($nl == null) {
            $msj = "Libro no encontrado";
        } else {
            $msj = "Id Libro: " . $nl->getIdLibro() . " Titulo: " . $nl->getTitulo() . " Autor: " . $nl->getAutor()
                . " Pais: " . $nl->getPais() . " Año: " . $nl->getAnho() . " Cantidad: " . $nl->getCant();
        }
        return $msj;
    }
    ### REVISAR Y VALIDAR CANTIDAD QUE SEAN SUMADAS O RESTADAS
    function actualizarInventario($ie, $il, $ca)
    {
        $nl = $this->buscarLibro($ie, $il);
        if ($nl == null) {
            return false;
        } else {
            $nl->setCant($nl->getCant() + $ca);
            return true;
        }
    }


    function eliminarLibro($ie, $il)
    {
        $p = $this->buscarEditorial($ie);
        if ($p == null) {
            return false;
        } else {
            $q = $p->getAbajo();
            $ant = $q;
            $encontrado = false;
            while ($q != null && $encontrado == false) {
                if ($q->getIdLibro() == $il) {
                    # code...
                    $encontrado = true;
                } else {
                    $ant = $q;
                    $q = $q->getAbajo();
                }
            }
            if ($q == null) {
                return false;
            } else {
                if ($q === $p->getAbajo()) {
                    $p->setAbajo($q->getAbajo());
                } else {
                    $ant->setAbajo($q->getAbajo());
                }
                $q = null;
                return true;
            }
        }
    }



    function eliminarEditorial($ie)
    {
        $p = $this->buscarEditorial($ie);
        if ($p == null) {
            return false;
        } else {
            if (!$this->editorialVacia($p)) {
                // si la editorial  esta vacia
                return false;
            } else {
                if ($p == $this->ptr) {
                    if ($p->getSig() === null) {
                        $this->ptr = null;
                        $this->final = null;
                    } else {
                        $this->ptr = $this->ptr->getSig();
                        $this->ptr->setAnt(null);
                    }
                } else {
                    $p->getAnt()->setSig($p->getSig());
                    if ($p == $this->final) {
                        $this->final = $p->getAnt();
                    } else {
                        $p->getSig()->setAnt($p->getAnt());
                    }
                }
                //
                $p = null;
                return true;
            }
        }
    }

    function eliminarEditorialCompleta($ie)
    {
        $p = $this->buscarEditorial($ie);
        if ($p == null) {
            return "nulo";
        } else {
            if (!$this->editorialVacia($p)) {
                // eliminar todos los libros
                $p->setAbajo(null);
                if ($p == $this->ptr) {
                    if ($p->getSig() === null) {
                        $this->ptr = null;
                        $this->final = null;
                    } else {
                        $this->ptr = $this->ptr->getSig();
                        $this->ptr->setAnt(null);
                    }
                } else {
                    $p->getAnt()->setSig($p->getSig());
                    if ($p == $this->final) {
                        $this->final = $p->getAnt();
                    } else {
                        $p->getSig()->setAnt($p->getAnt());
                    }
                }
                $p = null;
                return true;
            } else {
                if ($p == $this->ptr) {
                    if ($p->getSig() === null) {
                        $this->ptr = null;
                        $this->final = null;
                    } else {
                        $this->ptr = $this->ptr->getSig();
                        $this->ptr->setAnt(null);
                    }
                } else {
                    $p->getAnt()->setSig($p->getSig());
                    if ($p == $this->final) {
                        $this->final = $p->getAnt();
                    } else {
                        $p->getSig()->setAnt($p->getAnt());
                    }
                }
                //
                $p = null;
                return true;
            }
        }
    }


    function visualizarListaEditoriales()
    {
        $P = $this->ptr;
        $Mesaje = ""; // Lista vacia
        if ($P == null) { // si el nodo 
            return "Esta vacia";
        } else {
            # code...
            while ($P != null) {

                # code...
                $Mesaje = $Mesaje . "<br>- " . $P->getIdEditorial() . " Denominacion: " . $P->getDenominacion();
                $P = $P->getSig();
            }
        }

        return "$Mesaje";
    }

    function crearCombo()
    {
        $options = ""; // Lista vacia
        //   $template = "<option value="null">null</option>";
        $p = $this->ptr;

        while ($p != null) {
            $options = $options . '<option value="' . $p->getIdEditorial() . '">' . $p->getDenominacion() . '</option>
            ';
            $p = $p->getSig();
        }
        return "$options";
    }

    function visualizarListaCompleta()
    {
        $P = $this->ptr;
        $Mesaje = ""; // Lista vacia
        $MesajeLibro = "";
        if ($P == null) { // si el nodo 
            return "Esta vacia";
        } else {
            # code...
            while ($P != null) {

                # code...
                $Mesaje = $Mesaje . '<br><p class="text-inventory">- ' . $P->getIdEditorial() . " Denominacion: " . $P->getDenominacion() . "</p>";


                $r = $P->getAbajo(); // nodolibro = abajo
                while ($r != null) {
                    $MesajeLibro = $MesajeLibro . "&nbsp;&nbsp;&nbsp;&nbsp;-> id: " . $r->getIdLibro() . " titulo: " . $r->getTitulo() . " Autor: " . $r->getAutor() . " Pais: " . $r->getPais() . " Año: " . $r->getAnho() . " Cantidad " . $r->getCant() . "<br>";
                    $r = $r->getAbajo();
                }

                $Mesaje = $Mesaje . $MesajeLibro;
                $P = $P->getSig();
                $MesajeLibro = null;
            }
        }

        return "$Mesaje";
    }

    function contadorLibroXAnho($anho)
    {
        $p = $this->ptr;
        $cont = 0;
        $cant = 0;
        if ($p == null) {
            return "Biblioteca vacia";
        } else {
            while ($p != null) {
                $r = $p->getAbajo();
                if ($r != null) {
                    while ($r != null) {

                        if($r->getAnho() == $anho){
                            $cont = $cont +1;
                            $cant = $cant + $r->getCant();
                        }
                        $r = $r->getAbajo();
                    }
                    $p = $p->getSig();
                }else{
                    $p = $p->getSig();
                }
            }
            if ($cont != 0) {
                return "En la biblioteca existen ".$cont." libros diferentes con esa fecha, la suma de las cantidades de estos libros es: ".$cant;
            }else{
               return "no se encontro libros a esta fecha";
            }
        }
    }



    function contadorLibroXEditorial($editorial)
    {

        //$p = $this->ptr;
        $cont = 0;

        $dato = $this->editorialVacia($editorial);
        if ($dato == true) {
            return "editorial vacia";
        } else {
            return "editorial llena";
        }
        
        
    }
}
