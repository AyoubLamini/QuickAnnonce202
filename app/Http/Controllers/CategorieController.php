<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    public function index() {
        $categories = Categorie::all();
        if ($categories == null) {
            return response()->json(["message" => "Aucun Categorie"], 404);
        }
        else {
            return response()->json(["success" => $categories], 201);
        }
    }
    public function show($id) {
        $categorie = Categorie::find($id);
        if ($categorie == null) {
            return response()->json(["message" => "Aucun Categorie dont l'id ".$id], 404);
        }
        else {
            return response()->json(["success" => $categorie], 201);
        }
    }
    public function destroy($id) {
        $categorie = Categorie::find($id);
        if ($categorie == null) {
            return response()->json(["message" => "Aucun Categorie dont l'id ".$id], 404);
        }
        else {
            Categorie::destroy($id);
            return response()->json(["success" => "le categorie dont l'id ".$id." est bien supprimer"], 201);
        }
    }
    public function store(Request $request) {
        $validator = Categorie::make($request->all(),[
            "nomcat"=>"required",
            "libelle"=>"required",
        ]);
        if ($validator->fails()) {
            return response()->json(["error" => $validator->errors()],422);
        }
        else {
            $input = $request->all();
            $categorie = Categorie::create($input);
            return response()->json(["success" => "La categorie est bien ajoutée", "categorie" => $categorie], 201);
        }
    }
    public function update(Request $request, $id) {
        $categorie = Categorie::find($id);
        if ($categorie == null) {
            return response()->json(["message" => "Aucun categorie dont l'id ".$id], 404);
        }
        else {
            $validator = Categorie::make($request->all(), [
                'nom' => 'required'
            ]);
            if ($validator->fails()) {
                return response()-json(["error" => $validator->errors()], 422);
            } else {
                $input = $request->all();
                $categorie->update($input);
                return response()->json(['success' => 'la categorie est bien modifée', "categorie" => $categorie], 201);
            }
        }

    }
}
