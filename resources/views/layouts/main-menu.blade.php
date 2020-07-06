{{-- BEGIN: Main Menu --}}
<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
  <div class="main-menu-content">
    <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
      <li class=" navigation-header">
        <span>Utama</span><i class=" feather icon-minus" data-toggle="tooltip" data-placement="right" data-original-title="Utama"></i>
      </li>
      @php
      foreach ($menu_list as $menu) {
        echo '<li class=" nav-item ';
        if (url()->current() == url($menu->menu_link)) {
          echo 'active';
        }
        if ($menu->menu_child == 1) {
          echo "has-sub";
        }
        echo '"><a href="'.url($menu->menu_link).'"><i class="'.$menu->menu_icon.'"></i><span class="menu-title" data-i18n="'.$menu->menu_name.'">'.$menu->menu_name.'</span></a>';
        if ($menu->menu_child == 1) {
          echo '<ul class="menu-content">';
          foreach ($menu->sub_child as $child_menu) {
            echo '<li ';
            if (url()->current() == url($child_menu->menu_link)) {
              echo 'class="active"';
            }
            echo '><a class="menu-item" href="'.url($child_menu->menu_link).'" data-i18n="'.$child_menu->menu_name.'">'.$child_menu->menu_name.'</a></li>';
          }
          echo '</ul>';
        }
        echo '</li>';
      }
      @endphp
    </ul>
  </div>
</div>
{{-- END: Main Menu --}}