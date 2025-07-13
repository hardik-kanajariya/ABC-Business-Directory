@extends('layouts.user')

@section('head')
    <style>
        /* Custom Job Page Styles */
        .job-hero {
            background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
        }
        
        .job-card {
            background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .job-card:hover {
            background: linear-gradient(135deg, #bfdbfe 0%, #93c5fd 100%);
            transform: translateY(-2px);
        }
        
        .salary-badge {
            background: linear-gradient(45deg, #10b981, #059669);
            animation: salaryPulse 3s ease-in-out infinite;
        }
        
        @keyframes salaryPulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.8; }
        }
        
        .urgency-badge {
            background: linear-gradient(45deg, #ef4444, #dc2626);
            animation: urgencyBlink 2s ease-in-out infinite;
        }
        
        @keyframes urgencyBlink {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.6; }
        }
        
        .company-logo {
            transition: all 0.3s ease;
        }
        
        .company-logo:hover {
            transform: scale(1.1) rotate(3deg);
        }
        
        .job-detail-card {
            background: linear-gradient(145deg, #f8fafc, #e2e8f0);
            transition: all 0.3s ease;
        }
        
        .job-detail-card:hover {
            background: linear-gradient(145deg, #e2e8f0, #cbd5e1);
            transform: translateY(-2px);
        }
        
        .related-job-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .related-job-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
        }
        
        .apply-button {
            background: linear-gradient(45deg, #7c3aed, #5b21b6);
            transition: all 0.3s ease;
        }
        
        .apply-button:hover {
            background: linear-gradient(45deg, #5b21b6, #4c1d95);
            transform: scale(1.05);
        }
        
        .floating-badge {
            animation: float 3s ease-in-out infinite;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-5px); }
        }
        
        .deadline-timer {
            background: linear-gradient(135deg, #1f2937 0%, #374151 100%);
        }
        
        .timer-digit {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
        }
        
        .skill-tag {
            transition: all 0.3s ease;
        }
        
        .skill-tag:hover {
            transform: scale(1.05);
        }
        
        .benefit-card {
            background: linear-gradient(145deg, #ecfdf5, #d1fae5);
            transition: all 0.3s ease;
        }
        
        .benefit-card:hover {
            background: linear-gradient(145deg, #d1fae5, #a7f3d0);
            transform: translateY(-2px);
        }
        
        .responsibility-item {
            transition: all 0.3s ease;
        }
        
        .responsibility-item:hover {
            background: linear-gradient(145deg, #f8fafc, #e2e8f0);
            transform: translateX(5px);
        }
    </style>
    
    <x-seo :modal="$job" title="title"/>
@endsection

@section('content')
    <div class="container mx-auto px-4 max-w-7xl">
        <x-user.bread-crumb :data="['Home', 'Jobs', $job->title]"/>
        
        @php
            $daysLeft = now()->diffInDays($job->valid_until, false);
            $isUrgent = $daysLeft <= 7 && $daysLeft >= 0;
            $isExpired = $daysLeft < 0;
        @endphp
        
        <!-- Job Hero Section -->
        <div class="job-card rounded-2xl shadow-lg border border-blue-200 overflow-hidden mb-8 p-6 md:p-8">
            <div class="flex flex-col lg:flex-row items-start lg:items-center gap-6">
                <!-- Job Information -->
                <div class="flex-1 space-y-4">
                    <!-- Job Status Badges -->
                    <div class="flex flex-wrap items-center gap-3">
                        @if(!$isExpired)
                            @if($isUrgent)
                                <div class="urgency-badge text-white px-3 py-1 rounded-full text-sm font-bold">
                                    <i class='bx bx-time mr-1'></i>
                                    {{ $daysLeft }} {{ Str::plural('day', $daysLeft) }} left
                                </div>
                            @else
                                <div class="bg-green-500 text-white px-3 py-1 rounded-full text-sm font-bold">
                                    <i class='bx bx-check-circle mr-1'></i>
                                    Active
                                </div>
                            @endif
                        @else
                            <div class="bg-gray-500 text-white px-3 py-1 rounded-full text-sm font-bold">
                                <i class='bx bx-x-circle mr-1'></i>
                                Expired
                            </div>
                        @endif
                        
                        @if($job->is_featured)
                            <div class="floating-badge bg-gradient-to-r from-yellow-400 to-orange-500 text-white px-3 py-1 rounded-full text-sm font-bold">
                                <i class='bx bx-star mr-1'></i>
                                Featured
                            </div>
                        @endif
                        
                        <div class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-medium">
                            {{ $job->employment_type }}
                        </div>
                    </div>

                    <!-- Job Title & Company -->
                    <div>
                        <h1 class="text-2xl md:text-3xl lg:text-4xl font-bold text-blue-900 mb-2">
                            {{ $job->title }}
                        </h1>
                        <h2 class="text-lg md:text-xl text-gray-700 font-semibold mb-3">
                            {{ $job->company->name }}
                        </h2>
                    </div>

                    <!-- Job Meta -->
                    <div class="space-y-2">
                        <div class="flex items-center text-gray-600">
                            <i class='bx bx-map text-red-500 mr-2 text-lg'></i>
                            <span class="font-medium">{{ $job->address->state->name }}, {{ $job->address->country->name }}</span>
                        </div>
                        <div class="flex items-center text-gray-600">
                            <i class='bx bx-calendar text-blue-500 mr-2 text-lg'></i>
                            <span>Published {{ $job->created_at->format('M j, Y') }} ({{ $job->created_at->diffForHumans() }})</span>
                        </div>
                        @if($job->salary)
                            <div class="flex items-center">
                                <i class='bx bx-dollar text-green-500 mr-2 text-lg'></i>
                                <span class="salary-badge text-white px-3 py-1 rounded-full font-bold">
                                    ${{ \App\classes\HelperFunctions::formatCurrency($job->salary) }}/year
                                </span>
                            </div>
                        @endif
                    </div>

                    <!-- Desktop Apply Button -->
                    <div class="hidden md:block">
                        @if(!$isExpired)
                            <button onclick="showApplyModal()" 
                                    class="apply-button text-white px-8 py-3 rounded-full font-bold shadow-lg hover:shadow-xl transition-all duration-300">
                                <i class='bx bx-send mr-2'></i>
                                Apply for This Job
                            </button>
                        @else
                            <div class="bg-gray-400 text-white px-8 py-3 rounded-full font-bold">
                                <i class='bx bx-x-circle mr-2'></i>
                                Application Closed
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Company Logo -->
                <div class="flex-shrink-0">
                    <div class="relative">
                        <img src="{{ url('storage/' . $job->thumbnail) }}" 
                             alt="{{ $job->company->name }} logo"
                             class="company-logo w-32 h-32 md:w-40 md:h-40 object-contain bg-white rounded-2xl shadow-lg p-4">
                        
                        <!-- Verified Badge -->
                        @if($job->company->is_verified)
                            <div class="absolute -bottom-2 -right-2 bg-blue-500 text-white rounded-full p-2">
                                <i class='bx bx-badge-check'></i>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Mobile Apply Button -->
            <div class="md:hidden mt-6 w-full">
                @if(!$isExpired)
                    <button onclick="showApplyModal()" 
                            class="apply-button w-full text-white py-3 rounded-full font-bold shadow-lg">
                        <i class='bx bx-send mr-2'></i>
                        Apply for This Job
                    </button>
                @else
                    <div class="w-full bg-gray-400 text-white py-3 rounded-full font-bold text-center">
                        <i class='bx bx-x-circle mr-2'></i>
                        Application Closed
                    </div>
                @endif
            </div>
        </div>

        <!-- Deadline Timer (for urgent jobs) -->
        @if($isUrgent && !$isExpired)
        <div class="deadline-timer rounded-2xl p-6 text-white mb-8">
            <h3 class="text-xl font-bold mb-4 text-center flex items-center justify-center">
                <i class='bx bx-alarm mr-2'></i>
                Application Deadline
            </h3>
            <div id="deadlineTimer" class="flex justify-center space-x-4">
                <div class="timer-digit rounded-lg p-4 text-center min-w-20">
                    <div class="text-2xl font-bold" id="days">{{ $daysLeft }}</div>
                    <div class="text-sm opacity-75">Days</div>
                </div>
                <div class="timer-digit rounded-lg p-4 text-center min-w-20">
                    <div class="text-2xl font-bold" id="hours">00</div>
                    <div class="text-sm opacity-75">Hours</div>
                </div>
                <div class="timer-digit rounded-lg p-4 text-center min-w-20">
                    <div class="text-2xl font-bold" id="minutes">00</div>
                    <div class="text-sm opacity-75">Minutes</div>
                </div>
            </div>
            <p class="text-center mt-4 opacity-90">Apply before {{ $job->valid_until->format('M j, Y') }}</p>
        </div>
        @endif

        <div class="grid lg:grid-cols-3 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Job Overview -->
                <section class="bg-white rounded-2xl shadow-lg border border-gray-200 p-6 md:p-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                        <i class='bx bx-info-circle text-blue-600 mr-3'></i>
                        Job Overview
                    </h2>
                    
                    <div class="prose prose-gray max-w-none leading-relaxed text-lg">
                        {!! $job->description !!}
                    </div>
                </section>

                <!-- Job Responsibilities -->
                <section class="bg-white rounded-2xl shadow-lg border border-gray-200 p-6 md:p-8">
                    <h3 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                        <i class='bx bx-task text-purple-600 mr-3'></i>
                        Key Responsibilities
                    </h3>
                    
                    <div class="space-y-4">
                        <div class="responsibility-item p-4 rounded-xl border border-gray-100 transition-all duration-300">
                            <div class="flex items-start">
                                <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center mr-4 mt-1 flex-shrink-0">
                                    <i class='bx bx-check text-blue-600'></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-900 mb-2">Lead Project Development</h4>
                                    <p class="text-gray-700">Take ownership of project timelines, deliverables, and coordinate with cross-functional teams to ensure successful completion.</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="responsibility-item p-4 rounded-xl border border-gray-100 transition-all duration-300">
                            <div class="flex items-start">
                                <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center mr-4 mt-1 flex-shrink-0">
                                    <i class='bx bx-check text-green-600'></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-900 mb-2">Collaborate with Teams</h4>
                                    <p class="text-gray-700">Work closely with design, development, and marketing teams to align project goals and maintain quality standards.</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="responsibility-item p-4 rounded-xl border border-gray-100 transition-all duration-300">
                            <div class="flex items-start">
                                <div class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center mr-4 mt-1 flex-shrink-0">
                                    <i class='bx bx-check text-purple-600'></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-900 mb-2">Quality Assurance</h4>
                                    <p class="text-gray-700">Ensure all deliverables meet company standards and client requirements through thorough review and testing processes.</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="responsibility-item p-4 rounded-xl border border-gray-100 transition-all duration-300">
                            <div class="flex items-start">
                                <div class="w-8 h-8 bg-orange-100 rounded-full flex items-center justify-center mr-4 mt-1 flex-shrink-0">
                                    <i class='bx bx-check text-orange-600'></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-900 mb-2">Continuous Improvement</h4>
                                    <p class="text-gray-700">Identify opportunities for process optimization and implement best practices to enhance team productivity.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Required Skills & Qualifications -->
                <section class="bg-white rounded-2xl shadow-lg border border-gray-200 p-6 md:p-8">
                    <h3 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                        <i class='bx bx-cog text-indigo-600 mr-3'></i>
                        Required Skills & Qualifications
                    </h3>
                    
                    <div class="grid md:grid-cols-2 gap-8">
                        <!-- Required Skills -->
                        <div>
                            <h4 class="text-lg font-semibold text-gray-900 mb-4">Technical Skills</h4>
                            <div class="space-y-3">
                                @if($job->skills)
                                    @foreach(explode(',', $job->skills) as $skill)
                                        <div class="flex items-center">
                                            <i class='bx bx-check-circle text-green-500 mr-3'></i>
                                            <span class="skill-tag bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-medium">
                                                {{ trim($skill) }}
                                            </span>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="flex items-center">
                                        <i class='bx bx-check-circle text-green-500 mr-3'></i>
                                        <span class="skill-tag bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-medium">Problem Solving</span>
                                    </div>
                                    <div class="flex items-center">
                                        <i class='bx bx-check-circle text-green-500 mr-3'></i>
                                        <span class="skill-tag bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-medium">Communication</span>
                                    </div>
                                    <div class="flex items-center">
                                        <i class='bx bx-check-circle text-green-500 mr-3'></i>
                                        <span class="skill-tag bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-medium">Team Leadership</span>
                                    </div>
                                    <div class="flex items-center">
                                        <i class='bx bx-check-circle text-green-500 mr-3'></i>
                                        <span class="skill-tag bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-medium">Project Management</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                        
                        <!-- Education & Experience -->
                        <div>
                            <h4 class="text-lg font-semibold text-gray-900 mb-4">Qualifications</h4>
                            <div class="space-y-4">
                                @if($job->education)
                                    <div class="p-4 bg-purple-50 rounded-lg border border-purple-100">
                                        <div class="flex items-center mb-2">
                                            <i class='bx bx-book text-purple-600 mr-2'></i>
                                            <span class="font-semibold text-gray-900">Education</span>
                                        </div>
                                        <p class="text-gray-700">{{ $job->education }}</p>
                                    </div>
                                @endif
                                
                                @if($job->experience)
                                    <div class="p-4 bg-orange-50 rounded-lg border border-orange-100">
                                        <div class="flex items-center mb-2">
                                            <i class='bx bx-trending-up text-orange-600 mr-2'></i>
                                            <span class="font-semibold text-gray-900">Experience</span>
                                        </div>
                                        <p class="text-gray-700">{{ $job->experience }}</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Benefits & Perks -->
                <section class="bg-white rounded-2xl shadow-lg border border-gray-200 p-6 md:p-8">
                    <h3 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                        <i class='bx bx-gift text-green-600 mr-3'></i>
                        Benefits & Perks
                    </h3>
                    
                    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-4">
                        <div class="benefit-card p-4 rounded-xl border border-green-100">
                            <div class="flex items-center mb-2">
                                <i class='bx bx-health text-green-600 text-xl mr-3'></i>
                                <span class="font-semibold text-gray-900">Health Insurance</span>
                            </div>
                            <p class="text-sm text-gray-700">Comprehensive medical, dental, and vision coverage</p>
                        </div>
                        
                        <div class="benefit-card p-4 rounded-xl border border-green-100">
                            <div class="flex items-center mb-2">
                                <i class='bx bx-time text-blue-600 text-xl mr-3'></i>
                                <span class="font-semibold text-gray-900">Flexible Hours</span>
                            </div>
                            <p class="text-sm text-gray-700">Work-life balance with flexible scheduling options</p>
                        </div>
                        
                        <div class="benefit-card p-4 rounded-xl border border-green-100">
                            <div class="flex items-center mb-2">
                                <i class='bx bx-home text-purple-600 text-xl mr-3'></i>
                                <span class="font-semibold text-gray-900">Remote Work</span>
                            </div>
                            <p class="text-sm text-gray-700">Option to work remotely or hybrid arrangement</p>
                        </div>
                        
                        <div class="benefit-card p-4 rounded-xl border border-green-100">
                            <div class="flex items-center mb-2">
                                <i class='bx bx-trending-up text-orange-600 text-xl mr-3'></i>
                                <span class="font-semibold text-gray-900">Career Growth</span>
                            </div>
                            <p class="text-sm text-gray-700">Professional development and advancement opportunities</p>
                        </div>
                        
                        <div class="benefit-card p-4 rounded-xl border border-green-100">
                            <div class="flex items-center mb-2">
                                <i class='bx bx-dollar text-green-600 text-xl mr-3'></i>
                                <span class="font-semibold text-gray-900">Competitive Salary</span>
                            </div>
                            <p class="text-sm text-gray-700">Market-competitive compensation package</p>
                        </div>
                        
                        <div class="benefit-card p-4 rounded-xl border border-green-100">
                            <div class="flex items-center mb-2">
                                <i class='bx bx-calendar text-indigo-600 text-xl mr-3'></i>
                                <span class="font-semibold text-gray-900">Paid Time Off</span>
                            </div>
                            <p class="text-sm text-gray-700">Generous vacation days and sick leave policy</p>
                        </div>
                    </div>
                </section>

                <!-- Company Culture -->
                <section class="bg-white rounded-2xl shadow-lg border border-gray-200 p-6 md:p-8">
                    <h3 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                        <i class='bx bx-group text-purple-600 mr-3'></i>
                        Company Culture
                    </h3>
                    
                    <div class="bg-gradient-to-r from-purple-50 to-indigo-50 rounded-xl p-6 border border-purple-100">
                        <div class="grid md:grid-cols-2 gap-6">
                            <div>
                                <h4 class="font-semibold text-gray-900 mb-3">Our Values</h4>
                                <ul class="space-y-2 text-gray-700">
                                    <li class="flex items-center">
                                        <i class='bx bx-check-circle text-purple-600 mr-2'></i>
                                        Innovation and creativity
                                    </li>
                                    <li class="flex items-center">
                                        <i class='bx bx-check-circle text-purple-600 mr-2'></i>
                                        Collaboration and teamwork
                                    </li>
                                    <li class="flex items-center">
                                        <i class='bx bx-check-circle text-purple-600 mr-2'></i>
                                        Continuous learning
                                    </li>
                                    <li class="flex items-center">
                                        <i class='bx bx-check-circle text-purple-600 mr-2'></i>
                                        Work-life balance
                                    </li>
                                </ul>
                            </div>
                            
                            <div>
                                <h4 class="font-semibold text-gray-900 mb-3">Work Environment</h4>
                                <p class="text-gray-700 text-sm leading-relaxed">
                                    Join a dynamic team where your ideas matter. We foster an inclusive environment that encourages growth, 
                                    innovation, and personal development. Our collaborative workspace promotes creativity and team spirit.
                                </p>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Application Process -->
                <section class="bg-white rounded-2xl shadow-lg border border-gray-200 p-6 md:p-8">
                    <h3 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                        <i class='bx bx-clipboard text-blue-600 mr-3'></i>
                        Application Process
                    </h3>
                    
                    <div class="grid md:grid-cols-4 gap-4">
                        <div class="text-center p-4 bg-blue-50 rounded-xl border border-blue-100">
                            <div class="w-12 h-12 bg-blue-600 rounded-full flex items-center justify-center mx-auto mb-3">
                                <span class="text-white font-bold">1</span>
                            </div>
                            <h4 class="font-semibold text-gray-900 mb-2">Apply</h4>
                            <p class="text-sm text-gray-600">Submit your application and resume</p>
                        </div>
                        
                        <div class="text-center p-4 bg-green-50 rounded-xl border border-green-100">
                            <div class="w-12 h-12 bg-green-600 rounded-full flex items-center justify-center mx-auto mb-3">
                                <span class="text-white font-bold">2</span>
                            </div>
                            <h4 class="font-semibold text-gray-900 mb-2">Review</h4>
                            <p class="text-sm text-gray-600">HR team reviews your application</p>
                        </div>
                        
                        <div class="text-center p-4 bg-purple-50 rounded-xl border border-purple-100">
                            <div class="w-12 h-12 bg-purple-600 rounded-full flex items-center justify-center mx-auto mb-3">
                                <span class="text-white font-bold">3</span>
                            </div>
                            <h4 class="font-semibold text-gray-900 mb-2">Interview</h4>
                            <p class="text-sm text-gray-600">Phone/video interview with hiring manager</p>
                        </div>
                        
                        <div class="text-center p-4 bg-orange-50 rounded-xl border border-orange-100">
                            <div class="w-12 h-12 bg-orange-600 rounded-full flex items-center justify-center mx-auto mb-3">
                                <span class="text-white font-bold">4</span>
                            </div>
                            <h4 class="font-semibold text-gray-900 mb-2">Decision</h4>
                            <p class="text-sm text-gray-600">Final decision and offer extension</p>
                        </div>
                    </div>
                </section>

                <!-- Application CTA -->
                @if(!$isExpired)
                <section class="bg-gradient-to-r from-purple-50 to-indigo-50 rounded-2xl border border-purple-200 p-6 md:p-8">
                    <div class="text-center">
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Ready to Apply?</h3>
                        <p class="text-gray-700 mb-6">Join {{ $job->company->name }} and take your career to the next level!</p>
                        
                        <button onclick="showApplyModal()" 
                                class="apply-button text-white px-8 py-4 rounded-full font-bold text-lg shadow-lg hover:shadow-xl transition-all duration-300">
                            <i class='bx bx-send mr-2'></i>
                            Apply Now
                        </button>
                        
                        <div class="mt-4 text-sm text-gray-600">
                            <i class='bx bx-shield-check mr-1'></i>
                            Your application will be sent directly to the employer
                        </div>
                    </div>
                </section>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1 space-y-6">
                <!-- Job Details -->
                <div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-6 sticky top-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                        <i class='bx bx-file-blank text-blue-600 mr-2'></i>
                        Job Details
                    </h3>
                    
                    <div class="space-y-4">
                        <!-- Full Address -->
                        <div class="job-detail-card rounded-xl p-4">
                            <label class="block text-sm font-semibold text-gray-700 mb-1">
                                <i class='bx bx-map text-blue-500 mr-1'></i>
                                Location
                            </label>
                            <p class="text-gray-900 font-medium">{{ $job->fullAddress() }}</p>
                        </div>

                        <!-- Employment Type -->
                        <div class="job-detail-card rounded-xl p-4">
                            <label class="block text-sm font-semibold text-gray-700 mb-1">
                                <i class='bx bx-briefcase text-green-500 mr-1'></i>
                                Employment Type
                            </label>
                            <p class="text-gray-900 font-medium">{{ $job->employment_type }}</p>
                        </div>

                        <!-- Salary -->
                        @if($job->salary)
                        <div class="job-detail-card rounded-xl p-4">
                            <label class="block text-sm font-semibold text-gray-700 mb-1">
                                <i class='bx bx-dollar text-green-500 mr-1'></i>
                                Salary
                            </label>
                            <p class="text-green-600 font-bold text-lg">
                                ${{ \App\classes\HelperFunctions::formatCurrency($job->salary) }}/year
                            </p>
                        </div>
                        @endif

                        <!-- Application Deadline -->
                        <div class="job-detail-card rounded-xl p-4">
                            <label class="block text-sm font-semibold text-gray-700 mb-1">
                                <i class='bx bx-calendar text-red-500 mr-1'></i>
                                Application Deadline
                            </label>
                            <p class="font-medium {{ $isUrgent ? 'text-red-600' : ($isExpired ? 'text-gray-500' : 'text-gray-900') }}">
                                {{ $job->valid_until->format('M j, Y') }}
                                @if($isUrgent)
                                    <span class="text-sm block text-red-500">{{ $daysLeft }} {{ Str::plural('day', $daysLeft) }} left!</span>
                                @elseif($isExpired)
                                    <span class="text-sm block text-gray-500">Expired</span>
                                @endif
                            </p>
                        </div>

                        <!-- Education -->
                        @if($job->education)
                        <div class="job-detail-card rounded-xl p-4">
                            <label class="block text-sm font-semibold text-gray-700 mb-1">
                                <i class='bx bx-book text-purple-500 mr-1'></i>
                                Education
                            </label>
                            <p class="text-gray-900 font-medium">{{ $job->education }}</p>
                        </div>
                        @endif

                        <!-- Experience -->
                        @if($job->experience)
                        <div class="job-detail-card rounded-xl p-4">
                            <label class="block text-sm font-semibold text-gray-700 mb-1">
                                <i class='bx bx-trending-up text-orange-500 mr-1'></i>
                                Experience
                            </label>
                            <p class="text-gray-900 font-medium">{{ $job->experience }}</p>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Company Info -->
                <div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-4 flex items-center">
                        <i class='bx bx-building text-blue-600 mr-2'></i>
                        About Company
                    </h3>
                    
                    <div class="text-center">
                        <img src="{{ url('storage/' . $job->company->logo) }}" 
                             alt="{{ $job->company->name }}"
                             class="w-16 h-16 rounded-full mx-auto border-4 border-blue-100 shadow-lg mb-4">
                        
                        <h4 class="font-semibold text-gray-900 mb-2">{{ $job->company->name }}</h4>
                        
                        <div class="grid grid-cols-2 gap-4 mb-4 text-center">
                            <div>
                                <div class="font-bold text-blue-600">{{ $job->company->jobs_count ?? '1' }}</div>
                                <div class="text-xs text-gray-600">Active Jobs</div>
                            </div>
                            <div>
                                <div class="font-bold text-green-600">{{ $job->company->employees_count ?? 'N/A' }}</div>
                                <div class="text-xs text-gray-600">Employees</div>
                            </div>
                        </div>
                        
                        <a href="{{ route('view.company', [$job->company->slug]) }}"
                           class="block w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded-lg transition-colors">
                            View Company Profile
                        </a>
                    </div>
                </div>

                <!-- Share Job -->
                <div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-4 flex items-center">
                        <i class='bx bx-share text-blue-600 mr-2'></i>
                        Share This Job
                    </h3>
                    
                    <div class="flex justify-center space-x-3">
                        <button onclick="shareOnLinkedIn()" 
                                class="w-10 h-10 bg-blue-700 hover:bg-blue-800 text-white rounded-full flex items-center justify-center transition-colors">
                            <i class='bx bxl-linkedin'></i>
                        </button>
                        <button onclick="shareOnTwitter()" 
                                class="w-10 h-10 bg-sky-500 hover:bg-sky-600 text-white rounded-full flex items-center justify-center transition-colors">
                            <i class='bx bxl-twitter'></i>
                        </button>
                        <button onclick="shareOnFacebook()" 
                                class="w-10 h-10 bg-blue-600 hover:bg-blue-700 text-white rounded-full flex items-center justify-center transition-colors">
                            <i class='bx bxl-facebook'></i>
                        </button>
                        <button onclick="copyJobLink()" 
                                class="w-10 h-10 bg-gray-600 hover:bg-gray-700 text-white rounded-full flex items-center justify-center transition-colors">
                            <i class='bx bx-link'></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Related Jobs Section -->
        @if($related_jobs && $related_jobs->count() > 0)
        <section class="mt-12">
            <div class="flex items-center justify-between mb-8">
                <h2 class="text-3xl font-bold text-gray-900 flex items-center">
                    <i class='bx bx-briefcase text-blue-600 mr-3'></i>
                    Related Jobs
                </h2>
                <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-medium">
                    {{ $related_jobs->count() }} {{ Str::plural('Job', $related_jobs->count()) }}
                </span>
            </div>
            
            <div class="space-y-4">
                @foreach($related_jobs as $relatedJob)
                    <div class="related-job-card bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden group">
                        <div class="flex flex-col md:flex-row p-6">
                            <!-- Company Logo -->
                            <div class="flex-shrink-0 mb-4 md:mb-0 md:mr-6">
                                <img src="{{ url('storage/' . $relatedJob->thumbnail) }}" 
                                     alt="{{ $relatedJob->company->name }}"
                                     class="w-16 h-16 md:w-20 md:h-20 object-contain bg-gray-50 rounded-xl p-2">
                            </div>
                            
                            <!-- Job Info -->
                            <div class="flex-1">
                                <div class="flex flex-col md:flex-row md:items-start md:justify-between">
                                    <div class="flex-1 mb-4 md:mb-0">
                                        <h3 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-blue-600 transition-colors">
                                            <a href="{{ route('view.job', [$relatedJob->slug]) }}">
                                                {{ $relatedJob->title }}
                                            </a>
                                        </h3>
                                        
                                        <div class="text-purple-600 font-semibold mb-2">
                                            {{ $relatedJob->company->name }}
                                        </div>
                                        
                                        <div class="flex items-center text-gray-600 text-sm">
                                            <i class='bx bx-map text-red-500 mr-1'></i>
                                            {{ $relatedJob->address->state->name }}, {{ $relatedJob->address->country->name }}
                                        </div>
                                    </div>
                                    
                                    <!-- Job Type & Apply Button -->
                                    <div class="flex flex-col items-start md:items-end space-y-2">
                                        <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-medium">
                                            {{ $relatedJob->employment_type }}
                                        </span>
                                        
                                        <a href="{{ route('view.job', [$relatedJob->slug]) }}" 
                                           class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-lg font-medium transition-colors">
                                            View Job
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
        @endif
    </div>

    <!-- Application Modal -->
    <div id="applyModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full mx-4 transform transition-all duration-300">
            <div class="p-6">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-2xl font-bold text-gray-900">Apply for Job</h3>
                    <button onclick="hideApplyModal()" class="text-gray-400 hover:text-gray-600 text-2xl">
                        <i class='bx bx-x'></i>
                    </button>
                </div>
                
                <div class="text-center mb-6">
                    <i class='bx bx-envelope text-6xl text-blue-600 mb-4'></i>
                    <p class="text-gray-700 mb-4">
                        You can apply for this job by sending your résumé to the email address provided by the employer.
                    </p>
                    
                    <div class="bg-gray-50 rounded-lg p-4 mb-6">
                        <div class="text-sm text-gray-600 mb-1">Contact Email:</div>
                        <div class="font-semibold text-gray-900 flex items-center justify-center">
                            <i class='bx bx-envelope text-blue-600 mr-2'></i>
                            {{ $job->organization }}
                        </div>
                    </div>
                </div>
                
                <div class="flex space-x-3">
                    <button onclick="hideApplyModal()" 
                            class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold py-3 rounded-lg transition-colors">
                        Cancel
                    </button>
                    <a href="mailto:{{ $job->organization }}?subject=Application for {{ $job->title }}&body=Dear Hiring Manager,%0D%0A%0D%0AI am writing to express my interest in the {{ $job->title }} position at {{ $job->company->name }}.%0D%0A%0D%0APlease find my resume attached.%0D%0A%0D%0ABest regards" 
                       class="flex-1 apply-button text-white font-semibold py-3 rounded-lg transition-colors text-center">
                        <i class='bx bx-send mr-2'></i>
                        Send Email
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-scripts')
    <script>
        // Application Modal Functions
        function showApplyModal() {
            document.getElementById('applyModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function hideApplyModal() {
            document.getElementById('applyModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        // Deadline Timer (if urgent)
        @if($isUrgent && !$isExpired)
        function startDeadlineTimer() {
            const deadline = new Date('{{ $job->valid_until->toISOString() }}').getTime();
            
            const timer = setInterval(function() {
                const now = new Date().getTime();
                const timeLeft = deadline - now;
                
                if (timeLeft <= 0) {
                    clearInterval(timer);
                    document.getElementById('deadlineTimer').innerHTML = '<div class="text-center text-lg font-bold text-red-400">Application Deadline Passed!</div>';
                    return;
                }
                
                const days = Math.floor(timeLeft / (1000 * 60 * 60 * 24));
                const hours = Math.floor((timeLeft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
                
                document.getElementById('days').textContent = days.toString().padStart(2, '0');
                document.getElementById('hours').textContent = hours.toString().padStart(2, '0');
                document.getElementById('minutes').textContent = minutes.toString().padStart(2, '0');
            }, 1000);
        }
        @endif

        // Social Share Functions
        function shareOnLinkedIn() {
            const url = encodeURIComponent(window.location.href);
            const title = encodeURIComponent('{{ $job->title }} at {{ $job->company->name }}');
            const summary = encodeURIComponent('Check out this job opportunity!');
            window.open(`https://www.linkedin.com/sharing/share-offsite/?url=${url}&title=${title}&summary=${summary}`, '_blank', 'width=600,height=400');
        }

        function shareOnTwitter() {
            const url = encodeURIComponent(window.location.href);
            const text = encodeURIComponent('Check out this job opportunity: {{ $job->title }} at {{ $job->company->name }}');
            window.open(`https://twitter.com/intent/tweet?url=${url}&text=${text}`, '_blank', 'width=600,height=400');
        }

        function shareOnFacebook() {
            const url = encodeURIComponent(window.location.href);
            window.open(`https://www.facebook.com/sharer/sharer.php?u=${url}`, '_blank', 'width=600,height=400');
        }

        async function copyJobLink() {
            try {
                await navigator.clipboard.writeText(window.location.href);
                showNotification('Job link copied to clipboard!', 'success');
            } catch (error) {
                console.error('Error copying link:', error);
                showNotification('Failed to copy link. Please try again.', 'error');
            }
        }

        // Notification Function
        function showNotification(message, type = 'info') {
            const notification = document.createElement('div');
            notification.className = `fixed top-4 right-4 p-4 rounded-lg shadow-lg z-50 transform transition-all duration-300 ${
                type === 'success' ? 'bg-green-500 text-white' : 
                type === 'error' ? 'bg-red-500 text-white' : 
                'bg-blue-500 text-white'
            }`;
            notification.textContent = message;
            
            document.body.appendChild(notification);
            
            // Slide in animation
            setTimeout(() => {
                notification.style.transform = 'translateX(0)';
            }, 100);
            
            // Remove after 5 seconds
            setTimeout(() => {
                notification.style.transform = 'translateX(100%)';
                setTimeout(() => {
                    if (notification.parentNode) {
                        notification.parentNode.removeChild(notification);
                    }
                }, 300);
            }, 5000);
        }

        // Close modal when clicking outside
        document.getElementById('applyModal').addEventListener('click', function(e) {
            if (e.target === this) {
                hideApplyModal();
            }
        });

        // Escape key to close modal
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                hideApplyModal();
            }
        });

        // Initialize page
        document.addEventListener('DOMContentLoaded', function() {
            @if($isUrgent && !$isExpired)
                startDeadlineTimer();
            @endif
            
            // Initialize intersection observer for animations
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('animate-fade-in');
                    }
                });
            }, {
                threshold: 0.1
            });

            // Observe elements for animations
            document.querySelectorAll('.related-job-card, .job-detail-card, .benefit-card, .responsibility-item').forEach(el => {
                observer.observe(el);
            });

            // Track job view for analytics
            if (typeof gtag !== 'undefined') {
                gtag('event', 'job_view', {
                    event_category: 'jobs',
                    event_label: '{{ $job->title }}',
                    value: 1
                });
            }
        });
    </script>
@endsection