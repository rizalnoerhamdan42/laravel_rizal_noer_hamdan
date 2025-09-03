<?php
namespace App\Http\Controllers;
use App\Models\Hospital;
use Illuminate\Http\Request;

class HospitalController extends Controller
{
    public function __construct() { $this->middleware('auth'); }

    public function index() {
        $hospitals = Hospital::orderBy('name')->get();
        return view('hospitals.index', compact('hospitals'));
    }

    public function create() { return view('hospitals.create'); }



    public function validateInput(Request $request, $id = null)
    {
        return $request->validate([
            'hospital_code' => 'required|unique:hospitals,hospital_code,' . ($id ?? 'NULL') . ',id',
            'name'          => 'required|unique:hospitals,name,' . ($id ?? 'NULL') . ',id',
            'address'       => 'required|unique:hospitals,address,' . ($id ?? 'NULL') . ',id',
            'email'         => 'required|email|unique:hospitals,email,' . ($id ?? 'NULL') . ',id',
            'phone'         => 'required|unique:hospitals,phone,' . ($id ?? 'NULL') . ',id',
        ], [
            'hospital_code.required' => 'Kode Rumah Sakit wajib diisi.',
            'hospital_code.unique'   => 'Kode Rumah Sakit sudah terdaftar, silakan gunakan kode lain.',

            'name.required' => 'Nama Rumah Sakit wajib diisi.',
            'name.unique'   => 'Nama Rumah Sakit sudah terdaftar, silakan gunakan nama lain.',

            'address.required' => 'Alamat wajib diisi.',
            'address.unique'   => 'Alamat sudah terdaftar, silakan gunakan alamat lain.',

            'email.required' => 'Email wajib diisi.',
            'email.email'    => 'Format email tidak valid.',
            'email.unique'   => 'Email sudah terdaftar, silakan gunakan email lain.',

            'phone.required' => 'Nomor telepon wajib diisi.',
            'phone.unique'   => 'Nomor telepon sudah terdaftar, silakan gunakan nomor lain.',
        ]);
    }


    public function store(Request $request)
    {
        $this->validateInput( $request);
        Hospital::create($request->all());

        return redirect()->route('hospitals.index')->with('success','Rumah sakit berhasil ditambahkan.');
    }


    public function edit(Hospital $hospital) { return view('hospitals.edit', compact('hospital')); }

    public function update(Request $request, $id)
    {
        $hospital = Hospital::findOrFail($id);

         $this->validateInput($request, $hospital->id); 
        $hospital->update($request->all());

        return redirect()->route('hospitals.index') ->with('success', 'Data  '.$request->name.' berhasil diperbarui.');

    }


    public function destroy($id)
    {
        $hospital = Hospital::findOrFail($id);
        $hospital->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data Rumah Sakit berhasil dihapus.'
        ]);
    }
}