<?php

namespace App\Http\Controllers;

use App\Models\Documents;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use setasign\Fpdi\Fpdi;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DocumentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Documents::with(['creator', 'updater', 'office'])->get();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'num_exp' => 'required|string|max:50|unique:documents',
            'id_offi' => 'required|integer|exists:offices,id_offi',
            'pdf_file' => 'required|file|mimes:pdf|max:10240',
        ]);

        $pdfPath = $request->file('pdf_file')->store('documents', 'public');

        $document = Documents::create([
            'num_exp' => $request->num_exp,
            'id_offi' => $request->id_offi,
            'created_by' => Auth::user()->id_user,
            'pdf_path' => 'storage/' . $pdfPath,
        ]);

        return response()->json([
            'message' => 'Document created successfully',
            'document' => $document,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'id_offi' => 'required|integer|exists:offices,id_offi',
            'new_pdf' => 'nullable|file|mimes:pdf|max:10240',
        ]);

        $document = Documents::findOrFail($id);

        $oldAbsolutePath = Storage::disk('public')->path($document->pdf_path);

        $newPdf = $request->file('new_pdf');
        $newPdfName = 'new_' . Str::random(10) . '.pdf';

        Storage::disk('public')->putFileAs('documents', $newPdf, $newPdfName);

        $newPdfPath = Storage::disk('public')->path('documents/' . $newPdfName);

        $mergedPdfName = 'merged_' . Str::random(10) . '.pdf';
        $mergedPdfPath = Storage::disk('public')->path('documents/' . $mergedPdfName);

        $pdf = new Fpdi();

        $importPages = function ($path) use ($pdf) {
            $pageCount = $pdf->setSourceFile($path);
            for ($i = 1; $i <= $pageCount; $i++) {
                $tpl = $pdf->importPage($i);
                $size = $pdf->getTemplateSize($tpl);
                $pdf->AddPage($size['orientation'], [$size['width'], $size['height']]);
                $pdf->useTemplate($tpl);
            }
        };

        $importPages($oldAbsolutePath);
        $importPages($newPdfPath);
        $pdf->Output($mergedPdfPath, 'F');

        $document->update([
            'id_offi' => $request->id_offi,
            'pdf_path' => 'documents/' . $mergedPdfName,
            'updated_by' => Auth::user()->id_user,
        ]);

        return response()->json([
            'message' => 'Documento actualizado y fusionado exitosamente.',
            'document' => $document,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
