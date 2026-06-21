@extends('layouts.app')
@section('title', 'Project Details - ' . $serviceName)

@section('content')
<div class="max-w-4xl mx-auto py-8 px-4 sm:px-6">
    <div class="mb-8">
        <h1 class="text-2xl font-black text-slate-900 tracking-tight">Project Requirements Form</h1>
        <p class="text-slate-500 text-sm mt-1">Please provide the details below so our team can start working on your project: <span class="font-bold text-indigo-600">{{ $serviceName }}</span></p>
    </div>

    @if(session('error'))
        <div class="mb-6 bg-red-50 text-red-700 p-4 rounded-xl text-sm font-medium border border-red-100">
            {{ session('error') }}
        </div>
    @endif

    @php
        $type = 'default';
        if ($order->service) {
            $slug = $order->service->slug;
            if (str_contains($slug, 'website') || str_contains($slug, 'e-commerce') || str_contains($slug, 'ecommerce')) {
                $type = 'website';
            } elseif (str_contains($slug, 'meta-ads') || str_contains($slug, 'facebook')) {
                $type = 'meta_ads';
            } elseif (str_contains($slug, 'google-ads')) {
                $type = 'google_ads';
            } elseif (str_contains($slug, 'seo')) {
                $type = 'seo';
            }
        }
    @endphp

    <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">
        <form action="{{ route('post-payment.store', $order) }}" method="POST" enctype="multipart/form-data" class="p-8">
            @csrf
            <input type="hidden" name="service_name" value="{{ $serviceName }}">

            <div class="space-y-6">
                
                @if($type === 'website')
                    <!-- Website Fields -->
                    <div class="bg-indigo-50/50 p-6 rounded-2xl border border-indigo-100 mb-6">
                        <p class="text-sm font-semibold text-indigo-800 mb-2">📌 Please send us the following business details 👇</p>
                        <p class="text-xs text-indigo-600 mb-4">(So we can build your website just the way you want)</p>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-xs font-bold text-slate-600 mb-2 uppercase tracking-wider">Business Name <span class="text-red-500">*</span></label>
                                <input type="text" name="business_name" required class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 text-sm bg-slate-50 outline-none">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-600 mb-2 uppercase tracking-wider">Domain Name</label>
                                <input type="text" name="domain_name" placeholder="e.g. yourbusiness.com" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 text-sm bg-slate-50 outline-none">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-600 mb-2 uppercase tracking-wider">Customer Support Phone Number</label>
                                <input type="text" name="support_phone" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 text-sm bg-slate-50 outline-none">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-600 mb-2 uppercase tracking-wider">Customer Support Email</label>
                                <input type="email" name="support_email" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 text-sm bg-slate-50 outline-none">
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-xs font-bold text-slate-600 mb-2 uppercase tracking-wider">Full Office Address</label>
                                <textarea name="office_address" rows="2" placeholder="(Area, City, State, and PIN code)" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 text-sm bg-slate-50 outline-none"></textarea>
                            </div>
                        </div>

                        <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-xs font-bold text-slate-600 mb-2 uppercase tracking-wider">Business Logo (Image)</label>
                                <input type="file" name="logo" accept="image/*" class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-indigo-100 file:text-indigo-700 hover:file:bg-indigo-200">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-600 mb-2 uppercase tracking-wider">10 Product Images</label>
                                <input type="file" name="product_images[]" multiple accept="image/*" class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-indigo-100 file:text-indigo-700 hover:file:bg-indigo-200">
                                <p class="text-[10px] text-slate-400 mt-1">You can select up to 10 images.</p>
                            </div>
                        </div>

                        <div class="mt-6 p-4 bg-emerald-50 rounded-xl border border-emerald-100">
                            <p class="text-sm font-medium text-emerald-800 flex items-center gap-2">
                                <i data-lucide="check-circle" class="w-4 h-4"></i> 
                                Once you send all this, we’ll design and set up your website perfectly for you.
                            </p>
                        </div>
                    </div>

                @elseif($type === 'meta_ads')
                    <!-- Meta Ads Fields -->
                    <div class="bg-indigo-50/50 p-6 rounded-2xl border border-indigo-100 mb-6">
                        <p class="text-sm font-semibold text-indigo-800 mb-4">📌 Please send us the following details for Meta Ads Setup 👇</p>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-xs font-bold text-slate-600 mb-2 uppercase tracking-wider">Business Name <span class="text-red-500">*</span></label>
                                <input type="text" name="business_name" required class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 text-sm bg-slate-50 outline-none">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-600 mb-2 uppercase tracking-wider">Business WhatsApp Number</label>
                                <input type="text" name="whatsapp_number" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 text-sm bg-slate-50 outline-none">
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-xs font-bold text-slate-600 mb-2 uppercase tracking-wider">Full Office Address</label>
                                <textarea name="office_address" rows="2" placeholder="(Area, City, State, and PIN code)" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 text-sm bg-slate-50 outline-none"></textarea>
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-600 mb-2 uppercase tracking-wider">Facebook (Username & Password)</label>
                                <input type="text" name="facebook_credentials" placeholder="Username / Password" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 text-sm bg-slate-50 outline-none">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-600 mb-2 uppercase tracking-wider">Instagram (Username & Password)</label>
                                <input type="text" name="instagram_credentials" placeholder="Username / Password" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 text-sm bg-slate-50 outline-none">
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-xs font-bold text-slate-600 mb-2 uppercase tracking-wider">Business Logo (Image)</label>
                                <input type="file" name="logo" accept="image/*" class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-indigo-100 file:text-indigo-700 hover:file:bg-indigo-200">
                            </div>
                        </div>
                    </div>

                @elseif($type === 'google_ads')
                    <!-- Google Ads Fields -->
                    <div class="bg-indigo-50/50 p-6 rounded-2xl border border-indigo-100 mb-6">
                        <p class="text-sm font-semibold text-indigo-800 mb-4">📌 Please send us the following details for Google Ads Setup 👇</p>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-xs font-bold text-slate-600 mb-2 uppercase tracking-wider">Business Name <span class="text-red-500">*</span></label>
                                <input type="text" name="business_name" required class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 text-sm bg-slate-50 outline-none">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-600 mb-2 uppercase tracking-wider">Email ID</label>
                                <input type="email" name="email_id" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 text-sm bg-slate-50 outline-none">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-600 mb-2 uppercase tracking-wider">Business WhatsApp Number</label>
                                <input type="text" name="whatsapp_number" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 text-sm bg-slate-50 outline-none">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-600 mb-2 uppercase tracking-wider">Business Logo (Image)</label>
                                <input type="file" name="logo" accept="image/*" class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-indigo-100 file:text-indigo-700 hover:file:bg-indigo-200">
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-xs font-bold text-slate-600 mb-2 uppercase tracking-wider">Full Office Address</label>
                                <textarea name="office_address" rows="2" placeholder="(Area, City, State, and PIN code)" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 text-sm bg-slate-50 outline-none"></textarea>
                            </div>
                        </div>
                    </div>

                @elseif($type === 'seo')
                    <!-- SEO Fields -->
                    <div class="bg-indigo-50/50 p-6 rounded-2xl border border-indigo-100 mb-6">
                        <p class="text-sm font-semibold text-indigo-800 mb-4">📌 Please send us the following details for SEO (Search Engine Optimization) 👇</p>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-xs font-bold text-slate-600 mb-2 uppercase tracking-wider">Business Name <span class="text-red-500">*</span></label>
                                <input type="text" name="business_name" required class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 text-sm bg-slate-50 outline-none">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-600 mb-2 uppercase tracking-wider">Email ID</label>
                                <input type="email" name="email_id" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 text-sm bg-slate-50 outline-none">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-600 mb-2 uppercase tracking-wider">Website URL</label>
                                <input type="text" name="website_url" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 text-sm bg-slate-50 outline-none">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-600 mb-2 uppercase tracking-wider">Website Admin panel URL</label>
                                <input type="text" name="admin_url" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 text-sm bg-slate-50 outline-none">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-600 mb-2 uppercase tracking-wider">Username</label>
                                <input type="text" name="admin_username" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 text-sm bg-slate-50 outline-none">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-600 mb-2 uppercase tracking-wider">Password</label>
                                <input type="text" name="admin_password" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 text-sm bg-slate-50 outline-none">
                            </div>
                        </div>
                    </div>

                @else
                    <!-- Default Form -->
                    <div class="bg-indigo-50/50 p-6 rounded-2xl border border-indigo-100 mb-6">
                        <p class="text-sm font-semibold text-indigo-800 mb-4">📌 Please provide basic details for your {{ $serviceName }} project 👇</p>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-xs font-bold text-slate-600 mb-2 uppercase tracking-wider">Business / Brand Name <span class="text-red-500">*</span></label>
                                <input type="text" name="business_name" required class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 text-sm bg-slate-50 outline-none">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-600 mb-2 uppercase tracking-wider">Email ID</label>
                                <input type="email" name="email_id" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 text-sm bg-slate-50 outline-none">
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-xs font-bold text-slate-600 mb-2 uppercase tracking-wider">Phone / WhatsApp Number</label>
                                <input type="text" name="phone_number" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 text-sm bg-slate-50 outline-none">
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-xs font-bold text-slate-600 mb-2 uppercase tracking-wider">Project Details / Instructions</label>
                                <textarea name="project_details" rows="3" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 text-sm bg-slate-50 outline-none"></textarea>
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-xs font-bold text-slate-600 mb-2 uppercase tracking-wider">Attachments (If any)</label>
                                <input type="file" name="attachments[]" multiple class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-indigo-100 file:text-indigo-700 hover:file:bg-indigo-200">
                            </div>
                        </div>
                    </div>
                @endif
                
            </div>

            <div class="mt-8 pt-6 border-t border-slate-100 flex justify-end">
                <button type="submit" class="px-8 py-3.5 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl shadow-lg shadow-indigo-600/20 transition-all hover:-translate-y-0.5 flex items-center gap-2">
                    <i data-lucide="send" class="w-4 h-4"></i>
                    Submit Details
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
