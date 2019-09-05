<div class="form-group">
    <label for=""><h5>{{ $label }}</h5></label>
    <select name="{{ $name }}" id="id-{{ $name }}" class="form-control {{ isset($class)?$class:null }}" style="width:100%">
        @if(isset($default) && is_array($default))
        <option value="{{ $default[0] }}">{{ $default[1] }}</option>
        @endif
    </select>
</div>

@push('bottom')
<link rel="stylesheet" href="{{ asset('vendor/crudbooster/assets/select2/dist/css/select2.min.css') }}">
<style type="text/css">
    .select2-container--default .select2-selection--single {
        border-radius: 0px !important
    }

    .select2-container .select2-selection--single {
        height: 35px
    }

    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        background-color: #3c8dbc !important;
        border-color: #367fa9 !important;
        color: #fff !important;
    }

    .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
        color: #fff !important;
    }
</style>
<script src="{{ asset('vendor/crudbooster/assets/select2/dist/js/select2.full.min.js') }}"></script>
<script>
    $("#id-{{ $name }}").select2({
        ajax: {
            url: "{{ $route }}",
            data: function (param) {
                param['format']     = 'select2';
                return param;
            }
        },

        allowClear: true,
        placeholder: '',
    });
</script>
@endpush