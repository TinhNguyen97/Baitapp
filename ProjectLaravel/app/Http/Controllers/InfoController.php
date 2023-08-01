<?php

namespace App\Http\Controllers;

use App\Models\Infors;
use Illuminate\Http\Request;

class InfoController extends Controller
{
    public function index()
    {

        $infor = Infors::where('id', 3)->get();

        return view('info.index', ['infor' => $infor]);
    }
    public function add(Request $request)
    {
        $infor = new Infors();
        $infor->info_contact = $request->contact;
        $infor->info_map = $request->map;
        $infor->save();
        return back()->with(['addsuccess' => true]);
    }
    public function update(Request $request, $id)
    {
        $infor = Infors::find($id);
        abort_unless($infor, 404);
        $infor->info_contact = $request->contact;
        $infor->info_map = $request->map;
        $infor->save();
        return back()->with(['addsuccess' => true]);
    }
}
