@props(['url'])
<tr>
<td class="header">
  <a class="navbar-brand fw-bold text-primary d-flex align-items-center" href="{{ url('/') }}">
      <i class="bi bi-scissors"></i>
      <span style="font-size: 1.6rem;">Sal<span class="text-white">OOn</span></span>
  </a>
{{--  
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="https://laravel.com/img/notification-logo.png" class="logo" alt="Laravel Logo">
@else
{{ $slot }}
@endif
</a>--}}
</td>
</tr>
