@extends('layouts.app')

@section('content')
<div class="page">

    <div class="row">
        <div class="col-lg-12">
            <div class="heading">
                <h3 class="title">
                    Waiting For Approval
                </h3>
            </div>
            <div class="form-block mb-5">
                <p>Your account is not verified yet. Please verify your account by clicking on the link provided in the email.</p>
            </div>
        </div>

        
    </div>

</div>

<script type="text/javascript">
    $(document).ready(function(){
        $(document.body).on('change', '.form-submit', function () {
            $("#dashboard-form").submit();
        });
    });
</script>
@endsection
