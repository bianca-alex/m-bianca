<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\File;

class FileUploadController extends Controller
{
    //
    public function index()
    {
        return view('files.index');
    }

    public function list()
    {
        $files = File::all();
        return view('files.list', compact('files'));
    }

    public function upload(Request $request)
    {
        $file = $request->file('file');
        $extName = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $path = $file->store('local');
        $path = explode('/', $path)[1];
        File::create([
            'name' => $extName,
            'path' => $path,
            'ext' => $extension,
        ]);
        return redirect()->route('file.list');
    }

    public function download(Request $request)
    {
        $filename = $request->input('filename');
        $path = storage_path('app/local/' . $filename);
        return response()->download($path, $filename);
    }

    public function delete(Request $request)
    {
        $id = $request->input('id');
        File::destroy($id);
        return redirect()->route('file.list');
    }
}
