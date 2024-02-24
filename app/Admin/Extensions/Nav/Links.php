<?php

namespace App\Admin\Extensions\Nav;

class Links
{
  public function __toString()
  {
    return <<<HTML
  <li class="dropdown messages-menu">
     <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
      <i class="fa fa-envelope-o"></i>
      <span class="label label-success">4</span>
    </a>
  <ul class="dropdown-menu">
    <li class="header">You have 4 messages</li>
    <li>

      <ul class="menu">
      <li>
      <a href="#">
      <h4>
      Support Team
      </h4>
      <p>Why not buy a new awesome theme?</p>
      </a>
      </li>

    
      </ul>
  </li>
  
  </ul>
  </li>

<li>
    <a href="/demo/posts">
      <i class="fa fa-bell-o"></i>
      <span class="label label-warning">7</span>
    </a>
</li>

<li>
    <a href="/demo/users" no-pjax>
      <i class="fa fa-flag-o"></i>
      <span class="label label-danger">9</span>
    </a>
</li>

HTML;
  }
}
