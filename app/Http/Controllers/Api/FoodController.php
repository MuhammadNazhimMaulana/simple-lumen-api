<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Food;

class FoodController extends Controller
{
    public function index()
    {
        $data = Food::all();

        // Using map to change returned value
        $new_data = $data->map(function ($item, $key) {
            // Showing Category
            $item->category;
            return $item;
        });

        return response()->json($new_data);
    }

    public function show($id)
    {   
        $data = Food::where('id', $id)->with('category')->first();

        return response()->json($data);
    }

    public function create(Request $request)
    {   
        $this->validate($request, [
            'name' => 'required|unique:foods',
            'category_id' => 'required',
            'description' => 'required'
        ]);

        $Food = Food::create($request->all());

        return response()->json($Food);
    }

    public function update(Request $request, $id)
    {   
        Food::where('id', $id)->update($request->all());

        return response("Data Berhasil diupdate");
    }

    public function delete($id)
    {   
        Food::where('id', $id)->delete($id);

        return response("Data Berhasil dihapus");
    }
}