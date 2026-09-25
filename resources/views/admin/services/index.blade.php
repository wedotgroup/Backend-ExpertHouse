@extends('admin.loyout.master')

@section('content')

<style>
    * {
        font-family: 'Inter', system-ui, -apple-system, sans-serif;
    }

    .table-wrap::-webkit-scrollbar {
        width: 7px;
        height: 7px;
    }

    .table-wrap::-webkit-scrollbar-track {
        background: #f8fafc;
    }

    .table-wrap::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 999px;
    }

    .table-wrap::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }

    .service-row {
        transition: background-color 0.15s ease;
    }

    .service-row:hover {
        background: #f8fafc;
    }

    .sortable {
        cursor: pointer;
        user-select: none;
    }

    .sortable:hover {
        background: #f1f5f9;
    }

    .sortable i {
        transition: transform 0.2s ease;
    }

    .action-btn {
        transition: all 0.15s ease;
    }

    .action-btn:hover {
        transform: translateY(-1px);
    }

    .image-preview {
        width: 56px;
        height: 56px;
        object-fit: cover;
        border-radius: 12px;
        border: 1px solid #e2e8f0;
        background: #f8fafc;
    }

    #searchInput:focus {
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.10);
    }

    #toast {
        transition:
            opacity 0.3s ease,
            transform 0.3s ease;
        transform: translateY(12px);
    }

    #toast.show {
        opacity: 1;
        transform: translateY(0);
    }

    .content-preview {
        max-width: 220px;
        line-height: 1.5;
    }
</style>

<div class="mx-auto w-full max-w-[1600px] px-3 sm:px-5 lg:px-6">

   
    <div class="mb-5">

        <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">

            <!-- Left -->
            <div class="flex items-center gap-3">

                <div
                    class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-blue-50 text-blue-600">
                    <i class="fas fa-layer-group text-lg"></i>
                </div>

                <div>
                    <h1 class="text-xl font-bold tracking-tight text-slate-900 sm:text-2xl">
                        Services
                    </h1>

                    <div class="mt-1 flex flex-wrap items-center gap-2 text-xs text-slate-500">

                        <span class="flex items-center gap-1.5">
                            <span class="h-2 w-2 rounded-full bg-emerald-500"></span>
                            {{ $services->count() }} total services
                        </span>

                        <span class="text-slate-300">•</span>

                        <span>
                            Manage your service content
                        </span>

                    </div>
                </div>

            </div>

            <!-- Right Actions -->
            <div class="flex flex-col gap-2 sm:flex-row sm:items-center">

                <!-- Search -->
                <div class="relative">

                    <i
                        class="fas fa-search absolute left-3.5 top-1/2 -translate-y-1/2 text-sm text-slate-400">
                    </i>

                    <input
                        type="text"
                        id="searchInput"
                        placeholder="Search services..."
                        autocomplete="off"
                        class="w-full rounded-xl border border-slate-200 bg-white py-2.5 pl-10 pr-4 text-sm text-slate-700 outline-none transition placeholder:text-slate-400 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 sm:w-64"
                    >

                </div>

                <!-- Clear -->
                <button
                    type="button"
                    id="clearSearchBtn"
                    class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-medium text-slate-600 transition hover:border-slate-300 hover:bg-slate-50 hover:text-slate-900"
                >
                    <i class="fas fa-rotate-left text-xs"></i>
                    Clear
                </button>

                <!-- Category -->
                <a
                    href="{{ route('serCat.index') }}"
                    class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-medium text-slate-700 shadow-sm transition hover:bg-slate-50"
                >
                    <i class="fas fa-folder text-xs text-slate-500"></i>
                    Categories
                </a>

                <!-- Add -->
                <a
                    href="{{ route('service.create') }}"
                    class="inline-flex items-center justify-center gap-2 rounded-xl bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700 hover:shadow-md"
                >
                    <i class="fas fa-plus text-xs"></i>
                    Add Service
                </a>

            </div>

        </div>

    </div>



    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

        <!-- Card top -->
        <div
            class="flex flex-col gap-3 border-b border-slate-100 bg-slate-50/60 px-5 py-4 sm:flex-row sm:items-center sm:justify-between">

            <div>

                <h2 class="text-sm font-semibold text-slate-800">
                    Service Listing
                </h2>

                <p class="mt-0.5 text-xs text-slate-400">
                    All service information and content
                </p>

            </div>

            <div class="flex items-center gap-2">

                <span
                    id="resultCount"
                    class="rounded-lg bg-blue-50 px-3 py-1.5 text-xs font-semibold text-blue-700"
                >
                    {{ $services->count() }} results
                </span>

            </div>

        </div>



        <div class="table-wrap overflow-x-auto">

            <table
                id="fieldsTable"
                class="min-w-[1500px] w-full border-collapse text-sm"
            >

                <!-- THEAD -->
                <thead class="sticky top-0 z-10 bg-slate-50">

                    <tr class="border-b border-slate-200">

                        <th
                            data-sort="heading"
                            class="sortable whitespace-nowrap px-5 py-4 text-left text-[11px] font-bold uppercase tracking-wider text-slate-500"
                        >
                            Service
                            <i class="fas fa-sort ml-1 text-[10px] text-slate-300"></i>
                        </th>

                        <th
                            data-sort="main_img"
                            class="sortable whitespace-nowrap px-4 py-4 text-left text-[11px] font-bold uppercase tracking-wider text-slate-500"
                        >
                            Main Image
                            <i class="fas fa-sort ml-1 text-[10px] text-slate-300"></i>
                        </th>

                        <th
                            data-sort="small_pag"
                            class="sortable whitespace-nowrap px-4 py-4 text-left text-[11px] font-bold uppercase tracking-wider text-slate-500"
                        >
                            Small Page
                            <i class="fas fa-sort ml-1 text-[10px] text-slate-300"></i>
                        </th>

                        <th
                            data-sort="first_heading"
                            class="sortable whitespace-nowrap px-4 py-4 text-left text-[11px] font-bold uppercase tracking-wider text-slate-500"
                        >
                            First Heading
                            <i class="fas fa-sort ml-1 text-[10px] text-slate-300"></i>
                        </th>

                        <th
                            data-sort="paragraph"
                            class="sortable whitespace-nowrap px-4 py-4 text-left text-[11px] font-bold uppercase tracking-wider text-slate-500"
                        >
                            Paragraph
                            <i class="fas fa-sort ml-1 text-[10px] text-slate-300"></i>
                        </th>

                        <th
                            data-sort="note"
                            class="sortable whitespace-nowrap px-4 py-4 text-left text-[11px] font-bold uppercase tracking-wider text-slate-500"
                        >
                            Note
                            <i class="fas fa-sort ml-1 text-[10px] text-slate-300"></i>
                        </th>

                        <th
                            data-sort="sec_heading"
                            class="sortable whitespace-nowrap px-4 py-4 text-left text-[11px] font-bold uppercase tracking-wider text-slate-500"
                        >
                            Section Heading
                            <i class="fas fa-sort ml-1 text-[10px] text-slate-300"></i>
                        </th>

                        <th
                            data-sort="sec_imag"
                            class="sortable whitespace-nowrap px-4 py-4 text-left text-[11px] font-bold uppercase tracking-wider text-slate-500"
                        >
                            Section Image
                            <i class="fas fa-sort ml-1 text-[10px] text-slate-300"></i>
                        </th>

                        <th
                            data-sort="sec_paragraph"
                            class="sortable whitespace-nowrap px-4 py-4 text-left text-[11px] font-bold uppercase tracking-wider text-slate-500"
                        >
                            Section Paragraph
                            <i class="fas fa-sort ml-1 text-[10px] text-slate-300"></i>
                        </th>

                        <th
                            data-sort="third_heading"
                            class="sortable whitespace-nowrap px-4 py-4 text-left text-[11px] font-bold uppercase tracking-wider text-slate-500"
                        >
                            Third Heading
                            <i class="fas fa-sort ml-1 text-[10px] text-slate-300"></i>
                        </th>

                        <th
                            data-sort="content"
                            class="sortable whitespace-nowrap px-4 py-4 text-left text-[11px] font-bold uppercase tracking-wider text-slate-500"
                        >
                            External Content
                            <i class="fas fa-sort ml-1 text-[10px] text-slate-300"></i>
                        </th>

                        <th
                            data-sort="serviceCat_id"
                            class="sortable whitespace-nowrap px-4 py-4 text-left text-[11px] font-bold uppercase tracking-wider text-slate-500"
                        >
                            Category
                            <i class="fas fa-sort ml-1 text-[10px] text-slate-300"></i>
                        </th>

                        <th
                            class="whitespace-nowrap px-5 py-4 text-center text-[11px] font-bold uppercase tracking-wider text-slate-500"
                        >
                            Actions
                        </th>

                    </tr>

                </thead>


                <!-- TBODY -->
                <tbody
                    id="tableBody"
                    class="divide-y divide-slate-100"
                >

                    @forelse ($services as $service)

                        <tr
                            class="service-row"
                            data-search="{{ strtolower(
                                ($service->heading ?? '') . ' ' .
                                ($service->small_pag ?? '') . ' ' .
                                ($service->first_heading ?? '') . ' ' .
                                ($service->paragraph ?? '') . ' ' .
                                ($service->note ?? '') . ' ' .
                                ($service->sec_heading ?? '') . ' ' .
                                ($service->sec_paragraph ?? '') . ' ' .
                                ($service->third_heading ?? '') . ' ' .
                                ($service->content ?? '') . ' ' .
                                ($service->serviceCat->name ?? '')
                            ) }}"
                        >

                            <!-- Service -->
                            <td class="px-5 py-4 align-middle">

                                <div class="max-w-[220px]">

                                    <p
                                        class="truncate font-semibold text-slate-800"
                                        title="{{ $service->heading }}"
                                    >
                                        {{ $service->heading ?: 'Untitled Service' }}
                                    </p>

                                    <p class="mt-1 text-xs text-slate-400">
                                        ID #{{ $service->id }}
                                    </p>

                                </div>

                            </td>


                            <!-- Main Image -->
                            <td class="px-4 py-4 align-middle">

                                @if($service->main_img)

                                    <img
                                        src="{{ asset($service->main_img) }}"
                                        alt="{{ $service->heading }}"
                                        class="image-preview"
                                        loading="lazy"
                                    >

                                @else

                                    <div
                                        class="flex h-14 w-14 items-center justify-center rounded-xl border border-dashed border-slate-300 bg-slate-50 text-slate-300"
                                    >
                                        <i class="fas fa-image"></i>
                                    </div>

                                @endif

                            </td>


                            <!-- Small Page -->
                            <td class="px-4 py-4 align-middle">

                                <span
                                    class="inline-flex max-w-[150px] truncate rounded-lg bg-slate-100 px-2.5 py-1.5 text-xs font-medium text-slate-600"
                                    title="{{ $service->small_pag }}"
                                >
                                    {{ $service->small_pag ?: '—' }}
                                </span>

                            </td>


                            <!-- First Heading -->
                            <td class="px-4 py-4 align-middle">

                                <p
                                    class="max-w-[220px] truncate font-medium text-slate-700"
                                    title="{{ $service->first_heading }}"
                                >
                                    {{ $service->first_heading ?: '—' }}
                                </p>

                            </td>


                            <!-- Paragraph -->
                            <td class="px-4 py-4 align-middle">

                                <p
                                    class="content-preview line-clamp-2 text-xs text-slate-500"
                                    title="{{ $service->paragraph }}"
                                >
                                    {{ $service->paragraph ?: 'No paragraph' }}
                                </p>

                            </td>


                            <!-- Note -->
                            <td class="px-4 py-4 align-middle">

                                @if($service->note)

                                    <span
                                        class="inline-flex max-w-[180px] truncate rounded-full bg-blue-50 px-3 py-1.5 text-xs font-medium text-blue-700"
                                        title="{{ $service->note }}"
                                    >
                                        {{ Str::limit($service->note, 35) }}
                                    </span>

                                @else

                                    <span class="text-slate-300">—</span>

                                @endif

                            </td>


                            <!-- Section Heading -->
                            <td class="px-4 py-4 align-middle">

                                <p
                                    class="max-w-[220px] truncate font-medium text-slate-700"
                                    title="{{ $service->sec_heading }}"
                                >
                                    {{ $service->sec_heading ?: '—' }}
                                </p>

                            </td>


                            <!-- Section Image -->
                            <td class="px-4 py-4 align-middle">

                                @if($service->sec_imag)

                                    <img
                                        src="{{ asset($service->sec_imag) }}"
                                        alt="Section Image"
                                        class="image-preview"
                                        loading="lazy"
                                    >

                                @else

                                    <div
                                        class="flex h-14 w-14 items-center justify-center rounded-xl border border-dashed border-slate-300 bg-slate-50 text-slate-300"
                                    >
                                        <i class="fas fa-image"></i>
                                    </div>

                                @endif

                            </td>


                            <!-- Section Paragraph -->
                            <td class="px-4 py-4 align-middle">

                                <p
                                    class="content-preview line-clamp-2 text-xs text-slate-500"
                                    title="{{ $service->sec_paragraph }}"
                                >
                                    {{ $service->sec_paragraph ?: 'No paragraph' }}
                                </p>

                            </td>


                            <!-- Third Heading -->
                            <td class="px-4 py-4 align-middle">

                                <p
                                    class="max-w-[220px] truncate font-medium text-slate-700"
                                    title="{{ $service->third_heading }}"
                                >
                                    {{ $service->third_heading ?: '—' }}
                                </p>

                            </td>


                            <!-- External Content -->
                            <td class="px-4 py-4 align-middle">

                                @if($service->content)

                                    <span
                                        class="inline-flex items-center gap-1.5 rounded-lg bg-violet-50 px-3 py-1.5 text-xs font-semibold text-violet-700"
                                        title="{{ strip_tags($service->content) }}"
                                    >
                                        <i class="fas fa-code text-[10px]"></i>

                                        {{ Str::limit(strip_tags($service->content), 30) }}

                                    </span>

                                @else

                                    <span
                                        class="inline-flex items-center gap-1.5 rounded-lg bg-slate-50 px-3 py-1.5 text-xs font-medium text-slate-400"
                                    >
                                        <i class="fas fa-minus text-[10px]"></i>
                                        No Content
                                    </span>

                                @endif

                            </td>


                            <!-- Category -->
                            <td class="px-4 py-4 align-middle">

                                @if($service->serviceCat)

                                    <span
                                        class="inline-flex items-center gap-1.5 whitespace-nowrap rounded-full bg-emerald-50 px-3 py-1.5 text-xs font-semibold text-emerald-700"
                                    >
                                        <i class="fas fa-folder text-[10px]"></i>
                                        {{ $service->serviceCat->name }}
                                    </span>

                                @else

                                    <span class="text-slate-300">
                                        —
                                    </span>

                                @endif

                            </td>


                            <!-- Actions -->
                            <td class="px-5 py-4 align-middle">

                                <div class="flex items-center justify-center gap-2">

                                    <!-- Edit -->
                                    <a
                                        href="{{ route('service.edit', $service->id) }}"
                                        class="action-btn flex h-9 w-9 items-center justify-center rounded-xl border border-amber-200 bg-amber-50 text-amber-600 hover:border-amber-300 hover:bg-amber-100"
                                        title="Edit Service"
                                    >
                                        <i class="fas fa-pen text-xs"></i>
                                    </a>


                                    <!-- Delete -->
                                    <form
                                        action="{{ route('service.delete', $service->id) }}"
                                        method="POST"
                                        class="inline-block"
                                        onsubmit="return confirm('Are you sure you want to delete this service?')"
                                    >

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="action-btn flex h-9 w-9 items-center justify-center rounded-xl border border-rose-200 bg-rose-50 text-rose-500 hover:border-rose-300 hover:bg-rose-100"
                                            title="Delete Service"
                                        >
                                            <i class="fas fa-trash-can text-xs"></i>
                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr id="emptyRow">

                            <td colspan="13" class="px-6 py-16 text-center">

                                <div class="flex flex-col items-center">

                                    <div
                                        class="mb-4 flex h-16 w-16 items-center justify-center rounded-2xl bg-slate-100 text-slate-400"
                                    >
                                        <i class="fas fa-layer-group text-xl"></i>
                                    </div>

                                    <h3 class="text-sm font-semibold text-slate-700">
                                        No services found
                                    </h3>

                                    <p class="mt-1 text-xs text-slate-400">
                                        Start by creating your first service.
                                    </p>

                                    <a
                                        href="{{ route('service.create') }}"
                                        class="mt-4 inline-flex items-center gap-2 rounded-xl bg-blue-600 px-4 py-2.5 text-xs font-semibold text-white hover:bg-blue-700"
                                    >
                                        <i class="fas fa-plus"></i>
                                        Add Service
                                    </a>

                                </div>

                            </td>

                        </tr>

                    @endforelse

                    <!-- Search Empty -->
                    <tr
                        id="searchEmptyRow"
                        style="display:none;"
                    >

                        <td colspan="13" class="px-6 py-16 text-center">

                            <div class="flex flex-col items-center">

                                <div
                                    class="mb-4 flex h-14 w-14 items-center justify-center rounded-2xl bg-slate-100 text-slate-400"
                                >
                                    <i class="fas fa-search text-lg"></i>
                                </div>

                                <h3 class="text-sm font-semibold text-slate-700">
                                    No matching services
                                </h3>

                                <p class="mt-1 text-xs text-slate-400">
                                    Try searching with a different keyword.
                                </p>

                            </div>

                        </td>

                    </tr>

                </tbody>

            </table>

        </div>


        <div
            class="flex flex-col gap-3 border-t border-slate-100 bg-slate-50/50 px-5 py-4 sm:flex-row sm:items-center sm:justify-between"
        >

            <div class="flex flex-wrap items-center gap-2">

                <span
                    class="inline-flex items-center gap-1.5 rounded-lg border border-slate-200 bg-white px-3 py-1.5 text-[11px] font-medium text-slate-500"
                >
                    <i class="fas fa-search text-slate-400"></i>
                    Live Search
                </span>

                <span
                    class="inline-flex items-center gap-1.5 rounded-lg border border-slate-200 bg-white px-3 py-1.5 text-[11px] font-medium text-slate-500"
                >
                    <i class="fas fa-sort text-slate-400"></i>
                    Click header to sort
                </span>

            </div>

            <div class="text-xs text-slate-400">

                <span>
                    Showing
                    <strong
                        id="footerCount"
                        class="font-semibold text-slate-600"
                    >
                        {{ $services->count() }}
                    </strong>
                    services
                </span>

            </div>

        </div>

    </div>

</div>



<div
    id="toast"
    class="fixed bottom-6 right-6 z-50 flex translate-y-3 items-center gap-3 rounded-xl border border-white/10 bg-slate-900 px-5 py-3 text-white opacity-0 shadow-2xl pointer-events-none"
>

    <i
        id="toastIcon"
        class="fas fa-check-circle text-lg text-emerald-400"
    ></i>

    <span
        id="toastMessage"
        class="text-sm font-medium"
    >
        Action completed
    </span>

</div>


<script>
(function () {

    const searchInput = document.getElementById('searchInput');
    const clearBtn = document.getElementById('clearSearchBtn');

    const tableBody = document.getElementById('tableBody');
    const searchEmptyRow = document.getElementById('searchEmptyRow');

    const resultCount = document.getElementById('resultCount');
    const footerCount = document.getElementById('footerCount');

    const sortableHeaders = document.querySelectorAll('.sortable');

    let currentSortColumn = null;
    let sortDirection = 'asc';



    function filterTable() {

        const searchTerm = searchInput.value.trim().toLowerCase();

        const rows = Array.from(
            tableBody.querySelectorAll('.service-row')
        );

        let visibleCount = 0;

        rows.forEach(row => {

            const searchData =
                row.dataset.search || '';

            const shouldShow =
                searchData.includes(searchTerm);

            row.style.display =
                shouldShow ? '' : 'none';

            if (shouldShow) {
                visibleCount++;
            }

        });


        /* Search empty state */

        if (searchEmptyRow) {

            searchEmptyRow.style.display =
                rows.length > 0 && visibleCount === 0
                    ? ''
                    : 'none';

        }


        /* Counter */

        if (resultCount) {

            resultCount.textContent =
                `${visibleCount} result${visibleCount !== 1 ? 's' : ''}`;

        }

        if (footerCount) {

            footerCount.textContent =
                visibleCount;

        }

    }


    searchInput.addEventListener(
        'input',
        filterTable
    );



    clearBtn.addEventListener(
        'click',
        function () {

            searchInput.value = '';

            filterTable();

            searchInput.focus();

        }
    );



    sortableHeaders.forEach(header => {

        header.addEventListener(
            'click',
            function () {

                const columnIndex =
                    Array.from(header.parentNode.children)
                        .indexOf(header);

                const rows =
                    Array.from(
                        tableBody.querySelectorAll('.service-row')
                    );

                if (
                    currentSortColumn === columnIndex
                ) {

                    sortDirection =
                        sortDirection === 'asc'
                            ? 'desc'
                            : 'asc';

                } else {

                    currentSortColumn =
                        columnIndex;

                    sortDirection = 'asc';

                }


                rows.sort(function (a, b) {

                    const aText =
                        a.children[columnIndex]
                            ?.innerText
                            .trim()
                            .toLowerCase() || '';

                    const bText =
                        b.children[columnIndex]
                            ?.innerText
                            .trim()
                            .toLowerCase() || '';


                    return sortDirection === 'asc'
                        ? aText.localeCompare(bText)
                        : bText.localeCompare(aText);

                });


                rows.forEach(row => {

                    tableBody.appendChild(row);

                });


                /* Update icons */

                sortableHeaders.forEach(h => {

                    const icon =
                        h.querySelector('i');

                    if (icon) {

                        icon.className =
                            'fas fa-sort ml-1 text-[10px] text-slate-300';

                    }

                });


                const currentIcon =
                    header.querySelector('i');

                if (currentIcon) {

                    currentIcon.className =
                        sortDirection === 'asc'
                            ? 'fas fa-sort-up ml-1 text-[10px] text-blue-500'
                            : 'fas fa-sort-down ml-1 text-[10px] text-blue-500';

                }

            }
        );

    });


    /* =========================================================
        TOAST
    ========================================================= */

    const toast =
        document.getElementById('toast');

    const toastMessage =
        document.getElementById('toastMessage');

    const toastIcon =
        document.getElementById('toastIcon');

    let toastTimeout = null;


    function showToast(
        message,
        type = 'success'
    ) {

        const iconMap = {

            success:
                'fa-check-circle text-emerald-400',

            error:
                'fa-exclamation-circle text-rose-400',

            info:
                'fa-info-circle text-blue-400'

        };


        toastIcon.className =
            `fas ${iconMap[type] || iconMap.success} text-lg`;


        toastMessage.textContent =
            message;


        toast.classList.add('show');

        toast.classList.remove(
            'opacity-0',
            'pointer-events-none'
        );


        toast.classList.add(
            'opacity-100'
        );


        clearTimeout(toastTimeout);


        toastTimeout =
            setTimeout(function () {

                toast.classList.remove('show');

                toast.classList.remove(
                    'opacity-100'
                );

                toast.classList.add(
                    'opacity-0',
                    'pointer-events-none'
                );

            }, 2800);

    }


    /* =========================================================
        LARAVEL FLASH MESSAGE
    ========================================================= */

    @if(session('success'))

        showToast(
            @json(session('success')),
            'success'
        );

    @endif


    @if(session('error'))

        showToast(
            @json(session('error')),
            'error'
        );

    @endif


    /* =========================================================
        INITIAL SEARCH
    ========================================================= */

    filterTable();

})();
</script>

@endsection
