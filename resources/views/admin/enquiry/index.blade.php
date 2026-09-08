@extends('admin.loyout.master')
@section('content')

  <div class="max-w-7xl mx-auto bg-white rounded-xl shadow-md overflow-hidden p-6 md:p-8">

    <!-- header / title -->
    <div class="flex flex-wrap items-center justify-between gap-4 mb-6">
      <h2 class="text-2xl font-semibold text-gray-800 flex items-center gap-2">
        <i class="fas fa-inbox text-indigo-500"></i> Enquiry List
      </h2>
      <!-- actions -->
      <div class="flex items-center gap-3 text-sm text-gray-500">
        <span class="bg-indigo-50 px-3 py-1 rounded-full border border-indigo-100 text-indigo-700">
          <i class="far fa-file-alt mr-1"></i> {{ $data->total() ?? 0 }} entries
        </span>
       
      </div>
    </div>

    <!-- table wrapper -->
    <div class="overflow-x-auto rounded-lg border border-gray-200 shadow-sm">
      <table class="min-w-full divide-y divide-gray-200 text-sm">
        <!-- thead -->
        <thead class="bg-gray-50/80 text-gray-700 uppercase tracking-wider text-xs">
          <tr>
            
            <th scope="col" class="px-4 py-3 text-left font-medium">#ID</th>
            <th scope="col" class="px-4 py-3 text-left font-medium">First name</th>
            <th scope="col" class="px-4 py-3 text-left font-medium">Last name</th>
            <th scope="col" class="px-4 py-3 text-left font-medium">Phone</th>
            <th scope="col" class="px-4 py-3 text-left font-medium">Email</th>
            <th scope="col" class="px-4 py-3 text-left font-medium">Services</th>
            <th scope="col" class="px-4 py-3 text-left font-medium">Enquiry</th>
            <th scope="col" class="px-4 py-3 text-left font-medium">Created</th>
            <th scope="col" class="px-4 py-3 text-left font-medium">Updated</th>
          </tr>
        </thead>
        <!-- tbody -->
        <tbody class="bg-white divide-y divide-gray-200 text-gray-700">
          @forelse($data as $contact)
          <tr class="hover:bg-indigo-50/30 transition-colors">
           
            <td class="px-4 py-3 whitespace-nowrap font-medium text-indigo-700">{{ $contact->id }}</td>
            <td class="px-4 py-3 whitespace-nowrap">{{ $contact->firstname ?? 'N/A' }}</td>
            <td class="px-4 py-3 whitespace-nowrap">{{ $contact->lastname ?? 'N/A' }}</td>
            <td class="px-4 py-3 whitespace-nowrap">{{ $contact->phone ?? 'N/A' }}</td>
            <td class="px-4 py-3 whitespace-nowrap">{{ $contact->email ?? 'N/A' }}</td>
            <td class="px-4 py-3 whitespace-nowrap">{{ $contact->select_services ?? 'N/A' }}</td>
            <td class="px-4 py-3 max-w-xs truncate">{{ $contact->enquiry ?? 'N/A' }}</td>
            <td class="px-4 py-3 whitespace-nowrap text-gray-500 text-xs">
              {{ $contact->created_at ? $contact->created_at->format('Y-m-d H:i') : 'N/A' }}
            </td>
            <td class="px-4 py-3 whitespace-nowrap text-gray-500 text-xs">
              {{ $contact->updated_at ? $contact->updated_at->format('Y-m-d H:i') : 'N/A' }}
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="10" class="px-4 py-8 text-center text-gray-500">
              <i class="fas fa-inbox text-3xl block mb-2 text-gray-300"></i>
              No enquiry records found
            </td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <!-- footer: selected info & pagination -->
    <div class="flex flex-wrap items-center justify-between gap-4 mt-4 text-sm text-gray-600">
      <div class="flex items-center gap-2 bg-gray-50 px-3 py-2 rounded-lg border border-gray-200">
        <i class="far fa-check-circle text-indigo-500"></i>
        <span id="selectedCount" class="font-medium">0</span>
        <span class="text-gray-400">selected</span>
        <button class="ml-2 text-indigo-600 hover:text-indigo-800 font-medium text-xs bg-indigo-50 px-3 py-1 rounded-full border border-indigo-100 transition">Apply action</button>
      </div>
      
      <!-- Laravel pagination links -->
      <div class="flex items-center gap-3">
        @if($data->hasPages())
          <div class="flex items-center gap-1">
            {{ $data->links('pagination::tailwind') }}
          </div>
        @else
          <span class="text-xs text-gray-400">Showing 1–{{ $data->count() }} of {{ $data->total() }}</span>
        @endif
      </div>
    </div>
  </div>

  <!-- JavaScript for "check all" functionality -->
  <script>
    (function() {
      const checkAll = document.getElementById('checkAll');
      const rowCheckboxes = document.querySelectorAll('.rowCheckbox');
      const selectedSpan = document.getElementById('selectedCount');

      function updateSelectedCount() {
        const checked = document.querySelectorAll('.rowCheckbox:checked').length;
        if (selectedSpan) selectedSpan.textContent = checked;
        if (checkAll) {
          const total = rowCheckboxes.length;
          const checkedCount = document.querySelectorAll('.rowCheckbox:checked').length;
          checkAll.checked = (total > 0 && checkedCount === total);
        }
      }

      if (checkAll) {
        checkAll.addEventListener('change', function(e) {
          const isChecked = e.target.checked;
          rowCheckboxes.forEach(cb => cb.checked = isChecked);
          updateSelectedCount();
        });
      }

      rowCheckboxes.forEach(cb => {
        cb.addEventListener('change', function() {
          updateSelectedCount();
        });
      });

      updateSelectedCount();
    })();
  </script>

@endsection