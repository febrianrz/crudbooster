<div class="modal fade" id="{{ $modal_id }}" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog {{ $modal_size }}" role="document">
        <form action="{{ isset($modal_action)?$modal_action:null }}" class="form" method="{{ isset($modal_method)?$modal_method:'GET' }}"  enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel-{{ $modal_id }}">
                        @yield('title')
                    </h4>
                </div>
                
                <div class="modal-body" style="padding-left: 10px;padding-right:10px">
                    
                    @yield('modal_content')
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                
            </div>
        </form>
    </div>
</div>