<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Helpers\Metavis;
use Illuminate\Http\Request;

class FileController extends Controller
{
    public function manager()
    {
        return Metavis::lyna('admin.file.manager');
    }

    public function fortinymce()
    {
        return view('admin.file.tinymce5');
    }
}
