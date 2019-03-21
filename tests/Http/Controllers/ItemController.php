<?php

namespace Tests\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Tests\Models\Item;

class ItemController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index()
    {
        $items = Item::all();

        return response()->json($items);
    }

    public function show(Item $item)
    {
        return response()->json($item);
    }

    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'title'    => 'required',
            'password' => 'required',
        ]);

        $item = Item::create($data);

        return response()->json($item);
    }

    public function update(Request $request, Item $item)
    {
        $data = $this->validate($request, [
            'title'    => 'required',
            'password' => 'required',
        ]);

        $item->update($data);

        return response()->json($item);
    }

    public function delete(Item $item)
    {
        $item->delete();

        return response()->json([
            'message' => 'ok',
        ]);
    }
}
