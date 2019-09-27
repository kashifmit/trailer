<div class="trailer-contents">

	<div class="row">
		<div class="col-xl-6 mb-5 mb-xl-0">
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
		<div class="col-xl-6">
			<header class="heading heading-detail-sp">
				<h3 class="title text-right">Trailer Financials (YTD)</h3>			
			</header>
			
			<ul class="list-detail list-sp">
				<li>
					<span>Total Lease Expense (All Locations)</span>
					<mark>
						{{$allData['leaseExpense'] ? '$ '.number_format((float)$allData['leaseExpense'], 2) : 0}}
					</mark>
				</li>
				<li>
					<span>Total Maintenance Expense (All Locations)</span>
					<mark>
						{{$allData['totalPrice'] ? '$'. number_format((float)$allData['totalPrice'], 2) : 0}}
					</mark>
				</li>
				<li>
					<span>Total Tariler Count Lease & Owned (All Locations)</span>
					<mark>
						{{$allData['totalLeased_owned'] ? '$'. number_format($allData['totalLeased_owned'], 2) : 0}}
					</mark>

				</li>
			</ul>
						
		</div>
	</div>
	
</div>
