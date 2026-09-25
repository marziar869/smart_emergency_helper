@extends('layouts.app')

@section('title', 'Provider Verification Review')

@section('content')

<style>
.review-wrapper {
    max-width: 680px;
    margin: 40px auto;
    padding: 0 16px;
}
.review-card {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    padding: 24px;
    box-shadow: 0 1px 3px rgba(0,0,0,0.05);
}
.review-top {
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-bottom: 1px solid #f1f5f9;
    padding-bottom: 16px;
    margin-bottom: 20px;
}
.review-top h1 {
    font-size: 18px;
    font-weight: 800;
    color: #0f172a;
    margin: 0;
}
.review-top a {
    font-size: 12px;
    font-weight: 600;
    color: #64748b;
    text-decoration: none;
}
.review-top a:hover {
    color: #dc2626;
}
.info-table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
    font-size: 13px;
}
.info-table td {
    padding: 8px 0;
    border-bottom: 1px solid #f8fafc;
}
.info-table td.label {
    width: 35%;
    color: #64748b;
    font-weight: 600;
}
.info-table td.value {
    color: #0f172a;
    font-weight: 700;
}
.status-pill {
    display: inline-block;
    padding: 2px 8px;
    border-radius: 4px;
    font-size: 11px;
    font-weight: 800;
    text-transform: uppercase;
}
.status-pending { background: #fef3c7; color: #92400e; }
.status-approved { background: #dcfce7; color: #166534; }
.status-rejected { background: #fee2e2; color: #991b1b; }

.form-group {
    margin-top: 16px;
    margin-bottom: 20px;
}
.form-group label {
    display: block;
    font-size: 12px;
    font-weight: 700;
    color: #334155;
    margin-bottom: 6px;
}
.form-control {
    width: 100%;
    min-height: 80px;
    padding: 10px;
    font-size: 13px;
    border: 1px solid #cbd5e1;
    border-radius: 6px;
    box-sizing: border-box;
    font-family: inherit;
    resize: vertical;
}
.form-control:focus {
    outline: none;
    border-color: #0f172a;
}
.action-buttons {
    display: flex;
    gap: 12px;
}
.btn-approve, .btn-reject {
    flex: 1;
    padding: 10px 16px;
    font-size: 13px;
    font-weight: 800;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    text-align: center;
    transition: opacity 0.15s;
}
.btn-approve {
    background: #059669;
    color: #ffffff;
}
.btn-approve:hover {
    background: #047857;
}
.btn-reject {
    background: #dc2626;
    color: #ffffff;
}
.btn-reject:hover {
    background: #b91c1c;
}
</style>

<div class="review-wrapper">
    <div class="review-card">
        <div class="review-top">
            <div>
                <h1>Provider Verification</h1>
                <small style="color:#64748b;">Review and approve/reject provider profile</small>
            </div>
            <a href="{{ route('admin.dashboard') }}">&larr; Back to Dashboard</a>
        </div>

        <table class="info-table">
            <tr>
                <td class="label">Provider Name</td>
                <td class="value">{{ $profile->user?->name ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td class="label">Email Address</td>
                <td class="value">{{ $profile->user?->email ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td class="label">Phone Number</td>
                <td class="value">
                    {{ $profile->user?->phone ?? 'N/A' }}
                    @if($profile->phone_verified)
                        <span style="color:#16a34a; font-size:11px; margin-left:6px; font-weight:700;">(OTP Verified)</span>
                    @else
                        <span style="color:#d97706; font-size:11px; margin-left:6px; font-weight:700;">(OTP Pending)</span>
                    @endif
                </td>
            </tr>
            <tr>
                <td class="label">Service Category</td>
                <td class="value">{{ $profile->serviceCategory?->name ?? 'General Service' }}</td>
            </tr>
            <tr>
                <td class="label">Experience</td>
                <td class="value">{{ $profile->experience_years ?? 0 }} Years</td>
            </tr>
            <tr>
                <td class="label">Area</td>
                <td class="value">{{ $profile->area ?? ($profile->user?->area ?? 'N/A') }}</td>
            </tr>
            <tr>
                <td class="label">Address</td>
                <td class="value">{{ $profile->address ?? ($profile->user?->address ?? 'N/A') }}</td>
            </tr>
            <tr>
                <td class="label">Registration Date</td>
                <td class="value">{{ $profile->created_at ? $profile->created_at->format('M d, Y h:i A') : 'Recently' }}</td>
            </tr>
            <tr>
                <td class="label">Current Status</td>
                <td class="value">
                    <span class="status-pill status-{{ $profile->approval_status ?? 'pending' }}">
                        {{ strtoupper($profile->approval_status ?? 'pending') }}
                    </span>
                </td>
            </tr>
        </table>

        <form method="POST">
            @csrf
            <div class="form-group">
                <label for="admin_comment">Comments / Notes</label>
                <textarea id="admin_comment" name="admin_comment" class="form-control" placeholder="Write any comments, instructions, or rejection reason here...">{{ old('admin_comment', $profile->admin_comment) }}</textarea>
            </div>

            <div class="action-buttons">
                <button type="submit" formaction="{{ route('admin.provider.approve', $profile->id) }}" class="btn-approve">
                    Approve Provider
                </button>
                <button type="submit" formaction="{{ route('admin.provider.reject', $profile->id) }}" class="btn-reject">
                    Reject Provider
                </button>
            </div>
        </form>
    </div>
</div>

@endsection