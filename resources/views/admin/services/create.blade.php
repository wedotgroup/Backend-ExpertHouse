@extends('admin.loyout.master')
@section('content')
@if($errors->any())
@foreach ($errors->all() as $error)
<script>
    toastr.error("{{ $error }}")
</script>
@endforeach
@endif
  <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
  <style>
    .ck-editor__editable_inline {
      min-height: 100px;
    }
    .listing-item {
      transition: all 0.1s ease;
    }
  </style>
</head>
<body class="bg-slate-50 text-slate-800 font-sans antialiased">

<div class="max-w-4xl mx-auto px-4 py-8 sm:px-6 lg:px-8">
  <!-- header -->
  <div class="mb-8 border-b border-slate-200 pb-4 flex items-center justify-between">
    <div>
      <h1 class="text-3xl font-bold text-slate-800 tracking-tight">➕ Add new service</h1>
      <p class="text-sm text-slate-500 mt-1">All fields · dynamic listings with CKEditor</p>
    </div>
  </div>

  <!-- main form -->
  <form action="{{ route('service.add') }}" method="POST" class="space-y-6 bg-white shadow-sm rounded-xl p-6 md:p-8 border border-slate-200" enctype="multipart/form-data">
    @csrf
    <!-- ====== heading (plain) ====== -->
    <div>
      <label for="heading" class="block text-sm font-medium text-slate-700 mb-1">Heading</label>
      <input type="text" id="heading" name="heading" placeholder="Service main heading" value="{{ old('heading') }}"
             class="w-full rounded-lg border-slate-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm px-4 py-2.5 border">

    </div>

    <!-- ====== main_img (plain) ====== -->
    <div>
      <label for="main_img" class="block text-sm font-medium text-slate-700 mb-1">Main image (URL)</label>
      <input type="file" id="main_img" name="main_img" value="{{ old('main_img') }}"
             class="w-full rounded-lg border-slate-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm px-4 py-2.5 border">
    </div>

    <!-- ====== samll_pag (plain) ====== -->
    <div>
      <label for="samll_pag" class="block text-sm font-medium text-slate-700 mb-1">Small paragraph (short excerpt)</label>
      <input type="text" id="small_pag" name="small_pag" placeholder="Short description" value="{{ old('samll_pag') }}"
             class="w-full rounded-lg border-slate-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm px-4 py-2.5 border">
    </div>

    <!-- ====== first_heading (CKEditor) ====== -->
    <div>
      <label for="first_heading" class="block text-sm font-medium text-slate-700 mb-1">First heading </label>
       <input type="text"  name="first_heading" placeholder="Service First heading" value="{{ old('first_heading') }}"
             class="w-full rounded-lg border-slate-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm px-4 py-2.5 border">

    <!-- ====== paragraph (CKEditor) ====== -->
    <div>
      <label for="paragraph" class="block text-sm font-medium text-slate-700 mb-1">Paragraph (CKEditor)</label>
      <textarea id="paragraph" name="paragraph" rows="4"
                class="w-full rounded-lg border-slate-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm px-4 py-2.5 border hidden">Main paragraph with <strong>rich</strong> text.</textarea>
    </div>

    <!-- ====== note (CKEditor) ====== -->
    <div>
      <label for="note" class="block text-sm font-medium text-slate-700 mb-1">Note (CKEditor)</label>
      <textarea id="note" name="note" rows="3"
                class="w-full rounded-lg border-slate-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm px-4 py-2.5 border hidden">Additional note with <span style="background-color: #fef08a;">highlight</span>.</textarea>
    </div>

    <!-- ====== sec_heading (CKEditor) ====== -->
    <div>
      <label for="sec_heading" class="block text-sm font-medium text-slate-700 mb-1">Secondary heading (CKEditor)</label>
      <textarea id="sec_heading" name="sec_heading" rows="2"
                class="w-full rounded-lg border-slate-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm px-4 py-2.5 border hidden">Secondary section title</textarea>
    </div>

    <!-- ====== sec_imag (plain) ====== -->
    <div>
      <label for="sec_imag" class="block text-sm font-medium text-slate-700 mb-1">Secondary image (URL)</label>
      <input type="file" id="sec_imag" name="sec_imag"
             class="w-full rounded-lg border-slate-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm px-4 py-2.5 border">
    </div>

    <!-- ====== sec_paragraph (CKEditor) ====== -->
    <div>
      <label for="sec_paragraph" class="block text-sm font-medium text-slate-700 mb-1">Secondary paragraph (CKEditor)</label>
      <textarea id="sec_paragraph" name="sec_paragraph" rows="4"
                class="w-full rounded-lg border-slate-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm px-4 py-2.5 border hidden">Detailed secondary content with <ul><li>list</li><li>inside</li></ul>.</textarea>
    </div>

    <!-- ====== third_heading (CKEditor) ====== -->
    <div>
      <label for="third_heading" class="block text-sm font-medium text-slate-700 mb-1">Third heading (CKEditor)</label>
      <textarea id="third_heading" name="third_heading" rows="2"
                class="w-full rounded-lg border-slate-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm px-4 py-2.5 border hidden">Third level heading</textarea>
    </div>

 =

    <!-- ====== serviceCat_id (plain) ====== -->
    <div>
      <label for="serviceCat_id" class="block text-sm font-medium text-slate-700 mb-1">Service category ID</label>
     <select name="serviceCat_id" id="" class="w-full rounded-lg border-slate-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm px-4 py-2.5 border">
        <option value="">Select Category</option>
        @foreach ($serCat as $key=> $data )
        <option value="{{ $data->id }}">{{ $data->name }}</option>
        @endforeach
     </select>
    </div>


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
        <!-- initial example listing (will be cloned or used as template) -->
        <div class="listing-item bg-slate-50 p-4 rounded-lg border border-slate-200 relative group">
          <div class="flex items-start gap-3">
            <div class="flex-1 space-y-3">
              <div>
                <label class="block text-xs font-medium text-slate-600 mb-0.5">Listing heading</label>
                <input type="text" name="listing_heading[]" placeholder="e.g. Feature heading"
                       class="w-full rounded border-slate-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm px-3 py-1.5 border">
              </div>
              <div>
                <label class="block text-xs font-medium text-slate-600 mb-0.5">Summary</label>
                <textarea name="listing_summary[]" rows="2" placeholder="Short summary text"
                          class="w-full rounded border-slate-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm px-3 py-1.5 border"></textarea>
              </div>
            </div>
            <button type="button" class="remove-listing text-slate-400 hover:text-red-500 transition-colors p-1 mt-1" title="Remove listing">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
              </svg>
            </button>
          </div>
        </div>
      </div>
      <p class="text-xs text-slate-400 mt-2">Click "Add listing" to add a new heading + summary pair.</p>
    </div>

    <div>
      <label for="sec_imag" class="block text-sm font-medium text-slate-700 mb-1">External image</label>
      <input type="file" id="sec_imag" name="ext_images[]" accept="multiple" multiple
             class="w-full rounded-lg border-slate-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm px-4 py-2.5 border">
    </div>
    <!-- submit -->
    <div class="pt-4 border-t border-slate-200 flex justify-end">
      <button type="submit" class="inline-flex items-center px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg shadow-sm transition-colors duration-150 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
        Add service
      </button>
    </div>
  </form>
  <p class="text-xs text-slate-400 mt-6 text-center">Tailwind CSS only · dynamic listings with heading + summary</p>
</div>

<script>
  (function() {
    // ----- CKEditor initialization (unchanged) -----
    function initEditors() {
      const editorIds = [
        'first_heading', 'paragraph', 'note', 'sec_heading',
        'sec_paragraph', 'third_heading', 'lists'
      ];
      editorIds.forEach(id => {
        const textarea = document.getElementById(id);
        if (!textarea) return;
        ClassicEditor
          .create(textarea, {
            toolbar: [ 'heading', '|', 'bold', 'italic', 'underline', '|', 'bulletedList', 'numberedList', '|', 'link', 'blockQuote', 'undo', 'redo' ],
          })
          .then(editor => {
            console.log(`✅ CKEditor ready for #${id}`);
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

    // function to create a new listing item (clone from first child, but we build fresh)
    function createListingItem(headingValue = '', summaryValue = '') {
      const div = document.createElement('div');
      div.className = 'listing-item bg-slate-50 p-4 rounded-lg border border-slate-200 relative group';

      div.innerHTML = `
        <div class="flex items-start gap-3">
          <div class="flex-1 space-y-3">
            <div>
              <label class="block text-xs font-medium text-slate-600 mb-0.5">Listing heading</label>
              <input type="text" name="listing_heading[]" placeholder="e.g. Feature heading"
                     value="${headingValue}"
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
      // re-attach remove events (delegation already handles)
    });

    // Remove listing (event delegation on container)
    container.addEventListener('click', function(e) {
      const removeBtn = e.target.closest('.remove-listing');
      if (!removeBtn) return;
      const listingItem = removeBtn.closest('.listing-item');
      if (!listingItem) return;
      // prevent removing the last one? we allow remove any, but ensure at least one remains? optional.
      // if (container.children.length <= 1) {
      //   alert('At least one listing is required.');
      //   return;
      // }
      listingItem.remove();
    });

    // (Optional) If you want to keep at least one, but we allow full dynamic.
    // Also we want to make sure the initial one can be removed too – that's fine.

    console.log('✅ Dynamic listings ready – click "Add listing" to add heading+summary pairs.');
  })();
</script>

@endsection
