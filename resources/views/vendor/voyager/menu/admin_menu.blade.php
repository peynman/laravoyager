<ul class="nav navbar-nav">

@php
    if (Voyager::translatable($items)) {
        $items = $items->load('translations');
    }
@endphp

@foreach ($items as $item)
        @php
            $link = \App\Models\MenuItem::getLink($item, $options);
            if ($link[5]) {
                continue;
            }
            $listItemClass = $link[0];
            $styles = $link[1];
            $linkAttributes = $link[2];
            $transItem = $link[3];
            $hasChildren = $link[4];
        @endphp

    <li class="{{ implode(" ", $listItemClass) }}">
        <a style="display: inline; margin-right: 20px;"  {!! $linkAttributes !!} target="{{ $item->target }}" style="color:{{ (isset($item->color) && $item->color != '#000000' ? $item->color : '') }}">
            <span class="icon {{ $item->icon_class }}"></span>
            <span class="title">
                {{ $transItem->title }}
            </span>
            <span class="subtitle">
            @if ($item->relatives)
                    @foreach($item->relatives as $item_option)
                        @php
                            $link = \App\Models\MenuItem::getLink($item_option, $options);
                            if ($link[5]) {
                                continue;
                            }
                            $listItemClass = $link[0];
                            $styles = $link[1];
                            $linkAttributes = $link[2];
                            $transItem = $link[3];
                            $hasChildren = $link[4];
                        @endphp

                        <button style="display: inline; margin-right: 20px;"  class="btn btn-secondary btn-icon btn-sm btn-circle btn-label" {!! $linkAttributes !!} target="{{ $item_option->target }}" style="color:{{ (isset($item_option->color) && $item_option->color != '#000000' ? $item_option->color : '') }}">
                            <i class="{{ $item_option->icon_class }}"></i>
                    </button>
                    @endforeach
                @endif
            </span>
        </a>
        @if($hasChildren)
            <div id="{{ $transItem->id }}-dropdown-element" class="panel-collapse collapse {{ (in_array('active', $listItemClass) ? 'in' : '') }}">
                <div class="panel-body">
                    @include('voyager::menu.admin_menu', ['items' => $item->children, 'options' => $options, 'innerLoop' => true])
                </div>
            </div>
        @endif
    </li>
@endforeach

</ul>
