@if ($subcomments->count())
    @foreach ($subcomments as $subcomment)
        <script>
        $('#beybal'+{{$subcomment->id}}).hide();
        $('#agal{{$subcomment->id}}').on('click', function() {
            $('#beybal{{$subcomment->id}}').toggle();
});
    </script>
    @include('other.nigare',['subcomments' => $subcomment->subcomments])
    @endforeach
@endif
