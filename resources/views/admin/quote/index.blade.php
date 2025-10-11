@php use Illuminate\Support\Str; @endphp

@extends('layouts.admin')

@section('title', 'Quotes')

@push('css')
    {{-- add any extra css here --}}
@endpush

@section('content')
    <!-- Main Content -->
    <div class="main-content">
        <!-- Header -->
        <x-header :export-url="null" :create-url="route('admin.quotes.create')" export-label="Export Quote"
            create-label="New Quote" />

        <!-- Content -->
        <div class="content">
            <!-- Breadcrumb -->
            <div class="breadcrumb">
                <span class="breadcrumb-item" onclick="goToDashboard()">Dashboard</span>
                <span class="breadcrumb-separator">/</span>
                <span class="breadcrumb-item">Quotes</span>
            </div>

            <div class="content-header">
                <h1 class="content-title">Quotes Management</h1>
                <div class="action-buttons">
                    <a href="#" class="btn secondary">
                        <i>📊</i> Reports
                    </a>
                    <a href="{{ route('admin.quotes.create') }}" class="btn primary">
                        <i>➕</i> Create Quote
                    </a>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="stats-grid">
                <div class="stat-card">
                    <h3>Total Quotes</h3>
                    <div class="value">{{ $quotes->count() }}</div>
                </div>
                <div class="stat-card">
                    <h3>Draft</h3>
                    <div class="value">{{ $quotes->where('status', 'Draft')->count() }}</div>
                </div>
                <div class="stat-card">
                    <h3>Approved</h3>
                    <div class="value">{{ $quotes->where('status', 'Approved')->count() }}</div>
                </div>
                <div class="stat-card">
                    <h3>Total Value</h3>
                    <div class="value">${{ number_format($quotes->sum('total'), 2) }}</div>
                </div>
            </div>

            <!-- Tabs -->
            <div class="tabs" style="margin-bottom:16px;">
                @php $current = request('status'); @endphp
                <a href="{{ route('admin.quotes.index') }}" class="tab {{ $current ? '' : 'active' }}">All Quotes</a>
                <a href="{{ route('admin.quotes.index', ['status' => 'Draft']) }}"
                    class="tab {{ $current === 'Draft' ? 'active' : '' }}">Draft</a>
                <a href="{{ route('admin.quotes.index', ['status' => 'Sent']) }}"
                    class="tab {{ $current === 'Sent' ? 'active' : '' }}">Sent</a>
                <a href="{{ route('admin.quotes.index', ['status' => 'Approved']) }}"
                    class="tab {{ $current === 'Approved' ? 'active' : '' }}">Approved</a>
                <a href="{{ route('admin.quotes.index', ['status' => 'Rejected']) }}"
                    class="tab {{ $current === 'Rejected' ? 'active' : '' }}">Rejected</a>
                <a href="{{ route('admin.quotes.index', ['status' => 'Expired']) }}"
                    class="tab {{ $current === 'Expired' ? 'active' : '' }}">Expired</a>
            </div>

            <!-- Quotes Table -->
            <div class="crm-table">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Customer</th>
                            <th>Quote #</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Created</th>
                            <th>Expires</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="quotes-tbody">
                        @forelse($quotes as $quote)
                            @php
                                $clientName = optional($quote->project->customer)->name ?? ($quote->project->customer->name ?? '—');
                                $projectTitle = optional($quote->project)->name ?? ($quote->project_name ?? '-');
                                $pdfRoute = route('admin.quotes.download', $quote->id);
                            @endphp
                            <tr class="table-row" id="quote-{{ $quote->id }}" data-quote-id="{{ $quote->id }}">
                                <td class="customer-info">
                                    <div class="customer-avatar">{{ Str::upper(Str::substr($clientName, 0, 2)) }}</div>
                                    <div class="customer-details">
                                        <h4>{{ $clientName }}</h4>
                                        <p>{{ $projectTitle }}</p>
                                    </div>
                                </td>
                                <td class="quote-number">{{ $quote->quote_number }}</td>
                                <td class="amount">{{ $quote->total ? '$' . number_format($quote->total, 2) : '$0.00' }}</td>
                                <td><span class="status-tag status-{{ Str::lower($quote->status) }}">{{ $quote->status }}</span>
                                </td>
                                <td class="date">{{ optional($quote->created_at)->format('M d, Y') }}</td>
                                <td class="date">{{ optional($quote->expires_at)->format('M d, Y') }}</td>
                                <td class="actions">
                                    @if($quote->pdf_path)
                                        <button type="button" class="action-btn download" title="Download" onclick="openPdf('{{ $pdfRoute }}')"><i class="fa-solid fa-download"></i></button>
                                    @else
                                        <span class="muted">No PDF</span>
                                    @endif

                                    @if($quote->status === 'Draft')
                                        <button class="action-btn send" title="Send"><i class="fa-solid fa-paper-plane"></i></button>
                                    @endif

                                    @if(in_array($quote->status, ['Sent', 'Draft']))
                                        <button class="action-btn approve" title="Approve"><i class="fa-regular fa-square-check"></i></button>
                                        <button class="action-btn reject" title="Reject"><i class="fa-solid fa-square-xmark"></i></button>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" style="text-align:center">No quotes found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Customer Quotes Modal (kept minimal) -->
    <div class="modal modal-medium" id="customerModal" style="display:none;">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="modalTitle">Customer Quotes</h2>
                <button class="close-btn" onclick="closeModal()">&times;</button>
            </div>

            <div class="customer-info">
                <div class="customer-avatar" id="modalAvatar">JS</div>
                <div class="customer-details">
                    <h4 id="modalCustomerName">John Smith</h4>
                    <p id="modalCustomerProject">Project</p>
                </div>
            </div>

            <div class="customer-quotes" id="modalCustomerQuotes"></div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // CSRF setup once
        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
        });

        function ajaxAction(btn, url, successCallback) {
            var $btn = $(btn);
            if ($btn.data('processing')) return;
            $btn.data('processing', true);

            var original = $btn.html();
            $btn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Processing...');

            $.post(url)
                .done(function (res) {
                    if (res.status === 'success') {
                        if (window.toastr) toastr.success(res.message);
                        if (typeof successCallback === 'function') successCallback(res);
                    } else {
                        if (window.toastr) toastr.error(res.message || 'Error');
                    }
                })
                .fail(function (xhr) {
                    var msg = 'Server error.';
                    if (xhr.responseJSON && xhr.responseJSON.message) msg = xhr.responseJSON.message;
                    if (window.toastr) toastr.error(msg);
                })
                .always(function () {
                    $btn.prop('disabled', false).html(original);
                    $btn.removeData('processing');
                });
        }

        // Send quote
        $(document).on('click', '.send', function (e) {
            e.preventDefault();
            var $btn = $(this);
            var $row = $btn.closest('tr');
            var quoteId = $row.data('quote-id') || $row.attr('id')?.split('-').pop(); // support id="quote-123"
            var url = "{{ url('admin/quotes') }}/" + quoteId + "/send"; // or use route template

            ajaxAction($btn, url, function (res) {
                // update status cell
                $row.find('.status-tag').removeClass().addClass('status-tag status-' + res.status_label.toLowerCase()).text(res.status_label);
            });
        });

        // Approve quote
        $(document).on('click', '.approve-btn', function (e) {
            e.preventDefault();
            var $btn = $(this);
            var $row = $btn.closest('tr');
            var quoteId = $row.data('quote-id') || $row.attr('id')?.split('-').pop();
            var url = "{{ url('admin/quotes') }}/" + quoteId + "/approve";

            ajaxAction($btn, url, function (res) {
                $row.find('.status-tag').removeClass().addClass('status-tag status-' + res.status_label.toLowerCase()).text(res.status_label);
            });
        });

        // Reject quote
        $(document).on('click', '.reject-btn', function (e) {
            e.preventDefault();
            var $btn = $(this);
            var $row = $btn.closest('tr');
            var quoteId = $row.data('quote-id') || $row.attr('id')?.split('-').pop();
            var url = "{{ url('admin/quotes') }}/" + quoteId + "/reject";

            ajaxAction($btn, url, function (res) {
                $row.find('.status-tag').removeClass().addClass('status-tag status-' + res.status_label.toLowerCase()).text(res.status_label);
            });
        });

        function openPdf(url) {
            // open the download route in a new tab; browser will display inline if content-disposition = inline
            window.open(url, '_blank', 'noopener');
        }

        function goToDashboard() {
            window.location.href = '{{ url('/admin/dashboard') }}';
        }

        function showCustomerQuotes(customerName) {
            // optional: you can implement AJAX to fetch quotes for a customer
            document.getElementById('customerModal').style.display = 'block';
            document.getElementById('modalTitle').textContent = customerName + ' - Quotes';
            document.getElementById('modalCustomerName').textContent = customerName;
            document.getElementById('modalAvatar').textContent = customerName.split(' ').map(n => n[0]).join('');
        }

        function closeModal() {
            document.getElementById('customerModal').style.display = 'none';
        }

        // Client-side search (simple filter)
        document.getElementById('quote-search').addEventListener('input', function (e) {
            var q = e.target.value.trim().toLowerCase();
            var rows = document.querySelectorAll('#quotes-tbody tr.table-row');
            rows.forEach(function (row) {
                var txt = row.textContent.toLowerCase();
                row.style.display = txt.indexOf(q) !== -1 ? '' : 'none';
            });
        });
    </script>
@endpush