<?php

namespace App\Http\Controllers;

use App\Models\Office;
use Illuminate\Filesystem\FilesystemServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OfficeController extends Controller
{
    public function store(Request $request)
    {
        $filename = $request->file('photo')->getClientOriginalName();

        // TASK: Upload the file "photo" so it would be written as
        //   storage/app/public/offices/[original_filename]

        Storage::disk('public')->putFileAs('offices', $request->file('photo'), $filename);

        Office::create([
            'name' => $request->name,
            'photo' => $filename,
        ]);

        return 'Success';
    }

    public function show(Office $office)
    {
        return view('offices.show', compact('office'));
    }
}
