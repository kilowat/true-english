
<div class="collection-word-menu">
    <ul>
        @foreach ($items as $item)
            <li><a href="{{ $item->link }}" class="{{ $item->selected  ? "selected" : ""}}">{{ $item->name }}</a></li>
        @endforeach
    </ul>
</div>