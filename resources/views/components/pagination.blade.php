{{--
    Pagination Component
    Usage: @include('components.pagination', ['currentPage' => 1, 'totalPages' => 3])
--}}

@php
    $currentPage = $currentPage ?? 1;
    $totalPages = $totalPages ?? 3;
@endphp

<div class="pagination">
    <button class="pagination-btn" {{ $currentPage <= 1 ? 'disabled' : '' }}>Previous</button>
    <span class="pagination-info">Page {{ $currentPage }} of {{ $totalPages }}</span>
    <button class="pagination-btn" {{ $currentPage >= $totalPages ? 'disabled' : '' }}>Next</button>
</div>
