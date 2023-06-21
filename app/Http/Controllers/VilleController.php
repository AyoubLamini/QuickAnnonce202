<?php

namespace App\Http\Controllers;

use App\Models\Ville;
use Illuminate\Http\Request;;

class VilleController extends Controller
{
    public function index() {
        $villes = Ville::all();
        if ($villes == null) {
            return response()->json(["message" => "Aucun ville"], 404);
        }
        else {
            return response()->json(["success" => $villes], 201);
        }
    }
    public function show($id) {
        $ville = Ville::find($id);
        if ($ville == null) {
            return response()->json(["message" => "Aucun ville dont l'id ".$id], 404);
        }
        else {
            return response()->json(["success" => $ville], 201);
        }
    }
    public function destroy($id) {
        $ville = Ville::find($id);
        if ($ville == null) {
            return response()->json(["message" => "Aucun ville dont l'id ".$id], 404);
        }
        else {
            Ville::destroy($id);
            return response()->json(["success" => "le ville dont l'id ".$id." est bien supprimer"], 201);
        }
    }
    public function store(Request $request) {
        $validator = Ville::make($request->all(),[
            "nom"=>"required",
        ]);
        if ($validator->fails()) {
            return response()->json(["error" => $validator->errors()],422);
        }
        else {
            $input = $request->all();
            $ville = Ville::create($input);
            return response()->json(["success" => "La ville est bien ajoutée", "ville" => $ville], 201);
        }
    }
    public function update(Request $request, $id) {
        $ville = Ville::find($id);
        if ($ville == null) {
            return response()->json(["message" => "Aucun ville dont l'id ".$id], 404);
        }
        else {
            $validator = Ville::make($request->all(), [
                'nom' => 'required'
            ]);
            if ($validator->fails()) {
                return response()-json(["error" => $validator->errors()], 422);
            } else {
                $input = $request->all();
                $ville->update($input);
                return response()->json(['success' => 'la ville est bien modifée', "ville" => $ville],201);
            }
        }

    }
}



