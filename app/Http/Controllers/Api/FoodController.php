<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Food;
use App\Traits\FileTrait;

class FoodController extends Controller
{
    const DEFAULT_PATH = 'foods';

    use FileTrait;

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
            'description' => 'required',
            'gambar' => 'image|mimes:jpg,jpeg,png'
        ]);

        if ($request->hasFile('gambar')) {

            // Getting File
            $file = $request->file('gambar');

            //Custom Name
            $filename = time() . '.' . $file->getClientOriginalExtension();

            // Path
            $filepath = self::DEFAULT_PATH . '/' . $filename;

            //Upload Using s3
            $this->storeFile($filepath, file_get_contents($file));

            // Image Url
            $url = $this->showFile($filepath);
        }
        
        // Creating Food
        $food = Food::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'gambar' => $url,
            'path' => $filepath,
        ]);

        return response()->json($food);
    }

    public function update(Request $request, $id)
    {   
        $food = Food::where('id', $id)->first();

        if ($request->hasFile('gambar')) {

            // Deleting Old Picture
            $this->deleteFile($food->path);

            // Getting File
            $file = $request->file('gambar');

            //Custom Name
            $filename = time() . '.' . $file->getClientOriginalExtension();

            // Path
            $filepath = self::DEFAULT_PATH . '/' . $filename;

            //Upload Using s3
            $this->storeFile($filepath, file_get_contents($file));

            // Image Url
            $url = $this->showFile($filepath);
        }

        // Updating Food
        $food->update([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'gambar' => $url,
            'path' => $filepath,
        ]);

        return response("Data Berhasil diupdate");
    }

    public function delete($id)
    {   
        Food::where('id', $id)->delete($id);

        return response("Data Berhasil dihapus");
    }
}