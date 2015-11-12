<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <link rel="stylesheet" type="text/css" href="../resources/assets/css/style.css"/>
    <title>Laravel</title>
    <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</head>
<body> 
    <div id="centreur">
        <header id="header">
            <h1><img alt="logo codepi" src="../resources/assets/images/logo.png"/></h1>
            <h2>CODEPI</h2>
            {!! link_to('/', 'Accueil') !!}
            {!! link_to('/admin', 'Administration') !!}            
            <?php 
            $admin = Session::get('admin');
            if (isset($admin)) {
                ?>{!! link_to('logout', "Se deconnecter") !!}<?php
            }
            ?>             
        </header>
        <section id="section">
            <h3>Administration des concerts</h3>
            <div id="filters">
            <?php include_once '../public/php/edit.php'; ?><!-- This file is in public/php folder !! -->
            {!! Form::open(array('url' => 'addProcess')) !!}
            {!! Form::label("artiste", "Artiste : ") !!}
            {!! Form::text("artiste") !!}
            {!! Form::label("lieu", "Lieu : ") !!}
            {!! Form::text("lieu") !!}
            {!! Form::label("adresse", "Adresse : ") !!}
            {!! Form::text("adresse") !!}
            {!! Form::label("ville", "Ville : ") !!}
            {!! Form::text("ville") !!}
            {!! Form::label("date", "Date : ") !!}
            {!! Form::text("date") !!}
            {!! Form::label('heure', "Heure : ") !!}
            {!! Form::select('heure', $heure) !!}
            {!! Form::select('minutes', $minutes) !!}
            {!! Form::label("prix", "Prix : ") !!}
            {!! Form::text("prix") !!}
            {!! Form::submit('Ajouter') !!}
            {!! Form::close() !!}
            </div>
            <?php
            if (isset($message)) {
                echo $message;
            }
             ?>
        </section>
    </div>
</body>
</html>