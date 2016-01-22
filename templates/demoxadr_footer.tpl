<br />
<div class="btn-group dropup">
  <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
    Action Menu <span class="caret"></span>
  </button>
  <ul class="dropdown-menu" role="menu">
    <li><a href="{$xadr.controller_path}?{$action_accessor}=HelloWorld">Hello, World!</a></li>
    <li><a href="{$xadr.controller_path}?{$action_accessor}=Secure">Authentication</a></li>
    <li><a href="{$xadr.controller_path}?{$action_accessor}=ExampleForm">Example Form</a></li>
    <li class="divider"></li>
    <li><a href="{$xadr.controller_path}?{$action_accessor}=TodoList">ToDo List</a></li>
  </ul>
</div>
