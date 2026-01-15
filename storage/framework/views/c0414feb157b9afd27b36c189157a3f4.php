<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['status']));

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

foreach (array_filter((['status']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
$classes = match($status) {
    'active' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
    'dormant' => 'bg-amber-50 text-amber-700 border-amber-200',
    'archived' => 'bg-gray-50 text-gray-700 border-gray-200',
    'enabled' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
    'disabled' => 'bg-gray-50 text-gray-700 border-gray-200',
    default => 'bg-gray-50 text-gray-700 border-gray-200',
};
?>

<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium border <?php echo e($classes); ?>">
    <?php echo e(ucfirst($status)); ?>

</span>
<?php /**PATH C:\xampp\htdocs\fms\resources\views/components/status-badge.blade.php ENDPATH**/ ?>