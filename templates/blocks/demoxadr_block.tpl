<ul>
<{foreach item=i from=$block.todo}>
<li><a href="<{$block.controller}>?action=TodoDetail&amp;todo_id=<{$i.todo_id}>"><{$i.todo_subject}></a></li>
<{/foreach}>
</ul>
<{$block.message|default:''}>
