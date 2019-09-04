<div class="trailer-contents">

	<div class="row">
		<div class="col-md-6">
			<div class="row">
				<div class="col-md-6">
					<div class="mb-4" id="lease_expense_chart">
						{!! $leaseExpenseChart !!}
					</div>
				</div>
				<div class="col-md-6">
					<div class="mb-4" id="Total_Maintenance_Expense">
						{!! $TotalMaintenanceExpense !!}
					</div>
				</div>
				<div class="col-md-6">
					<div class="mb-4" id="Total_trailer_count_owned">
						{!! $TrailerLeasedCountAndOwned !!}
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<header class="heading">
				<h3 class="title text-right">Trailer Financials (YTD)</h3>			
			</header>
			
			<ul class="list-detail">
				<li>
					Total Lease Expense <small>(All Locations)</small>
					<mark>
						{{$allData['leaseExpense'] ? $allData['leaseExpense'] : 0}}
					</mark>
				</li>
				<li>
					Total Maintenance Expense <small>(All Locations)</small>
					<mark>
						{{$allData['totalPrice'] ? $allData['totalPrice'] : 0}}
					</mark>
				</li>
				<li>
					Total Tariler Count Lease & Owned <small>(All Locations)</small>
					<mark>
						{{$allData['totalLeased_owned'] ? $allData['totalLeased_owned'] : 0}}
					</mark>

				</li>
			</ul>
						
		</div>
	</div>
	
</div>
