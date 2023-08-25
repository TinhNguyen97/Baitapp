<?php

namespace App\Http\Controllers;

use App\Models\Infors;
use App\Services\Info\InfoServiceInterface;
use Illuminate\Http\Request;

class InfoController extends Controller
{
    private $infoService;
    public function __construct(InfoServiceInterface $infoService)
    {
        $this->infoService = $infoService;
    }
    public function index()
    {
        $infor = $this->infoService->find(3);
        return view('info.index', ['infor' => $infor]);
    }
    public function add(Request $request)
    {
        $this->infoService->create($request->all());
        return back()->with(['addsuccess' => true]);
    }
    public function update(Request $request, $id)
    {
        $infor = $this->infoService->find($id);
        abort_unless($infor, 404);
        $this->infoService->update($request->all(), $id);
        return back()->with(['addsuccess' => true]);
    }
}
