@extends('admin.loyout.master')

@section('content')



    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    toastr.error(@json($error));
                });
            </script>
        @endforeach
    @endif

    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                toastr.success(@json(session('success')));
            });
        </script>
    @endif



    <meta name="csrf-token" content="{{ csrf_token() }}">






    <style>
        .ck-editor__editable_inline {
            min-height: 180px;
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



        <div class="mb-8 border-b border-slate-200 pb-4 flex items-center justify-between">

            <div>
                <h1 class="text-3xl font-bold text-slate-800 tracking-tight">
                    ✏️ Edit Service
                </h1>

                <p class="text-sm text-slate-500 mt-1">
                    Update service fields · dynamic listings with CKEditor
                </p>
            </div>

            <a href="{{ route('service.index') }}"
                class="inline-flex items-center gap-2 px-4 py-2
                       bg-slate-100 hover:bg-slate-200
                       text-slate-700 text-sm font-medium
                       rounded-lg transition-colors">

                <i class="fas fa-arrow-left"></i>
                Back

            </a>

        </div>




        <form action="{{ route('service.update', $service->id) }}" method="POST" enctype="multipart/form-data"
            class="space-y-6 bg-white shadow-sm rounded-xl
                   p-6 md:p-8 border border-slate-200">

            @csrf




            <div>

                <label for="heading" class="block text-sm font-medium text-slate-700 mb-1">
                    Heading
                </label>

                <input type="text" id="heading" name="heading" placeholder="Service main heading"
                    value="{{ old('heading', $service->heading) }}"
                    class="w-full rounded-lg border-slate-300
                           shadow-sm focus:border-indigo-500
                           focus:ring-indigo-500 sm:text-sm
                           px-4 py-2.5 border">

                @error('heading')
                    <p class="text-red-500 text-xs mt-1">
                        {{ $message }}
                    </p>
                @enderror

            </div>



            <div>

                <label for="main_img" class="block text-sm font-medium text-slate-700 mb-1">
                    Main Image
                </label>

                @if ($service->main_img)
                    <div class="mb-3">

                        <p class="text-xs text-slate-500 mb-1">
                            Current image:
                        </p>

                        <img src="{{ asset($service->main_img) }}" alt="Main image" class="preview-image">

                    </div>
                @endif

                <input type="file" id="main_img" name="main_img" accept="image/*"
                    class="w-full rounded-lg border-slate-300
                           shadow-sm focus:border-indigo-500
                           focus:ring-indigo-500 sm:text-sm
                           px-4 py-2.5 border">

                <p class="text-xs text-slate-400 mt-1">
                    Leave empty to keep current image.
                </p>

                @error('main_img')
                    <p class="text-red-500 text-xs mt-1">
                        {{ $message }}
                    </p>
                @enderror

            </div>



            <div>

                <label for="small_pag" class="block text-sm font-medium text-slate-700 mb-1">
                    Small Paragraph
                </label>

                <input type="text" id="small_pag" name="small_pag" placeholder="Short description"
                    value="{{ old('small_pag', $service->small_pag) }}"
                    class="w-full rounded-lg border-slate-300
                           shadow-sm focus:border-indigo-500
                           focus:ring-indigo-500 sm:text-sm
                           px-4 py-2.5 border">

                @error('small_pag')
                    <p class="text-red-500 text-xs mt-1">
                        {{ $message }}
                    </p>
                @enderror

            </div>




            <div>

                <label for="first_heading" class="block text-sm font-medium text-slate-700 mb-1">
                    First Heading
                </label>

                <input type="text" id="first_heading" name="first_heading" placeholder="Service first heading"
                    value="{{ old('first_heading', $service->first_heading) }}"
                    class="w-full rounded-lg border-slate-300
                           shadow-sm focus:border-indigo-500
                           focus:ring-indigo-500 sm:text-sm
                           px-4 py-2.5 border">

                @error('first_heading')
                    <p class="text-red-500 text-xs mt-1">
                        {{ $message }}
                    </p>
                @enderror

            </div>




            <div>

                <label for="paragraph" class="block text-sm font-medium text-slate-700 mb-1">
                    Paragraph
                </label>

                <textarea id="paragraph" name="paragraph" rows="6"
                    class="w-full rounded-lg border-slate-300
                           shadow-sm focus:border-indigo-500
                           focus:ring-indigo-500 sm:text-sm
                           px-4 py-2.5 border">{{ old('paragraph', $service->paragraph) }}</textarea>

                @error('paragraph')
                    <p class="text-red-500 text-xs mt-1">
                        {{ $message }}
                    </p>
                @enderror

            </div>




            <div>

                <label for="note" class="block text-sm font-medium text-slate-700 mb-1">
                    Note
                </label>

                <textarea id="note" name="note" rows="5"
                    class="w-full rounded-lg border-slate-300
                           shadow-sm focus:border-indigo-500
                           focus:ring-indigo-500 sm:text-sm
                           px-4 py-2.5 border">{{ old('note', $service->note) }}</textarea>

                @error('note')
                    <p class="text-red-500 text-xs mt-1">
                        {{ $message }}
                    </p>
                @enderror

            </div>




            <div>

                <label for="sec_heading" class="block text-sm font-medium text-slate-700 mb-1">
                    Secondary Heading
                </label>

                <textarea id="sec_heading" name="sec_heading" rows="4"
                    class="w-full rounded-lg border-slate-300
                           shadow-sm focus:border-indigo-500
                           focus:ring-indigo-500 sm:text-sm
                           px-4 py-2.5 border">{{ old('sec_heading', $service->sec_heading) }}</textarea>

                @error('sec_heading')
                    <p class="text-red-500 text-xs mt-1">
                        {{ $message }}
                    </p>
                @enderror

            </div>




            <div>

                <label for="sec_imag" class="block text-sm font-medium text-slate-700 mb-1">
                    Secondary Image
                </label>

                @if ($service->sec_imag)
                    <div class="mb-3">

                        <p class="text-xs text-slate-500 mb-1">
                            Current image:
                        </p>

                        <img src="{{ asset($service->sec_imag) }}" alt="Secondary image" class="preview-image">

                    </div>
                @endif

                <input type="file" id="sec_imag" name="sec_imag" accept="image/*"
                    class="w-full rounded-lg border-slate-300
                           shadow-sm focus:border-indigo-500
                           focus:ring-indigo-500 sm:text-sm
                           px-4 py-2.5 border">

                <p class="text-xs text-slate-400 mt-1">
                    Leave empty to keep current image.
                </p>

                @error('sec_imag')
                    <p class="text-red-500 text-xs mt-1">
                        {{ $message }}
                    </p>
                @enderror

            </div>



            <div>

                <label for="sec_paragraph" class="block text-sm font-medium text-slate-700 mb-1">
                    Secondary Paragraph
                </label>

                <textarea id="sec_paragraph" name="sec_paragraph" rows="6"
                    class="w-full rounded-lg border-slate-300
                           shadow-sm focus:border-indigo-500
                           focus:ring-indigo-500 sm:text-sm
                           px-4 py-2.5 border">{{ old('sec_paragraph', $service->sec_paragraph) }}</textarea>

                @error('sec_paragraph')
                    <p class="text-red-500 text-xs mt-1">
                        {{ $message }}
                    </p>
                @enderror

            </div>




            <div>

                <label for="third_heading" class="block text-sm font-medium text-slate-700 mb-1">
                    Third Heading
                </label>

                <textarea id="third_heading" name="third_heading" rows="4"
                    class="w-full rounded-lg border-slate-300
                           shadow-sm focus:border-indigo-500
                           focus:ring-indigo-500 sm:text-sm
                           px-4 py-2.5 border">{{ old('third_heading', $service->third_heading) }}</textarea>

                @error('third_heading')
                    <p class="text-red-500 text-xs mt-1">
                        {{ $message }}
                    </p>
                @enderror

            </div>



            <div>

                <label for="serviceCat_id" class="block text-sm font-medium text-slate-700 mb-1">
                    Service Category
                </label>

                <select name="serviceCat_id" id="serviceCat_id"
                    class="w-full rounded-lg border-slate-300
                           shadow-sm focus:border-indigo-500
                           focus:ring-indigo-500 sm:text-sm
                           px-4 py-2.5 border">

                    <option value="">
                        Select Category
                    </option>

                    @foreach ($serCat as $category)
                        <option value="{{ $category->id }}"
                            {{ old('serviceCat_id', $service->serviceCat_id) == $category->id ? 'selected' : '' }}>

                            {{ $category->name }}

                        </option>
                    @endforeach

                </select>

                @error('serviceCat_id')
                    <p class="text-red-500 text-xs mt-1">
                        {{ $message }}
                    </p>
                @enderror

            </div>




            <div>

                <label for="content" class="block text-sm font-medium text-slate-700 mb-1">
                    Content
                </label>

                <textarea id="content" name="content" rows="8"
                    class="w-full rounded-lg border-slate-300
                           shadow-sm focus:border-indigo-500
                           focus:ring-indigo-500 sm:text-sm
                           px-4 py-2.5 border">{{ old('content', $service->content ?? '') }}</textarea>

                @error('content')
                    <p class="text-red-500 text-xs mt-1">
                        {{ $message }}
                    </p>
                @enderror

            </div>



            <div class="pt-4 border-t border-slate-200">

                <div class="flex items-center justify-between mb-3">

                    <h2 class="text-lg font-semibold text-slate-700">
                        📋 Listings
                    </h2>

                    <button type="button" id="addListingBtn"
                        class="inline-flex items-center gap-1
                               px-4 py-2 bg-indigo-600
                               hover:bg-indigo-700 text-white
                               text-sm font-medium rounded-lg
                               shadow-sm">

                        <span>+</span>
                        Add Listing

                    </button>

                </div>


                <div id="listingsContainer" class="space-y-4">

                    @php
                        $listData = [];

                        if (!empty($service->list)) {
                            $decodedList = json_decode($service->list, true);

                            if (is_array($decodedList)) {
                                $listData = $decodedList;
                            }
                        }
                    @endphp


                    @forelse ($listData as $item)
                        @if (is_array($item))
                            <div
                                class="listing-item bg-slate-50
                                        p-4 rounded-lg
                                        border border-slate-200
                                        relative">

                                <div class="flex items-start gap-3">

                                    <div class="flex-1 space-y-3">

                                        {{-- Listing Heading --}}

                                        <div>

                                            <label
                                                class="block text-xs
                                                       font-medium
                                                       text-slate-600
                                                       mb-1">

                                                Listing Heading

                                            </label>

                                            <input type="text" name="listing_heading[]"
                                                value="{{ $item['heading'] ?? '' }}" placeholder="Feature heading"
                                                class="w-full rounded
                                                       border-slate-300
                                                       shadow-sm
                                                       sm:text-sm
                                                       px-3 py-1.5
                                                       border">

                                        </div>


                                        {{-- Summary --}}

                                        <div>

                                            <label
                                                class="block text-xs
                                                       font-medium
                                                       text-slate-600
                                                       mb-1">

                                                Summary

                                            </label>

                                            <textarea name="listing_summary[]" rows="2" placeholder="Short summary"
                                                class="w-full rounded
                                                       border-slate-300
                                                       shadow-sm
                                                       sm:text-sm
                                                       px-3 py-1.5
                                                       border">{{ $item['summary'] ?? '' }}</textarea>

                                        </div>

                                    </div>


                                    <button type="button"
                                        class="remove-listing
                                               text-slate-400
                                               hover:text-red-500
                                               p-1"
                                        title="Remove">

                                        ✕

                                    </button>

                                </div>

                            </div>
                        @endif

                    @empty

                        {{-- Default Listing --}}

                        <div
                            class="listing-item bg-slate-50
                                    p-4 rounded-lg
                                    border border-slate-200
                                    relative">

                            <div class="flex items-start gap-3">

                                <div class="flex-1 space-y-3">

                                    <div>

                                        <label
                                            class="block text-xs
                                                   font-medium
                                                   text-slate-600 mb-1">

                                            Listing Heading

                                        </label>

                                        <input type="text" name="listing_heading[]" placeholder="Feature heading"
                                            class="w-full rounded
                                                   border-slate-300
                                                   shadow-sm sm:text-sm
                                                   px-3 py-1.5 border">

                                    </div>


                                    <div>

                                        <label
                                            class="block text-xs
                                                   font-medium
                                                   text-slate-600 mb-1">

                                            Summary

                                        </label>

                                        <textarea name="listing_summary[]" rows="2" placeholder="Short summary"
                                            class="w-full rounded
                                                   border-slate-300
                                                   shadow-sm sm:text-sm
                                                   px-3 py-1.5 border"></textarea>

                                    </div>

                                </div>


                                <button type="button"
                                    class="remove-listing
                                           text-slate-400
                                           hover:text-red-500 p-1"
                                    title="Remove">

                                    ✕

                                </button>

                            </div>

                        </div>
                    @endforelse

                </div>


                <p class="text-xs text-slate-400 mt-2">
                    Click "Add Listing" to add a new heading + summary pair.
                </p>

            </div>




            <div class="pt-4 border-t border-slate-200">

                <label for="external_images" class="block text-sm font-medium text-slate-700 mb-1">

                    External Images

                </label>

                <input type="file" id="external_images" name="ext_images[]" accept="image/*" multiple
                    class="w-full rounded-lg border-slate-300
                           shadow-sm focus:border-indigo-500
                           focus:ring-indigo-500 sm:text-sm
                           px-4 py-2.5 border">

                <p class="text-xs text-slate-400 mt-1">
                    You can select multiple images.
                </p>

                @error('ext_images')
                    <p class="text-red-500 text-xs mt-1">
                        {{ $message }}
                    </p>
                @enderror

                @error('ext_images.*')
                    <p class="text-red-500 text-xs mt-1">
                        {{ $message }}
                    </p>
                @enderror

            </div>



            @php
                $externalImages = [];

                if (!empty($service->ext_images)) {
                    $decodedImages = json_decode($service->ext_images, true);

                    if (is_array($decodedImages)) {
                        $externalImages = $decodedImages;
                    }
                }
            @endphp


            @if (count($externalImages) > 0)
                <div>

                    <p class="text-sm font-medium text-slate-700 mb-3">
                        Existing External Images
                    </p>

                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">

                        @foreach ($externalImages as $image)
                            @php
                                $imageId = 'external-image-' . md5($image);
                            @endphp

                            <div class="relative group" id="{{ $imageId }}">

                                <img src="{{ asset($image) }}"
                                    class="w-full h-32 object-cover
                                           rounded-lg border"
                                    alt="External image">

                                <button type="button"
                                    onclick="deleteExternalImage(
                                        {{ $service->id }},
                                        @js($image),
                                        @js($imageId)
                                    )"
                                    class="absolute top-2 right-2
                                           w-7 h-7 flex items-center
                                           justify-center
                                           bg-red-600 text-white
                                           rounded-full shadow
                                           hover:bg-red-700 transition"
                                    title="Delete image">

                                    &times;

                                </button>

                            </div>
                        @endforeach

                    </div>

                </div>
            @endif



            <div class="pt-4 border-t border-slate-200
                        flex justify-end gap-3">

                <a href="{{ route('service.index') }}"
                    class="inline-flex items-center
                           px-6 py-2.5 bg-slate-100
                           hover:bg-slate-200 text-slate-700
                           text-sm font-medium rounded-lg">

                    Cancel

                </a>


                <button type="submit"
                    class="inline-flex items-center
                           px-6 py-2.5 bg-indigo-600
                           hover:bg-indigo-700 text-white
                           text-sm font-medium rounded-lg
                           shadow-sm">

                    Update Service

                </button>

            </div>

        </form>


        <p class="text-xs text-slate-400 mt-6 text-center">
            Dynamic listings + CKEditor + image uploads
        </p>

    </div>


    <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            class MyUploadAdapter {

                constructor(loader) {
                    this.loader = loader;
                }

                upload() {

                    return this.loader.file.then(file => {

                        return new Promise((resolve, reject) => {

                            const data = new FormData();

                            data.append('upload', file);

                            const csrfToken =
                                document
                                .querySelector('meta[name="csrf-token"]')
                                .getAttribute('content');

                            fetch("{{ route('ckeditor.upload') }}", {
                                    method: 'POST',

                                    headers: {
                                        'X-CSRF-TOKEN': csrfToken,
                                        'Accept': 'application/json'
                                    },

                                    body: data
                                })

                                .then(response => response.json())

                                .then(result => {

                                    console.log('CKEditor upload:', result);

                                    if (result.url) {

                                        resolve({
                                            default: result.url
                                        });

                                    } else {

                                        reject(
                                            result?.error?.message ||
                                            'Image upload failed.'
                                        );

                                    }

                                })

                                .catch(error => {

                                    console.error(
                                        'CKEditor upload error:',
                                        error
                                    );

                                    reject(
                                        error.message ||
                                        'Cannot upload image.'
                                    );

                                });

                        });

                    });

                }

                abort() {}
            }


            function MyCustomUploadAdapterPlugin(editor) {

                editor.plugins
                    .get('FileRepository')
                    .createUploadAdapter = loader => {

                        return new MyUploadAdapter(loader);

                    };
            }


            const editorIds = [
                'paragraph',
                'note',
                'sec_heading',
                'sec_paragraph',
                'third_heading',
                'content'
            ];


            editorIds.forEach(function(id) {

                const element =
                    document.getElementById(id);


                if (!element) {

                    console.warn(
                        'CKEditor element not found:',
                        id
                    );

                    return;
                }


                ClassicEditor
                    .create(element, {

                        extraPlugins: [
                            MyCustomUploadAdapterPlugin
                        ],

                        toolbar: [
                            'heading',
                            '|',
                            'bold',
                            'italic',
                            'underline',
                            'link',
                            '|',
                            'bulletedList',
                            'numberedList',
                            '|',
                            'blockQuote',
                            'insertTable',
                            'imageUpload',
                            'mediaEmbed',
                            '|',
                            'undo',
                            'redo'
                        ]

                    })

                    .then(editor => {

                        window[id + 'Editor'] = editor;

                        console.log(
                            'CKEditor initialized:',
                            id
                        );

                    })

                    .catch(error => {

                        console.error(
                            'CKEditor initialization failed:',
                            id,
                            error
                        );

                    });

            });

        });
    </script>




    <script>
        function deleteExternalImage(
            serviceId,
            imagePath,
            elementId
        ) {

            if (
                !confirm(
                    'Are you sure you want to delete this image?'
                )
            ) {
                return;
            }


            const csrfElement =
                document.querySelector(
                    'meta[name="csrf-token"]'
                );


            if (!csrfElement) {

                toastr.error(
                    'CSRF token not found.'
                );

                return;
            }


            const csrfToken =
                csrfElement.getAttribute('content');


            const url =
                "{{ route('service.external-image.delete', ':id') }}"
                .replace(
                    ':id',
                    serviceId
                );


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


                .then(async response => {

                    const text =
                        await response.text();


                    let data;


                    try {

                        data =
                            JSON.parse(text);

                    } catch (error) {

                        console.error(
                            'Delete image response:',
                            text
                        );


                        throw new Error(
                            `Server returned ${response.status}`
                        );

                    }


                    if (!response.ok) {

                        throw new Error(
                            data.message ||
                            'Image delete failed.'
                        );

                    }


                    return data;

                })


                .then(data => {

                    if (data.success) {

                        const imageElement =
                            document.getElementById(
                                elementId
                            );


                        if (imageElement) {
                            imageElement.remove();
                        }


                        toastr.success(
                            data.message ||
                            'Image deleted successfully.'
                        );

                    } else {

                        toastr.error(
                            data.message ||
                            'Image delete failed.'
                        );

                    }

                })


                .catch(error => {

                    console.error(
                        'Delete image error:',
                        error
                    );


                    toastr.error(
                        error.message ||
                        'Something went wrong.'
                    );

                });

        }
    </script>

@endsection
