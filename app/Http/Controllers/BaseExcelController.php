<?php

namespace App\Http\Controllers;

use App\Imports\BaseExcelImport;
use App\Models\BaseExcel;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class BaseExcelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->has('date')) {
            $date = $request->date;
        } else {
            $date = now();
        }

        $bases = BaseExcel::where('user_id', auth()->user()->id)->where('date_import', $date)->paginate(50);

        return view('comparar/index', compact('bases'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('comparar/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            "file.*" => "required|mimes:xls|max:2048",
        ]);

        Excel::import(new BaseExcelImport, $$data['file']);

        return redirect(route('comparar.index'))->banner('Se importa la planilla base');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BaseExcel  $baseExcel
     * @return \Illuminate\Http\Response
     */
    public function show(BaseExcel $baseExcel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BaseExcel  $baseExcel
     * @return \Illuminate\Http\Response
     */
    public function edit(BaseExcel $baseExcel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BaseExcel  $baseExcel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BaseExcel $baseExcel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BaseExcel  $baseExcel
     * @return \Illuminate\Http\Response
     */
    public function destroy(BaseExcel $baseExcel)
    {
        //
    }
}
