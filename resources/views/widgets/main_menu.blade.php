    <ul class="main-menu">
        @foreach($config as $item)
        <li>
            <a href="{{ $item["link"]  }}"
               class="{{ $item["selected"] ? 'selected' : '' }}">{{ $item["name"]  }}</a>
        </li>

        @endforeach
    </ul>