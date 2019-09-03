<div class="trailer-contents">

	<div class="row">
		<div class="col-md-4">&nbsp;</div>
		<div class="col-md-4">&nbsp;</div>
		<div class="col-md-4">
			<h3>Trailer Financials (YTD)</h3>
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-4" id="lease_expense_chart">
			{!! $leaseExpenseChart !!}
		</div>
		<div class="col-md-4" id="Total_Maintenance_Expense">
			{!! $TotalMaintenanceExpense !!}
		</div>
		<div class="col-md-4">
			<div class="row">
				<div class="col-md-6">Total Lease Expense (All Locations)</div>
				<div class="col-md-4">
					{!! Form::text('leaseExpense', $allData['leaseExpense'] ? $allData['leaseExpense'] : 0, array('class'=>'form-control', 'id'=>'leaseExpense', 'placeholder'=>'Total Lease Expense', 'readonly' => true)) !!}
				</div>
			</div>
			<div class="row">&nbsp;</div>
			<div class="row">
				<div class="col-md-6">Total Maintenance Expense (All Locations)</div>
				<div class="col-md-4">
					{!! Form::text('totalPrice', $allData['totalPrice'] ? $allData['totalPrice'] : 0, array('class'=>'form-control', 'id'=>'totalPrice', 'placeholder'=>'Total Maintenance Expense', 'readonly' => true)) !!}
				</div>
			</div>
			<div class="row">&nbsp;</div>
			<div class="row">
				<div class="col-md-6">
					Total Tariler Count Lease & Owned (All Locations)
				</div>
				<div class="col-md-4">
					{!! Form::text('totalLeased_owned', $allData['totalLeased_owned'] ? $allData['totalLeased_owned'] : 0, array('class'=>'form-control', 'id'=>'totalLeased_owned', 'placeholder'=>'Total Lease Expense', 'readonly' => true)) !!}
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-4" id="Total_trailer_count_owned">
			{!! $TrailerLeasedCountAndOwned !!}
		</div>
		<div class="col-md-8">&nbsp;</div>
	</div>
	
</div>
