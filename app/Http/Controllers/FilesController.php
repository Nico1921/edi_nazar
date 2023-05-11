<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class FilesController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Inertia\Response
     */
    public function get_kbis($file)
    {
      $path = "public/uploads/kbis/{$file}";

      if(Storage::exists($path)){
         return Storage::download($path);
      }

      abort(404);
    }

    public function delete_kbis($file)
    {
      $path = "public/uploads/kbis/{$file}";

      if(Storage::exists($path)){
         return Storage::delete($path);
      }

      abort(404);
    }

    /**
     * Display the registration view.
     *
     * @return \Inertia\Response
     */
    public function get_identiter($file)
    {
      $path = "public/uploads/identiter/{$file}";

      if(Storage::exists($path)){
         return Storage::download($path);
      }

      abort(404);
    }

    public function delete_identiter($file)
    {
      $path = "public/uploads/identiter/{$file}";

      if(Storage::exists($path)){
         return Storage::delete($path);
      }

      abort(404);
    }
}
