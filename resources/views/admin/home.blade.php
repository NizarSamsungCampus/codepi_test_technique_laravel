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
            <?php if (!isset($concerts)) { ?>
            <h2>Accéder à l'interface administrateur</h2>
            <div id="filters">
                {!! Form::open(array('url' => 'adminaccess', 'id' => 'formadmin')) !!}
                {!! Form::label('login', 'Login') !!}
                {!! Form::text('login') !!}
                {!! Form::label('password', 'Mot de passe :') !!}
                {!! Form::password('password') !!}
                {!! Form::submit('Connexion') !!}
                {!! Form::close() !!}
            </div>
            <?php } else { ?>
            <h3>Administration des concerts</h3>
            <div id="table">
                <table>
                    <tr>
                        <td>Artiste</td>
                        <td>Lieu</td>
                        <td>Date</td>
                        <td>Adresse</td>
                        <td>Prix</td>
                        <td>Operations</td>
                    </tr>
                    @foreach ($concerts as $concert)
                        <tr>
                            <td>{{ $concert->artiste }}</td>
                            <td>{{ $concert->lieu }}</td>
                            <td>{{ $concert->date }}</td>
                            <td>{{ $concert->adresse }}</td>
                            <td>{{ $concert->prix }}</td>
                            <td>{!! link_to("edit/".$concert->id_concert, "Editer") !!}</td>
                            <td>{!! link_to('delete/'.$concert->id_concert, "Supprimer") !!}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
            <div id="pagination">
                <?php 
                $concerts->setPath("admin");
                echo $concerts->render(); ?>
            </div>
            <?php
                } ?>

        </section>
    </div>
</body>
</html>