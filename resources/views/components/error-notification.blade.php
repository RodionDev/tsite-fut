@if($errors->all())
<section id="error-bar">
    <div id="modal1" class="modal modal-default-open">
        <div class="modal-content">
            <h4>Error</h4>
            @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
            @endforeach
        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-close waves-effect waves-green btn-flat">Oke</a>
        </div>
    </div>
</section>
@endif
