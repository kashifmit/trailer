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

$(document).on('click', '.get-file-view', function(){
  var fileName = $(this).attr('file-name');
  var filetype = $(this).attr('file-type');
  $("#image_previews").attr('src', fileName);
  $("#image_previews").attr('image_previews', 'application/'+filetype);
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
      switch($("#enable_document").val()) {
        case "search_documents":
          $(".docsClass").hide();
        break;
        case "show_document_table":
          $(".docsClass").hide();
          $(".download_documents, .upload_documents, .search_documents").show();
        break;
        case "download_all_documents":
          $(".docsClass").hide();
          $(".upload_documents, .search_documents").show();
        break;
        case "upload_all_documents":
          $(".docsClass").hide();
          $(".download_documents, .search_documents").show();
        break;
      }
      return false;
  	}
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
	$.ajax({
	    url: "/search-docs-form",
	    method:"get",
	}).done(function (response) {
	    $("#trailer_documents").html(response);
      $(".docsClass").hide();
	});
});
$(document).on('click', '.upload-documents', function () {
	var classes = "download_documents,search_documents";
    searchResult("/upload-all-docs?",$("#upload_all_docs").serialize(), classes);
});
$(document).on('submit', '#form_inspection_document', function (e) {
    e.preventDefault();
    if ($("#file_inspection_document").val() == "") {
      alert("Please select Inspection document File file");
      return false;
    }
    var formData = $(this)[0];
    upploadDocuments(formData);
});

$(document).on('submit', '#form_fhwa', function (e) {
    e.preventDefault();
    if ($("#file_fhwa").val() == "") {
      alert("Please select FHWA file");
      return false;
    }
    var formData = $(this)[0];
    upploadDocuments(formData);
});

$(document).on('submit', '#form_registration', function (e) {
    e.preventDefault();
    if ($("#file_registration").val() == "") {
      alert("Please select Registration file");
      return false;
    }
    var formData = $(this)[0];
    upploadDocuments(formData);
});

$(document).on('submit', '#form_tracking_installation_sheet', function (e) {
    e.preventDefault();
    if ($("#file_tracking_installation_sheet").val() == "") {
      alert("Please select Tracking Installation Sheet file");
      return false;
    }
    var formData = $(this)[0];
    upploadDocuments(formData);
});

function upploadDocuments(formData) {
  $.ajax({
        url: "/upload-documents",
        type: "POST",
        data:  new FormData(formData),
        contentType: false,
        cache: false,
        processData:false,
    }).done(function(response){
        $("#trailer_documents").html(response);
        setTimeout(function(){ 
          $(".alert-success").hide();
        }, 4000);
    });
}

function searchResult(route, formData, classes) {
	if (formData != "") {
		$(".docsClass").hide();
	    $.ajax({
	        url: route+formData,
	        method:"get",
	    }).done(function (response) {
	        $("#trailer_documents").html(response);
	        if (classes != "" && $("#check_Data_available").val() != "0") {
	    		var array = classes.split(",");
		    	$.each(array, function(key, item) {
		    		$("."+item).show();
		    	});	
	    	} else {
			$(".search_documents").show();
	    	}
	    });	
	} else {
		$(".docsClass").hide();
		$(".search_documents").show();
	}
	
}
