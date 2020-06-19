@if(!$formOne)
<!-- small box -->
<div class="d-flex">
  <h3 class="d-inline mr-5">Complete Your Profile first</h3>
  <p><small class="d-inline mr-5 font-weight-bold">( Step one pending )</small></p>
  <a href="{{ url('cleaner/information') }}" class="small-box-footer btn btn-danger">Step 1</a>
</div>
@elseif(!$formTwo)
<!-- small box -->
<div class="d-flex">
  <h3 class="d-inline mr-5">Update address </h3>
  <p><small class="d-inline mr-5 font-weight-bold">( Step two pending )</small></p>
  <a href="{{ url('cleaner/address') }}" class="btn btn-danger d-inline">Step 2</a>
</div>
@elseif(!$formThree)
<div class="d-flex">
  <h3 class="d-inline mr-5">Upload Profile Photo </h3>
  <p><small class="d-inline mr-5 font-weight-bold">( Step four pending )</small></p>
  <a href="{{ url('cleaner/profile_photo') }}" class="btn btn-danger d-inline">Step 4</a>
</div>
@elseif(!$formFour)
<div class="d-flex">
  <h3 class="d-inline mr-5">Complete Identity Information </h3>
  <p><small class="d-inline mr-5 font-weight-bold">( Step four pending )</small></p>
  <a href="{{ url('cleaner/identity') }}" class="btn btn-danger d-inline">Step 4</a>
</div>
@else