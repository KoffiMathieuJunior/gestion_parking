<div class="row">
    @if(session('error'))
        <div class="col-12 text-bg-danger p-2 mb-3 rounded">
            <div>{{ session('error') }}</div>
        </div>
    @endif

    @if(session('success'))
        <div class="col-12 text-bg-success p-2 mb-3 rounded">
            <div>{{ session('success') }}</div>
        </div>
    @endif
</div>