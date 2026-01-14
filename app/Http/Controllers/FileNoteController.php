<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\FileNote;
use App\Services\AuditLogService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FileNoteController extends Controller
{
    public function __construct(
        protected AuditLogService $auditLogService
    ) {}

    public function store(Request $request, File $file): JsonResponse
    {
        $this->authorize('files.notes');

        $validated = $request->validate([
            'note' => 'required|string|max:5000',
        ]);

        $note = FileNote::create([
            'file_id' => $file->id,
            'user_id' => auth()->id(),
            'note' => $validated['note'],
        ]);

        $this->auditLogService->log(
            'file_note_added',
            FileNote::class,
            $note->id,
            "Note added to file '{$file->original_name}'"
        );

        $note->load('user');

        return response()->json([
            'success' => true,
            'note' => [
                'id' => $note->id,
                'note' => $note->note,
                'user' => $note->user->name,
                'created_at' => $note->created_at->format('M d, Y H:i'),
                'created_at_human' => $note->created_at->diffForHumans(),
            ],
        ]);
    }

    public function destroy(FileNote $fileNote): JsonResponse
    {
        $this->authorize('files.notes');

        $fileNote->delete();

        return response()->json(['success' => true]);
    }
}
