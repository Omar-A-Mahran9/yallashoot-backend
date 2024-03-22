<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DropzoneController extends Controller
{
    public function validateImage(Request $request)
    {
  
        $request->validate([
            'file' => 'required|mimes:jpeg,jpg,png,gif,svg|max:2096'
        ]);

        return response('image validation complete');
    }
}
