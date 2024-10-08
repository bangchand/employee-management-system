<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request as FacadesRequest;

class CompanyController extends Controller
{
    public function reset_code(Company $company): mixed
    {
        $company->update([
            'company_code' => Company::company_generate()
        ]);

        return redirect()->route('candidates.index')->with('success', 'berhasil mereset kode rekrut!');
    }

    public function reset_invite(Company $company): mixed
    {
        $company->update([
            'company_invite' => Company::company_generate()
        ]);

        return redirect()->route('candidates.index')->with('success', 'berhasil mereset kode undangan!');
    }

    public function updateOfficeHour(Request $request)
    {
        $request->validate([
            'checkin_start' => 'required|before:checkin_end',
            'checkin_end' => 'required|after:checkin_start',
            'checkout_start' => [
                'required',
                function ($attribute, $value, $fail) use ($request) {
                    if (Carbon::parse($value)->lt(Carbon::parse($request->checkin_end))) {
                        $fail('Waktu check-out awal harus setelah waktu check-in akhir.');
                    }
                },
            ],
            'checkout_end' => [
                'required',
                function ($attribute, $value, $fail) use ($request) {
                    if (Carbon::parse($value)->lt(Carbon::parse($request->checkout_start))) {
                        $fail('Waktu check-out akhir harus setelah waktu check-out awal.');
                    }
                },
            ],
            'checkin_tolerance' => 'required|integer|min:0',
            // checkout_tolerance tidak ada lagi
        ], [
            'checkin_start.required' => 'Waktu absen masuk awal harus diisi.',
            'checkin_start.date_format' => 'Format waktu absen masuk awal harus dalam format jam:menit (HH:mm).',
            'checkin_start.before' => 'Waktu absen masuk awal harus sebelum waktu absen masuk akhir.',

            'checkin_end.required' => 'Waktu absen masuk akhir harus diisi.',
            'checkin_end.date_format' => 'Format waktu absen masuk akhir harus dalam format jam:menit (HH:mm).',
            'checkin_end.after' => 'Waktu absen masuk akhir harus setelah waktu absen masuk awal.',

            'checkout_start.required' => 'Waktu absen keluar awal harus diisi.',
            'checkout_start.date_format' => 'Format waktu absen keluar awal harus dalam format jam:menit (HH:mm).',
            'checkout_start.after' => 'Waktu absen keluar awal harus setelah waktu absen masuk akhir.',

            'checkout_end.required' => 'Waktu absen keluar akhir harus diisi.',
            'checkout_end.date_format' => 'Format waktu absen keluar akhir harus dalam format jam:menit (HH:mm).',
            'checkout_end.after' => 'Waktu absen keluar akhir harus setelah waktu absen keluar awal.',

            'checkin_tolerance.required' => 'Menit toleransi absen masuk harus diisi.',
            'checkin_tolerance.integer' => 'Menit toleransi absen masuk harus berupa angka.',
            'checkin_tolerance.min' => 'Menit toleransi absen masuk tidak boleh kurang dari 0.',
        ]);

        $company = Auth::user()->company;

        // Update perusahaan tanpa checkout_tolerance
        $company->update([
            'checkin_start' => $request->checkin_start,
            'checkin_end' => $request->checkin_end,
            'checkin_tolerance' => $request->checkin_tolerance,
            'checkout_start' => $request->checkout_start,
            'checkout_end' => $request->checkout_end,
        ]);

        return redirect()->back()->with('success', 'Jam masuk kantor berhasil diperbarui!');
    }
}
