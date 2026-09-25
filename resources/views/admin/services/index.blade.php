@extends('admin.loyout.master')
@section('content')
    <style>
        * {
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
        }

        .table-wrap::-webkit-scrollbar {
            height: 6px;
            width: 6px;
        }

        .table-wrap::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 8px;
        }

        .table-wrap::-webkit-scrollbar-thumb {
            background: #94a3b8;
            border-radius: 8px;
        }

        .table-wrap::-webkit-scrollbar-thumb:hover {
            background: #64748b;
        }

        #searchInput:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.15);
        }

        th.sortable {
            cursor: pointer;
            user-select: none;
            transition: background 0.15s;
        }

        th.sortable:hover {
            background-color: #e2e8f0;
        }

        tbody tr {
            transition: background 0.1s;
        }

        tbody tr:nth-child(even) {
            background-color: #fafcff;
        }

        tbody tr:hover {
            background-color: #f1f5f9;
        }

        .action-btn {
            transition: all 0.15s;
            border-radius: 6px;
        }

        .action-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 8px -4px rgba(0, 0, 0, 0.1);
        }

        .badge-note {
            background: #dbeafe;
            color: #1e40af;
            padding: 0.1rem 0.6rem;
            border-radius: 9999px;
            font-size: 0.7rem;
            font-weight: 500;
        }

        #toast {
            transition: opacity 0.3s ease, transform 0.3s ease;
            transform: translateY(12px);
        }

        #toast.show {
            opacity: 1;
            transform: translateY(0);
        }
    </style>

    <div class="max-w-7xl mx-auto">
        <!-- card header -->
        <div class="bg-white rounded-2xl shadow-lg border border-slate-200/80 p-5 md:p-7">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-blue-50 rounded-xl flex items-center justify-center text-blue-600">
                        <i class="fas fa-table text-lg"></i>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-slate-800 tracking-tight">Fields Manager</h1>
                        <p class="text-xs text-slate-400 flex items-center gap-2 mt-0.5">
                            <span class="inline-block w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
                            {{ $services->count() }} columns · <span class="font-medium text-slate-600">{{ $services->count() }}</span> entries
                        </p>
                    </div>
                </div>
                <div class="flex flex-wrap items-center gap-3">
                    <div class="relative">
                        <i class="fas fa-search absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-sm"></i>
                        <input type="text" id="searchInput" placeholder="Search fields..."
                            class="pl-9 pr-4 py-2.5 border border-slate-200 rounded-xl text-sm w-full md:w-64 bg-slate-50/80 focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-200/60 transition outline-none" />
                    </div>
                    <button id="clearSearchBtn"
                        class="text-slate-400 hover:text-slate-700 text-sm px-3.5 py-2.5 border border-slate-200 rounded-xl hover:bg-slate-50 transition flex items-center gap-1.5 bg-white/80">
                        <i class="fas fa-times-circle"></i> Clear
                    </button>

                    <a href="{{ route('service.create') }}"
                        class="bg-blue-600 hover:bg-blue-700 text-white text-sm px-4 py-2.5 rounded-xl shadow-sm transition flex items-center gap-2">
                        <i class="fas fa-plus-circle"></i> Add
                    </a>

                    <a href="{{ route('serCat.index') }}"
                        class="bg-blue-600 hover:bg-blue-700 text-white text-sm px-4 py-2.5 rounded-xl shadow-sm transition flex items-center gap-2">
                        <i class="fas fa-list"></i> Service Category
                    </a>
                </div>
            </div>

            <!-- table wrapper -->
            <div class="table-wrap overflow-x-auto rounded-xl border border-slate-200/80 bg-white">
                <table id="fieldsTable" class="min-w-full divide-y divide-slate-200 text-sm">
                    <thead
                        class="bg-slate-50/80 text-slate-700 uppercase text-[0.65rem] tracking-wider border-b border-slate-200">
                        <tr>
                            <th class="px-4 py-3.5 text-left sortable" data-sort="heading">heading <i
                                    class="fas fa-sort ml-1 text-slate-300"></i></th>
                            <th class="px-4 py-3.5 text-left sortable" data-sort="main_img">main_img <i
                                    class="fas fa-sort ml-1 text-slate-300"></i></th>
                            <th class="px-4 py-3.5 text-left sortable" data-sort="samll_pag">samll_pag <i
                                    class="fas fa-sort ml-1 text-slate-300"></i></th>
                            <th class="px-4 py-3.5 text-left sortable" data-sort="first_heading">first_heading <i
                                    class="fas fa-sort ml-1 text-slate-300"></i></th>
                            <th class="px-4 py-3.5 text-left sortable" data-sort="paragraph">paragraph <i
                                    class="fas fa-sort ml-1 text-slate-300"></i></th>
                            <th class="px-4 py-3.5 text-left sortable" data-sort="note">note <i
                                    class="fas fa-sort ml-1 text-slate-300"></i></th>
                            <th class="px-4 py-3.5 text-left sortable" data-sort="sec_heading">sec_heading <i
                                    class="fas fa-sort ml-1 text-slate-300"></i></th>
                            <th class="px-4 py-3.5 text-left sortable" data-sort="sec_imag">sec_imag <i
                                    class="fas fa-sort ml-1 text-slate-300"></i></th>
                            <th class="px-4 py-3.5 text-left sortable" data-sort="sec_paragraph">sec_paragraph <i
                                    class="fas fa-sort ml-1 text-slate-300"></i></th>
                            <th class="px-4 py-3.5 text-left sortable" data-sort="third_heading">third_heading <i
                                    class="fas fa-sort ml-1 text-slate-300"></i></th>
                                    <th class="px-4 py-3.5 text-left sortable" data-sort="third_heading">External Content<i
                                    class="fas fa-sort ml-1 text-slate-300"></i></th>


                            <th class="px-4 py-3.5 text-left sortable" data-sort="serviceCat_id">serviceCategory <i
                                    class="fas fa-sort ml-1 text-slate-300"></i></th>
                            <th class="px-4 py-3.5 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody" class="divide-y divide-slate-100 bg-white">
                        @forelse ($services as $service)
                            <tr class="hover:bg-slate-50/80 transition-colors">
                                <td class="px-4 py-3.5 align-middle font-medium text-slate-800">
                                    {{ $service->heading ?? '' }}
                                </td>
                                <td class="px-4 py-3.5 align-middle">
                                   <img src="{{ asset($service->main_img ?? "") }}" alt="" width="90">
                                </td>
                                <td class="px-4 py-3.5 align-middle">
                                    {{ $service->small_pag ?? '' }}
                                </td>
                                <td class="px-4 py-3.5 align-middle text-slate-800">
                                    {{ $service->first_heading ?? '' }}
                                </td>
                                <td class="px-4 py-3.5 align-middle">
                                    <span class="truncate block max-w-[130px]" title="{{ $service->paragraph ?? '' }}">
                                        {{ $service->paragraph ?? '' }}
                                    </span>
                                </td>
                                <td class="px-4 py-3.5 align-middle">
                                    <span class="badge-note">{{ Str::limit($service->note,30) ?? '' }}</span>
                                </td>
                                <td class="px-4 py-3.5 align-middle">
                                    {{ $service->sec_heading ?? '' }}
                                </td>
                                <td class="px-4 py-3.5 align-middle">
                                   <img src="{{ asset($service->sec_imag ?? "") }}" alt="" width="90">
                                </td>
                                <td class="px-4 py-3.5 align-middle">
                                    <span class="truncate block max-w-[130px]" title="{{ $service->sec_paragraph ?? '' }}">
                                        {{ Str::limit($service->sec_paragraph,30) ?? '' }}
                                    </span>
                                </td>
                                <td class="px-4 py-3.5 align-middle">
                                    {{ $service->third_heading ?? '' }}
                                </td>

                                <td class="px-4 py-3.5 align-middle">
                                    {{ Str::limit($service->content,30) ?? '' }}
                                </td>

                                <td class="px-4 py-3.5 align-middle">
                                    <span class="font-semibold text-blue-600">{{ $service->serviceCat->name ?? '' }}</span>
                                </td>
                                <td class="px-4 py-3.5 text-center">
                                    <div class="flex items-center justify-center gap-1.5">

                                        <a href="{{ route('service.edit', $service->id) }}"
                                           class="action-btn w-8 h-8 rounded-lg bg-amber-50 text-amber-600 hover:bg-amber-100 flex items-center justify-center"
                                           title="Edit">
                                            <i class="fas fa-pen text-xs"></i>
                                        </a>
                                        <form action="{{ route('service.delete', $service->id) }}"
                                              method="POST"
                                              class="inline-block"
                                              onsubmit="return confirm('Are you sure you want to delete this item?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="action-btn w-8 h-8 rounded-lg bg-rose-50 text-rose-500 hover:bg-rose-100 flex items-center justify-center"
                                                    title="Delete">
                                                <i class="fas fa-trash-can text-xs"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="13" class="px-4 py-10 text-center text-slate-400 italic">
                                    No services found
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- footer -->
            <div class="flex flex-wrap items-center justify-between mt-4 text-xs text-slate-400">
                <div class="flex items-center gap-3">
                    <span class="bg-slate-50/80 px-3 py-1.5 rounded-lg border border-slate-200/70 flex items-center gap-1.5">
                        <i class="fas fa-arrows-up-down text-slate-400"></i> click header to sort
                    </span>
                    <span class="bg-slate-50/80 px-3 py-1.5 rounded-lg border border-slate-200/70 flex items-center gap-1.5">
                        <i class="fas fa-magnifying-glass text-slate-400"></i> live search
                    </span>
                </div>
                <div class="text-slate-400 flex items-center gap-2">
                    <i class="far fa-clock"></i>
                    <span id="timestamp" class="font-mono text-[0.6rem]"></span>
                </div>
            </div>
        </div>
    </div>

    <!-- Toast notification -->
    <div id="toast"
        class="fixed bottom-6 right-6 bg-slate-800/90 backdrop-blur-sm text-white px-5 py-3 rounded-xl shadow-2xl flex items-center gap-3 opacity-0 pointer-events-none transition-all duration-300 z-50 border border-white/10">
        <i id="toastIcon" class="fas fa-check-circle text-emerald-400 text-lg"></i>
        <span id="toastMessage" class="text-sm font-medium">Action performed</span>
    </div>

    <script>
        (function() {
            // Simple search functionality
            const searchInput = document.getElementById('searchInput');
            const clearBtn = document.getElementById('clearSearchBtn');
            const tableRows = document.querySelectorAll('#tableBody tr');
            const rowCountDisplay = document.querySelector('.font-medium.text-slate-600');

            // Toast functions
            const toast = document.getElementById('toast');
            const toastMessage = document.getElementById('toastMessage');
            const toastIcon = document.getElementById('toastIcon');
            let toastTimeout = null;

            function showToast(message, type = 'success') {
                const iconMap = {
                    success: 'fa-check-circle text-emerald-400',
                    error: 'fa-exclamation-circle text-rose-400',
                    info: 'fa-info-circle text-blue-400'
                };
                toastIcon.className = `fas ${iconMap[type] || iconMap.success} text-lg`;
                toastMessage.textContent = message;
                toast.classList.remove('opacity-0', 'pointer-events-none');
                toast.classList.add('opacity-100', 'pointer-events-auto');
                clearTimeout(toastTimeout);
                toastTimeout = setTimeout(() => {
                    toast.classList.remove('opacity-100', 'pointer-events-auto');
                    toast.classList.add('opacity-0', 'pointer-events-none');
                }, 2800);
            }

            // Search functionality
            function filterTable() {
                const searchTerm = searchInput.value.trim().toLowerCase();
                let visibleCount = 0;

                tableRows.forEach(row => {
                    // Skip empty row
                    if (row.querySelector('td[colspan]')) {
                        row.style.display = 'none';
                        return;
                    }

                    const textContent = row.textContent.toLowerCase();
                    const shouldShow = textContent.includes(searchTerm);
                    row.style.display = shouldShow ? '' : 'none';
                    if (shouldShow) visibleCount++;
                });

                // Update count
                if (rowCountDisplay) {
                    rowCountDisplay.textContent = visibleCount;
                }

                // Show empty message if no results
                const emptyRow = document.querySelector('#tableBody tr td[colspan]');
                if (emptyRow) {
                    emptyRow.closest('tr').style.display = visibleCount === 0 ? '' : 'none';
                }
            }

            // Search input listener
            searchInput.addEventListener('input', filterTable);

            // Clear search
            clearBtn.addEventListener('click', function() {
                searchInput.value = '';
                filterTable();
                searchInput.focus();
            });

            // Show toast for delete success (from session flash)
            @if(session('success'))
                showToast('{{ session('success') }}', 'success');
            @endif

            @if(session('error'))
                showToast('{{ session('error') }}', 'error');
            @endif

            // Timestamp
            document.getElementById('timestamp').textContent = new Date().toLocaleTimeString('en-US', {
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit'
            });

        })();
    </script>
@endsection
