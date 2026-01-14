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
            <h1 class="text-3xl font-bold text-white">Client Details</h1>
            <p class="mt-1 text-sm text-gray-300"><?php echo e($client->name); ?></p>
        </div>
     <?php $__env->endSlot(); ?>

    <div class="max-w-7xl mx-auto space-y-6">
        <?php if(session('success')): ?>
            <div class="bg-gradient-to-r from-emerald-50 to-green-50 border-2 border-emerald-200 text-emerald-700 px-6 py-4 rounded-xl shadow-md">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <?php echo e(session('success')); ?>

                </div>
            </div>
        <?php endif; ?>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
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
                        <p class="text-sm font-semibold text-gray-600 uppercase tracking-wide">Total Files</p>
                        <p class="text-3xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent mt-1"><?php echo e($totalFiles); ?></p>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-blue-50 via-cyan-50 to-teal-50 rounded-2xl border-2 border-blue-200/60 p-6 hover:border-blue-300 hover:shadow-xl transition-all duration-200 group transform hover:-translate-y-1">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="flex items-center justify-center h-14 w-14 rounded-xl bg-gradient-to-br from-blue-500 to-cyan-500 group-hover:from-blue-600 group-hover:to-cyan-600 transition-all duration-200 shadow-lg">
                            <svg class="h-7 w-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4" />
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-semibold text-gray-600 uppercase tracking-wide">Storage Used</p>
                        <p class="text-3xl font-bold bg-gradient-to-r from-blue-600 to-cyan-600 bg-clip-text text-transparent mt-1">
                            <?php echo e(number_format($totalSize / 1024 / 1024, 2)); ?> MB
                        </p>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-emerald-50 via-green-50 to-teal-50 rounded-2xl border-2 border-emerald-200/60 p-6 hover:border-emerald-300 hover:shadow-xl transition-all duration-200 group transform hover:-translate-y-1">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="flex items-center justify-center h-14 w-14 rounded-xl bg-gradient-to-br from-emerald-500 to-green-500 group-hover:from-emerald-600 group-hover:to-green-600 transition-all duration-200 shadow-lg">
                            <svg class="h-7 w-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-semibold text-gray-600 uppercase tracking-wide">Categories</p>
                        <p class="text-3xl font-bold bg-gradient-to-r from-emerald-600 to-green-600 bg-clip-text text-transparent mt-1"><?php echo e($categoriesCount); ?></p>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-purple-50 via-pink-50 to-violet-50 rounded-2xl border-2 border-purple-200/60 p-6 hover:border-purple-300 hover:shadow-xl transition-all duration-200 group transform hover:-translate-y-1">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="flex items-center justify-center h-14 w-14 rounded-xl bg-gradient-to-br from-purple-500 to-pink-500 group-hover:from-purple-600 group-hover:to-pink-600 transition-all duration-200 shadow-lg">
                            <svg class="h-7 w-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-semibold text-gray-600 uppercase tracking-wide">Status</p>
                        <p class="mt-1">
                            <?php
                                $statusColors = [
                                    'active' => 'bg-gradient-to-r from-emerald-100 to-green-100 text-emerald-800 border-2 border-emerald-300',
                                    'dormant' => 'bg-gradient-to-r from-amber-100 to-orange-100 text-amber-800 border-2 border-amber-300',
                                    'archived' => 'bg-gradient-to-r from-slate-100 to-gray-100 text-slate-800 border-2 border-slate-300',
                                ];
                                $statusColor = $statusColors[strtolower($client->status)] ?? $statusColors['active'];
                            ?>
                            <span class="inline-flex items-center px-3 py-1.5 rounded-lg text-xs font-bold border shadow-sm <?php echo e($statusColor); ?>">
                                <?php echo e(ucfirst($client->status)); ?>

                            </span>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Client Information Card -->
        <div class="bg-gradient-to-br from-white via-indigo-50/30 to-purple-50/30 rounded-2xl border-2 border-indigo-200/60 shadow-xl overflow-hidden backdrop-blur-sm">
            <div class="px-8 py-6 border-b-2 border-indigo-200/50 bg-gradient-to-r from-indigo-500/10 via-purple-500/10 to-pink-500/10">
                <h2 class="text-xl font-bold text-gray-900 flex items-center">
                    <svg class="w-6 h-6 mr-2 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    Client Information
                </h2>
            </div>
            <div class="p-8">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div class="bg-gradient-to-br from-indigo-50/50 to-purple-50/30 rounded-xl border-2 border-indigo-200 p-5">
                        <dt class="text-xs font-bold text-gray-600 uppercase tracking-wide mb-2 flex items-center">
                            <svg class="w-4 h-4 mr-1.5 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            Full Name
                        </dt>
                        <dd class="text-base font-bold text-gray-900"><?php echo e($client->name); ?></dd>
                    </div>
                    <div class="bg-gradient-to-br from-purple-50/50 to-pink-50/30 rounded-xl border-2 border-purple-200 p-5">
                        <dt class="text-xs font-bold text-gray-600 uppercase tracking-wide mb-2 flex items-center">
                            <svg class="w-4 h-4 mr-1.5 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            Email Address
                        </dt>
                        <dd class="text-base font-semibold text-gray-900">
                            <?php if($client->email): ?>
                                <a href="mailto:<?php echo e($client->email); ?>" class="text-indigo-600 hover:text-indigo-700 hover:underline">
                                    <?php echo e($client->email); ?>

                                </a>
                            <?php else: ?>
                                <span class="text-gray-400">N/A</span>
                            <?php endif; ?>
                        </dd>
                    </div>
                    <div class="bg-gradient-to-br from-pink-50/50 to-violet-50/30 rounded-xl border-2 border-pink-200 p-5">
                        <dt class="text-xs font-bold text-gray-600 uppercase tracking-wide mb-2 flex items-center">
                            <svg class="w-4 h-4 mr-1.5 text-pink-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                            Phone Number
                        </dt>
                        <dd class="text-base font-semibold text-gray-900">
                            <?php if($client->phone): ?>
                                <a href="tel:<?php echo e($client->phone); ?>" class="text-purple-600 hover:text-purple-700 hover:underline">
                                    <?php echo e($client->phone); ?>

                                </a>
                            <?php else: ?>
                                <span class="text-gray-400">N/A</span>
                            <?php endif; ?>
                        </dd>
                    </div>
                    <div class="bg-gradient-to-br from-violet-50/50 to-indigo-50/30 rounded-xl border-2 border-violet-200 p-5">
                        <dt class="text-xs font-bold text-gray-600 uppercase tracking-wide mb-2 flex items-center">
                            <svg class="w-4 h-4 mr-1.5 text-violet-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                            KRA PIN
                        </dt>
                        <dd class="text-base font-semibold text-gray-900 font-mono"><?php echo e($client->kra_pin ?? 'N/A'); ?></dd>
                    </div>
                    <div class="bg-gradient-to-br from-emerald-50/50 to-teal-50/30 rounded-xl border-2 border-emerald-200 p-5">
                        <dt class="text-xs font-bold text-gray-600 uppercase tracking-wide mb-2 flex items-center">
                            <svg class="w-4 h-4 mr-1.5 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            Created
                        </dt>
                        <dd class="text-base font-semibold text-gray-900"><?php echo e($client->created_at->format('M d, Y')); ?></dd>
                    </div>
                    <div class="bg-gradient-to-br from-cyan-50/50 to-blue-50/30 rounded-xl border-2 border-cyan-200 p-5">
                        <dt class="text-xs font-bold text-gray-600 uppercase tracking-wide mb-2 flex items-center">
                            <svg class="w-4 h-4 mr-1.5 text-cyan-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                            </svg>
                            Last Updated
                        </dt>
                        <dd class="text-base font-semibold text-gray-900"><?php echo e($client->updated_at->format('M d, Y')); ?></dd>
                    </div>
                </div>

                <?php if($client->company_name || $client->company_address || $client->company_website || $client->company_registration_number): ?>
                    <!-- Company Details Section -->
                    <div class="mt-8 pt-8 border-t-2 border-indigo-200">
                        <h3 class="text-lg font-bold text-gray-900 mb-6 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                            Company Details
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            <?php if($client->company_name): ?>
                                <div class="bg-gradient-to-br from-purple-50/50 to-pink-50/30 rounded-xl border-2 border-purple-200 p-5">
                                    <dt class="text-xs font-bold text-gray-600 uppercase tracking-wide mb-2 flex items-center">
                                        <svg class="w-4 h-4 mr-1.5 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                        </svg>
                                        Company Name
                                    </dt>
                                    <dd class="text-base font-bold text-gray-900"><?php echo e($client->company_name); ?></dd>
                                </div>
                            <?php endif; ?>
                            <?php if($client->company_registration_number): ?>
                                <div class="bg-gradient-to-br from-violet-50/50 to-indigo-50/30 rounded-xl border-2 border-violet-200 p-5">
                                    <dt class="text-xs font-bold text-gray-600 uppercase tracking-wide mb-2 flex items-center">
                                        <svg class="w-4 h-4 mr-1.5 text-violet-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                        Registration Number
                                    </dt>
                                    <dd class="text-base font-semibold text-gray-900"><?php echo e($client->company_registration_number); ?></dd>
                                </div>
                            <?php endif; ?>
                            <?php if($client->company_website): ?>
                                <div class="bg-gradient-to-br from-pink-50/50 to-violet-50/30 rounded-xl border-2 border-pink-200 p-5">
                                    <dt class="text-xs font-bold text-gray-600 uppercase tracking-wide mb-2 flex items-center">
                                        <svg class="w-4 h-4 mr-1.5 text-pink-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                                        </svg>
                                        Website
                                    </dt>
                                    <dd class="text-base font-semibold text-gray-900">
                                        <a href="<?php echo e($client->company_website); ?>" target="_blank" class="text-indigo-600 hover:text-indigo-700 hover:underline">
                                            <?php echo e($client->company_website); ?>

                                        </a>
                                    </dd>
                                </div>
                            <?php endif; ?>
                            <?php if($client->company_address): ?>
                                <div class="bg-gradient-to-br from-indigo-50/50 to-purple-50/30 rounded-xl border-2 border-indigo-200 p-5 md:col-span-2 lg:col-span-3">
                                    <dt class="text-xs font-bold text-gray-600 uppercase tracking-wide mb-2 flex items-center">
                                        <svg class="w-4 h-4 mr-1.5 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                        Company Address
                                    </dt>
                                    <dd class="text-base font-semibold text-gray-900"><?php echo e($client->company_address); ?></dd>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if($client->contact_name || $client->contact_email || $client->contact_phone || $client->contact_position): ?>
                    <!-- Contact Person Section -->
                    <div class="mt-8 pt-8 border-t-2 border-indigo-200">
                        <h3 class="text-lg font-bold text-gray-900 mb-6 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-pink-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            Contact Person
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                            <?php if($client->contact_name): ?>
                                <div class="bg-gradient-to-br from-pink-50/50 to-violet-50/30 rounded-xl border-2 border-pink-200 p-5">
                                    <dt class="text-xs font-bold text-gray-600 uppercase tracking-wide mb-2 flex items-center">
                                        <svg class="w-4 h-4 mr-1.5 text-pink-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                        Contact Name
                                    </dt>
                                    <dd class="text-base font-bold text-gray-900"><?php echo e($client->contact_name); ?></dd>
                                </div>
                            <?php endif; ?>
                            <?php if($client->contact_position): ?>
                                <div class="bg-gradient-to-br from-violet-50/50 to-indigo-50/30 rounded-xl border-2 border-violet-200 p-5">
                                    <dt class="text-xs font-bold text-gray-600 uppercase tracking-wide mb-2 flex items-center">
                                        <svg class="w-4 h-4 mr-1.5 text-violet-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                        Position
                                    </dt>
                                    <dd class="text-base font-semibold text-gray-900"><?php echo e($client->contact_position); ?></dd>
                                </div>
                            <?php endif; ?>
                            <?php if($client->contact_email): ?>
                                <div class="bg-gradient-to-br from-purple-50/50 to-pink-50/30 rounded-xl border-2 border-purple-200 p-5">
                                    <dt class="text-xs font-bold text-gray-600 uppercase tracking-wide mb-2 flex items-center">
                                        <svg class="w-4 h-4 mr-1.5 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                        Contact Email
                                    </dt>
                                    <dd class="text-base font-semibold text-gray-900">
                                        <a href="mailto:<?php echo e($client->contact_email); ?>" class="text-indigo-600 hover:text-indigo-700 hover:underline">
                                            <?php echo e($client->contact_email); ?>

                                        </a>
                                    </dd>
                                </div>
                            <?php endif; ?>
                            <?php if($client->contact_phone): ?>
                                <div class="bg-gradient-to-br from-pink-50/50 to-violet-50/30 rounded-xl border-2 border-pink-200 p-5">
                                    <dt class="text-xs font-bold text-gray-600 uppercase tracking-wide mb-2 flex items-center">
                                        <svg class="w-4 h-4 mr-1.5 text-pink-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                        </svg>
                                        Contact Phone
                                    </dt>
                                    <dd class="text-base font-semibold text-gray-900">
                                        <a href="tel:<?php echo e($client->contact_phone); ?>" class="text-purple-600 hover:text-purple-700 hover:underline">
                                            <?php echo e($client->contact_phone); ?>

                                        </a>
                                    </dd>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Files Section -->
        <div class="bg-gradient-to-br from-white via-indigo-50/30 to-purple-50/30 rounded-2xl border-2 border-indigo-200/60 shadow-xl overflow-hidden backdrop-blur-sm">
            <div class="px-8 py-6 border-b-2 border-indigo-200/50 bg-gradient-to-r from-indigo-500/10 via-purple-500/10 to-pink-500/10">
                <div class="flex justify-between items-center">
                    <h3 class="text-xl font-bold text-gray-900 flex items-center">
                        <svg class="w-6 h-6 mr-2 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Files
                    </h3>
                    <a href="<?php echo e(route('clients.timeline', $client)); ?>" class="text-sm font-semibold text-indigo-600 hover:text-indigo-700 hover:underline flex items-center">
                        View Activity Timeline
                        <svg class="w-4 h-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>
            </div>
            <div class="p-8">
                <?php if($files->count() > 0): ?>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 sticky top-0 z-10 shadow-lg">
                                <tr>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">File Name</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">Category</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">Financial Year</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">Size</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">Uploaded By</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">Date</th>
                                    <th class="px-6 py-4 text-right text-xs font-bold text-white uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <?php $__currentLoopData = $files; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="hover:bg-gradient-to-r hover:from-indigo-50/50 hover:to-purple-50/30 transition-all duration-150 <?php echo e($loop->even ? 'bg-gray-50/30' : 'bg-white'); ?> cursor-pointer group" onclick="window.location.href='<?php echo e(route('files.show', $file)); ?>'">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <?php if($file->is_locked): ?>
                                                    <svg class="h-4 w-4 text-amber-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                                    </svg>
                                                <?php endif; ?>
                                                <svg class="h-5 w-5 text-gray-400 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                </svg>
                                                <span class="text-sm font-bold text-gray-900 group-hover:text-indigo-700 transition-colors"><?php echo e($file->original_name); ?></span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2.5 py-1 text-xs font-bold rounded-full bg-gradient-to-r from-indigo-100 to-purple-100 text-indigo-700 border-2 border-indigo-200">
                                                <?php echo e($file->category->name); ?>

                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap" onclick="event.stopPropagation()">
                                            <?php
                                                $statusColors = [
                                                    'uploaded' => 'bg-gradient-to-r from-gray-100 to-gray-200 text-gray-800 border-2 border-gray-300',
                                                    'pending_review' => 'bg-gradient-to-r from-amber-100 to-orange-100 text-amber-800 border-2 border-amber-300',
                                                    'approved' => 'bg-gradient-to-r from-emerald-100 to-green-100 text-emerald-800 border-2 border-emerald-300',
                                                    'needs_correction' => 'bg-gradient-to-r from-red-100 to-pink-100 text-red-800 border-2 border-red-300',
                                                    'archived' => 'bg-gradient-to-r from-slate-100 to-gray-100 text-slate-800 border-2 border-slate-300',
                                                ];
                                                $status = $file->status ?: 'uploaded';
                                                $statusColor = $statusColors[$status] ?? $statusColors['uploaded'];
                                            ?>
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold border shadow-sm <?php echo e($statusColor); ?>">
                                                <?php echo e(str_replace('_', ' ', ucfirst($status))); ?>

                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-800">
                                            <?php echo e($file->financial_year); ?>

                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-800">
                                            <?php echo e(number_format($file->size / 1024, 2)); ?> KB
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-800">
                                            <?php echo e($file->uploader->name ?? 'N/A'); ?>

                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-800">
                                            <?php echo e($file->created_at->format('M d, Y')); ?>

                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium" onclick="event.stopPropagation()">
                                            <?php if (isset($component)) { $__componentOriginal3bb36eedd7bcefc353ba4ac566fed84b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3bb36eedd7bcefc353ba4ac566fed84b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.table-action-dropdown','data' => ['item' => $file]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('table-action-dropdown'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['item' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($file)]); ?>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('files.download')): ?>
                                                    <a href="<?php echo e(route('files.download', $file)); ?>" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gradient-to-r hover:from-blue-50 hover:to-cyan-50 hover:text-blue-700 transition-colors">Download</a>
                                                <?php endif; ?>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('files.view')): ?>
                                                    <a href="<?php echo e(route('files.show', $file)); ?>" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gradient-to-r hover:from-indigo-50 hover:to-purple-50 hover:text-indigo-700 transition-colors">View Details</a>
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
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="mt-6 pt-6 border-t-2 border-indigo-200">
                        <?php echo e($files->links()); ?>

                    </div>
                <?php else: ?>
                    <div class="text-center py-16">
                        <div class="flex items-center justify-center h-20 w-20 rounded-full bg-gradient-to-br from-indigo-100 to-purple-100 mx-auto mb-4">
                            <svg class="h-10 w-10 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900">No files</h3>
                        <p class="mt-2 text-sm text-gray-600">Get started by uploading a new file.</p>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('files.upload')): ?>
                            <div class="mt-6">
                                <a href="<?php echo e(route('files.create')); ?>?client_id=<?php echo e($client->id); ?>">
                                    <button class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 border border-transparent rounded-xl font-bold text-sm text-white hover:from-indigo-700 hover:via-purple-700 hover:to-pink-700 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                                        <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                        </svg>
                                        Upload File
                                    </button>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex items-center justify-center gap-4 pt-6">
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('files.upload')): ?>
                <a href="<?php echo e(route('files.create')); ?>?client_id=<?php echo e($client->id); ?>" class="inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 border border-transparent rounded-xl font-bold text-sm text-white hover:from-indigo-700 hover:via-purple-700 hover:to-pink-700 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                    <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Upload File
                </a>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('clients.update')): ?>
                <a href="<?php echo e(route('clients.edit', $client)); ?>" class="inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-blue-50 to-cyan-50 border-2 border-blue-200 rounded-xl font-semibold text-sm text-blue-700 hover:from-blue-100 hover:to-cyan-100 hover:border-blue-300 transition-all duration-200 shadow-sm hover:shadow-md">
                    <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                    Edit Client
                </a>
            <?php endif; ?>
            <a href="<?php echo e(route('clients.index')); ?>" class="inline-flex items-center justify-center px-6 py-3 bg-white border-2 border-gray-300 rounded-xl font-semibold text-sm text-gray-700 hover:bg-gray-50 hover:border-gray-400 transition-all duration-200 shadow-sm hover:shadow-md">
                <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back
            </a>
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
<?php /**PATH C:\projects\filecr\resources\views/clients/show.blade.php ENDPATH**/ ?>