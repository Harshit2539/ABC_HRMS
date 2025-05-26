<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attachment;
use Illuminate\Http\Request;

class AttachmentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:pdf|max:2048',
            'contract_id' => 'required|exists:contracts,id',
        ]);

        $file = $request->file('file');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $filePath = $file->storeAs('attachments', $fileName, 'public');

        $attachment = Attachment::create([
            'contract_id' => $request->contract_id,
            'file_name' => $file->getClientOriginalName(),
            'file_path' => $filePath,
            'file_type' => $file->getClientMimeType(),
            'file_size' => $file->getSize(),
        ]);

        return response()->json(['message' => 'File uploaded successfully', 'attachment' => $attachment]);
    }

 

    public function destroy($id)
    {
        $attachment = Attachment::findOrFail($id);
        $filePath = storage_path("app/public/" . $attachment->file_path);

        if (file_exists($filePath)) {
            unlink($filePath);
        }

        $attachment->delete();
        return response()->json(['message' => 'File deleted successfully']);
    }
}
