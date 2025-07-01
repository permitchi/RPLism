<x-layout>
    <div class="container mx-auto px-20 py-16">
        <!-- Page Title -->
        <div class="text-center mb-16">
            <h1 class="font-logo text-5xl font-bold text-yellow-600 mb-4">Get in Touch</h1>
            <p class="font-body text-gray-600 mx-auto">
                We'd love to hear from you. Send us a message and we'll respond as soon as possible.
            </p>
        </div>

        <div class="grid md:grid-cols-2 gap-16">
            <!-- Contact Form -->
            <div class="bg-white rounded-2xl shadow-lg p-8">
                <h2 class="font-logo text-3xl font-bold text-gray-800 mb-6">Send us a Message</h2>
                <form class="space-y-6">
                    <div class="grid md:grid-cols-2 gap-4">
                        <div>
                            <label class="block font-body text-gray-700 mb-2">First Name</label>
                            <input type="text" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 font-body" placeholder="Your first name">
                        </div>
                        <div>
                            <label class="block font-body text-gray-700 mb-2">Last Name</label>
                            <input type="text" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 font-body" placeholder="Your last name">
                        </div>
                    </div>
                    <div>
                        <label class="block font-body text-gray-700 mb-2">Email Address</label>
                        <input type="email" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 font-body" placeholder="your.email@example.com">
                    </div>
                    <div>
                        <label class="block font-body text-gray-700 mb-2">Phone Number</label>
                        <input type="tel" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 font-body" placeholder="+62 123 456 789">
                    </div>
                    <div>
                        <label class="block font-body text-gray-700 mb-2">Subject</label>
                        <select class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 font-body">
                            <option>General Inquiry</option>
                            <option>Product Question</option>
                            <option>Order Support</option>
                            <option>Custom Design</option>
                            <option>Partnership</option>
                        </select>
                    </div>
                    <div>
                        <label class="block font-body text-gray-700 mb-2">Message</label>
                        <textarea rows="5" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 font-body" placeholder="Tell us how we can help you..."></textarea>
                    </div>
                    <button type="submit" class="w-full bg-yellow-600 hover:bg-yellow-700 text-white py-3 rounded-lg font-body font-medium text-lg transition duration-300 transform hover:scale-[1.02]">
                        Send Message
                    </button>
                </form>
            </div>

            <!-- Contact Information -->
            <div class="space-y-8">
                <!-- Contact Details -->
                <div class="bg-white rounded-2xl shadow-lg p-8">
                    <h2 class="font-logo text-3xl font-bold text-gray-800 mb-6">Contact Information</h2>
                    <div class="space-y-6">
                        <div class="flex items-start">
                            <div class="bg-yellow-100 p-3 rounded-lg mr-4">
                                <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-body font-semibold text-gray-800 mb-1">Address</h3>
                                <p class="font-body text-gray-600">123 Fifth Avenue<br>New York, NY 10160<br>United States</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="bg-yellow-100 p-3 rounded-lg mr-4">
                                <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-body font-semibold text-gray-800 mb-1">Phone</h3>
                                <p class="font-body text-gray-600">+62 87654321<br>+1 (555) 123-4567</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="bg-yellow-100 p-3 rounded-lg mr-4">
                                <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-body font-semibold text-gray-800 mb-1">Email</h3>
                                <p class="font-body text-gray-600">miinacci@gmail.com<br>support@minacci.com</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Business Hours -->
                <div class="bg-white rounded-2xl shadow-lg p-8">
                    <h2 class="font-logo text-3xl font-bold text-gray-800 mb-6">Business Hours</h2>
                    <div class="space-y-3">
                        <div class="flex justify-between">
                            <span class="font-body text-gray-600">Monday - Friday</span>
                            <span class="font-body font-semibold text-gray-800">9:00 AM - 7:00 PM</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="font-body text-gray-600">Saturday</span>
                            <span class="font-body font-semibold text-gray-800">10:00 AM - 6:00 PM</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="font-body text-gray-600">Sunday</span>
                            <span class="font-body font-semibold text-gray-800">12:00 PM - 5:00 PM</span>
                        </div>
                    </div>
                </div>

                <!-- Social Media -->
                <div class="bg-white rounded-2xl shadow-lg p-8">
                    <h2 class="font-logo text-3xl font-bold text-gray-800 mb-6">Follow Us</h2>
                    <div class="flex space-x-4">
                        <a href="#" class="bg-blue-600 hover:bg-blue-700 text-white p-3 rounded-lg transition duration-300">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                            </svg>
                        </a>
                        <a href="#" class="bg-pink-600 hover:bg-pink-700 text-white p-3 rounded-lg transition duration-300">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 5.079 3.158 9.417 7.618 11.174-.105-.949-.199-2.403.041-3.439.219-.937 1.406-5.957 1.406-5.957s-.359-.72-.359-1.781c0-1.663.967-2.911 2.168-2.911 1.024 0 1.518.769 1.518 1.688 0 1.029-.653 2.567-.992 3.992-.285 1.193.6 2.165 1.775 2.165 2.128 0 3.768-2.245 3.768-5.487 0-2.861-2.063-4.869-5.008-4.869-3.41 0-5.409 2.562-5.409 5.199 0 1.033.394 2.143.89 2.745.099.12.112.225.085.347-.09.375-.293 1.199-.334 1.363-.053.225-.172.271-.402.165-1.495-.69-2.433-2.878-2.433-4.646 0-3.776 2.748-7.252 7.92-7.252 4.158 0 7.392 2.967 7.392 6.923 0 4.135-2.607 7.462-6.233 7.462-1.214 0-2.357-.629-2.746-1.378l-.748 2.853c-.271 1.043-1.002 2.35-1.492 3.146C9.57 23.812 10.763 24.009 12.017 24.009c6.624 0 11.99-5.367 11.99-11.988C24.007 5.367 18.641.001 12.017.001z"/>
                            </svg>
                        </a>
                        <a href="#" class="bg-blue-800 hover:bg-blue-900 text-white p-3 rounded-lg transition duration-300">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                            </svg>
                        </a>
                        <a href="#" class="bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white p-3 rounded-lg transition duration-300">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12.004 5.838a6.157 6.157 0 1 0 6.158 6.158 6.165 6.165 0 0 0-6.158-6.158ZM12.004 16.155A4.157 4.157 0 1 1 16.161 12a4.161 4.161 0 0 1-4.157 4.155Z"/>
                                <path d="M18.406 4.155a1.44 1.44 0 1 0 1.44 1.44 1.441 1.441 0 0 0-1.44-1.44Z"/>
                                <path d="M12.004 2.204c-2.4 0-2.69.01-3.64.052-.95.043-1.6.196-2.17.418A4.412 4.412 0 0 0 4.6 4.6a4.361 4.361 0 0 0-1.925 1.594c-.222.57-.375 1.22-.418 2.17C2.214 9.314 2.204 9.604 2.204 12s.01 2.686.052 3.636c.043.95.196 1.6.418 2.17A4.412 4.412 0 0 0 4.6 19.4a4.361 4.361 0 0 0 1.594 1.925c.57.222 1.22.375 2.17.418.95.042 1.24.052 3.64.052s2.69-.01 3.64-.052c.95-.043 1.6-.196 2.17-.418A4.412 4.412 0 0 0 19.4 19.4a4.361 4.361 0 0 0 1.925-1.594c.222-.57.375-1.22.418-2.17.042-.95.052-1.24.052-3.64s-.01-2.69-.052-3.64c-.043-.95-.196-1.6-.418-2.17A4.412 4.412 0 0 0 19.4 4.6a4.361 4.361 0 0 0-1.594-1.925c-.57-.222-1.22-.375-2.17-.418C14.694 2.214 14.404 2.204 12.004 2.204Zm0 1.8c2.4 0 2.686.009 3.637.052.877.04 1.354.187 1.671.31a2.788 2.788 0 0 1 1.035.673 2.788 2.788 0 0 1 .673 1.035c.123.317.27.794.31 1.671.043.951.052 1.237.052 3.637s-.009 2.686-.052 3.637c-.04.877-.187 1.354-.31 1.671a2.788 2.788 0 0 1-.673 1.035 2.788 2.788 0 0 1-1.035.673c-.317.123-.794.27-1.671.31-.951.043-1.237.052-3.637.052s-2.686-.009-3.637-.052c-.877-.04-1.354-.187-1.671-.31a2.788 2.788 0 0 1-1.035-.673 2.788 2.788 0 0 1-.673-1.035c-.123-.317-.27-.794-.31-1.671-.043-.951-.052-1.237-.052-3.637s.009-2.686.052-3.637c.04-.877.187-1.354.31-1.671a2.788 2.788 0 0 1 .673-1.035A2.788 2.788 0 0 1 6.696 4.36c.317-.123.794-.27 1.671-.31.951-.043 1.237-.052 3.637-.052Z"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Map Section -->
        <div class="mt-16">
            <h2 class="font-logo text-4xl font-bold text-yellow-600 text-center mb-8">Find Us</h2>
            <iframe class="w-full" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d26261.055293436457!2d106.84657440838353!3d-6.20594615202121!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f4ed14403213%3A0x2412a91a0f6a01c8!2sJakarta%20State%20University!5e0!3m2!1sen!2sid!4v1751375431531!5m2!1sen!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>
</x-layout>