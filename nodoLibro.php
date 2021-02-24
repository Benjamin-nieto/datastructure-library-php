<?php

class nodoLibro
{
    private $idLibro;
    private $titulo;
    private $autor;
    private $pais;
    private $anho;
    private $cant;
    private $abajo;
 
   /* function __construct()
    {
        $this->idLibro = null;
        $this->titulo = null;
        $this->autor = null;
        $this->pais = null;
        $this->anho = null;
        $this->cant = null;
        $this->abajo = null;
    }*/

    function __construct($i, $t, $a, $p, $an, $ca)
    {
        $this->idLibro = $i;
        $this->titulo = $t;
        $this->autor = $a;
        $this->pais = $p;
        $this->anho = $an;
        $this->cant = $ca;
        $this->abajo = null;
    }
    // getters
    function getIdLibro()
    {
        return $this->idLibro;
    }
    function getTitulo()
    {
        return $this->titulo;
    }
    function getAutor()
    {
        return $this->autor;
    }
    function getPais()
    {
        return $this->pais;
    }
    function getAnho()
    {
        return $this->anho;
    }
    function getCant()
    {
        return $this->cant;
    }
    function getAbajo()
    {
        return $this->abajo;
    }

    // setters

    function setIdLibro($i)
    {
        $this->idLibro = $i;
    }
    function setTitulo($t)
    {
        $this->titulo = $t;
    }
    function setAutor($a)
    {
        $this->autor = $a;
    }
    function setPais($p)
    {
        $this->pais = $p;
    }
    function setAnho($a)
    {
        $this->anho = $a;
    }
    function setCant($c)
    {
        $this->cant = $c;
    }
    function setAbajo($ab)
    {
        $this->abajo = $ab;
    }
}
