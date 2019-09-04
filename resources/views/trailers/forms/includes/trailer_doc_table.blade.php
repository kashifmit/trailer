<div class="row">
		<table class="table table-striped text-sm table-hover">
			<thead>
				<tr>
					<th>DownLoad</th>
					<th>Document Name</th>
					<th>Status</th>
				</tr>
			</thead>
			<tbody>
				@foreach($data->filesData as $fileData)
					@if($fileData->DocType !="invoice")
					<tr>
						<td>
							@if(file_exists(public_path('docs/'.$fileData->FileName)))
								<a href="{{route('download.file',$fileData->Id)}}">DownLoad {{str_replace("_", " ",$fileData->DocType)}}</a>
							@else
								File Not Available
							@endif
						</td>
						<td>
							{{str_replace("_", " ",$fileData->DocType)}}
						</td>
						<td>
							{{ file_exists(public_path('docs/'.$fileData->FileName)) ? 'Exists' : 'Not Available for download' }}
						</td>
					</tr>
					@endif
				@endforeach
			</tbody>
		</table>
	</div>
	<div class="row">&nbsp;</div>
	<div class="row">
		<div class="col-md-12 text-left">
			<h3>
			Equipment Invoices
			</h3>
			<p>Click the Invioce Number to View the Invoice</p>
		</div>
	</div>
	<div class="row">&nbsp;</div>
	<div class="row">
		<table class="table table-striped text-sm table-hover">
			<thead>
				<tr>
					<th>DownLoad Invoice</th>
					<th>Invoice Number</th>
					<th>Invoice Date</th>
					<th>Vendor</th>
					<th>Total Invoice</th>
				</tr>
				<tbody>
					@foreach($data->filesData as $fileData)
						@if($fileData->DocType =="invoice")
						<tr>
							<td>
								@if(file_exists(public_path('docs/'.$fileData->FileName)))
									<a href="{{route('download.file',$fileData->Id)}}">DownLoad {{str_replace("_", " ",$fileData->DocType)}}</a>
								@else
									File Not Available
								@endif
							</td>
							<td>Invoice Number</td>
							<td>Invoice Date</td>
							<td>Vendor</td>
							<td>Total Invoice</td>
						</tr>
						@endif
					@endforeach
				</tbody>
			</thead>
		</table>
	</div>