<meta name="csrf-token" content="{{ csrf_token() }}">


<div id="log-in">
<print-gafete :id_record="{{ $id_record }}" >
</print-gafete>
</div>
{{-- este es un cambio son nececidad --}}
<script src="{{ mix('js/app.js') }}"></script>