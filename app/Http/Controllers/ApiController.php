<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ApiController extends Controller
{
    public function index()
    {
        $response = Http::get('http://127.0.0.1:8080/api/category');
        if ($response->successful()) {
            $jsonData = $response->json();

            return view('category-show', ['categories' => $jsonData]);
        } else {
            return view('category-show', ['error' => 'Failed to fetch categories']);
        }
    }
    public function store(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        try {
            $response = Http::post('http://127.0.0.1:8080/api/category-store', [
                'name' => $request->name,
            ]);
            if ($response->failed()) {
                dd($response->status());
            }
            if ($response->successful()) {
                return redirect()->back()->with('success', 'Category added successfully!');
            } else {
                return redirect()->back()->with('error', 'Failed to add category. ' . $response->body());
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    public function edit($id,Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        try {
            $response = Http::post('http://127.0.0.1:8080/api/category-update/'.$id, [
                'name' => $request->name,
            ]);
            if ($response->failed()) {
                dd($response->status());
            }
            if ($response->successful()) {
                return redirect()->back()->with('success', 'Category Update successfully!');
            } else {
                return redirect()->back()->with('error', 'Failed to Update category. ');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    public function destroy($id){
        try {
            $response = Http::post('http://127.0.0.1:8080/api/category-delete/'.$id);
            if ($response->failed()) {
                dd($response->status());
            }
            if ($response->successful()) {
                return redirect()->back()->with('success', 'Category Delete successfully!');
            } else {
                return redirect()->back()->with('error', 'Failed to Delete category. ' . $response->body());
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
}
