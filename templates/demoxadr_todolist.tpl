<{include file="module:demoxadr/demoxadr_header.tpl"}>
<table  class="table table-striped">
	<thead>
		<tr>
			<td class='head'>Subject</td>
			<td class='head' width="17%">Input Date</td>
			<td class='head' width="17%">Total Time</td>
			<td class='head' width="12%">Status</td>
			<td class='head' width="8%">Control</td>
		</tr>
	</thead>
	<tbody>
	<{foreach item=i from=$todo}>
		<tr class="<{cycle values="odd,even"}>">
			<td><a href="index.php?action=TodoDetail&amp;todo_id=<{$i.todo_id}>"><{$i.todo_subject}></a></td>
			<td><{$i.todo_input_date|date_format:"%Y/%m/%d %H:%M"}></td>
			<td>
				<{if $i.todo_total_time}>
					<{$i.total_time}>
				<{else}>
					---
				<{/if}>
			</td>
			<td><{$i.status}></td>
			<td>
				<a href="index.php?action=TodoEdit&amp;todo_id=<{$i.todo_id}>"><img src="<{$imagedir}>edit.png" alt="Edit" title="Edit" /></a>
				<a href="index.php?action=TodoDelete&amp;todo_id=<{$i.todo_id}>"><img src="<{$imagedir}>delete.png" alt="Delete" title="Delete" /></a>
			</td>
		</tr>
	<{/foreach}>
	</tbody>
</table>

<{$list.navigation|default:''}>
<p></p>
<p><a class="btn btn-success" type="button" href="index.php?action=TodoEdit">Add New Todo</a></p>

<{include file="module:demoxadr/demoxadr_footer.tpl"}>
