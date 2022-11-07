<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $request = request()->all();

        // Checking Request
        if(!empty($request))
        {
            // Checking searched keyword
            $data = Category::where('slug', 'like', '%' . $request['search'] . '%' )->get();
        }else{
            // Getting all data
            $data = Category::all();
        }

        return response()->json($data);
    }

    public function show($id)
    {   
        $data = Category::where('id', $id)->first();

        return response()->json($data);
    }

    public function create(Request $request)
    {   
        $this->validate($request, [
            'name' => 'required|unique:categories',
            'slug' => 'required'
        ]);

        $category = Category::create($request->all());

        return response()->json($category);
    }

    public function update(Request $request, $id)
    {   
        Category::where('id', $id)->update($request->all());

        return response("Data Berhasil diupdate");
    }

    public function delete($id)
    {   
        Category::where('id', $id)->delete($id);

        return response("Data Berhasil dihapus");
    }
}