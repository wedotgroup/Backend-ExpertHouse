@extends('admin.loyout.master')

@section('content')

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <script>
                toastr.error(@json($error));
            </script>
        @endforeach
    @endif

    <style>
        .ck-editor__editable_inline {
            min-height: 180px;
        }

        .listing-item {
            transition: all 0.1s ease;
        }

        .ck-content img {
            max-width: 100%;
            height: auto;
        }
    </style>

    <div class="max-w-4xl mx-auto px-4 py-8 sm:px-6 lg:px-8">

        {{-- Header --}}
        <div class="mb-8 border-b border-slate-200 pb-4 flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-slate-800 tracking-tight">
                    ➕ Add New Service
                </h1>

                <p class="text-sm text-slate-500 mt-1">
                    Create service content with images and rich text
                </p>
            </div>
        </div>


        {{-- Form --}}
        <form action="{{ route('service.add') }}" method="POST" enctype="multipart/form-data"
            class="space-y-6 bg-white shadow-sm rounded-xl p-6 md:p-8 border border-slate-200">

            @csrf


            <div>
                <label for="heading" class="block text-sm font-medium text-slate-700 mb-1">
                    Heading
                </label>

                <input type="text" id="heading" name="heading" value="{{ old('heading') }}"
                    placeholder="Service main heading"
                    class="w-full rounded-lg border-slate-300 shadow-sm
                       focus:border-indigo-500 focus:ring-indigo-500
                       sm:text-sm px-4 py-2.5 border">
            </div>



            <div>
                <label for="main_img" class="block text-sm font-medium text-slate-700 mb-1">
                    Main Image
                </label>

                <input type="file" id="main_img" name="main_img" accept="image/jpeg,image/png,image/webp,image/jpg"
                    class="w-full rounded-lg border-slate-300 shadow-sm
                       focus:border-indigo-500 focus:ring-indigo-500
                       sm:text-sm px-4 py-2.5 border">
            </div>


            <div>
                <label for="small_pag" class="block text-sm font-medium text-slate-700 mb-1">
                    Small Paragraph
                </label>

                <input type="text" id="small_pag" name="small_pag" value="{{ old('small_pag') }}"
                    placeholder="Short description"
                    class="w-full rounded-lg border-slate-300 shadow-sm
                       focus:border-indigo-500 focus:ring-indigo-500
                       sm:text-sm px-4 py-2.5 border">
            </div>



            <div>
                <label for="first_heading" class="block text-sm font-medium text-slate-700 mb-1">
                    First Heading
                </label>

                <textarea id="first_heading" name="first_heading">{{ old('first_heading') }}</textarea>
            </div>



            <div>
                <label for="paragraph" class="block text-sm font-medium text-slate-700 mb-1">
                    Paragraph
                </label>

                <textarea id="paragraph" name="paragraph">{{ old('paragraph') }}</textarea>
            </div>



            <div>
                <label for="note" class="block text-sm font-medium text-slate-700 mb-1">
                    Note
                </label>

                <textarea id="note" name="note">{{ old('note') }}</textarea>
            </div>



            <div>
                <label for="sec_heading" class="block text-sm font-medium text-slate-700 mb-1">
                    Secondary Heading
                </label>

                <textarea id="sec_heading" name="sec_heading">{{ old('sec_heading') }}</textarea>
            </div>



            <div>
                <label for="sec_imag" class="block text-sm font-medium text-slate-700 mb-1">
                    Secondary Image
                </label>

                <input type="file" id="sec_imag" name="sec_imag" accept="image/jpeg,image/png,image/webp,image/jpg"
                    class="w-full rounded-lg border-slate-300 shadow-sm
                       focus:border-indigo-500 focus:ring-indigo-500
                       sm:text-sm px-4 py-2.5 border">
            </div>



            <div>
                <label for="sec_paragraph" class="block text-sm font-medium text-slate-700 mb-1">
                    Secondary Paragraph
                </label>

                <textarea id="sec_paragraph" name="sec_paragraph">{{ old('sec_paragraph') }}</textarea>
            </div>



            <div>
                <label for="third_heading" class="block text-sm font-medium text-slate-700 mb-1">
                    Third Heading
                </label>

                <textarea id="third_heading" name="third_heading">{{ old('third_heading') }}</textarea>
            </div>



            <div>
                <label for="serviceCat_id" class="block text-sm font-medium text-slate-700 mb-1">
                    Service Category
                </label>

                <select name="serviceCat_id" id="serviceCat_id"
                    class="w-full rounded-lg border-slate-300 shadow-sm
                       focus:border-indigo-500 focus:ring-indigo-500
                       sm:text-sm px-4 py-2.5 border">

                    <option value="">
                        Select Category
                    </option>

                    @foreach ($serCat as $data)
                        <option value="{{ $data->id }}" {{ old('serviceCat_id') == $data->id ? 'selected' : '' }}>
                            {{ $data->name }}
                        </option>
                    @endforeach

                </select>
            </div>



            <div class="pt-4 border-t border-slate-200">

                <div class="flex items-center justify-between mb-3">

                    <h2 class="text-lg font-semibold text-slate-700">
                        📋 Listings
                    </h2>

                    <button type="button" id="addListingBtn"
                        class="inline-flex items-center gap-1 px-4 py-2
                           bg-indigo-600 hover:bg-indigo-700
                           text-white text-sm font-medium rounded-lg">
                        <span>+</span>
                        Add Listing
                    </button>

                </div>


                <div id="listingsContainer" class="space-y-4">

                    <div class="listing-item bg-slate-50 p-4 rounded-lg border border-slate-200">

                        <div class="flex items-start gap-3">

                            <div class="flex-1 space-y-3">

                                <div>

                                    <label class="block text-xs font-medium text-slate-600 mb-1">
                                        Listing Heading
                                    </label>

                                    <input type="text" name="listing_heading[]" placeholder="Feature heading"
                                        class="w-full rounded border-slate-300
                                           shadow-sm sm:text-sm px-3 py-1.5 border">

                                </div>


                                <div>

                                    <label class="block text-xs font-medium text-slate-600 mb-1">
                                        Summary
                                    </label>

                                    <textarea name="listing_summary[]" rows="2" placeholder="Short summary"
                                        class="w-full rounded border-slate-300
                                           shadow-sm sm:text-sm px-3 py-1.5 border"></textarea>

                                </div>

                            </div>


                            <button type="button" class="remove-listing text-slate-400 hover:text-red-500 p-1"
                                title="Remove listing">
                                ✕
                            </button>

                        </div>

                    </div>

                </div>

            </div>


            <div>

                <label for="ext_images" class="block text-sm font-medium text-slate-700 mb-1">
                    External Images
                </label>

                <input type="file" id="ext_images" name="ext_images[]" accept="image/jpeg,image/png,image/webp,image/jpg"
                    multiple
                    class="w-full rounded-lg border-slate-300 shadow-sm
                       focus:border-indigo-500 focus:ring-indigo-500
                       sm:text-sm px-4 py-2.5 border">

            </div>


            <div>

                <label for="content" class="block text-sm font-medium text-slate-700 mb-2">
                    External Content
                </label>

                <textarea name="content" id="content">{{ old('content') }}</textarea>

            </div>



            <div class="pt-4 border-t border-slate-200 flex justify-end">

                <button type="submit"
                    class="inline-flex items-center px-6 py-2.5
                       bg-indigo-600 hover:bg-indigo-700
                       text-white text-sm font-medium rounded-lg">
                    Add Service
                </button>

            </div>

        </form>

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

                            const csrfToken = document
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
                                .then(async response => {

                                    const responseText =
                                        await response.text();


                                    console.log(
                                        'CKEDITOR STATUS:',
                                        response.status
                                    );

                                    console.log(
                                        'CKEDITOR RESPONSE:',
                                        responseText
                                    );


                                    let result;

                                    try {

                                        result =
                                            JSON.parse(responseText);

                                    } catch (error) {

                                        reject(
                                            `Server Error (${response.status}): ` +
                                            responseText.substring(0, 500)
                                        );

                                        return;
                                    }


                                    if (!response.ok) {

                                        reject(
                                            result?.error?.message ||
                                            `Upload failed (${response.status})`
                                        );

                                        return;
                                    }


                                    if (result.url) {

                                        resolve({
                                            default: result.url
                                        });

                                    } else {

                                        reject(
                                            result?.error?.message ||
                                            'Image URL not returned.'
                                        );
                                    }

                                })

                                .catch(error => {

                                    console.error(
                                        'CKEditor Upload Error:',
                                        error
                                    );

                                    reject(
                                        error.message ||
                                        'Cannot upload file.'
                                    );

                                });

                        });

                    });

                }


                abort() {
                    // Upload cancel
                }

            }




            function MyCustomUploadAdapterPlugin(editor) {

                editor.plugins
                    .get('FileRepository')
                    .createUploadAdapter = loader => {

                        return new MyUploadAdapter(loader);

                    };

            }




            const editorConfig = {

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

            };




            const editorIds = [

                'first_heading',
                'paragraph',
                'note',
                'sec_heading',
                'sec_paragraph',
                'third_heading',
                'content'

            ];


            editorIds.forEach(function(id) {

                const textarea =
                    document.getElementById(id);


                if (!textarea) {
                    return;
                }


                ClassicEditor
                    .create(
                        textarea,
                        editorConfig
                    )

                    .then(function(editor) {

                        window[id + 'Editor'] = editor;

                        console.log(
                            'CKEditor loaded:',
                            id
                        );

                    })

                    .catch(function(error) {

                        console.error(
                            'CKEditor error for #' + id,
                            error
                        );

                    });

            });



            const container =
                document.getElementById('listingsContainer');


            const addBtn =
                document.getElementById('addListingBtn');


            if (container && addBtn) {

                addBtn.addEventListener(
                    'click',
                    function() {

                        const div =
                            document.createElement('div');


                        div.className =
                            'listing-item bg-slate-50 p-4 rounded-lg border border-slate-200';


                        div.innerHTML = `

                    <div class="flex items-start gap-3">

                        <div class="flex-1 space-y-3">

                            <div>

                                <label
                                    class="block text-xs font-medium text-slate-600 mb-1"
                                >
                                    Listing Heading
                                </label>

                                <input
                                    type="text"
                                    name="listing_heading[]"
                                    placeholder="Feature heading"
                                    class="w-full rounded border-slate-300
                                           shadow-sm sm:text-sm px-3 py-1.5 border"
                                >

                            </div>


                            <div>

                                <label
                                    class="block text-xs font-medium text-slate-600 mb-1"
                                >
                                    Summary
                                </label>

                                <textarea
                                    name="listing_summary[]"
                                    rows="2"
                                    placeholder="Short summary"
                                    class="w-full rounded border-slate-300
                                           shadow-sm sm:text-sm px-3 py-1.5 border"
                                ></textarea>

                            </div>

                        </div>


                        <button
                            type="button"
                            class="remove-listing text-slate-400
                                   hover:text-red-500 p-1"
                        >
                            ✕
                        </button>

                    </div>

                `;


                        container.appendChild(div);

                    }
                );




                container.addEventListener(
                    'click',
                    function(event) {

                        const button =
                            event.target.closest('.remove-listing');


                        if (!button) {
                            return;
                        }


                        const item =
                            button.closest('.listing-item');


                        if (item) {
                            item.remove();
                        }

                    }
                );

            }

        });
    </script>

    </script>

@endsection
