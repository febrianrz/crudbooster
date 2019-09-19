# Select2 Form Type

### Select2 Form View
Digunakan untuk membuat select2 otomatis via view html,
Pada versi ini belum mensupport server sidenya, jadi masih harus membuat route yg mengembalikan select2 json.

```html
@include('crudbooster::components.select2',[
    'label' => 'Kota',
    'name'  => 'kota_id',
    'route' => route('api.master.data','kota'),
    {{--  'default'=> [1,'Uji Coba']  Kalau ada default valuenya, id, label  --}}
])
```