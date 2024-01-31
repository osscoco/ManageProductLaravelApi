<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Managers\ProductManager;

class ProductController extends Controller
{
    protected $productManager;

    public function __construct(ProductManager $productManager)
    {
        $this->productManager = $productManager;
    }

    public function index()
    {
        return $this->sendResponse(Product::all(), 'Produits récupérés');
    }

    public function store(Request $request)
    {
        return $this->sendResponse($this->cardManager->create($request->all()), 'Produit créé');
    }

    public function show(int $id)
    {
        return $this->sendResponse(Product::findOrFail($id), 'Produit récupéré');
    }

    public function update(Request $request, int $id)
    {
        return $this->sendResponse($this->cardManager->update(Card::findOrFail($id), $request->all()), 'Produit modifié');
    }

    public function destroy(int $id)
    {
        return $this->sendResponse($this->cardManager->delete(Card::findOrFail($id)), 'Produit supprimé');
    }
}
