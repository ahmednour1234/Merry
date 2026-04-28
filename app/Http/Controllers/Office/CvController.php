<?php

namespace App\Http\Controllers\Office;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Cv;
use App\Models\Nationality;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CvController extends Controller
{
    public function index(Request $request)
    {
        $office = Auth::guard('office-panel')->user();

        $query = Cv::on('system')
            ->with(['nationality.translations', 'category'])
            ->where('office_id', $office->id)
            ->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $query->where('id', 'like', '%'.$request->search.'%');
        }

        $cvs = $query->paginate(15)->withQueryString();

        return view('office.cvs.index', compact('cvs'));
    }

    public function create()
    {
        $categories   = $this->getCategories();
        $nationalities = $this->getNationalities();
        return view('office.cvs.create', compact('categories', 'nationalities'));
    }

    public function store(Request $request)
    {
        $office = Auth::guard('office-panel')->user();

        $request->validate([
            'category_id'      => 'nullable|integer',
            'nationality_code' => 'required|string',
            'gender'           => 'nullable|in:male,female',
            'has_experience'   => 'boolean',
            'is_muslim'        => 'boolean',
            'files'            => 'required|array|min:1|max:20',
            'files.*'          => 'required|file|mimes:pdf|max:10240',
        ], [
            'nationality_code.required' => 'الجنسية مطلوبة',
            'files.required'            => 'يجب رفع ملف واحد على الأقل',
            'files.max'                 => 'لا يمكن رفع أكثر من 20 ملف في المرة الواحدة',
            'files.*.mimes'             => 'يجب أن تكون الملفات بصيغة PDF',
            'files.*.max'               => 'حجم كل ملف يجب أن يكون أقل من 10 MB',
        ]);

        $count = 0;
        foreach ($request->file('files') as $uploaded) {
            $path = $uploaded->store('cvs', 'private');

            Cv::on('system')->create([
                'office_id'          => $office->id,
                'category_id'        => $request->category_id,
                'nationality_code'   => $request->nationality_code,
                'gender'             => $request->gender,
                'has_experience'     => $request->boolean('has_experience'),
                'is_muslim'          => $request->boolean('is_muslim'),
                'file_path'          => $path,
                'file_mime'          => $uploaded->getMimeType(),
                'file_size'          => $uploaded->getSize(),
                'file_original_name' => $uploaded->getClientOriginalName(),
                'status'             => 'pending',
            ]);

            $count++;
        }

        return redirect()->route('office.cvs.index')
            ->with('success', "تم رفع {$count} سيرة ذاتية بنجاح. ستتم مراجعتها من الإدارة.");
    }

    public function edit($id)
    {
        $office = Auth::guard('office-panel')->user();
        $cv     = Cv::on('system')->where('office_id', $office->id)->findOrFail($id);

        $categories    = $this->getCategories();
        $nationalities = $this->getNationalities();

        return view('office.cvs.edit', compact('cv', 'categories', 'nationalities'));
    }

    public function update(Request $request, $id)
    {
        $office = Auth::guard('office-panel')->user();
        $cv     = Cv::on('system')->where('office_id', $office->id)->findOrFail($id);

        $request->validate([
            'category_id'      => 'nullable|integer',
            'nationality_code' => 'required|string',
            'gender'           => 'nullable|in:male,female',
            'has_experience'   => 'boolean',
            'is_muslim'        => 'boolean',
            'file'             => 'nullable|file|mimes:pdf|max:10240',
        ], [
            'nationality_code.required' => 'الجنسية مطلوبة',
            'file.mimes'                => 'يجب أن يكون الملف بصيغة PDF',
            'file.max'                  => 'حجم الملف يجب أن يكون أقل من 10 MB',
        ]);

        $data = [
            'category_id'    => $request->category_id,
            'nationality_code' => $request->nationality_code,
            'gender'         => $request->gender,
            'has_experience' => $request->boolean('has_experience'),
            'is_muslim'      => $request->boolean('is_muslim'),
        ];

        if ($request->hasFile('file') && $request->file('file')->isValid()) {
            // Delete old file
            if ($cv->file_path) {
                Storage::disk('private')->delete($cv->file_path);
            }
            $uploaded          = $request->file('file');
            $data['file_path'] = $uploaded->store('cvs', 'private');
            $data['file_mime'] = $uploaded->getMimeType();
            $data['file_size'] = $uploaded->getSize();
            $data['file_original_name'] = $uploaded->getClientOriginalName();
            $data['status']    = 'pending'; // Reset to pending after file change
        }

        $cv->update($data);

        return redirect()->route('office.cvs.index')
            ->with('success', 'تم تحديث السيرة الذاتية بنجاح.');
    }

    public function destroy($id)
    {
        $office = Auth::guard('office-panel')->user();
        $cv     = Cv::on('system')->where('office_id', $office->id)->findOrFail($id);

        if ($cv->file_path) {
            Storage::disk('private')->delete($cv->file_path);
        }

        $cv->delete();

        return redirect()->route('office.cvs.index')
            ->with('success', 'تم حذف السيرة الذاتية بنجاح.');
    }

    public function download($id)
    {
        $office = Auth::guard('office-panel')->user();
        $cv     = Cv::on('system')->where('office_id', $office->id)->findOrFail($id);

        if (empty($cv->file_path)) {
            abort(404, 'الملف غير موجود');
        }

        $fileName = $cv->file_original_name ?? basename($cv->file_path);

        // Primary: public disk (where PdfUpload stores files)
        if (Storage::disk('public')->exists($cv->file_path)) {
            $fullPath = Storage::disk('public')->path($cv->file_path);
            return response()->download($fullPath, $fileName, ['Content-Type' => 'application/pdf']);
        }

        // Fallback: private disk
        if (Storage::disk('private')->exists($cv->file_path)) {
            $fullPath = Storage::disk('private')->path($cv->file_path);
            return response()->download($fullPath, $fileName, ['Content-Type' => 'application/pdf']);
        }

        // Fallback: direct paths
        $possiblePaths = [
            storage_path('app/public/'.ltrim($cv->file_path, '/')),
            public_path('storage/'.ltrim($cv->file_path, '/')),
        ];
        foreach ($possiblePaths as $p) {
            if (file_exists($p)) {
                return response()->download($p, $fileName, ['Content-Type' => 'application/pdf']);
            }
        }

        abort(404, 'الملف غير موجود على الخادم');
    }

    // ── Helpers ──────────────────────────────────────────────────────────

    private function getCategories(): array
    {
        return Category::on('system')
            ->with('translations')
            ->where('active', true)
            ->get()
            ->map(function ($cat) {
                $name = $cat->translations->where('lang_code', 'ar')->first()?->name
                    ?? $cat->translations->first()?->name
                    ?? $cat->name;
                return ['id' => $cat->id, 'name' => $name];
            })
            ->toArray();
    }

    private function getNationalities(): array
    {
        return Nationality::on('system')
            ->with('translations')
            ->where('active', true)
            ->get()
            ->map(function ($nat) {
                $name = $nat->translations->where('lang_code', 'ar')->first()?->name
                    ?? $nat->translations->first()?->name
                    ?? $nat->name;
                return ['code' => $nat->code, 'name' => $name];
            })
            ->toArray();
    }
}
