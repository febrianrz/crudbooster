@include("crudbooster::emails.header")

{!!$content!!}
{{trans("crudbooster.email_footer")}}
@include("crudbooster::emails.footer")
