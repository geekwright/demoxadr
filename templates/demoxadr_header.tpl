<{if isset($err_message)}>
	<{$err_message}>
<{/if}>
<{$xp_breadcrumb}>
<{if isset($warning_message)}>
	<div class="alert alert-warning"><{$warning_message}></div>
<{/if}>
<{if isset($message)}>
    <div class="alert alert-success"><{$message}></div>
<{/if}>
<h1><{$title}></h1>
