<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Managers\UserManager;
use App\Managers\RoleManager;

class AuthentificationController extends Controller
{
    protected $userManager;
    protected $roleManager;

    public function __construct(UserManager $userManager, RoleManager $roleManager)
    {
        $this->userManager = $userManager;
        $this->roleManager = $roleManager;
    }

    /**
     * Login
     * 
     * @param Request $request
     * @return JSONResponse - Json
     * 
     * @OA\Post(
     *     path="/api/login",
     *     description="Login",
     *     tags={"AUTH"},
     * 
     *     @OA\RequestBody(
     *         required=true,
     *         description="Identifiants",
     * 
     *         @OA\JsonContent(
     *             required={"email, password"},
     * 
     *             @OA\Property(
     *                 property="email",
     *                 type="string"
     *             ),
     *         
     *             @OA\Property(
     *                 property="password",
     *                 type="string"
     *             )
     *         )
     *     ),
     * 
     *     @OA\Response(response="200", description="Utilisateur connecté & token")
     * )
     */
    public function login(Request $request)
    {
        try {

            //Validations
            $validateUser = Validator::make($request->all(),
            [
                'email' => 'required|email',
                'password' => 'required|max:255'
            ]);

            //Vérification des validations
            if($validateUser->fails()){

                return $this->sendError('validation error', $validateUser->errors(), 401);
            }

            //Recherche d'un email d'utilisateur (envoyé dans la requête) dans la base de données
            $user = User::where('email', $request['email'])->first();

            //Si un utilisateur existe pour cet email
            if ($user) {

                //Déclaration d'un objet composé des informations de connexions (envoyées dans la requête)
                $requestCredentials = [
                    'email' => $request['email'],
                    'password' => $request['password']
                ];

                //Si l'utilisateur n'a pas fournis les bonnes informations de connexion
                if(!Auth::attempt($requestCredentials)){

                    return $this->sendError('Les identifiants sont invalides', [], 401);
                }

                return $this->sendResponse($user->createToken("API TOKEN")->plainTextToken, 'Connecté');
            }
            else {

                return $this->sendError('Les identifiants sont invalides', [], 401);
            }

        }
        catch (\Throwable $th) {

            return $this->sendError($th->getMessage(), [], 500);
        }
    }

    /**
     * Register
     * 
     * @param Request $request
     * @return JSONResponse - Json
     * 
     * @OA\Post(
     *     path="/api/register",
     *     description="Register",
     *     tags={"AUTH"},
     *     security={{"bearerAuth": {}}},
     * 
     *     @OA\RequestBody(
     *         required=true,
     *         description="Utilisateur",
     * 
     *         @OA\JsonContent(
     *             required={"name, email, password"},
     * 
     *             @OA\Property(
     *                 property="name",
     *                 type="string"
     *             ),
     * 
     *             @OA\Property(
     *                 property="email",
     *                 type="string"
     *             ),
     *         
     *             @OA\Property(
     *                 property="password",
     *                 type="string"
     *             )
     *         )
     *     ),
     * 
     *     @OA\Response(response="200", description="Utilisateur créé")
     * )
     */
    public function register(Request $request)
    {
        //Essayer
        try {

            $request['role_id'] = 2;

            //Validations
            $validateUser = Validator::make($request->all(),
            [
                'name' => 'required|max:255',
                'email' => 'required|email',
                'password' => 'required|max:255'
            ]);

            //Vérification des validations
            if($validateUser->fails()){

                return $this->sendError('validation error', $validateUser->errors(), 401);
            }

            //Verification que l'email (envoyé en requête) de l'utilisateur n'existe pas déjà
            $userVerify = User::where('email', $request['email'])->first();

            //S'il existe
            if ($userVerify !== null)
            {
                return $this->sendError('Un compte existe déjà avec cet email', [], 409);
            }
            //Sinon
            else
            {
                //Création de l'utilisateur
                $user = $this->userManager->create($request->all());

                //Sauvegarde de l'utilisateur en base de données
                $user->save();

                return $this->sendResponse($user, 'Utilisateur créé');
            }
        }
        //Si erreur
        catch (\Throwable $th) {

            return $this->sendError($th->getMessage(), [], 500);
        }
    }

    /**
     * Generate Root Account
     * 
     * @param Request $request
     * @return JSONResponse - Json
     * 
     * @OA\Get(
     *     path="/api/generateRootAccount",
     *     description="Generate Root Account",
     *     tags={"AUTH"},
     * 
     *     @OA\Response(response="200", description="Administrateur créé")
     * )
     */
    public function root()
    {
        //Essayer
        try {

            $requestRoleAdmin = [
                'label' => 'Administrateur'
            ];

            //Création du rôle Admin
            $roleAdmin = $this->roleManager->create($requestRoleAdmin);

            //Sauvegarde du rôle Admin en base de données
            $roleAdmin->save();

            $requestRoleUtilisateur = [
                'label' => 'Utilisateur'
            ];

            //Création du rôle Utilisateur
            $roleUtilisateur = $this->roleManager->create($requestRoleUtilisateur);

            //Sauvegarde du rôle Utilisateur en base de données
            $roleUtilisateur->save();

            $request = [
                'name' => 'Admin',
                'email' => 'admin.corporation@gmail.com',
                'password' => 'AkfdhdjfFG19R463qfds!!',
                'role_id' => 1
            ];

            //Verification que l'email (envoyé en requête) de l'utilisateur n'existe pas déjà
            $userVerify = User::where('email', $request['email'])->first();

            //S'il existe
            if ($userVerify !== null)
            {
                return $this->sendError('Un compte existe déjà avec cet email', [], 409);
            }
            //Sinon
            else
            {
                //Création de l'utilisateur
                $user = $this->userManager->create($request);

                //Sauvegarde de l'utilisateur en base de données
                $user->save();

                return $this->sendResponse($user, 'Utilisateur créé');
            }
        }
        //Si erreur
        catch (\Throwable $th) {

            return $this->sendError($th->getMessage(), [], 500);
        }
    }

    /**
     * User Auth
     * 
     * @param Request $request
     * @return JSONResponse - Json
     * 
     * @OA\Get(
     *     path="/api/user",
     *     description="User Auth",
     *     tags={"AUTH"},
     *     security={{"bearerAuth": {}}},
     * 
     *     @OA\Response(response="200", description="Utilisateur actuellement connecté")
     * )
     */
    public function user(Request $request)
    {
        try {

            return $this->sendResponse($request->user(), 'Utilisateur connecté');

        }
        //Si erreur
        catch (\Throwable $th) {

            return $this->sendError($th->getMessage(), [], 500);
        }
    }

    /**
     * Logout
     * 
     * @param Request $request
     * @return JSONResponse - Json
     * 
     * @OA\Get(
     *     path="/api/logout",
     *     description="Logout",
     *     tags={"AUTH"},
     *     security={{"bearerAuth": {}}},
     * 
     *     @OA\Response(response="200", description="Utilisateur déconnecté")
     * )
     */
    public function logout(Request $request)
    {
        try {

            $request->user()->currentAccessToken()->delete();

            return $this->sendResponse([], 'Déconnecté');

        }
        //Si erreur
        catch (\Throwable $th) {

            return $this->sendError($th->getMessage(), [], 500);
        }
    }
}
