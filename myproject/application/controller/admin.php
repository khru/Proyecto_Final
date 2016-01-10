<?php

class Admin
{

    public function index()
    {
        HelperFunctions::comprobarSesion();
        View::render("admin/index");

    }
}
