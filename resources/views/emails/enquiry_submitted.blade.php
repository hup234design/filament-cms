<x-mail::message>
# {{ config('app.name') }} Enquiry
Enquiry been submitted at {{ $enquiry->created_at->format('g:ia \o\n D jS M Y') }}.

Name: **{{ $enquiry->name }}**

Email: **{{ $enquiry->email }}**

Telephone: **{{ $enquiry->telephone ?? '-' }}**

How did you hear about us: **{{ $enquiry->referral ?? '-' }}**

Subject: **{{ $enquiry->subject }}**

{!! nl2br($enquiry->message) !!}

---

*IP Address: {{ $enquiry->ip_address }}*


{{ config('app.name') }}<br>
{{ config('app.url') }}
</x-mail::message>
