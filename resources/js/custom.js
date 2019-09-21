$(document).ready(function () {
    
    $('.nav-trigger').on('click', this, function(){
        $('body').toggleClass('menu-collapsed');
    });

    $('.nav-overlay').on('click', this, function(){
        $('body').removeClass('menu-collapsed');
    });

    $('.datepicker').datepicker();

    $('.selectable-box').select2();
    
});



$(document).on('click', '.checkClass', function () {
  if ($(this).attr('href') === "#home_details" || $(this).attr('href') === "#trailer_details") {
  	$(".homeClass").show();
  	$(".docsClass").hide();
  	$(".add_financial_invoice_top").hide();
  	return false;
  }
  if ($(this).attr('href') === "#trailer_documents") {
  	$(".homeClass").hide();
  	$(".add_financial_invoice_top").hide();
  	if($("#enable_document").val()) {
  		$(".upload_documents, .search_documents").show();
  	}
  	return false;
  }
  if ($(this).attr('href') === "#trailer_locations") {
  	$(".homeClass").hide();
  	$(".docsClass").hide();
  	$(".add_financial_invoice_top").hide();
  	return false;	
  }
  if ($(this).attr('href') === "#trailer_financials") {
  	$(".homeClass").hide();
  	$(".docsClass").hide();
  	$(".add_financial_invoice_top").show();
  	return false;	
  }
});

$(document).on('click', '.find-docs', function (argument) {
    var allBlank = false;
    if ($("#TrailerSerialNo_docs").val() != "" ||
        $("#VehicleId_VIN_docs").val() != "" ||
        $("#TrackingId_docs").val() != ""
        ) {
        allBlank = true;
    } else {
        allBlank = false;
        alert('Please add any value');
    }
    if (allBlank) {
    	var classes = "download_documents,upload_documents,search_documents";
        searchResult("/search-trailer-docs?",$("#search_trailer_docs").serialize(), classes);
    }
});

$(document).on('click', '.download-all-documents', function () {
	var classes = "upload_documents,search_documents";
    searchResult("/download-all-docs?",$("#all_docs_form").serialize(), classes);
});

$(document).on('click', '.search-docs-form', function () {
	var classes = "";
    searchResult("/search-docs-form","", classes);
});
$(document).on('click', '.upload-documents', function () {
	var classes = "download_documents,search_documents";
    searchResult("/upload-all-docs?",$("#upload_all_docs").serialize(), classes);
});
$(document).on('submit', '#upload_documents', function (e) {
    e.preventDefault();
    $.ajax({
        url: "/upload-documents",
        type: "POST",
        data:  new FormData($(this)[0]),
        contentType: false,
        cache: false,
        processData:false,
    }).done(function(response){
        if (response.success) {
            $(".alert").addClass('alert-success').html(response.message).show();
            setTimeout(function(){ 
                $(".alert").removeClass('alert-success').html('').hide();
            }, 3000);
        } else {
            $(".alert").addClass('alert-danger').html(response.message).show();
            setTimeout(function(){ 
                $(".alert").removeClass('alert-danger').html('').hide();
            }, 3000);
            console.log(response.technical_message);
        }
    });
});

function searchResult(route, formData, classes) {
	$(".docsClass").hide();
    $.ajax({
        url: route+formData,
        method:"get",
    }).done(function (response) {
    	if (classes != "") {
    		var array = classes.split(",");
	    	$.each(array, function(key, item) {
	    		$("."+item).show();
	    	});	
    	}
    	
        $("#trailer_documents").html(response);
    });
}

function searchTrailer(formData) {
	$.ajax({
        url: "/trailer-data?"+formData,
        method: "GET",
    }).done(function(response) {
        $("#home_data_table").html(response);
    });
}
