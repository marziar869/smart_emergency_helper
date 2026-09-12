# Smart Emergency Helper - কোড পরিবর্তন ও ফাইল রিপোর্ট (Code Change & File Report)

এই ডকুমেন্টে প্রজেক্টের প্রতিটি ফাইল, যেখান থেকে হার্ডকোডেড স্ট্যাটিক কোড ডিলিট/রিপ্লেস করা হয়েছে এবং নতুন যেসব ডায়নামিক কন্ট্রোলার, রুট, ও ভিউ তৈরি করা হয়েছে—তার বিস্তারিত ব্যাখ্যা দেওয়া হলো।

---

## 📁 ১. ডাটাবেজ ও সিডার (Database & Seeders)

### 🟢 `database/seeders/ServiceCategorySeeder.php` `[NEW]`
- **যে কাজ করা হয়েছে:**
  - নতুন সিডার তৈরি করে Emergency, Technical, এবং Home—এই ৩টি গ্রুপের মোট ৯টি সার্ভিসের ক্যাটাগরি ডাটাবেজে পপুলেট করার কোড লেখা হয়েছে।
- **ব্যাখ্যা:** পূর্বে সার্ভিসের নামগুলো ফর্ম বা রুটের অ্যারেতে শক্তভাবে লেখা (Hardcoded) ছিল। এখন ক্যাটাগরিগুলো ডাটাবেজে সংরক্ষণ করা হচ্ছে।

---

### 🟡 `database/seeders/DatabaseSeeder.php` `[MODIFIED]`
- **কোড ডিলিট/রিপ্লেস:**
  - পূর্বে ডিফল্ট টেস্টিং ইউজারের কোড বাদ দেওয়া হয়েছে।
- **নতুন যোগ করা কোড:**
  - `ServiceCategorySeeder` কল করা হয়েছে।
  - Admin Account (`admin@seh.com.bd`), Customer Account (`customer@seh.com.bd`), ৫টি Approved Provider Account (যেমন `rapidcare@seh.com.bd`, `voltfix@seh.com.bd`) এবং ১টি Pending Provider Account (`farzana.akter@seh.com.bd`) অটোমেটিক ডেমো ডাটা হিসেবে হ্যাশড পাসওয়ার্ডসহ তৈরি করা হয়েছে।
- **ব্যাখ্যা:** সিস্টেমের শুরুতেই যেন ডাটাবেজে বাস্তবসম্মত এডমিন, কাস্টমার ও প্রোভাইডার একাউন্ট প্রস্তুত থাকে।

---

## 📁 ২. মডেল লেয়ার (Models)

### 🟡 `app/Models/ServiceCategory.php` `[MODIFIED]`
- **নতুন যোগ করা কোড:**
  - `providerProfiles()` রিলেশনশিপ (One-to-Many) মেথড যোগ করা হয়েছে।
- **ব্যাখ্যা:** এর ফলে সার্ভিস ক্যাটাগরির সাথে যুক্ত সকল প্রোভাইডার প্রোফাইল সহজেই `ServiceCategory::withCount('providerProfiles')` দিয়ে ফেচ করা যায়।

---

## 📁 ৩. কন্ট্রোলার লেয়ার (Controllers)

### 🟢 `app/Http/Controllers/PublicPageController.php` `[NEW]`
- **যে কাজ করা হয়েছে:**
  - `home()`: হোম পেজের রিয়েল-টাইম রিকোয়েস্ট কাউন্ট, ভেরিফাইড প্রোভাইডার সংখ্যা, একটিভ ক্যাটাগরি ও টপ প্রোভাইডার ফেচ করে।
  - `services()`: ক্যাটাগরি অনুযায়ী সার্ভিস ও প্রোভাইডার কাউন্ট ডাইনামিক পাঠায়।
  - `providers()`: ডাইনামিক ফিল্টারিং (গ্রুপ, ক্যাটাগরি, এভেলেবিলিটি, সার্চ) সহ ডাটাবেজ থেকে প্রোভাইডারদের লিস্ট নিয়ে আসে।
  - `providerDetails($id)`: নির্দিষ্ট প্রোভাইডারের প্রাইমারি ID অনুযায়ী সম্পূর্ণ ডাটাবেজ প্রোফাইল নিয়ে আসে।
- **ব্যাখ্যা:** আগে পাবলিক পেজগুলোতে ডাইনামিক ডাটা আসত না, এখন ডাটাবেজ কোয়েরি দিয়ে ডাটা পেজে রেন্ডার হয়।

---

### 🟡 `app/Http/Controllers/EmergencyRequestController.php` `[MODIFIED]`
- **কোড ডিলিট/রিপ্লেস:**
  - পূর্বে মেথডগুলোর ভেতর কোনো ডাটাবেজ সেভিং বা ক্যাটাগরি ফেচিং লজিক ছিল না।
- **নতুন যোগ করা কোড:**
  - `create()`: ডাটাবেজ থেকে একটিভ সার্ভিস ক্যাটাগরি লোড করে ফর্মে পাঠায়।
  - `store()`: ফর্ম সাবমিট হলে ইউনিক রিকোয়েস্ট কোড (`REQ-XXXXXX`) জেনারেট করে `EmergencyRequest` টেবিলে সেভ করে। পাশাপাশি Recommendation Algorithm রান করে প্রোভাইডার অ্যাসাইন করে।
  - `showResult()`: সেভ হওয়া ইন-মেমোরি ও ডাটাবেজ রিকোয়েস্টের রিয়েল-টাইম ডিসপ্যাচ রেজাল্ট শো করে।
- **ব্যাখ্যা:** পূর্বে ইমার্জেন্সি ফর্ম সাবমিট করলে সেশনে ফেক এরে ডাটা সেভ হতো, এখন আসল ডাটাবেজ রেকর্ড তৈরি হয়।

---

### 🟢 `app/Http/Controllers/AdminDashboardController.php` `[NEW]`
- **যে কাজ করা হয়েছে:**
  - `index()`: এডমিন ড্যাশবোর্ডের সব KPI Metrics (Active Jobs, Providers Online, Total Users, Total Providers) রিয়েল ডাটাবেজ থেকে মেপে নিয়ে আসে।
  - `reviewVerification($id)`: পেন্ডিং প্রোভাইডারের ডাটাবেজ রেকর্ড লোড করে।
  - `approveVerification($id)` & `rejectVerification($id)`: এডমিন এক ক্লিকে প্রোভাইডার একাউন্ট Approved বা Rejected স্ট্যাটাসে ডাটাবেজে আপডেট করতে পারেন।
- **ব্যাখ্যা:** পূর্বে এডমিন ড্যাশবোর্ডে সেশন ডাটা `session('provider_applications')` ব্যবহার করা হতো, যা এখন ডাটাবেজ রিলেশন দ্বারা প্রতিস্থাপিত হয়েছে।

---

### 🟡 `app/Http/Controllers/ProviderRequestController.php` `[MODIFIED]`
- **কোড ডিলিট/রিপ্লেস:**
  - `reject()` মেথডের ভেতরের ডেবগিং কোড `dd($request, auth()->id());` ডিলিট করা হয়েছে।
- **নতুন যোগ করা কোড:**
  - রিকোয়েস্ট রিজেক্ট করার লজিক ঠিক করে ডাটাবেজে স্ট্যাটাস `rejected` সেভ করে রেসপন্স পাঠানোর ব্যবস্থা করা হয়েছে।

---

## 📁 ৪. রুট লেয়ার (Routes)

### 🟡 `routes/web.php` `[MODIFIED]`
- **ডিলিট/রিপ্লেস করা হার্ডকোডেড কোড:**
  1. `Route::get('/', fn() => view('home'))`
  2. `Route::get('/services', fn() => view('services'))`
  3. `Route::get('/providers', fn() => view('providers'))`
  4. `Route::get('/providers/rapid-care-ambulance', fn() => view('provider-details'))`
  5. Hardcoded arrays containing `$providerPools`, `$demoProviders`, and static session mocks in `/emergency-form` POST route.
  6. Hardcoded session-based closure in `/admin/dashboard` & `/admin/provider-verification/{provider}`.

- **নতুন যোগ করা রুটসমূহ:**
```php
// Dynamic Public Pages
Route::get('/', [PublicPageController::class, 'home'])->name('home');
Route::get('/services', [PublicPageController::class, 'services'])->name('services');
Route::get('/providers', [PublicPageController::class, 'providers'])->name('providers');
Route::get('/providers/{id}', [PublicPageController::class, 'providerDetails'])->name('providers.show');

// Dynamic Emergency Flow
Route::get('/emergency-form', [EmergencyRequestController::class, 'create'])->name('emergency.form');
Route::post('/emergency-form', [EmergencyRequestController::class, 'store'])->name('emergency.form.submit');
Route::get('/emergency-result', [EmergencyRequestController::class, 'showResult'])->name('emergency.result');

// Dynamic Admin Controls
Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
Route::get('/admin/provider-verification/{provider}', [AdminDashboardController::class, 'reviewVerification'])->name('admin.provider.verification.review');
Route::post('/admin/provider-verification/{provider}/approve', [AdminDashboardController::class, 'approveVerification'])->name('admin.provider.approve');
Route::post('/admin/provider-verification/{provider}/reject', [AdminDashboardController::class, 'rejectVerification'])->name('admin.provider.reject');
```

---

## 📁 ৫. ভিউ লেয়ার (Blade Views)

### 🟡 `resources/views/providers.blade.php` `[MODIFIED]`
- **ডিলিট কোড:** ২টি শক্তভাবে লেখা স্ট্যাটিক প্রোভাইডার কার্ড মুছে ফেলা হয়েছে।
- **নতুন কোড:** `@forelse($providers as $provider)` লুপের মাধ্যমে ডাটাবেজ থেকে ফিল্টার করা প্রোভাইডারদের ডাটা (স্কোর, অভিজ্ঞতা, রেটিং, স্ট্যাটাস) ডাইনামিক ডিসপ্লে করা হয়েছে।

### 🟡 `resources/views/provider-details.blade.php` `[MODIFIED]`
- **ডিলিট কোড:** `$provider['name']`, `$provider['category']` এর মতো হার্ডকোডেড এরে এক্সেস মুছে ফেলা হয়েছে।
- **নতুন কোড:** Eloquent Dynamic Objects (`$provider->user->name`, `$provider->serviceCategory->name`, `$provider->area`) দিয়ে পেজটিকে সাজানো হয়েছে।

### 🟡 `resources/views/services.blade.php` `[MODIFIED]`
- **ডিলিট কোড:** ৯টি সার্ভিস ক্যাটাগরির আলাদা আলাদা এইচটিএমএল ব্লক ডিলিট করা হয়েছে।
- **নতুন কোড:** `@foreach($serviceCategories as $groupName => $categories)` লুপ চালিয়ে ডাটাবেজ থেকে ক্যাটাগরি ও তাদের প্রোভাইডার কাউন্ট রেন্ডার করা হয়েছে।

### 🟡 `resources/views/admin/dashboard.blade.php` `[MODIFIED]`
- **ডিলিট কোড:** `42 ACTIVE JOBS`, `128 PROVIDERS ONLINE`, `PRV-1052` ইত্যাদি স্ট্যাটিক নাম ও সংখ্যা ডিলিট করা হয়েছে।
- **নতুন কোড:** ডায়নামিক ভ্যারিয়েবল (`$activeJobsCount`, `$providersOnlineCount`, `$providerApplications`) এবং পেন্ডিং এপ্লিকেশন ভেরিফিকেশন লুপ যোগ করা হয়েছে।

### 🟡 `resources/views/admin/provider-verification-review.blade.php` `[MODIFIED]`
- **ডিলিট কোড:** স্ট্যাটিক বাটনের ডিজেবল্ড স্টেট ও ফেক প্রোভাইডার এরে রিডিং ডিলিট করা হয়েছে।
- **নতুন কোড:** বাস্তব ডাটা উপস্থাপন এবং Approve ও Reject করার জন্য ইন্টারেক্টিভ HTML ফর্ম যোগ করা হয়েছে।

---

## 📊 সামারি টেবিল (Static vs Dynamic Comparison)

| ফিচার (Feature) | আগের অবস্থা (Static / Mock) | বর্তমান অবস্থা (Dynamic Database) |
| :--- | :--- | :--- |
| **ডাটা সোর্স (Data Source)** | Hardcoded Arrays, Session State | PostgreSQL Database Records |
| **সার্ভিস লিস্ট (Service Catalogue)** | static html elements | Database `service_categories` Table |
| **প্রোভাইডার ডিরেক্টরি** | Hardcoded Provider Card | `ProviderProfile` Eloquent Model Query & Filtering |
| **ইমার্জেন্সি রিকোয়েস্ট** | Session Memory array | Database `emergency_requests` Table with Reference |
| **এডমিন স্ট্যাটস (Admin KPIs)** | Fixed text numbers (e.g. 42, 128) | Dynamic DB Aggregations (`count()`) |
| **প্রোভাইডার এপ্রুভাল** | Fake visual interface | Working DB Action (`approval_status = 'approved'`) |
