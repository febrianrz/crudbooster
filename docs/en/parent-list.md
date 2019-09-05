### Digunakan untuk parent list pada list (detail nya) (header detail)
```php
$parent = \App\Model::findOrFail(g('parent_id'));
$this->parent_list = [
    [
        "label"		=> "Kode SIPLOG",
        "value"		=> $parent->plProses->siplogHeader->id_proses,
    ],
    [
        "label"		=> "Paket Pengadaan",
        "value"		=> $parent->plProses->siplogHeader->paket_pengadaan
    ],
    [
        "label"		=> "Nilai HPS",
        "value"		=> $parent->plProses->siplogHeader->nilai_abpp_label
    ],
    [
        "label"		=> "Jenis Negosiasi",
        "value"		=> $parent->plProses->jenis->nama
    ],
    [
        "label"		=> "Status",
        "value"		=> $parent->plProses->status_label
    ],
    [
        "label"		=> "State",
        "value"		=> ($parent->penawaranHeader()->first()->source == 1 ? 'Vendor' : 'Admin'),
    ],
    [
        "label"		=> "Keterangan",
        "value"		=> '*Harga sudah termasuk PPN',
    ],
    [
        "label"		=> "Submit",
        "value"		=> 'Submit',
        'type'		=> 'button',
        'class'		=> 'btn-sm btn_confirm',
        'title'		=> 'Apakah Anda yakin ingin mensubmit penawaran ini?',
        'url'		=> route('pl.penawaran.submit',$parent->id),
        'color'		=> 'success',
        'icon'		=> 'fa-save',
        'label'		=> 'Submit',
        'showIf'	=> $showSubmit,
    ],
    [
        "label"		=> "Butuh Bantuan?",
        "value"		=> 'Baca Halaman Bantuan',
        "type"		=> 'url',	
        'url'		=> url('/panel/siplog_user_guides?q=Panduan Negosiasi'),
        'target'	=> '_blank',
        'icon'		=> 'fa-info-circle',
        'showIf'	=> true,
    ],
];
```