@extends('layouts.app')

@section('content')
<style>
.image-button {
    color: white;
    background-color: green;
    font-weight: bold;
}
</style>
    @include('flash::message')
    <div class="page">
      <div class="content">
        @include('trailers.forms.form')
      </div>

    </div>
<script type="text/javascript">
    $(document).ready(function(){
      $(document.body).on('change', '#SiteId', function() {
        $.post("/trailer-owners", 
            {
                SiteId: $(this).val(), 
                _method: 'POST', 
                _token: '{{ csrf_token() }}'
            })
            .done(function (response) {
            if (response.success == 1) {
                $("#Owner").val(response.Owner);
                $("#business_detail").val(response.business);
            } else {
                console.log("not found");
            }
        });
    });  
      $(document).on('click', '.edit-class', function() {
        $("#edit_trailer").submit();
      });
      $(document).on('click', '.search-by-trailer-number', function () {
        var formData = $("#search-by-trailer-number").serialize();
        searchTrailer(formData);
      });
      $(document).on('click', '.search-by-vin-number', function () {
        var formData = $("#search-by-vin-number").serialize();
        searchTrailer(formData);
      });
      $(document).on('click', '.search-by-tracking-id', function () {
        var formData = $("#search-by-tracking-id").serialize();
        searchTrailer(formData);
      });
      $(document).on('click', '.search-by-business-location', function () {
        var formData = $("#search-by-business-location").serialize();
        searchTrailer(formData);
      });
    });
    function searchTrailer(formData) {
      $.ajax({
            url: "/trailer-data?"+formData,
            method: "GET",
        }).done(function(response) {
            $("#home_data_table").html(response);
        });
    }
</script>    
@endsection
