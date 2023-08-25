<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\Statistical;
use App\Models\Statisticals;
use App\Services\Statistical\StatisticalServiceInterface;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatisticalController extends Controller
{
    private $statisticalService;
    public function __construct(StatisticalServiceInterface $statisticalService)
    {
        $this->statisticalService = $statisticalService;
    }
    public function index()
    {

        $statisticals = $this->statisticalService->all();
        return view('statisticals.index', ['statisticals' => $statisticals]);
    }
}
