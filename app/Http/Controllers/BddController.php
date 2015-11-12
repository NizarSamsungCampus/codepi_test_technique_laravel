<?php

namespace Concerto\Http\Controllers;

use Illuminate\Http\Request;
use DB, Hash;
use Concerto\Http\Requests;
use Concerto\Http\Controllers\Controller;


class BddController extends Controller
{
    /**
     * Manual seeding of database
     *
     * @return View with validation seeding
     */    
    function store() {
        $verif = DB::table('admins')->get();
        if (empty($verif)) {
            $login = "user@codepi.com";
            $password = Hash::make('pwd2015');
            DB::table('admins')->insert(['login' => $login, 'password' => addslashes($password)]);
        }

        $verif = DB::table('concerts')->get();
        if (empty($verif)) {
            $akhi = file_get_contents("../resources/assets/concerts.csv");
            $subject = str_replace("\n", ",", $akhi);
            $explode = explode(',', $subject);
            $tabs = array_chunk($explode, 6);
            for ($i=0;$i<count($tabs);$i++) {
                $tabs[$i]['artiste'] = $tabs[$i][0];
                $tabs[$i]['lieu'] = $tabs[$i][1];
                $tabs[$i]['adresse'] = $tabs[$i][2];
                $tabs[$i]['ville'] = $tabs[$i][3];
                $tabs[$i]['date'] = $tabs[$i][4];
                $tabs[$i]['prix'] = $tabs[$i][5];
                for ($a = 0; $a < count($tabs[$i]); $a++) {
                    unset($tabs[$i][$a]);
                }
            }
            DB::table('concerts')->insert($tabs);
        }
        $verif = DB::table('artistes')->get();
        if (empty($verif)) {
            $akhi = file_get_contents("../resources/assets/artistes.csv");
            $explode = explode("\n", $akhi);
            $tabs = [];
            for ($i = 0; $i < count($explode); $i++) {
                $tab = explode(";", $explode[$i]);
                $tabs[$i]['nom'] = $tab[0];
                $tabs[$i]['description'] = $tab[1];
                $tabs[$i]['image'] = $tab[2];
                $tabs[$i]['tags'] = $tab[3];
            }
            DB::table('artistes')->insert($tabs);
        }

        return "La base de donnée est fonctionnelle.";
    }
}
