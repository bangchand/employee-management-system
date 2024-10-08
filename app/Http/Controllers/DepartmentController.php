<?php

namespace App\Http\Controllers;

use App\Http\Requests\DepartmentRequest;
use App\Models\Department;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Ambil company_id dari user yang sedang login
        $companyId = Auth::user()->company_id;

        $query = Department::query()->withTrashed();

        // order by deleted at
        $query->orderByRaw('deleted_at IS NOT NULL');

        // Filter berdasarkan company_id
        $query->where('company_id', $companyId);

        // Pencarian
        $search = $request->input('search');
        if ($search) {
            $query->where('name', 'like', '%' . $search . '%'); // Menggunakan scope search dari model
        }

        // Sorting
        $sortBy = $request->get('sortBy', 'created_at'); // Kolom default yang valid
        $sortDirection = $request->get('sortDirection', 'asc'); // Arah default
        $query->orderBy($sortBy, $sortDirection);

        // Ambil data yang telah disortir dan difilter
        $departments = $query->paginate(5);
        $departments->appends($request->all());

        return view('department.index', compact('departments'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(DepartmentRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['company_id'] = Auth::user()->company->id;

        Department::create($validatedData);

        return redirect()->route('departments.index')->with('success', 'Departemen berhasil dibuat.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DepartmentRequest $request, Department $department)
    {
        $department->update($request->validated());

        return redirect()->route('departments.index')->with('success', 'Departemen berhasil di edit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Department $department)
    {
        try {
            $department->delete();
            return redirect()->route('departments.index')->with('success', 'Hapus Department Success!');
        } catch (QueryException $e) {
            if ($e->getCode() === '23000') {
                return redirect()->route('departments.index')->with('danger', 'Tidak dapat menghapus department karena terkait dengan data lain.');
            }
            return redirect()->route('departments.index')->with('danger', 'Terjadi kesalahan saat menghapus department.');
        } catch (Exception $e) {
            return redirect()->route('departments.index')->with('danger', 'Terjadi kesalahan tak terduga.');
        }
    }

    public function restore($id)
    {
        $department = Department::withTrashed()->find($id);

        if ($department) {
            $department->restore();
            return redirect()->route('departments.index')->with('success', 'Department Berhasil dipulihkan!');
        }
    }
}
