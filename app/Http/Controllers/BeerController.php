<?php

namespace App\Http\Controllers;

use App\Models\Brewery;
use Inertia\Inertia;

class BeerController extends Controller
{
    public function index($id)
    {
        $brewery = Brewery::find($id);

        $beers = $brewery->beers()->paginate(4);

        return Inertia::render('Beers', ['brewery' => $brewery, 'beers' => $beers]);
    }
}
