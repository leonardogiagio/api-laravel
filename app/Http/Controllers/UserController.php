<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

/**
 * @OA\Info(title="API Laravel", version="0.1")
 */


class UserController extends Controller
{

    /**
     * @OA\Get(
     *     path="/usuarios",
     *     summary="Obter todos os usuários",
     *     tags={"Usuários"},
     *     security={{ "bearerAuth": {} }},
     *     @OA\Response(
     *         response=200,
     *         description="Lista de usuários",
     *     )
     * )
     */
    public function index()
    {
        $usuarios = User::all();

        return response()->json($usuarios);
    }


    /**
     * @OA\Get(
     *     path="/api/usuarios/id",
     *     summary="Obter um usuário pelo ID",
     *     tags={"Usuários"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Dados do usuário",
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="No query results for model [App\\Models\\User] id",
     *     )
     * )
     */

    public function show($id)
    {
        $usuario = User::findOrFail($id);

        return response()->json($usuario);
    }


    /**
     * @OA\Post(
     *     path="/api/login",
     *     summary="Autenticar usuário",
     *     tags={"Autenticação"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="email",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="password",
     *                     type="string"
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Token"
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="As credenciais fornecidas estão incorretas."
     *     )
     * )
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $usuario = User::where('email', $request->email)->first();

        if (!$usuario || !Hash::check($request->password, $usuario->password)) {
            throw ValidationException::withMessages([
                'email' => ['As credenciais fornecidas estão incorretas.'],
            ]);
        }

        $token = $usuario->createToken('token-name')->plainTextToken;

        return response()->json(['token' => $token]);
    }
}
