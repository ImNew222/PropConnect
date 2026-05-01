<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" class="auth-form">
        @csrf

        <!-- Name -->
        <div class="input-group">
            <label for="name">Full Name</label>
            <div class="input-wrapper">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                    <circle cx="12" cy="7" r="4"/>
                </svg>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" placeholder="Enter your full name">
            </div>
            <x-input-error :messages="$errors->get('name')" class="input-error" />
        </div>

        <!-- Email Address -->
        <div class="input-group">
            <label for="email">Email</label>
            <div class="input-wrapper">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                    <polyline points="22,6 12,13 2,6"/>
                </svg>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" placeholder="Enter your email">
            </div>
            <x-input-error :messages="$errors->get('email')" class="input-error" />
        </div>

        <!-- Phone -->
        <div class="input-group">
            <label for="phone">Phone Number (optional)</label>
            <div class="input-wrapper">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
                </svg>
                <input id="phone" type="tel" name="phone" value="{{ old('phone') }}" placeholder="+63 9XX XXX XXXX">
            </div>
            <x-input-error :messages="$errors->get('phone')" class="input-error" />
        </div>

        <!-- Password -->
        <div class="input-group">
            <label for="password">Password</label>
            <div class="input-wrapper">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                    <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                </svg>
                <input id="password" type="password" name="password" required autocomplete="new-password" placeholder="••••••••">
            </div>
            <x-input-error :messages="$errors->get('password')" class="input-error" />
        </div>

        <!-- Confirm Password -->
        <div class="input-group">
            <label for="password_confirmation">Confirm Password</label>
            <div class="input-wrapper">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                    <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                </svg>
                <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="••••••••">
            </div>
            <x-input-error :messages="$errors->get('password_confirmation')" class="input-error" />
        </div>

        <!-- Role Selection -->
        <div class="input-group">
            <label>I am a...</label>
            <div style="display: flex; gap: 20px; margin-top: 8px;">
                <label style="display: flex; align-items: center; gap: 8px; cursor: pointer; color: #374151;">
                    <input type="radio" name="role" value="renter" {{ old('role', 'renter') == 'renter' ? 'checked' : '' }} 
                           style="width: 18px; height: 18px; accent-color: #667eea;"
                           onchange="toggleLandlordFields()">
                    <span>Renter</span>
                </label>
                <label style="display: flex; align-items: center; gap: 8px; cursor: pointer; color: #374151;">
                    <input type="radio" name="role" value="landlord" {{ old('role') == 'landlord' ? 'checked' : '' }}
                           style="width: 18px; height: 18px; accent-color: #667eea;"
                           onchange="toggleLandlordFields()">
                    <span>Landlord</span>
                </label>
            </div>
            <x-input-error :messages="$errors->get('role')" class="input-error" />
        </div>

        <!-- Landlord Verification -->
        <div id="landlord-fields" class="{{ old('role') == 'landlord' ? '' : 'hidden' }}" style="margin-top: 16px; padding: 16px; background: #f3f4f6; border-radius: 12px; border: 1px solid #e5e7eb;">
            <div style="display: flex; gap: 12px; margin-bottom: 12px;">
                <svg style="width: 20px; height: 20px; color: #f59e0b; flex-shrink: 0;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <div>
                    <p style="font-size: 14px; color: #374151; font-weight: 500;">Verification Required</p>
                    <p style="font-size: 12px; color: #6b7280;">Upload a valid ID for verification (24-48 hours review).</p>
                </div>
            </div>
            
            <label style="display: flex; flex-direction: column; align-items: center; justify-content: center; width: 100%; height: 100px; border: 2px dashed #d1d5db; border-radius: 12px; cursor: pointer; background: white; transition: all 0.3s;">
                <svg style="width: 32px; height: 32px; margin-bottom: 8px; color: #9ca3af;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                <p style="font-size: 14px; color: #6b7280;">Upload ID (JPEG, PNG, PDF)</p>
                <input id="id_document" name="id_document" type="file" style="display: none;" accept=".jpg,.jpeg,.png,.pdf" onchange="showFileName(this)" />
            </label>
            <p id="file-name" class="hidden" style="margin-top: 8px; font-size: 14px; color: #10b981;"></p>
            <x-input-error :messages="$errors->get('id_document')" class="input-error" />
        </div>

        <!-- Register Button -->
        <button type="submit" class="auth-btn" style="margin-top: 20px;">
            Create Account
        </button>

        <!-- Footer -->
        <div class="auth-footer">
            Already have an account? <a href="{{ route('login') }}">Sign in</a>
        </div>
    </form>

    <script>
        function toggleLandlordFields() {
            const landlordFields = document.getElementById('landlord-fields');
            const landlordRadio = document.querySelector('input[name="role"][value="landlord"]');
            
            if (landlordRadio.checked) {
                landlordFields.classList.remove('hidden');
            } else {
                landlordFields.classList.add('hidden');
            }
        }

        function showFileName(input) {
            const fileNameEl = document.getElementById('file-name');
            if (input.files && input.files[0]) {
                fileNameEl.textContent = '✓ ' + input.files[0].name;
                fileNameEl.classList.remove('hidden');
            }
        }

        document.addEventListener('DOMContentLoaded', toggleLandlordFields);
    </script>
</x-guest-layout>
