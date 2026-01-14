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
        <div>
            <h1 class="text-3xl font-bold text-white">File Request Details</h1>
            <p class="mt-1 text-sm text-gray-300">View file request information</p>
        </div>
     <?php $__env->endSlot(); ?>

    <div class="max-w-6xl mx-auto space-y-6">
        <!-- Request Header Card -->
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
                            <h2 class="text-xl font-bold text-gray-900 truncate"><?php echo e($fileRequest->title); ?></h2>
                            <?php if($fileRequest->description): ?>
                                <p class="text-sm font-medium text-gray-600 mt-1"><?php echo e($fileRequest->description); ?></p>
                            <?php endif; ?>
                            <div class="mt-3 flex items-center gap-4 flex-wrap">
                                <?php
                                    $statusColors = [
                                        'completed' => 'bg-gradient-to-r from-emerald-100 to-green-100 text-emerald-800 border-2 border-emerald-300',
                                        'expired' => 'bg-gradient-to-r from-slate-100 to-gray-100 text-slate-800 border-2 border-slate-300',
                                        'pending' => 'bg-gradient-to-r from-amber-100 to-orange-100 text-amber-800 border-2 border-amber-300',
                                    ];
                                    $statusColor = $statusColors[$fileRequest->status] ?? $statusColors['pending'];
                                ?>
                                <span class="inline-flex items-center px-3 py-1.5 rounded-lg text-xs font-bold border shadow-sm <?php echo e($statusColor); ?>">
                                    <?php echo e(ucfirst($fileRequest->status)); ?>

                                </span>
                                <span class="flex items-center text-sm text-gray-600">
                                    <svg class="w-4 h-4 mr-1.5 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    <?php echo e($fileRequest->requester->name); ?>

                                </span>
                                <span class="flex items-center text-sm text-gray-600">
                                    <svg class="w-4 h-4 mr-1.5 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <?php echo e($fileRequest->created_at->format('M d, Y H:i')); ?>

                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Request Information -->
            <div class="p-8">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Client -->
                    <div class="bg-gradient-to-br from-indigo-50/50 to-purple-50/30 rounded-xl border-2 border-indigo-200 p-5">
                        <dt class="text-xs font-bold text-gray-600 uppercase tracking-wide mb-2 flex items-center">
                            <svg class="w-4 h-4 mr-1.5 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            Client
                        </dt>
                        <dd class="text-base font-bold text-gray-900"><?php echo e($fileRequest->client->name); ?></dd>
                        <?php if($fileRequest->client->email): ?>
                            <dd class="text-sm font-medium text-indigo-600 mt-1">
                                <a href="mailto:<?php echo e($fileRequest->client->email); ?>" class="hover:underline"><?php echo e($fileRequest->client->email); ?></a>
                            </dd>
                        <?php endif; ?>
                    </div>

                    <!-- Category -->
                    <div class="bg-gradient-to-br from-purple-50/50 to-pink-50/30 rounded-xl border-2 border-purple-200 p-5">
                        <dt class="text-xs font-bold text-gray-600 uppercase tracking-wide mb-2 flex items-center">
                            <svg class="w-4 h-4 mr-1.5 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                            </svg>
                            Category
                        </dt>
                        <dd class="text-base font-bold text-gray-900"><?php echo e($fileRequest->category->name ?? '—'); ?></dd>
                    </div>

                    <!-- Financial Year -->
                    <div class="bg-gradient-to-br from-pink-50/50 to-violet-50/30 rounded-xl border-2 border-pink-200 p-5">
                        <dt class="text-xs font-bold text-gray-600 uppercase tracking-wide mb-2 flex items-center">
                            <svg class="w-4 h-4 mr-1.5 text-pink-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            Financial Year
                        </dt>
                        <dd class="text-base font-bold text-gray-900"><?php echo e($fileRequest->financial_year ?? '—'); ?></dd>
                    </div>

                    <!-- Requested By -->
                    <div class="bg-gradient-to-br from-violet-50/50 to-indigo-50/30 rounded-xl border-2 border-violet-200 p-5">
                        <dt class="text-xs font-bold text-gray-600 uppercase tracking-wide mb-2 flex items-center">
                            <svg class="w-4 h-4 mr-1.5 text-violet-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            Requested By
                        </dt>
                        <dd class="text-base font-bold text-gray-900"><?php echo e($fileRequest->requester->name); ?></dd>
                        <dd class="text-sm font-medium text-gray-600 mt-1"><?php echo e($fileRequest->created_at->format('M d, Y H:i')); ?></dd>
                    </div>

                    <!-- Expires -->
                    <div class="bg-gradient-to-br from-emerald-50/50 to-teal-50/30 rounded-xl border-2 border-emerald-200 p-5">
                        <dt class="text-xs font-bold text-gray-600 uppercase tracking-wide mb-2 flex items-center">
                            <svg class="w-4 h-4 mr-1.5 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Expires
                        </dt>
                        <dd class="text-base font-bold text-gray-900">
                            <?php echo e($fileRequest->expires_at ? $fileRequest->expires_at->format('M d, Y') : '—'); ?>

                        </dd>
                        <?php if($fileRequest->expires_at && $fileRequest->expires_at->isFuture()): ?>
                            <dd class="text-sm font-medium text-emerald-600 mt-1"><?php echo e($fileRequest->expires_at->diffForHumans()); ?></dd>
                        <?php elseif($fileRequest->expires_at && $fileRequest->expires_at->isPast()): ?>
                            <dd class="text-sm font-medium text-red-600 mt-1">Expired</dd>
                        <?php endif; ?>
                    </div>

                    <!-- Status -->
                    <div class="bg-gradient-to-br from-cyan-50/50 to-blue-50/30 rounded-xl border-2 border-cyan-200 p-5">
                        <dt class="text-xs font-bold text-gray-600 uppercase tracking-wide mb-2 flex items-center">
                            <svg class="w-4 h-4 mr-1.5 text-cyan-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Status
                        </dt>
                        <dd class="mt-1">
                            <span class="inline-flex items-center px-3 py-1.5 rounded-lg text-xs font-bold border shadow-sm <?php echo e($statusColor); ?>">
                                <?php echo e(ucfirst($fileRequest->status)); ?>

                            </span>
                        </dd>
                    </div>
                </div>

                <?php if($fileRequest->status === 'pending'): ?>
                    <!-- Upload Link Section -->
                    <div class="mt-8 pt-8 border-t-2 border-indigo-200">
                        <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                            </svg>
                            Upload Link
                        </h3>
                        <div class="bg-gradient-to-br from-indigo-50/50 to-purple-50/30 rounded-xl border-2 border-indigo-200 p-6">
                            <p class="text-sm font-semibold text-gray-700 mb-3">Share this link with the client to allow them to upload files:</p>
                            <div class="flex items-center gap-3">
                                <input type="text" 
                                       readonly 
                                       value="<?php echo e(route('file-requests.upload', $fileRequest->token)); ?>" 
                                       id="upload-link"
                                       class="flex-1 px-4 py-3 border-2 border-indigo-200 rounded-xl bg-white text-gray-900 font-medium text-sm focus:outline-none focus:border-indigo-400 transition-all duration-200" />
                                <button onclick="copyToClipboard()" 
                                        id="copy-btn"
                                        class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 border border-transparent rounded-xl font-bold text-sm text-white hover:from-indigo-700 hover:via-purple-700 hover:to-pink-700 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                                    <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                    </svg>
                                    Copy Link
                                </button>
                            </div>
                            <p class="mt-3 text-xs font-medium text-gray-600 flex items-center">
                                <svg class="w-4 h-4 mr-1.5 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                                This link will expire on <?php echo e($fileRequest->expires_at->format('M d, Y')); ?> (<?php echo e($fileRequest->expires_at->diffForHumans()); ?>)
                            </p>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex items-center justify-center gap-4">
            <a href="<?php echo e(route('file-requests.index')); ?>" class="inline-flex items-center px-6 py-3 bg-white border-2 border-gray-300 rounded-xl font-semibold text-sm text-gray-700 hover:bg-gray-50 hover:border-gray-400 transition-all duration-200 shadow-sm hover:shadow-md">
                <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back to Requests
            </a>
        </div>
    </div>

    <script>
        function copyToClipboard() {
            const input = document.getElementById('upload-link');
            input.select();
            input.setSelectionRange(0, 99999);
            navigator.clipboard.writeText(input.value).then(() => {
                // Show feedback
                const button = document.getElementById('copy-btn');
                const originalHTML = button.innerHTML;
                button.innerHTML = `
                    <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    Copied!
                `;
                button.classList.add('bg-gradient-to-r', 'from-emerald-600', 'to-green-600', 'hover:from-emerald-700', 'hover:to-green-700');
                button.classList.remove('from-indigo-600', 'via-purple-600', 'to-pink-600', 'hover:from-indigo-700', 'hover:via-purple-700', 'hover:to-pink-700');
                
                setTimeout(() => {
                    button.innerHTML = originalHTML;
                    button.classList.remove('from-emerald-600', 'to-green-600', 'hover:from-emerald-700', 'hover:to-green-700');
                    button.classList.add('from-indigo-600', 'via-purple-600', 'to-pink-600', 'hover:from-indigo-700', 'hover:via-purple-700', 'hover:to-pink-700');
                }, 2000);
            }).catch(() => {
                // Fallback for older browsers
                document.execCommand('copy');
                const button = document.getElementById('copy-btn');
                const originalHTML = button.innerHTML;
                button.innerHTML = `
                    <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    Copied!
                `;
                setTimeout(() => {
                    button.innerHTML = originalHTML;
                }, 2000);
            });
        }
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
<?php /**PATH C:\projects\filecr\resources\views/file-requests/show.blade.php ENDPATH**/ ?>