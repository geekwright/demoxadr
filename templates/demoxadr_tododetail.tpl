<{include file="module:demoxadr/demoxadr_header.tpl"}>

<dl class="dl-horizontal">
		<dt>Description</dt>
		<dd><{$todo.todo_description}></dd>
		<dt>Input Date</dt>
		<dd><{$todo.todo_input_date|date_format:"%Y/%m/%d %H:%M"}></dd>
		<dt>Total Time</dt>
		<dd>
			<{if $todo.todo_total_time}>
				<{$todo.total_time}>
			<{else}>
				---
			<{/if}>
		</dd>
		<dt>Status</dt>
		<dd><{$todo.status}></dd>
		<dt>Control</dt>
		<dd>
<{if !$todo.todo_lock_id}>
			<form action="index.php?action=TodoFlipStatus" method="post" style="display:inline;">
					<input type="hidden" name="todo_id" value="<{$todo.todo_id}>">
					<{$security_token}>
					<input type="submit" class="btn btn-warning" value="Change Status">
			</form>
<{/if}>
<{if $todo.todo_active}>
	<{if $todo.todo_lock_id}>
			<form action="index.php?action=TodoEndWork" method="post" style="display:inline;">
					<input type="hidden" name="todo_id" value="<{$todo.todo_id}>">
					<{$security_token}>
					<input type="submit" class="btn btn-danger" value="End Work">
			</form>
	<{else}>
			<form action="index.php?action=TodoStartWork" method="post" style="display:inline;">
					<input type="hidden" name="todo_id" value="<{$todo.todo_id}>">
					<{$security_token}>
					<input type="submit" class="btn btn-success" value="Start Work">
			</form>
	<{/if}>
<{/if}>
		</dd>
</dl>

<h2>Working Log</h2>

<table class="table table-hover">
	<thead>
	<tr>
		<td class='head'>Start Time</td>
		<td class='head'>End Time</td>
		<td class='head'>Work Time</td>
	</tr>
	</thead>
	<tbody>
<{if $logs|default:false}>
<{foreach item=i from=$logs}>
		<tr class="<{cycle values="odd,even"}>">
			<td>
				<{$i.log_start_time|date_format:"%Y/%m/%d %H:%M"}>
			</td>
			<td>
				<{if $i.log_end_time}>
					<{$i.log_end_time|date_format:"%Y/%m/%d %H:%M"}>
				<{else}>
					---
				<{/if}>
			</td>
			<td>
				<{if $i.log_work_time}>
					<{$i.work_time}>
				<{else}>
					---
				<{/if}>
			</td>
		</tr>
<{/foreach}>
<{/if}>
	</tbody>
</table>

<{include file="module:demoxadr/demoxadr_footer.tpl"}>
