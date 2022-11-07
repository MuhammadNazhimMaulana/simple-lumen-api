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
        $request = request()->all();

        // Search Category
        $searchCategory = $request['category'];

        // Checking Request
        if(!empty($request))
        {
            // Checking searched keyword
            $data = Food::whereHas('category', function($query) use ($searchCategory){
                $query->where('slug', 'like', '%'.$searchCategory.'%');
            })->get();
        }else{
            // Getting all data
            $data = Food::all();
        }

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
        $food = Food::where('id', $id)->first();
        
        // Deleting File from s3
        $this->deleteFile($food->path); 

        // Deleting Data
        $food->delete($id);

        return response("Data Berhasil dihapus");
    }
}