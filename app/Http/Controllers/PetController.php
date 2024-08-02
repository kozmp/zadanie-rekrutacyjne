<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PetController extends Controller
{
    private $baseUrl = 'https://petstore.swagger.io/v2';
    private $headers = ['api_key' => 'kozmp'];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Pobieranie listy zwierząt (zakładając, że API ma takie endpoint)
        $response = Http::withHeaders($this->headers)->get($this->baseUrl . '/pet/findByStatus', [
            'status' => 'available'
        ]);

        $pets = $response->json();
        
        return view('pets.index', compact('pets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Formularz do stworzenia nowego zwierzaka
        return view('pets.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Dodawanie nowego zwierzaka
        $response = Http::withHeaders($this->headers)->post($this->baseUrl . '/pet', [
            'id'       => $request->id,
            'category' => ['id' => $request->category_id, 'name' => $request->category_name],
            'name'     => $request->name,
            'photoUrls'=> explode(',', $request->photoUrls),
            'tags'     => array_map(function($tag) { return ['name' => trim($tag)]; }, explode(',', $request->tags)),
            'status'   => $request->status
        ]);

        if ($response->successful()) {
            return redirect()->route('pets.index')->with('success', 'Pet added successfully');
        } else {
            return redirect()->back()->with('error', 'Failed to add pet');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Pobieranie detali zwierzaka
        $response = Http::withHeaders($this->headers)->get($this->baseUrl . '/pet/' . $id);
        
        if ($response->successful()) {
            $pet = $response->json();
            return view('pets.show', compact('pet'));
        } else {
            return redirect()->route('pets.index')->with('error', 'Pet not found');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Formularz do edycji zwierzaka
        $response = Http::withHeaders($this->headers)->get($this->baseUrl . '/pet/' . $id);
        
        if ($response->successful()) {
            $pet = $response->json();
            return view('pets.edit', compact('pet'));
        } else {
            return redirect()->route('pets.index')->with('error', 'Pet not found');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Aktualizowanie zwierzaka
        $response = Http::withHeaders($this->headers)->put($this->baseUrl . '/pet', [
            'id'       => $id,
            'category' => ['id' => $request->category_id, 'name' => $request->category_name],
            'name'     => $request->name,
            'photoUrls'=> explode(',', $request->photoUrls),
            'tags'     => array_map(function($tag) { return ['name' => trim($tag)]; }, explode(',', $request->tags)),
            'status'   => $request->status
        ]);

        if ($response->successful()) {
            return redirect()->route('pets.index')->with('success', 'Pet updated successfully');
        } else {
            return redirect()->back()->with('error', 'Failed to update pet');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Usuwanie zwierzaka
        $response = Http::withHeaders($this->headers)->delete($this->baseUrl . '/pet/' . $id);
        
        if ($response->successful()) {
            return redirect()->route('pets.index')->with('success', 'Pet deleted successfully');
        } else {
            return redirect()->route('pets.index')->with('error', 'Failed to delete pet');
        }
    }
}