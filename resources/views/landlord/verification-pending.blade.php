@extends('layouts.dashboard')

@section('title', 'Verification Pending')

@section('content')
<div class="verification-container">
    <div class="verification-card">
        <!-- Status Icon -->
        <div class="status-icon {{ $document && $document->status === 'rejected' ? 'rejected' : 'pending' }}">
            @if($document && $document->status === 'rejected')
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="10"/>
                    <line x1="15" y1="9" x2="9" y2="15"/>
                    <line x1="9" y1="9" x2="15" y2="15"/>
                </svg>
            @else
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="10"/>
                    <polyline points="12 6 12 12 16 14"/>
                </svg>
            @endif
        </div>

        <!-- Title & Message -->
        @if($document && $document->status === 'rejected')
            <h1>Verification Rejected</h1>
            <p class="message">
                Unfortunately, your document was not approved. Please review the reason below and upload a new document.
            </p>
            <div class="rejection-reason">
                <strong>Reason:</strong> {{ $document->rejection_reason ?? 'The document provided was not acceptable.' }}
            </div>
        @else
            <h1>Verification In Progress</h1>
            <p class="message">
                Thank you for registering as a landlord! We're reviewing your submitted documents. 
                This usually takes 24-48 hours.
            </p>
        @endif

        <!-- Document Status -->
        @if($document)
        <div class="document-status">
            <div class="document-item">
                <div class="doc-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                        <polyline points="14 2 14 8 20 8"/>
                    </svg>
                </div>
                <div class="doc-info">
                    <span class="doc-type">{{ ucfirst(str_replace('_', ' ', $document->document_type)) }}</span>
                    <span class="doc-date">Uploaded {{ $document->created_at->diffForHumans() }}</span>
                </div>
                <span class="status-badge {{ $document->status }}">{{ ucfirst($document->status) }}</span>
            </div>
        </div>
        @endif

        <!-- Upload New Document (if rejected or need additional) -->
        @if($document && $document->status === 'rejected')
        <form action="{{ route('landlord.verification.upload') }}" method="POST" enctype="multipart/form-data" class="upload-form">
            @csrf
            <input type="hidden" name="document_type" value="id_proof">
            
            <label class="upload-area">
                <input type="file" name="document" accept=".jpg,.jpeg,.png,.pdf" required>
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                    <polyline points="17 8 12 3 7 8"/>
                    <line x1="12" y1="3" x2="12" y2="15"/>
                </svg>
                <span>Click to upload new document</span>
                <small>JPEG, PNG, PDF up to 10MB</small>
            </label>

            <button type="submit" class="btn-primary">
                Submit New Document
            </button>
        </form>
        @endif

        <!-- What happens next -->
        <div class="next-steps">
            <h2>What happens next?</h2>
            <ul>
                <li>
                    <span class="step-num">1</span>
                    <span>Our team reviews your documents</span>
                </li>
                <li>
                    <span class="step-num">2</span>
                    <span>You'll receive an email once verified</span>
                </li>
                <li>
                    <span class="step-num">3</span>
                    <span>Start adding your properties!</span>
                </li>
            </ul>
        </div>

        <!-- Actions -->
        <div class="actions">
            <a href="{{ route('dashboard') }}" class="btn-secondary">Go to Dashboard</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn-text">Log Out</button>
            </form>
        </div>
    </div>
</div>

@if(session('success'))
<script>
    alert('{{ session('success') }}');
</script>
@endif

<style>
.verification-container {
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 80vh;
    padding: 2rem;
}

.verification-card {
    background: var(--card-bg, #1a1a2e);
    border-radius: 16px;
    border: 1px solid var(--border-color, rgba(255,255,255,0.1));
    padding: 3rem;
    max-width: 500px;
    width: 100%;
    text-align: center;
}

.status-icon {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1.5rem;
}

.status-icon.pending {
    background: rgba(245, 158, 11, 0.15);
}

.status-icon.pending svg {
    width: 40px;
    height: 40px;
    color: #f59e0b;
}

.status-icon.rejected {
    background: rgba(239, 68, 68, 0.15);
}

.status-icon.rejected svg {
    width: 40px;
    height: 40px;
    color: #ef4444;
}

h1 {
    font-size: 1.5rem;
    font-weight: 600;
    color: var(--text-primary);
    margin: 0 0 1rem;
}

.message {
    color: var(--text-secondary);
    line-height: 1.6;
    margin: 0 0 1.5rem;
}

.rejection-reason {
    background: rgba(239, 68, 68, 0.1);
    border: 1px solid rgba(239, 68, 68, 0.3);
    color: #fca5a5;
    padding: 1rem;
    border-radius: 8px;
    margin-bottom: 1.5rem;
    text-align: left;
    font-size: 0.875rem;
}

.document-status {
    background: var(--bg-secondary, #0f0f1a);
    border-radius: 10px;
    padding: 1rem;
    margin-bottom: 1.5rem;
}

.document-item {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.doc-icon {
    width: 40px;
    height: 40px;
    background: var(--bg-tertiary, #1a1a2e);
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.doc-icon svg {
    width: 20px;
    height: 20px;
    color: var(--text-secondary);
}

.doc-info {
    flex: 1;
    text-align: left;
}

.doc-type {
    display: block;
    font-weight: 500;
    color: var(--text-primary);
    font-size: 0.9375rem;
}

.doc-date {
    font-size: 0.75rem;
    color: var(--text-muted);
}

.status-badge {
    padding: 0.35rem 0.75rem;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
}

.status-badge.pending {
    background: rgba(245, 158, 11, 0.15);
    color: #f59e0b;
}

.status-badge.approved {
    background: rgba(16, 185, 129, 0.15);
    color: #10b981;
}

.status-badge.rejected {
    background: rgba(239, 68, 68, 0.15);
    color: #ef4444;
}

.upload-form {
    margin-bottom: 1.5rem;
}

.upload-area {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 2rem;
    border: 2px dashed var(--border-color, rgba(255,255,255,0.2));
    border-radius: 10px;
    cursor: pointer;
    transition: all 0.2s;
    margin-bottom: 1rem;
}

.upload-area:hover {
    border-color: #667eea;
    background: rgba(102, 126, 234, 0.05);
}

.upload-area input {
    display: none;
}

.upload-area svg {
    width: 32px;
    height: 32px;
    color: var(--text-muted);
    margin-bottom: 0.5rem;
}

.upload-area span {
    color: var(--text-secondary);
    font-size: 0.9375rem;
}

.upload-area small {
    color: var(--text-muted);
    font-size: 0.75rem;
}

.next-steps {
    text-align: left;
    margin: 2rem 0;
    padding: 1.5rem;
    background: var(--bg-secondary, #0f0f1a);
    border-radius: 10px;
}

.next-steps h2 {
    font-size: 1rem;
    font-weight: 600;
    color: var(--text-primary);
    margin: 0 0 1rem;
}

.next-steps ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.next-steps li {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 0.5rem 0;
    color: var(--text-secondary);
    font-size: 0.9375rem;
}

.step-num {
    width: 24px;
    height: 24px;
    border-radius: 50%;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.75rem;
    font-weight: 600;
}

.actions {
    display: flex;
    justify-content: center;
    gap: 1rem;
    margin-top: 1.5rem;
    flex-wrap: wrap;
}

.btn-primary {
    width: 100%;
    padding: 0.875rem;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border: none;
    border-radius: 8px;
    color: white;
    font-size: 0.9375rem;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.2s;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
}

.btn-secondary {
    padding: 0.75rem 1.5rem;
    background: transparent;
    border: 1px solid var(--border-color, rgba(255,255,255,0.2));
    border-radius: 8px;
    color: var(--text-secondary);
    font-size: 0.9375rem;
    text-decoration: none;
    transition: all 0.2s;
}

.btn-secondary:hover {
    background: var(--bg-secondary);
    color: var(--text-primary);
}

.btn-text {
    background: none;
    border: none;
    color: var(--text-muted);
    font-size: 0.875rem;
    cursor: pointer;
    padding: 0.75rem;
}

.btn-text:hover {
    color: var(--text-secondary);
}

@media (max-width: 640px) {
    .verification-card {
        padding: 2rem 1.5rem;
    }
}
</style>
@endsection
