<?php

namespace App\Http\Controllers;

use App\Models\Annonce;
use Illuminate\Http\Request;


class AnonnceController extends Controller
{
    public function index() {
        $annonces = Annonce::all();
        if ($annonces == null) {
            return response()->json(["message" => "Aucun Annonce"], 404);
        }
        else {
            return response()->json(["success" => $annonces], 201);
        }
    }
    public function show($id) {
        $annonce = Annonce::find($id);
        if ($annonce == null) {
            return response()->json(["message" => "Aucun Annonce dont l'id ".$id], 404);
        }
        else {
            return response()->json(["success" => $annonce], 201);
        }
    }
    public function destroy($id) {
        $annonce = Annonce::find($id);
        if ($annonce == null) {
            return response()->json(["message" => "Aucun Annonce dont l'id ".$id], 404);
        }
        else {
            Annonce::destroy($id);
            return response()->json(["success" => "le Annonce dont l'id ".$id." est bien supprimer"],201);
        }
    }
    public function store(Request $request) {
        $validator = Annonce::make($request->all(),[
            'titre'=> 'required',
            'description'=> 'required',
            'photo'=>'required|image|mimes:jpg,jpeg,png,svg,gif|max:2048',
            'prix'=>'required',
            'ville'=>'required',
            'categorie'=>'required',
            'date'=>'required'
        ]);
        if ($validator->fails()) {
            return response()->json(["error" => $validator->errors()],422);
        }
        else {
            $photo = time().'.'.$request->photo->extension();  
            $request->photo->move(public_path('images'),$photo);


            $input = array(
                'titre' => $request->titre,
                'description' => $request->description,
                'photo' => 'images\\'.$photo,
                'prix' =>  $request->prix,
                'ville' =>  $request->ville,
                'categorie' =>  $request->categorie,
                'date' =>  $request->date,
            );
            $annonce = Annonce::create($input);
            return response()->json(["success" => "La Annonce est bien ajoutée", "Annonce" => $annonce], 201);
        }
    }
    public function update(Request $request, $id) {
        $annonce = Annonce::find($id);
        if ($annonce == null) {
            return response()->json(["message" => "Aucun Annonce dont l'id ".$id], 404);
        }
        else {
            $validator = Annonce::make($request->all(), [
                'nom' => 'required'
            ]);
            if ($validator->fails()) {
                return response()-json(["error" => $validator->errors()], 422);
            } else {

            $photo = time().'.'.$request->photo->extension();
            $request->photo->move(public_path('images'),$photo);


            $input = array(
                'titre' => $request->titre,
                'description' => $request->description,
                'photo' => 'images\\'.$photo,
                'prix' =>  $request->prix,
                'ville' =>  $request->ville,
                'categorie' =>  $request->categorie,
                'date' =>  $request->date,
            );

                $annonce->update($input);
                return response()->json(['success' => 'la Annonce est bien modifée', "Annonce" => $annonce], 201);
            }
        }

    }
}
