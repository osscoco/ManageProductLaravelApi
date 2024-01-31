<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Managers\UserManager;

class UserController extends Controller
{
    protected $userManager;

    public function __construct(UserManager $userManager)
    {
        $this->userManager = $userManager;
    }

    public function index()
    {
        return $this->sendResponse(User::all(), 'Utilisateurs récupérés');
    }

    public function show(int $id)
    {
        return $this->sendResponse(User::findOrFail($id), 'Utilisateur récupéré');
    }

    public function update(Request $request, int $id)
    {
        return $this->sendResponse($this->userManager->update(User::findOrFail($id), $request->all()), 'Utilisateur modifié');
    }

    public function destroy(int $id)
    {
        return $this->sendResponse($this->userManager->delete(User::findOrFail($id)), 'Utilisateur supprimé');
    }
}
