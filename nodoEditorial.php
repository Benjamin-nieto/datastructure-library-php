<?php
class nodoEditorial
{

    private $idEditorial;
    private $denominacion;
    private $ant;
    private $sig;
    private $abajo;

    /*public function __construct()
    {
        $this->idEditorial = null;
        $this->denominacion = null;
        $this->ant = null;
        $this->sig = null;
        $this->abajo = null;
    }*/
    public function __construct($i,$d)
    {
        $this->idEditorial = $i;
        $this->denominacion = $d;
        $this->ant = null;
        $this->sig = null;
        $this->abajo = null;
    }

    function getIdEditorial()
    {
        return $this->idEditorial;
    }
    function getDenominacion()
    {
        return $this->denominacion;
    }
    function getAnt()
    {
        return $this->ant;
    }
    function getSig()
    { 
        return $this->sig;
    }
    function getAbajo()
    {
        return $this->abajo;
    }

    function setIdEditorial($I){
        $this->idEditorial=$I;
    }
    function setDenominacion($D){
        $this->denominacion=$D;
    }
    function setAnt($a){
        $this->ant=$a;
    }
    function setSig($s){
        $this->sig=$s;
    }
    function setAbajo($a){
        $this->abajo=$a;
    }
}
