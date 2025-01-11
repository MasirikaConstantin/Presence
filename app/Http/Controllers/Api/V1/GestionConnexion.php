<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ImageVAlidate;
use App\Http\Resources\UserRessource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Utilisateur;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class GestionConnexion extends Controller
{
    public function register(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:4|confirmed',
                "lieu_id" => "required|exists:lieus,id",
                "categorie_id" => "required|exists:categories,id",
                "address"=>"nullable|min:5",
                'image'=> ["nullable",'max:5120', 'mimes:png,jpg,jpeg,gif,PNG,JPEG,JPG'],

                

            ]);

            $user = Utilisateur::create([
                'name' => $validated['name'],
                'lieu_id' => $validated['lieu_id'],
                'address' => $validated['address'],
                'categorie_id' => $validated['categorie_id'],
                'email' => $validated['email'],
                'image' => $validated['image'],
                'password' => Hash::make($validated['password']),
            ]);

            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'message' => 'Utilisateur créé avec succès',
                'user' => $user,
                'access_token' => $token,
                'token_type' => 'Bearer',
            ], 201);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Erreur de validation',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Une erreur est survenue',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function login(Request $request)
{
    try {
        $validated = $request->validate([
            'matricule' => 'required|string',
            'password' => 'required',
        ]);

        // Récupérer l'utilisateur par son matricule
        $user = Utilisateur::where('matricule', $validated['matricule'])->first();

        if (!$user || !Hash::check($validated['password'], $user->password)) {
            return response()->json([
                'message' => 'Identifiants invalides'
            ], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Connexion réussie',
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $user,
        ]);
    } catch (ValidationException $e) {
        return response()->json([
            'message' => 'Erreur de validation',
            'errors' => $e->errors()
        ], 422);
    } catch (\Exception $e) {
        return response()->json([
            'message' => 'Une erreur est survenue',
            'error' => $e->getMessage()
        ], 500);
    }
}

    public function logout(Request $request)
    {
        try {
            $request->user()->tokens()->delete();
            return response()->json([
                'message' => 'Déconnexion réussie'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Une erreur est survenue',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request)
{
    try {
        // Récupérer l'utilisateur authentifié
        $utilisateur = $request->user();

        // Valider les données de la requête
        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'address' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:utilisateurs,email,' . $utilisateur->id, // Utilisez 'utilisateurs' comme nom de table
            'password' => 'sometimes|min:6|confirmed',
            'image' => ['nullable', 'max:5120', 'mimes:png,jpg,jpeg,gif,PNG,JPEG,JPG'],
        ]);

        // Préparer les données à mettre à jour
        $updateData = [];
        if (isset($validated['name'])) $updateData['name'] = $validated['name'];
        if (isset($validated['address'])) $updateData['address'] = $validated['address'];
        if (isset($validated['email'])) $updateData['email'] = $validated['email'];
        if (isset($validated['password'])) {
            $updateData['password'] = Hash::make($validated['password']);
        }

        // Mettre à jour l'utilisateur
        $utilisateur->update($updateData);

        // Retourner une réponse JSON
        return response()->json([
            'message' => 'Profil mis à jour avec succès',
            'user' => $utilisateur
        ]);
    } catch (ValidationException $e) {
        // Gérer les erreurs de validation
        return response()->json([
            'message' => 'Erreur de validation',
            'errors' => $e->errors()
        ], 422);
    } catch (\Exception $e) {
        // Gérer les autres erreurs
        return response()->json([
            'message' => 'Une erreur est survenue',
            'error' => $e->getMessage()
        ], 500);
    }
}

    public function delete(Request $request)
    {
        try {
            $user = $request->user();
            $user->tokens()->delete();
            $user->delete();

            return response()->json([
                'message' => 'Compte supprimé avec succès'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Une erreur est survenue',
                'error' => $e->getMessage()
            ], 500);
        }
    }





    /*
        private function extractData(Astuce $astuce,Astucesrequest $request){
        $data=$request->validated();
        //dd($data);
        /**
        * @var UploadedFile $image
         */
       /* $image=$request->validated('image');
        if($image==null || $image->getError()){
            return $data;
        }
        if($astuce->image){
            Storage::disk('public')->delete($astuce->image);
        }
            $data['image']=$image->store("imageastuces",'public');
        return $data;
        }
    */

    public function updatePassword(Request $request)
    {
        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => ['required', 'current_password'],
            'password' => ['required','sometimes','min:4', 'confirmed'],
        ]);

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        return response()->json([
            'success' => true,
        ]);
    }

    public function imagedeledata(Utilisateur $user)
    {
        try {
            if ($user->image) {
                // Extraire le chemin relatif de l'URL complète
                $relativePath = str_replace(env('APP_URL') . '/storage/', '', $user->getRawOriginal('image'));
                
                // Supprimer le fichier physique
                if (Storage::disk('public')->exists($relativePath)) {
                    Storage::disk('public')->delete($relativePath);
                }
    
                // Mettre à null le champ image dans la BDD
                $user->image = null;
                $user->save();
    
                return response()->json([
                    'status' => true,
                    'message' => 'Image supprimée avec succès',
                    'user' => new UserRessource($user)
                ], 200);
            }
    
            return response()->json([
                'status' => false,
                'message' => 'Aucune image à supprimer'
            ], 404);
    
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Erreur lors de la suppression : ' . $e->getMessage()
            ], 500);
        }
    }

    public function updateImage(Utilisateur $user,ImageVAlidate $request)
    {
       
        $user->update($this->extractData($user ,$request));
        

        return new UserRessource($user);
    }
    private function extractData(Utilisateur $user,  Request $request){

        $validated =$request->validate([
            'image'=> ["nullable",'max:5120', 'mimes:png,jpg,jpeg,gif,PNG,JPEG,JPG'],

        ]);
        $data=[
            'image' => $validated['image'] ?? '',
        ];
        //dd($data);
        /**
        * @var UploadedFile $image
         */
        $image=$data['image'];
        if($image==null || $image->getError()){
            return $data;
        }
        if($user->image){
            Storage::disk('public')->delete($user->image);
        }
            $data['image']=$image->store("profil",'public');
        return $data;
    }
}