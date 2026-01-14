<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['active']));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter((['active']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
$classes = ($active ?? false)
            ? 'flex items-center space-x-3 px-4 py-3 text-sm font-semibold text-white bg-gradient-to-r from-indigo-600/80 to-purple-600/80 rounded-lg border-2 border-indigo-500/50 shadow-md'
            : 'flex items-center space-x-3 px-4 py-3 text-sm font-medium text-gray-300 hover:text-white hover:bg-gray-700/50 rounded-lg border border-gray-700/50 hover:border-gray-600/70 shadow-sm hover:shadow-md transition-all duration-200';
?>

<a <?php echo e($attributes->merge(['class' => $classes])); ?>>
    <?php echo e($slot); ?>

</a>
<?php /**PATH C:\projects\filecr\resources\views/components/sidebar-nav-link.blade.php ENDPATH**/ ?>