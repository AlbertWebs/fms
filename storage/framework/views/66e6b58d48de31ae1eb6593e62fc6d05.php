<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('header', null, []); ?> 
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-white">File Details</h1>
                <p class="mt-1 text-sm text-gray-300"><?php echo e($file->original_name); ?></p>
            </div>
            <div class="flex items-center gap-3">
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('files.preview')): ?>
                    <button onclick="previewFile(<?php echo e($file->id); ?>)" class="inline-flex items-center justify-center px-5 py-2.5 bg-gradient-to-r from-blue-50 to-cyan-50 border-2 border-blue-200 rounded-xl font-semibold text-sm text-blue-700 hover:from-blue-100 hover:to-cyan-100 hover:border-blue-300 transition-all duration-200 shadow-sm hover:shadow-md">
                        <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                        Preview
                    </button>
                <?php endif; ?>
            </div>
        </div>
     <?php $__env->endSlot(); ?>

    <div class="max-w-6xl mx-auto space-y-6">
        <!-- File Header Card -->
        <div class="bg-gradient-to-br from-white via-indigo-50/30 to-purple-50/30 rounded-2xl border-2 border-indigo-200/60 shadow-xl overflow-hidden backdrop-blur-sm">
            <div class="px-8 py-6 border-b-2 border-indigo-200/50 bg-gradient-to-r from-indigo-500/10 via-purple-500/10 to-pink-500/10">
                <div class="flex items-center justify-between flex-wrap gap-4">
                    <div class="flex items-center gap-4 flex-1 min-w-0">
                        <div class="flex-shrink-0">
                            <div class="p-4 bg-gradient-to-br from-indigo-500 to-purple-500 rounded-xl shadow-lg">
                                <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center gap-3 flex-wrap">
                                <h2 class="text-xl font-bold text-gray-900 truncate"><?php echo e($file->original_name); ?></h2>
                                <?php if($file->is_locked): ?>
                                    <span class="inline-flex items-center px-2.5 py-1 bg-gradient-to-r from-amber-100 to-orange-100 text-amber-800 border-2 border-amber-300 rounded-lg text-xs font-bold shadow-sm">
                                        <svg class="w-3 h-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                        </svg>
                                        Locked
                                    </span>
                                <?php endif; ?>
                                <?php
                                    $status = $file->status ?: 'uploaded';
                                    $statusColors = [
                                        'uploaded' => 'bg-gradient-to-r from-gray-100 to-gray-200 text-gray-800 border-2 border-gray-300 shadow-sm',
                                        'pending_review' => 'bg-gradient-to-r from-amber-100 to-orange-100 text-amber-800 border-2 border-amber-300 shadow-sm',
                                        'approved' => 'bg-gradient-to-r from-emerald-100 to-green-100 text-emerald-800 border-2 border-emerald-300 shadow-sm',
                                        'needs_correction' => 'bg-gradient-to-r from-red-100 to-pink-100 text-red-800 border-2 border-red-300 shadow-sm',
                                        'archived' => 'bg-gradient-to-r from-slate-100 to-gray-100 text-slate-800 border-2 border-slate-300 shadow-sm',
                                    ];
                                    $statusColor = $statusColors[$status] ?? $statusColors['uploaded'];
                                    $statusLabel = str_replace('_', ' ', ucfirst($status));
                                ?>
                                <span class="inline-flex items-center px-3 py-1.5 rounded-lg text-xs font-bold border <?php echo e($statusColor); ?>">
                                    <?php echo e($statusLabel); ?>

                                </span>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('files.status.change')): ?>
                                    <form method="POST" action="<?php echo e(route('files.update-status', $file)); ?>" class="inline" onchange="this.submit()">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('PUT'); ?>
                                        <select name="status" class="text-xs font-semibold rounded-lg border-2 border-purple-200 focus:border-purple-400 focus:ring-2 focus:ring-purple-300 bg-white text-gray-900 px-2 py-1 transition-all duration-200">
                                            <option value="uploaded" <?php echo e($file->status === 'uploaded' ? 'selected' : ''); ?>>Uploaded</option>
                                            <option value="pending_review" <?php echo e($file->status === 'pending_review' ? 'selected' : ''); ?>>Pending Review</option>
                                            <option value="approved" <?php echo e($file->status === 'approved' ? 'selected' : ''); ?>>Approved</option>
                                            <option value="needs_correction" <?php echo e($file->status === 'needs_correction' ? 'selected' : ''); ?>>Needs Correction</option>
                                            <option value="archived" <?php echo e($file->status === 'archived' ? 'selected' : ''); ?>>Archived</option>
                                        </select>
                                    </form>
                                <?php endif; ?>
                            </div>
                            <div class="mt-2 flex items-center gap-4 text-sm text-gray-600 flex-wrap">
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 mr-1.5 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                    <?php echo e($file->client->name); ?>

                                </span>
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 mr-1.5 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                    </svg>
                                    <?php echo e($file->category->name); ?>

                                </span>
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 mr-1.5 text-pink-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <?php echo e($file->financial_year); ?>

                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tabs -->
            <div class="border-b-2 border-indigo-200/50 bg-white/50">
                <nav class="flex -mb-px px-8">
                    <button onclick="switchTab('details')" 
                            id="tab-details"
                            class="tab-button whitespace-nowrap py-4 px-6 border-b-2 font-bold text-sm transition-all duration-200 border-indigo-500 text-indigo-600">
                        <span class="flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            Details
                        </span>
                    </button>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('files.notes')): ?>
                        <button onclick="switchTab('notes')" 
                                id="tab-notes"
                                class="tab-button whitespace-nowrap py-4 px-6 border-b-2 font-bold text-sm transition-all duration-200 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300">
                            <span class="flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                                Notes <span id="notes-count" class="ml-1 px-2 py-0.5 bg-indigo-100 text-indigo-700 rounded-full text-xs font-bold"><?php echo e($file->notes->count()); ?></span>
                            </span>
                        </button>
                    <?php endif; ?>
                    <?php if($file->versions->count() > 0): ?>
                        <button onclick="switchTab('versions')" 
                                id="tab-versions"
                                class="tab-button whitespace-nowrap py-4 px-6 border-b-2 font-bold text-sm transition-all duration-200 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300">
                            <span class="flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                                </svg>
                                Versions <span class="ml-1 px-2 py-0.5 bg-purple-100 text-purple-700 rounded-full text-xs font-bold"><?php echo e($file->versions->count()); ?></span>
                            </span>
                        </button>
                    <?php endif; ?>
                </nav>
            </div>

            <!-- Tab Content -->
            <div class="p-8">
                <!-- Details Tab -->
                <div id="content-details" class="tab-content">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <div class="bg-gradient-to-br from-indigo-50/50 to-purple-50/30 rounded-xl border-2 border-indigo-200 p-5">
                            <dt class="text-xs font-bold text-gray-600 uppercase tracking-wide mb-2 flex items-center">
                                <svg class="w-4 h-4 mr-1.5 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                File Name
                            </dt>
                            <dd class="text-sm font-bold text-gray-900 break-words"><?php echo e($file->original_name); ?></dd>
                        </div>
                        <div class="bg-gradient-to-br from-blue-50/50 to-cyan-50/30 rounded-xl border-2 border-blue-200 p-5">
                            <dt class="text-xs font-bold text-gray-600 uppercase tracking-wide mb-2 flex items-center">
                                <svg class="w-4 h-4 mr-1.5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                                Client
                            </dt>
                            <dd class="text-sm font-semibold text-gray-900">
                                <a href="<?php echo e(route('clients.show', $file->client)); ?>" class="text-blue-600 hover:text-blue-700 hover:underline">
                                    <?php echo e($file->client->name); ?>

                                </a>
                            </dd>
                        </div>
                        <div class="bg-gradient-to-br from-purple-50/50 to-pink-50/30 rounded-xl border-2 border-purple-200 p-5">
                            <dt class="text-xs font-bold text-gray-600 uppercase tracking-wide mb-2 flex items-center">
                                <svg class="w-4 h-4 mr-1.5 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                </svg>
                                Category
                            </dt>
                            <dd class="text-sm font-semibold text-gray-900"><?php echo e($file->category->name); ?></dd>
                            <?php if($file->category->retention_days): ?>
                                <dd class="mt-2 text-xs font-medium text-purple-600 bg-purple-100 px-2 py-1 rounded-lg inline-block">
                                    Retention: <?php echo e($file->category->retention_days); ?> days
                                </dd>
                            <?php endif; ?>
                        </div>
                        <div class="bg-gradient-to-br from-pink-50/50 to-rose-50/30 rounded-xl border-2 border-pink-200 p-5">
                            <dt class="text-xs font-bold text-gray-600 uppercase tracking-wide mb-2 flex items-center">
                                <svg class="w-4 h-4 mr-1.5 text-pink-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                Financial Year
                            </dt>
                            <dd class="text-sm font-semibold text-gray-900"><?php echo e($file->financial_year); ?></dd>
                        </div>
                        <div class="bg-gradient-to-br from-emerald-50/50 to-green-50/30 rounded-xl border-2 border-emerald-200 p-5">
                            <dt class="text-xs font-bold text-gray-600 uppercase tracking-wide mb-2 flex items-center">
                                <svg class="w-4 h-4 mr-1.5 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10" />
                                </svg>
                                Version
                            </dt>
                            <dd class="text-sm font-semibold text-gray-900"><?php echo e($file->version); ?></dd>
                        </div>
                        <div class="bg-gradient-to-br from-amber-50/50 to-orange-50/30 rounded-xl border-2 border-amber-200 p-5">
                            <dt class="text-xs font-bold text-gray-600 uppercase tracking-wide mb-2 flex items-center">
                                <svg class="w-4 h-4 mr-1.5 text-amber-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4" />
                                </svg>
                                File Size
                            </dt>
                            <dd class="text-sm font-semibold text-gray-900"><?php echo e(number_format($file->size / 1024, 2)); ?> KB</dd>
                        </div>
                        <div class="bg-gradient-to-br from-cyan-50/50 to-blue-50/30 rounded-xl border-2 border-cyan-200 p-5">
                            <dt class="text-xs font-bold text-gray-600 uppercase tracking-wide mb-2 flex items-center">
                                <svg class="w-4 h-4 mr-1.5 text-cyan-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                Uploaded By
                            </dt>
                            <dd class="text-sm font-semibold text-gray-900"><?php echo e($file->uploader->name ?? 'System'); ?></dd>
                        </div>
                        <div class="bg-gradient-to-br from-teal-50/50 to-emerald-50/30 rounded-xl border-2 border-teal-200 p-5">
                            <dt class="text-xs font-bold text-gray-600 uppercase tracking-wide mb-2 flex items-center">
                                <svg class="w-4 h-4 mr-1.5 text-teal-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                Uploaded Date
                            </dt>
                            <dd class="text-sm font-semibold text-gray-900"><?php echo e($file->created_at->format('M d, Y H:i')); ?></dd>
                        </div>
                        <?php if($file->archived_at): ?>
                            <div class="bg-gradient-to-br from-slate-50/50 to-gray-50/30 rounded-xl border-2 border-slate-200 p-5">
                                <dt class="text-xs font-bold text-gray-600 uppercase tracking-wide mb-2 flex items-center">
                                    <svg class="w-4 h-4 mr-1.5 text-slate-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                                    </svg>
                                    Archived Date
                                </dt>
                                <dd class="text-sm font-semibold text-gray-900"><?php echo e($file->archived_at->format('M d, Y H:i')); ?></dd>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Action Buttons -->
                    <div class="mt-8 pt-8 border-t-2 border-indigo-200 flex items-center gap-4 flex-wrap">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('files.lock')): ?>
                            <?php if(!$file->is_locked): ?>
                                <form method="POST" action="<?php echo e(route('files.toggle-lock', $file)); ?>">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit" class="inline-flex items-center px-5 py-2.5 bg-gradient-to-r from-amber-50 to-orange-50 border-2 border-amber-300 rounded-xl font-semibold text-sm text-amber-700 hover:from-amber-100 hover:to-orange-100 hover:border-amber-400 transition-all duration-200 shadow-sm hover:shadow-md">
                                        <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                        </svg>
                                        Lock File
                                    </button>
                                </form>
                            <?php endif; ?>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('files.unlock')): ?>
                            <?php if($file->is_locked): ?>
                                <form method="POST" action="<?php echo e(route('files.toggle-lock', $file)); ?>">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit" class="inline-flex items-center px-5 py-2.5 bg-gradient-to-r from-emerald-50 to-green-50 border-2 border-emerald-300 rounded-xl font-semibold text-sm text-emerald-700 hover:from-emerald-100 hover:to-green-100 hover:border-emerald-400 transition-all duration-200 shadow-sm hover:shadow-md">
                                        <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 11V7a4 4 0 118 0m-4 8v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z" />
                                        </svg>
                                        Unlock File
                                    </button>
                                </form>
                            <?php endif; ?>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('files.upload')): ?>
                            <button onclick="showUploadVersionModal()" class="inline-flex items-center px-5 py-2.5 bg-gradient-to-r from-violet-50 to-purple-50 border-2 border-violet-300 rounded-xl font-semibold text-sm text-violet-700 hover:from-violet-100 hover:to-purple-100 hover:border-violet-400 transition-all duration-200 shadow-sm hover:shadow-md">
                                <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                </svg>
                                Upload New Version
                            </button>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('files.preview')): ?>
                            <a href="<?php echo e(route('files.preview-page', $file)); ?>" target="_blank" class="inline-flex items-center px-5 py-2.5 bg-gradient-to-r from-blue-600 to-cyan-600 border border-transparent rounded-xl font-semibold text-sm text-white hover:from-blue-700 hover:to-cyan-700 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                                <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                Preview in New Page
                            </a>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('files.download')): ?>
                            <a href="<?php echo e(route('files.download', $file)); ?>" class="inline-flex items-center px-5 py-2.5 bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 border border-transparent rounded-xl font-semibold text-sm text-white hover:from-indigo-700 hover:via-purple-700 hover:to-pink-700 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                                <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                Download
                            </a>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('files.delete')): ?>
                            <button onclick="showDeleteConfirm(<?php echo e($file->id); ?>, '<?php echo e(addslashes($file->original_name)); ?>')" class="inline-flex items-center px-5 py-2.5 bg-gradient-to-r from-red-50 to-pink-50 border-2 border-red-300 rounded-xl font-semibold text-sm text-red-700 hover:from-red-100 hover:to-pink-100 hover:border-red-400 transition-all duration-200 shadow-sm hover:shadow-md">
                                <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                                Delete File
                            </button>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Notes Tab -->
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('files.notes')): ?>
                    <div id="content-notes" class="tab-content" style="display: none;">
                        <div class="space-y-6">
                            <!-- Add Note Form -->
                            <div class="bg-gradient-to-br from-indigo-50/50 to-purple-50/30 rounded-xl border-2 border-indigo-200 p-6 shadow-lg">
                                <label class="block text-sm font-bold text-gray-700 mb-3 uppercase tracking-wide">Add Note</label>
                                <textarea id="new-note" 
                                          rows="4" 
                                          class="block w-full px-4 py-3 border-2 border-indigo-200 rounded-xl shadow-sm focus:border-indigo-400 focus:ring-2 focus:ring-indigo-300 text-sm bg-white transition-all duration-200"
                                          placeholder="Add an internal note about this file..."></textarea>
                                <div class="mt-4 flex justify-end">
                                    <button onclick="addNote()" id="add-note-btn" class="inline-flex items-center px-6 py-2.5 bg-gradient-to-r from-indigo-600 to-purple-600 border border-transparent rounded-xl font-bold text-sm text-white hover:from-indigo-700 hover:to-purple-700 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                                        <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                        </svg>
                                        Add Note
                                    </button>
                                </div>
                            </div>

                            <!-- Notes List -->
                            <div id="notes-list" class="space-y-4">
                                <?php $__currentLoopData = $file->notes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $note): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="bg-white rounded-xl border-2 border-gray-200 p-5 shadow-md hover:shadow-lg transition-all duration-200">
                                        <div class="flex items-start justify-between">
                                            <div class="flex-1">
                                                <p class="text-sm font-medium text-gray-900 mb-2"><?php echo e($note->note); ?></p>
                                                <div class="flex items-center gap-3 text-xs text-gray-600">
                                                    <span class="flex items-center font-semibold">
                                                        <svg class="w-4 h-4 mr-1 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                                        </svg>
                                                        <?php echo e($note->user->name); ?>

                                                    </span>
                                                    <span class="flex items-center">
                                                        <svg class="w-4 h-4 mr-1 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                        </svg>
                                                        <?php echo e($note->created_at->format('M d, Y H:i')); ?>

                                                    </span>
                                                    <span class="text-gray-400"><?php echo e($note->created_at->diffForHumans()); ?></span>
                                                </div>
                                            </div>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('files.notes.delete')): ?>
                                                <form method="POST" action="<?php echo e(route('files.notes.destroy', $note)); ?>" onsubmit="return confirm('Are you sure you want to delete this note?');" class="ml-4">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('DELETE'); ?>
                                                    <button type="submit" class="p-2 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors">
                                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                        </svg>
                                                    </button>
                                                </form>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <div id="notes-empty" class="text-center py-12 text-gray-500 text-sm <?php echo e($file->notes->count() > 0 ? 'hidden' : ''); ?>">
                                    <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                    <p class="font-medium">No notes yet</p>
                                    <p class="text-xs mt-1">Add the first note above</p>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Versions Tab -->
                <?php if($file->versions->count() > 0): ?>
                    <div id="content-versions" class="tab-content" style="display: none;">
                        <div class="space-y-4">
                            <?php $__currentLoopData = $file->versions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $version): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="bg-gradient-to-r from-white to-purple-50/30 rounded-xl border-2 border-purple-200 p-6 hover:border-purple-300 transition-all duration-200 shadow-md hover:shadow-lg">
                                    <div class="flex items-center justify-between flex-wrap gap-4">
                                        <div class="flex items-center gap-4 flex-1 min-w-0">
                                            <div class="flex-shrink-0">
                                                <div class="p-3 bg-gradient-to-br from-purple-500 to-pink-500 rounded-lg shadow-md">
                                                    <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <div class="text-base font-bold text-gray-900 truncate"><?php echo e($version->original_name); ?></div>
                                                <div class="flex items-center gap-4 mt-2 text-xs text-gray-600 flex-wrap">
                                                    <span class="px-2.5 py-1 bg-purple-100 text-purple-700 rounded-lg font-bold">Version <?php echo e($version->version); ?></span>
                                                    <span class="flex items-center">
                                                        <svg class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                        </svg>
                                                        <?php echo e($version->created_at->format('M d, Y H:i')); ?>

                                                    </span>
                                                    <span class="flex items-center">
                                                        <svg class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4" />
                                                        </svg>
                                                        <?php echo e(number_format($version->size / 1024, 2)); ?> KB
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex items-center gap-3">
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('files.download')): ?>
                                                <a href="<?php echo e(route('files.download', $version)); ?>" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-indigo-600 to-purple-600 border border-transparent rounded-lg font-semibold text-sm text-white hover:from-indigo-700 hover:to-purple-700 transition-all duration-200 shadow-md hover:shadow-lg">
                                                    <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                    </svg>
                                                    Download
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Back Button -->
        <div class="flex items-center justify-end">
            <a href="<?php echo e(route('files.index')); ?>" class="inline-flex items-center px-6 py-3 bg-white border-2 border-gray-300 rounded-xl font-semibold text-sm text-gray-700 hover:bg-gray-50 hover:border-gray-400 transition-all duration-200 shadow-sm hover:shadow-md">
                <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back to Files
            </a>
        </div>
    </div>

    <!-- File Preview Modal -->
    <?php if (isset($component)) { $__componentOriginal9f64f32e90b9102968f2bc548315018c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9f64f32e90b9102968f2bc548315018c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.modal','data' => ['name' => 'file-preview']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'file-preview']); ?>
        <div class="p-6">
            <h2 id="preview-title" class="text-xl font-bold text-gray-900 mb-4">Loading preview...</h2>
            <div id="preview-loading" class="flex items-center justify-center py-12">
                <svg class="animate-spin h-8 w-8 text-indigo-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
            </div>
            <div id="preview-content" style="display: none;"></div>
            <div id="preview-error" class="text-center py-12" style="display: none;">
                <p class="text-red-600 mb-4 font-semibold"></p>
            </div>
        </div>
     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9f64f32e90b9102968f2bc548315018c)): ?>
<?php $attributes = $__attributesOriginal9f64f32e90b9102968f2bc548315018c; ?>
<?php unset($__attributesOriginal9f64f32e90b9102968f2bc548315018c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9f64f32e90b9102968f2bc548315018c)): ?>
<?php $component = $__componentOriginal9f64f32e90b9102968f2bc548315018c; ?>
<?php unset($__componentOriginal9f64f32e90b9102968f2bc548315018c); ?>
<?php endif; ?>

    <!-- Upload Version Modal -->
    <?php if (isset($component)) { $__componentOriginal9f64f32e90b9102968f2bc548315018c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9f64f32e90b9102968f2bc548315018c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.modal','data' => ['name' => 'upload-version']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'upload-version']); ?>
        <div class="p-6">
            <div class="flex items-center mb-4">
                <div class="flex-shrink-0 mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-gradient-to-br from-violet-100 to-purple-100">
                    <svg class="h-6 w-6 text-violet-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                    </svg>
                </div>
            </div>
            <h2 class="text-xl font-bold text-gray-900 mb-2 text-center">Upload New Version</h2>
            <p class="text-sm text-gray-600 mb-6 text-center">Upload a new version of <span class="font-semibold text-gray-900"><?php echo e($file->original_name); ?></span></p>
            
            <form id="upload-version-form" method="POST" action="<?php echo e(route('files.upload-version', $file)); ?>" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="mb-6">
                    <div id="version-dropzone" 
                         class="relative border-2 border-dashed border-violet-300 rounded-xl p-8 text-center bg-gradient-to-br from-violet-50/50 to-purple-50/30 hover:border-violet-400 transition-all duration-200 cursor-pointer"
                         ondrop="handleVersionDrop(event)" 
                         ondragover="handleVersionDragOver(event)" 
                         ondragleave="handleVersionDragLeave(event)"
                         onclick="document.getElementById('version-file-input').click()">
                        <input type="file" 
                               id="version-file-input" 
                               name="file" 
                               required
                               accept=".pdf,.doc,.docx,.xls,.xlsx,.jpg,.jpeg,.png,.gif"
                               class="hidden"
                               onchange="handleVersionFileSelect(event)">
                        <div id="version-dropzone-content">
                            <svg class="mx-auto h-12 w-12 text-violet-500 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                            </svg>
                            <p class="text-sm font-semibold text-gray-700 mb-1">Drop file here or click to browse</p>
                            <p class="text-xs text-gray-300">PDF, DOC, XLS, Images (Max 10MB)</p>
                        </div>
                        <div id="version-file-preview" class="hidden">
                            <div class="bg-gradient-to-br from-violet-100 to-purple-100 rounded-lg p-4 mb-4">
                                <div class="flex items-center justify-center mb-2">
                                    <svg class="h-10 w-10 text-violet-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                </div>
                                <p id="version-file-name" class="text-sm font-semibold text-gray-900 mb-1"></p>
                                <p id="version-file-size" class="text-xs text-gray-600"></p>
                                <span class="inline-block mt-2 px-3 py-1 bg-gradient-to-r from-violet-600 to-purple-600 text-white text-xs font-semibold rounded-full">Ready to upload</span>
                            </div>
                            <button type="button" 
                                    onclick="clearVersionFile()" 
                                    class="text-sm text-violet-600 hover:text-violet-700 font-medium">
                                Choose different file
                            </button>
                        </div>
                    </div>
                    <p id="version-file-error" class="mt-2 text-sm text-red-600" style="display: none;"></p>
                </div>
                
                <div class="flex items-center justify-end gap-3">
                    <button type="button" 
                            onclick="closeUploadVersionModal()" 
                            class="px-5 py-2.5 text-sm font-semibold text-gray-700 bg-white border-2 border-gray-300 rounded-lg hover:bg-gray-50 transition-all duration-200">
                        Cancel
                    </button>
                    <button type="submit" 
                            id="version-upload-btn"
                            class="px-6 py-2.5 bg-gradient-to-r from-violet-600 to-purple-600 border border-transparent rounded-lg font-semibold text-sm text-white hover:from-violet-700 hover:to-purple-700 transition-all duration-200 shadow-lg hover:shadow-xl disabled:opacity-50 disabled:cursor-not-allowed">
                        Upload Version
                    </button>
                </div>
            </form>
        </div>
     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9f64f32e90b9102968f2bc548315018c)): ?>
<?php $attributes = $__attributesOriginal9f64f32e90b9102968f2bc548315018c; ?>
<?php unset($__attributesOriginal9f64f32e90b9102968f2bc548315018c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9f64f32e90b9102968f2bc548315018c)): ?>
<?php $component = $__componentOriginal9f64f32e90b9102968f2bc548315018c; ?>
<?php unset($__componentOriginal9f64f32e90b9102968f2bc548315018c); ?>
<?php endif; ?>

    <!-- Delete Confirmation Modal -->
    <?php if (isset($component)) { $__componentOriginal9f64f32e90b9102968f2bc548315018c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9f64f32e90b9102968f2bc548315018c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.modal','data' => ['name' => 'delete-confirm']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'delete-confirm']); ?>
        <div class="p-6">
            <div class="flex items-center mb-4">
                <div class="flex-shrink-0 mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100">
                    <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>
            </div>
            <h2 class="text-xl font-bold text-gray-900 mb-2 text-center">Confirm Deletion</h2>
            <p class="text-sm text-gray-600 mb-1 text-center">You are about to delete the file:</p>
            <p class="text-sm font-semibold text-gray-900 mb-6 text-center" id="delete-file-name"></p>
            <p class="text-sm text-red-600 mb-6 text-center font-medium">This action cannot be undone. Please enter your password to confirm.</p>
            
            <form id="delete-form" method="POST" action="">
                <?php echo csrf_field(); ?>
                <?php echo method_field('DELETE'); ?>
                <div class="mb-4">
                    <label for="delete-password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                    <input type="password" 
                           id="delete-password" 
                           name="password" 
                           required
                           autocomplete="current-password"
                           class="block w-full px-4 py-2.5 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 text-sm"
                           placeholder="Enter your password">
                    <p id="delete-password-error" class="mt-1 text-sm text-red-600" style="display: none;"></p>
                </div>
                
                <div class="flex items-center justify-end gap-3">
                    <button type="button" 
                            onclick="closeDeleteModal()" 
                            class="px-5 py-2.5 text-sm font-semibold text-gray-700 bg-white border-2 border-gray-300 rounded-lg hover:bg-gray-50 transition-all duration-200">
                        Cancel
                    </button>
                    <button type="submit" 
                            class="px-6 py-2.5 bg-gradient-to-r from-red-600 to-red-700 border border-transparent rounded-lg font-semibold text-sm text-white hover:from-red-700 hover:to-red-800 transition-all duration-200 shadow-lg hover:shadow-xl">
                        Delete File
                    </button>
                </div>
            </form>
        </div>
     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9f64f32e90b9102968f2bc548315018c)): ?>
<?php $attributes = $__attributesOriginal9f64f32e90b9102968f2bc548315018c; ?>
<?php unset($__attributesOriginal9f64f32e90b9102968f2bc548315018c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9f64f32e90b9102968f2bc548315018c)): ?>
<?php $component = $__componentOriginal9f64f32e90b9102968f2bc548315018c; ?>
<?php unset($__componentOriginal9f64f32e90b9102968f2bc548315018c); ?>
<?php endif; ?>

    <script>
        let currentTab = 'details';
        let notes = <?php echo json_encode($file->notes->map(fn($n) => ['id' => $n->id, 'note' => $n->note, 'user' => $n->user->name, 'created_at' => $n->created_at->format('M d, Y H:i'), 'created_at_human' => $n->created_at->diffForHumans()])); ?>;

        function switchTab(tab) {
            currentTab = tab;
            
            // Hide all tab contents
            document.querySelectorAll('.tab-content').forEach(content => {
                content.style.display = 'none';
            });
            
            // Remove active state from all tabs
            document.querySelectorAll('.tab-button').forEach(btn => {
                btn.classList.remove('border-indigo-500', 'text-indigo-600');
                btn.classList.add('border-transparent', 'text-gray-500');
            });
            
            // Show selected tab content
            const content = document.getElementById('content-' + tab);
            const button = document.getElementById('tab-' + tab);
            
            if (content) content.style.display = 'block';
            if (button) {
                button.classList.remove('border-transparent', 'text-gray-500');
                button.classList.add('border-indigo-500', 'text-indigo-600');
            }
        }

        async function previewFile(fileId) {
            const loadingDiv = document.getElementById('preview-loading');
            const contentDiv = document.getElementById('preview-content');
            const errorDiv = document.getElementById('preview-error');
            const titleEl = document.getElementById('preview-title');
            
            loadingDiv.style.display = 'flex';
            contentDiv.style.display = 'none';
            errorDiv.style.display = 'none';
            titleEl.textContent = 'Loading preview...';
            
            try {
                const response = await fetch(`/files/${fileId}/preview`);
                const data = await response.json();
                
                if (data.error) {
                    errorDiv.querySelector('p').textContent = data.error;
                    errorDiv.style.display = 'block';
                    loadingDiv.style.display = 'none';
                    return;
                }
                
                titleEl.textContent = data.name || 'File Preview';
                loadingDiv.style.display = 'none';
                contentDiv.innerHTML = '';
                
                if (data.mime_type === 'application/pdf') {
                    const iframe = document.createElement('iframe');
                    iframe.src = data.url;
                    iframe.className = 'w-full h-96 border-2 border-gray-200 rounded-xl';
                    contentDiv.appendChild(iframe);
                } else if (data.mime_type.startsWith('image/')) {
                    const img = document.createElement('img');
                    img.src = data.url;
                    img.className = 'max-w-full h-auto mx-auto rounded-xl shadow-lg';
                    contentDiv.appendChild(img);
                } else {
                    contentDiv.innerHTML = `
                        <div class="text-center py-12">
                            <p class="text-gray-500 mb-4 font-medium">Preview not available for this file type.</p>
                            <a href="${data.url}" target="_blank" class="inline-flex items-center px-6 py-2.5 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-xl hover:from-indigo-700 hover:to-purple-700 shadow-lg">
                                Open in New Tab
                            </a>
                        </div>
                    `;
                }
                
                contentDiv.style.display = 'block';
                window.dispatchEvent(new CustomEvent('open-modal', { detail: 'file-preview' }));
            } catch (err) {
                errorDiv.querySelector('p').textContent = 'Failed to load preview. Please try again.';
                errorDiv.style.display = 'block';
                loadingDiv.style.display = 'none';
            }
        }

        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('files.notes')): ?>
        async function addNote() {
            const noteText = document.getElementById('new-note').value.trim();
            if (!noteText) return;
            
            const btn = document.getElementById('add-note-btn');
            const originalText = btn.innerHTML;
            btn.disabled = true;
            btn.innerHTML = '<svg class="animate-spin h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>Adding...';
            
            try {
                const response = await fetch('<?php echo e(route('files.notes.store', $file)); ?>', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
                    },
                    body: JSON.stringify({ note: noteText })
                });
                
                const data = await response.json();
                if (data.success) {
                    notes.unshift(data.note);
                    document.getElementById('new-note').value = '';
                    updateNotesDisplay();
                    document.getElementById('notes-count').textContent = notes.length;
                    document.getElementById('notes-empty').classList.add('hidden');
                } else {
                    alert('Failed to add note');
                }
            } catch (e) {
                alert('Failed to add note');
            }
            
            btn.disabled = false;
            btn.innerHTML = originalText;
        }

        function updateNotesDisplay() {
            const notesList = document.getElementById('notes-list');
            const emptyDiv = document.getElementById('notes-empty');
            
            if (notes.length === 0) {
                emptyDiv.classList.remove('hidden');
                return;
            }
            
            emptyDiv.classList.add('hidden');
            
            // Remove existing note items (keep empty message and form)
            const existingNotes = notesList.querySelectorAll('[data-note-id]');
            existingNotes.forEach(note => note.remove());
            
            // Add new notes
            notes.forEach(note => {
                const noteDiv = document.createElement('div');
                noteDiv.className = 'bg-white rounded-xl border-2 border-gray-200 p-5 shadow-md hover:shadow-lg transition-all duration-200';
                noteDiv.setAttribute('data-note-id', note.id);
                noteDiv.innerHTML = `
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-900 mb-2">${escapeHtml(note.note)}</p>
                            <div class="flex items-center gap-3 text-xs text-gray-600">
                                <span class="flex items-center font-semibold">
                                    <svg class="w-4 h-4 mr-1 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    ${escapeHtml(note.user)}
                                </span>
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 mr-1 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    ${escapeHtml(note.created_at)}
                                </span>
                                <span class="text-gray-400">${escapeHtml(note.created_at_human)}</span>
                            </div>
                        </div>
                    </div>
                `;
                notesList.insertBefore(noteDiv, emptyDiv);
            });
        }

        function escapeHtml(text) {
            const div = document.createElement('div');
            div.textContent = text;
            return div.innerHTML;
        }
        <?php endif; ?>

        let currentDeleteFileId = null;

        function showDeleteConfirm(fileId, fileName) {
            currentDeleteFileId = fileId;
            document.getElementById('delete-file-name').textContent = fileName;
            document.getElementById('delete-form').action = `/files/${fileId}`;
            document.getElementById('delete-password').value = '';
            document.getElementById('delete-password-error').style.display = 'none';
            document.getElementById('delete-password').classList.remove('border-red-500');
            window.dispatchEvent(new CustomEvent('open-modal', { detail: 'delete-confirm' }));
        }

        function closeDeleteModal() {
            window.dispatchEvent(new CustomEvent('close-modal', { detail: 'delete-confirm' }));
            document.getElementById('delete-password').value = '';
            document.getElementById('delete-password-error').style.display = 'none';
            document.getElementById('delete-password').classList.remove('border-red-500');
        }

        document.getElementById('delete-form')?.addEventListener('submit', function(e) {
            e.preventDefault();
            const password = document.getElementById('delete-password').value;
            const errorDiv = document.getElementById('delete-password-error');
            const passwordInput = document.getElementById('delete-password');
            
            if (!password) {
                errorDiv.textContent = 'Password is required.';
                errorDiv.style.display = 'block';
                passwordInput.classList.add('border-red-500');
                return;
            }
            
            this.submit();
        });

        document.getElementById('delete-password')?.addEventListener('input', function() {
            const errorDiv = document.getElementById('delete-password-error');
            if (errorDiv.style.display !== 'none') {
                errorDiv.style.display = 'none';
                this.classList.remove('border-red-500');
            }
        });

        <?php if($errors->has('password') && session('delete_file_id')): ?>
            document.addEventListener('DOMContentLoaded', function() {
                setTimeout(function() {
                    showDeleteConfirm(<?php echo e(session('delete_file_id')); ?>, '<?php echo e(addslashes(session('delete_file_name', 'this file'))); ?>');
                    const errorDiv = document.getElementById('delete-password-error');
                    const passwordInput = document.getElementById('delete-password');
                    errorDiv.textContent = '<?php echo e($errors->first('password')); ?>';
                    errorDiv.style.display = 'block';
                    passwordInput.classList.add('border-red-500');
                }, 100);
            });
        <?php endif; ?>

        // Version Upload Functions
        function showUploadVersionModal() {
            window.dispatchEvent(new CustomEvent('open-modal', { detail: 'upload-version' }));
        }

        function closeUploadVersionModal() {
            window.dispatchEvent(new CustomEvent('close-modal', { detail: 'upload-version' }));
            clearVersionFile();
        }

        function handleVersionDragOver(e) {
            e.preventDefault();
            e.stopPropagation();
            e.currentTarget.classList.add('border-violet-500', 'bg-gradient-to-br', 'from-violet-100', 'to-purple-100');
        }

        function handleVersionDragLeave(e) {
            e.preventDefault();
            e.stopPropagation();
            e.currentTarget.classList.remove('border-violet-500', 'bg-gradient-to-br', 'from-violet-100', 'to-purple-100');
        }

        function handleVersionDrop(e) {
            e.preventDefault();
            e.stopPropagation();
            e.currentTarget.classList.remove('border-violet-500', 'bg-gradient-to-br', 'from-violet-100', 'to-purple-100');
            
            const files = e.dataTransfer.files;
            if (files.length > 0) {
                document.getElementById('version-file-input').files = files;
                handleVersionFileSelect({ target: { files: files } });
            }
        }

        function handleVersionFileSelect(e) {
            const file = e.target.files[0];
            if (!file) return;

            // Validate file size (10MB max)
            const maxSize = 10 * 1024 * 1024; // 10MB in bytes
            if (file.size > maxSize) {
                showVersionError('File size exceeds 10MB limit.');
                clearVersionFile();
                return;
            }

            // Validate file type
            const allowedTypes = ['.pdf', '.doc', '.docx', '.xls', '.xlsx', '.jpg', '.jpeg', '.png', '.gif'];
            const fileExtension = '.' + file.name.split('.').pop().toLowerCase();
            if (!allowedTypes.includes(fileExtension)) {
                showVersionError('File type not allowed. Please upload PDF, DOC, XLS, or Image files.');
                clearVersionFile();
                return;
            }

            hideVersionError();
            
            // Show preview
            document.getElementById('version-dropzone-content').classList.add('hidden');
            document.getElementById('version-file-preview').classList.remove('hidden');
            document.getElementById('version-file-name').textContent = file.name;
            document.getElementById('version-file-size').textContent = formatFileSize(file.size);
        }

        function clearVersionFile() {
            document.getElementById('version-file-input').value = '';
            document.getElementById('version-dropzone-content').classList.remove('hidden');
            document.getElementById('version-file-preview').classList.add('hidden');
            hideVersionError();
        }

        function showVersionError(message) {
            const errorDiv = document.getElementById('version-file-error');
            errorDiv.textContent = message;
            errorDiv.style.display = 'block';
        }

        function hideVersionError() {
            document.getElementById('version-file-error').style.display = 'none';
        }

        function formatFileSize(bytes) {
            if (bytes === 0) return '0 Bytes';
            const k = 1024;
            const sizes = ['Bytes', 'KB', 'MB', 'GB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return Math.round(bytes / Math.pow(k, i) * 100) / 100 + ' ' + sizes[i];
        }

        // Handle form submission
        document.getElementById('upload-version-form')?.addEventListener('submit', function(e) {
            const fileInput = document.getElementById('version-file-input');
            if (!fileInput.files || fileInput.files.length === 0) {
                e.preventDefault();
                showVersionError('Please select a file to upload.');
                return;
            }

            const btn = document.getElementById('version-upload-btn');
            btn.disabled = true;
            btn.innerHTML = '<svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>Uploading...';
        });
    </script>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php /**PATH C:\projects\filecr\resources\views/files/show.blade.php ENDPATH**/ ?>