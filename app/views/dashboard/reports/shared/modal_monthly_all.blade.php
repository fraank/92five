<!-- Monthly All template -->
<div id="myModal-monthlyall" class="modal cal_light_box hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Complete Monthly Report</h3>
  </div>
  <div class="modal-body">
    <div class="confirm-button">
      <form method="post" action="{{url('/dashboard/reports/monthly')}}" method='post' data-validate="parsley">
        <div class="modal-body">
          <div class="popup_event">
            <div class="add-proj-form">
              <fieldset>
                <div class="row-fluid">
                  <div class="control-group">
                    <div class="row-fluid">
                      <label class="control-label" for="passwordinput">Select month:</label>
                      <input id="monthall" name="monthall" type="text" class="span6 pull-left" placeholder="Date" data-required="true" data-trigger="change">
                    </div>
                  </div>
                  @if ($users)
                    <div class="row-fluid">
                      <label class="control-label" for="passwordinput">Select User:</label>
                      <div class="controls">
                        <div class="task_select">
                          <select name="user_id" id="userprojectreportid" tabindex="1" data-required="true" style="width:270px;">
                            @foreach ($users as $user)
                              <option value="{{ $user->id }}">
                              @if (trim($user->fullName()) != "")
                                {{ $user->fullName() }}
                              @else
                                {{ $user->email }}
                              @endif
                              </option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                    </div>
                  @endif
                </fieldset>
              </div>
            </div>
          </div>
        <button class="submit">Submit</a></button>
      </form>
    </div>
  </div>
</div>
<!-- End Monthly All Tempate -->