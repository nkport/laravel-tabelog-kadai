<footer class="footer flex-box justify-between align-end">
    <small><a class="text-link" href="{{ url('/') }}">&copy; <span id="currentYear"></span> {{ config('app.name', 'Laravel') }}</a></small>
    <nav>
        <ul>
            {{-- <li><a class="text-link" href="{{ route('about.show') }}">{{ trans('messages.introduction_title') }}</a></li> --}}
            <li><a class="text-link" href="{{ route('terms.show') }}">{{ trans('messages.footer_nav_terms') }}</a></li>
            <li><a class="text-link" href="{{ route('company.show') }}">{{ trans('messages.footer_nav_company') }}</a></li>
            <li><a class="text-link" href="{{ route('company.show') }}#contact">{{ trans('messages.footer_nav_contact') }}</a></li>
            <li><a class="text-link" href="{{ route('policy.show') }}">{{ trans('messages.footer_nav_policy') }}</a></li>
        </ul>
    </nav>
</footer>