@extends('admin.loyout.master')
@section('content')
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <script>
                toastr.error("{{ $error }}")
            </script>
        @endforeach
    @endif

    @if (session('success'))
        <script>
            toastr.success("{{ session('success') }}")
        </script>
    @endif

    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
    <style>
        .ck-editor__editable_inline {
            min-height: 100px;
        }

        .listing-item {
            transition: all 0.1s ease;
        }

        .preview-image {
            max-width: 150px;
            max-height: 100px;
            object-fit: cover;
            border-radius: 8px;
            border: 1px solid #e2e8f0;
        }
    </style>

    <div class="max-w-4xl mx-auto px-4 py-8 sm:px-6 lg:px-8">
        <!-- header -->
        <div class="mb-8 border-b border-slate-200 pb-4 flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-slate-800 tracking-tight">✏️ Edit service</h1>
                <p class="text-sm text-slate-500 mt-1">Update service fields · dynamic listings with CKEditor</p>
            </div>
            <a href="{{ route('service.index') }}"
                class="inline-flex items-center gap-2 px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 text-sm font-medium rounded-lg transition-colors">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>

        <!-- main form -->
        <form action="{{ route('service.update', $service->id) }}" method="POST"
            class="space-y-6 bg-white shadow-sm rounded-xl p-6 md:p-8 border border-slate-200" enctype="multipart/form-data">
            @csrf
            <!-- ====== heading (plain) ====== -->
            <div>
                <label for="heading" class="block text-sm font-medium text-slate-700 mb-1">Heading</label>
                <input type="text" id="heading" name="heading" placeholder="Service main heading"
                    value="{{ old('heading', $service->heading) }}"
                    class="w-full rounded-lg border-slate-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm px-4 py-2.5 border">
                @error('heading')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- ====== main_img (file upload) ====== -->
            <div>
                <label for="main_img" class="block text-sm font-medium text-slate-700 mb-1">Main image</label>
                @if ($service->main_img)
                    <div class="mb-2">
                        <p class="text-xs text-slate-500 mb-1">Current image:</p>
                        <img src="{{ asset($service->main_img) }}" alt="Main image" class="preview-image">
                    </div>
                @endif
                <input type="file" id="main_img" name="main_img"
                    class="w-full rounded-lg border-slate-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm px-4 py-2.5 border">
                <p class="text-xs text-slate-400 mt-1">Leave empty to keep current image</p>
                @error('main_img')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- ====== samll_pag (plain) ====== -->
            <div>
                <label for="samll_pag" class="block text-sm font-medium text-slate-700 mb-1">Small paragraph (short
                    excerpt)</label>
                <input type="text" id="small_pag" name="small_pag" placeholder="Short description"
                    value="{{ old('small_pag', $service->small_pag) }}"
                    class="w-full rounded-lg border-slate-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm px-4 py-2.5 border">
                @error('samll_pag')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- ====== first_heading (plain) ====== -->
            <div>
                <label for="first_heading" class="block text-sm font-medium text-slate-700 mb-1">First heading</label>
                <input type="text" name="first_heading" placeholder="Service First heading"
                    value="{{ old('first_heading', $service->first_heading) }}"
                    class="w-full rounded-lg border-slate-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm px-4 py-2.5 border">
                @error('first_heading')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- ====== paragraph (CKEditor) ====== -->
            <div>
                <label for="paragraph" class="block text-sm font-medium text-slate-700 mb-1">Paragraph (CKEditor)</label>
                <textarea id="paragraph" name="paragraph" rows="4"
                    class="w-full rounded-lg border-slate-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm px-4 py-2.5 border hidden">{{ old('paragraph', $service->paragraph) }}</textarea>
                @error('paragraph')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- ====== note (CKEditor) ====== -->
            <div>
                <label for="note" class="block text-sm font-medium text-slate-700 mb-1">Note (CKEditor)</label>
                <textarea id="note" name="note" rows="3"
                    class="w-full rounded-lg border-slate-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm px-4 py-2.5 border hidden">{{ old('note', $service->note) }}</textarea>
                @error('note')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- ====== sec_heading (CKEditor) ====== -->
            <div>
                <label for="sec_heading" class="block text-sm font-medium text-slate-700 mb-1">Secondary heading
                    (CKEditor)</label>
                <textarea id="sec_heading" name="sec_heading" rows="2"
                    class="w-full rounded-lg border-slate-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm px-4 py-2.5 border hidden">{{ old('sec_heading', $service->sec_heading) }}</textarea>
                @error('sec_heading')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- ====== sec_imag (file upload) ====== -->
            <div>
                <label for="sec_imag" class="block text-sm font-medium text-slate-700 mb-1">Secondary image</label>
                @if ($service->sec_imag)
                    <div class="mb-2">
                        <p class="text-xs text-slate-500 mb-1">Current image:</p>
                        <img src="{{ asset($service->sec_imag) }}" alt="Secondary image" class="preview-image">
                    </div>
                @endif
                <input type="file" id="sec_imag" name="sec_imag"
                    class="w-full rounded-lg border-slate-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm px-4 py-2.5 border">
                <p class="text-xs text-slate-400 mt-1">Leave empty to keep current image</p>
                @error('sec_imag')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- ====== sec_paragraph (CKEditor) ====== -->
            <div>
                <label for="sec_paragraph" class="block text-sm font-medium text-slate-700 mb-1">Secondary paragraph
                    (CKEditor)</label>
                <textarea id="sec_paragraph" name="sec_paragraph" rows="4"
                    class="w-full rounded-lg border-slate-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm px-4 py-2.5 border hidden">{{ old('sec_paragraph', $service->sec_paragraph) }}</textarea>
                @error('sec_paragraph')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- ====== third_heading (CKEditor) ====== -->
            <div>
                <label for="third_heading" class="block text-sm font-medium text-slate-700 mb-1">Third heading
                    (CKEditor)</label>
                <textarea id="third_heading" name="third_heading" rows="2"
                    class="w-full rounded-lg border-slate-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm px-4 py-2.5 border hidden">{{ old('third_heading', $service->third_heading) }}</textarea>
                @error('third_heading')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- ====== serviceCat_id (select) ====== -->
            <div>
                <label for="serviceCat_id" class="block text-sm font-medium text-slate-700 mb-1">Service category</label>
                <select name="serviceCat_id" id="serviceCat_id"
                    class="w-full rounded-lg border-slate-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm px-4 py-2.5 border">
                    <option value="">Select Category</option>
                    @foreach ($serCat as $category)
                        <option value="{{ $category->id }}"
                            {{ old('serviceCat_id', $service->serviceCat_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('serviceCat_id')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- ====== Dynamic Listings ====== -->
            <div class="pt-4 border-t border-slate-200">
                <div class="flex items-center justify-between mb-3">
                    <h2 class="text-lg font-semibold text-slate-700">📋 Listings (heading + summary)</h2>
                    <button type="button" id="addListingBtn"
                        class="inline-flex items-center gap-1 px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg shadow-sm transition-colors duration-150 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                        <span>+</span> Add listing
                    </button>
                </div>

                <!-- container where listing items will be injected -->
                <div id="listingsContainer" class="space-y-4">
                    @php
                        // Decode the list JSON if it exists (column name is 'list')
                        $listData = [];
                        if ($service->list) {
                            $listData = json_decode($service->list, true);
                            // If it's not an array or is empty, try to parse it differently
    if (!is_array($listData) || empty($listData)) {
        // Try to handle if it's a serialized array or just a string
                                if (is_string($service->list) && strpos($service->list, '[') === 0) {
                                    $listData = json_decode($service->list, true);
                                }
                            }
                        }
                        // If still not an array, set default
                        if (!is_array($listData)) {
                            $listData = [];
                        }
                    @endphp

                    @if (count($listData) > 0)
                        @foreach ($listData as $item)
                            @if (is_array($item) && isset($item['heading']) && isset($item['summary']))
                                <div
                                    class="listing-item bg-slate-50 p-4 rounded-lg border border-slate-200 relative group">
                                    <div class="flex items-start gap-3">
                                        <div class="flex-1 space-y-3">
                                            <div>
                                                <label class="block text-xs font-medium text-slate-600 mb-0.5">Listing
                                                    heading</label>
                                                <input type="text" name="listing_heading[]"
                                                    placeholder="e.g. Feature heading" value="{{ $item['heading'] }}"
                                                    class="w-full rounded border-slate-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm px-3 py-1.5 border">
                                            </div>
                                            <div>
                                                <label
                                                    class="block text-xs font-medium text-slate-600 mb-0.5">Summary</label>
                                                <textarea name="listing_summary[]" rows="2" placeholder="Short summary text"
                                                    class="w-full rounded border-slate-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm px-3 py-1.5 border">{{ $item['summary'] }}</textarea>
                                            </div>
                                        </div>
                                        <button type="button"
                                            class="remove-listing text-slate-400 hover:text-red-500 transition-colors p-1 mt-1"
                                            title="Remove listing">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                                fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @else
                        <!-- Default empty listing item -->
                        <div class="listing-item bg-slate-50 p-4 rounded-lg border border-slate-200 relative group">
                            <div class="flex items-start gap-3">
                                <div class="flex-1 space-y-3">
                                    <div>
                                        <label class="block text-xs font-medium text-slate-600 mb-0.5">Listing
                                            heading</label>
                                        <input type="text" name="listing_heading[]" placeholder="e.g. Feature heading"
                                            class="w-full rounded border-slate-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm px-3 py-1.5 border">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-medium text-slate-600 mb-0.5">Summary</label>
                                        <textarea name="listing_summary[]" rows="2" placeholder="Short summary text"
                                            class="w-full rounded border-slate-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm px-3 py-1.5 border"></textarea>
                                    </div>
                                </div>
                                <button type="button"
                                    class="remove-listing text-slate-400 hover:text-red-500 transition-colors p-1 mt-1"
                                    title="Remove listing">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    @endif
                </div>
                <p class="text-xs text-slate-400 mt-2">Click "Add listing" to add a new heading + summary pair.</p>
            </div>
            <div>
                <label for="sec_imag" class="block text-sm font-medium text-slate-700 mb-1">External image</label>
                <input type="file" id="sec_imag" name="ext_images[]" accept="multiple" multiple
                    class="w-full rounded-lg border-slate-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm px-4 py-2.5 border">
            </div>
            @if (!empty(json_decode($service->ext_images, true)))
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-4">

                    @foreach (json_decode($service->ext_images, true) as $image)
                        <div class="relative group">

                            {{-- Image --}}
                            <img src="{{ asset($image) }}" class="w-full h-32 object-cover rounded-lg border">

                            {{-- Delete Button --}}
                            <button type="button"
                                onclick="deleteExternalImage('{{ $service->id }}', '{{ $image }}')"
                                class="absolute top-2 right-2 w-7 h-7 flex items-center justify-center
                           bg-red-600 text-white rounded-full shadow
                           hover:bg-red-700 transition">
                                &times;
                            </button>

                        </div>
                    @endforeach

                </div>
            @endif

            <!-- submit -->
            <div class="pt-4 border-t border-slate-200 flex justify-end gap-3">
                <a href="{{ route('service.index') }}"
                    class="inline-flex items-center px-6 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 text-sm font-medium rounded-lg transition-colors">
                    Cancel
                </a>
                <button type="submit"
                    class="inline-flex items-center px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg shadow-sm transition-colors duration-150 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    Update service
                </button>
            </div>
        </form>
        <p class="text-xs text-slate-400 mt-6 text-center">Tailwind CSS only · dynamic listings with heading + summary</p>
    </div>

    <script>
        (function() {
            // ----- CKEditor initialization -----
            function initEditors() {
                const editorIds = [
                    'paragraph', 'note', 'sec_heading',
                    'sec_paragraph', 'third_heading'
                ];
                editorIds.forEach(id => {
                    const textarea = document.getElementById(id);
                    if (!textarea) return;

                    // Get the content from the textarea
                    const initialContent = textarea.value;

                    ClassicEditor
                        .create(textarea, {
                            toolbar: ['heading', '|', 'bold', 'italic', 'underline', '|', 'bulletedList',
                                'numberedList', '|', 'link', 'blockQuote', 'undo', 'redo'
                            ],
                        })
                        .then(editor => {
                            console.log(`✅ CKEditor ready for #${id}`);
                            editor.setData(initialContent);
                        })
                        .catch(error => {
                            console.error(`❌ CKEditor init failed for #${id}:`, error);
                        });
                });
            }

            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', initEditors);
            } else {
                initEditors();
            }

            // ----- Dynamic listings: add & remove -----
            const container = document.getElementById('listingsContainer');
            const addBtn = document.getElementById('addListingBtn');

            function createListingItem(headingValue = '', summaryValue = '') {
                const div = document.createElement('div');
                div.className = 'listing-item bg-slate-50 p-4 rounded-lg border border-slate-200 relative group';

                div.innerHTML = `
                <div class="flex items-start gap-3">
                    <div class="flex-1 space-y-3">
                        <div>
                            <label class="block text-xs font-medium text-slate-600 mb-0.5">Listing heading</label>
                            <input type="text" name="listing_heading[]" placeholder="e.g. Feature heading"
                                   value="${headingValue.replace(/"/g, '&quot;')}"
                                   class="w-full rounded border-slate-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm px-3 py-1.5 border">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-slate-600 mb-0.5">Summary</label>
                            <textarea name="listing_summary[]" rows="2" placeholder="Short summary text"
                                      class="w-full rounded border-slate-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm px-3 py-1.5 border">${summaryValue}</textarea>
                        </div>
                    </div>
                    <button type="button" class="remove-listing text-slate-400 hover:text-red-500 transition-colors p-1 mt-1" title="Remove listing">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
            `;
                return div;
            }

            // Add new listing when button clicked
            addBtn.addEventListener('click', function() {
                const newItem = createListingItem('', '');
                container.appendChild(newItem);
            });

            // Remove listing (event delegation on container)
            container.addEventListener('click', function(e) {
                const removeBtn = e.target.closest('.remove-listing');
                if (!removeBtn) return;
                const listingItem = removeBtn.closest('.listing-item');
                if (!listingItem) return;
                listingItem.remove();
            });

            console.log('✅ Dynamic listings ready – click "Add listing" to add heading+summary pairs.');
        })();
    </script>
    <script>
    function deleteExternalImage(serviceId, imagePath) {

        if (!confirm('Are you sure you want to delete this image?')) {
            return;
        }

        const csrfToken = document.querySelector(
            'meta[name="csrf-token"]'
        )?.getAttribute('content');

        const url = "{{ route('service.external-image.delete', ':id') }}"
            .replace(':id', serviceId);

        fetch(url, {
            method: 'DELETE',

            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            },

            body: JSON.stringify({
                image: imagePath
            })
        })
        .then(response => response.json())
        .then(data => {

            if (data.success) {
                location.reload();
            } else {
                alert(data.message || 'Image delete failed.');
            }

        })
        .catch(error => {
            console.error('Delete image error:', error);
            alert('Something went wrong.');
        });
    }
</script>

@endsection
