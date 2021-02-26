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
                    $r = $r->getSig();
                }
            }
            return $r;
        }
    }

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
        if ($p = null) {
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
                    $q = $q->getSig();
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
        if ($p = null) {
            return false;
        } else {
            if (!$this->editorialVacia($p)) {
                // si la editorial no esta vacia
                return false;
            } else {
                if ($p = $this->ptr) {
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

    function visualizarLista()
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

}
