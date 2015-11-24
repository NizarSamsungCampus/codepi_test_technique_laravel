<?php

namespace Concerto\Http\Controllers;

use Illuminate\Http\Request;
use Concerto\Concert;
use Concerto\Http\Requests;
use Concerto\Http\Controllers\Controller;
use DB, Session;
use Response;
use Illuminate\Support\Facades\Validator;
use Input, Hash, Auth;
use Illuminate\Support\Facades\Redirect;

class ConcertsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return return home of the applicatoin
     */
    public function index()
    {
        $concerts = DB::table('concerts')->leftJoin('artistes', 'concerts.artiste', '=', 'artistes.nom')->paginate(9);
        return view('home.home')->with('concerts', $concerts);
    }

    public function show($id)
    {

        $concert = DB::table('concerts')->where('id_concert', '=', $id)->leftJoin('artistes', 'concerts.artiste', '=', 'artistes.nom')->get();
        return view('home.infoconcert')->with('data', $concert);
    }
    /**
     * Display a listing of the resource with filters.
     *
     * @return Return a view with results of user's search.
     */
    public function test() {
        return Response::json("akhi");
    }

    public function search(Request $request) {
        $ville = $request->input('ville');
        $tags = $request->input('tags');
        $prix = $request->input('prix');
        $akhi = new Concert;
        $result = $akhi->newQuery()->leftJoin('artistes', 'concerts.artiste', '=', 'artistes.nom');
        if (!empty($ville)) 
            $result->where('ville', '=', $ville);

        if (!empty($prix)) {
            if ($prix == "<20")
                $result->where('prix', '<=', 20);

            if ($prix == "20-30")
                $result->whereBetween('prix',[20, 30]);

            if ($prix == "<50")
                $result->where("prix", '<=', 50);
        }
        if (!empty($tags)) {
            $result->where('artistes.tags', '=', $tags);
        }
        $data = $result->paginate(9);
        Session::put('search', $data);

        return Response::json($data);
    }
}
