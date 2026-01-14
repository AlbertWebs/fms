<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use App\Services\AuditLogService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function __construct(
        protected AuditLogService $auditLogService
    ) {}

    public function index(Request $request): View
    {
        $this->authorize('categories.manage');

        $query = Category::withCount('files');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $categories = $query->latest()->paginate(20);
        $totalCategories = Category::count();

        return view('categories.index', compact('categories', 'totalCategories'));
    }

    public function create(): View
    {
        $this->authorize('categories.manage');

        return view('categories.create');
    }

    public function store(StoreCategoryRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        if (isset($validated['retention_days']) && $validated['retention_days'] !== null) {
            $validated['retention_days'] = (int) $validated['retention_days'];
        }
        
        $category = Category::create($validated);

        $this->auditLogService->log('category_created', Category::class, $category->id, "Category '{$category->name}' created");

        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }

    public function show(Category $category): View
    {
        $this->authorize('categories.manage');

        return view('categories.show', compact('category'));
    }

    public function edit(Category $category): View
    {
        $this->authorize('categories.manage');

        return view('categories.edit', compact('category'));
    }

    public function update(UpdateCategoryRequest $request, Category $category): RedirectResponse
    {
        $original = $category->getOriginal();
        $validated = $request->validated();
        
        if (isset($validated['retention_days']) && $validated['retention_days'] !== null) {
            $validated['retention_days'] = (int) $validated['retention_days'];
        }
        
        $category->update($validated);
        
        $changes = [];
        foreach ($validated as $key => $value) {
            if (isset($original[$key]) && $original[$key] != $value) {
                $changes[$key] = ['old' => $original[$key], 'new' => $value];
            }
        }

        $this->auditLogService->log('category_updated', Category::class, $category->id, "Category '{$category->name}' updated", $changes);

        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(Category $category): RedirectResponse
    {
        $this->authorize('categories.manage');

        $categoryName = $category->name;
        $categoryId = $category->id;
        $category->delete();

        $this->auditLogService->log('category_deleted', Category::class, $categoryId, "Category '{$categoryName}' deleted");

        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
}