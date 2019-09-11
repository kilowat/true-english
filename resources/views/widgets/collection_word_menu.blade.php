<div class="collection-word-menu">
    <ul>
        @foreach ($items as $item)
            <li><a href="{{ $item->link }}">{{ $item->name }}</a></li>
        @endforeach
    </ul>
</div>