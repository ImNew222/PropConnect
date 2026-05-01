<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/jpeg" href="{{ asset('logo/logoo.jpeg') }}">
    <title>PropConnect</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Figtree', sans-serif;
            min-height: 100vh;
            background: #f8f9fa;
        }
        
        .auth-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        
        .auth-card {
            display: flex;
            max-width: 900px;
            width: 100%;
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }
        
        /* Left Panel - Form */
        .auth-form-panel {
            flex: 1;
            padding: 50px 40px;
            display: flex;
            flex-direction: column;
        }
        
        .auth-logo {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 40px;
        }
        
        .auth-logo img {
            width: 40px;
            height: 40px;
            border-radius: 8px;
        }
        
        .auth-logo span {
            font-size: 20px;
            font-weight: 700;
        }
        
        .auth-logo .prop { color: #ef4444; }
        .auth-logo .connect { color: #3b82f6; }
        
        .avatar-circle {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: #2d3748;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 30px;
        }
        
        .avatar-circle svg {
            width: 40px;
            height: 40px;
            color: white;
        }
        
        .auth-form {
            flex: 1;
        }
        
        .input-group {
            margin-bottom: 20px;
        }
        
        .input-group label {
            display: block;
            font-size: 14px;
            font-weight: 500;
            color: #374151;
            margin-bottom: 8px;
        }
        
        .input-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }
        
        .input-wrapper svg {
            position: absolute;
            left: 16px;
            width: 20px;
            height: 20px;
            color: #9ca3af;
        }
        
        .input-wrapper input {
            width: 100%;
            padding: 14px 16px 14px 48px;
            border: 2px solid #e5e7eb;
            border-radius: 30px;
            font-size: 15px;
            transition: all 0.3s ease;
            background: white;
            color: #1f2937;
        }
        
        .input-wrapper input:focus {
            outline: none;
            border-color: #2d3748;
            box-shadow: 0 0 0 3px rgba(45, 55, 72, 0.1);
        }
        
        .input-wrapper input::placeholder {
            color: #9ca3af;
        }
        
        .auth-btn {
            width: 100%;
            padding: 14px 24px;
            background: #2d3748;
            color: white;
            border: none;
            border-radius: 30px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-top: 10px;
        }
        
        .auth-btn:hover {
            transform: translateY(-2px);
            background: #1a202c;
            box-shadow: 0 10px 20px rgba(45, 55, 72, 0.3);
        }
        
        .auth-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
            font-size: 14px;
        }
        
        .remember-me {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #6b7280;
        }
        
        .remember-me input[type="checkbox"] {
            width: 16px;
            height: 16px;
            accent-color: #2d3748;
        }
        
        .forgot-link {
            color: #2d3748;
            text-decoration: none;
            font-weight: 500;
        }
        
        .forgot-link:hover {
            text-decoration: underline;
        }
        
        .auth-footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e5e7eb;
            color: #6b7280;
            font-size: 14px;
        }
        
        .auth-footer a {
            color: #2d3748;
            font-weight: 600;
            text-decoration: none;
        }
        
        .auth-footer a:hover {
            text-decoration: underline;
        }
        
        /* Hidden on desktop, shown on mobile */
        .mobile-auth-link {
            display: none;
        }
        
        /* Right Panel - Welcome */
        .auth-welcome-panel {
            flex: 1;
            background: #2d3748;
            padding: 50px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }
        
        .auth-welcome-panel::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 100%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 60%);
        }
        
        .welcome-content {
            position: relative;
            z-index: 1;
        }
        
        .welcome-content h1 {
            font-size: 48px;
            font-weight: 700;
            color: white;
            margin-bottom: 20px;
        }
        
        .welcome-content p {
            font-size: 16px;
            color: rgba(255, 255, 255, 0.8);
            line-height: 1.6;
            margin-bottom: 30px;
        }
        
        .welcome-link {
            color: white;
            font-size: 14px;
        }
        
        .welcome-link a {
            color: white;
            font-weight: 600;
            text-decoration: underline;
        }
        
        /* Wave Animation */
        .waves-container {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 150px;
            overflow: hidden;
        }
        
        .wave {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 200%;
            height: 100%;
            background-repeat: repeat-x;
            transform-origin: center bottom;
        }
        
        .wave1 {
            background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1200 120' preserveAspectRatio='none'%3E%3Cpath d='M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z' fill='rgba(255,255,255,0.15)'/%3E%3C/svg%3E") repeat-x;
            background-size: 1200px 100%;
            animation: wave 8s linear infinite;
            opacity: 0.8;
        }
        
        .wave2 {
            background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1200 120' preserveAspectRatio='none'%3E%3Cpath d='M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z' fill='rgba(255,255,255,0.1)'/%3E%3C/svg%3E") repeat-x;
            background-size: 1200px 100%;
            animation: wave 12s linear infinite reverse;
            opacity: 0.6;
        }
        
        .wave3 {
            background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1200 120' preserveAspectRatio='none'%3E%3Cpath d='M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,googletag137.08-85.68,248.8-66.78V0Z' fill='rgba(255,255,255,0.05)'/%3E%3C/svg%3E") repeat-x;
            background-size: 1200px 100%;
            animation: wave 15s linear infinite;
            opacity: 0.4;
        }
        
        @keyframes wave {
            0% { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }
        
        /* Mobile Responsive */
        @media (max-width: 768px) {
            .auth-card {
                flex-direction: column;
                max-width: 100%;
                border-radius: 0;
                min-height: 100vh;
            }
            
            .auth-welcome-panel {
                display: none;
            }
            
            .auth-form-panel {
                padding: 40px 24px;
                min-height: 100vh;
                justify-content: center;
            }
            
            .avatar-circle {
                width: 70px;
                height: 70px;
                margin-bottom: 24px;
            }
            
            .avatar-circle svg {
                width: 35px;
                height: 35px;
            }
            
            .welcome-content h1 {
                font-size: 32px;
            }
            
            .mobile-auth-link {
                display: block;
                text-align: center;
                margin-top: 20px;
                padding-top: 20px;
                border-top: 1px solid #e5e7eb;
                color: #6b7280;
                font-size: 14px;
            }
            
            .mobile-auth-link a {
                color: #2d3748;
                font-weight: 600;
                text-decoration: none;
            }
        }
        
        /* Error messages */
        .input-error {
            color: #ef4444;
            font-size: 13px;
            margin-top: 6px;
        }
    </style>
</head>
<body>
    <div class="auth-container">
        <div class="auth-card">
            <!-- Left Panel - Form -->
            <div class="auth-form-panel">
                <div class="auth-logo">
                    <img src="{{ asset('logo/logoo.jpeg') }}" alt="PropConnect">
                    <span><span class="prop">Prop</span><span class="connect">Connect</span></span>
                </div>
                
                <div class="avatar-circle">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                        <circle cx="12" cy="7" r="4"/>
                    </svg>
                </div>
                
                {{ $slot }}
                
                <!-- Mobile-only auth link (hidden on desktop) -->
                <div class="mobile-auth-link">
                    @if(request()->is('login'))
                        Don't have an account? <a href="/register">Sign up</a>
                    @else
                        Already have an account? <a href="/login">Sign in</a>
                    @endif
                </div>
            </div>
            
            <!-- Right Panel - Welcome -->
            <div class="auth-welcome-panel">
                <div class="welcome-content">
                    <h1>Welcome.</h1>
                    <p>Find your perfect home with PropConnect. Browse thousands of rental properties and connect directly with landlords.</p>
                    <div class="welcome-link">
                        @if(request()->is('login'))
                            New here? <a href="/register">Create an account</a>
                        @else
                            Already have an account? <a href="/login">Sign in</a>
                        @endif
                    </div>
                </div>
                
                <!-- Animated Waves -->
                <div class="waves-container">
                    <div class="wave wave1"></div>
                    <div class="wave wave2"></div>
                    <div class="wave wave3"></div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
