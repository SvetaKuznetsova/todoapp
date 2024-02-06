<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Item;

class EditItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $existingItem = Item::find($id);

        if ($existingItem && $request->item["is_completed"] != $existingItem->is_completed) {
            $existingItem->is_completed = $request->item["is_completed"] ? true : false;
            $existingItem->completed_at = $request->item["is_completed"] ? Carbon::now() : null;
            return $existingItem->save();

        } elseif ($existingItem && $request->item["name"] != $existingItem->name) {
            $existingItem->name = $request->item["name"];
            return $existingItem->save();

        } elseif ($existingItem && $request->item["sort"] != $existingItem->sort) {
            $existingItem->sort = $request->item["sort"];
            return $existingItem->save();
        }

        return "Item not found";
    }

    /**
     * Remove the specified resource from storage.
     */
    public
    function destroy(string $id)
    {
        //
    }
}
