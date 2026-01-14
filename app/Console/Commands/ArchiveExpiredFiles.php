<?php

namespace App\Console\Commands;

use App\Models\File;
use App\Services\AuditLogService;
use Illuminate\Console\Command;

class ArchiveExpiredFiles extends Command
{
    protected $signature = 'files:archive-expired';
    protected $description = 'Archive files that have exceeded their retention period';

    public function __construct(
        protected AuditLogService $auditLogService
    ) {
        parent::__construct();
    }

    public function handle()
    {
        $files = File::needsArchiving()->get();
        
        $this->info("Found {$files->count()} files to archive.");

        foreach ($files as $file) {
            $file->update([
                'status' => 'archived',
                'archived_at' => now(),
            ]);

            $this->auditLogService->log(
                'file_auto_archived',
                File::class,
                $file->id,
                "File '{$file->original_name}' auto-archived due to retention policy"
            );
        }

        $this->info("Archived {$files->count()} files successfully.");
        return Command::SUCCESS;
    }
}
