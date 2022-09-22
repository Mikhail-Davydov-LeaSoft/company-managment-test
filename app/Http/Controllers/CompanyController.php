<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Company;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return Inertia::render('CompanyList', [
            'companies' => Company::paginate(10)
        ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
//        $visibility = Storage::getVisibility('logos/632c6514519f0.png');
        return Inertia::render('CompanyCreate');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
           'logo'   => ['image', 'dimensions:min_width=100,min_height=100'],
           'name'     => ['required', 'string'],
           'email'    => ['email', 'string'],
           'website' => ['string'],
       ]);

        $file = $request->file('logo');
        //$name = uniqid() . '.' . $file->extension();
        $name = $file->store('logos', 'public');
        $data['logo'] = $name;

        Company::create($data);

        return response()->json(['status' => true]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Inertia::render('CompanyShow', [
            'company' => Company::find($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return Inertia::render('CompanyEdit', [
            'company' => Company::find($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id): JsonResponse
    {
        $company = Company::find($id);
        $file = $request->file('logo');
        //$name = uniqid() . '.' . $file->extension();
        $name = $file->store('logos', 'public');
        $data['logo'] = $name;

        $company->update($data);

        return response()->json(['status' => true]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id): JsonResponse
    {
        $company = Company::find($id);
        $company->delete();

        return response()->json(['status' => true]);
    }
}
