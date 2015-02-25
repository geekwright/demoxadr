<{if $err_message|default:false}>
	<{$err_message}>
<{/if}>
<{$xp_breadcrumb}>
<{if $warning_message|default:false}>
	<div class="alert alert-warning"><{$warning_message}></div>
<{/if}>
<{if $message|default:false}>
    <div class="alert alert-success"><{$message}></div>
<{/if}>
<h1><{$title}></h1>
