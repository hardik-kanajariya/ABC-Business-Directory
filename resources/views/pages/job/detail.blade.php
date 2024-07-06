@extends('layouts.user')
@section('head')
    <x-seo :modal="$job" title="title"/>
@endsection
@section('content')
    <x-user.bread-crumb :data="['Home', 'Jobs', $job->title]"/>
    <div class="container w-full mb-10 lg:mb-0 overflow-hidden px-2 mt-3">
        <div class="bg-blue-100 p-4 rounded-lg shadow-lg ">
            <div class="flex items-center">
                <div class="flex-grow">
                    <h1 class="text-2xl font-semibold text-blue-900">{{$job->title}}</h1>
                    <p class="text-gray-600">{{$job->company->name}}</p>
                    <div class="text-base text-gray-500">
                        <i class='bx bx-been-here text-red-500'></i> {{$job->address->state->name}}, {{$job->address->country->name}}
                    </div>
                    <p>
                        <span class="text-xs text-gray-600 font-semibold">Published: </span>
                        <span class="text-xs text-gray-600">{{$job->created_at->format('d M Y')}}</span>
                    </p>
                    <div class="mt-4 md:block hidden">
                        <button onclick="showModal('apply-job-on-email')"
                                class="border border-purple-600 text-purple-600 hover:bg-purple-600 hover:text-white py-2 px-4 rounded-full hover:rounded-full transition-all duration-300 ease-in-out">
                            Apply for job
                        </button>
                    </div>
                </div>
                <div class="ml-4">
                    <div class="relative">
                        <img class="w-full h-40 object-contain overflow-hidden" src="{{ url('storage/' . $job->thumbnail) }}" alt="">
                    </div>
                </div>
            </div>
            <div class="mt-4 md:hidden w-full">
                <button onclick="showModal('apply-job-on-email')"
                        class="border border-purple-600 text-purple-600 hover:bg-purple-600 hover:text-white py-2 px-4 rounded-full hover:rounded-full transition-all duration-300 ease-in-out w-full">
                    Apply for job
                </button>
            </div>
        </div>
        <hr class="my-4">
        <h1 class="text-xl text-black">Job Overview</h1>
        <div class="mt-8">
            <p>{!! $job->description !!}</p>
        </div>
        <hr class="my-4">
        <section class="p-4 mx-[-15px]">
            <h2 class="mb-3 text-lg font-bold text-gray-800 lg:text-xl">Job Details</h2>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Address</label>
                <p class="mt-1 text-sm text-gray-500">{{ $job->fullAddress() }}</p>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Employment Type</label>
                <p class="mt-1 text-sm text-gray-500">{{ $job->employment_type }}</p>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Salary</label>
                <p class="mt-1 text-sm text-gray-500">$ {{ \App\classes\HelperFunctions::formatCurrency($job->salary) }}</p>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Last date for apply</label>
                <p class="mt-1 text-sm text-gray-500">{{ $job->valid_until->format('d M Y') }}</p>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Education</label>
                <p class="mt-1 text-sm text-gray-500">{{ $job->education }}</p>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Experience</label>
                <p class="mt-1 text-sm text-gray-500">{{ $job->experience }}</p>
            </div>
        </section>
        <hr class="my-4">
        <div class="mt-4">
            <button  onclick="showModal('apply-job-on-email')" class="border border-purple-600 text-purple-600 hover:bg-purple-600 hover:text-white py-2 px-4 rounded-full hover:rounded-full transition-all duration-300 ease-in-out md:w-auto w-full">
                Apply for job
            </button>
        </div>
        <section class="mt-8">
            <h2 class="text-2xl font-semibold">Related Jobs</h2>
            <div class="mt-5">
                @forelse($related_jobs as $job)
                    <div class="flex flex-col md:flex-row company-card bg-white rounded-lg shadow-md overflow-hidden transform transition-transform duration-300 ease-in-out hover:-translate-y-2 items-center justify-center p-4 md:p-2 mb-5">
                        <div class="mb-4 p-2 md:pr-3">
                            <img class="w-full h-40 md:h-20 object-contain overflow-hidden" src="{{ url('storage/' . $job->thumbnail) }}" alt="">
                        </div>
                        <div class="w-full mx-1 ml-5 pl-3 flex flex-col items-start justify-stretch md:flex-grow"> <!-- Adjusted width to grow on medium screens and above -->
                            <a href="{{ route('view.job', [$job->slug]) }}" class="flex flex-nowrap items-center mb-3">
                                <span class="text-2xl mr-3">{{$job->title}}</span>
                            </a>
                            <div class="text-base text-gray-500 mb-3">
                                <i class='bx bx-been-here text-red-500'></i> {{$job->address->state->name}}, {{$job->address->country->name}}
                            </div>
                            <div class="text-purple-600">
                                {{$job->company->name}}
                            </div>
                        </div>
                        <div class="w-full mx-auto md:w-[calc(20%-1rem)]">
                            <a href="{{ route('view.job', [$job->slug]) }}" class="text-purple-500 bg-purple-100 hover:bg-purple-500 hover:text-white rounded-full p-1 mt-1 transition duration-300 ease-in-out flex items-center justify-center transform hover:-translate-y-1 hover:scale-60 text-center">
                                {{$job->employment_type}} &nbsp;
                            </a>
                        </div>
                    </div>
                @empty
                    <h1 class="text-gray-500 text-4xl text-center mt-10">No Jobs Found</h1>
                @endforelse
            </div>
        </section>
    </div>
    <x-bladewind.modal
        name="apply-job-on-email"
        title="Apply for Job">
        You can apply for this job
        by sending your résumé to the email address
        provided by the employer.
        <br>
        <span class="text-gray-600 text-sm">
                <i class='bx bx-envelope text-gray-600'></i>
                {{$job->organization}}
            </span>
        <div class="mt-4">
            <a href="mailto:{{$job->organization}}"
               class="border border-purple-600 text-purple-600 hover:bg-purple-600 hover:text-white py-2 px-4 rounded-full hover:rounded-full transition-all duration-300 ease-in-out">
                Send Email
            </a>
        </div>
    </x-bladewind.modal>
@endsection
