
<div class="row">
	<div class="col-lg-8">
		<div class="table-responsive mb-4">
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
									<a class="text-primary" href="{{route('download.file',$fileData->Id)}}">DownLoad {{str_replace("_", " ",$fileData->DocType)}}</a>
								@else
									No File
								@endif
							</td>
							<td>
								{{str_replace("_", " ",$fileData->DocType)}}
							</td>
							<td>
								{{ file_exists(public_path('docs/'.$fileData->FileName)) ? 'Exists' : 'File Not Available' }}
							</td>
						</tr>
						@endif
					@endforeach
				</tbody>
			</table>
		</div>	
	</div>
</div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    
@if(count($data->TrailerInvoices))
<header class="heading">
	<h4 class="title">
		Equipment Invoices
	</h4>
	<h5>
		Click the Invioce Number to View the Invoice
	</h5>
</header>

<div class="row">
	<div class="col-lg-8">
		<div class="table-responsive">
			<table class="table table-striped text-sm table-hover">
				<thead>
					<tr>
						<th>DownLoad Invoice</th>
						<th>Invoice Number</th>
						<th>Invoice Date</th>
						<th>Total Invoice</th>
					</tr>
					<tbody>
						@php
							$i = 0;
						@endphp
						@foreach($data->filesData as $fileData)
							@if($fileData->DocType =="invoice")
							<tr>
								<td>
									@if(file_exists(public_path('docs/'.$fileData->FileName)))
										<a class="text-primary" href="{{route('download.file',$fileData->Id)}}">DownLoad</a>
									@else
										No File
									@endif
								</td>
								<td>
									<a href="{{route('edit.invoice', ['InvoiceNo' => $data->TrailerInvoices[$i]->InvoiceNo])}}">
										{{$data->TrailerInvoices[$i]->InvoiceNo}}
									</a>	
								</td>
								<td>{{date('m/d/Y', strtotime($data->TrailerInvoices[$i]->InvoiceDate))}}</td>
								<td>{{ $data->TrailerInvoices[$i]->TotalPrice }}</td>
							</tr>
								@php
									$i++;
								@endphp
							@endif
						@endforeach
					</tbody>
				</thead>
			</table>
		</div>
	</div>
</div>
@endif