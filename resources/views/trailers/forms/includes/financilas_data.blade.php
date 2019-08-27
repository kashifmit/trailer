<div class="row">
	<div class="col-md-4">&nbsp;</div>
	<div class="col-md-4">&nbsp;</div>
	<div class="col-md-4">
		<h3>Trailer Financials (YTD)</h3>
	</div>
</div>

<div class="row">
	<div class="col-md-4">Total Lease Expense</div>
	<div class="col-md-4">Total Maintenance Expense</div>
	<div class="col-md-4">
		<div class="row">
	        <div class="col-md-6">Total Lease Expense (All Locations)</div>
	        <div class="col-md-4">
	            {!! Form::text('leaseExpense', $allData['leaseExpense'], array('class'=>'form-control', 'id'=>'leaseExpense', 'placeholder'=>'Total Lease Expense', 'readonly' => true)) !!}
	        </div>
	    </div>
	    <div class="row">&nbsp;</div>
	    <div class="row">
            <div class="col-md-6">Total Maintenance Expense (All Locations)</div>
            <div class="col-md-4">
                {!! Form::text('totalPrice', $allData['totalPrice'], array('class'=>'form-control', 'id'=>'totalPrice', 'placeholder'=>'Total Maintenance Expense', 'readonly' => true)) !!}
            </div>
        </div>
        <div class="row">&nbsp;</div>
        <div class="row">
	        <div class="col-md-6">
	        	Total Tariler Count Lease & Owned (All Locations)
	        </div>
	        <div class="col-md-4">
	            {!! Form::text('totalLeased_owned', $allData['totalLeased_owned'], array('class'=>'form-control', 'id'=>'totalLeased_owned', 'placeholder'=>'Total Lease Expense', 'readonly' => true)) !!}
	        </div>
	    </div>
	</div>
</div>