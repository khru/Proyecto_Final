<?php

class BackHome
{
    
    public function index()
    {
        HelperFunctions::comprobarSesion();
        View::render("backhome/index");
        
    }
}
