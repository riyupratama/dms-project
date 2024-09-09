<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Folder;
use Illuminate\Http\Request;

class FolderController extends Controller
{
    public function index(Request $request)
    {
        $parent_id = $request->id;
        if ($parent_id) {
            // Sub folder
            $folders = Folder::where('parent_id', '=', $parent_id)->get();
            $parent = Folder::where('id', '=', $parent_id)->get();
        } else {
            // folder utama 
            $folders = Folder::where('parent_id', '=', null)->get();
            $parent = NULL;
        }
        return view('folders.folder', compact('folders', 'parent'));
    }
    
    public function create(Request $request)
    {
        if ($request->parent_id) {
            $parent_id = $request->parent_id;
            $parent = Folder::where('id', '=', $parent_id)->get()[0];
        }else{
            $parent = NULL;
        }
        return view('folders.create', compact('parent'));
        
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
        ]);
        
        $folder = new Folder;
        $folder->name = $data['name'];
        $folder->parent_id = $request['parent_id'];
        $folder->save();

        return redirect()->route('folders')->with('success', 'Folder created successfully!');
    }
}
