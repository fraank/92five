<!-- Add Event Popup -->
<div id="myModal" class="modal hide fade cal_light_box" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <form class="form-horizontal" action='calendar/add' method='post' id="addevent" data-validate="parsley">
    <div class="modal-header form_modal_header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      <h3 id="myModalLabel">
        <input type="text" name="title" id="title" class="popup_title_input" placeholder="Title" data-required="true"  data-show-errors="false" >
      </h3>
    </div>
    <div class="modal-body">
      <div class="popup_event">
        <div class="add-proj-form">
          <fieldset>
            <div class="row-fluid">
              <div class="control-group">
                <div class="row-fluid">
                  <input id="date" name="date" type="text" class="span6 pull-left" placeholder="When" data-required="true"  data-show-errors="true">
                  <div id="timeselect">
                    <input id="starttime" name="starttime" type="text" class="span3 pull-left" placeholder="From" data-show-errors="true">
                    <input id="endtime" name="endtime" type="text" class="span3 pull-left" placeholder="Till" data-show-errors="true">
                  </div>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label" for="allday">All day?</label>
                <div class="controls">
                  <input id="allday" name="allday" value="1" type="checkbox" data-show-errors="true">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label" for="passwordinput">Category:</label>
                <div class="controls">
                  <div class="task_select">
                    <select name="category" id="category" tabindex="1" style="width:270px;" data-required="true"  data-show-errors="false">
                      <option name="" value="" selected="selected" title="">Select Category</option>
                      <option  name="" value="Meeting - General" title="">Meeting - General</option>
                      <option  name="" value="Meeting - Project" title="">Meeting - Project</option>
                      <option  name="" value="Meeting - Task" title="">Meeting - Task</option>
                      <option  name="" value="Deliverer" title="">Deliverer</option>
                      <option  name="" value="Client" title="">Client</option>
                      <option  name="" value="Others" title="">Others</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label" for="passwordinput">Note:</label>
                <div class="controls">
                  <textarea  name="note" id="note" class="add-proj-form-t" placeholder="Note"></textarea>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label" for="passwordinput">People:<span class="tooltipster-icon" title="To add the people start typing the name and select the appropriate user from the list. Please note that only those name will appear in list who are registered in the app. Please add your name as well if you are one of them.">(?)</span></label>
                <div class="controls">
                  <input id="plugin" name="passwordinput" type="text" placeholder="Add Name">
                </div>
                <div id="selected">
                  <ul id="list">
                  </ul>
                  <input style="display: none;" name="tagsinput" id="tagsinput" class="tagsinput" placeholder="Add Name" value=""/>
                  <p></p>
                </div>
              </div>
              <div class="advanced_link"><a href="#" id="adv">Advanced</a></div>
            </div>
            <div id="advanced-inputs">
              <div class="row-fluid event_form_data">
                <div class="control-group">
                  <label class="control-label" for="passwordinput">Location:</label>
                  <div class="controls">
                    <input id="location" name="location" type="text" placeholder="Location">
                  </div>
                </div>
              </div>
            </div>
            <button class="submit pull-right">Submit</a></button>
          </fieldset>
        </div>
      </div>
    </div>
  </form>
</div>
<!-- End Add Event Popup -->
