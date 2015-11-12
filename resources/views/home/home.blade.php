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
            <h2>Parcourir les concerts à venir</h2>
            <div id="filters">
                {!! Form::open(array('url' => 'search')) !!}
                {!! Form::submit('Filtrer les recherches', array('class' => 'filtres')) !!}
                <?php require_once 'php/filters.php'; ?><!-- This file is in public/php folder !! -->
                {!! Form::select("filterville", $villes, null, array('placeholder' => "VILLE", 'class' => 'filtres')) !!}
                {!! Form::select("filtertags", $tags, null, array('placeholder' => "TAGS",'class' => 'filtres')) !!}
                {!! Form::select('filterprix', $prix, null, array('placeholder' => 'PRIX','class'=> 'filtres')) !!}
                {!! Form::close() !!}
            </div>
            <div id="concerts">
                @foreach ($concerts as $concert)
                    <div class="figureconcert">
                        <h3 class="specialtitle">{{ $concert->artiste." @ ".$concert->lieu." - ".$concert->ville }}</h3>
                        <img class="concertimage" alt="{{ $concert->artiste }}" src="../resources/assets/images/{{ $concert->image }}"/>
                        <div class="infoconcert">
                            <p>{{ $concert->date }}
                                <span class="right">Prix : 
                                    <strong>{{ $concert->prix }},00€</strong>
                                </span>
                            </p>
                            <p>
                                {{ $concert->tags }}
                                <span class="right">
                                    {!! link_to('concert/'.$concert->id_concert, "Voir l'affiche ->", array('class' => 'affichebutton'))  !!}
                                </span>
                            </p>
                        </div>
                    </div>
                 @endforeach   
            </div>
        </section>
        <div id="pagination">
            <?php echo $concerts->render(); ?>
            ?>
        </div>
    </div>
</body>
</html>
