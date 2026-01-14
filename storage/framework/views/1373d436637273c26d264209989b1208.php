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
            <h1 class="text-3xl font-bold text-white">Dashboard</h1>
            <p class="mt-1 text-sm text-gray-300">Welcome back! Here's what's happening with your files.</p>
        </div>
     <?php $__env->endSlot(); ?>

    <div class="space-y-6">
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
            <a href="<?php echo e(route('clients.index')); ?>" class="bg-gradient-to-br from-indigo-50 via-purple-50 to-pink-50 rounded-2xl border-2 border-indigo-200/60 p-6 hover:border-indigo-300 hover:shadow-xl transition-all duration-200 group transform hover:-translate-y-1">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="flex items-center justify-center h-14 w-14 rounded-xl bg-gradient-to-br from-indigo-500 to-purple-500 group-hover:from-indigo-600 group-hover:to-purple-600 transition-all duration-200 shadow-lg">
                            <svg class="h-7 w-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4 flex-1">
                        <p class="text-sm font-semibold text-gray-600 uppercase tracking-wide">Total Clients</p>
                        <p class="text-3xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent mt-1"><?php echo e($totalClients); ?></p>
                        <p class="text-xs text-gray-500 mt-1 group-hover:text-indigo-600 transition-colors">View all clients →</p>
                    </div>
                </div>
            </a>

            <a href="<?php echo e(route('files.index')); ?>" class="bg-gradient-to-br from-blue-50 via-cyan-50 to-teal-50 rounded-2xl border-2 border-blue-200/60 p-6 hover:border-blue-300 hover:shadow-xl transition-all duration-200 group transform hover:-translate-y-1">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="flex items-center justify-center h-14 w-14 rounded-xl bg-gradient-to-br from-blue-500 to-cyan-500 group-hover:from-blue-600 group-hover:to-cyan-600 transition-all duration-200 shadow-lg">
                            <svg class="h-7 w-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4 flex-1">
                        <p class="text-sm font-semibold text-gray-600 uppercase tracking-wide">Files This Month</p>
                        <p class="text-3xl font-bold bg-gradient-to-r from-blue-600 to-cyan-600 bg-clip-text text-transparent mt-1"><?php echo e($filesThisMonth); ?></p>
                        <p class="text-xs text-gray-500 mt-1 group-hover:text-blue-600 transition-colors">View all files →</p>
                    </div>
                </div>
            </a>

            <div class="bg-gradient-to-br from-emerald-50 via-green-50 to-teal-50 rounded-2xl border-2 border-emerald-200/60 p-6 hover:border-emerald-300 hover:shadow-xl transition-all duration-200 group transform hover:-translate-y-1">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="flex items-center justify-center h-14 w-14 rounded-xl bg-gradient-to-br from-emerald-500 to-green-500 group-hover:from-emerald-600 group-hover:to-green-600 transition-all duration-200 shadow-lg">
                            <svg class="h-7 w-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4" />
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4 flex-1">
                        <p class="text-sm font-semibold text-gray-600 uppercase tracking-wide">Storage Usage</p>
                        <p class="text-3xl font-bold bg-gradient-to-r from-emerald-600 to-green-600 bg-clip-text text-transparent mt-1"><?php echo e(number_format($storageUsage / 1024 / 1024, 2)); ?> MB</p>
                        <p class="text-xs text-gray-500 mt-1"><?php echo e(number_format($storageUsage / 1024 / 1024 / 1024, 2)); ?> GB total</p>
                    </div>
                </div>
            </div>

            <a href="<?php echo e(route('audit-logs.index')); ?>" class="bg-gradient-to-br from-amber-50 via-orange-50 to-yellow-50 rounded-2xl border-2 border-amber-200/60 p-6 hover:border-amber-300 hover:shadow-xl transition-all duration-200 group transform hover:-translate-y-1">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="flex items-center justify-center h-14 w-14 rounded-xl bg-gradient-to-br from-amber-500 to-orange-500 group-hover:from-amber-600 group-hover:to-orange-600 transition-all duration-200 shadow-lg">
                            <svg class="h-7 w-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4 flex-1">
                        <p class="text-sm font-semibold text-gray-600 uppercase tracking-wide">Recent Activity</p>
                        <p class="text-3xl font-bold bg-gradient-to-r from-amber-600 to-orange-600 bg-clip-text text-transparent mt-1"><?php echo e($recentActivity->count()); ?></p>
                        <p class="text-xs text-gray-500 mt-1 group-hover:text-amber-600 transition-colors">View all logs →</p>
                    </div>
                </div>
            </a>
        </div>

        <!-- Recent Activity Timeline -->
        <div class="bg-gradient-to-br from-white via-indigo-50/30 to-purple-50/30 rounded-2xl border-2 border-indigo-200/60 shadow-xl backdrop-blur-sm overflow-hidden">
            <div class="px-6 py-5 border-b-2 border-indigo-200/60 bg-gradient-to-r from-indigo-50/80 via-purple-50/80 to-pink-50/80">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-xl font-bold text-gray-900">Recent Activity</h2>
                        <p class="text-sm text-gray-600 mt-0.5">Latest system activities and events</p>
                    </div>
                    <?php if($recentActivity->count() > 0): ?>
                        <a href="<?php echo e(route('audit-logs.index')); ?>" class="inline-flex items-center px-4 py-2 text-sm font-semibold text-indigo-700 bg-indigo-100 hover:bg-indigo-200 rounded-lg transition-colors duration-200">
                            View All
                            <svg class="ml-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
            <div class="p-6">
                <?php $__empty_1 = true; $__currentLoopData = $recentActivity; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="flex items-start space-x-4 py-4 <?php echo e(!$loop->last ? 'border-b border-gray-200/60' : ''); ?> hover:bg-white/50 rounded-lg px-3 -mx-3 transition-colors duration-200">
                        <div class="flex-shrink-0 mt-1">
                            <div class="h-3 w-3 rounded-full bg-gradient-to-br from-indigo-500 to-purple-500 ring-4 ring-indigo-100"></div>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-semibold text-gray-900 leading-relaxed"><?php echo e($activity->description); ?></p>
                            <div class="mt-1.5 flex items-center space-x-3">
                                <p class="text-xs text-gray-500 flex items-center">
                                    <svg class="h-3.5 w-3.5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    <?php echo e($activity->user->name ?? 'System'); ?>

                                </p>
                                <p class="text-xs text-gray-400">•</p>
                                <p class="text-xs text-gray-500 flex items-center">
                                    <svg class="h-3.5 w-3.5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <?php echo e($activity->created_at->diffForHumans()); ?>

                                </p>
                            </div>
                        </div>
                        <div class="flex-shrink-0">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-gradient-to-r from-indigo-100 to-purple-100 text-indigo-700 border border-indigo-200/60">
                                <?php echo e($activity->action); ?>

                            </span>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="text-center py-16">
                        <div class="inline-flex items-center justify-center h-16 w-16 rounded-full bg-gradient-to-br from-gray-100 to-gray-200 mb-4">
                            <svg class="h-8 w-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 mt-4">No recent activity</h3>
                        <p class="mt-2 text-sm text-gray-600 max-w-sm mx-auto">Activity will appear here as users interact with the system. Check back later for updates.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?><?php /**PATH C:\projects\filecr\resources\views/dashboard.blade.php ENDPATH**/ ?>