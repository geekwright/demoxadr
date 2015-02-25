<{include file="module:demoxadr/demoxadr_header.tpl"}>

<{$body}>

<dl class="dl-horizontal">
<dt>Subject</dt><dd><{$todo.todo_subject}></dd>
<dt>Description</dt><dd><{$todo.todo_description}></dd>
<dt>User</dt><dd><{$todo.uname}></dd>
<dt>Input Date</dt><dd><{$todo.input_date}></dd>
<dt>Total Time</dt><dd>
	<{if $todo.todo_total_time}>
		<{$todo.total_time}>
	<{else}>
		---
	<{/if}>
</dd>
<dt>Status</dt><dd><{$todo.status}></dd>
</dl>

<{include file="module:demoxadr/demoxadr_footer.tpl"}>
