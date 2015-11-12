<?php 
$akhi = DB::table('concerts')->select('ville')->where('ville', '!=', '')->distinct()->get();
$villes = [];
foreach ($akhi as $info) {
    $villes[$info->ville] = $info->ville;
}
$trierTags = DB::table('artistes')->select('tags')->where('tags', '!=', '')->distinct()->get();
$tags = [];
foreach ($trierTags as $info) {
    $tags[$info->tags] = $info->tags;
}

$prix = ['<20' => 'Moins de 20€', '20-30' => 'Entre 20€ et 30€', '>30' => 'Moins de 50€'];

if (isset($concerts)) {
    $filterville = null;
    $filtertags = null;
    $filterprix = null;
    if (Input::get('filterville') != "")
        $filterville = Input::get('filterville');

    if (Input::get('filtertags') != "")
        $filtertags = Input::get('filtertags');

    if (Input::get('filterprix') != "")
        $filterprix = Input::get('filterprix');
}
?>