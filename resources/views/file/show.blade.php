@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Video/Audio player</div>
                <div class="card-body">
                    <div id="fileLink" data-url="{{ $file->url }}" class="hidden"></div>
                    <div id="file-player">Loading....</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jwplayer.com/libraries/vQNzhNXt.js"></script>
<script>
  $(document).ready(function() {
    jwplayer("file-player").setup({
        "file": $('#fileLink').data('url')
    });
  });
</script>
@endsection
