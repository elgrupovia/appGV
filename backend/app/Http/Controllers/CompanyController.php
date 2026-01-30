<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $companies = Company::latest()->paginate(10);
        // Asume que tienes una vista en: resources/views/companies/index.blade.php
        return view('layouts.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Asume que tienes una vista en: resources/views/companies/create.blade.php
        return view('layouts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'sector' => 'required|string|max:255',
            'phone' => 'required|string|max:50',
            'email' => 'required|email|max:255|unique:companies,email',
            'website' => 'nullable|string|max:255',
            'logo' => 'nullable|image|max:2048',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'province' => 'required|string|max:255',
        ]);

        if ($request->hasFile('logo')) {
            $validatedData['logo'] = $request->file('logo')->store('logos', 'public');
        }

        Company::create($validatedData);

        return redirect()->route('companies.index')->with('success', 'Empresa creada correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        // Carga la relación con los usuarios para mostrarla en la vista de detalles
        $company->load('users');
        return view('layouts.show', compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company)
    {
        // Asume que tienes una vista en: resources/views/companies/edit.blade.php
        return view('layouts.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Company $company)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'sector' => 'required|string|max:255',
            'phone' => 'required|string|max:50',
            'email' => 'required|email|max:255|unique:companies,email,'.$company->id,
            'website' => 'nullable|string|max:255',
            'logo' => 'nullable|image|max:2048',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'province' => 'required|string|max:255',
        ]);

        if ($request->hasFile('logo')) {
            if ($company->logo && Storage::disk('public')->exists($company->logo)) {
                Storage::disk('public')->delete($company->logo);
            }
            $validatedData['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $company->update($validatedData);

        return redirect()->route('companies.index')->with('success', 'Empresa actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        if ($company->logo && Storage::disk('public')->exists($company->logo)) {
            Storage::disk('public')->delete($company->logo);
        }
        
        $company->delete();

        return redirect()->route('companies.index')->with('success', 'Empresa eliminada correctamente.');
    }
}