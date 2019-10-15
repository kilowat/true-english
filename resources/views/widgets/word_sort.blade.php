<div class="sort-block">
    @foreach($sort as $sort_key => $sort_item)
        <div class="sort-cell">
            <span class="sort-name">{{ $sort_item["name"] }}:</span>
            <span class="sort-arrow">
                <a href="{{ $sort_item["asc"]["link"] }}" class="{{ $sort_item["asc"]["selected"] ? 'selected' : '' }}"><i class="material-icons dp48">arrow_downward</i></a>
                <a href="{{ $sort_item["desc"]["link"] }}" class="{{ $sort_item["desc"]["selected"] ? 'selected' : '' }}"><i class="material-icons dp48">arrow_upward</i></a>
            </span>
        </div>
    @endforeach
</div>