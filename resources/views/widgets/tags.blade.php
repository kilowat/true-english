<div class="tags-block">
    <div class="tag-h">
        Поиск по тегам
    </div>
    <div class="tag-list">
        @foreach($tags as $tag_item)
            <a href="{{ $tag_item["url"] }}" class="{{ $tag_item["active"] ? 'active' : '' }}" title="{{ $tag_item["tag"]->name }}">{{ $tag_item["tag"]->name }}</a>
        @endforeach
    </div>
</div>