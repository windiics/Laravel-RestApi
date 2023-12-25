<?php

namespace App\Http\Controllers;

use App\Models\mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class mahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = mahasiswa::orderBy('name', 'asc')->get();
        return response()->json([
            'status' => true,
            'message' => 'data ditemukan',
            'data' => $data
        ],200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            "name"      => ['required'],
            "address"    => ['required']
        ];
    
        $validated = Validator::make($request->all(),$rules);
        if($validated->fails()) {
            return response()->json([
                "status"    => 401,
                "errors"    => $validated->errors()
            ]);
        }
    
        $mahasiswa = mahasiswa::create([
            'name' => $request->input('name'),
            'address' => $request->input('address'),
        ]);
    
        return response()->json([
            'message' => 'Mahasiswa berhasil dibuat',
            'student' => $mahasiswa
            ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $mahasiswa = mahasiswa::find($id);
        if (!$mahasiswa) {
            return response()->json([
                'message' => 'Mahasiswa tidak ditemukan'
            ], 401);
        }
        return response()->json(['data' => $mahasiswa]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $mahasiswa = mahasiswa::find($id);

        if (!$mahasiswa) {
            return response()->json([
                'message' => 'Mahasiswa tidak ditemukan'
            ], 401);
        }

        $this->validate($request, [
            'name' => 'required',
            'address' => 'required',
        ]);

        $mahasiswa->name = $request->input('name');
        $mahasiswa->address = $request->input('address');
        $mahasiswa->save();

        return response()->json([
            'message' => 'Mahasiswa berhasil diperbarui',
            'student' => $mahasiswa
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $mahasiswa = mahasiswa::find($id);
    
        if (!$mahasiswa) {
            return response()->json([
                'message' => 'Mahasiswa tidak ditemukan'
            ], 401);
        }
    
        $mahasiswa->delete();
    
    return response()->json([
            'message' => 'Mahasiswa berhasil dihapus'
        ], 200);
    }
}
