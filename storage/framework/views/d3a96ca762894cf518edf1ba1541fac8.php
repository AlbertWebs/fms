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
            <h1 class="text-2xl font-semibold text-white">Purge System Data</h1>
            <p class="mt-1 text-sm text-gray-300">Delete all data except users</p>
        </div>
     <?php $__env->endSlot(); ?>

    <div class="max-w-4xl mx-auto">
        <div class="bg-gradient-to-br from-white via-red-50/30 to-orange-50/30 rounded-2xl border-2 border-red-200/60 shadow-xl backdrop-blur-sm overflow-hidden">
            <div class="p-6 border-b-2 border-red-200/60 bg-gradient-to-r from-red-50 to-orange-50">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <svg class="h-8 w-8 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h2 class="text-xl font-bold text-gray-900">Warning: Destructive Action</h2>
                        <p class="text-sm text-gray-700 mt-1">This action will permanently delete all data except user accounts. This cannot be undone.</p>
                    </div>
                </div>
            </div>

            <div class="p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Data to be Deleted:</h3>
                
                <div class="space-y-3 mb-6">
                    <div class="flex items-center justify-between p-4 bg-white rounded-lg border-2 border-gray-200">
                        <div class="flex items-center">
                            <svg class="h-5 w-5 text-gray-400 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            <span class="text-sm font-medium text-gray-900">Clients</span>
                        </div>
                        <span class="text-sm font-bold text-gray-600"><?php echo e(number_format($counts['clients'])); ?></span>
                    </div>

                    <div class="flex items-center justify-between p-4 bg-white rounded-lg border-2 border-gray-200">
                        <div class="flex items-center">
                            <svg class="h-5 w-5 text-gray-400 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            <span class="text-sm font-medium text-gray-900">Files</span>
                        </div>
                        <span class="text-sm font-bold text-gray-600"><?php echo e(number_format($counts['files'])); ?></span>
                    </div>

                    <div class="flex items-center justify-between p-4 bg-white rounded-lg border-2 border-gray-200">
                        <div class="flex items-center">
                            <svg class="h-5 w-5 text-gray-400 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                            </svg>
                            <span class="text-sm font-medium text-gray-900">Categories</span>
                        </div>
                        <span class="text-sm font-bold text-gray-600"><?php echo e(number_format($counts['categories'])); ?></span>
                    </div>

                    <div class="flex items-center justify-between p-4 bg-white rounded-lg border-2 border-gray-200">
                        <div class="flex items-center">
                            <svg class="h-5 w-5 text-gray-400 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            <span class="text-sm font-medium text-gray-900">File Requests</span>
                        </div>
                        <span class="text-sm font-bold text-gray-600"><?php echo e(number_format($counts['file_requests'])); ?></span>
                    </div>

                    <div class="flex items-center justify-between p-4 bg-white rounded-lg border-2 border-gray-200">
                        <div class="flex items-center">
                            <svg class="h-5 w-5 text-gray-400 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            <span class="text-sm font-medium text-gray-900">Audit Logs</span>
                        </div>
                        <span class="text-sm font-bold text-gray-600"><?php echo e(number_format($counts['audit_logs'])); ?></span>
                    </div>

                    <div class="flex items-center justify-between p-4 bg-white rounded-lg border-2 border-gray-200">
                        <div class="flex items-center">
                            <svg class="h-5 w-5 text-gray-400 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            <span class="text-sm font-medium text-gray-900">Email Logs</span>
                        </div>
                        <span class="text-sm font-bold text-gray-600"><?php echo e(number_format($counts['email_logs'])); ?></span>
                    </div>

                    <div class="flex items-center justify-between p-4 bg-white rounded-lg border-2 border-gray-200">
                        <div class="flex items-center">
                            <svg class="h-5 w-5 text-gray-400 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                            <span class="text-sm font-medium text-gray-900">Roles & Permissions</span>
                        </div>
                        <span class="text-sm font-bold text-gray-600"><?php echo e(number_format($counts['roles'])); ?> roles, <?php echo e(number_format($counts['permissions'])); ?> permissions</span>
                    </div>
                </div>

                <div class="bg-green-50 border-2 border-green-200 rounded-lg p-4 mb-6">
                    <div class="flex items-center">
                        <svg class="h-5 w-5 text-green-600 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span class="text-sm font-semibold text-green-800">Users will be preserved</span>
                    </div>
                </div>

                <?php if(session('success')): ?>
                    <div class="mb-4 p-4 bg-green-50 border-2 border-green-200 rounded-lg">
                        <p class="text-sm font-semibold text-green-800"><?php echo e(session('success')); ?></p>
                    </div>
                <?php endif; ?>

                <?php if(session('error')): ?>
                    <div class="mb-4 p-4 bg-red-50 border-2 border-red-200 rounded-lg">
                        <p class="text-sm font-semibold text-red-800"><?php echo e(session('error')); ?></p>
                    </div>
                <?php endif; ?>

                <form method="POST" action="<?php echo e(route('admin.purge.execute')); ?>" 
                      x-data="{ confirming: false, confirmText: '' }"
                      @submit.prevent="if(confirming && confirmText === 'DELETE') { $el.submit(); } else { confirming = true; }">
                    <?php echo csrf_field(); ?>
                    
                    <div x-show="!confirming" class="space-y-4">
                        <button type="button" 
                                @click="confirming = true"
                                class="w-full px-6 py-3 bg-gradient-to-r from-red-600 to-red-700 border border-transparent rounded-xl font-bold text-sm text-white hover:from-red-700 hover:to-red-800 transition-all duration-200 shadow-lg hover:shadow-xl">
                            Purge All Data
                        </button>
                    </div>

                    <div x-show="confirming" class="space-y-4" style="display: none;">
                        <div class="p-4 bg-red-50 border-2 border-red-300 rounded-lg">
                            <p class="text-sm font-semibold text-red-900 mb-2">Final Confirmation</p>
                            <p class="text-sm text-red-700 mb-4">Type <strong>DELETE</strong> in the field below to confirm:</p>
                            <input type="text" 
                                   x-model="confirmText"
                                   placeholder="Type DELETE to confirm"
                                   class="w-full px-4 py-2 border-2 border-red-300 rounded-lg focus:border-red-500 focus:ring-2 focus:ring-red-300 text-sm"
                                   autocomplete="off">
                        </div>
                        <div class="flex gap-3">
                            <button type="button" 
                                    @click="confirming = false; confirmText = ''"
                                    class="flex-1 px-6 py-3 bg-white border-2 border-gray-300 rounded-xl font-semibold text-sm text-gray-700 hover:bg-gray-50 transition-all duration-200">
                                Cancel
                            </button>
                            <button type="submit" 
                                    x-bind:disabled="confirmText !== 'DELETE'"
                                    x-bind:class="confirmText === 'DELETE' ? 'bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800' : 'bg-gray-400 cursor-not-allowed'"
                                    class="flex-1 px-6 py-3 border border-transparent rounded-xl font-bold text-sm text-white transition-all duration-200 shadow-lg">
                                Confirm Purge
                            </button>
                        </div>
                    </div>
                </form>
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
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\fms\resources\views/admin/purge/index.blade.php ENDPATH**/ ?>