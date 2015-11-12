<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <link rel="stylesheet" type="text/css" href="../../resources/assets/css/style.css"/>
    <title>Laravel</title>
    <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script type="text/javascript" src="../js/google.js"></script>
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
        <section id="infosection">
            <?php
                foreach ($data as $info) {
                    $artiste = $info->artiste;
                    $lieu = $info->lieu;
                    $date = $info->date;
                    $adresse = $info->adresse;
                    $ville = $info->ville;
                    $prix = $info->prix; ?>
                    <h2>{{ $info->artiste." @ ".$info->lieu." - ".$info->ville }}</h2>
                    <img class="infophoto" src="../../resources/assets/images/{{ $info->image }}" alt="{{ $info->artiste }}"/>
                    <p>{{ $info->description }}</p>
                    {!! Form::hidden('artiste', $info->artiste, array('id' => 'artiste')) !!}
                    {!! Form::hidden('adresse', $info->adresse, array('id' => 'adresse')) !!}
                    {!! Form::hidden('lieu', $info->lieu, array('id' => 'lieu')) !!}
          <?php } ?>
        </section>
        <nav id="infonav">
            <h2>Pré-commandez</h2>
            <p>Commandez votre place de concert pour le concert de <span class="underline">{{ $artiste }}</span></p>
            <div id="info">
                <div><span class="underline label">Date :</span><span class="right value">{{ $date }}</span></div>
                <div><span class="underline label">Lieu :</span><span class="right value">{{ $lieu }}</span></div>
                <div><span class="underline label">Adresse :</span><span class="right value">{{ $adresse }}</span></div>
                <div><span class="underline label">Ville :</span><span class="right value">{{ $ville }}</span></div>
            </div>
            <div id="map-canvas"></div>
            <button id="precommande">Pré-commandez !</button>
        </nav>
       <div id="player">
       </div>
    </div>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCgCvrp13n2LzkVF1prKoYlwDmu74ijiKg&amp;libraries=places&amp;language=fr"></script>
    <script type="text/javascript" src="../js/script.js"></script>
</body>
</html>