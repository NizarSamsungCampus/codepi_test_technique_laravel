<?php

namespace Concerto\Http\Controllers;

use Illuminate\Http\Request;
use Concerto\Concert;
use Concerto\Http\Requests;
use Concerto\Http\Controllers\Controller;
use DB, Session;
use Illuminate\Support\Facades\Validator;
use Input, Hash, Auth;
use Illuminate\Support\Facades\Redirect;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource with CRUD if admin is authentified..
     *
     * @return 
     */
    public function index()
    {
        $admin = Session::get('admin');
        if (isset($admin)) {
            $concerts = DB::table('concerts')->paginate(15);
            return view('admin.home')->with('concerts', $concerts);
        } else {
            return view('admin.home')->with('concerts', null);
        }
    }
    /**
     * Verify admin access authentification
     *
     * @return Listing of resource with CRUD if authentification success
     */
    public function access() {
        $regle = array(
            'login' => 'required',
            'password' => 'required'
            );
        $validation = Validator::make(Input::all(), $regle);
        if ($validation->passes()) {
            $login = Input::get('login');
            $checkedPwd = Input::get('password');
            $checkLogin = DB::table('admins')->where('login', '=', $login)->get();
            if (!empty($checkLogin)) {
                foreach ($checkLogin as $value) {
                    $checkPwd = $value->password;
                    if (Hash::check($checkedPwd, $checkPwd)) {
                        Session::put('admin', 1);
                        return redirect('/admin');
                    } else {
                        return redirect('/admin')->with('message', "Vous avez rentré un mauvais mot de passe.");
                    }
                }
            } else {
                return view('admin.home')->with('message', "Cet identifiant n'existe pas");
            }
        }
    }
    /**
     * Display a form with the specified resource.
     *
     * @return Admin View for edit resource
     */
    public function editInterface($id) {
        $admin = Session::get('admin');
        if (isset($admin)) {
            $concert = DB::table('concerts')->where('id_concert', '=', $id)->get();
            return view('admin.edit')->with('concert', $concert);
        } else {
            return redirect('/');
        }
    }
    public function logout() {
        Session::flush();
        return redirect('/');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @return  Same view with form editing the same resource with updates.
     */
    public function edit()
    {
        $regle = array(
            'id_concert' => 'required',
            'artiste' => 'required',
            'lieu' => 'required',
            'date' => 'required|date|after:start_day',
            'adresse' => 'required',
            'heure' => 'required', 
            'minutes' => 'required',
            'ville' => 'required',
            'prix' => 'required|integer'
            );
        $validation = Validator::make(Input::all(), $regle);
        if ($validation->passes()) {
            $date = Input::get('date');
            $heure = Input::get('heure');
            $minutes = Input::get('minutes');
            $newDate = $date." ".$heure.":".$minutes.":00";
            $id_concert = Input::get('id_concert');
            $array = [
            'artiste' => Input::get('artiste'),
            'lieu' => Input::get('lieu'),
            'date' => Input::get('date'),
            'adresse' => Input::get('adresse'),
            'ville' => Input::get('ville'),
            'date' => $newDate,
            'prix' => Input::get('prix')
            ];
            DB::table('concerts')->where('id_concert', '=', $id_concert)->update($array);
            return redirect('edit/'.$id_concert);
        } else {
            return redirect('/');
        }
    }
    /**
     * return view with form to store a resource
     *
     * @return Return view
     */
    public function addInterface() {
        $admin = Session::get('admin');
        if (isset($admin)) {
            return view('admin.add');
        } else {
            return redirect('/');
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $admin = Session::get('admin');
        if (isset($admin)) {
            DB::table('concerts')->where('id_concert', '=', $id)->delete();
            return redirect('/admin');
        } else {
            return redirect('/');
        }
    }
    /**
     * Add a resource in storage
     *
     * @return Return a redirection
     */
    public function add() {
        $regle = array(
            'artiste' => 'required|string',
            'lieu' => 'required|string',
            'date' => 'required|date|after:start_day',
            'adresse' => 'required|string',
            'heure' => 'required', 
            'minutes' => 'required',
            'ville' => 'required|string',
            'prix' => 'required|integer'
            );
        $validation = Validator::make(Input::all(), $regle);
        if ($validation->passes()) {
            $date = Input::get('date');
            $akhi = date("j/m/Y", strtotime($date));
            $heure = Input::get('heure');
            $minutes = Input::get('minutes');
            $newDate = $akhi." ".$heure.":".$minutes.":00";
            $newConcert = new Concert;
            $newConcert->artiste = Input::get('artiste');
            $newConcert->lieu = Input::get('lieu');
            $newConcert->date = $newDate;
            $newConcert->adresse = Input::get('adresse');
            $newConcert->ville = Input::get('ville');
            $newConcert->prix = Input::get('prix');
            $newConcert->save();
            return view('admin.add')->with('message', "La ressource a bien été inséré en base de donnée.");
        } else {
            return view('admin.add')->with('message', "Vous devez remplir tous les champs.(Veillez a saisir un format correct pour la date et un entier pour le prix)");
        }
    }
}
