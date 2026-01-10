  <li class="nav-item  {{ request()->url() == $route ? 'active' : '' }}">
      <a class="nav-link" href="{{ $route }}">
          <span class="menu-title">{{ $name }}</span>
          <i class="mdi mdi-{{ $icon }} menu-icon"></i>
      </a>
  </li>
