@extends('admin.loyout.master')
@section('content')
    <style>
        .category-row {
            transition: background 0.15s ease;
        }

        .category-row:hover {
            background-color: #f8fafc;
        }

        .table-wrap {
            max-height: 420px;
            overflow-y: auto;
        }

        .table-wrap::-webkit-scrollbar {
            width: 5px;
        }

        .table-wrap::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 10px;
        }

        .table-wrap::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 10px;
        }

        .slug-preview {
            transition: opacity 0.15s ease;
        }

        /* edit mode highlight */
        .editing-row {
            background-color: #f0f4ff !important;
        }
    </style>

    <div class="w-full max-w-6xl grid grid-cols-1 lg:grid-cols-2 gap-6">

        <div class="bg-white rounded-2xl shadow-lg shadow-slate-200/60 p-6 md:p-7 border border-slate-200/50 self-start">
            <div class="mb-5">
                <h2 class="text-xl font-semibold text-slate-800 tracking-tight flex items-center gap-2">
                    <i class="fas fa-plus-circle text-indigo-500 text-lg"></i>
                    <span id="formTitle">{{ isset($edit) ? 'Edit Category' : 'Add Category' }}</span>
                </h2>
                <p class="text-sm text-slate-500 mt-0.5" id="formSubtitle">Fill in the details and save.</p>
            </div>

            <form action="{{ isset($edit) ? route('ser.update', $edit->id) : route('ser.cat.add') }}" method="POST"
                class="space-y-5">
                @csrf


                <!-- Name -->
                <div>
                    <label for="categoryName" class="block text-sm font-medium text-slate-700 mb-1.5">Category name
                        *</label>
                    <input type="text" id="categoryName" name="name" placeholder="e.g. Web development"
                        value="{{ isset($edit) ? old('name', $edit->name) : '' }}"
                        class="@error('name') border-red-600 @enderror w-full px-4 py-2.5 bg-white border border-slate-300 rounded-lg shadow-sm text-slate-800 placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 transition duration-200">
                    @error('name')
                        <span class="text-sm text-red-600">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Slug + auto/manual + generate -->
                <div>
                    <div class="flex items-center justify-between">
                        <label for="categorySlug" class="block text-sm font-medium text-slate-700 mb-1.5">Slug</label>
                        <span id="slugAutoIndicator"
                            class="text-xs text-slate-400 bg-slate-100 px-2 py-0.5 rounded-full">auto</span>
                    </div>
                    <div class="relative">
                        <input type="text" id="categorySlug" name="slug" placeholder="web-development"
                            value="{{ isset($edit) ? old('slug', $edit->slug) : '' }}"
                            class="@error('slug') border-red-600 @enderror w-full px-4 py-2.5 bg-white border border-slate-300 rounded-lg shadow-sm text-slate-800 placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 transition duration-200 pr-24">
                        @error('slug')
                            <span class="text-sm text-red-600">{{ $message }}</span>
                        @enderror
                        <button type="button" id="generateSlugBtn"
                            class="absolute right-1.5 top-1/2 -translate-y-1/2 text-xs font-medium text-indigo-600 bg-indigo-50 hover:bg-indigo-100 px-3 py-1.5 rounded-md transition duration-150 border border-indigo-100/50">
                            <i class="fas fa-sync-alt mr-1 text-[10px]"></i> Generate
                        </button>
                    </div>
                    <div class="mt-1.5 flex items-center gap-2">
                        <span class="text-xs text-slate-400">Preview:</span>
                        <span id="slugPreview"
                            class="text-xs font-mono text-slate-600 bg-slate-100 px-2 py-0.5 rounded slug-preview">your-category-slug</span>
                    </div>
                    <p class="text-xs text-slate-400 mt-1.5">Unique URL-friendly identifier.</p>
                </div>

                <!-- action buttons -->
                <div class="pt-2 flex flex-col sm:flex-row gap-3">
                    <button type="submit"
                        class="w-full sm:flex-1 bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2.5 px-5 rounded-lg shadow-sm shadow-indigo-200/50 transition duration-200 flex items-center justify-center gap-2 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <i class="fas fa-save text-sm"></i> <span
                            >{{ isset($edit) ? 'Update' : 'Save' }}</span>
                    </button>
                    <button type="reset" id="resetFormBtn"
                        class="w-full sm:w-auto bg-white hover:bg-slate-50 text-slate-600 border border-slate-300 font-medium py-2.5 px-5 rounded-lg transition duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-400">
                        <i class="fas fa-undo-alt text-xs mr-1"></i> Reset
                    </button>
                </div>
            </form>

            <!-- feedback message (hidden by default) -->
            <div id="formFeedback"
                class="mt-5 text-sm text-emerald-700 bg-emerald-50 border border-emerald-200 rounded-lg px-4 py-3 hidden transition-all">
                <i class="fas fa-check-circle mr-1.5"></i> <span id="feedbackText">Category added</span>
            </div>
        </div>

        <!-- ========== RIGHT: TABLE LISTING ========== -->
        <div class="bg-white rounded-2xl shadow-lg shadow-slate-200/60 p-6 md:p-7 border border-slate-200/50 flex flex-col">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center gap-2">
                    <i class="fas fa-list-ul text-indigo-500 text-lg"></i>
                    <h3 class="text-xl font-semibold text-slate-800 tracking-tight">Categories</h3>
                    <span id="categoryCount"
                        class="ml-1 text-sm font-normal text-slate-400 bg-slate-100 px-2.5 py-0.5 rounded-full">0</span>
                </div>
                <button id="clearAllBtn"
                    class="text-xs text-slate-400 hover:text-red-500 transition-colors duration-150 flex items-center gap-1 bg-slate-50 hover:bg-red-50 px-3 py-1.5 rounded-full border border-slate-200 hover:border-red-200">
                    <i class="fas fa-trash-alt text-[11px]"></i> Clear all
                </button>
            </div>

            <!-- table wrapper with scroll -->
            <div class="table-wrap border border-slate-200/60 rounded-xl overflow-hidden">
                <table class="w-full text-sm">
                    <thead class="bg-slate-50/80 text-slate-600 border-b border-slate-200/70 sticky top-0 z-10">
                        <tr>
                            <th class="text-left font-semibold px-4 py-3 text-xs uppercase tracking-wider">#</th>
                            <th class="text-left font-semibold px-4 py-3 text-xs uppercase tracking-wider">Name</th>
                            <th class="text-left font-semibold px-4 py-3 text-xs uppercase tracking-wider">Slug</th>
                            <th class="text-right font-semibold px-4 py-3 text-xs uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="categoryTableBody" class="divide-y divide-slate-100 bg-white">
                        @forelse ($serCate as $key=> $data)
                            <tr class="category-row" data-id="{{ $data->id }}">
                                <td class="px-4 py-2.5 text-slate-400 font-mono text-xs">{{ $key + 1 }}</td>
                                <td class="px-4 py-2.5 font-medium text-slate-700">{{ $data->name ?? '-' }}</td>
                                <td class="px-4 py-2.5 text-slate-500 font-mono text-xs">{{ $data->slug ?? '-' }}</td>
                                <td class="px-4 py-2.5 text-right flex items-center justify-end gap-1.5">
                                    <a href="{{ route('ser.edit', $data->id) }}"
                                        class=" text-indigo-400 hover:text-indigo-700 transition-colors duration-150 text-sm p-1.5 rounded-md hover:bg-indigo-50"
                                        title="Edit category">
                                        <i class="fas fa-pen"></i>
                                    </a>
                                    <form action="{{ route('ser.delete', $data->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" onclick="return confirm('Are you sure delete this data ')"
                                            class="text-slate-300 hover:text-red-500 transition-colors duration-150 text-sm p-1.5 rounded-md hover:bg-red-50"
                                            title="Delete category">
                                            <i class="fas fa-times"></i>
                                        </button>

                                    </form>

                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-slate-400 py-8 text-sm">
                                    <i class="fas fa-box-open text-2xl block mb-2 text-slate-300"></i>
                                    No categories yet. Add one from the left!
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- small footer hint -->
            <div class="mt-3 text-[11px] text-slate-400 flex justify-between items-center">
                <span><i class="far fa-clock mr-1"></i> latest first</span>
                <span id="rowCountInfo" class="text-slate-300">{{ $serCate->count() }} entries</span>
            </div>
        </div>
    </div>

    <script>
        (function() {
            "use strict";

            // ----- DOM refs -----
            const form = document.getElementById('categoryForm');
            const nameInput = document.getElementById('categoryName');
            const slugInput = document.getElementById('categorySlug');
            const generateBtn = document.getElementById('generateSlugBtn');
            const slugPreview = document.getElementById('slugPreview');
            const autoIndicator = document.getElementById('slugAutoIndicator');
            const feedback = document.getElementById('formFeedback');
            const feedbackText = document.getElementById('feedbackText');
            const resetBtn = document.getElementById('resetFormBtn');
            const submitBtn = document.getElementById('submitBtn');
            const submitBtnText = document.getElementById('submitBtnText');
            const formTitle = document.getElementById('formTitle');
            const formSubtitle = document.getElementById('formSubtitle');
            const editIdInput = document.getElementById('editId');

            const tbody = document.getElementById('categoryTableBody');
            const categoryCount = document.getElementById('categoryCount');
            const rowCountInfo = document.getElementById('rowCountInfo');
            const clearAllBtn = document.getElementById('clearAllBtn');

            // ----- data store -----
            let categories = []; // each: { id, name, slug }
            let editingId = null; // null = add mode, else editing

            // ----- helpers -----
            function generateSlugFromString(str) {
                if (!str || str.trim() === '') return '';
                return str
                    .trim()
                    .toLowerCase()
                    .replace(/[^a-z0-9\s-]/g, '')
                    .replace(/\s+/g, '-')
                    .replace(/-+/g, '-')
                    .replace(/^-|-$/g, '');
            }

            function updateSlugPreview(value) {
                slugPreview.textContent = (value && value.trim() !== '') ? value.trim() : 'your-category-slug';
            }

            function setManualMode() {
                if (autoIndicator.textContent !== 'manual') {
                    autoIndicator.textContent = 'manual';
                    autoIndicator.classList.remove('bg-slate-100', 'text-slate-400');
                    autoIndicator.classList.add('bg-indigo-50', 'text-indigo-600');
                }
            }

            function setAutoMode() {
                if (autoIndicator.textContent !== 'auto') {
                    autoIndicator.textContent = 'auto';
                    autoIndicator.classList.remove('bg-indigo-50', 'text-indigo-600');
                    autoIndicator.classList.add('bg-slate-100', 'text-slate-400');
                }
            }

            // auto-generate slug from name (if auto mode)
            function autoGenerateSlug() {
                if (autoIndicator.textContent === 'auto') {
                    const name = nameInput.value;
                    const generated = generateSlugFromString(name);
                    if (generated) {
                        slugInput.value = generated;
                        updateSlugPreview(generated);
                    } else {
                        slugInput.value = '';
                        updateSlugPreview('');
                    }
                }
            }

            // escape html
            function escapeHtml(text) {
                if (!text) return '';
                const map = {
                    '&': '&amp;',
                    '<': '&lt;',
                    '>': '&gt;',
                    '"': '&quot;',
                    "'": '&#039;'
                };
                return text.replace(/[&<>"']/g, function(m) {
                    return map[m];
                });
            }









            function handleFormSubmit(e) {
                e.preventDefault();

                const name = nameInput.value.trim();
                const slug = slugInput.value.trim();

                if (!name) {
                    alert('Please enter a category name.');
                    nameInput.focus();
                    return;
                }

                if (!slug) {
                    const generated = generateSlugFromString(name);
                    if (generated) {
                        slugInput.value = generated;
                        updateSlugPreview(generated);
                        // Continue with the generated slug
                        const finalSlug = generated;
                        if (editingId) {
                            updateCategory(editingId, name, finalSlug);
                        } else {
                            addCategory(name, finalSlug);
                        }
                    } else {
                        alert('Please enter a valid slug or generate one.');
                        return;
                    }
                } else {
                    if (editingId) {
                        updateCategory(editingId, name, slug);
                    } else {
                        addCategory(name, slug);
                    }
                }
            }

            // ----- Event Listeners -----
            // Name input → auto-generate slug
            nameInput.addEventListener('input', function() {
                if (autoIndicator.textContent === 'auto' && !editingId) {
                    const generated = generateSlugFromString(this.value);
                    if (generated) {
                        slugInput.value = generated;
                        updateSlugPreview(generated);
                    } else {
                        slugInput.value = '';
                        updateSlugPreview('');
                    }
                }
            });

            // Slug input → manual mode + update preview
            slugInput.addEventListener('input', function() {
                const val = this.value;
                if (val.trim() === '') {
                    setManualMode();
                    updateSlugPreview('');
                } else {
                    setManualMode();
                    updateSlugPreview(val);
                }
            });

            // Generate button
            generateBtn.addEventListener('click', function(e) {
                e.preventDefault();
                const name = nameInput.value;
                const generated = generateSlugFromString(name);
                if (generated) {
                    slugInput.value = generated;
                    updateSlugPreview(generated);
                    setManualMode();
                } else {
                    slugInput.value = '';
                    updateSlugPreview('');
                    setManualMode();
                }
                feedback.classList.add('hidden');
            });

            // Reset button
            resetBtn.addEventListener('click', function(e) {
                e.preventDefault();
                if (editingId) {
                    cancelEdit();
                } else {
                    resetFormToDefault();
                }
                feedback.classList.add('hidden');
            });

            // Form submit
            form.addEventListener('submit', handleFormSubmit);

            // Clear all button
            clearAllBtn.addEventListener('click', clearAllCategories);

            // ----- Initialize with existing data from server -----
            function initializeCategories() {
                const existingRows = tbody.querySelectorAll('tr.category-row');
                if (existingRows.length > 0) {
                    existingRows.forEach(row => {
                        const id = Number(row.getAttribute('data-id'));
                        const name = row.querySelector('td:nth-child(2)')?.textContent || '';
                        const slug = row.querySelector('td:nth-child(3)')?.textContent || '';
                        categories.push({
                            id,
                            name,
                            slug
                        });
                    });
                    renderTable();
                }
                // Attach events to existing buttons
                document.querySelectorAll('.edit-cat-btn').forEach(btn => {
                    btn.addEventListener('click', function(e) {
                        e.stopPropagation();
                        const id = Number(this.getAttribute('data-id'));
                        const name = this.getAttribute('data-name');
                        const slug = this.getAttribute('data-slug');
                        startEdit(id, name, slug);
                    });
                });
                document.querySelectorAll('.delete-cat-btn').forEach(btn => {
                    btn.addEventListener('click', function(e) {
                        e.stopPropagation();
                        const id = Number(this.getAttribute('data-id'));
                        deleteCategoryById(id);
                    });
                });
                // Update counts
                const count = categories.length;
                categoryCount.textContent = count;
                rowCountInfo.textContent = `${count} entry${count > 1 ? 's' : ''}`;
            }

            // Initialize with server data
            initializeCategories();
            updateSlugPreview('');
            setAutoMode();

            console.log('📦 Service category form + table with Edit/Delete ready');
        })();
    </script>
@endsection
