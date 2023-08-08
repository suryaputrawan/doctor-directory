<?php

namespace App\Http\Controllers\Admin;

use Exception;
use Throwable;
use App\Models\Site;
use App\Models\Doctor;
use App\Models\Specialist;
use Illuminate\Http\Request;
use App\Models\SubSpecialist;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->type == 'datatable') {
            $data = Doctor::orderBy('name', 'ASC')->get();

            return datatables()->of($data)
                ->addColumn('action', function ($data) {
                    $editRoute       = 'admin.doctors.edit';
                    $dataId          = Crypt::encryptString($data->id);

                    $action = "";
                    $action .= '
                        <a class="btn btn-warning btn-icon" type="button" href="' . route($editRoute, $dataId) . '">
                            <i data-feather="edit"></i>
                        </a> ';

                    $group = '<div class="btn-group btn-group-sm mb-1 mb-md-0" role="group">
                        ' . $action . '
                    </div>';
                    return $group;
                })
                ->addColumn('specialist', function ($data) {
                    return $data->specialist->name;
                })
                ->addColumn('sub_specialist', function ($data) {
                    return $data->subSpecialist ? $data->subSpecialist->name : '';
                })
                ->addColumn('site', function ($data) {
                    return $data->site->name;
                })
                ->addColumn('picture', function ($data) {
                    return $data->picture ? '<img src="' . $data->takeImage . '" alt="Gambar" width="50">' : '';
                })
                ->addColumn('status', function ($data) {
                    if ($data->isAktif == 1) {
                        return '<i data-feather="check"></i>';
                    } else {
                        return '<i data-feather="x"></i>';
                    }
                })
                ->rawColumns(['action', 'specialist', 'sub_specialist', 'picture', 'status'])
                ->make(true);
        }

        return view('admin.modules.doctor.index', [
            'breadcrumb' => 'Doctors'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.modules.doctor.create', [
            'breadcrumb'        => 'Doctor',
            'btnSubmit'         => 'Save',
            'specialists'       => Specialist::orderBy('name', 'ASC')->get(['id', 'name']),
            'subSpecialists'    => SubSpecialist::orderBy('name', 'ASC')->get(['id', 'name']),
            'sites'             => Site::orderBy('name', 'ASC')->get(['id', 'name'])
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'          => 'required|max:255|min:5|unique:doctors,name',
            'specialist'    => 'required',
            'keterangan'    => 'required|min:5',
            'site'          => 'required',
            'picture'       => 'required|mimes:jpg,jpeg,png|max:1000',
        ]);

        try {
            DB::beginTransaction();
            Doctor::create([
                'name'              => $request->name,
                'specialist_id'     => $request->specialist,
                'sub_specialist_id' => $request->sub_specialist,
                'keterangan'        => $request->keterangan,
                'notes'             => $request->notes,
                'site_id'           => $request->site,
                'picture'           => $request->file('picture')->store('picture/doctor')
            ]);

            DB::commit();

            if (isset($_POST['btnSimpan'])) {
                return redirect()->route('admin.doctors.index')
                    ->with('success', 'Doctor has been success to created');
            } else {
                return redirect()->route('admin.doctors.create')
                    ->with('success', 'Doctor has been success to created');
            }
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()
                ->back()
                ->withInput()
                ->with('error', "Error on line {$e->getLine()}: {$e->getMessage()}");
        } catch (Throwable $e) {
            DB::rollBack();
            return redirect()
                ->back()
                ->withInput()
                ->with('error', "Error on line {$e->getLine()}: {$e->getMessage()}");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Doctor $doctor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        try {
            $id = Crypt::decryptString($id);
            $data = Doctor::find($id);

            if (!$data) {
                return redirect()
                    ->back()
                    ->with('error', "Data not found..");
            }

            return view('admin.modules.doctor.edit', [
                'breadcrumb'        => 'Doctor',
                'btnSubmit'         => 'Save Change',
                'specialists'       => Specialist::orderBy('name', 'ASC')->get(['id', 'name']),
                'subSpecialists'    => SubSpecialist::orderBy('name', 'ASC')->get(['id', 'name']),
                'sites'             => Site::orderBy('name', 'ASC')->get(['id', 'name']),
                'data'              => $data
            ]);
        } catch (\Throwable $e) {
            return redirect()
                ->back()
                ->with('error', "Error on line {$e->getLine()}: {$e->getMessage()}");
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $id = Crypt::decryptString($id);
        $data = Doctor::find($id);

        if (!$data) {
            return redirect()
                ->back()
                ->with('error', "Data not found");
        }

        $request->validate([
            'name'          => 'required|max:255|min:5|unique:doctors,name,' . $data->id,
            'specialist'    => 'required',
            'keterangan'    => 'required|min:5',
            'site'          => 'required',
            'picture'       => request('logo') ? 'mimes:jpg,jpeg,png|max:1000' : '',
        ]);

        DB::beginTransaction();

        //Membuat kondisi langsung mendelete gambar yang lama pada storage
        if (request('picture')) {
            if ($data->picture != null) {
                Storage::delete($data->picture);
            }
            $picture = request()->file('picture')->store('picture/doctor');
        } elseif ($data->picture) {
            $picture = $data->picture;
        } else {
            $picture = null;
        }

        try {
            $data->update([
                'name'              => $request->name,
                'specialist_id'     => $request->specialist,
                'sub_specialist_id' => $request->sub_specialist,
                'keterangan'        => $request->keterangan,
                'notes'             => $request->notes,
                'site_id'           => $request->site,
                'isAktif'           => $request->status,
                'picture'           => $picture
            ]);

            DB::commit();

            return redirect()->route('admin.doctors.index')
                ->with('success', 'Doctor has been updated');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()
                ->back()
                ->withInput()
                ->with('error', "Error on line {$e->getLine()}: {$e->getMessage()}");
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()
                ->back()
                ->withInput()
                ->with('error', "Error on line {$e->getLine()}: {$e->getMessage()}");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Doctor $doctor)
    {
        //
    }
}
