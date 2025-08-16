<script src='{{ URL::asset('assets/libs/choices.js/public/assets/scripts/choices.min.js') }}'></script>
<script src="{{ URL::asset('assets/libs/@popperjs/core/umd/popper.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/tippy.js/tippy-bundle.umd.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/prismjs/prism.js') }}"></script>
<script src="{{ URL::asset('assets/libs/lucide/umd/lucide.js') }}"></script>
<script src="{{ URL::asset('assets/js/tailwick.bundle.js') }}"></script>

<!-- J Query -->
<script src="{{ URL::asset('assets/js/datatables/jquery-3.7.0.js') }}"></script>

<!-- Select2 -->
<script src="{{ asset('assets/js/select2.min.js') }}"></script>

<!-- App js -->
<script src="{{ URL::asset('assets/js/app.js') }}"></script>
<!-- Sweet Alert Template Script -->
@include('layouts.sweet-alerts')
@stack('scripts')