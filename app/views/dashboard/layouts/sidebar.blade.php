<div class="sidebar">
  
  <div class="user">
    <a href="{{url('/dashboard/me')}}"><i class="fa fa-user"></i> {{Sentry::getUser()->first_name}}</a>
  </div>

  <ul class="nav nav-pills nav-stacked">
    @foreach ($sidebar as $item)
      @if (is_array($item))
        <li class="{{ $item['class'] }}">
          <a href="{{ $item['link'] }}">
            <i class="{{ $item['icon'] }}"></i>
            <span>
              {{ $item['name'] }}
            </span>
          </a>
        </li>
      @else
        <li class="separator"></li>
      @endif
    @endforeach
  </ul>
  
</div>