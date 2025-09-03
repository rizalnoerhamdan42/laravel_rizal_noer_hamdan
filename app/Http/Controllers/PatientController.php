<?php
namespace App\Http\Controllers;
use App\Models\Patient;
use App\Models\Hospital;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function __construct() { $this->middleware('auth'); }

    public function index(Request $request)
    {
        $hospitals = Hospital::all();
 

        $hospital_id = $request->get('hospital_id');
        $patients = $hospital_id ? Patient::with('hospital')->where('hospital_id',$hospital_id)->get()
                                 : Patient::with('hospital')->get();

        return view('patients.index', compact('patients','hospitals'));
    }



    public function filterByHospital(Request $request)
    {
        $hospital_id = $request->hospital_id;

       
        $patients = Patient::when($hospital_id, function ($query, $hospital_id) {
            return $query->where('hospital_id', $hospital_id);
        })->get();

        return view('patients.row_patients_table', compact('patients'));
    }



    public function create() {
        $hospitals = Hospital::orderBy('name')->get();
        return view('patients.create', compact('hospitals'));
    }

    public function store(Request $request) {
        $data = $request->validate([
            'name'=>'required|string|max:255',
            'address'=>'nullable',
            'phone'=>'nullable',
            'hospital_id'=>'required|exists:hospitals,id',
        ]);
        Patient::create($data);
        return redirect()->route('patients.index')->with('success','Pasien ditambahkan.');
    }

    public function edit(Patient $patient) {
        $hospitals = Hospital::orderBy('name')->get();
        return view('patients.edit', compact('patient','hospitals'));
    }

    public function update(Request $request, $id)
    {
        $patient = Patient::findOrFail($id);

        // Validasi
        $request->validate([
            'name'   => 'required|string|max:255',
            'phone'  => 'required|unique:patients,phone,' . $patient->id,
            'address'=> 'nullable|string',
            'hospital_id' => 'required|exists:hospitals,id',
        ], [
            'name.required' => 'Nama pasien wajib diisi.',
            'phone.unique'  => 'Nomor telepon sudah terdaftar.',
            'phone.required'  => 'Nomor telepon wajib diisi',
            'address.required'  => 'Alamat wajib diisi',
            'hospital_id.required'   => 'Rumah sakit wajib dipilih',
        ]);

        // Update data
        $patient->update($request->all());

        return redirect()->route('patients.index') ->with('success', 'Data pasien '.$request->name.' berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $patient = Patient::findOrFail($id);
        $patient->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data pasien berhasil dihapus.'
        ]);
    }

    
    public function show($id)
    {
        return response()->json(Patient::findOrFail($id));
    }

   
}