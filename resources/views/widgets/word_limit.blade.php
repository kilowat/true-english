<div class="limit-block">
    <div class="sort-cell">
        <label for="limit_select" class="limit-label">По:</label>
        <select class="browser-default" name="limit" id="limit_select">
            @foreach($limit_select as $limit)
                <option
                        value="{{ $limit["link"] }}"
                        {{ $limit["selected"] ? 'selected="selected"' : '' }}>
                    {{ $limit["name"] }}
                </option>
            @endforeach
        </select>
    </div>
</div>
@section("js")
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelectorAll('#limit_select');
        var instances = M.FormSelect.init(elems);
    });
    $("#limit_select").on('change', function() {
        location.href = $(this).val();
    });
</script>
@endsection