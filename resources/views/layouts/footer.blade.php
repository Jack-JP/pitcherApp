
<footer class="footer">
  <div class="container">
    <div class="row">
      @lang('messages.disclamer')
    </div>
    <div class="row justify-content-center">
      <span class="text-muted">@lang('messages.rightsreserved')</span>
    </div>
  </div>
</footer>
<!-- Scripts -->

<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/header.js') }}"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

@yield('scripts')
</body>
</html>
