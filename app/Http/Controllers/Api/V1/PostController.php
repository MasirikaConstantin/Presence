<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\PostValidator;
use App\Http\Requests\Api\V1\ReactionValidator;
use App\Models\Post;
use App\Models\Reaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index() {
         // Version avec pagination (recommandée)
         $posts = Post::with(['categorie', 'type', 'user'])
         ->orderBy('created_at', 'desc')
         ->get();

         return response()->json([
            'posts' => $posts
        ]);
    }
    /**
     * Enregistrer un nouveau post
     */
    public function store(PostValidator $request)
    {

       $post =Post::create($this->extractData(new Post(), $request));

       

        return response()->json($post, 201);
    }


    private function extractData(Post $post,PostValidator $request){
        $data=$request->validated();
        //dd($data);
        /**
        * @var UploadedFile $image
         */
        $image=$request->validated('image');
        if($image==null || $image->getError()){
            return $data;
        }
        if($post->image){
            Storage::disk('public')->delete($post->image);
        }
            $data['image']=$image->store("imagePost",'public');
        return $data;
    }




public function login(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if (!Auth::attempt($request->only('email', 'password'))) {
        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    $user = $request->user();
    $token = $user->createToken('authToken')->plainTextToken;

    return response()->json([
        'access_token' => $token,
        'token_type' => 'Bearer',
    ]);
}
public function show(Post $post)
    {
        $post->load(['categorie', 'type', 'user']);
        
        return response()->json([
            'post' => $post
        ]);
    }


    public function Reaction(Post $post, ReactionValidator $request) {
        //    $request->validated();
            $user = Auth::user();
            $reactionType = request('reaction_type');
        
            // Vérifier si l'utilisateur a déjà réagi au post
            if ($user->reactions()->where('post_id', $post->id)->exists()) {
                $reactions=$user->reactions();
                $reactions->delete();
                return response()->json([
                    'reaction' => "Vous avez annuler votre Réaction à ce Post"
                ]);
                
            } else {
                // Enregistrer la réaction dans la base de données
                $reaction = new Reaction();
                $reaction->user_id = $user->id;
                $reaction->post_id = $post->id;
                $reaction->reaction= $request->validated('reaction');
                $react =$reaction->save();
        }
            return response()->json([
                'reaction' => $react
            ]);
        }


}
