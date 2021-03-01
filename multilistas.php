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

    function agregarNodoPrincio($P)
    {
        if ($this->ptr == null) {
            $mjs = 'esta vacio';
            $this->final = $P;
        } else {
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
        if ($p->getAbajo() == null) {
            return true;
        } else {
            return false;
        }
    }

    function apuntarFinalEditorial($p)
    {
        $r = $p->getAbajo(); 
        while ($r->getAbajo() != null) {
            $r = $r->getAbajo();
        }
        return $r;
    }

    function agregarLibro($p, $q)
    {
        if ($this->editorialVacia($p)) {
            $p->setAbajo($q);
        } else {
            $finLibro = $this->apuntarFinalEditorial($p);
            $finLibro->setAbajo($q);
        }
    }

    function buscarLibro($e, $l)
    {
        $ne = $this->buscarEditorial($e);
        if ($ne === null) {
            return null;
        } else {
            $r = $ne->getAbajo(); 
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
                $p = null;
                return true;
            }
        }
    }


    function visualizarListaEditoriales()
    {
        $P = $this->ptr;
        $Mesaje = ""; 
        if ($P == null) { 
            return "Esta vacia";
        } else {
            while ($P != null) {
                $Mesaje = $Mesaje . "<br>- " . $P->getIdEditorial() . " Denominacion: " . $P->getDenominacion();
                $P = $P->getSig();
            }
        }

        return "$Mesaje";
    }

    function crearCombo()
    {
        $options = ""; 
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
        $Mesaje = ""; 
        $MesajeLibro = "";
        if ($P == null) {  
            return "Esta vacia";
        } else {
            while ($P != null) {
                $Mesaje = $Mesaje . '<br><p class="text-inventory">- ' . $P->getIdEditorial() . " Denominacion: " . $P->getDenominacion() . "</p>";
                $r = $P->getAbajo(); 
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

        $cont = 0;
        $cant = 0;
        $dato = $this->editorialVacia($editorial);
        if ($dato == true) {
            return "Editorial sin libros para contar";
        } else {
            $r = $editorial->getAbajo();
            while($r != null){
                if ($r->getIdLibro() != null) {
                  $cont = $cont + 1;
                  $cant = $cant + $r->getCant();

                }
                $r = $r->getAbajo();
            }
            if ($cont != 0) {
                return "La cantidad de libros distintos de esta editorial es ".$cont." la suma de todas las cantidades de los libros en inventario es ".$cant;
            }
        }
        
        
    }

    function validateIdNoRepeatEditorial($id){
        $p = $this->ptr;
        $cuantos = 0;
        while($p != null){
            if ($p->getIdEditorial() == $id) {
               $cuantos = $cuantos + 1;
            }
            
            $p = $p->getSig();
        }

        if ($cuantos >= 1) {
           $mds = "no valido";
        } else {
           $mds = "valido";
        }
        
        return $mds;

    }

    function validateIdNoRepeatLibro($ne,$id){

        $n = $ne->getAbajo();
        $cuantos2 = 0;
        while ($n != null ) {
           
            if ($n->getIdLibro() == $id) {
                $cuantos2 =  $cuantos2 +1;
            } 
            
            $n = $n->getAbajo();
        }

        if ($cuantos2 >= 1) {
            $mds = "no valido";
         } else {
            $mds = "valido";
         }
         
         return $mds;
        
    }

}
