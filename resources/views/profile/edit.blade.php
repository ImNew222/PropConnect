@extends('layouts.dashboard')

@section('title', 'Settings')

@section('content')
<div class="settings-page">
    <div class="page-header">
        <h1>Settings</h1>
        <p class="subtitle">Manage your account and preferences</p>
    </div>
    
    <!-- Profile Information -->
    <section class="settings-section">
        <div class="section-header-simple">
            <h2>Profile Information</h2>
            <p>Update your account's profile information and email address.</p>
        </div>
        
        <form method="post" action="{{ route('profile.update') }}" class="settings-form">
            @csrf
            @method('patch')
            
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
                @error('name')
                    <span class="form-error">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required autocomplete="username">
                @error('email')
                    <span class="form-error">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="form-actions">
                <button type="submit" class="btn-primary">Save Changes</button>
                @if (session('status') === 'profile-updated')
                    <span class="success-msg">Saved!</span>
                @endif
            </div>
        </form>
    </section>
    
    <!-- Update Password -->
    <section class="settings-section">
        <div class="section-header-simple">
            <h2>Update Password</h2>
            <p>Ensure your account is using a long, random password to stay secure.</p>
        </div>
        
        <form method="post" action="{{ route('password.update') }}" class="settings-form">
            @csrf
            @method('put')
            
            <div class="form-group">
                <label for="current_password">Current Password</label>
                <input type="password" id="current_password" name="current_password" autocomplete="current-password">
                @error('current_password', 'updatePassword')
                    <span class="form-error">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="password">New Password</label>
                <input type="password" id="password" name="password" autocomplete="new-password">
                @error('password', 'updatePassword')
                    <span class="form-error">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" autocomplete="new-password">
                @error('password_confirmation', 'updatePassword')
                    <span class="form-error">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="form-actions">
                <button type="submit" class="btn-primary">Update Password</button>
                @if (session('status') === 'password-updated')
                    <span class="success-msg">Password updated!</span>
                @endif
            </div>
        </form>
    </section>
    
    <!-- Delete Account -->
    <section class="settings-section danger-zone">
        <div class="section-header-simple">
            <h2>Delete Account</h2>
            <p>Once your account is deleted, all of its resources and data will be permanently deleted.</p>
        </div>
        
        <form method="post" action="{{ route('profile.destroy') }}" class="settings-form" onsubmit="return confirm('Are you sure you want to delete your account? This action cannot be undone.');">
            @csrf
            @method('delete')
            
            <div class="form-group">
                <label for="delete_password">Confirm Password</label>
                <input type="password" id="delete_password" name="password" placeholder="Enter your password to confirm">
                @error('password', 'userDeletion')
                    <span class="form-error">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="form-actions">
                <button type="submit" class="btn-danger">Delete Account</button>
            </div>
        </form>
    </section>
</div>

<style>
.settings-page {
    max-width: 640px;
}

.page-header {
    margin-bottom: 2rem;
}

.page-header h1 {
    font-size: 32px;
    font-weight: 700;
    color: #1a1a1a;
    margin: 0 0 6px;
}

.page-header .subtitle {
    font-size: 16px;
    color: #666;
    margin: 0;
}

.settings-section {
    background: #fff;
    border: 1px solid #e5e5e5;
    border-radius: 12px;
    padding: 28px;
    margin-bottom: 24px;
}

.section-header-simple {
    margin-bottom: 24px;
    padding-bottom: 16px;
    border-bottom: 1px solid #f0f0f0;
}

.section-header-simple h2 {
    font-size: 20px;
    font-weight: 600;
    color: #1a1a1a;
    margin: 0 0 6px;
}

.section-header-simple p {
    font-size: 15px;
    color: #666;
    margin: 0;
}

.settings-form {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.form-group {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.form-group label {
    font-size: 15px;
    font-weight: 600;
    color: #1a1a1a;
}

.form-group input {
    padding: 14px 16px;
    font-size: 16px;
    border: 1px solid #e5e5e5;
    border-radius: 10px;
    background: #fff;
    color: #1a1a1a;
    transition: border-color 0.2s;
}

.form-group input:focus {
    outline: none;
    border-color: #1a1a1a;
}

.form-group input::placeholder {
    color: #999;
}

.form-error {
    font-size: 14px;
    color: #dc2626;
}

.form-actions {
    display: flex;
    align-items: center;
    gap: 16px;
    padding-top: 8px;
}

.btn-primary {
    padding: 14px 28px;
    font-size: 16px;
    font-weight: 600;
    background: #1a1a1a;
    color: #fff;
    border: none;
    border-radius: 10px;
    cursor: pointer;
    transition: background 0.2s;
}

.btn-primary:hover {
    background: #333;
}

.btn-danger {
    padding: 14px 28px;
    font-size: 16px;
    font-weight: 600;
    background: #dc2626;
    color: #fff;
    border: none;
    border-radius: 10px;
    cursor: pointer;
    transition: background 0.2s;
}

.btn-danger:hover {
    background: #b91c1c;
}

.success-msg {
    font-size: 15px;
    color: #16a34a;
    font-weight: 500;
}

.danger-zone {
    border-color: #fecaca;
}

.danger-zone .section-header-simple {
    border-bottom-color: #fecaca;
}

.danger-zone h2 {
    color: #dc2626;
}

@media (max-width: 768px) {
    .settings-section {
        padding: 20px;
    }
    
    .page-header h1 {
        font-size: 26px;
    }
    
    .section-header-simple h2 {
        font-size: 18px;
    }
}
</style>
@endsection
