@if(session('errors'))
    @foreach(session('errors')->all() as $error)
        <div class="status-bar status-error">{{ $error }}</div>
    @endforeach
@endif

@if(session('success'))
    <div class="status-bar status-success">{{ session('success') }}</div>
@endif

@if(session('error'))
    <div class="status-bar status-error">{{ session('error') }}</div>
@endif

@if(session('status'))
    <div class="status-bar status-success">{{ session('status') }}</div>
@endif
