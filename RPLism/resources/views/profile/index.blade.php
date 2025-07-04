<head>
    <title>Profile - MIINACCI</title>
    <style>
        .profile-card {
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }
        .form-input {
            @apply w-full px-10 py-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-red-800 focus:border-transparent transition-all text-sm;
            height: 44px; /* Fixed height for consistent alignment */
            line-height: 1.2; /* Better line height for text spacing */
        }
        .form-input:disabled {
            @apply bg-gray-100 cursor-not-allowed;
        }
        .form-label {
            @apply block text-sm font-medium text-gray-700 mb-2;
            min-height: 20px; /* Consistent label height */
        }
        .avatar-circle {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background-color: #9CA3AF;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
        .save-btn {
            background-color: #4B5563;
            color: white;
            padding: 8px 24px;
            border: none;
            border-radius: 4px;
            font-size: 14px;
            cursor: pointer;
            transition: background-color 0.2s;
        }
        .save-btn:hover {
            background-color: #374151;
        }
    </style>
</head>

<x-layout>
    <div class="container mx-auto px-4 lg:px-20 py-8">
        <div class="max-w-2xl mx-auto">
            <div class="bg-white rounded-lg profile-card p-8">
                <!-- Header -->
                <div class="text-left mb-6">
                    <h1 class="text-lg font-semibold text-gray-800 mb-1">ACCOUNT SETTING</h1>
                    
                    <!-- Success Message -->
                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif
                    
                    <!-- Error Messages -->
                    @if($errors->any())
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                            <ul class="list-disc list-inside">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>

                <form id="profileForm" method="POST" action="{{ url('/profile/update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="flex gap-8">
                        <!-- Left side - Avatar -->
                        <div class="flex-shrink-0">
                            {{-- <div class="avatar-circle" id="avatarPreview" style="background-image: url('https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=80&h=80&fit=crop&crop=face');"></div> --}}
                    <div class="avatar-circle" id="avatarPreview"
                        style="background-image: url('{{ $user->pfp_image ? asset('storage/' . $user->pfp_image) : 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=80&h=80&fit=crop&crop=face' }}');">
                    </div>
                            <input type="file" id="imageUpload" name="profile_picture" accept=".png, .jpg, .jpeg" style="display: none;" />
                            <div class="text-center mt-3">
                                <p class="text-sm text-gray-600 font-medium">Role</p>
                                <p class="text-xs text-gray-500">{{ $user->role ?? 'Customer' }}</p>
                            </div>
                        </div>

                        <!-- Right side - Form -->
                        <div class="flex-1">
                            <div class="space-y-4">
                                <!-- Username -->
                                <div class="flex flex-col">
                                    <label class="form-label">Username</label>
                                    <input type="text" name="username" value="{{ old('username', $user->username) }}" class="form-input" required>
                                </div>
                                
                                <!-- Email -->
                                <div class="flex flex-col">
                                    <label class="form-label">Email</label>
                                    <input type="email" name="email" value="{{ $user->email }}" class="form-input" disabled>
                                </div>
                                
                                <!-- Phone Number -->
                                <div class="flex flex-col">
                                    <label class="form-label">Phone Number</label>
                                    <input type="tel" name="phone_num" value="{{ old('phone_num', $user->phone_num) }}" class="form-input" required placeholder="Masukkan nomor telepon">
                                </div>

                                <!-- Address Fields -->
                                <div class="flex flex-col">
                                    <label class="form-label">Address</label>
                                    <input type="text" name="address" value="{{ old('address', $user->address) }}" class="form-input" placeholder="Street Address" required>
                                </div>
                            </div>
                            
                            <!-- Save Button -->
                            <div class="mt-6">
                                <button type="submit" class="save-btn">SAVE CHANGES</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Success/Error Messages -->
        <div id="messageContainer" class="fixed top-4 right-4 z-50 space-y-2"></div>
    </div>

    <script>
        // Image upload functionality
        document.getElementById('imageUpload').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('avatarPreview').style.backgroundImage = 'url(' + e.target.result + ')';
                }
                reader.readAsDataURL(file);
            }
        });

        // Click avatar to upload image
        document.getElementById('avatarPreview').addEventListener('click', function() {
            document.getElementById('imageUpload').click();
        });

        // Phone number formatting - simple number only
        document.querySelector('input[name="phone_num"]').addEventListener('input', function(e) {
            // Only allow numbers
            let value = e.target.value.replace(/\D/g, '');
            e.target.value = value;
        });

        // Form submission
        document.getElementById('profileForm').addEventListener('submit', function(e) {
            // Show loading state
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.textContent;
            submitBtn.textContent = 'SAVING...';
            submitBtn.disabled = true;
            
            // Allow form to submit normally to server
            // The form will redirect after processing
        });

        // Show success/error messages
        function showMessage(message, type = 'success') {
            const messageContainer = document.getElementById('messageContainer');
            const messageDiv = document.createElement('div');
            
            const bgColor = type === 'success' ? 'bg-green-500' : 'bg-red-500';
            messageDiv.className = `${bgColor} text-white px-4 py-2 rounded shadow-lg transform transition-all duration-300 translate-x-full text-sm`;
            messageDiv.textContent = message;
            
            messageContainer.appendChild(messageDiv);
            
            // Animate in
            setTimeout(() => {
                messageDiv.classList.remove('translate-x-full');
            }, 100);
            
            // Auto remove after 3 seconds
            setTimeout(() => {
                messageDiv.classList.add('translate-x-full');
                setTimeout(() => {
                    messageContainer.removeChild(messageDiv);
                }, 300);
            }, 3000);
        }

        // Form validation
        document.querySelectorAll('input[required], select[required]').forEach(field => {
            field.addEventListener('blur', function() {
                if (!this.value.trim()) {
                    this.style.borderColor = '#ef4444';
                } else {
                    this.style.borderColor = '#d1d5db';
                }
            });
        });
    </script>
</x-layout>
