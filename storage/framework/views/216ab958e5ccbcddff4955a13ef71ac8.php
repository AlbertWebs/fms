<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

        <title><?php echo e(config('app.name', 'Laravel')); ?> - Secure Login</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 dark:from-gray-950 dark:via-gray-900 dark:to-gray-950">
            <!-- Elegant background pattern -->
            <div class="absolute inset-0 overflow-hidden pointer-events-none">
                <div class="absolute top-0 -left-4 w-96 h-96 bg-indigo-200/30 dark:bg-indigo-900/10 rounded-full mix-blend-multiply dark:mix-blend-soft-light filter blur-3xl opacity-70"></div>
                <div class="absolute top-0 -right-4 w-96 h-96 bg-blue-200/30 dark:bg-blue-900/10 rounded-full mix-blend-multiply dark:mix-blend-soft-light filter blur-3xl opacity-70"></div>
                <div class="absolute -bottom-8 left-20 w-96 h-96 bg-purple-200/30 dark:bg-purple-900/10 rounded-full mix-blend-multiply dark:mix-blend-soft-light filter blur-3xl opacity-70"></div>
            </div>

            <?php
                $logoPath = \App\Models\Setting::get('logo_path');
                $companyName = \App\Models\Setting::get('company_name', 'Ngunzi & Associates');
            ?>
            <div class="relative mb-10">
                <a href="/" class="flex items-center justify-center group">
                    <div class="p-4 bg-black rounded-2xl shadow-lg group-hover:shadow-xl group-hover:scale-105 transition-all duration-300">
                        <?php if($logoPath): ?>
                            <img src="<?php echo e(asset('storage/' . $logoPath)); ?>" alt="<?php echo e($companyName); ?>" class="h-16 w-auto object-contain">
                        <?php else: ?>
                            <?php if (isset($component)) { $__componentOriginal8892e718f3d0d7a916180885c6f012e7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8892e718f3d0d7a916180885c6f012e7 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.application-logo','data' => ['class' => 'w-16 h-16 fill-current text-white']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('application-logo'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-16 h-16 fill-current text-white']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal8892e718f3d0d7a916180885c6f012e7)): ?>
<?php $attributes = $__attributesOriginal8892e718f3d0d7a916180885c6f012e7; ?>
<?php unset($__attributesOriginal8892e718f3d0d7a916180885c6f012e7); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8892e718f3d0d7a916180885c6f012e7)): ?>
<?php $component = $__componentOriginal8892e718f3d0d7a916180885c6f012e7; ?>
<?php unset($__componentOriginal8892e718f3d0d7a916180885c6f012e7); ?>
<?php endif; ?>
                        <?php endif; ?>
                    </div>
                </a>
                <div class="mt-6 text-center">
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100 tracking-tight"><?php echo e($companyName); ?></h1>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-2 font-medium">Secure File Management System</p>
                </div>
            </div>

            <div class="relative w-full sm:max-w-md mt-6 px-8 py-10 bg-white/70 dark:bg-gray-800/70 backdrop-blur-xl shadow-2xl overflow-hidden sm:rounded-3xl border border-white/20 dark:border-gray-700/30">
                <!-- Subtle inner glow -->
                <div class="absolute inset-0 bg-gradient-to-br from-white/50 to-transparent dark:from-gray-800/50 pointer-events-none rounded-3xl"></div>
                
                <div class="relative">
                    <?php echo e($slot); ?>

                </div>
            </div>
            
            <!-- Footer -->
            <div class="mt-8 text-center">
                <p class="text-xs text-gray-400 dark:text-gray-500">© <?php echo e(date('Y')); ?> Ngunzi & Associates. All rights reserved.</p>
            </div>
        </div>
    </body>
</html><?php /**PATH C:\projects\filecr\resources\views/layouts/guest.blade.php ENDPATH**/ ?>