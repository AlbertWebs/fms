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
            <h1 class="text-3xl font-bold text-white">File Requests</h1>
            <p class="mt-1 text-sm text-gray-300">Request files from clients</p>
        </div>
     <?php $__env->endSlot(); ?>

    <div class="space-y-6">
        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
            <div class="bg-gradient-to-br from-indigo-50 via-purple-50 to-pink-50 rounded-2xl border-2 border-indigo-200/60 p-6 hover:border-indigo-300 hover:shadow-xl transition-all duration-200 group transform hover:-translate-y-1">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="flex items-center justify-center h-14 w-14 rounded-xl bg-gradient-to-br from-indigo-500 to-purple-500 group-hover:from-indigo-600 group-hover:to-purple-600 transition-all duration-200 shadow-lg">
                            <svg class="h-7 w-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-semibold text-gray-600 uppercase tracking-wide">Total Requests</p>
                        <p class="text-3xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent mt-1"><?php echo e($fileRequests->total()); ?></p>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-amber-50 via-orange-50 to-yellow-50 rounded-2xl border-2 border-amber-200/60 p-6 hover:border-amber-300 hover:shadow-xl transition-all duration-200 group transform hover:-translate-y-1">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="flex items-center justify-center h-14 w-14 rounded-xl bg-gradient-to-br from-amber-500 to-orange-500 group-hover:from-amber-600 group-hover:to-orange-600 transition-all duration-200 shadow-lg">
                            <svg class="h-7 w-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-semibold text-gray-600 uppercase tracking-wide">Pending</p>
                        <p class="text-3xl font-bold bg-gradient-to-r from-amber-600 to-orange-600 bg-clip-text text-transparent mt-1"><?php echo e($fileRequests->where('status', 'pending')->count()); ?></p>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-emerald-50 via-green-50 to-teal-50 rounded-2xl border-2 border-emerald-200/60 p-6 hover:border-emerald-300 hover:shadow-xl transition-all duration-200 group transform hover:-translate-y-1">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="flex items-center justify-center h-14 w-14 rounded-xl bg-gradient-to-br from-emerald-500 to-green-500 group-hover:from-emerald-600 group-hover:to-green-600 transition-all duration-200 shadow-lg">
                            <svg class="h-7 w-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-semibold text-gray-600 uppercase tracking-wide">Completed</p>
                        <p class="text-3xl font-bold bg-gradient-to-r from-emerald-600 to-green-600 bg-clip-text text-transparent mt-1"><?php echo e($fileRequests->where('status', 'completed')->count()); ?></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Search & Filters -->
        <div class="bg-gradient-to-br from-white via-indigo-50/30 to-purple-50/30 rounded-2xl border-2 border-indigo-200/60 shadow-xl p-6 backdrop-blur-sm">
            <form method="GET" action="<?php echo e(route('file-requests.index')); ?>" class="space-y-4">
                <div class="flex flex-col sm:flex-row gap-4">
                    <div class="sm:w-48">
                        <label class="block text-xs font-bold text-gray-700 mb-2 uppercase tracking-wide">Status</label>
                        <select name="status" class="block w-full px-4 py-3 border-2 border-purple-200 rounded-xl bg-white text-gray-900 font-medium focus:border-purple-400 focus:ring-2 focus:ring-purple-300 transition-all duration-200 shadow-sm">
                            <option value="">All Statuses</option>
                            <option value="pending" <?php echo e(request('status') == 'pending' ? 'selected' : ''); ?>>Pending</option>
                            <option value="completed" <?php echo e(request('status') == 'completed' ? 'selected' : ''); ?>>Completed</option>
                            <option value="expired" <?php echo e(request('status') == 'expired' ? 'selected' : ''); ?>>Expired</option>
                        </select>
                    </div>
                    <div class="sm:w-48">
                        <label class="block text-xs font-bold text-gray-700 mb-2 uppercase tracking-wide">Client</label>
                        <select name="client_id" class="block w-full px-4 py-3 border-2 border-indigo-200 rounded-xl bg-white text-gray-900 font-medium focus:border-indigo-400 focus:ring-2 focus:ring-indigo-300 transition-all duration-200 shadow-sm">
                            <option value="">All Clients</option>
                            <?php $__currentLoopData = $clients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($client->id); ?>" <?php echo e(request('client_id') == $client->id ? 'selected' : ''); ?>><?php echo e($client->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('files.upload')): ?>
                        <div class="flex items-end">
                            <a href="<?php echo e(route('file-requests.create')); ?>" class="inline-flex items-center justify-center px-5 py-2.5 bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 border border-transparent rounded-xl font-bold text-sm text-white hover:from-indigo-700 hover:via-purple-700 hover:to-pink-700 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                                <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                                New Request
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="flex items-center justify-between pt-4 border-t-2 border-indigo-200">
                    <div class="flex gap-3">
                        <button type="submit" class="inline-flex items-center px-5 py-2.5 bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 border border-transparent rounded-xl font-semibold text-sm text-white hover:from-indigo-700 hover:via-purple-700 hover:to-pink-700 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                            <svg class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                            </svg>
                            Apply Filters
                        </button>
                        <?php if(request('status') || request('client_id')): ?>
                            <a href="<?php echo e(route('file-requests.index')); ?>" class="inline-flex items-center px-5 py-2.5 bg-white border-2 border-gray-300 rounded-xl font-semibold text-sm text-gray-700 hover:bg-gray-50 hover:border-gray-400 transition-all duration-200 shadow-sm hover:shadow-md">
                                <svg class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                                Clear Filters
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </form>
        </div>

        <!-- Table -->
        <div class="bg-gradient-to-br from-white via-indigo-50/30 to-purple-50/30 rounded-2xl border-2 border-indigo-200/60 shadow-xl overflow-hidden backdrop-blur-sm">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 sticky top-0 z-10 shadow-lg">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">
                                <div class="flex items-center space-x-2">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    <span>Title</span>
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">
                                <div class="flex items-center space-x-2">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                    <span>Client</span>
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">
                                <div class="flex items-center space-x-2">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                    </svg>
                                    <span>Category</span>
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">
                                <div class="flex items-center space-x-2">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    <span>Requested By</span>
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">Status</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">
                                <div class="flex items-center space-x-2">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <span>Expires</span>
                                </div>
                            </th>
                            <th class="px-6 py-4 text-right text-xs font-bold text-white uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php $__empty_1 = true; $__currentLoopData = $fileRequests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fileRequest): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr class="hover:bg-gradient-to-r hover:from-indigo-50/50 hover:to-purple-50/30 transition-all duration-150 <?php echo e($loop->even ? 'bg-gray-50/30' : 'bg-white'); ?> cursor-pointer group" onclick="window.location.href='<?php echo e(route('file-requests.show', $fileRequest)); ?>'">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-bold text-gray-900 group-hover:text-indigo-700 transition-colors"><?php echo e($fileRequest->title); ?></div>
                                    <?php if($fileRequest->description): ?>
                                        <div class="text-xs font-medium text-gray-600 mt-1"><?php echo e(Str::limit($fileRequest->description, 50)); ?></div>
                                    <?php endif; ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-semibold text-gray-800"><?php echo e($fileRequest->client->name); ?></div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <?php if($fileRequest->category): ?>
                                        <span class="px-2.5 py-1 text-xs font-bold rounded-full bg-gradient-to-r from-indigo-100 to-purple-100 text-indigo-700 border-2 border-indigo-200">
                                            <?php echo e($fileRequest->category->name); ?>

                                        </span>
                                    <?php else: ?>
                                        <span class="text-sm text-gray-400">—</span>
                                    <?php endif; ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-semibold text-gray-800"><?php echo e($fileRequest->requester->name); ?></div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap" onclick="event.stopPropagation()">
                                    <?php if($fileRequest->status === 'completed'): ?>
                                        <span class="inline-flex items-center px-2.5 py-1.5 rounded-lg text-xs font-bold border shadow-sm bg-gradient-to-r from-emerald-100 to-green-100 text-emerald-800 border-2 border-emerald-300">
                                            Completed
                                        </span>
                                    <?php elseif($fileRequest->status === 'expired'): ?>
                                        <span class="inline-flex items-center px-2.5 py-1.5 rounded-lg text-xs font-bold border shadow-sm bg-gradient-to-r from-slate-100 to-gray-100 text-slate-800 border-2 border-slate-300">
                                            Expired
                                        </span>
                                    <?php else: ?>
                                        <span class="inline-flex items-center px-2.5 py-1.5 rounded-lg text-xs font-bold border shadow-sm bg-gradient-to-r from-amber-100 to-orange-100 text-amber-800 border-2 border-amber-300">
                                            Pending
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-semibold text-gray-800">
                                        <?php echo e($fileRequest->expires_at ? $fileRequest->expires_at->format('M d, Y') : '—'); ?>

                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium" onclick="event.stopPropagation()">
                                    <?php if (isset($component)) { $__componentOriginal3bb36eedd7bcefc353ba4ac566fed84b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3bb36eedd7bcefc353ba4ac566fed84b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.table-action-dropdown','data' => ['item' => $fileRequest]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('table-action-dropdown'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['item' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($fileRequest)]); ?>
                                        <a href="<?php echo e(route('file-requests.show', $fileRequest)); ?>" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gradient-to-r hover:from-blue-50 hover:to-cyan-50 hover:text-blue-700 transition-colors">View</a>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('files.delete')): ?>
                                            <form method="POST" action="<?php echo e(route('file-requests.destroy', $fileRequest)); ?>" 
                                                  x-data="{ confirmDelete() { if(confirm('Are you sure you want to delete this file request?')) { this.submit(); } } }"
                                                  @submit.prevent="confirmDelete()">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gradient-to-r hover:from-red-50 hover:to-pink-50 transition-colors">Delete</button>
                                            </form>
                                        <?php endif; ?>
                                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal3bb36eedd7bcefc353ba4ac566fed84b)): ?>
<?php $attributes = $__attributesOriginal3bb36eedd7bcefc353ba4ac566fed84b; ?>
<?php unset($__attributesOriginal3bb36eedd7bcefc353ba4ac566fed84b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal3bb36eedd7bcefc353ba4ac566fed84b)): ?>
<?php $component = $__componentOriginal3bb36eedd7bcefc353ba4ac566fed84b; ?>
<?php unset($__componentOriginal3bb36eedd7bcefc353ba4ac566fed84b); ?>
<?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="7" class="px-6 py-16 text-center">
                                    <div class="flex flex-col items-center">
                                        <div class="flex items-center justify-center h-20 w-20 rounded-full bg-gradient-to-br from-indigo-100 to-purple-100 mb-4">
                                            <svg class="h-10 w-10 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                        </div>
                                        <h3 class="text-lg font-bold text-gray-900">No file requests found</h3>
                                        <p class="mt-2 text-sm text-gray-600 max-w-sm">
                                            <?php if(request('status') || request('client_id')): ?>
                                                No file requests match your current filters. Try adjusting your search criteria.
                                            <?php else: ?>
                                                Get started by creating a new file request.
                                            <?php endif; ?>
                                        </p>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('files.upload')): ?>
                                            <div class="mt-6">
                                                <a href="<?php echo e(route('file-requests.create')); ?>">
                                                    <button class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 border border-transparent rounded-xl font-bold text-sm text-white hover:from-indigo-700 hover:via-purple-700 hover:to-pink-700 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                                                        <svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                                        </svg>
                                                        Create First Request
                                                    </button>
                                                </a>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <?php if($fileRequests->hasPages()): ?>
                <div class="px-6 py-4 border-t-2 border-indigo-200 bg-gradient-to-r from-gray-50 to-indigo-50/30">
                    <?php echo e($fileRequests->links()); ?>

                </div>
            <?php endif; ?>
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
<?php endif; ?>
<?php /**PATH C:\projects\filecr\resources\views/file-requests/index.blade.php ENDPATH**/ ?>