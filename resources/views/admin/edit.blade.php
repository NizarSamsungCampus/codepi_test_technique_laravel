<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <link rel="stylesheet" type="text/css" href="../../resources/assets/css/style.css"/>
    <title>Laravel</title>
    <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</head>
<body> 
    <div id="centreur">
        <header id="header">
            <h1><img alt="logo codepi" src="../../resources/assets/images/logo.png"/></h1>
            <h2>CODEPI</h2>
            {!! link_to('/', 'Accueil') !!}
            {!! link_to('/admin', 'Administration') !!}
            <?php 
            $admin = Session::get('admin');
            if (isset($admin)) {
                ?>
                {!! link_to('add',"Ajouter une ressource") !!}
                {!! link_to('logout', "Se deconnecter") !!}<?php
            }
            ?>                
        </header>
        <section id="section">
            <h3>Administration des concerts</h3>
            <div id="filters">
            <?php include_once '../public/php/edit.php'; ?><!-- This file is in public/php folder !! -->
            {!! Form::open(array('url' => 'editProcess')) !!}
            {!! Form::hidden('id_concert', $id_concert) !!}
            {!! Form::label("artiste", "Artiste : ") !!}
            {!! Form::text("artiste", $artiste) !!}
            {!! Form::label("lieu", "Lieu : ") !!}
            {!! Form::text("lieu", $lieu) !!}
            {!! Form::label("adresse", "Adresse : ") !!}
            {!! Form::text("adresse", $adresse) !!}
            {!! Form::label("ville", "Ville : ") !!}
            {!! Form::text("ville", $ville) !!}
            {!! Form::label("date", "Date : ") !!}
            {!! Form::text("date", $thisDate) !!}
            {!! Form::label('heure', "Heure : ") !!}
            {!! Form::select('heure', $heure, array('value' => $thisHour)) !!}
            {!! Form::select('minutes', $minutes, array('value' => $thisMinutes)) !!}
            {!! Form::label("prix", "Prix : ") !!}
            {!! Form::text("prix", $prix) !!}
            {!! Form::submit('Modifier') !!}
            {!! Form::close() !!}
            </div>
        </section>
    </div>
</body>
</html>