{if $inactive}
<div class="page-header">
	<h1>{$LANG.affiliatestitle}</h1>
</div>

<div class="alert alert-warning">
	{$LANG.affiliatesdisabled}
</div>
{else}

<div class="page-header">
	<h1>{$LANG.affiliatestitle} <small>{$LANG.affiliatesrealtime}</small></h1>
</div>

<div class="row">
	<div class="col-md-10 col-md-offset-1">
		<div class="text-center">
			<h3>{$LANG.affiliatesreferallink}</h3>
			<div class="panel panel-default">
				<div class="panel-body text-center">
					<span class="lead">{$referrallink}</span>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row text-center">
	<div class="col-md-10 col-md-offset-1">
		<div class="row">
			<div class="col-md-4">
				<div class="well">
					<h4>{$LANG.affiliatesvisitorsreferred}</h4>
					<span class="lead">{$visitors}</span>
				</div>
			</div>
			<div class="col-md-4">
				<div class="well">
					<h4>{$LANG.affiliatessignups}</h4>
					<span class="lead">{$signups}</span>
				</div>
			</div>
			<div class="col-md-4">
				<div class="well">
					<h4>{$LANG.affiliatesconversionrate}</h4>
				 	<span class="lead">{$conversionrate}%</span>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-6 col-md-offset-3">
		<div class="panel panel-default">
			<table class="table table-striped">
				<tbody>
					<tr>
						<td>{$LANG.affiliatescommissionspending}</td>
						<td class="text-center"><strong>{$pendingcommissions}</strong></td>
					</tr>
					<tr>
						<td>{$LANG.affiliatescommissionsavailable}</td>
						<td class="text-center"><strong>{$balance}</strong></td>
					</tr>
					<tr>
						<td>{$LANG.affiliateswithdrawn}:</td>
						<td class="text-center"><strong>{$withdrawn}</strong></td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>

{if $withdrawrequestsent}
<div class="alert alert-success alert-dismissable">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	{$LANG.affiliateswithdrawalrequestsuccessful}
</div>
{elseif $withdrawlevel}
<div class="text-center">
	<a href="{$smarty.server.PHP_SELF}?action=withdrawrequest" class="btn btn-lg btn-primary" title="{$LANG.affiliatesrequestwithdrawal}">{$LANG.affiliatesrequestwithdrawal}</a>
</div>
{/if}

<div class="page-header">
	<h2>{$LANG.affiliatesreferals}</h2>
</div>

<p>{$numitems} {$LANG.recordsfound}, {$LANG.page} {$pagenumber} {$LANG.pageof} {$totalpages}</p>

<div class="panel panel-default">
	<table class="table table-striped table-sorted">
		<thead>
			<tr>
				<th{if $orderby eq "date"} class="sort-{$sort}"{/if}><a href="affiliates.php?orderby=date">{$LANG.affiliatessignupdate}</a></th>
				<th{if $orderby eq "product"} class="sort-{$sort}"{/if}><a href="affiliates.php?orderby=product">{$LANG.orderproduct}</a></th>
				<th{if $orderby eq "amount"} class="sort-{$sort}"{/if}><a href="affiliates.php?orderby=amount">{$LANG.affiliatesamount}</a></th>
				<th>{$LANG.affiliatescommission}</th>
				<th{if $orderby eq "status"} class="sort-{$sort}"{/if}><a href="affiliates.php?orderby=status">{$LANG.affiliatesstatus}</a></th>
			</tr>
		</thead>
		<tbody>
			{foreach key=num item=referral from=$referrals}
			<tr>
				<td>{$referral.date}</td>
				<td>{$referral.service}</td>
				<td>{$referral.amountdesc}</td>
				<td>{$referral.commission}</td>
				<td>{$referral.status}</td>
			</tr>
			{foreachelse}
			<tr>
				<td colspan="5" class="text-center">{$LANG.norecordsfound}</td>
			</tr>
			{/foreach}
		</tbody>
	</table>
</div>

<ul class="pagination">
	<li{if !$prevpage} class="disabled"{/if}><a href="{if $prevpage}affiliates.php?page={$prevpage}{else}javascript:return false;{/if}">&larr; {$LANG.previouspage}</a></li>
	<li{if !$nextpage} class="disabled"{/if}><a href="{if $nextpage}affiliates.php?page={$nextpage}{else}javascript:return false;{/if}">{$LANG.nextpage} &rarr;</a></li>
</ul>

{if $affiliatelinkscode}
<div class="page-header">
	<h2>{$LANG.affiliateslinktous}</h2>
</div>

<div class="text-center">
	{$affiliatelinkscode}
</div>
{/if}


{/if}
