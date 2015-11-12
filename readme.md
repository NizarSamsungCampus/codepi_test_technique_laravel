# Installation

## Requirements : 
	-Configurer la connexion à mysql dans le fichier config/database.php
	-Installer composer
	-Créer une base de donnée vide nommée 'concerto'

## Etape 1 - Utiliser composer :
	-Se rendre à la racine du projet, lancer composer et taper les commandes suivantes :
		-`composer install`
		-`php artisan migrate`

## Etape 2 - Importation des fichiers CSV en base de donnée : 
	
	Une fois à l'index de l'application, veuillez utiliser l'url '/public/bdd' 
	pour éxécuter le script qui importera 
	les informations necessaire à l'application
	dans votre base de données 'concerto'.

Vous pouvez maintenant retourner à la racine de l'application, celle-ci sera normalement fonctionnelle.